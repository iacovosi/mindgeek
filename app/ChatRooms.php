<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRooms extends Model
{
    //
    protected $table = 'chat_rooms';

    public function users(){
        return $this->belongsToMany( 'App\User', 'chatroom_users', 'chatroom_id', 'user_id' );
    }
    
    public function messages() { 
        return $this->belongsToMany( 'App\Message', 'chatroom_messages', 'chatroom_id', 'message_id' );             
    }

}
