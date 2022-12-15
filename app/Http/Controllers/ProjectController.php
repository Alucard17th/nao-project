<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    // public function usersClients(){
    //     $projects = Client::all();
    //     $data = Client::query()->with('users')->get();
    //     $projects = Client::with(['users' => function ($query) {
    //         $query->where('id', '=', 3);
    //     }])->get();
    //     echo '<ol>';
    //     foreach($projects as $project){
    //         echo '<li>'.$project->firstname.'</li>';
    //         echo '<li>'.$project->lastname.'</li>';
    //         echo '<ul>';
    //         foreach($project->users as $employe){
    //             echo '<li>'.$employe->name.'</li>';
    //         }
    //         echo '</ul>';
    //     }
    //     echo '</ol>';

    //     $user = auth()->user();

    //     echo "L utilisater est : ";
    //     // echo $user->clients;
    //     foreach($user->clients as $employe){
    //         echo '<li>'.$employe->firstname.'</li>';
    //         echo '<li>'.$employe->lastname.'</li>';
    //     }

    //     // dd($projects);
    //     // return view('todo-lists.index', compact('projects'));
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
