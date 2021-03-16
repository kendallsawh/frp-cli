<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationType extends Model
{
    //
	
    protected $table = 'registration_types';
    
	public function scopeOrdered($query){
		return $query->orderBy('id', 'asc')->get();
	}
}
