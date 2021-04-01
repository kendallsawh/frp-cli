<?php

namespace App\Http\Controllers;

use App\Http\Traits\CompositeKeyModelHelper;
use Illuminate\Http\Request;
//use CompositeKeyModelHelper;
use Validator;
use Storage;
use DB;
use File;
/*use Illuminate\Support\Facades\File as LaraFile;*/
use App\Enterprise;
use App\Farmer;
use App\AddressLotType;
use App\Gender;
use App\Individual;
use App\Address;
use App\IndividualAddress;
use App\Application;
use App\ApplicationIndividual;
use App\ApplicationEnterprise;
use App\EnterpriseOther;
use App\FarmerIndividual;
use App\FarmerBadge;
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
use App\ApplicationUserComment;
use App\PrintBadge;
use App\PrintRasBadge;
use \App\Commodities;
use App\Counties;
use Carbon\Carbon;
use App\FarmerRegExport;
use App\StatelandUprn;
use App\ParcelUprn;
use App\ApplicationUser;
use App\UserApplication;
use App\Appointment;
use App\Notifications\AppointmentNotification;
use App\Notifications\NotifiyApplicant;
use Notification;

class IndividualRegisterController extends Controller
{
    use CompositeKeyModelHelper;

    public function __construct()
      {
        $this->middleware('auth');
      }
    
