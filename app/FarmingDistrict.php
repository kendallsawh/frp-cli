<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmingDistrict extends Model
{
    public $timestamps = false;
    public function districts(){
		return $this->hasMany('App\Districts' , 'farmer_district_id', 'id');
	}
	public function scopeOrdered($query){
		return $query->orderBy('district_name', 'asc')->get();
	}
}
