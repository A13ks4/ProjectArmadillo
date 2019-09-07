<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function user(){
        return $this->hasMany('App\User');
    }
    public function plan(){
        return $this->belongsTo("App\Plan");
    }
}
