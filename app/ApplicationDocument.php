<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationDocument extends Model
{
	use SoftDeletes;
    protected $table = 'application_documents';
    protected $dates = ['deleted_at'];

    public function getDocumentAttribute($value)
    {
        //if (file_exists(public_path().'/storage/proofdocs/'.$this->attributes['document'])){
        	return asset('/storage/applicationforms').'/'.$this->attributes['document'];
        //}else
        	return Null;
    }

    public function getApplicationDocumentRoleAttribute(){
        $appdoc = \App\ApplicationDocumentRoles::where('app_doc_id', $this->id)->first();
        if($appdoc){
            return $appdoc;
        }
        else{return null;}
    }

    public function checkifao1(){
        $appdoc = \App\ApplicationDocumentRoles::where('app_doc_id', $this->id)->where('user_role',6)->first();
        if($appdoc){
            return True;
        }
        else{return False;}
    }
}
