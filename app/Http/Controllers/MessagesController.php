<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ChatRooms;
use Auth;

use Session;

use App\User;
use App\Types;
use App\Message;
use DateTime;

class MessagesController extends Controller
{
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
        $types=Types::all();
        $user=Auth::user(); 
        $chatrooms=$user->chatrooms()->get();
        $users=User::all();
        $ip=$_SERVER['HTTP_HOST'];
        $user_id= Auth::id();
        return view('messages.create')->with('types',$types)->with('chatrooms',$chatrooms)->with('users',$users)->with('ip',$ip)->with('user_id',$user_id);
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
        $this->validate($request, [
            'text' => 'required',
            'type_id' => 'required',
        ]);

        $message = Message::create([
            'sendAt' => $request->sendAt,
            'text' => $request->text,
            'type_id' => $request->type_id,
            'user_id' => Auth::id()
        ]);
        $message->users()->attach($request->users);
        //because we use seeder we know
        //that type_id = 2 is System message
        if ($request->type_id == 2) {
            $chatroomsAll=ChatRooms::all();
            $arrayIdsChatRoom=Array();
            foreach ($chatroomsAll as $chatroom) {
                $arrayIdsChatRoom[]=$chatroom->id;
            }
            $message->chatrooms()->attach($arrayIdsChatRoom);
        }
        else {
            $message->chatrooms()->attach($request->chatrooms);
        }
        Session::flash('success', 'Message created succesfully.');
        return redirect()->back();        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPersonal($id)
    {
        //
        //format message to be display
        $messagesForDisplay=Array();
        $messagetoShow=Array();
        $user=User::find($id);
        $messages=$user->messagesManyToMany()->get();
        foreach ($messages as $message) {
            $today=new DateTime();
            //send massage pass sendat or not set
            if ((!empty($message->sendAt) && ($message->sendAt<=$today)) || (empty($message->sendAt))) {
                $messagesForDisplay['message']=$message->text;
                $messagesForDisplay['datetime']=$message->created_at;
                $userOfMsg=$message->user()->get()->first();
                //dd($userOfMsg);
                $messagesForDisplay['username']=$userOfMsg->name;
                $messagetoShow[]=$messagesForDisplay;
            }
        }
        //dd($messagesForDisplay);
        $ip=$_SERVER['HTTP_HOST'];
        $user_id= Auth::id();
        return view('messages.personal')->with('messages',$messagetoShow)->with('ip',$ip)->with('user_id',$user_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($room_id,$user_id)
    {
        //
        //format message to be display
        $messagesForDisplay=Array();
        $messagetoShow=Array();
        $chatroom=ChatRooms::find($room_id);
        $chatroomName=$chatroom->name;
        $chatroomid=$chatroom->id;
        $messages=$chatroom->messages()->get();
        foreach ($messages as $message) {
            $today=new DateTime();
            //send massage pass sendat or not set
            if ((!empty($message->sendAt) && ($message->sendAt<=$today)) || (empty($message->sendAt))) {
                $messagesForDisplay['message']=$message->text;
                $messagesForDisplay['datetime']=$message->created_at;
                $userOfMsg=$message->user()->get()->first();
                //dd($userOfMsg);
                $messagesForDisplay['username']=$userOfMsg->name;
                $messagetoShow[]=$messagesForDisplay;
            }
        }
        //dd($messagesForDisplay);
        //dd($_SERVER);
        $ip=$_SERVER['HTTP_HOST'];
        $user_id= Auth::id();
        return view('messages.chatroom')->with('messages',$messagetoShow)->with('chatroomname',$chatroomName)->with('id',$chatroomid)->with('ip',$ip)->with('user_id',$user_id);

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
