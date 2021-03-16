<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Districts extends Model
{
	use SoftDeletes;
    
    public $timestamps = false;
	protected $dates = ['deleted_at'];
	public function ward(){
		return $this->hasOne('App\Wards', 'id' , 'ward_id');
	}
    
    public function farmdistrict(){
    	
    		return $this->hasOne('App\FarmingDistrict', 'id' , 'farmer_district_id');

		
	}

	public function scopeOrdered($query){
		return $query->orderBy('district', 'asc')->get();
	}

	public function getfarmdist(){
		//return $this->farmer_district_id;
    	if ($this->farmer_district_id !=0) {
    		return \App\FarmingDistrict::find($this->farmer_district_id)->get();
    	}
    		

		
	}
}
