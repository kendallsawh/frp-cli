<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\CompositeKeyModelHelper;

class ApplicationEnterprise extends Model
{
	use CompositeKeyModelHelper;
	public $incrementing = false;
    protected $table = 'application_enterprise';
    protected $primaryKey = ['enterprise_id', 'application_id'];
    public $timestamps = false;
    
	
}
