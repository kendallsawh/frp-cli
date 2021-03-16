<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderComment extends Model
{
    //
    public function createdBy($createdby){
        return \App\User::where('id', '=' , $createdby)->first();
    }
}
