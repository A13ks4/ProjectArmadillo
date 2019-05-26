<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
   
    
    public function users(){
        return $this->hasMany("App\User");
    }

    public function streets(){
        return $this->belongsToMany("App\Street");
    }

    public function plans(){
        return $this->hasMany('App\Plan');
    }
}
