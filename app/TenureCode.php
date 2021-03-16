<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenureCode extends Model
{
	
	public function scopeOrdered($query){
		return $query->orderBy('tenure_code', 'asc')->get();
	}
}
