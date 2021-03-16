<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\ApplicationDnq;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
	
	public function applicant(){
		$individual = \App\ApplicationIndividual::where('app_id',$this->id)->first();
		$organization = \App\ApplicationOrganization::where('app_id',$this->id)->first();
		if ($individual) 
			return \App\Individual::find($individual->ind_id);
		elseif($organization)
			return \App\Organization::find($organization->org_id);
		else
			return 0;
	}

	public function getApplicantTypeAttribute(){
		$individual = \App\ApplicationIndividual::where('app_id',$this->id)->first();
		$organization = \App\ApplicationOrganization::where('app_id',$this->id)->first();
		if ($individual) 
			return 'Individual';
		elseif($organization)
			return 'Organization';
	}
	
	public function enterprises(){
		return DB::table('enterprises')
					->join('application_enterprise','application_enterprise.enterprise_id','=','enterprises.id')
					->join('applications','applications.id','=','application_enterprise.application_id')
					->where('applications.id',$this->id)
					->get();
	}

	public function getEnterpriseOtherAttribute(){
		return \App\EnterpriseOther::where('application_id', $this->id)->first();
	}

	public function getApplicationDocumentAttribute(){
		$appdoc = \App\ApplicationDocument::where('app_id', $this->id)->first();
		if($appdoc){
			return $appdoc;
		}
		else{return NULL;}
	}

	public function getParcelUprnAttribute(){
		$appuprn = \App\ParcelUprn::where('app_id', $this->id)->first();
		if($appuprn){
			return $appuprn;
		}
		else{return null;}
	}

	public function documents()
    {
        return $this->hasOne('App\ApplicationDocument', 'app_id', 'id');
    }

	public function appuserid(){
		$userid = \App\ApplicationUser::where('app_id', $this->id)->where('user_id',\Auth::user()->id)->first();
		if($userid){
			return \App\User::find($userid->user_id);
		}
		else{return null;}
	}

	public function appdfoassign(){
		$userid = \App\ApplicationUser::where('app_id', $this->id)->where('user_role',4)->first();
		if($userid){
			return '';
		}
		else{return 'This application is not assigned to a Field Officer! Please request that your AA3 or AO1 assign this application to an officer.';}
	}

	public function dfoname(){
		$userid = \App\ApplicationUser::where('app_id', $this->id)->where('user_role',4)->first();
		if($userid){
			return \App\User::where('id', $userid->user_id)->first()->name;
		}
		else{return 'None';}
	}

	public function aa3name(){
		$userid = \App\ApplicationUser::where('app_id', $this->id)->where('user_role',5)->first();
		if($userid){
			return \App\User::where('id', $userid->user_id)->first()->name;
		}
		else{return 'None';}
	}

	public function parcels()
	{
		return \App\Parcel::where('application_id', $this->id)->get();
	}

	public function eagerparcels()
	{
		return $this->hasMany('App\Parcel', 'application_id','id');
	}
	public function eagercomments()
	{
		return $this->hasManyThrough('App\ApplicationUserComment', 'App\Parcel');
	}

	public function oneparcel($appid)
	{
		return \App\Parcel::where('application_id', $appid)->first();
	}

	public function oneparcel_parcelid($parcelid)
	{
		return \App\Parcel::where('id', '=', $parcelid)->first();
	}

	public function parceldocumentcount(){
		return DB::table('parcel_proof_of_interest')
					->join('parcels','parcels.id','=','parcel_proof_of_interest.parcel_id')
					->join('applications','applications.id','=','parcels.application_id')
					->where('applications.id',$this->id)
					->count();
			
	}

	public function missingdocument(){
		$exists = 1;
		$parcels = $this->parcels();
		foreach ($parcels as $parcel) {// loop each parcel for the application
            $proooofs = $parcel->proofs->all();
            foreach ($proooofs as $proof) {//loop each proof of each parcel
                $ffff = $proof->documents;// get the document for each proof
                if (!$ffff->isEmpty())//check to see that the proof document exist/has a record
                {
                    $docs = $proof->documents->first()->id;//get the first record
                    if(empty($docs))//if empty return 0
                    {
                        $exists = 0;
                    }
                }
               
                
                
            }
        }
        return $exists; 
	}
	
	public function type(){
		return $this->hasOne('App\ApplicationType', 'id' , 'app_type_id');
	}
	
	public function registration(){
		return $this->hasOne('App\RegistrationType', 'id' , 'registration_id');
	}
	
	public function status(){
		return $this->hasOne('App\Status', 'id' , 'status_id');
	}
	
	public function createdBy(){
		return $this->hasOne('App\User', 'id' , 'created_by')->withTrashed();
	}

	public function createdBy2($createdby){
		return \App\User::where('id', '=' , $createdby)->withTrashed()->first();
	}

    public function getCreatedOnAttribute($value)
    {
        return Carbon::parse($this->created_at)->format('F jS, Y');
    }
	
	public function getCreatedOnNumericAttribute($value)
    {
        return Carbon::parse($this->created_at)->format('d-m-Y, h:i a');
    }

	public function scopeOrdered($query){
		return $query->orderBy('id', 'desc')->get();
	}
	
	public function scopePending($query){

		return $query->whereNotIn('status_id',[6,7])
					->where('registering_county', \Auth::user()->countyid)
					->orderBy('id', 'desc')
					->paginate(9);
		
                    
	}

	public function scopeApproved($query){
		return $query->whereIn('status_id',[6])->orderBy('id', 'desc')->get();
	
	}

	public function scopeFlagged($query){
		return $query->whereIn('status_id',[7])->orderBy('id', 'desc')->get();
		
	}

	public function parcelcomments(){
		return 	\App\ApplicationUserComment::whereIn('id',
			DB::table('application_user_comments')
		->join('parcels','parcels.id','=','application_user_comments.parcel_id')
		->join('applications','applications.id','=','parcels.application_id')
		->where('applications.id',$this->id)
		->whereIn('application_user_comments.user_role',[1,4])
		->pluck('application_user_comments.id')
		)->get();

		/*->select('application_user_comments.parcel_id','application_user_comments.district_id','application_user_comments.comments','application_user_comments.date_of_verification','application_user_comments.user_id','application_user_comments.created_at')*/
	}

	public function parcelaa3comments(){
		return 	\App\ApplicationUserComment::whereIn('id',
			DB::table('application_user_comments')
		->join('parcels','parcels.id','=','application_user_comments.parcel_id')
		->join('applications','applications.id','=','parcels.application_id')
		->where('applications.id',$this->id)
		->where('application_user_comments.user_role',5)
		->pluck('application_user_comments.id')
		)->get();

		/*->select('application_user_comments.parcel_id','application_user_comments.district_id','application_user_comments.comments','application_user_comments.date_of_verification','application_user_comments.user_id','application_user_comments.created_at')*/
	}

	public function parcelao1comments(){
		return 	\App\ApplicationUserComment::whereIn('id',
			DB::table('application_user_comments')
		->join('parcels','parcels.id','=','application_user_comments.parcel_id')
		->join('applications','applications.id','=','parcels.application_id')
		->where('applications.id',$this->id)
		->where('application_user_comments.user_role',6)
		->pluck('application_user_comments.id')
		)->get();

		/*->select('application_user_comments.parcel_id','application_user_comments.district_id','application_user_comments.comments','application_user_comments.date_of_verification','application_user_comments.user_id','application_user_comments.created_at')*/
	}

	public function flagdetails(){
		return 	\App\ApplicationFlag::whereIn('id',
			DB::table('application_flags')
		->join('applications','applications.id','=','application_flags.app_id')
		->where('applications.id',$this->id)
		->pluck('application_flags.id')
		)->get();
	}
	public function dnqdetails(){
		return 	ApplicationDnq::whereIn('id',
			DB::table('application_dnqs')
		->join('applications','applications.id','=','application_dnqs.app_id')
		->where('applications.id',$this->id)
		->pluck('application_dnqs.id')
		)->get();

		/*->select('application_user_comments.parcel_id','application_user_comments.district_id','application_user_comments.comments','application_user_comments.date_of_verification','application_user_comments.user_id','application_user_comments.created_at')*/
	}

	public function userpending(){
		return 	Application::whereIn('id',
			DB::table('applications')
		->join('application_users','application_users.app_id','=','applications.id')
		->join('users','users.id','=','application_users.user_id')
		->where('users.id',Auth::user()->id)
		->whereNotIn('status_id',[6])
		->pluck('applications.id')
		)->get();

		/*->select('application_user_comments.parcel_id','application_user_comments.district_id','application_user_comments.comments','application_user_comments.date_of_verification','application_user_comments.user_id','application_user_comments.created_at')*/
	}

	public function producecount(){
	return DB::table('parcel_types_of_produce')
			->join('parcels','parcels.id','=','parcel_types_of_produce.parcel_id')
			->join('applications','applications.id','=','parcels.application_id')			
			->where('applications.id',$this->id)
			->pluck('parcel_types_of_produce.id')
			->count('parcel_types_of_produce.id');
	}


}
