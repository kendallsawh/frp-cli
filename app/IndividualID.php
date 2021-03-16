<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Response;

class IndividualID extends Model
{
    protected $table = 'individual_ids';
    protected $primaryKey = 'individual_id';
    public $timestamps = false;

     public function getDocumentsAttribute($value)
    {
        if ($this->attributes['documents'] != Null){
            /*if (Storage::disk('ftp_2')->exists('proofdocs/'.$this->attributes['documents'])) {
               return Storage::disk('ftp_2')->get('proofdocs/'.$this->attributes['documents']);
            }
            else
                return '#';*/
                //$filename = $this->attributes['documents'];
                //$filecontent = Storage::disk('ftp_2')->get('proofdocs/'.$this->attributes['documents']);

                //this line is the right code
                //return 'ftp://ksawh:1234@127.0.0.1/proofdocs/'.$this->attributes['documents'];
              
           /*return Response::make($filecontent, '200', array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="'.$this->attributes['documents'].'"'
            ));*/
            //return $this->attributes['documents'];
            /*return Response::make(file_get_contents('ftp://ksawh:1234@127.0.0.1/proofdocs/'.$this->attributes['documents']), 200, ['Content-Type'=> 'application/pdf','Content-Disposition' => 'inline; filename="'.$this->attributes['documents'].'"']);*/
        	return asset('/storage/proofdocs').'/'.$this->attributes['documents'];
        }else
        	return '#';
    }

    
    public function entity()
    {
        return $this->hasOne('App\Individual','id','individual_id');
    }
}
