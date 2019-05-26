<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    

    public function citys(){
        return $this->belongsToMany("App\City");
    }
}
