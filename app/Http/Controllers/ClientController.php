<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\FicheVT;
use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    public function index()
    {
        $all_projects = Project::all();
        $client = Factory::createWithAccessToken(config('services.hubspot.access_token'));
        // Contact
        try {
            $columns = ['firstname', 'lastname', 'email', 'city', 'phone', 'state', 'zip', 'address'];

            $apiResponse = $client->crm()
                ->contacts()
                ->basicApi()
                ->getPage(10, null, $columns, null, null, false);

            //Client::query()->truncate();

            foreach ($apiResponse['results'] as $result) {

                //dump($result['properties']);

                Client::query()->updateOrCreate(
                    ['email' => $result['properties']['email']],
                    [
                        "id" => $result['properties']['hs_object_id'],
                        "city" => $result['properties']['city'],
                        "email" => $result['properties']['email'],
                        "firstname" => $result['properties']['firstname'],
                        "lastname" => $result['properties']['lastname'],
                        "phone" => $result['properties']['phone'],
                        "state" => $result['properties']['state'],
                        "zip" => $result['properties']['zip'],
                        "address" => $result['properties']['address'],
                        "created_at" => $result['properties']['createdate'],
                        "updated_at" => $result['properties']['lastmodifieddate'],
                    ]
                );

            }

            $user = auth()->user();
            if ($user->hasRole('commercial'))
                $clients = $user->clients;
            else
                $clients = Client::all();

            return view('clients.index', compact('clients', 'all_projects'));

        } catch (ApiException $e) {
            echo "Exception when calling List de client: ", $e->getMessage();
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::find($request['client_id']);
        $client->signe = $request['signature'];
        if (!$request['signature']) {
            $client->no_signe_raisons = $request['signature_non'];
        } else {
            $client->no_signe_raisons = null;
        }
        if(is_null($client->step)){
            $client->step = "visite technique";
        }
        
        $client->save();

        $client->projects()->sync($request['projects']);
        $projects_id = $request['projects'];
        
        $isFvtCreated = FicheVT::where('client_id', $request['client_id'])->first();
        return redirect()
            ->route('documents.index',['client_id' => $client->id, 'project_id' => implode("",$request['projects']), 'isfvtcreated' => $isFvtCreated])
            ->withSuccess('Le client '.$client->email.' a été modifié avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects = Project::all();
        $client = Client::find($id);
        $project_ids = $client->projects()->pluck('projects.id');
        return view('clients.show', compact('client', 'projects', 'project_ids'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    public function search(Request $request)
    {
        $all_projects = Project::all();

        //DB::connection()->enableQueryLog();
        $dates = $request['dates'];
        $projects = $request['projects'];
        $search_text = $request['search_text'];

        $query = Client::query();

        if (isset($dates) && $dates[0] != 'tout')
            $query->whereIn(DB::raw("YEAR(`created_at`)"), $request['dates']);

        if ($search_text)
            $query->where(DB::raw("concat(firstname, ' ', lastname)"), 'like', "%{$request['search_text']}%");

        if ($projects) {
            $query->whereHas('projects', function ($q) use ($projects) {
                $q->whereIn('projects.id', $projects);
            });
        }

        $user = Auth::user();
        if ($user->hasRole('commercial')) {
            $query->whereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            });
        }

        //DB::enableQueryLog();
        $clients = $query->get();
        //$quries = DB::getQueryLog();
        //dd($quries);

        return view('clients.index', compact('clients', 'dates', 'projects', 'all_projects', 'search_text'));
    }
}
