<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FarmerBadgeReplacement extends Model
{
    
    public function issuedBy(){
        return $this->hasOne('App\User', 'id' , 'issued_by');
    }
    
    public function badge(){
        return $this->hasOne('App\FarmerBadge', 'id' , 'badge_id');
    }

    public function getPoliceReportAttribute($value)
    {
    	// **** change back - remove '!' ****
        //if (file_exists(public_path().'/storage/police_report/'.$this->attributes['avatar'])){
        	return asset('/storage/police_report').'/'.$this->attributes['police_report'];
        //}else
        	return;
    }
}
