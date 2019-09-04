<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
   
    public function users(){
        return $this->belongsToMany('App\User');
    }
    public function driver(){
        return $this->belongsTo('App\User','driver_id');
    }

    public function vehicle(){
        return $this->belongsTo('App\Vehicle');
    }
    public function schedule(){
        return $this->belongsTo('App\Schedule');
    }

    public function reservations(){
        return $this->belongsToMany('App\Reservation');
    }

    public function city_from(){
        return $this->belongsTo('App\City', 'city_id_from');
    }

    public function city_to(){
        return $this->belongsTo('App\City', 'city_id_to');
    }
}
