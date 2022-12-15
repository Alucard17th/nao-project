<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\TodoList;
use App\Models\Project;
use App\Models\FicheVT;
use Illuminate\Http\Request;
use App\Models\User;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskDoneNotification;

class TodoListController extends Controller
{

    public function index()
    {
        // $data = TodoList::query()->with(['user', 'client'])->get();

        // $projects = Project::query()->with(['clients' => function ($query) {
        //         $query->with('users');
        //     }])->get();
        // 
        $user = auth()->user();
        $projects = $user->clients;
       
        return view('todo-lists.index', compact('projects'));
    }

    public function TodoListTable(Request $request)
    {
        $user = Auth::user();

        $tasks = TodoList::where('user_id', $user->id)->where('client_id', $request['client_id'])->get();
        $client = Client::where('id', $request['client_id'])->get();
        // $project_step = Project::where('id',  $request['project_id'])->first()->step;
        // $projects = $client;
        $fichevtc = FicheVT::where('client_id',  $request['client_id'])->first();
        if($fichevtc === null){
            $fichevtc = null;
        }else{
            $fichevtc = $fichevtc->id;
        }
        $notifiablesUsers = User::all();
        return view('todo-lists.tasks-table', compact('tasks', 'client', 'fichevtc', 'notifiablesUsers'));
    }

    // UPDATE THE USERS TO BE NOTIFIED FOR A TASK
    public function updateNotifiables(Request $request)
    {   
        $task = TodoList::find($request->taskId);
        // loop through all notifiables from request 
        $final_notifiables = [];
        foreach ($request->notifiables as $notifiable){
            // find user by id from notifiables 
            $user = User::find($notifiable);
            // find each user name 
            array_push($final_notifiables, (object)[ 'id' => $user->id, 'name' => $user->name]);
        }
        // $task->notifiables = array_merge($task->notifiables, $final_notifiables);
        $task->notifiables = array_merge($final_notifiables);
        $task->save();
      
        return Response::json($task);
    }

    // UPDATE THE USERS TO BE NOTIFIED FOR A TASK
    public function updateDelais(Request $request)
    {   
        try{
            $task = TodoList::find($request->taskId);
            $final_delais = [];
            array_push($final_delais, (object)[ 'start' => $request->delais['from'], 'end' => $request->delais['to']]);
            $task->delais = array_merge($final_delais);
            $task->save();
            return Response::json($task);
        }
        catch (ApiException $e) {
            echo "Exception when calling List de client: ", $e->getMessage();
        }
    }

    // UPDATE THE FILES ATTACHED TO A TASK
    public function updateFiles(Request $request)
    {
        try{
            $task = TodoList::find($request->task_id);

            $fileName = auth()->id() . '_' . time() . '.'. $request->file->extension();  
            $type = $request->file->getClientMimeType();
            $size = $request->file->getSize();
            $newFile = $request->file->move(public_path('file'), $fileName);
            // $task->attachements = $newFile->getPathName();
            $task->attachements = $fileName;
            $task->save();
            return Response::json($task);
        }
        catch (ApiException $e) {
            echo "Exception when calling List de client: ", $e->getMessage();
        }
    }

     // UPDATE THE STATUT OF THE TASK
     public function updateStatut(Request $request)
     {
        
        try{
            $task = TodoList::find($request->taskId);
            
            $task->status = $request->statut;
            $task->save();

            if($task->notifiables && $request->statut === 'Fait'){
                foreach($task->notifiables as $notifiable)
                {
                    $user = User::find($notifiable['id']);
                    $client = Client::find($task->client_id);
                    $sender = auth()->user()->name;
                    $content = "Report this user";
                    $notifTask = $task->description;
                    $clientfName = $client->firstname;
                    $clientlName = $client->lastname;
                    $clientName = $clientfName. ' ' .$clientlName;
                    $notificationsSettings = [
                        'sender' => $sender,
                        'content' => $content,
                        'task' => $notifTask,
                        'client' => $clientName,
                        'sender_image' => 'https://cdn.pixabay.com/photo/2013/07/13/12/07/avatar-159236__340.png'
                    ];

                    $user->notify(new TaskDoneNotification($notificationsSettings));
                }
            }
            
            return Response::json($task);
        }
        catch (ApiException $e) {
            echo "Exception when calling List de client: ", $e->getMessage();
        }
     }

    public function FormulaireVisite1($client_id)
    {
        $client = Client::query()->find($client_id);
        return view('todo-lists.formulaire-visite-1', compact('client', 'client_id'));
    }

    public function FormulaireVisite1Submit(Request $request)
    {
        //dd($request->all());
        $task = new TodoList();

        $task->client_id = $request->client_id;
        $task->user_id = Auth::user()->id;
        $task->name = "VISITE TECHNIQUE";
        $task->description = "Formulaire Visite Technique Part. 1";
        $task->fiche_client =
            [
                'First Name' => $request->firstname,
                'Last Name' => $request->lastname,
                'Email' => $request->email,
                'Phone' => $request->phone,
                'Date de construction' => $request->date_de_construction,
                'NPA' => $request->npa,
            ];
        $task->project = [
            'Nombre de panneaux' => $request->nombre_de_panneaux,
            'Puissance' => $request->puissance,
            'Marque' => $request->marque,
            'Type d’onduleur' => $request->type_d_onduleur,
            'Batteries' => $request->batteries,
            'Date de construction' => $request->date_de_construction,
        ];
        $task->delais =
            [
                'Date et heure de la Visite Technique' => $request->date_visite_technique,
                'Date et heure du Retour du Bureau d’Etudes' => $request->date_retour_bureau_detudes,
            ];
        $task->status = "en cours";
        $task->save();
    }

    public function FormulaireVisite2($client_id)
    {
        $client = Client::query()->find($client_id);
        return view('todo-lists.formulaire-visite-2', compact('client', 'client_id'));
    }
}
