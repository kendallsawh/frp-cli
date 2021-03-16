<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
//use Illuminate\Database\Eloquent\SoftDeletes;

class FarmerLogin extends Authenticatable
{
     //use SoftDeletes;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'f_name', 'l_name', 'username', 'email', 'password', 'lastlogin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function getNameAttribute($value)
    {
        return ucwords($this->attributes['f_name'].' '.$this->attributes['l_name']);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
