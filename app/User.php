<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'phone_number', 'gender', 'img', 'date_of_birth', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function city(){
        return $this->belongsTo("App\City");
    }

    public function plans(){
        return $this->belongsToMany('App\Plan');
    }
    public function schedule(){
        return $this->hasMany('App\Schedule');
    }

    public function isAdmin(){
        return $this->level == 3; // Number 3 is admin, driver would be 2 and end user would be 1
    }
    public function isDriver(){
        return $this->level == 2;
    }
    public function isClient(){
        return $this->level == 1;
    }

    public function isImgLocal(){
        return !(strpos($this->img, 'http') === 0);
    }
}
