<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandType extends Model
{
	
	public function scopeOrdered($query){
		return $query->orderBy('land_type', 'asc')->get();
	}
}
