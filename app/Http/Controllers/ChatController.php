<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatMessageEvent;
use App\Models\User;
use App\Models\NoaMessages;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use Config;
use Response;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('chat.index', compact('users'));
    }

    public function getChat(Request $request){

        // GET ALL MESSAGES IN DATABASE by from / to 
        $user = auth()->user();
        $messages = NoaMessages::where([['from_id', $user->id],['to_id', $request->sendTo]])
        ->orWhere([['to_id', $user->id],['from_id', $request->sendTo]])->get();

        // MARK ALL SEEN MESSAGES AS SEEN
        $seenMessages = NoaMessages::where([['from_id', $request->sendTo],['to_id', $user->id]])->get();
        foreach($seenMessages as $seenMessage){
            $seenMessage->seen = 1;
            $seenMessage->save();
        }
        return Response::json($messages);
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
        try{
             // STORE MESSAGES IN DATABASE
            $user = auth()->user();

            $message = new NoaMessages();
            $message->from_id = $user->id; 
            $message->to_id = $request->sendto;
            $message->body = $request->message;
            $message->save();
            
            // Broadcast Event with Message 
            event(new ChatMessageEvent($user->name, $request->message, $user, $request->sendto ));
            return response()->json([
                'success' => 'Chat Message Sent'
            ]);
        }
        catch (ApiException $e) {
            echo "Exception when calling List de client: ", $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createEvent(){
        // First override Laravel default config for given user
        Config::set('google-calendar', [
                'auth_profiles' => [
                    'service_account' => [
                        // 'credentials_json' => storage_path('app/google-calendar/api-key-' . auth()->user()->id . '.json'),
                        'credentials_json' => storage_path('app/google-calendar/service-account-credentials.json'),
                        
                    ]
                ],
                'calendar_id' => "47808cc6e318192bb4bcde5297e76ca0f236b34aaed7a2679ce6b95f23954bc5@group.calendar.google.com",
            ] + config('google-calendar'));

        $event = new Event;

        $event->name = 'Megadath & Metallica Live!!!';
        $event->startDateTime = Carbon::now();
        $event->endDateTime = Carbon::now()->addHour();

        $event->save();
    }

    public function shareFiles(Request $request)
    {   
        $explode_id = array_map('intval', explode(',', $request->allReceivers));
        $user = auth()->user();
        
        if($request->TotalFiles > 0)
        {
                
            for ($x = 0; $x < $request->TotalFiles; $x++) 
            {

                if ($request->hasFile('files'.$x)) 
                {
                    $file      = $request->file('files'.$x);
                    $path = $file->store('public/files');
                    $name = $file->getClientOriginalName();

                    $insert[$x]['name'] = $name;
                    $insert[$x]['path'] = $path;
                }
            }

            foreach($explode_id as $receiver)
            {
                $message = new NoaMessages();
                $message->from_id = $user->id; 
                $message->to_id = $receiver;
                $message->body = $request->messageContent;
                $message->attachment = $insert;
                $message->save();
            }
            

            // return response()->json($insert);
            return response()->json(['success'=>'Ajax Multiple fIle has been uploaded']);
        }
        else
        {
           return response()->json(["message" => "Please try again."]);
        }
    }
}
