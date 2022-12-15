<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use App\Models\Client;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $tasks = TodoList::where('user_id', $user->id)->with('client')->get();
        $clients = $user->clients()->orderBy('id', 'desc')->take(5)->get();
        // $lastClients = $tasks = Client::with('users')->wherePivot('user_id', 3)->get();
        return view('home', compact('tasks', 'clients'));
    }
}
