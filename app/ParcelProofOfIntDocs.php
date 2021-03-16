<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ParcelProofOfIntDocs extends Model
{
	use SoftDeletes;
    protected $table = 'parcel_proof_of_int_docs';
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    public function getDocumentAttribute($value)
    {
        //if (file_exists(public_path().'/storage/proofdocs/'.$this->attributes['document'])){
        	return asset('/storage/proofdocs').'/'.$this->attributes['document'];
        //}else
        	return Null;
    }

    public function documentDelete()
    {
        $this->delete();
    }
}
