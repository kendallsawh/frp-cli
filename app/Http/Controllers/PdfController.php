<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Application;
use App\Individual;
use App\Organization;
use App\ParcelProofOfInterest;
use App\ParcelVerification;
use App\ServiceProvider;
use PDF;
use Storage;
use Carbon\Carbon;
use DB;
use App\Parcel;
use App\ParcelProofOfIntDocs;
class PdfController extends Controller
{

    /*
    |------------------------------------------------------------------
    |Download stateland verification form
    |and fill it in with user data
    |------------------------------------------------------------------
     */
    public function downloadPDF($id=0, Request $request){
        ini_set('max_execution_time', '160000');
        //return ($request->view_only);
    	//add if statement to diffrentiate if individual/org
        $individual = Individual::find($id);
        $organization = Organization::find($id);
     //$user = ($individual? $individual : $organization);
        if ($individual === null && $organization === null)
        {
            return back()->with('flashed', 'This record does not exist neither as an Individual nor Organization');

        }
        else
        {
            $user = array(
                'nav' => ['nav-appl','nav-appl-1'],
                'navApplIn' => 'in',            
                'user' => ($individual? $individual : $organization),
                'applicant_type' =>  ($individual? "Individual" : "Organization"),
                'home_address' => ($individual? $individual->home()->address : $organization->address->address),

            );
        }

        /*Insert stuff to add proof entry into db*/
        if($request->view_only=='True'){

        }
        else{

            /*$proof = new ParcelProofOfInterest;
            $proof->parcel_id = $request->parcel_id;
            $proof->proof_of_int_id = 34;
            $proof->save();*/

            $proof = ParcelProofOfInterest::where('parcel_id',$request->parcel_id)
            ->where('proof_of_int_id',34)
            ->first();
        }

        $app_id = Parcel::find($request->parcel_id)->application_id;
        $docname = 'Appendix_C_'.$app_id.'_'.$individual->fname.'_'.$individual->l_name.'_'.Carbon::now()->toDateString().'.pdf';
        $proofdocs = new ParcelProofOfIntDocs;
        $proofdocs->parcel_proof_of_int_id = $proof->id;;
        $proofdocs->document = $docname;
        $proofdocs->type = '.pdf';
        $proofdocs->save();
        // set the untenanted value to 0 as the document is in
        /*$application = Application::find($app_id);
        $application->untenanted = 0;
        $application->save();*/

    //return ($request->parcel_id);    
    //return ($user['user']->parcels()->all());
        
        $dompdf = PDF::loadView('application.statelandverification.pdf', compact('user'));
        
        /*save pdf to public file*/
        $dompdf->save('storage/proofdocs/'.$docname);

        return $dompdf->stream($docname);
    }

    public function applicationPDF($id=0, Request $request){
        ini_set('max_execution_time', '160000');
        //dd($request->all());
        $app = Application::find($request->app_id);
        $app_parcel_comments = $app->parcelcomments();
        //add if statement to diffrentiate if individual/org
        
        $organization = null;
        $individual = null;
        if($request->type === 'Organization'){
             $organization = Organization::find($id);
            
         }else{$individual = Individual::find($id);}
        
        if ($individual === null && $organization === null)
        {
            return back()->with('flashed', 'This record does not exist neither as an Individual nor Organization');

        }
        else
        {
            $user = array(
                'nav' => ['nav-appl','nav-appl-1'],
                'navApplIn' => 'in',            
                'user' => ($individual? $individual : $organization),
                'applicant_type' =>  ($individual? "Individual" : "Organization"),
                'home_address' => ($individual? $individual->home()->address : $organization->address->address),
                'data' => $app,
                'parcelcomments' => $app_parcel_comments,
            );
        }

       

       
    //return ($app);    
    //return ($user['user']->reps->first()->identification);
        //return (public_path()."/storage/avatars/".basename($user['user']->avatar));
        $dompdf = null;
        if ($individual){
            $dompdf = PDF::loadView('application.ind_pdf_min', compact('user'))->setPaper('legal', 'portrait');
        }
        else{
            $dompdf = PDF::loadView('application.companyapplicationpdf', compact('user'))->setPaper('legal', 'portrait');
        }
        
        $documentname = null;
        if($request->type === 'Individual'){
            $documentname = 'application_form_'.$app->id.'_'.preg_replace('/\s+/', '_', $individual->name).'_'.Carbon::now()->toDateString().'.pdf';
            }
        else{
            $documentname = 'application_form_'.$app->id.'_'.$organization->name.'_'.Carbon::now()->toDateString().'.pdf';
        }
        /*save pdf to public file*/
         $appdoc = new \App\ApplicationDocument;
        $appdoc->app_id = $request->app_id;
        
        $appdoc->document = $documentname;
        
        $appdoc->type = '.pdf';
        $appdoc->updated_by =  \Auth::user()->role_id;
        $appdoc->save();
        return $dompdf->save('storage/applicationforms/'.$documentname)->stream($documentname);
        //$dompdf->save('storage/applicationforms/'.$documentname);
        //return $dompdf->stream($documentname);
        
        //return redirect()->back()->with('message','Application form generated! Please Click the DOWNLOAD APPLICATION button now.');




    }

     public function spApplicationPDF($id=0, Request $request){
        ini_set('max_execution_time', '160000');
        $servp = ServiceProvider::find($request->app_id);
        //$servpcomments = App\ServiceProviderComment::where('service_provider_id',$servp->id)->get();
        //$recommendations = \App\Recommendation::where('provider_id', $servp->id)->get();

        $organization = null;
        $individual = null;
        if($request->type === 'Organization'){
             $organization = $servp->provider;
            
         }else{$individual = $servp->provider;}
        
        if ($individual === null && $organization === null)
        {
            //return back()->with('success', 'This record does not exist neither as an Individual nor Organization');
            return 'bob';
        }
        else
        {
            $user = array(
                'nav' => ['nav-appl','nav-appl-1'],
                'navApplIn' => 'in',            
                'user' => ($individual? $individual : $organization),
                'applicant_type' =>  ($individual? "Individual" : "Organization"),
                'home_address' => ($individual? $individual->home()->address : $organization->address->address),
                'data' => $servp,
                //'parcelcomments' => $app_parcel_comments,
            );
        }

        $dompdf = null;
        if ($individual){
            $dompdf = PDF::loadView('application.serviceapplicationpdf', compact('user'))->setPaper('legal', 'portrait');
        }
        else{
            //$dompdf = PDF::loadView('application.companyapplicationpdf', compact('user'))->setPaper('legal', 'portrait');
        }
        
        $documentname = null;
        if($request->type === 'Individual'){
            $documentname = 'serviceprovider_form_'.$servp->id.'_'.$individual->name.'_'.Carbon::now()->toDateString().'.pdf';
            }
        else{
            $documentname = 'serviceprovider_form_'.$servp->id.'_'.$organization->name.'_'.Carbon::now()->toDateString().'.pdf';
        }
        /*save pdf to public file*/
         /*$appdoc = new \App\ServiceProviderDocument;
        $appdoc->app_id = $servp->id;
        
        $appdoc->document = $documentname;
        
        $appdoc->type = '.pdf';
        $appdoc->updated_by =  \Auth::user()->role_id;
        $appdoc->save();
    $dompdf->save('storage/applicationforms/'.$documentname);*/

    
        
        return $dompdf->stream('serviceprovider_form_'.$servp->id.'.pdf');

     }

}
