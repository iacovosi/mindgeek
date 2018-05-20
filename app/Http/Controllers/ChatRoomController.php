<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ChatRooms;
use Auth;

use Session;

class ChatRoomController extends Controller
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
        $chatRooms=ChatRooms::all();    
        foreach ($chatRooms as $key=>$chatRoom) {
            $chatRooms[$key]['count']=$chatRoom->users()->get();
            //dd( $chatRooms[$key]['count']);
        }
        return view('chatroom.create')->with('rooms',$chatRooms);  
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
            'name' => 'required',
        ]);

        $chatroom=new ChatRooms;
        $chatroom->name = $request->name;
        $chatroom->save();
        Session::flash('success', 'Your Chat Room was created.');
        $chatRooms=ChatRooms::all();
        foreach ($chatRooms as $key=>$chatRoom) {
            $chatRooms[$key]['count']=$chatRoom->users()->get();
        }
        return redirect()->back()->with('rooms',$chatRooms);
    }


    /*
    join chat rooms
    */
    public function join() {
        $chatRooms=ChatRooms::all();   
        $user_id=Auth::user()->id; 
        foreach ($chatRooms as $key=>$chatRoom) {
            $chatRooms[$key]['count']=$chatRoom->users()->get();
            //dd( $chatRooms[$key]['count']);
            if (count($chatRooms[$key]['count'])>0) {
                //dd($chatRooms[$key]['count']->toArray());
                if ($chatRooms[$key]['count']->whereIn('id',Array($user_id))->isNotEmpty()) {
                    $chatRooms[$key]['isInArray']=1;
                    //dd($user_id);
                }
                //dd($chatRooms[$key]['count']);
            }             
        }

        return view('chatroom.join')->with('rooms',$chatRooms);          
    }

    /*
    enter user to chat rooms
    */
    public function enter($room_id,$user_id) {
        $chatRoom=ChatRooms::find($room_id);
        $chatRoom->users()->syncWithoutDetaching([$user_id]);
        $chatRooms=ChatRooms::all();             
        foreach ($chatRooms as $key=>$chatRoom) {
            $chatRooms[$key]['count']=$chatRoom->users()->get();
            if (count($chatRooms[$key]['count'])>0) {
                //dd($chatRooms[$key]['count']->toArray());
                if ($chatRooms[$key]['count']->whereIn('id',Array($user_id))->isNotEmpty()) {
                    $chatRooms[$key]['isInArray']=1;
                    //dd($user_id);
                }
                //dd($chatRooms[$key]['count']);
            } 

        }
        Session::flash('success', 'You Enter Chat Room.');
        return redirect()->back()->with('rooms',$chatRooms);          
    }

    /*
    leave from a chat room
    */
    public function leave($room_id,$user_id) {
        $chatRoom=ChatRooms::find($room_id);
        $chatRoom->users()->detach([$user_id]);
        $chatRooms=ChatRooms::all();             
        foreach ($chatRooms as $key=>$chatRoom) {
            $chatRooms[$key]['count']=$chatRoom->users()->get();
            if (count($chatRooms[$key]['count'])>0) {
                //dd($chatRooms[$key]['count']->toArray());
                if ($chatRooms[$key]['count']->whereIn('id',Array($user_id))->isNotEmpty()) {
                    $chatRooms[$key]['isInArray']=1;
                    //dd($user_id);
                }
                //dd($chatRooms[$key]['count']);
            } 
        }
        Session::flash('success', 'You Left Chat Room.');
        return redirect()->back()->with('rooms',$chatRooms);           
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
        $chatroom = ChatRooms::find($id);
        $chatroom->delete();
        Session::flash('success', 'Your Chat Room was deleted.');
        return redirect()->back();
    }
}
