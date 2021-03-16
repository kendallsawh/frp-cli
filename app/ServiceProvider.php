<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use \App\ServiceProviderComment;
use \App\ServiceProviderFlag;
use \App\ServiceProviderUser;

class ServiceProvider extends Model
{

    public function getProviderAttribute()
    {
        $individual = \App\ServiceProviderIndividual::where('provider_id',$this->id)->first();
        $organization = \App\ServiceProviderOrganization::where('provider_id',$this->id)->first();
        if ($individual) 
            return \App\Individual::find($individual->ind_id);
        else if($organization)
            return \App\Organization::find($organization->org_id);
        else
            return;
    }

    public function getTypeAttribute()
    {
        $individual = \App\ServiceProviderIndividual::where('provider_id',$this->id)->first();
        $organization = \App\ServiceProviderOrganization::where('provider_id',$this->id)->first();
        if ($individual) 
            return 'Individual';
        else if($organization)
            return 'Organization';
        else
            return;
    }

    public function getNameAttribute()
    {
        if ($this->provider) 
            return $this->provider->name;
        else
            return;
    }

    public function getSinceAttribute()
    {
        return Carbon::parse($this->created_at)->format('F jS, Y');
    }
    
    public function createdBy(){
        return $this->hasOne('App\User', 'id' , 'created_by')->withTrashed();
    }


    
    public function status(){
        return $this->hasOne('App\Status', 'id' , 'status_id');
    }
    
    public function scopeDistinctlist($query){
        $providers = $query->get();
        $list = [];$chk = [];
        foreach ($providers as $provider) {
            if (!in_array($provider->provider, $chk)) {
                $chk[] = $provider->provider;
                $list[] = $provider;
            }
        }
        return $list;
    }

    public function getCertAttribute($value)
    {
        // **** change back - remove '//' ****
        //if (file_exists(public_path().'/storage/avatars/'.$this->attributes['avatar'])){
            return asset('/storage/cert_copy').'/'.$this->attributes['certified_copy'];
        //}else
            return;
    }
    
    public function recommendations(){
        return \App\Recommendation::where('provider_id', $this->id)->get();
    }

    public function serv_prov_userid(){
        $userid = ServiceProviderUser::where('service_provider_id', $this->id)->where('user_id',\Auth::user()->id)->first();
        if($userid){
            return \App\User::find($userid->user_id);
        }
        else{return null;}
    }

    public function serv_prov_comments(){
        return  \App\ServiceProviderComment::whereIn('id',
            DB::table('service_provider_comments')
        ->where('service_provider_id',$this->id)
        ->whereIn('service_provider_comments.user_role',[1,4])
        ->pluck('service_provider_comments.id')
        )->get();

       
    }

    public function serv_prov_aa3comments(){
        return  \App\ServiceProviderComment::whereIn('id',
            DB::table('service_provider_comments')
        ->where('service_provider_id',$this->id)
        ->where('service_provider_comments.user_role',5)
        ->pluck('service_provider_comments.id')
        )->get();

     
    }

    public function serv_prov_ao1comments(){
        return  \App\ServiceProviderComment::whereIn('id',
            DB::table('service_provider_comments')
        ->where('service_provider_id',$this->id)
        ->where('service_provider_comments.user_role',6)
        ->pluck('service_provider_comments.id')
        )->get();

     
    }

    public function dnqdetails(){
        return  \App\ServiceProviderFlag::whereIn('id',
            DB::table('service_provider_flags')
        ->where('service_provider_id',$this->id)
        ->pluck('service_provider_flags.id')
        )->get();

    }
}
