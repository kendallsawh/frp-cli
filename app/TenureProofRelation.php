<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenureProofRelation extends Model
{
    protected $table = 'tenure_proof_relation';
    public $timestamps = false;

    public function getApplicationAttribute(){
		return \App\ApplicationType::where('id', $this->app_id)->first();
	}
	
	public function getLandAttribute(){
		return \App\LandType::where('id', $this->land_id)->first();
	}
	
	public function getTenureAttribute(){
		return \App\TenureCode::where('id', $this->tenure_id)->first();
	}
	public function getProofAttribute(){
		return \App\ProofOfInterestCode::where('id', $this->proof_id)->first();
	}
	
}
