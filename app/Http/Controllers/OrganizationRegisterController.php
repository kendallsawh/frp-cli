<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Storage;
use App\FarmerOrganization;
use App\Farmer;
use App\FarmerBadge;
use App\Organization;
use \App\Commodities;
use DB;

class OrganizationRegisterController extends Controller
{
    public function register()
    {

    	$data = array(
            'nav' => ['nav-funct','nav-funct-1'],
            'navFunctIn' => 'in',
			'title' => 'Organization Registration',

            'type' => ['slug' => 'new_farmer', 'type' => 'Organization Registration'],
            'enterprises' => \App\Enterprise::all(),
            'lot_types' => \App\AddressLotType::ordered(),
            'genders' => \App\Gender::all(),
            'proof_codes' => \App\ProofOfInterestCode::ordered(),
            'tenure_codes' => \App\TenureCode::ordered(),
            'parcel_count' => 5,
            'parcel_types' => \App\ParcelType::all(),
            'land_types' => \App\LandType::ordered(),
            'area_types' => \App\AreaType::all(),
            'id_types' => \App\IdentificationType::all(),
            'emails' => \App\Organization::pluck('email'),
            'reg_nums' => \App\Organization::pluck('registration_num'),
            'vat_nums' => \App\Organization::whereNotNull('vat_reg_num')->pluck('vat_reg_num'),
            'districts' => \App\Districts::ordered(),
            'n_ids' => \App\IndividualID::pluck('id_num'),
            'old_reg_id' => \App\Farmer::pluck('old_badge_id'),
            'proof_mandatory' => proofMandatory(),
            'proof_optional' => proofOptional(),
            'proof_conditions' => proofOptionalCondition(),
            'shortlist' => shortlistCombos(),
            'application_types' => \App\ApplicationType::ordered(),
            'animal_crops' => Commodities::select('CommodityLocalName', 'id','Variety')
            ->where('display', 1)
            ->distinct()->orderBy('CommodityLocalName', 'ASC')->get(),
		);
		
        return view('company.register', $data);
    }

