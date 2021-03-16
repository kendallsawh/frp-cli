<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationUserComment extends Model
{
    protected $table = 'application_user_comments';

    public function createdBy(){
		return $this->hasOne('App\User', 'id' , 'user_id');
	}

	public function createdBy2($createdby){
		return \App\User::where('id', '=' , $createdby)->first();
	}

	public function eagerparcel(){
		return $this->belongsTo('App\Parcel', 'id' , 'parcel_id');
	}
}
