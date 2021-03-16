<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Land extends Model
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'land';
	
	public function address(){
		return $this->hasOne('App\Address', 'id' , 'address_id');
	}
	
	public function area_type(){
		return $this->hasOne('App\AreaType', 'id' , 'area_type_id');
	}

	public function parcel(){
		return $this->belongsTo('App\Parcel', 'land_id' , 'id');
	}
}
