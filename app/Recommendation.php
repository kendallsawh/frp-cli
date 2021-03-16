<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Districts;

class Recommendation extends Model
{
	
	/*public function farmer(){
		return \App\Farmer::find($this->farmer_id);
	}*/

    public function rec_name(){
        return ($this->attributes['f_name'].' '.$this->attributes['l_name']);
    }
	
	public function provider(){
		return \App\ServiceProvider::find($this->provider_id);
	}

    public function address(){

        return $this->attributes['address'].', '.Districts::find($this->district_id)->district;
    }

	
	/*public function land(){
		return \App\Land::find($this->land_id);
	}*/

    public function getSinceAttribute($value)
    {
        return \Carbon\Carbon::parse($this->created_at)->format('F jS, Y');
    }

    public function getDateAttribute($value)
    {
        return \Carbon\Carbon::parse($this->attributes['date'])->format('F jS, Y');
    }

    public function getProofAttribute($value)
    {
        // **** change back - remove '//' ****
        //if (file_exists(public_path().'/storage/avatars/'.$this->attributes['avatar'])){
            return asset('/storage/proof_doc').'/'.$this->attributes['proof_doc'];
        //}else
            return;
    }
}
