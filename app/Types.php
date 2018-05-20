<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    //
    protected $table = 'types';
    public function messages() {
        return $this->hasMany ( 'App\Message','type_id','id');           
    }    
}
