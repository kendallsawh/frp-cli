<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';
    public $timestamps = false;
    
	public function scopeOrdered($query){
		return $query->orderBy('region', 'asc')->get();
	}

	public function counties(){
		return $this->hasMany('App\Counties' , 'region_id', 'id');
	}
}
