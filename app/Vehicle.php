<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    


    public function plans(){
        return $this->hasMany('App\Plan');
    }
    public function schedule(){
        return $this->hasMany('App\Schedule');
    }
}
