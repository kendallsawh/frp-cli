<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadgeColour extends Model
{
	
	public function scopeOrdered($query){
		return $query->orderBy('id', 'asc')->get();
	}
}
