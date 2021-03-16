<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

	

class ParcelTypeOfProduce extends Model
{
    protected $table = 'parcel_types_of_produce';
    //public $timestamps = false;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
	
	public function type(){
		return $this->hasOne('App\ParcelType', 'id' , 'parcel_type_id');
	}
	
	public function unit(){
		return $this->hasOne('App\ParcelUnit', 'id' , 'parcel_unit_id');
	}
}
