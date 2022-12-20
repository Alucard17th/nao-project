<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\FicheVT;
use App\Models\TodoList;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use Config;
use Response;

class FicheVTController extends Controller
{
    //

    public function index(Request $request)
    {   
        $client = $client = Client::find($request['client_id']);
        $project = $request['projects_ids'];
       
        return view('documents.createfvt', compact('client'));
    }

    public function create(Request $request)
    {       
        // dd($request['client_id']);
        // return redirect()
        //     ->route('documents.index',['client_id' => 1, 'projects_ids' => 4])
        //     ->withSuccess('La Fiche FVT a été crée avec succès');
        // $all_projects = Project::all();
        // $client = Factory::createWithAccessToken(config('services.hubspot.access_token'));
        // // Contact
        try {
            $fichierVT = FicheVT::query()->create(
                [
                    "npa" => $request['npa'],
                    "date_construction" => $request['date_construction'],
                    "nbre_panneaux" => $request['nbre_panneaux'],
                    "puissance" => $request['puissance'],
                    "marque" => $request['marque'],
                    "type_onduleur" => $request['type_onduleur'],
                    "batteries" => $request['batteries'],
                    "commentaire" => $request['commentaires'],
                    "rdv_vt" => $request['date_vt'],
                    "rdv_rbe" => $request['date_rbe'],
                    "client_id" => $request['client_id']
                ]
            );

            

            if($fichierVT){
                // GENERATE AND STORE FVT PDF FILE 
                view()->share('fichierVT', $fichierVT);
                $pdfFvtName = $fichierVT->id.'_ficheVT';
                $pdf = Pdf::loadView('documents.pdf-template', $fichierVT->toArray())->save(public_path().'/storage/pdfs/'.$pdfFvtName.'.pdf');
        
                $final_notifiables = [];
                array_push($final_notifiables, (object)[ 'id' => 4, 'name' => 'Direction Technique']);
                $task = new TodoList();
                $task->client_id = $request['client_id'];
                $task->user_id = Auth::user()->id;
                $task->name = "VISITE TECHNIQUE";
                $task->description = "Compléter Formulaire Visite Technique Part. 1";
                $task->status = "En cours";
                $task->notifiables = $final_notifiables;
                $task->user()->associate(Auth::user()->id); //update the model
                $task->save();

                $final_notifiables = [];
                array_push($final_notifiables, (object)[ 'id' => 4, 'name' => 'Direction Technique']);
                $task = new TodoList();
                $task->client_id = $request['client_id'];
                $task->user_id = Auth::user()->id;
                $task->name = "Date VT";
                $task->description = "Fixer la date VT";
                $task->status = "En cours";
                $task->notifiables = $final_notifiables;
                $task->user()->associate(Auth::user()->id); //update the model
                $task->save();

                $final_notifiables = [];
                array_push($final_notifiables, (object)[ 'id' => 5, 'name' => 'Bureau d\'études']);
                $task = new TodoList();
                $task->client_id = $request['client_id'];
                $task->user_id = Auth::user()->id;
                $task->name = "Data RBE";
                $task->description = "Fixer la data RBE";
                $task->status = "En cours";
                $task->notifiables = $final_notifiables;
                $task->user()->associate(Auth::user()->id); //update the model
                $task->save();
                
                $task = new TodoList();
                $task->client_id = $request['client_id'];
                $task->user_id = Auth::user()->id;
                $task->name = "Tâche Hubspot";
                $task->description = "Compléter les champs Hubspot";
                $task->status = "En cours";
                $task->user()->associate(Auth::user()->id); //update the model
                $task->save();

                $final_notifiables = [];
                array_push($final_notifiables, (object)[ 'id' => 4, 'name' => 'Direction Technique']);
                array_push($final_notifiables, (object)[ 'id' => 5, 'name' => 'Bureau d\'études']);
                array_push($final_notifiables, (object)[ 'id' => 6, 'name' => 'Administratif']);
                array_push($final_notifiables, (object)[ 'id' => 7, 'name' => 'Direction']);
                $task = new TodoList();
                $task->client_id = $request['client_id'];
                $task->user_id = Auth::user()->id;
                $task->name = "Tâche BDC";
                $task->description = "Scanner les BDC signé + Dépôt";
                $task->status = "En cours";
                $task->notifiables = $final_notifiables;
                $task->user()->associate(Auth::user()->id); //update the model
                $task->save();

                $final_notifiables = [];
                array_push($final_notifiables, (object)[ 'id' => 6, 'name' => 'Administratif']);
                $task = new TodoList();
                $task->client_id = $request['client_id'];
                $task->user_id = Auth::user()->id;
                $task->name = "Tache lettre de procuration";
                $task->description = "Scanner la lettre de procuration + Dépôt";
                $task->status = "En cours";
                $task->notifiables = $final_notifiables;
                $task->user()->associate(Auth::user()->id); //update the model
                $task->save();

                
                try {
                    Config::set('google-calendar', [
                        'auth_profiles' => [
                            'service_account' => [
                                // 'credentials_json' => storage_path('app/google-calendar/api-key-' . auth()->user()->id . '.json'),
                                'credentials_json' => storage_path('app/google-calendar/service-account-credentials.json'),
                            ]
                        ],
                        'calendar_id' => Auth::user()->calendar_id,
                    ] + config('google-calendar'));
                    
                    // CREATE GOOGLE AGENDA VT EVENT with date 
                    
                    // $event = new Event;
                    $event = Event::create([
                        'name' => 'A new event',
                        'startDateTime' => Carbon::now(),
                        'endDateTime' => Carbon::now()->addHour(),
                     ]);
                    // $event->name = 'Rendez-vous visite technique';
                    // $rbeDate = Carbon::parse($request['date_vt']);
                    // $rbeDateEnd = (clone $rbeDate)->addHour();
                    // $event->startDateTime = $rbeDate;
                    // $event->endDateTime = $rbeDateEnd;
                    // $event->save();

                    // CREATE GOOGLE AGENDA RBE EVENT with date
                    // $event = new Event;
                    // $event->name = 'Rendez-vous RBE';
                    // $rbeDate = Carbon::parse($request['date_rbe']);
                    // $rbeDateEnd = (clone $rbeDate)->addHour();
                    // $event->startDateTime = $rbeDate;
                    // $event->endDateTime = $rbeDateEnd;
                    // $event->save();
                } 
                catch(\Exception $error){
                    return redirect()
                    ->route('fichevt.create',['client_id' => $request['client_id']])
                    ->with('calendar-error', 'Votre ID d\'agenda ne correspond pas!');
                    // return $error->getMessage();
                }
            }

            $isFvtCreated = FicheVT::where('client_id', $request['client_id'])->first();

            return redirect()
            ->route('documents.index',['client_id' => $request['client_id'], 'isfvtcreated' => $isFvtCreated])
            ->withSuccess('La Fiche FVT a été '. $fichierVT->id .' crée avec succès');

        } catch (ApiException $e) {
            echo "Exception when calling List de client: ", $e->getMessage();
        }
    }

