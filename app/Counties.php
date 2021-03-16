<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Counties extends Model
{
    use SoftDeletes,Notifiable; 
    protected $table = 'counties';
    public $timestamps = false;
    
	public function scopeOrdered($query){
		return $query->orderBy('county', 'asc')->get();
	}

	public function region(){
		return $this->hasOne('App\Region', 'id' , 'region_id');
	}

	public function wards(){
		return $this->hasMany('App\Wards' , 'county_id', 'id');
	}

     public function getTotalindAttribute(){
          return DB::table('individuals')
            ->join('individual_address','individuals.id', '=','individual_address.ind_id')
            ->join('addresses','individual_address.add_id', '=', 'addresses.id')
            ->join('districts','addresses.district_id','=','districts.id')
            ->join('wards','districts.ward_id', '=', 'wards.id')
            ->join('counties','wards.county_id', '=' ,'counties.id')
            ->where('counties.id', $this->id)
            ->get()
            ->count();
     }

     public function getWebRegisterAttribute(){
       
           return DB::table('individuals')
            ->join('individual_address','individuals.id', '=','individual_address.ind_id')
            ->join('addresses','individual_address.add_id', '=', 'addresses.id')
            ->join('districts','addresses.district_id','=','districts.id')
            ->join('wards','districts.ward_id', '=', 'wards.id')
            ->join('counties','wards.county_id', '=' ,'counties.id')
            ->where('counties.id', $this->id)
                    ->where('individuals.created_online', 1)
                    ->get()
                    ->count();
    }

	public function getPendingAppAttribute(){
		/*return DB::table('applications')
                    ->join('application_individual','application_individual.app_id','=','applications.id')
                    ->join('individuals','individuals.id','=','application_individual.ind_id')
                    ->join('individual_address','individual_address.ind_id','=','individuals.id')
                    ->join('addresses','addresses.id','=','individual_address.add_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->join('counties','counties.id','=','wards.county_id')
                    ->where('counties.county', $this->county)
                    ->whereNotIn('applications.status_id', [6,7])
                    ->get()
                    ->count();*/
           return DB::table('applications')
                    ->where('applications.registering_county', $this->id)
                    ->whereNotIn('applications.status_id', [6,7])
                    ->get()
                    ->count();
	}

	public function getApprovedAppAttribute(){
		/*return DB::table('applications')
                    ->join('application_individual','application_individual.app_id','=','applications.id')
                    ->join('individuals','individuals.id','=','application_individual.ind_id')
                    ->join('individual_address','individual_address.ind_id','=','individuals.id')
                    ->join('addresses','addresses.id','=','individual_address.add_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->join('counties','counties.id','=','wards.county_id')
                    ->where('counties.county', $this->county)
                    ->where('applications.status_id', 6)
                    ->get()
                    ->count(); */
                    return DB::table('applications')
                    ->where('applications.registering_county', $this->id)
                    ->where('applications.status_id', 6)
                    ->get()
                    ->count();
	}

	public function getFlaggedAppAttribute(){
		/*return DB::table('applications')
                    ->join('application_individual','application_individual.app_id','=','applications.id')
                    ->join('individuals','individuals.id','=','application_individual.ind_id')
                    ->join('individual_address','individual_address.ind_id','=','individuals.id')
                    ->join('addresses','addresses.id','=','individual_address.add_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->join('counties','counties.id','=','wards.county_id')
                    ->where('counties.county', $this->county)
                    ->where('applications.status_id', 7)
                    ->get()
                    ->count(); */
           return DB::table('applications')
                    ->where('applications.registering_county', $this->id)
                    ->where('applications.status_id', 7)
                    ->get()
                    ->count();
	}

    

	public function getOutAppAttribute(){
		return 0;
	}
}
