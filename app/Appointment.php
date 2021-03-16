<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Individual;
class Appointment extends Model
{
    use SoftDeletes;
    public function getIndividualAttribute($value)
    {
    	$individual = Individual::where('id',$this->individual_id)->first();
		 
			return $individual;
		
    }
}
