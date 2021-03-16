<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
class Parcel extends Model
{
	use SoftDeletes;
	
    public $timestamps = false;
    protected $dates = ['deleted_at'];
	public function application(){
		return \App\Application::where('id', $this->application_id)->first();
	}

	public function eagerapp(){
		return $this->belongsTo('App\Application', 'id' , 'application_id');
	}
	public function land(){
		return $this->hasOne('App\Land', 'id' , 'land_id');
	}
	
	public function land_type(){
		return $this->hasOne('App\LandType', 'id' , 'land_type_id');
	}
	
	public function tenure(){
		return $this->hasOne('App\TenureCode', 'id' , 'tenure_code_id');
	}
	
	public function proofs(){
		return $this->hasMany('App\ParcelProofOfInterest', 'parcel_id', 'id');
	}

	/*public function documents(){
		return $this->hasManyTrough('App\ParcelProofOfIntDocs', 'App\ParcelProofOfInterest');
	}*/

	public function getDocumentCountAttribute($value)
	{
		return count($this->proofs());
	}

    public function getCountyAttribute($value)
    {
        $add = \App\Districts::find($this->land->address->district_id);
        return $add->ward->county->county;
    }
    public function getCountyIdAttribute($value)
    {
        $add = \App\Districts::find($this->land->address->district_id);
        return $add->ward->county->id;
    }

    public function getAreaAttribute($value)
    {
        return number_format($this->land->area_amt,2).' '.$this->land->area_type->area_type;
    }
	
	public function produce(){
		return \App\ParcelTypeOfProduce::whereIn('id',
				DB::table('parcels')
					->join('parcel_types_of_produce','parcel_types_of_produce.parcel_id','=','parcels.id')
					->where('parcels.id',$this->id)
					->pluck('parcel_types_of_produce.id')
			)->get();
	}

	public function eagarproduce(){
		return $this->hasMany('App\ParcelTypeOfProduce','parcel_id','id');
	}

	public function eagarcomments(){
		return $this->hasMany('App\ApplicationUserComment','parcel_id','id');
	}

    public function getCaroniStateAttribute($value)
    {
        /*if(strpos($this->land_type->land_type, "Caroni") !== false || strpos($this->land_type->land_type, "State") !== false )
        	return 'true';
        else
        	return ;*/

        	if(strpos($this->land_type->land_type, "State") !== false || $this->proofs()->where('proof_of_int_id',34)->first() !== null)
        	return 'true';
        else
        	return ;
    }

    public function getProduceCountAttribute($value)
    {
        return count($this->produce());
    }

    public function parcel_verification(){
		return \App\ParcelVerification::whereIn('id',
				DB::table('parcel_verification')
					->join('parcels','parcel_verification.parcel_id','=','parcels.id')
					->where('parcels.id',$this->id)
					->pluck('parcel_verification.id')
			)->first();
	}
}

