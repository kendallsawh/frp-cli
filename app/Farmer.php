<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
	
	public function badge(){

		$farmer = \App\FarmerBadge::where('farmer_id',$this->id)->first();
		if ($farmer) 
			return $farmer;
		else
			return 0;
		
		//return $this->hasOne('App\FarmerBadge', 'farmer_id' , 'id');
	}
	
	public function farmer(){

		$individual = \App\FarmerIndividual::where('farmer_id',$this->id)->first();
		$organization = \App\FarmerOrganization::where('farmer_id',$this->id)->first();
		if ($individual) 
			return \App\Individual::find($individual->ind_id);
		elseif($organization)
			return \App\Organization::find($organization->org_id);
		else
			return 0;
	}

	public function getTypeAttribute(){
		
		$individual = \App\FarmerIndividual::where('farmer_id',$this->id)->first();
		
			$organization = \App\FarmerOrganization::where('farmer_id',$this->id)->first();
		
		
		if ($individual) 
			return 'Individual';
		elseif($organization)
			return 'Organization';
		else
			return 'N/A';
	}

    public function getSinceAttribute($value)
    {
        return \Carbon\Carbon::parse($this->created_at)->format('F jS, Y');
    }
}
