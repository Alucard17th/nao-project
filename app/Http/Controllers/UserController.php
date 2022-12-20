<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = Role::query()->where('name', 'NOT LIKE', 'administrator')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'role' => ['required', 'int'],
        ]);

        $user = new User();
        $user['name'] = $validated['name'];
        $user['email'] = $validated['email'];
        $user['password'] = Hash::make($validated['password']);
        if ($request['verification']) {
            $user['email_verified_at'] = now();
        }

        $user->save();

        $user->attachRole($validated['role']);

        return redirect()->route('users.index')->with('success', 'User created success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::query()->find($id);
        return view('users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'int'],
        ]);


        $user = User::query()->find($id);

        if ($user) {
            $user['name'] = $validated['name'];
            $user['email'] = $validated['email'];
            if (!empty($validated['password'])) {
                $user['password'] = Hash::make($validated['password']);
            }

            $user->save();

            $user->detachRoles($user->roles);

            $user->attachRole($validated['role']);

            return redirect()->route('users.index')->with('success', 'User updated success');
        }

    }

    public function updateProfile(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'mimes:jpg,jpeg,png,gif']
        ]);

        
        $user = User::query()->find($id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        

        if (!empty($validated['password'])) {
            $user['password'] = Hash::make($validated['password']);
        }

        if (!empty($validated['avatar'])) {
            $avatarPath = $request->file('avatar')->storeAs('avatars', auth()->user()->id.'-profile'.$request->file('avatar')->getClientOriginalName(), 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile mis à jours.');
    }

    public function updateCalendar(Request $request, $id)
    {
        $validated = $request->validate([
            'calendar' => ['required', 'max:255'],
        ]);


        $user = User::query()->find($id);

        if ($user) {
            $user['calendar_id'] = $validated['calendar'];
          
            $user->save();

            return redirect()->route('user.profile')->with('calendar-success', 'Agenda enregistré.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::query()->find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted success');
        } else {
            return redirect()->route('users.index')->with('error', 'User not exists');
        }
    }

    public function setClients($user_id)
    {
        $clients = Client::all();
        $user = User::find($user_id);

        $client_ids = $user->clients->pluck('id')->toArray();

        return view('users.set_clients', compact('clients', 'user', 'client_ids'));
    }

    public function post_setClients(Request $request)
    {
        $user = User::find($request['commercial_id']);
        $user->clients()->sync($request['clients']);

        return back()->with('success', 'Des clients ont été attribués avec succès à ce commercial');
    }

    public function notificationsList(Request $request)
    {
        $user = auth()->user();
       
        return view('notifications.index', compact('user'));
    }

    public function markNotificationAsRead(){
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return Response::json('Notifications marked as read');
    }

    public function userProfile()
    {   
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

}
