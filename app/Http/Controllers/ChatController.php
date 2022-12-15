<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatMessageEvent;
use App\Models\User;
use App\Models\NoaMessages;
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

        // GET ALL MESSAGES IN DATABASE by from to 
        $user = auth()->user();
        $messages = NoaMessages::where([['from_id', $user->id],['to_id', $request->sendTo]])
        ->orWhere([['to_id', $user->id],['from_id', $request->sendTo]])->get();

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
}
