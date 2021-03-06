<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function plan(){
        return $this->belongsTo("App\Plan");
    }
    public function schedule(){
        return $this->belongsTo("App\Schedule");
    }
}
