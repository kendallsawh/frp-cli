<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcelType extends Model
{
	
	public function unit(){
		return $this->hasOne('App\ParcelUnit', 'id' , 'parcel_unit_id');
	}
}
