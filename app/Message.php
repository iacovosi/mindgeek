<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\ChatRooms;

class Message extends Model
{
    //
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sendAt', 'text', 'type_id','user_id'
    ];


    public function type() {
        return $this->belongsTo( 'App\Types' ,'type_id','id');        
    }  
    
    public function users() {
       return $this->belongsToMany( 'App\User', 'message_users', 'message_id', 'user_id' );               
    }

    public function user() {
        return $this->belongsTo ( 'App\User','user_id','id');           
    }

    public function chatrooms() {
       return $this->belongsToMany( 'App\ChatRooms', 'chatroom_messages', 'message_id', 'chatroom_id' );            
    }
}