    /*
    |-----------------------------------------------------------------------------
    | Function to return page to enter a new indivdual application
    |-----------------------------------------------------------------------------
    |
    |
    */
    public function registerIndividual()
    {
        /*$chk = false;
        if (\Auth::user()->userapplication) {
            (\Auth::user()->userapplication->type==1) ? $chk = true : $chk = false ;            
          }
        if ($chk) {
            return redirect('/home')->with('flashed', 'Unauthorized access to link.');
        } else {
            $data = array(
            'nav' => ['nav-funct','nav-funct-1'],
            'navFunctIn' => 'in',
            'title' => 'Individual Registration',
            'type' => ['slug' => 'new_farmer', 'type' => 'Individual Registration'],
            'enterprises' => Enterprise::all(),
            'lot_types' => AddressLotType::ordered(),
            'genders' => Gender::all(),
            'proof_codes' => ProofOfInterestCode::ordered(),
            'tenure_codes' => TenureCode::ordered(),
            'parcel_count' => 5,
            'parcel_types' => ParcelType::all(),
            'land_types' => LandType::ordered(),
            'area_types' => AreaType::all(),
            'emails' => Individual::pluck('email'),
            'districts' => Districts::ordered(),
            //'n_ids' => IndividualID::pluck('id_num'),
            //'testtt' => \App\UserDistrict::where('district_id',16)->first(),
            'n_ids' => '',
            'old_reg_id' => Farmer::pluck('old_badge_id'),
            'proof_mandatory' => proofMandatory(),
            'proof_optional' => proofOptional(),
            'proof_conditions' => proofOptionalCondition(),
            'shortlist' => shortlistCombos(),
            'application_types' => ApplicationType::ordered(),
            'doc_lists' => TenureProofRelation::orderBy('app_id','desc')->get(),
            'animal_crops' => Commodities::select('CommodityLocalName', 'id','Variety')
            ->where('display', 1)
            ->distinct()->orderBy('CommodityLocalName', 'ASC')->get(),
        );
          
        return view('farmer.individual', $data);
        }*/
        
            
        $data = array(
            'nav' => ['nav-funct','nav-funct-1'],
            'navFunctIn' => 'in',
            'title' => 'Individual Registration',
            'type' => ['slug' => 'new_farmer', 'type' => 'Individual Registration'],
            'enterprises' => Enterprise::all(),
            'lot_types' => AddressLotType::ordered(),
            'genders' => Gender::all(),
            'proof_codes' => ProofOfInterestCode::ordered(),
            'tenure_codes' => TenureCode::ordered(),
            'parcel_count' => 5,
            'parcel_types' => ParcelType::all(),
            'land_types' => LandType::ordered(),
            'area_types' => AreaType::all(),
            'emails' => Individual::pluck('email'),
            'districts' => Districts::ordered(),
            //'n_ids' => IndividualID::pluck('id_num'),
            //'testtt' => \App\UserDistrict::where('district_id',16)->first(),
            'n_ids' => '',
            'old_reg_id' => Farmer::pluck('old_badge_id'),
            'proof_mandatory' => proofMandatory(),
            'proof_optional' => proofOptional(),
            'proof_conditions' => proofOptionalCondition(),
            'shortlist' => shortlistCombos(),
            'application_types' => ApplicationType::ordered(),
            'doc_lists' => TenureProofRelation::orderBy('app_id','desc')->get(),
            'animal_crops' => Commodities::select('CommodityLocalName', 'id','Variety')
            ->where('display', 1)
            ->distinct()->orderBy('CommodityLocalName', 'ASC')->get(),
        );
          
        return view('farmer.individual', $data);
        
    }
    /*
    |-----------------------------------------------------------------------------
    | Function to save data for new individual application
    |-----------------------------------------------------------------------------
    |
    |
    */
    public function individualInsert(Request $request)
    {

        //return dd($request->all());
        ini_set('max_execution_time', '200000');
        /** Validation **/
         $validator = Validator::make($request->all(), [
            /** rules **/
            /*'oldregistration' => 'nullable|unique:farmers,old_badge_id',*/
            // type
            // 'job' => 'required',
            'regtype' => 'required',
            // personal info
            'avatar' => 'mimes:jpeg,png,jpg|max:4000', // 4Mb
            'dateofbirth' => 'required|date|before_or_equal:'.Carbon::now(),
            'alias' => '',
            'dateofissue' => '',
            'firstname' => 'required',
            'middlename' => '',
            'lastname' => 'required',
            'gender' => 'required|exists:genders,slug',
            'email' => 'nullable|unique:individuals,email|email',
            'homenumber' => 'nullable|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            'mobilenumber' => 'nullable|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            'n_id' => 'required_without_all:passport|nullable|unique:individual_ids,id_num|digits:11',
            'passport' => 'required_without_all:n_id',
            //'dp' => 'required_without_all:n_id,passport',
            'emergencynumber' => 'nullable|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            // address
            'hometype' => 'required',
            'street_number' => '',
            'road_trace' => '',
            'town_village' => 'required',
            'postal_checkbox' => '',
            'postaltype' => 'required_without:postal_checkbox',
            'street_number2' => 'required_without:postal_checkbox',
            'road_trace2' => 'required_without:postal_checkbox',
            'town_village2' => 'required_without:postal_checkbox',
            // enterprise
            'enterprise' => 'required',
            "majorminor" => '',
            "other_name" => '',
            // parcel
            'appdate' => '',
            "parcels_added" => 'required',
            "parcel_lot_type" => '',
            "parcel_street_number" => '',
            "parcel_road_trace" => '',
            "parcel_town_village" => '',
            "parcel_area_type" => '',
            "parcel_area" => '',
            "land_type" => '',
            "tenure" => '',
            "proof_codes" => '',
            'proof_codes_file' => '',
            // crops/animals
            "crops_added" => '',
            "parcel_type" => '',
            "animal_crop" => '',
            "parcel_amt" => '',
            ],[
            // custom messages
            'avatar.image' => 'Only jpeg and jpg images are allowed.',
            'avatar.max' => 'Sorry! Maximum allowed size for an image is 4MB.',
            'postaltype.required_without' => 'The postal lot type field is required when postal address is not the same as home address.',
            'street_number2.required_without' => 'The street number field is required when postal address is not the same as home address.',
            'road_trace2.required_without' => 'The road/street/trace field is required when postal address is not the same as home address.',
            'town_village2.required_without' => 'The town/village/settlement field is required when postal address is not the same as home address.',
            'n_id.required' => 'The national id field is required.',
            'n_id.unique' => 'The national id has already been taken.',
            'n_id.digits' => 'The national id must be 11 digits.',
            'dateofbirth.required' => 'The date of birth field is required.',
            'dateofbirth.date' => 'The date of birth is not a valid date.',
            'dateofbirth.before_or_equal' => 'The date of birth must be a date before or equal to today.',
            'parcels_added.required' => 'There are no parcels.',
            'homenumber.regex' => 'The home contact format should be (xxx) xxx-xxxx.',
            'mobilenumber.regex' => 'The mobile contact format should be (xxx) xxx-xxxx.',
            'emergencynumber.regex' => 'The emergency number format should be (xxx) xxx-xxxx.',
            'emergencynumber.required' => 'The emergency number field is required.',
            'n_id.required_without_all' => 'Select at least one type of identification.',
            //'dp.required_without_all' => 'Select at least one type of identification.',
            'passport.required_without_all' => 'Select at least one type of identification.',
            ]
        );

        // check for extra stuff
            $validator->after(function($validator)  use ($request) {
            // check for avatar
            if (!$request->avatar && !$request->old_avatar) {
            $validator->errors()->add('avatar', 'Picture is required.');
            }

        // check age 18 and over
            if ($request->dateofbirth)
                if (strtotime($request->dateofbirth)) // check if is a date
            if (Carbon::parse($request->dateofbirth)->age < 18)
                $validator->errors()->add('dateofbirth', 'Applicant must be 18 years or older.');

            // enterprise rules
            if ($request->enterprise)
                foreach ($request->enterprise as $slug => $value) {
                    if (!isset($request->majorminor[$slug])) {
                        $validator->errors()->add('majorminor-'.$slug, 'Please select major or minor for enterprise.');
                    }
                    if ($slug=='other') {
                        if (!isset($request->other_name)) {
                            $validator->errors()->add('other_name', 'Please enter other name.');
                        }
                    }
                }

            // parcel rules
                if ($request->parcels_added) {
                    $parcels = explode(',', $request->parcels_added);
                // proof documents
                    $proof_mandatory = proofMandatory();
                    $proof_optional = proofOptional();
                    $proof_conditional = proofOptionalCondition();
                    

                    foreach ($parcels as $parcel) {
                    // check for required fields in parcel
                        if (!isset($request->parcel_lot_type[$parcel])) $validator->errors()->add('parcel_lot_type.'.$parcel, 'The parcel lot type field is required.');
                        if (!isset($request->parcel_street_number[$parcel])) $validator->errors()->add('parcel_street_number.'.$parcel, 'The parcel street number field is required.');
                        if (!isset($request->parcel_road_trace[$parcel])) $validator->errors()->add('parcel_road_trace.'.$parcel, 'The parcel road/street/trace field is required.');
                        if (!isset($request->parcel_town_village[$parcel])) $validator->errors()->add('parcel_town_village.'.$parcel, 'The parcel town/village/settlement field is required.');
                        if (!isset($request->parcel_area_type[$parcel])) $validator->errors()->add('parcel_area_type.'.$parcel, 'The parcel area type field is required.');
                        if (!isset($request->parcel_area[$parcel])) $validator->errors()->add('parcel_area.'.$parcel, 'The parcel area field is required.');
                        if (!isset($request->land_type[$parcel])) $validator->errors()->add('land_type.'.$parcel, 'The parcel land type field is required.');
                        if (!isset($request->tenure[$parcel])) $validator->errors()->add('tenure.'.$parcel, 'The parcel tenure field is required.');

                        $app = $request->app_type;
                        $land_type = $request->land_type[$parcel];
                        $tenure = $request->tenure[$parcel];

                        if (isset($app) && isset($land_type) && isset($tenure)) {

                            $mands = 0;
                            $opts = true;
                            $chk = true;

                        // app type -> land type -> tenure -> document
                            if (isset($proof_mandatory[$app][$land_type][$tenure])) {
                                if ($request->proof_codes[$parcel]) {
                                    foreach ($proof_mandatory[$app][$land_type][$tenure] as $item) {
                                        foreach ($request->proof_codes[$parcel] as $code => $on) {
                                            if ($item == $code) $mands++;
                                        }
                                    }
                                }
                                if ($mands != count($proof_mandatory[$app][$land_type][$tenure])) $chk = false;
                            }
                            if (isset($proof_optional[$app][$land_type][$tenure])) {
                                $opts = false;
                                if ($request->proof_codes[$parcel]) {
                                    foreach ($proof_optional[$app][$land_type][$tenure] as $item) {
                                        foreach ($request->proof_codes[$parcel] as $code => $on) {

                                            if ($item == $code){//if any optional documents of the paticular index set =  the selected set of proofs, set opts to true
                                                $opts = true;}
                                            elseif (count($proof_conditional[$app][$land_type][$tenure])==1) {
                                                    /*$proof_conditional[$app][$land_type][$tenure][$item]*/
                                                    $opts = true;
                                                }
                                            elseif($proof_conditional[$app][$land_type][$tenure][$item] == 1){
                                                $opts = false;
                                            }
                                            

                                        }
                                    }
                                } 
                            }

                            if (!$chk || !$opts) $validator->errors()->add('proof_codes.'.$parcel, 'The marked documents are required.');
                        }

                   
                        }
                    }

                });

        if ($validator->fails()) {
            // upload avatar to temp
            $avatar = $request->old_avatar;
            if ($request->avatar) {
                if ($request->file('avatar')->isValid() && $request->file('avatar')->getClientSize() <= 4000000) { // 4mb
                    $avatar = md5($this->generateRandomString()).'.'.$request->avatar->extension();
                    // upload avatar
                    $request->avatar->storeAs('avatar', $avatar);
                }
            }
            
            // set old avatar in session
            return redirect('/farmer/register/individual/')
            ->withInput()
            ->withErrors($validator)
                ->with([ // uploaded files
                    'old_avatar' => $request->avatar,
                ]);
        }
        //dd($request->all());
        DB::beginTransaction();//BEGIN THE PROCESS
        try{
            // create individual
                $individual = new Individual;
                $individual->f_name = strtoupper($request->firstname);
                $individual->m_name = strtoupper($request->middlename);
                $individual->l_name = strtoupper($request->lastname);
                $individual->alias = strtoupper($request->alias);
                $individual->gender_slug = $request->gender;
                $individual->dob = $request->dateofbirth;
                $individual->email = $request->email;
                $individual->created_by = 1;
                $individual->save();

            // avatar upload
                if ($request->avatar) {
                    if ($request->file('avatar')->isValid()) {
                        $avatar = $individual->id.'_'.md5($individual->id).'.'.$request->avatar->extension();
                    // upload avatar
                        $request->avatar->storeAs('public/avatars', $avatar);
                    // save name to individual
                        $individual->avatar = $avatar;
                        $individual->save();
                    }
                }else if ($request->old_avatar && file_exists(public_path().'/storage/temp/'.$request->old_avatar)) {
                    $ext = explode('.',$request->old_avatar);
                    $avatar = $individual->id.'_'.md5($individual->id).'.'.end($ext);

                    Storage::move('temp/'.$request->old_avatar, 'avatars/'.$avatar);
                // save name to individual
                    $individual->avatar = $avatar;
                    $individual->save();
                }

            // create home address
                $address = new Address;
                $address->lot_type_id = $request->hometype;
                $address->house_num = strtoupper($request->street_number);
                $address->road = strtoupper($request->road_trace);
                $address->district_id = $request->town_village;
                $address->save();

            // check if postal address is same as home
                $request->postal_checkbox ? $a = 3 : $a = 1;

            // link address and individual
                $indAddress = new IndividualAddress;
                $indAddress->ind_id = $individual->id;
                $indAddress->add_id = $address->id;
                $indAddress->ind_add_type_id = $a;
                $indAddress->save();

            // enter postal address if different from home
                if (!$request->postal_checkbox) {
                    $postal = new Address;
                    $postal->lot_type_id = $request->postaltype;
                    $postal->house_num = strtoupper($request->street_number2);
                    $postal->road = strtoupper($request->road_trace2);
                    $postal->district_id = $request->town_village2;
                    $postal->save();

                // link postal address and individual
                    $postalAddress = new IndividualAddress;
                    $postalAddress->ind_id = $individual->id;
                    $postalAddress->add_id = $postal->id;
                    $postalAddress->ind_add_type_id = '2';
                    $postalAddress->save();
                }

            // create application
                //$regType = RegistrationType::where('slug',$request->job)->first();
                $application = new Application;
                $application->old_registration_num = html_entity_decode($request->oldregistration, ENT_QUOTES, 'UTF-8');
                $application->app_type_id = $request->app_type;
                $application->registration_id = $request->regtype;
                //$application->registration_id = $request->options;
                //$application->registration_id = isset($request->oldregistration)?  2: $regType->id;
                $application->application_date = $request->appdate;
                $application->created_by = 1;
                $application->registering_county = Districts::find($address->district_id)->ward->county->id;
                $application->save();
                $application->application_num = '10'.Districts::find($address->district_id)->ward->county->id.'00'.$application->id;
                $application->save();

            // link application to individual
                $applicationInd = new ApplicationIndividual;
                $applicationInd->app_id = $application->id;
                $applicationInd->ind_id = $individual->id;
                $applicationInd->save();

            
            // attach enterprises to application
                if ($request->majorminor) {
                    foreach ($request->majorminor as $key => $value) {
                        $enterprise = Enterprise::where('slug',$key)->first(); // get enterprise id

                        $appEnterprise = new ApplicationEnterprise;
                        $appEnterprise->enterprise_id = $enterprise->id;
                        $appEnterprise->application_id = $application->id;
                        $appEnterprise->type = $value;
                        $appEnterprise->save();

                        // handle other
                        if ($key == 'other' && $request->other_name) {
                            // save other name
                            $entOther = new EnterpriseOther;
                            $entOther->enterprise = strtoupper($request->other_name);
                            $entOther->application_id = $application->id;
                            $entOther->save();
                        }
                    }
                }

            // contact numbers
                if ($request->homenumber) {
                    // save contact number and type
                    $home = new Contact;
                    $home->contact = $request->homenumber;
                    $home->contact_type_id = 1;
                    $home->save();

                    // link contact number to individual
                    $indHome = new IndividualContact;
                    $indHome->individual_id = $individual->id;
                    $indHome->contact_id = $home->id;
                    $indHome->save();
                }
                if ($request->mobilenumber) {
                    // save contact number and type
                    $mobile = new Contact;
                    $mobile->contact = $request->mobilenumber;
                    $mobile->contact_type_id = 2;
                    $mobile->save();

                    // link contact number to individual
                    $indMobile = new IndividualContact;
                    $indMobile->individual_id = $individual->id;
                    $indMobile->contact_id = $mobile->id;
                    $indMobile->save();
                }
                if ($request->emergencynumber) {
                    // save contact number and type
                    $emergency = new Contact;
                    $emergency->contact = $request->emergencynumber;
                    $emergency->contact_type_id = 4;
                    $emergency->save();

                    // link contact number to individual
                    $indEmergency = new IndividualContact;
                    $indEmergency->individual_id = $individual->id;
                    $indEmergency->contact_id = $emergency->id;
                    $indEmergency->save();
                }

            // identification
                if ($request->n_id) {
                    // save id
                    $doc = "";
                    $file = NULL;
                    $n_id = new IndividualID;
                    $n_id->individual_id = $individual->id;
                    $n_id->id_type_id = 1;
                    $n_id->id_num = $request->n_id;
                    
                    
                    

                    if (isset($request->nid_file)) {
                        sleep(2);
                        $file = $request->nid_file;
                        if (!empty($file)) {



                            $doc = $individual->id.'_NIDScan_'.md5($file->getClientOriginalName()).'.'.$file->extension();
                                            // upload document
                            $file->storeAs('public/proofdocs', $doc);
                            //this worked
                            //Storage::disk('ftp_2')->putFileAs('proofdocs', $file, $doc);
                            
                            /*if (Storage::disk('ftp_2')->exists($doc)) {
                                Storage::disk('ftp_2')->put($file);
                            }*/
                            /*$ftp_server = "127.0.0.1";
                            $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
                            $login = ftp_login($ftp_conn, 'apps', '1234');

                            $files = $doc;

                            // upload file
                            ftp_put($ftp_conn, 'proofdocs/'.$files, $file, FTP_BINARY );
                            

                            // close connection
                            ftp_close($ftp_conn);*/

                            /*THIS ONE*/
                            /*$ftp_server = "10.13.1.66";
                            $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
                            $login = ftp_login($ftp_conn, 'apps', '1234');
                            //two precceding lines are required for ftp passive mode
                            ftp_set_option($ftp_conn, FTP_USEPASVADDRESS, false);
                            ftp_pasv($ftp_conn, true);*/
                            $this->ftpconnect();
                            $files = $doc;

                            // upload file
                            ftp_put($ftp_conn, $files, $file, FTP_BINARY );
                            

                            // close connection
                            ftp_close($ftp_conn);
                            
                                            // save document to parcel
                            //return $doc.' '.$n_id->documents;
                            
                            $n_id = new IndividualID;
                            $n_id->individual_id = $individual->id;
                            $n_id->id_type_id = 1;
                            $n_id->id_num = $request->n_id;
                            $n_id->documents = $doc;
                            $n_id->type = $file->extension();
                            $n_id->save();
                            
                        }




                    }
                    else{
                        $n_id = new IndividualID;
                        $n_id->individual_id = $individual->id;
                        $n_id->id_type_id = 1;
                        $n_id->id_num = $request->n_id;
                        $n_id->save();
                    }
                    
                           
                    

                }
                if ($request->dp) {
                    // save id
                    $dp = new IndividualID;
                    $dp->individual_id = $individual->id;
                    $dp->id_type_id = 2;
                    $dp->id_num = $request->dp;
                    $dp->save();
                }

                  

                if ($request->passport) {
                    $doc = "";
                    $file = NULL;
                    $passport = new IndividualID;
                    $passport->individual_id = $individual->id;
                    $passport->id_type_id = 3;
                    $passport->id_num = $request->passport;
                    

                       
                    if (isset($request->passport_file)) {
                        sleep(2);
                        $file = $request->passport_file;
                        if (!empty($file)) {
                            $doc = $individual->id.'_PPScan_'.md5($file->getClientOriginalName()).'.'.$file->extension();
                                                // upload document
                            $file->storeAs('public/proofdocs', $doc);
                                                // save document to parcel

                            $this->ftpconnect();
                            $files = $doc;

                            // upload file
                            ftp_put($ftp_conn, $files, $file, FTP_BINARY );
                            

                            // close connection
                            ftp_close($ftp_conn);

                            $passport = new IndividualID;
                            $passport->individual_id = $individual->id;
                            $passport->id_type_id = 3;
                            $passport->id_num = $request->passport;
                            $passport->documents = $doc;
                            $passport->type = $file->extension();
                            $passport->save();
                            
                        }

                    } 
                    else {
                        $passport = new IndividualID;
                        $passport->individual_id = $individual->id;
                        $passport->id_type_id = 3;
                        $passport->id_num = $request->passport;
                        $passport->save();
                    }

                }
            //return ($passport);
            // Parcel
            if ($request->parcel_lot_type) {
                foreach ($request->parcel_lot_type as $key => $value) {
                    // address
                        $parcelAddress = new Address;
                        $parcelAddress->lot_type_id = $request->parcel_lot_type[$key];
                        $parcelAddress->house_num = strtoupper($request->parcel_street_number[$key]);
                        $parcelAddress->road = strtoupper($request->parcel_road_trace[$key]);
                        $parcelAddress->district_id = $request->parcel_town_village[$key];
                        $parcelAddress->save();

                    // save land parcel
                        $land = new Land;
                        $land->address_id = $parcelAddress->id;
                        $land->area_amt = $request->parcel_area[$key];
                        $land->area_type_id = $request->parcel_area_type[$key];
                        $land->save();

                    
                    

                    // save parcel
                        $parcel = new Parcel;
                        $parcel->application_id = $application->id;
                        $parcel->land_id = $land->id;
                        $parcel->land_type_id = $request->land_type[$key];
                        $parcel->tenure_code_id = $request->tenure[$key];
                        $parcel->save();

                    if($request->uprns[$key]){
                        //save uprns if state lands
                        $statelanduprns = new StatelandUprn;
                        $statelanduprns->uprn = $request->uprns[$key];
                        $statelanduprns->parcel_id = $parcel->id;
                        $statelanduprns->save();

                        //save uprns-application link
                        $ParcelUprn = new ParcelUprn;
                        $ParcelUprn->app_id = $application->id;
                        $ParcelUprn->uprn_id = $statelanduprns->id;
                        $ParcelUprn->save();

                        $parcelverify = new ParcelVerification;
                        $parcelverify->parcel_id = $parcel->id;
                        $parcelverify->uprn = $request->uprns[$key];
                        $parcelverify->uprn_id = $statelanduprns->id;
                        $parcelverify->recommended = 1;
                        $parcelverify->user_id = 1;
                        $parcelverify->save();
                    }

                      

                    // proof codes
                        $untenanted = true; $doublecheck = 1;
                        if (isset($request->proof_codes[$key])) {
                            foreach ($request->proof_codes[$key] as $code => $on) {
                                $proof = new ParcelProofOfInterest;
                                $proof->parcel_id = $parcel->id;
                                $proof->proof_of_int_id = $code;
                                $proof->save();


                                        // upload documents for proof code

                                if (isset($request->proof_codes_file[$key][$code])) {
                                    sleep(2);
                                    foreach ($request->proof_codes_file[$key][$code] as $file) {
                                        if (!empty($file)) {
                                           $untenanted = false;

                                           try {

                                            $doc = \App\ProofOfInterestCode::where('id',$proof->proof_of_int_id)->pluck('proof')->first().'_'.$application->id.'_'.$parcel->id.'_'.md5($proof->id.'_'.$file->getClientOriginalName()).'.'.$file->extension();
                                                    // upload document
                                            $file->storeAs('public/proofdocs', $doc);
                                                    // save document to parcel
                                                    // 
                                            $this->ftpconnect();
                                            $files = $doc;

                                            // upload file
                                            ftp_put($ftp_conn, "proofdocs/".$files, $file, FTP_BINARY );


                                            // close connection
                                            ftp_close($ftp_conn);

                                            $proofdocs = new ParcelProofOfIntDocs;
                                            $proofdocs->parcel_proof_of_int_id = $proof->id;
                                            $proofdocs->document = $doc;
                                            $proofdocs->type = $file->extension();
                                            $proofdocs->save();
                                            $doublecheck = 0;
                                            } catch (\Exception $exception) {

                                            }
                                        }
                                                /*if($doublecheck == 1){
                                                    $untenanted = true;
                                                    
                                                }*/
                                    }


                                }
                            }
                        }
                        if($untenanted == true  && $application->app_type_id == 12){
                            $application->untenanted = 1;
                            $application->save();
                        }
                    // parcel crops/animals
                        if ($request->parcel_type[$key]) {
                            foreach ($request->parcel_type[$key] as $ind => $value) {
                                
                                $crops = new ParcelTypeOfProduce;
                                $crops->parcel_id = $parcel->id;
                                $crops->parcel_type_id = $value;
                                    
                                $crops->specific_parcel = \App\Commodities::find($request->animal_crop[$key][$ind])->CommodityLocalName;
                                $crops->commodity_id = $request->animal_crop[$key][$ind];
                                 
                                
                                $crops->amt = $request->parcel_amt[$key][$ind] ? $request->parcel_amt[$key][$ind] : 0;
                                /*convert to acres if hectares and store is std value column*/
                                $crops->amt_std = $value==1? $value *2.471053 : ($land->area_type_id == 1 ? $land->area_amt*2.471053 : $land->area_amt);
                                $crops->save();
                            }
                        }

                        $userapplication = new UserApplication;
                        $userapplication->user_id = \Auth::user()->id;
                        $userapplication->application_id = $application->id;
                        $userapplication->type = $request->regtype;
                        $userapplication->save();

                        $appointment = new Appointment;
                        $appointment->appointment_date = $request->appointment_date;
                        $appointment->individual_id = $individual->id;
                        $appointment->county_id =  Districts::find($request->town_village)->ward()->first()->county_id;
                        if (isset($request->comments)) {
                            $appointment->comments = $request->comments;
                        }
                        
                        $appointment->appointment_type = $request->regtype;
                        $appointment->save(); 

                        

                        
                }
            }
            
            
            // commit all the data to db before returning
            DB::commit();

            $users = Counties::where('id',$appointment->county_id)
            ->whereNotNull('email',)
            ->get();
            if (!$users->isEmpty()) {
                foreach ($users as $user) {

                    Notification::send($user, new AppointmentNotification($appointment,$user));
                }
            }


            $county = Counties::find($appointment->county_id)->first();
            $regtype = $appointment->appointment_type == 1? 'New' : 'Renewal';
            Notification::route('mail', $individual->email)
            ->notify(
                new NotifiyApplicant(
                    $individual->name,$appointment->appointment_date,$county,$regtype)

            );
            
            /*/ delete temp avatar
            if(file_exists(public_path().'/storage/temp/'.session('old_avatar')))
            Storage::delete('temp/'.session('old_avatar'));*/

            //session()->forget('app_type');
            
            return redirect('/application/view/'.$application->id)->with('success', 'Application successful. ');
            
            
        } catch (\Throwable $e) {
                /*DB::rollBack();
                return redirect('/farmer/register/individual/')
                ->withInput()
                ->withErrors($validator)
                    ->with([ // uploaded files
                        'old_avatar' => $request->avatar,
                    ]);*/
                    return $e->getMessage();

            }         
    }

