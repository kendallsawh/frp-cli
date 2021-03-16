<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function getAddressAttribute($value)
    {
        //return $this->lot_type->lot_type.' '.$this->attributes['house_num'].' '.$this->attributes['road'].', '.$this->district->district;
        if ($this->lot_type->id == 7) {
        	$lottype = '';
        } else {
        	$lottype = $this->lot_type->lot_type;
        }
        
        if ($this->attributes['house_num'] == 'N/A') {
    		$housenumber ='';
    	} elseif ($this->attributes['house_num'] == '00') {
    		$housenumber = '';
    		$lottype = '';
    	} 
    	else{
    		$housenumber =$this->attributes['house_num'];
    	}
    	
    	return $lottype.' '.
       $housenumber.' '.
        $this->attributes['road'].', '.
        $this->district->district;
    }

    public function getLocalityAttribute($value)
    {
        //return $this->lot_type->lot_type.' '.$this->attributes['house_num'].' '.$this->attributes['road'].', '.$this->district->district;
        if ($this->lot_type->id == 7) {
            $lottype = '';
        } else {
            $lottype = $this->lot_type->lot_type;
        }
        
        if ($this->attributes['house_num'] == 'N/A') {
            $housenumber ='';
        } elseif ($this->attributes['house_num'] == '00') {
            $housenumber = '';
            $lottype = '';
        } 
        else{
            $housenumber =$this->attributes['house_num'];
        }
        
        return $lottype.' '.
       $housenumber.' '.
        $this->attributes['road'];
    }

	public function district(){
		return $this->hasOne('App\Districts', 'id' , 'district_id');
	}

	public function lot_type(){
		return $this->hasOne('App\AddressLotType', 'id' , 'lot_type_id');
	}
}
/*if ($this->attributes['house_num'] == 'N/A') {
    		$housenumber ='';
    	} elseif ($this->attributes['house_num'] == '00') {
    		return$housenumber = '';
    	} 
    	else{
    		$housenumber =$this->attributes['house_num'];
    	}
    	
    	return ($this->lot_type->id == 7? '' : $this->lot_type->lot_type).' '.
       $housenumber.' '.
        $this->attributes['road'].', '.
        $this->district->district;*/