    public function edit(Request $request)
    {
        $fichierVT = FicheVT::where('id', $request['fiche_id'])->first();
       
        $client = Client::where('id', $fichierVT->client_id)->first();
        return view('documents.editfvt', compact('fichierVT', 'client'));
    }

    public function update(Request $request)
    {
        try{
            $fichierVTUpdated = FicheVT::where('id', $request['fiche_id'])
        
            ->update([
                "npa" => $request['npa'],
                "date_construction" => $request['date_construction'],
                "nbre_panneaux" => $request['nbre_panneaux'],
                "puissance" => $request['puissance'],
                "marque" => $request['marque'],
                "type_onduleur" => $request['type_onduleur'],
                "batteries" => $request['batteries'],
                "commentaire" => $request['commentaires'],
                "rdv_vt" => $request['date_vt'],
                "rdv_rbe" => $request['date_rbe'],
            ]);

            $fichierVT = FicheVT::where('id', $request['fiche_id'])->first();
            $client = Client::where('id', $request['client_id'])->first();
            return view('documents.editfvt', compact('fichierVT', 'client'))
            ->with('successMsg','La Fiche FVT a été modifié avec succès');
        }
        catch (ApiException $e) {
            echo "Exception when calling List de client: ", $e->getMessage();
        }
        
    }

    public function pdf(Request $request)
    {   
        $fichierVT = FicheVT::where('id', $request['fiche_id'])->get();
        view()->share('fichierVT', $fichierVT);
        $pdf = Pdf::loadView('documents.pdf-stream-template', $fichierVT->toArray());
        return $pdf->stream();
    }

    public function getPDFLink(Request $request)
    {   
        $PDFPath = public_path().'/storage/pdfs/'.$request->ficheVTC.'_ficheVT.pdf';
        return Response::json($PDFPath);
    }

}
