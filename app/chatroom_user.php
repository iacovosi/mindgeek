<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chatroom_user extends Model
{
    //
    protected $table = 'chatroom_users';

    public function chatroom() {
        return $this->belongsTo('App\ChatRooms','chatroom_id','id');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id','id');        
    }
}
