<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParcelProofOfInterest extends Model
{
    use SoftDeletes;
    protected $table = 'parcel_proof_of_interest';
    public $timestamps = false;
	protected $dates = ['deleted_at'];
	public function proof_code(){
		return $this->hasOne('App\ProofOfInterestCode', 'id' , 'proof_of_int_id');
	}

    public function documents()
    {
        return $this->hasMany('App\ParcelProofOfIntDocs', 'parcel_proof_of_int_id', 'id');
    }
}
