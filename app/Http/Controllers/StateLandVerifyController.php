<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Storage;
use DB;
use App\Enterprise;
use App\AddressLotType;
use App\Gender;
use App\Individual;
use App\Address;
use App\IndividualAddress;
use App\Application;
use App\ApplicationIndividual;
use App\ApplicationEnterprise;
use App\EnterpriseOther;
use App\RegistrationType;
use App\Contact;
use App\IndividualContact;
use App\IndividualID;
use App\ProofOfInterestCode;
use App\TenureCode;
use App\ParcelType;
use App\ParcelUnit;
use App\Parcel;
use App\Land;
use App\AreaType;
use App\ParcelTypeOfProduce;
use App\ParcelProofOfInterest;
use App\ParcelProofOfIntDocs;
use App\Districts;
use App\LandType;
use App\TenureProofRelation;
use App\TenureProofRelOpt;
use App\ApplicationType;
use App\ParcelVerification;
use App\OfficerParcelVerification;
use App\StatelandUprn;
use App\ParcelUprn;
use Carbon\Carbon;

class StateLandVerifyController extends Controller
{
    public function index()
    {
      $data = array(
        'nav' => ['nav-appl','nav-appl-1'],
        'navApplIn' => 'in',
        'title' => 'State Land Verification Form',
        'applications' => Application::all(),
        'type' => ['slug' => 'slv_request', 'type' => 'State Land Verification Request'],
        'enterprises' => Enterprise::all(),
        'lot_types' => AddressLotType::ordered(),
        'genders' => Gender::all(),
        'proof_codes' => ProofOfInterestCode::ordered(),
        'tenure_codes' => TenureCode::ordered(),
        'parcel_types' => ParcelType::all(),
        'land_types' => LandType::ordered(),
        'area_types' => AreaType::all(),
        'emails' => Individual::pluck('email'),
        'districts' => Districts::ordered(),
        'n_ids' => IndividualID::pluck('id_num'),
        'proof_mandatory' => proofMandatory(),
        'proof_optional' => proofOptional(),
        'shortlist' => shortlistCombos(),
        'application_types' => ApplicationType::ordered(),
        );
        return view('application.statelandverification.statelandform', $data);
    }



    public function getindividual()
    {
         $farmer = FarmerIndividual::where('ind_id',$this->id)->first();
         if ($farmer)
            return Farmer::find($farmer->farmer_id);
         else
            return 0;
    }

    public function view($id=0)
    {
     $user = Individual::find($id);
     if(!$user) return back()->with('flashed', 'That Individual does not exist');

     $data = array(
         'nav' => ['nav-funct', 'nav-funct-5'],
         'navFunctIn' => 'in',
         'title' => $user->name,
         'data' => $user,

     );
            //return ($data);
     return view('application.statelandverification.view', $data);
    }

