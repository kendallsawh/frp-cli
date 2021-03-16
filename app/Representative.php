<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Representative extends Model
{

    public function getNameAttribute($value)
    {
    	return ucwords($this->attributes['f_name'].' '.$this->attributes['l_name']);
    }

    public function getContactAttribute($value)
    {
    	return \App\Contact::find($this->contact_id)->contact;
    }

    public function getIdentificationAttribute($value)
    {
    	return $this->id_num.' ('.\App\IdentificationType::find($this->id_type_id)->identification_type.')';
    }

    public function getSinceAttribute($value)
    {
        return Carbon::parse($this->created_at)->format('F jS, Y');
    }

    public function getAvatarAttribute($value)
    {
    	// **** change back - remove '!' ****
        if (file_exists(public_path().'/storage/avatars/reps/'.$this->attributes['avatar'])){
        	return asset('/storage/avatars/reps').'/'.$this->attributes['avatar'];
        }else
        	return asset('/img/default-avatar.png');
    }

     public function getCompanyAttribute()
    {
        return \App\Organization::whereIn('id',
            \App\OrganizationRep::where('rep_id', $this->id)->pluck('org_id')
        )->get();
    }
}
