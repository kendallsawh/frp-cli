<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false;
	
	public function county(){
		return $this->hasOne('App\Counties', 'id' , 'county_id');
	}
	
	public function districts(){
		return $this->hasMany('App\Districts' , 'ward_id', 'id');
	}
	public function scopeOrdered($query){
		return $query->orderBy('ward', 'asc')->get();
	}
}