    function ftpconnect(){
         /*THIS ONE*/
                            $ftp_server = "10.13.1.66";
                            $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
                            $login = ftp_login($ftp_conn, 'apps', '1234');
                            //two precceding lines are required for ftp passive mode
                            ftp_set_option($ftp_conn, FTP_USEPASVADDRESS, false);
                            ftp_pasv($ftp_conn, true);
    }
    function ftpdisconnect(){
        ftp_close();
    }

   
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

    /*
    |-----------------------------------------------------------------------------
    | Ajax
    |-----------------------------------------------------------------------------
    |use to search for id/pp match in database during farmer registration
    |
    */
    public function checknid(Request $request){
        $nid = $request->input('nid');
        $isExists = \App\IndividualID::where('id_num',$nid)->first();
        if($isExists){
            //return response()->json(array("exists" => true, "individual_view" => "http://127.0.0.1:8000/individual/view/".$isExists->individual_id));
            return response()->json(array("exists" => true, "individual_view" => $isExists->individual_id));
        }
    }
    /*
    |-----------------------------------------------------------------------------
    | Ajax
    |-----------------------------------------------------------------------------
    |use to search for county based on selected community match in database during farmer registration
    |also searches for the assigned officer for that farming district. returns the values: county,officer,boolean
    |
    */
    public function districtCountyCheck(Request $request){
        //return response()->json(array("exists" => true, "assinged_county" => 'hhh'));
        try {
            $dist_id = $request->input('districtid');
            $district = \App\Districts::find($dist_id);
            if ($district) {
                $farm_dist = \App\FarmingDistrict::find($district->farmer_district_id);
            }
            
            $isExists = \App\Districts::find($dist_id)->ward->county->county;
            if($isExists){
                
                //return $farm_dist;
                return response()->json(array(
                    "exists" => true, 
                    "assinged_county" => $isExists,
                    "assinged_farmdistrict" => is_null($farm_dist)? "": " of the District ".$farm_dist->district_name,
                ));
            }
            
        } catch (Exception $e) {
            //return errors if fail
            return \Response::json(['status' => 500, 'message' => $e->getMessage()],442);
        }
        
    }

   

}
