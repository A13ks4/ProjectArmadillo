<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function plan(){
        return  $this->hasMany("App\Plan");
    }
    public function vehicle(){
        return $this->belongsTo('App\Vehicle');
    }
    public function driver(){
        return $this->belongsTo('App\User');
    }
}
