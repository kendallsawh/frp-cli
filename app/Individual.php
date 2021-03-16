<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contact;
use App\IndividualID;
use App\FarmerIndividual;
use App\Farmer;
use Carbon\Carbon;
use DB;

class Individual extends Model
{

    public function getNameAttribute($value)
    {
        if ($this->attributes['m_name']) 
	        return ucwords($this->attributes['f_name'].' '.$this->attributes['m_name'].' '.$this->attributes['l_name']);
	    else
	    	return ucwords($this->attributes['f_name'].' '.$this->attributes['l_name']);
    }

    public function getAvatarAttribute($value)
    {
    	// **** change back - remove '//' ****
        //if (file_exists(public_path().'/storage/avatars/'.$this->attributes['avatar'])){
        	return asset('/storage/avatars').'/'.$this->attributes['avatar'];
        //}else
        	return asset('/img/default-avatar.png');
    }


    public function getAgeAttribute($value)
    {
        return Carbon::parse($this->dob)->age;
    }

    public function getCountyAttribute($value)
    {
        $add = \App\Districts::find($this->home()->district_id);
        return $add->ward->county->county;
    }
     public function getDistrictAttribute($value)
    {
        $add = \App\Districts::find($this->home()->district_id);
        return $add->district;
    }

	public function getAddressAttribute(){
		return $this->home();
	}

    public function getSinceAttribute($value)
    {
        return Carbon::parse($this->created_at)->format('F jS, Y');
    }
	
	public function gender(){
		return $this->hasOne('App\Gender', 'slug' , 'gender_slug');
	}
	
	public function createdBy(){
		return $this->hasOne('App\User', 'id' , 'created_by')->withTrashed();
	}
	
	public function applications(){
		return \App\Application::whereIn('id',
				DB::table('application_individual')
					->where('ind_id',$this->id)
					->pluck('app_id')
			)->get();
	}

	public function getOldRegistrationAttribute(){
		return \App\Application::whereIn('id',
				DB::table('application_individual')
					->where('ind_id',$this->id)
					->pluck('app_id')
			)
		->whereNotNull('old_registration_num')
		->get();
	}
	
	public function enterprises(){
		return DB::table('enterprises')
					->join('application_enterprise','application_enterprise.enterprise_id','=','enterprises.id')
					->join('applications','applications.id','=','application_enterprise.application_id')
					->join('application_individual','application_individual.app_id','=','applications.id')
					->where('application_individual.ind_id',$this->id)
					->get();
	}
	
	public function parcels(){
		return \App\Parcel::whereIn('id',
				DB::table('parcels')
					->join('applications','applications.id','=','parcels.application_id')
					->join('application_individual','application_individual.app_id','=','applications.id')
					->where('application_individual.ind_id',$this->id)
					->pluck('parcels.id')
			)->get();
	}


	public function land_verify(){
		return DB::table('parcels')
					->join('applications','applications.id','=','parcels.application_id')
					->join('application_individual','application_individual.app_id','=','applications.id')
					->join('land_types', 'parcels.land_type_id', '=', 'land_types.id')
					->join('parcel_verification', 'parcel_verification.parcel_id', '=', 'parcels.id')
					->where('application_individual.ind_id',$this->id)
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
	
	public function home(){
		return \App\Address::whereIn('id', DB::table('addresses')
					->join('individual_address','individual_address.add_id','=','addresses.id')
					->join('individuals','individuals.id','=','individual_address.ind_id')
					->join('address_lot_types','address_lot_types.id','=','addresses.lot_type_id')
					->join('districts','districts.id','=','addresses.district_id')
					->where('individuals.id',$this->id)
					->whereIn('individual_address.ind_add_type_id',[1,3])
					->pluck('addresses.id')
				)->first();
	}
	
	public function postal(){
		return \App\Address::whereIn('id', DB::table('addresses')
					->join('individual_address','individual_address.add_id','=','addresses.id')
					->join('individuals','individuals.id','=','individual_address.ind_id')
					->join('address_lot_types','address_lot_types.id','=','addresses.lot_type_id')
					->join('districts','districts.id','=','addresses.district_id')
					->where('individuals.id',$this->id)
					->whereIn('individual_address.ind_add_type_id',[2])
					->pluck('addresses.id')
				)->first();
	}

	public function ind_add_type_id(){
		return $this->hasOne('App\IndividualAddress', 'ind_id' , 'id');
	}

    public function getHomeContactAttribute($value)
    {
        $num = DB::table('contacts')
					->join('individual_contact','individual_contact.contact_id','=','contacts.id')
					->where('individual_contact.individual_id',$this->id)
					->whereIn('contacts.contact_type_id',[1])
					->first();
		if ($num) 
			return $num->contact;
		else
			return 0;
    }

    public function getMobileContactAttribute($value)
    {
        $num = DB::table('contacts')
					->join('individual_contact','individual_contact.contact_id','=','contacts.id')
					->where('individual_contact.individual_id',$this->id)
					->whereIn('contacts.contact_type_id',[2])
					->first();
		if ($num) 
			return $num->contact;
		else
			return 0;
    }

    public function getEmergencyContactAttribute($value)
    {
        $num = DB::table('contacts')
					->join('individual_contact','individual_contact.contact_id','=','contacts.id')
					->where('individual_contact.individual_id',$this->id)
					->whereIn('contacts.contact_type_id',[4])
					->first();
		if ($num) 
			return $num->contact;
		else
			return 0;
    }

    public function getNationalIDAttribute($value)
    {
        $id = IndividualID::where('individual_id',$this->id)->where('id_type_id',1)->first();

        if ($id) 
			return $id->id_num;
		else
			return 0;
    }

    public function getNationalIDDocAttribute($value)
    {
        $id = IndividualID::where('individual_id',$this->id)->where('id_type_id',1)->first();

        if ($id) 
			return $id->documents;
		else
			return '#';
    }


    public function getDriverIDAttribute($value)
    {
        $id = IndividualID::where('individual_id',$this->id)->where('id_type_id',2)->first();

        if ($id) 
			return $id->id_num;
		else
			return 0;
    }

    public function getPassportIDAttribute($value)
    {
        $id = IndividualID::where('individual_id',$this->id)->where('id_type_id',3)->first();

        if ($id) 
			return $id->id_num;
		else
			return 0;
    }
    public function getPassportIDDocAttribute($value)
    {
        $id = IndividualID::where('individual_id',$this->id)->where('id_type_id',3)->first();

        if ($id) 
			return $id->documents;
		else
			return '#';
    }

    public function farmer()
    {
        $farmer = FarmerIndividual::where('ind_id',$this->id)->first();
		if ($farmer) 
			return Farmer::find($farmer->farmer_id);
		else
			return 0;
    }

    public function getProviderAttribute()
    {
        $provider = \App\ServiceProviderIndividual::where('ind_id',$this->id)->first();

        if ($provider) 
			return \App\ServiceProvider::find($provider->provider_id);
		else
			return;
    }

    public function getTractorsAttribute()
    {
        return \App\ServiceProvider::whereIn('id',
        		\App\ServiceProviderIndividual::where('ind_id',$this->id)->pluck('provider_id')
        	)->get();
    }
}
