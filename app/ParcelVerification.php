<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class ParcelVerification extends Model
{
     protected $table = 'parcel_verification';

     public function gis_link(){
		return \App\GisParcel::whereIn('id',
				DB::table('gis_parcels')
					->join('parcel_verification','gis_parcels.parcel_verification_id','=','parcel_verification.id')
					->where('parcel_verification.id',$this->id)
					->pluck('gis_parcels.id')
			)->first();
	}
    
}
