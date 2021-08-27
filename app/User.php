<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use Notifiable;

    protected $connection = "mysql2";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'f_name', 'l_name', 'username', 'email', 'password', 'lastlogin','identification',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function routeNotificationForMail($notification)
    {
       return $this->email;
    }

    /*public function roless()
    {
      return $this->hasOne('App\Role','id','role_id');
    }*/

    public function getNameAttribute($value)
    {
        return ucwords($this->attributes['f_name'].' '.$this->attributes['l_name']);
    }

    // public function getCountyAttribute($value)
    // {
    //     $add = \App\Districts::find($this->district_id);
    //     return $add->ward->county->county;
    // }

    /*public function getUserDistrictAttribute($value)
    {
        $userdistrict = \App\UserDistrict::find($this->id);
        return $userdistrict;
    }*/

    /*public function getCountyIdAttribute($value)
    {
        $add = \App\Districts::find($this->district_id);
        return $add->ward->county->id;
    }*/

    /*public function getRegionIdAttribute($value)
    {
        $add = \App\Districts::find($this->district_id);
        return $add->ward->county->region->id;
    }*/

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /* public function getRoleNameAttribute($value)
    {
        $role = \App\Role::find($this->role_id);
        return $role->role;
    }*/

    /*public function getRoleSlugAttribute($value)
    {
        $role = \App\Role::find($this->role_id);
        return $role->slug;
    }*/

   /* public function getShowNotifAttribute($value)
    {
        
        return $this->attributes['show_notif'];
    }*/

     public function getUserApplicationAttribute()
    {
        $add = \App\UserApplication::where('user_id', $this->id)->first();
        return $add;
        //return $this->hasOne('App\UserApplication', 'user_id' , $this->id)->first();
        
    }
   
    public function CreatedOn($value)
    {
        return Carbon::parse($value)->format('F jS, Y');
    }

   

}
