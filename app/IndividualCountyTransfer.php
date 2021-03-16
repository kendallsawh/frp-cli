<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FarmerIndividual;
use App\Farmer;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndividualCountyTransfer extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
