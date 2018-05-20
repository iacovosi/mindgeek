<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function chatrooms() {
        return $this->belongsToMany( 'App\ChatRooms', 'chatroom_users', 'user_id', 'chatroom_id' );        
    }

    public function role() {
        return $this->belongsTo( 'App\Roles' ,'role_id','id');        
    }

    public function messagesManyToMany() {
        return $this->belongsToMany( 'App\Message', 'message_users', 'user_id', 'message_id' );            
    }

    public function messages() {
        return $this->hasMany( 'App\Message' ,'user_id','id');       
    }

    public function isAdmin() {
        $role=$this->role()->first();
        if ($role->isAdminRole) {
            return true;
        }
        else {
            return false;
        }
    }

    

}
