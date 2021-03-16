<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Application;

class ApplicationUser extends Model
{
    protected $table = 'application_users';
    protected $dates = ['deleted_at'];
    //public $timestamps = false;

    public function getUserAttribute($value)
    {
        
        	return User::find($this->user_id);
        
    }

    public function getApplicationAttribute($value)
    {
        
        	return Application::find($this->app_id);
        
    }
}