    public function organizationInsert(Request $request)
    {
        //dd($request->all());

        /** Validation **/
        $validator = Validator::make($request->all(), [
            /** rules **/
            // type
            'job' => 'required',
            'app_type' => 'required',
            // company info
            'oldregistration' => '',
            'dateofissue' => 'required_with:oldregistration',
            'logo' => 'image|max:4000', // 4Mb
            'org_name' => 'required',
            'org_type' => 'required',
            //'reg_num' => 'required|unique:organizations,registration_num',
            //'vat_num' => 'required|unique:organizations,vat_reg_num',
            //'biz_email' => 'required|unique:organizations,email|email',
            'biz_phone' => 'required|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            // address
            'hometype' => 'required',
            'street_number' => 'required',
            'road_trace' => 'required',
            'town_village' => 'required',
            //representatives
            'avatar1' => 'image|max:4000', // 4Mb
            'app_fname1' => 'required',
            'app_sname1' => 'required',
            'contact1' => 'required|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            'id_type1' => 'required',
            'id_num1' => 'required',
            'avatar2' => 'image|max:4000', // 4Mb
            'app_fname2' => '',
            'app_sname2' => '',
            'contact2' => 'nullable|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            'id_type2' => '',
            'id_num2' => '',
            // enterprise
            'enterprise' => 'required',
            "majorminor" => '',
            "other_name" => '',
            // parcel
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
            "crops_added" => 'required',
            "parcel_type" => '',
            "animal_crop" => '',
            "parcel_amt" => '',
        ],[
            // custom messages
            'dateofissue.required_with' => 'The date field is required when a farmer registration number is supplied.',
            'org_name.required' => 'The organization name field is required.',
            'org_type.required' => 'The organization type field is required.',
            'reg_num.required' => 'The registration number field is required.',
            'vat_num.required' => 'The VAT registration number field is required.',
            'biz_email.required' => 'The email field is required.',
            'biz_phone.required' => 'The telephone number field is required.',

            'biz_phone.regex' => 'The telephone number format should be (xxx) xxx-xxxx.',
            'contact1.regex' => 'The contact format should be (xxx) xxx-xxxx.',
            'contact2.regex' => 'The contact format should be (xxx) xxx-xxxx.',

            'postaltype.required_without' => 'The postal lot type field is required when postal address is not the same as home address.',
            'parcels_added.required' => 'There are no parcels.',
            'contact.regex' => 'The home contact format should be (xxx) xxx-xxxx.',

            'app_fname1.required' => 'The first name field is required.',
            'app_sname1.required' => 'The surname field is required.',
            'contact1.required' => 'The contact field is required.',
            'id_type1.required' => 'The id type field is required.',
            'id_num1.required' => 'The id number field is required.',

            /*'app_fname2.required' => 'The first name field is required.',
            'app_sname2.required' => 'The surname field is required.',
            'contact2.required' => 'The contact field is required.',
            'id_type2.required' => 'The id type field is required.',
            'id_num2.required' => 'The id number field is required.',*/
        ]
        );

           // check for extra stuff
        $validator->after(function($validator)  use ($request) {

            //representatives rules
            // check for avatar
            if (!$request->avatar1 && !$request->old_avatar1) {
                $validator->errors()->add('avatar1', 'Picture is required.');
            }
            /*if (!$request->avatar2 && !$request->old_avatar2) {
                $validator->errors()->add('avatar2', 'Picture is required.');
            }*/

            
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
                                        if ($item == $code) $opts = true;
                                    }
                                }
                            } 
                        }

                        if (!$chk || !$opts) $validator->errors()->add('proof_codes.'.$parcel, 'The marked documents are required.');
                    }
                    
                    // parcel details
                    if ($request->crops_added[$parcel]) {
                        $crops = explode(',', $request->crops_added[$parcel]);
                        //dd($crops);
                        foreach ($crops as $crop) {
                            if (!isset($request->parcel_type[$parcel][$crop])) $validator->errors()->add('parcel_type.'.$parcel.'.'.$crop, 'The parcel type field field is required.');
                            if (!isset($request->animal_crop[$parcel][$crop])) $validator->errors()->add('animal_crop.'.$parcel.'.'.$crop, 'The type of crop/animal field is required.');
                            if (!isset($request->parcel_amt[$parcel][$crop])) $validator->errors()->add('parcel_amt.'.$parcel.'.'.$crop, 'The parcel amount field is required.');
                        }
                    }else $validator->errors()->add('crops_added.'.$parcel, 'The parcel crops/animals are required.');
                }
            }

        });
        
        if ($validator->fails()) {
            // upload avatar to temp
            $logo = $request->old_logo;
            if ($request->logo) {
                if ($request->file('logo')->isValid() && $request->file('logo')->getClientSize() <= 4000000) { // 4mb
                    $logo = md5(\Auth::user()->id).'.'.$request->logo->extension();
                    // upload avatar
                    $request->logo->storeAs('temp', $logo);
                }
            }
            $avatar1 = $request->old_avatar1;
            if ($request->avatar1) {
                if ($request->file('avatar1')->isValid() && $request->file('avatar1')->getClientSize() <= 4000000) { // 4mb
                    $avatar1 = md5(\Auth::user()->id.'rep1').'.'.$request->avatar1->extension();
                    // upload avatar
                    $request->avatar1->storeAs('temp', $avatar1);
                }
            }
            $avatar2 = $request->old_avatar2;
            if ($request->avatar2) {
                if ($request->file('avatar2')->isValid() && $request->file('avatar2')->getClientSize() <= 4000000) { // 4mb
                    $avatar2 = md5(\Auth::user()->id.'rep2').'.'.$request->avatar2->extension();
                    // upload avatar
                    $request->avatar2->storeAs('temp', $avatar2);
                }
            }
            
            // set old avatar in session
            return redirect('/farmer/register/organization')
                ->withInput()
                ->withErrors($validator)
                ->with([ // uploaded files
                    'old_logo' => $logo,
                    'old_avatar1' => $avatar1,
                    'old_avatar2' => $avatar2,
                ]);
        }
        //dd($request->all());

        // create business address
        $address = new \App\Address;
        $address->lot_type_id = $request->hometype;
        $address->house_num = strtoupper($request->street_number);
        $address->road = strtoupper($request->road_trace);
        $address->district_id = $request->town_village;
        $address->save();

        // save contact number and type
        $biz_phone = new \App\Contact;
        $biz_phone->contact = $request->biz_phone;
        $biz_phone->contact_type_id = 3;
        $biz_phone->save();

        // create organization
        $organization = new Organization;
        $organization->organization_name = strtoupper($request->org_name);
        $organization->organization_type = strtoupper($request->org_type);
        $organization->registration_num = strtoupper($request->reg_num);
        $organization->vat_reg_num = strtoupper($request->vat_num);
        $organization->email = $request->biz_email;
        $organization->contact_id = $biz_phone->id;
        $organization->address_id = $address->id;
        $organization->created_by = \Auth::user()->id;
        $organization->save();

        // create application
        $regType = \App\RegistrationType::where('slug',$request->job)->first();
        $application = new \App\Application;
        //$application->old_registration_num = strtoupper(html_entity_decode($request->oldregistration, ENT_QUOTES, 'UTF-8'));
        $application->app_type_id = $request->app_type;
        $application->registration_id = $regType->id;
        $application->application_date = $request->appdate;
        $application->created_by = \Auth::user()->id;
        $application->registering_county = \Auth::user()->county_id;
        $application->save();
        $application->application_num = '10'.\App\Districts::find($address->district_id)->ward->county->id.'00'.$application->id;
        $application->save();

        // link application to Organization
        $applicationOrg = new \App\ApplicationOrganization;
        $applicationOrg->app_id = $application->id;
        $applicationOrg->org_id = $organization->id;
        $applicationOrg->save();
       
        
        //if old reg/badge number is given
            if($request->oldregistration){
                $application->status_id = 6;
                $application->save();

                
                $org_county = \App\Districts::find($organization->address->district_id)->ward->county->id;

                $newfarmer = new Farmer;
                $newfarmer->registration_num = $this->generateRandomString();
                $newfarmer->old_badge_id = html_entity_decode($request->oldregistration, ENT_QUOTES, 'UTF-8');
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
               /* $newfarmer->registration_num = '2'.$org_county.$newfarmer->id;
                $newfarmer->save();*/
                /*FARMER REGISTRATION NUMBER FORMAT: 1-APP_ID-APP_YEAR-COUNTY-INCREMENT_NUMBER*/
                $newfarmer->registration_num = '2'.$org_county.Carbon::parse($application->created_at)->format('y').$application->id.$increment_for_id;
                $newfarmer->save();

            

                $farmerorganization = new FarmerOrganization;
                $farmerorganization->farmer_id = $newfarmer->id;
                $farmerorganization->org_id = $organization->id;
                $farmerorganization->save();

                $farmerbadge = new FarmerBadge;
                $farmerbadge->old_badge_id = strtoupper(html_entity_decode($request->oldregistration, ENT_QUOTES, 'UTF-8'));
                $farmerbadge->farmer_badge = $newfarmer->registration_num;
                $farmerbadge->date_issued = $request->dateofissue;
                $farmerbadge->farmer_id = $newfarmer->id;
                if( $application->app_type_id!=12){
                  $farmerbadge->colour_id = 1;  
              }else{
                $farmerbadge->colour_id = 2;
              };
                $farmerbadge->user_id = \Auth::user()->id;
                $farmerbadge->valid = 0;
                $farmerbadge->save();
            }

        // attach enterprises to application
        if ($request->majorminor) {
            foreach ($request->majorminor as $key => $value) {
                $enterprise = \App\Enterprise::where('slug',$key)->first(); // get enterprise id

                $appEnterprise = new \App\ApplicationEnterprise;
                $appEnterprise->enterprise_id = $enterprise->id;
                $appEnterprise->application_id = $application->id;
                $appEnterprise->type = $value;
                $appEnterprise->save();

                // handle other
                if ($key == 'other' && $request->other_name) {
                    // save other name
                    $entOther = new \App\EnterpriseOther;
                    $entOther->enterprise = strtoupper($request->other_name);
                    $entOther->application_id = $application->id;
                    $entOther->save();
                }
            }
        }

        //company representatives

        // save contact number and type
        $rep1_contact = new \App\Contact;
        $rep1_contact->contact = $request->contact1;
        $rep1_contact->contact_type_id = 3;
        $rep1_contact->save();

        $rep1 = new \App\Representative;
        $rep1->f_name = strtoupper($request->app_fname1);
        $rep1->l_name = strtoupper($request->app_sname1);
        $rep1->contact_id = $rep1_contact->id;
        $rep1->id_type_id = $request->id_type1;
        $rep1->id_num = strtoupper($request->id_num1);
        //$rep1->created_by = \Auth::user()->id;
        $rep1->save();

        $rep1_link = new \App\OrganizationRep;
        $rep1_link->org_id = $organization->id;
        $rep1_link->rep_id = $rep1->id;
        $rep1_link->save();

        // save contact number and type
        if($request->app_fname2 && $request->app_sname2){
            $rep2_contact = new \App\Contact;
            $rep2_contact->contact = $request->contact2;
            $rep2_contact->contact_type_id = 3;
            $rep2_contact->save();

            $rep2 = new \App\Representative;
            $rep2->f_name = strtoupper($request->app_fname2);
            $rep2->l_name = strtoupper($request->app_sname2);
            $rep2->contact_id = $rep2_contact->id;
            $rep2->id_type_id = $request->id_type2;
            $rep2->id_num = strtoupper($request->id_num2);
            //$rep2->created_by = \Auth::user()->id;
            $rep2->save();

            $rep2_link = new \App\OrganizationRep;
            $rep2_link->org_id = $organization->id;
            $rep2_link->rep_id = $rep2->id;
            $rep2_link->save();
        }
        // Parcel
        if ($request->parcel_lot_type) {
            foreach ($request->parcel_lot_type as $key => $value) {
                // address
                $parcelAddress = new \App\Address;
                $parcelAddress->lot_type_id = $request->parcel_lot_type[$key];
                $parcelAddress->house_num = strtoupper($request->parcel_street_number[$key]);
                $parcelAddress->road = strtoupper($request->parcel_road_trace[$key]);
                $parcelAddress->district_id = $request->parcel_town_village[$key];
                $parcelAddress->save();

                // save land parcel
                $land = new \App\Land;
                $land->address_id = strtoupper($parcelAddress->id);
                $land->area_amt = $request->parcel_area[$key];
                $land->area_type_id = $request->parcel_area_type[$key];
                $land->save();

                // save parcel
                $parcel = new \App\Parcel;
                $parcel->application_id = $application->id;
                $parcel->land_id = $land->id;
                $parcel->land_type_id = $request->land_type[$key];
                $parcel->tenure_code_id = $request->tenure[$key];
                $parcel->save();

                $untenanted = true;
                // proof codes
                if (isset($request->proof_codes[$key])) {
                    foreach ($request->proof_codes[$key] as $code => $on) {
                        $proof = new \App\ParcelProofOfInterest;
                        $proof->parcel_id = $parcel->id;
                        $proof->proof_of_int_id = $code;
                        $proof->save();

                        // upload documents for proof code
                        if (isset($request->proof_codes_file[$key][$code]))  {
                            sleep(2);
                            foreach ($request->proof_codes_file[$key][$code] as $file) {
                                if (!empty($file)) {
                                    $untenanted = false;
                                    $doc = \App\ProofOfInterestCode::where('id',$proof->proof_of_int_id)->pluck('proof')->first().'_'.$application->id.'_'.$parcel->id.'_'.md5($proof->id.'-'.$file->getClientOriginalName()).'.'.$file->extension();
                                    // upload document
                                    $file->storeAs('proofdocs', $doc);
                                    // save document to parcel
                                    $proofdocs = new \App\ParcelProofOfIntDocs;
                                    $proofdocs->parcel_proof_of_int_id = $proof->id;
                                    $proofdocs->document = $doc;
                                    $proofdocs->type = $file->extension();
                                    $proofdocs->save();
                                }
                            }
                        }
                    }
                }
                if($untenanted == true){
                    $application->untenanted = 1;
                                    $application->save();
                }

                // parcel crops/animals
                if ($request->parcel_type[$key]) {
                    foreach ($request->parcel_type[$key] as $ind => $value) {
                        $crops = new \App\ParcelTypeOfProduce;
                        $crops->parcel_id = $parcel->id;
                        $crops->parcel_type_id = $value;
                        $crops->specific_parcel = $request->animal_crop[$key][$ind];
                        $crops->amt = $request->parcel_amt[$key][$ind];
                        $crops->save();
                    }
                }

                 if ($request->comments[$key]){
                    $dfocomment = new \App\ApplicationUserComment;
                    $dfocomment->parcel_id = $parcel->id;
                    $dfocomment->district_id = $request->parcel_town_village[$key];
                    $dfocomment->comments = strtoupper($request->comments[$key]);
                    $dfocomment->date_of_verification = $request->dateofverification[$key];
                    $dfocomment->user_id = \Auth::user()->id;
                    $dfocomment->save();
                }
            }
        }

        // logo upload
        if ($request->logo) {
            if ($request->file('logo')->isValid()) {
                $logo = md5($organization->id).'.'.$request->logo->extension();
                // upload logo
                $request->logo->storeAs('public/logos', $logo);
                // save name to organization
                $organization->logo = $logo;
                $organization->save();
            }
        }else if ($request->old_logo && file_exists(public_path().'/storage/temp/'.$request->old_logo)) {
            $ext = explode('.',$request->old_logo);
            $logo = md5($organization->id).'.'.end($ext);

            Storage::move('public/temp/'.$request->old_logo, 'public/logos/'.$logo);
            // save name to organization
            $organization->logo = $logo;
            $organization->save();
        }

        // avatar upload
        if ($request->avatar1) {
            if ($request->file('avatar1')->isValid()) {
                $avatar1 = $organization->id.'_'.md5($organization->id.'rep1').'.'.$request->avatar1->extension();
                // upload avatar
                $request->avatar1->storeAs('public/avatars/reps', $avatar1);
                // save name to organization
                $rep1->avatar = $avatar1;
                $rep1->save();
            }
        }else if ($request->old_avatar1 && file_exists(public_path().'/storage/temp/'.$request->old_avatar1)) {
            $ext = explode('.',$request->old_avatar1);
            $avatar1 = $organization->id.'_'.md5($organization->id.'rep1').'.'.end($ext);

            Storage::move('public/temp/'.$request->old_avatar1, 'public/avatars/reps/'.$avatar1);
            // save name to organization
            $rep1->avatar = $avatar1;
            $rep1->save();
        }

        // avatar upload
        if ($request->avatar2) {
            if ($request->file('avatar2')->isValid()) {
                $avatar2 = $organization->id.'_'.md5($organization->id.'rep2').'.'.$request->avatar2->extension();
                // upload avatar
                $request->avatar2->storeAs('public/avatars/reps', $avatar2);
                // save name to organization
                $rep2->avatar = $avatar2;
                $rep2->save();
            }
        }else if ($request->old_avatar2 && file_exists(public_path().'/storage/temp/'.$request->old_avatar2)) {
            $ext = explode('.',$request->old_avatar2);
            $avatar2 = $organization->id.'_'.md5($organization->id.'rep2').'.'.end($ext);

            Storage::move('public/temp/'.$request->old_avatar2, 'public/avatars/reps/'.$avatar2);
            // save name to organization
            $rep2->avatar = $avatar2;
            $rep2->save();
        }
        /*/ delete temp avatar
        if(file_exists(public_path().'/storage/temp/'.session('old_avatar')))
            Storage::delete('temp/'.session('old_avatar'));*/

        session()->forget('app_type');
        return redirect('/organization/view/'.$organization->id)->with('success', ' Application Successful');
        //print_r($update);   */ 


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

