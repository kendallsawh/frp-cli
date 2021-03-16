<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Districts;
use App\IndividualID;
use \App\Individual;

class FarmerExistReference extends Model
{
	use SoftDeletes;
	public $timestamps = false;
	protected $dates = ['deleted_at'];
    //
    //
    public function IndividualId()
    {
        //$ind = IndividualID::where('id_num','19440222017')->first()->individual_id;
        if (IndividualID::where('id_num',$this->individual_id)->count() > 0) {
        	$ind = IndividualID::where('id_num',$this->individual_id)->first()->individual_id;
   			return $ind;
			}
		else
			return 'false';
    }
}