    public function insert(Request $request)
    {
        //return ($this->proofOfIntId($request->parcel_id));

        $validator = Validator::make($request->all(), [
                
                'proof_codes_file' => '',
                'sal_Recommendation' => '',
                'cabinet_Note' => '',
                'years_Occupied' => 'required',
                'comments' => 'required',
                'slv_enterprise_type' => 'required',
                'parcel_amt' => 'required',
                'percent_cultivation' => 'required',
                'recommend' => 'required',
                'uprn' => '',
                
            ]);
        /*get app id*/
        $app = Application::find($request->view_id);
        /*if validator fails*/
        if ($validator->fails()) {
            return redirect('/application/view/'.$app->id)
                ->withInput()
                ->withErrors($validator);
        };
        /*code to insert upload*/
        if($this->proofOfIntId($request->modal_parcel_id) !== 0) 
        {   
            /*$proofs = Parcel::with('proofs.documents')->find($request->modal_parcel_id)->proofs->where('proof_of_int_id',34)->first();
            return $proofs->documents->first()->delete();
            if (!is_null($proofs)) {
               $proofs->documents->delete();
            }*/

            $statelanduprns = new StatelandUprn;
            $statelanduprns->uprn = $request->uprn;
            $statelanduprns->save();

            $ParcelUprn = new ParcelUprn;
            $ParcelUprn->app_id = $request->view_id;
            $ParcelUprn->uprn_id = $statelanduprns->id;
            $ParcelUprn->save();
            
            $parcelverification = new ParcelVerification;
            $parcelverification->parcel_id = $request->modal_parcel_id;
            $parcelverification->recommend_sal = $request->sal_Recommendation;
            $parcelverification->cabnote = $request->cabinet_Note;
            $parcelverification->occupation_years = $request->years_Occupied;
            $parcelverification->uprn = $request->uprn;
            $parcelverification->uprn_id = $statelanduprns->id;
            $parcelverification->remarks = $request->comments;
            $parcelverification->verification_ent_id = $request->slv_enterprise_type;
            $parcelverification->plot_size = $request->parcel_amt;
            $parcelverification->percent_cultivated = $request->percent_cultivation;
            $parcelverification->recommended = $request->recommend;
            $parcelverification->user_id = \Auth::user()->id;
            $parcelverification->save();

            /*Record officer's id for state land*/ 
            $officerparcelverification = new OfficerParcelVerification;
            $officerparcelverification->parcel_veri_id = $parcelverification->id;
            $officerparcelverification->user_id =  \Auth::user()->id;
            $officerparcelverification->save();
            
            $file = $request->proof_codes_file;
            if (!empty($file)) {

                $this->proofDocumentDelete($request->modal_parcel_id);
                $doc = 'State_Land_'.$app->id.'_'.$app->applicant()->id.'_'.md5('34_'.$file->getClientOriginalName()).'.'.$file->extension();
                                        // upload document
                $file->storeAs('public/proofdocs', $doc);
                                        // save document to parcel
                $proofdocs = new ParcelProofOfIntDocs;

                $proofdocs->parcel_proof_of_int_id = $this->proofOfIntId($request->modal_parcel_id);
                $proofdocs->document = $doc;
                $proofdocs->type = $file->extension();
                $proofdocs->save();
                //check if all documents exist
                if ($app->untenanted == 1) {
                    if ($app->missingdocument()) {
                        $app->untenanted = 0;
                        $app->save();
                    }
                }
                return redirect('/application/view/'.$app->id)->with('success', ' Stateland Application form has been uploaded and saved.');
            }


            else{return redirect('/application/view/'.$app->id)->with('message', ' Please attach Stateland Verification form.');}

            //check if all documents exist
                if ($app->untenanted == 1) {
                    if ($app->missingdocument()) {
                        $app->untenanted = 0;
                        $app->save();
                    }
                }
            
            return redirect('/application/view/'.$app->id)->with('success', ' Stateland Application form data has been saved.');
        }
        else{return redirect('/application/view/'.$app->id)->with('message', ' Data was not saved');}

    }

    protected function proofOfIntId($parcel_id)
    {
        $parcel = Parcel::find($parcel_id);
        $proofs = $parcel->proofs->pluck('proof_of_int_id');
        $collection = $proofs;
        if($this->containsStateland($collection))
        {
                //YOU ARE HERE, THIS RETURNS IF SLV 34 ENTRY IS FOUND
            return ($parcel->proofs()->where('proof_of_int_id',34)->pluck('id')->first());
        }
        return (0);
    }

    protected function proofDocumentDelete($parcel_id)
    {
        //$parcel = Parcel::find($parcel_id);
        $proofs = Parcel::with('proofs.documents')->find($parcel_id)->proofs->where('proof_of_int_id',34)->first();
        //$stateland = $proofs->where('proof_of_int_id',34)->first();
        //return $stateland;
        if (!is_null($proofs)) {
           $proofs->documents->first()->delete();
        }
        
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

    public function listing()
    {
      /*$data = array(
        'nav' => ['nav-appl','nav-appl-1'],
        'navApplIn' => 'in',
        'title' => 'State Land Verification Form',
        'applications' => Application::all(),
        'type' => ['slug' => 'slv_request', 'type' => 'State Land Verification Request'],
        'enterprises' => Enterprise::all(),
        'lot_types' => AddressLotType::ordered(),
        'genders' => Gender::all(),
        'proof_codes' => ProofOfInterestCode::ordered(),
        'tenure_codes' => TenureCode::ordered(),
        'parcel_types' => ParcelType::all(),
        'land_types' => LandType::ordered(),
        'area_types' => AreaType::all(),
        'emails' => Individual::pluck('email'),
        'districts' => Districts::ordered(),
        'n_ids' => IndividualID::pluck('id_num'),
        'proof_mandatory' => proofMandatory(),
        'proof_optional' => proofOptional(),
        'shortlist' => shortlistCombos(),
        'application_types' => ApplicationType::ordered(),
        );
        return view('application.statelandverification.statelandform', $data);*/
    }

}
