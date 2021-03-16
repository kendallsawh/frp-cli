<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Organization extends Model
{

    public function getNameAttribute($value)
    {
        return ucwords($this->organization_name);
    }

	public function getLogoAttribute($value)
	{
    	// **** change back - remove '!' ****
        //if (file_exists(public_path().'/storage/logos/'.$this->attributes['logo'])){
			return asset('/storage/logos').'/'.$this->attributes['logo'];
        //}else
			return asset('/img/blank-img.png');
	}

    public function getSinceAttribute($value)
    {
        return Carbon::parse($this->created_at)->format('F jS, Y');
    }

	public function getCountyAttribute($value)
	{
		$add = \App\Districts::find($this->address->district_id);
		return $add->ward->county->county;
	}

	public function getCountyIdAttribute($value)
	{
		$add = \App\Districts::find($this->address->district_id);
		return $add->ward->county->id;
	}

	public function createdBy(){
		return $this->hasOne('App\User', 'id' , 'created_by')->withTrashed();
	}

    public function getRepsAttribute()
    {
    	return \App\Representative::whereIn('id',
    		\App\OrganizationRep::where('org_id', $this->id)->pluck('rep_id')
    	)->get();
    }
	
	public function applications(){
		return \App\Application::whereIn('id',
			DB::table('application_organization')
			->where('org_id',$this->id)
			->pluck('app_id')
			)->get();
	}

	public function enterprises(){
		return  DB::table('enterprises')
		->join('application_enterprise','application_enterprise.enterprise_id','=','enterprises.id')
		->join('applications','applications.id','=','application_enterprise.application_id')
		->join('application_organization','application_organization.app_id','=','applications.id')
		->where('application_organization.org_id',$this->id)
		->get();
	}
	
	public function parcelsCount()
	{
		return count($this->parcels());
	}

	public function enterpriseCount()
	{
		return count($this->enterprises());
	}

	public function parcels(){
		return \App\Parcel::whereIn('id',
			DB::table('parcels')
			->join('applications','applications.id','=','parcels.application_id')
			->join('application_organization','application_organization.app_id','=','applications.id')
			->where('application_organization.org_id',$this->id)
			->pluck('parcels.id')
			)->get();
	}

	public function getAddressAttribute(){
		return \App\Address::find($this->address_id);
	}

	//Create table for organization_contact
	public function getContactAttribute($value)
	{
		return \App\Contact::find($this->contact_id);
	}

    public function farmer()
    {
        $farmer = \App\FarmerOrganization::where('org_id',$this->id)->first();
		if ($farmer) 
			return \App\Farmer::find($farmer->farmer_id);
		else
			return 0;
    }

    public function getProviderAttribute()
    {
        $provider = \App\ServiceProviderOrganization::where('org_id',$this->id)->first();

        if ($provider) 
			return \App\ServiceProvider::find($provider->provider_id);
		else
			return;
    }

    public function getTractorsAttribute()
    {
        return \App\ServiceProvider::whereIn('id',
        		\App\ServiceProviderOrganization::where('org_id',$this->id)->pluck('provider_id')
        	)->get();
    }

}
