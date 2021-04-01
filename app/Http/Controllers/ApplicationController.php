<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\ParcelType;
use Validator;
use Session;
use DB;
use File;
use App\TenureCode;
use App\Districts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;

class ApplicationController extends Controller
{


    public function __construct()
      {
        $this->middleware('auth');
      }
    
    /*
    |-----------------------------------------------------------------------------
    | View application based on applicaton id
    |-----------------------------------------------------------------------------
    |
    |
    */
        public function view($id=0){
          $chk = false;
          if (\Auth::user()->userapplication) {
            if (\Auth::user()->userapplication->application_id==$id) {
              $chk = true;
            }
            else $chk = false;
          }
          
          if ($chk) {
            $app = Application::find($id);
          if(!$app) return back()->with('flashed', 'That Application does not exist');
          $userRoleid = \Auth::user()->role_id;
          $collection = null;
          if($app->applicant()->parcels()->first()){
          $collection = $app->applicant()->parcels()->first()->proofs->pluck('proof_of_int_id');
          }
          
           
          //-----------------------------set if out of county----------------------------------//
            $isthere = False;
            $isverified = False;
            $getparcels = $app->parcels();
            
            foreach ($getparcels as $getparcel) {
                
                    //if out of county and status id is 3(dfo verified)
                    if ($getparcel->CountyId !== $app->registering_county)
                    {
                        
                        $isthere = True;//out of county
                        $getparcel->status_id >=3 ? $isverified = True : $isverified = False ;
                    }
                    
                    
                    
                
            } 
          $outofcounty = $isthere? 'True':'False';
          $data = array(
                'nav' => ['nav-appl','nav-appl-1'],
                'navApplIn' => 'in',
                'title' => $app->applicant()->name,
                'data' => $app,
                'parcel_types' => ParcelType::all(),
                'districts' => Districts::ordered(),
                'tenures' => TenureCode::ordered(),
                'outofcounty' => $outofcounty,
          );           
          return view('application.view', $data);
          }
          else{
            return redirect('/');
          }
          //return \Auth::user()->userapplication->application_id;
          

        }
    /*
    |-----------------------------------------------------------------------------
    | View application based on applicaton id after registration
    |-----------------------------------------------------------------------------
    |
    |
    */
        public function viewOnce($id=0){
          $chk = false;
          if (\Auth::user()->userapplication->application_id==$id) {
            $chk = true;
          }
          
          
            $app = Application::find($id);
          if(!$app) return back()->with('flashed', 'That Application does not exist');
           
          //-----------------------------set if out of county----------------------------------//
            $isthere = False;
            $isverified = False;
            $getparcels = $app->parcels();
            
            foreach ($getparcels as $getparcel) {
                
                    //if out of county and status id is 3(dfo verified)
                    if ($getparcel->CountyId !== $app->registering_county)
                    {
                        
                        $isthere = True;//out of county
                        $getparcel->status_id >=3 ? $isverified = True : $isverified = False ;
                    }
                    
                    
                    
                
            } 
          $outofcounty = $isthere? 'True':'False';
          $data = array(
                'nav' => ['nav-appl','nav-appl-1'],
                'navApplIn' => 'in',
                'title' => $app->applicant()->name,
                'data' => $app,
                'parcel_types' => ParcelType::all(),
                'districts' => Districts::ordered(),
                'tenures' => TenureCode::ordered(),
                'outofcounty' => $outofcounty,
          );           
          return view('application.view', $data);
          
          

        }

    /*
    |-----------------------------------------------------------------------------
    | Generate a temporary random
    |-----------------------------------------------------------------------------
    |
    | temp id is 62 characters long and contains a combination of alphanumeric symbols
    | where a character is randomly selected and can be replaced resulting in 760401738905937245009910944207609328 possible options
    */
    function generateRandomString($length = 40) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }





   
}
