<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OldFarmerId extends Model
{
	use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    public function getNationalIDAttribute($value)
    {
			return $this->NationalIDCardNumber;
    }

    public function getPassportAttribute($value)
    {
			return $this->PassportNumber;
    }

    public function getDriversPermitAttribute($value)
    {
			return $this->DriversPermitNumber;
    }

    public function individualid()
    {
        $id = \App\IndividualID::where('id_num',$this->NationalIDCardNumber)
        ->orWhere('id_num',$this->PassportNumber)
        ->orWhere('id_num',$this->DriversPermitNumber)
        ->first();

        if($id)
			return $id;
		else
			return NULL;
		
    }
}
