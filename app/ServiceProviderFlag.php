<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderFlag extends Model
{
    public function createdBy($createdby){
        return \App\User::where('id', '=' , $createdby)->first();
    }
}
