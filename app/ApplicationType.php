<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationType extends Model
{
	
	public function scopeOrdered($query){
		return $query->orderBy('application_type', 'asc')->get();
	}
}
