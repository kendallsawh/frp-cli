<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FarmerBadgeLog extends Model
{
    
    public function issuedBy(){
        return $this->hasOne('App\User', 'id' , 'issued_by');
    }
    
    public function badge(){
        return $this->hasOne('App\FarmerBadge', 'id' , 'badge_id');
    }
    
    public function colour(){
        return $this->hasOne('App\BadgeColour', 'id' , 'colour_id');
    }
}