public function editOrganizationView($id=0)
    {
        $organization = Organization::find($id);
        

        $data = array(
            'nav' => ['nav-funct','nav-funct-1'],
            'navFunctIn' => 'in',
            'title' => 'Organization/Company Edit',
            'type' => ['slug' => 'edit_farmer', 'type' => 'Organization/Company Edit'],
            'enterprises' => \App\Enterprise::all(),
            'lot_types' => \App\AddressLotType::ordered(),
            'genders' => \App\Gender::all(),
            'proof_codes' => \App\ProofOfInterestCode::ordered(),
            'tenure_codes' => \App\TenureCode::ordered(),
            'parcel_count' => 5,
            'parcel_types' => \App\ParcelType::all(),
            'land_types' => \App\LandType::ordered(),
            'area_types' => \App\AreaType::all(),
            'id_types' => \App\IdentificationType::all(),
            'emails' => \App\Individual::pluck('email'),
            'districts' => \App\Districts::ordered(),
            'n_ids' => \App\IndividualID::pluck('id_num'),
            'reg_nums' => \App\Organization::pluck('registration_num'),
            'vat_nums' => \App\Organization::pluck('vat_reg_num'),
            'old_reg_id' => \App\Farmer::pluck('old_badge_id'),
            'proof_mandatory' => proofMandatory(),
            'proof_optional' => proofOptional(),
            'proof_conditions' => proofOptionalCondition(),
            'shortlist' => shortlistCombos(),
            'application_types' => \App\ApplicationType::ordered(),
            'company' => $organization,
            
        );
        //dd(session('_old_input.app_type'));
        //return ($user->home()->id);  
        return view('company.edit', $data);
    }

     public function organizationEditInsert(Request $request)
    {
       

        /** Validation **/
        $validator = Validator::make($request->all(), [
            /** rules **/
            // type
            
            // company info
            'oldregistration' => '',
            'dateofissue' => 'required_with:oldregistration',
            'logo' => 'image|max:4000', // 4Mb
            'org_name' => 'required',
            'org_type' => 'required',
            'reg_num' => 'required',
            'vat_num' => 'required',
            'biz_email' => '',
            'biz_phone' => 'required|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            // address
            'hometype' => '',
            'street_number' => '',
            'road_trace' => '',
            'town_village' => '',
            //representatives
            
            
        ],[
            // custom messages
            'dateofissue.required_with' => 'The date field is required when a farmer registration number is supplied.',
            'org_name.required' => 'The organization name field is required.',
            'org_type.required' => 'The organization type field is required.',
            'reg_num.required' => 'The registration number field is required.',
            'vat_num.required' => 'The VAT registration number field is required.',
            'biz_phone.required' => 'The telephone number field is required.',

            'biz_phone.regex' => 'The telephone number format should be (xxx) xxx-xxxx.',
            'contact1.regex' => 'The contact format should be (xxx) xxx-xxxx.',
            'contact2.regex' => 'The contact format should be (xxx) xxx-xxxx.',

            'postaltype.required_without' => 'The postal lot type field is required when postal address is not the same as home address.',

            'contact.regex' => 'The home contact format should be (xxx) xxx-xxxx.',

           
        ]
        );

           // check for extra stuff
        $validator->after(function($validator)  use ($request) {

            //representatives rules
            // check for avatar
            

        });
        
        if ($validator->fails()) {
            // upload avatar to temp
            $logo = $request->old_logo;
            if ($request->logo) {
                if ($request->file('public/logo')->isValid() && $request->file('logo')->getClientSize() <= 4000000) { // 4mb
                    $logo = md5(\Auth::user()->id).'.'.$request->logo->extension();
                    // upload avatar
                    $request->logo->storeAs('public/temp', $logo);
                }
            }
           
            
            // set old avatar in session
            return redirect('/farmer/register/organization')
                ->withInput()
                ->withErrors($validator);
        }
        //dd($request->all());

        // create organization
        $organization = Organization::find($request->companyid);
        $organization->organization_name = $request->org_name;
        $organization->organization_type = $request->org_type;
        $organization->registration_num = $request->reg_num;
        $organization->vat_reg_num = $request->vat_num;
        $organization->email = $request->biz_email;        
        $organization->save();

        // create business address
        $address = \App\Address::find($organization->address->id);
        $address->lot_type_id = $request->hometype;
        $address->house_num = $request->street_number;
        $address->road = $request->road_trace;
        $address->district_id = $request->town_village;
        $address->save();

        
        // save contact number and type
        $biz_phone = \App\Contact::find($organization->contact_id);
        $biz_phone->contact = $request->biz_phone;
        $biz_phone->save();
        
        

      

        // logo upload
        if ($request->logo) {
            if ($request->file('logo')->isValid()) {
                $logo = md5($organization->id).'.'.$request->logo->extension();
                // upload logo
                $request->logo->storeAs('public/logos', $logo);
                // save name to organization
                $organization->logo = $logo;
                $organization->save();
            }
        }else if ($request->old_logo && file_exists(public_path().'/storage/temp/'.$request->old_logo)) {
            $ext = explode('.',$request->old_logo);
            $logo = md5($organization->id).'.'.end($ext);

            Storage::move('public/temp/'.$request->old_logo, 'public/logos/'.$logo);
            // save name to organization
            $organization->logo = $logo;
            $organization->save();
        }

    

       
        return redirect('/organization/view/'.$organization->id)->with('success', 'Application Successful');
        //print_r($update);   */ 


    }


    public function editOrganizationRepsView($id=0,$companyid=0)
    {
        $representative = \App\Representative::find($id);
        

        $data = array(
            'nav' => ['nav-funct','nav-funct-1'],
            'navFunctIn' => 'in',
            'title' => 'Organization/Company Edit',
            'type' => ['slug' => 'edit_farmer', 'type' => 'Organization/Company Representative Edit'],            
            'id_types' => \App\IdentificationType::all(),           
            'n_ids' => \App\IndividualID::pluck('id_num'),            
            'rep' => $representative,
            
        );
        //dd(session('_old_input.app_type'));
        //return ($user->home()->id);  
        return view('company.companyedit.companyrepedit.edit', $data);
    }

    public function organizationRepEditInsert(Request $request)
    {
        //dd($request->all());

        /** Validation **/
        $validator = Validator::make($request->all(), [
            /** rules **/
 
            //representatives
            'avatar1' => 'image|max:4000', // 4Mb
            'app_fname1' => 'required',
            'app_sname1' => 'required',
            'contact1' => 'required|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            'id_type1' => 'required',
            'id_num1' => 'required',
            
        ],[
           
            'contact1.regex' => 'The contact format should be (xxx) xxx-xxxx.',
            

           

            'app_fname1.required' => 'The first name field is required.',
            'app_sname1.required' => 'The surname field is required.',
            'contact1.required' => 'The contact field is required.',
            'id_type1.required' => 'The id type field is required.',
            'id_num1.required' => 'The id number field is required.',

          
        ]
        );

           // check for extra stuff
        $validator->after(function($validator)  use ($request) {

            //representatives rules
            // check for avatar
            if (!$request->avatar1 && !$request->old_avatar1) {
                $validator->errors()->add('avatar1', 'Picture is required.');
            }
           


        });
        
        if ($validator->fails()) {
            // upload avatar to temp
           
            $avatar1 = $request->old_avatar1;
            if ($request->avatar1) {
                if ($request->file('avatar1')->isValid() && $request->file('avatar1')->getClientSize() <= 4000000) { // 4mb
                    $avatar1 = md5(\Auth::user()->id.'rep1').'.'.$request->avatar1->extension();
                    // upload avatar
                    $request->avatar1->storeAs('public/temp', $avatar1);
                }
            }
           
            
            // set old avatar in session
            return redirect('/farmer/register/organization')
                ->withInput()
                ->withErrors($validator)
                ->with([ // uploaded files
                    'old_logo' => $logo,
                    'old_avatar1' => $avatar1,
                    
                ]);
        }
       //dd($request->all());

        //company representatives

        

        $rep1 = \App\Representative::find($request->repid);
        $rep1->f_name = $request->app_fname1;
        $rep1->l_name = $request->app_sname1;
        $rep1->id_type_id = $request->id_type1;
        $rep1->id_num = $request->id_num1;
        //$rep1->created_by = \Auth::user()->id;
        $rep1->save();
        // save contact number and type
        $rep1_contact = \App\Contact::find($rep1->contact_id);
        $rep1_contact->contact = $request->contact1;
        $rep1_contact->save();



        // avatar upload
        if ($request->avatar1) {
            if ($request->file('avatar1')->isValid()) {
                $avatar1 = $rep1->company->first()->id.'_'.md5($request->avatar1->getClientOriginalName()).'.'.$request->avatar1->extension();
                // upload avatar
                $request->avatar1->storeAs('public/avatars/reps', $avatar1);
                // save name to organization
                $rep1->avatar = $avatar1;
                $rep1->save();

            }
        }else if ($request->old_avatar1 && file_exists(public_path().'public/storage/temp/'.$request->old_avatar1)) {
            $ext = explode('.',$request->old_avatar1);
            $avatar1 = $rep1->company->first()->id.'_'.md5($request->avatar1->getClientOriginalName()).'.'.end($ext);

            Storage::move('public/temp/'.$request->old_avatar1, 'public/avatars/reps/'.$avatar1);
            // save name to organization
            $rep1->avatar = $avatar1;
            $rep1->save();
        }

        /*/ delete temp avatar
        if(file_exists(public_path().'/storage/temp/'.session('old_avatar')))
            Storage::delete('temp/'.session('old_avatar'));*/

        session()->forget('app_type');
        return redirect('/organization/view/'.$rep1->company->first()->id)->with('success', 'Application Successful');
        //print_r($update);   */ 


    }

}
