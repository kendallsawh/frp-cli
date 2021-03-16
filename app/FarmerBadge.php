<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FarmerBadge extends Model
{

    public function getExpiredAttribute($value)
    {
        $dt = Carbon::parse($this->attributes['date_issued']);
		$now = Carbon::now();
        if($this->attributes['colour_id']==2){
            if ($dt->diffInYears($now) >= 1) 
            return true;
        else
            return false;
        }
        else{
            if ($dt->diffInYears($now) >= 3) 
                return true;
            else
                return false;
        }
        
    }

    public function getExpiryDateAttribute($value)
    {
        if($this->attributes['colour_id']==2){
            return Carbon::parse($this->attributes['date_issued'])->addYears(1)->toDateString();
        }else{
           return Carbon::parse($this->attributes['date_issued'])->addYears(3)->toDateString(); 
        }
        
    }

    public function farmer()
    {
        if($this->attributes['farmer_id']){
            return Farmer::where('id','=',$this->attributes['farmer_id'])->get();
        }else{
           return false; 
        }
        
    }

    public function getStatusAttribute($value)
    {
        if ($this->attributes['valid']) 
	        return 'Valid';
	    else
	    	return 'Invalid';
    }

    public function getTableClassAttribute($value)
    {
    	switch ($this->attributes['colour_id']) {
    		case '1':
    			return 'success';
    			break;
    		
    		case '2':
    			return 'warning';
    			break;
    		
    		default:
    			return '';
    			break;
    	}
    }
	
	public function createdBy(){
		return $this->hasOne('App\User', 'id' , 'user_id')->withTrashed();
	}
}
