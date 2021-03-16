<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceProvider;
use App\ServiceProviderComment;
use App\ServiceProviderIndividual;
use App\ServiceProviderOrganization;
use \App\ServiceProviderFlag;
use App\Individual;
use App\Organization;
use Validator;
use DB;

class ProviderController extends Controller
{
    public function listing()
    {
        $data = array(
            'nav' => ['nav-funct','nav-funct-7'],
            'navFunctIn' => 'in',
            'title' => 'Service Provider List',
            'providers' => ServiceProvider::distinctlist(),
        );
        
        return view('provider.list', $data);
    }
    
    public function view($id=0)
    {
    	$user = ServiceProvider::find($id);
        $sp_user_assinged = $user->serv_prov_userid()==null? 'False' : 'True';
        if(!$user) return back()->with('flashed', 'That Service Provider does not exist');
        $roleStat = $this->rolestatusRel(\Auth::user()->role_name, $user->status_id)? 'True' : 'False';
    	$data = array(
			'nav' => ['nav-funct', 'nav-funct-7'],
            'navFunctIn' => 'in',
			'title' => $user->name,
			'data' => $user,
            'rep_types' => \App\ReplacementType::all(),
            'flagTypes' => \App\FlagType::all(),
            'roleStatus' => $roleStat,
            'userAssingned' => $sp_user_assinged,
            
		);
		
        return view('provider.view', $data);
    }

      public function verification(Request $request)
    {
        $app = ServiceProvider::find($request->view_id);
        $next = \App\Status::where('id', '>', $request->app_status_id)->first();

        /*this would set to the previous id
        $next = \App\Status::where('id', '<', $request->app_status_id)->first();
        */
        //return ($request->user()->role_id.' '.$request->app_status_id);

        if ($request->user()->role_id == 1 && $request->app_status_id == 1){
            $this->updateApplicationVerification($app->id, $next->id);
           }
          
           elseif ($request->user()->role_id == 5 && $request->app_status_id == 3){
             $this->updateApplicationVerification($app->id, $next->id);
           }
           elseif ($request->user()->role_id == 6 && $request->app_status_id == 4){
             $this->updateApplicationVerification($app->id, $next->id);
             $directors = \App\User::whereIn('id',
                DB::table('region')
                ->join('counties','counties.region_id','=','region.id')
                ->join('wards','wards.county_id','=','counties.id')
                ->join('districts','districts.ward_id','=','wards.id')
                ->join('users','users.district_id','=','districts.id')
                ->where('region.id',\Auth::user()->region_id)
                ->where('users.role_id',7)
                ->pluck('users.id')
            )->get();

             //if directors exist
            if($directors){
                //for each person wit director role
                foreach ($directors as $director) {
                    //assign to them
                    $this->insertApplicationUser($app->id,$director->id,7,\Auth::user()->id); 
                }
            }
           }
           elseif ($request->user()->role_id == 7 && $request->app_status_id == 5){
             
             $this->addindfarmer($request->ind_id,$request->view_id);
           }
           else{return redirect('/provider/view/'.$app->id)->back()->with('flashed','Error.');}
       
        //Session::flash('success', 'Here is your success message');
       // $request->session()->flash('success', 'Here is your success message');
        //return redirect('/application/view/'.$app->id)->with('message','Error.');
        return redirect('/provider/view/'.$app->id)->with('success', ' Application has succesfully been moved to the next stage.');

    }

    public function addindfarmer($indid,$sp_id)
    {
        
        
        // check if farmer exists
        if (\App\ServiceProviderIndividual::where('ind_id',$indid)->exists() == True)
        {

          $ind = \App\Individual::find($indid);
          $ind_county = \App\Districts::find($ind->home()->district_id)->ward->county->id; 
          $application = \App\Application::find($sp_id);
          $this->updateApplicationVerification($sp_id, 6);

            $newfarmer = new Farmer;
            $newfarmer->registration_num = $this->generateRandomString();
           
            $newfarmer->save();
            $increment_for_id = $newfarmer->id;
                if(strlen($newfarmer->id)==1){
                    $increment_for_id = '00000'.$newfarmer->id;
                }
                elseif(strlen($newfarmer->id)==2){
                    $increment_for_id = '0000'.$newfarmer->id;
                }
                elseif(strlen($newfarmer->id)==3){
                        $increment_for_id = '000'.$newfarmer->id;
                }
                elseif(strlen($newfarmer->id)==4){
                        $increment_for_id = '00'.$newfarmer->id;
                }
                elseif(strlen($newfarmer->id)==5){
                        $increment_for_id = '0'.$newfarmer->id;
                }
            $newfarmer->registration_num = '3'.$ind_county.$increment_for_id;
            $newfarmer->save();

            $farmerbadge = new \App\FarmerBadge;            
            $farmerbadge->farmer_badge = $newfarmer->registration_num;           
            $farmerbadge->farmer_id = $newfarmer->id;
            $farmerbadge->colour_id = 1;            
            $farmerbadge->user_id = \Auth::user()->id;
            $farmerbadge->valid = 1;
            $farmerbadge->save();

            return redirect('/provider/view/'.$sp_id)->with('success', ' Added as Service Provider.');
        }
        else{
          return redirect('/provider/view/'.$sp_id)->with('flashed', ' Service Provider data not found for this applicant.');
        }

        
    }

