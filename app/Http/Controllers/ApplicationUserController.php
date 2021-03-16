<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use \App\ApplicationUser;
use \App\Application;
use \App\ServiceProvider;
use \App\ServiceProviderUser;
use \App\User;
use DB;


class ApplicationUserController extends Controller
{
    public function listing()
    {
    	$app = Application::whereIn('id',
            DB::table('applications')
        ->join('application_users','application_users.app_id','=','applications.id')
        ->join('users','users.id','=','application_users.user_id')
        ->where('users.id',\Auth::user()->id)
        ->whereNotIn('status_id',[6])
        ->pluck('applications.id')
        )->orderBy('status_id', 'asc')->paginate(10);

        $servprovider = ServiceProvider::whereIn('id',DB::table('service_providers')
            ->join('service_provider_users','service_provider_users.service_provider_id','=','service_providers.id')
            ->join('users','users.id','=','service_provider_users.user_id')
            ->where('users.id',\Auth::user()->id)
            ->whereNotIn('service_providers.status_id',[6])
            ->pluck('service_providers.id')
        )->orderBy('status_id', 'asc')->paginate(10);
        //return $servprovider;
    	//$app_yours = $app->userpending();
        $data = array(
            'nav' => ['nav-appl','nav-appl-3'],
            'navApplIn' => 'in',
            'title' => 'Your Pending Farmer List',
            'applications' =>$app,
            'serviceProvidersList'=> $servprovider,
            'director' => \Auth::user()->role_id == 7? 1 : 0,
            'ao1' => \Auth::user()->role_id == 6? 1 : 0,
            );
        

        return view('application.list', $data);
    }

    public function assingnAppToSelf(Request $request)
    {
        //get application
        $app = Application::find($request->app_id);
        //if not exist return to page with error
        if(!$app) return back()->with('flashed', 'That Application does not exist');
        //get next status  for application in line
       $next = \App\Status::where('id', '>', $app->status()->first()->min('id'))->first();//recheck this code, 
       //get user's role
       $userRoleid = \Auth::user()->role_id;
       
       //
		$apprecord = ApplicationUser::where('app_id',$request->app_id)->where('user_id',\Auth::user()->id)->get();
        //return ($apprecord);
        if ($apprecord->count()>=1){
        	return redirect('/application/view/'.$request->app_id)->with('message', ' Application alread assigned to you.');
        }else{

            $this->deleteApplicationUser($app->id);  
            $this->insertApplicationUser($request->app_id,$request->userid,\Auth::user()->role_id,\Auth::user()->role_id);
          
        }
        

      /* $roleStat = $this->rolestatusRel($userRoleid, $app->status()->first()->id)? 'True' : 'False';

       // this needs to fix in that you need a for loop incase more than 1 parcels exist, ie dont use parcels->first
       $collection = null;
       if($app->applicant()->parcels()->first()){
        $collection = $app->applicant()->parcels()->first()->proofs->pluck('proof_of_int_id');
       }
       
       $app_parcel_comments = $app->parcelcomments();
       */
        

         return redirect('/application/view/'.$app->id)->with('success', ' Application has succesfully been assinged to your list.');

    }

    /*
    |-----------------------------------------------------------------------------
    | Assign an application to a user
    |-----------------------------------------------------------------------------
    |
    | Only users within the county/region of the assigner can be assigned an application
    | 
    */
    public function assingnAppToUser($id=0,$userid=0)
    {
        //get application
        $app = Application::find($id);
        //ger user
        $asgnuser = User::find($userid);
        //check if app exists
        if(!$app) return back()->with('flashed', 'That Application does not exist');
        //get app-user combination and see if record exist
        $apprecord = ApplicationUser::where('app_id',$id)->where('user_id',$userid)->get();
        if ($apprecord->count()>=1){
            //if not exist, redirecct to page
            return redirect('/application/view/'.$id)->with('message', ' Application alread assigned to this user.')
                                                                ->with('useradded', '');
        }else{
            //remove all previously assigned field officers
            $this->deleteApplicationUser($id);
            //assign to new selected user
            $this->insertApplicationUser($id,$userid,$asgnuser->role_id,\Auth::user()->role_id);
        }
        //return to page wth success        
        return redirect('/application/view/'.$id)->with('success', ' Application has succesfully been assinged to '. $asgnuser->name.' list.')
                                                ->with('useradded', '');
    }

    /*---------------------------------------------------------------------------------------*/

     public function assingnServProvToSelf($id=0,$userid=0,Request $request)
    {
      
        $app = ServiceProvider::find($id);
        if(!$app) return back()->with('flashed', 'That Application does not exist');
       
        $apprecord = ServiceProviderUser::where('service_provider_id',$id)->where('user_id',\Auth::user()->id)->get();
        //return ($apprecord);
        if ($apprecord->count()>=1){
            return redirect('/provider/view/'.$id)->with('message', ' Application alread assigned to you.');
        }else{
        
            $this->insertServiceProviderUser($id,$userid,\Auth::user()->role_id);
          
        }
         return redirect('/provider/view/'.$app->id)->with('success', ' Application has succesfully been assinged to your list.');

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

    protected function deleteApplicationUser($appId)
    {
            //get appuser record
            $appusers = ApplicationUser::where('app_id', '=', $appId)
                        ->where('user_role','=',4)
                        ->get();
            //if record exists
            if ($appusers) {

                foreach ($appusers as $key => $appuser) {
                   $user = User::find($appuser->user_id);
                    //if user is in the same county as logged in user
                   if ($user->countyid == Auth::user()->countyid){

                       $appuser->delete();
                   
               }
           }
                //get user from record
                //$user = User::find($appusers->user_id);
                //if user is in the same county as logged in user
                /*if ($user->countyid == Auth::user()->countyid){
                    //remove the user from this application
                    foreach ($appusers as $key => $appuser) {
                     $appuser->delete();
                 }
                }*/        
                 
            }
            
                 
    }

    protected function insertServiceProviderUser($sp_Id, $userId,$role)
    {
            $appuser = new ServiceProviderUser; 
            $appuser->service_provider_id = $sp_Id;
            $appuser->user_id = $userId;
            $appuser->user_role = $role;
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

    protected function containsStateland($collection)
    {

        if ($collection != null){
            if ($collection->contains(34)){
                return ('True' );
            }
            else{
                return 'False';
            }
        }else
        {
            return 'False';
        }
        
    }

    protected function noDocumentFound($app)
    {

        $isthere = 'True';
        $parcels = $app->applicant()->parcels()->all();
        foreach ($parcels as $parcel) {
            $proooofs = $parcel->proofs->all();
            foreach ($proooofs as $proof) {
                $ffff = $proof->documents;
                if (!$ffff->isEmpty())
                {
                    $docs = $proof->documents->first()->id;
                    if(empty($docs))
                    {
                        $isthere = 'False';
                    }
                }
                else{
                    $isthere = 'False';
                }
                
                
            }
        } 


        return ($isthere);
        
    }
    /*GET LIST OF PRODUCE FOR A PARCEL using ajax from the application view list*/
    public function producechecklist($parcelid=0)
    {

        $specificcrops = \App\Parcel::find($parcelid)->produce();
        
       
        return view('application.dfocomment.dfoproduceconf', compact('specificcrops'));
        
    }

}