    protected function insertApplicationUser($appId, $userId,$role,$creator)
    {
            $appuser = new ApplicationUser; 
            $appuser->app_id = $appId;
            $appuser->user_id = $userId;
            $appuser->user_role = $role;
            $appuser->created_by = $creator;
            $appuser->save();       
    }

     public function rolestatusRel($roleID,$statusID)
    {

        if ($roleID == 'Farmer Registration Clerk' && $statusID == 1){
           return true;
           }
           elseif ($roleID == 'District Field Officer' && $statusID == 2){
            return true;
           }
           elseif ($roleID == 'Agricultural Assistant III' && $statusID == 3){
            return true;
           }
           elseif ($roleID == 'Agricultural Officer I' && $statusID == 4){
            return true;
           }
           elseif ($roleID == 'RAN/RAS Director' && $statusID == 5){
            return true;
           }
           else{
            return false;
           };

    }
     protected function addDFOComments(Request $request)
    {

        //return ($request->parcel);
         $validator = Validator::make($request->all(), [
           
            'dateofverification' => 'required',
            'comments' => 'required',

         ]);
         if ($validator->fails()) {
            return redirect('/application/view/'.$request->view_id)
            ->withInput()
            ->withErrors($validator);
         }
         
            
         
        $dfocomment = new ServiceProviderComment;
        $dfocomment->service_provider_id = $request->view_id;
        $dfocomment->comments = html_entity_decode($request->comments, ENT_QUOTES, 'UTF-8'); 
        $dfocomment->date_of_verification = $request->dateofverification;
        $dfocomment->user_id = \Auth::user()->id;
        $dfocomment->user_role = \Auth::user()->role_id;
        $dfocomment->save();
         return redirect('/provider/view/'.$request->view_id)->with('success', ' Succesfully added comment.');
    }

    protected function addDFOVerify(Request $request)
    {

        return 'jjjjjjjjj';
         
        //return ($request->parcel);
         $validator = Validator::make($request->all(), [
           
            'dateofverification' => 'required',
            'comments' => 'required',

         ]);
         if ($validator->fails()) {
            return redirect('/provider/view/'.$request->view_id)
            ->withInput()
            ->withErrors($validator);
         }
        

        

        
        
          $app = Application::find($request->view_id);          
          $app->status_id = 3;
          $app->save();

          //enter the application-officer-verification information
          $aov = new \App\OfficerApplicationVerification;
          $aov->application_id = $app->id;
          $aov->verification_id = 3;
          $aov->user_id = \Auth::user()->id;
          $aov->save();
        

       

         return redirect('/provider/view/'.$request->view_id)->with('success', ' Succesfully added comment.');
    }

    public function flagApplication(Request $request)
    {
        

        $serviceprovider = ServiceProvider::find($request->view_id);
        $dnq = new ServiceProviderFlag;

        $validator = Validator::make($request->all(), [
            
            'details' => 'required',
            
        ]);

        if ($validator->fails())
        {
           return redirect('/provider/view/'.$serviceprovider->id)->withInput()
                    ->withErrors($validator)
                    ->with('flashed', 'Please correct errors.')
                    ->with('fail', 'failed'); 
        }

        
         // change status to denied and update when edited
        $serviceprovider->updated_at = \Carbon\Carbon::now()->toDateString();
        $serviceprovider->status_id = 7;
        $serviceprovider->save();

        //enter the applcation into dnq table
        
        $dnq->service_provider_id = $serviceprovider->id;
        $dnq->created_by = \Auth::user()->id;
        $dnq->flag_type = $request->flag_type;
        $dnq->details = $request->details;
        $dnq->save();        

        
         //return view('application.view', compact($data));
         return redirect('/provider/view/'.$serviceprovider->id)->with('warning', 'Application has been flagged. ');
    }

    protected function updateApplicationVerification($appId, $statId)
    {
         
        $serviceprovider = ServiceProvider::find($appId); // change status to next statud and update when edited
        $serviceprovider->updated_at = \Carbon\Carbon::now()->toDateString();
        $serviceprovider->status_id = $statId;
        $serviceprovider->save();

        //enter the application-officer-verification information
        $aov = new \App\OfficerApplicationVerification;
        $aov->application_id = $appId;
        $aov->verification_id = $statId;
        $aov->user_id = \Auth::user()->id;
        $aov->save();
    }


}
