<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Storage;
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
use App\Farmer;
use App\ServiceProvider;
use App\PrintBadge;
use App\PrintRASBadge;
use App\Counties;
use \App\Commodities;
use Carbon\Carbon;
use DB;

class ProviderRegisterController extends Controller
{

     public function registerProvider()
    {
        //return "dfd";
        if (!session('data')) return redirect('/farmer/register')->with('flashed', 'Please restart process');
        
        $post = session('data');
        isset($post['selected'])? $indorg = explode('-', $post['selected']) : $indorg = [0 => '', 1 => ''];
        isset($post['farmertype'])? $farmertype = $post['farmertype'] : $farmertype = '';
        isset($post['newexist'])? $newexist = $post['newexist'] : $newexist = '';
        //return "dfd";
        // farmers and their lands
        //$farmers = Farmer::all();
        //$lands = [];
        /*foreach ($farmers as $farmer) {
            if ($farmer->farmer()){
                $parcels = $farmer->farmer()->parcels();
            foreach ($parcels as $parcel) {
                $lands[$farmer->registration_num][] = \App\Land::find($parcel->land_id);
            }
            }
            
        }*/
        //dd($lands);

        $data = [
            'nav' => ['nav-funct','nav-funct-1'],
            'navFunctIn' => 'in',
            'title' => 'Service Provider',
            'type' => ['slug' => 'new_farmer', 'type' => 'Service Provider'],
            'genders' => Gender::all(),
            'newexist' => $newexist,
            'farmertype' => $farmertype,
            'indorg' => $indorg[0],
            'indorg_id' => $indorg[1],
            'reg_nums' => \App\Organization::pluck('registration_num'),
            'vat_nums' => \App\Organization::pluck('vat_reg_num'),
            'biz_emails' => \App\Organization::pluck('email'),
            'rec_count' => 5,   // recommendation count = 5
            'id_types' => \App\IdentificationType::all(),
            'lot_types' => AddressLotType::ordered(),
            'emails' => Individual::pluck('email'),
            'districts' => Districts::ordered(),
            //'n_ids' => IndividualID::pluck('id_num'),
            'old_reg_id' => \App\Farmer::pluck('old_badge_id'),
            'shortlist' => shortlistCombos(),

            // not used but necessary for scripts file
            'proof_mandatory' => proofMandatory(),
            'proof_optional' => proofOptional(),
            'proof_conditions' => proofOptionalCondition(),
            'parcel_types' => ParcelType::all(),
            'parcel_count' => 5,
            'animal_crops' => Commodities::orderBy('CommodityLocalName','asc')->get(),
        ];
        //dd(session('_old_input.app_type'));  
        return view('provider.register', $data);
    }
    
    public function insertProvider(Request $request)
    {
        //dd($request->all());

        /** Validation **/
        $validator = Validator::make($request->all(), [
            /** rules **/
            // type
            'job' => 'required',
            "newexist" => 'required',
            "farmertype" => '',
            "indorg" => '',
            "indorg_id" => '',
            // service
            "reg_number" => '',
            "chasis_number" => 'required',
            "cert_copy" => 'required',
            "rec_count" => '',
            "farmer" => 'required|array',
            "proof_doc" => 'required|array',
            "land" => 'required|array',
            "date" => 'required|array',

            // Individual
            // personal info
            'avatar' => 'image|max:4000', // 4Mb
            'dateofbirth' => 'date|before_or_equal:'.Carbon::now(),
            'alias' => '',
            'firstname' => '',
            'middlename' => '',
            'lastname' => '',
            'gender' => 'exists:genders,slug',
            'email' => 'nullable|unique:individuals,email|email',
            'homenumber' => 'nullable|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            'mobilenumber' => 'nullable|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            'n_id' => 'nullable|unique:individual_ids,id_num|digits:11',
            'passport' => '',
            //'dp' => 'required_without_all:n_id,passport',
            'emergencynumber' => 'nullable|regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            // address
            'hometype' => '',
            'street_number' => '',
            'road_trace' => '',
            'town_village' => '',
            // postal
            'postal_checkbox' => '',
            'postaltype' => '',
            'street_number2' => '',
            'road_trace2' => '',
            'town_village2' => '',

            // Organization
            // company info
            'logo' => 'image|max:4000', // 4Mb
            'org_name' => '',
            'org_type' => '',
            'reg_num' => 'unique:organizations,registration_num',
            'vat_num' => 'unique:organizations,vat_reg_num',
            'biz_email' => 'unique:organizations,email|email',
            'biz_phone' => 'regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            //representatives
            'avatar1' => 'image|max:4000', // 4Mb
            'app_fname1' => '',
            'app_sname1' => '',
            'contact1' => 'regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            'id_type1' => '',
            'id_num1' => '',
            'avatar2' => 'image|max:4000', // 4Mb
            'app_fname2' => '',
            'app_sname2' => '',
            'contact2' => 'regex:/^[(]{1}[0-9]{3}[)]{1} [0-9]{3}-[0-9]{4}$/',
            'id_type2' => '',
            'id_num2' => '',
        ],[
            // custom messages
            'postaltype.required_without' => 'The postal lot type field is required when postal address is not the same as home address.',
            'street_number2.required_without' => 'The street number field is required when postal address is not the same as home address.',
            'road_trace2.required_without' => 'The road/street/trace field is required when postal address is not the same as home address.',
            'town_village2.required_without' => 'The town/village/settlement field is required when postal address is not the same as home address.',
            'n_id.unique' => 'The national id has already been taken.',
            'n_id.digits' => 'The national id must be 11 digits.',
            'dateofbirth.date' => 'The date of birth is not a valid date.',
            'dateofbirth.before_or_equal' => 'The date of birth must be a date before or equal to today.',
            'parcels_added.required' => 'There are no parcels.',
            'homenumber.regex' => 'The home contact format should be (xxx) xxx-xxxx.',
            'mobilenumber.regex' => 'The mobile contact format should be (xxx) xxx-xxxx.',
            'emergencynumber.regex' => 'The emergency number format should be (xxx) xxx-xxxx.',
            'n_id.required_without_all' => 'Select at least one type of identification.',
            //'dp.required_without_all' => 'Select at least one type of identification.',
            'passport.required_without_all' => 'Select at least one type of identification.',
        ]
        );

        // check for extra stuff
        $validator->after(function($validator)  use ($request) {
            // check for avatar
            /*if (!$request->avatar && !$request->old_avatar) {
                $validator->errors()->add('avatar', 'Picture is required.');
            }

            // check age 18 and over
            if ($request->dateofbirth)
                if (strtotime($request->dateofbirth)) // check if is a date
                    if (Carbon::parse($request->dateofbirth)->age < 18)
                        $validator->errors()->add('dateofbirth', 'Applicant must be 18 years or older.');*/

            $d = false; $e = false;

            for ($i = 1; $i <= $request->rec_count; $i++) {
                $farmer = \App\FarmerBadge::where('farmer_badge', $request->farmer[$i])
            ->orWhere('old_badge_id',html_entity_decode($request->farmer[$i], ENT_QUOTES, 'UTF-8'))
            ->get();
                //$farmer = $request->farmer[$i];
                $date = $request->date[$i];
                $land = isset($request->land[$i])? $request->land[$i] : null;
                $proof = isset($request->proof_doc[$i])? $request->proof_doc[$i] : null;

                if (!$farmer || !$proof) {
                    $validator->errors()->add('rec_msg', 'Please make sure that '.$request->rec_count.' recommendations are uploaded and the farmer is selectd.');
                }else if(!$farmer){
                    $e = true;
                }
                if (!$land) {
                    $validator->errors()->add('farmer.'.$i, 'Please select farmer land.');
                }
                if (!$date) {
                    $validator->errors()->add('date.'.$i, 'Please enter recommendation date.');
                }

                // check for duplication
                $o = '';
                /*foreach ($farmers as $key => $value) {
                    if ($value == $farmer) $o = $key;
                }
                for ($n = 0; $n <= $request->rec_count; $n++) {
                    if ($o != $n) {
                        if (isset($farmers[$n])) {
                            if ($farmer == $farmers[$n]) {
                                $d = true;
                            }
                        }
                    }
                }*/
            }
            if ($d) { // duplicates
                $validator->errors()->add('rec_msg2', 'Please make sure the farmers are not duplicated.');
            }
            if ($e) { // doesn't exist
                $validator->errors()->add('rec_msg3', 'Please only select farmers from the suggested list.');
            }

        });
        
        if ($validator->fails()) {
            // upload avatar to temp
            $avatar = $request->old_avatar;
            if ($request->avatar) {
                if ($request->file('avatar')->isValid() && $request->file('avatar')->getClientSize() <= 4000000) { // 4mb
                    $avatar = md5(\Auth::user()->id).'.'.$request->avatar->extension();
                    // upload avatar
                    $request->avatar->storeAs('temp', $avatar);
                }
            }
            
            // set old avatar in session
            return redirect('/farmer/register/provider/')
                ->withInput()
                ->withErrors($validator)
                ->with([ // uploaded files
                    'old_avatar' => $avatar,
                    'data' => 'data',
                ]);
        }
        //dd($request->all());

        // individual/organization from form

        $ind = $org = $request->indorg_id;

        // create service provider
        $provider = new ServiceProvider;
        $provider->registration_num = $request->reg_number;
        $provider->chassis_num = $request->chasis_number;
        $provider->created_by = \Auth::user()->id;
        $provider->reg_county = \Auth::user()->countyid;
        $provider->save();

        // certified copy upload
        if ($request->cert_copy) {
            if ($request->file('cert_copy')->isValid()) {
                $cert = md5($provider->id).'.'.$request->cert_copy->extension();
                // upload certified copy
                $request->cert_copy->storeAs('public/cert_copy', $cert);
                // save name to provider
                $provider->certified_copy = $cert;
                $provider->save();
            }
        }

        if ($request->newexist == 'new') {

            // create address
            $address = new Address;
            $address->lot_type_id = $request->hometype;
            $address->house_num = $request->street_number;
            $address->road = $request->road_trace;
            $address->district_id = $request->town_village;
            $address->save();

            if ($request->farmertype == 'ind') {
            // create Individual
                $individual = new Individual;
                $individual->f_name = $request->firstname;
                $individual->m_name = $request->middlename;
                $individual->l_name = $request->lastname;
                $individual->alias = $request->alias;
                $individual->gender_slug = $request->gender;
                $individual->dob = $request->dateofbirth;
                $individual->email = $request->email;
                $individual->created_by = \Auth::user()->id;
                $individual->save();

                // to attach to service provider
                $ind = $individual->id;

                if($request->oldregistration){
                    $provider->status_id = 6;
                    $provider->save();


                    $ind_county = \App\Districts::find($individual->home()->district_id)->ward->county->id;

                    $newfarmer = new Farmer;
                    $newfarmer->registration_num = $this->generateRandomString();
                    $newfarmer->old_badge_id = html_entity_decode(strtoupper($request->oldregistration), ENT_QUOTES, 'UTF-8');
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
                    /*FARMER REGISTRATION NUMBER FORMAT: 1-APP_ID-APP_YEAR-COUNTY-INCREMENT_NUMBER*/
                    $newfarmer->registration_num = '3'.$ind_county.Carbon::parse($provider->created_at)->format('y').$provider->id.$increment_for_id;
                    $newfarmer->save();


                    

                    $farmerbadge = new FarmerBadge;
                    $farmerbadge->old_badge_id = html_entity_decode($request->oldregistration, ENT_QUOTES, 'UTF-8');
                    $farmerbadge->farmer_badge = $newfarmer->registration_num;
                    $farmerbadge->date_issued = $request->dateofissue;
                    $farmerbadge->farmer_id = $newfarmer->id;
                    $farmerbadge->colour_id = 1;  
                    $farmerbadge->user_id = \Auth::user()->id;
                    $farmerbadge->valid = 0;
                    $farmerbadge->save();
                }

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
                    $postal->house_num = $request->street_number2;
                    $postal->road = $request->road_trace2;
                    $postal->district_id = $request->town_village2;
                    $postal->save();

                    // link postal address and individual
                    $postalAddress = new IndividualAddress;
                    $postalAddress->ind_id = $individual->id;
                    $postalAddress->add_id = $postal->id;
                    $postalAddress->ind_add_type_id = '2';
                    $postalAddress->save();
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
                    $n_id = new IndividualID;
                    $n_id->individual_id = $individual->id;
                    $n_id->id_type_id = 1;
                    $n_id->id_num = $request->n_id;
                    $n_id->save();
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
                    // save id
                    $passport = new IndividualID;
                    $passport->individual_id = $individual->id;
                    $passport->id_type_id = 3;
                    $passport->id_num = $request->passport;
                    $passport->save();
                }

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
                    $avatar = md5($individual->id).'.'.end($ext);

                    Storage::move('temp/'.$request->old_avatar, 'avatars/'.$avatar);
                    // save name to individual
                    $individual->avatar = $avatar;
                    $individual->save();
                }
            }

            if ($request->farmertype == 'org') {
                // save contact number and type
                $biz_phone = new \App\Contact;
                $biz_phone->contact = $request->biz_phone;
                $biz_phone->contact_type_id = 3;
                $biz_phone->save();

                // create organization
                $organization = new \App\Organization;
                $organization->organization_name = $request->org_name;
                $organization->organization_type = $request->org_type;
                $organization->registration_num = $request->reg_num;
                $organization->vat_reg_num = $request->vat_num;
                $organization->email = $request->biz_email;
                $organization->contact_id = $biz_phone->id;
                $organization->address_id = $address->id;
                $organization->created_by = \Auth::user()->id;
                $organization->save();

                // to attach to service provider
                $org = $organization->id;


                if($request->oldregistration){
                    $provider->status_id = 6;
                    $provider->save();

                    
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
                    
                    /*FARMER REGISTRATION NUMBER FORMAT: 1-APP_ID-APP_YEAR-COUNTY-INCREMENT_NUMBER*/
                    $newfarmer->registration_num = '3'.$org_county.Carbon::parse($provider->created_at)->format('y').$provider->id.$increment_for_id;
                    $newfarmer->save();

                

                    $farmerorganization = new FarmerOrganization;
                    $farmerorganization->farmer_id = $newfarmer->id;
                    $farmerorganization->org_id = $organization->id;
                    $farmerorganization->save();

                    $farmerbadge = new FarmerBadge;
                    $farmerbadge->old_badge_id = html_entity_decode($request->oldregistration, ENT_QUOTES, 'UTF-8');
                    $farmerbadge->farmer_badge = $newfarmer->registration_num;
                    $farmerbadge->date_issued = $request->dateofissue;
                    $farmerbadge->farmer_id = $newfarmer->id;
                    if( $application->app_type_id!=12){
                      $farmerbadge->colour_id = 1;  
                  }else{
                    $farmerbadge->colour_id = 2;
                  };
                    $farmerbadge->colour_id = 1;
                    $farmerbadge->user_id = \Auth::user()->id;
                    $farmerbadge->valid = 0;
                    $farmerbadge->save();
                }

                //company representatives

                // save contact number and type
                $rep1_contact = new \App\Contact;
                $rep1_contact->contact = $request->contact1;
                $rep1_contact->contact_type_id = 3;
                $rep1_contact->save();

                $rep1 = new \App\Representative;
                $rep1->f_name = $request->app_fname1;
                $rep1->l_name = $request->app_sname1;
                $rep1->contact_id = $rep1_contact->id;
                $rep1->id_type_id = $request->id_type1;
                $rep1->id_num = $request->id_num1;
                //$rep1->created_by = \Auth::user()->id;
                $rep1->save();

                $rep1_link = new \App\OrganizationRep;
                $rep1_link->org_id = $organization->id;
                $rep1_link->rep_id = $rep1->id;
                $rep1_link->save();

                // save contact number and type
                $rep2_contact = new \App\Contact;
                $rep2_contact->contact = $request->contact2;
                $rep2_contact->contact_type_id = 3;
                $rep2_contact->save();

                $rep2 = new \App\Representative;
                $rep2->f_name = $request->app_fname2;
                $rep2->l_name = $request->app_sname2;
                $rep2->contact_id = $rep2_contact->id;
                $rep2->id_type_id = $request->id_type2;
                $rep2->id_num = $request->id_num2;
                //$rep2->created_by = \Auth::user()->id;
                $rep2->save();

                $rep2_link = new \App\OrganizationRep;
                $rep2_link->org_id = $organization->id;
                $rep2_link->rep_id = $rep2->id;
                $rep2_link->save();

                // logo upload
                if ($request->logo) {
                    if ($request->file('logo')->isValid()) {
                        $logo = md5($organization->id).'.'.$request->logo->extension();
                        // upload logo
                        $request->logo->storeAs('logos', $logo);
                        // save name to organization
                        $organization->logo = $logo;
                        $organization->save();
                    }
                }else if ($request->old_logo && file_exists(public_path().'/storage/temp/'.$request->old_logo)) {
                    $ext = explode('.',$request->old_logo);
                    $logo = md5($organization->id).'.'.end($ext);

                    Storage::move('temp/'.$request->old_logo, 'logos/'.$logo);
                    // save name to organization
                    $organization->logo = $logo;
                    $organization->save();
                }

                // avatar upload
                if ($request->avatar1) {
                    if ($request->file('avatar1')->isValid()) {
                        $avatar1 = md5($organization->id.'rep1').'.'.$request->avatar1->extension();
                        // upload avatar
                        $request->avatar1->storeAs('avatars', $avatar1);
                        // save name to organization
                        $rep1->avatar = $avatar1;
                        $rep1->save();
                    }
                }else if ($request->old_avatar1 && file_exists(public_path().'/storage/temp/'.$request->old_avatar1)) {
                    $ext = explode('.',$request->old_avatar1);
                    $avatar1 = md5($organization->id.'rep1').'.'.end($ext);

                    Storage::move('temp/'.$request->old_avatar1, 'avatars/'.$avatar1);
                    // save name to organization
                    $rep1->avatar = $avatar1;
                    $rep1->save();
                }

                // avatar upload
                if ($request->avatar2) {
                    if ($request->file('avatar2')->isValid()) {
                        $avatar2 = md5($organization->id.'rep2').'.'.$request->avatar2->extension();
                        // upload avatar
                        $request->avatar2->storeAs('avatars', $avatar2);
                        // save name to organization
                        $rep2->avatar = $avatar2;
                        $rep2->save();
                    }
                }else if ($request->old_avatar2 && file_exists(public_path().'/storage/temp/'.$request->old_avatar2)) {
                    $ext = explode('.',$request->old_avatar2);
                    $avatar2 = md5($organization->id.'rep2').'.'.end($ext);

                    Storage::move('temp/'.$request->old_avatar2, 'avatars/'.$avatar2);
                    // save name to organization
                    $rep2->avatar = $avatar2;
                    $rep2->save();
                }
            }
        }
        
        // attach to individual/organization
        if ($request->farmertype == 'ind' || $request->indorg == 'ind') {
            DB::table('service_provider_individual')->insert(['provider_id' => $provider->id, 'ind_id' => $ind]);
        }else if ($request->farmertype == 'org' || $request->indorg == 'org') {
            DB::table('service_provider_organization')->insert(['provider_id' => $provider->id, 'org_id' => $org]);
        }

        // recommendations
        foreach ($request->farmer as $key => $val) {
            // upload proof
            if ($request->proof_doc[$key]) {
                if ($request->file('proof_doc')[$key]->isValid()) {
                    $proof_doc = md5($provider->id.'proof_doc'.$key).'.'.$request->proof_doc[$key]->extension();
                    // upload proof doc
                    $request->proof_doc[$key]->storeAs('public/proof_doc', $proof_doc);
                }
            }
            $names = explode(' ',$request->name[$key],2);
            $rec = new \App\Recommendation;
            $rec->farmer_id = $request->farmer[$key];
            
            $rec->f_name = $names[0];
            $rec->l_name = $names[1];
            
            $rec->provider_id = $provider->id;
            //$rec->land_id = $request->land[$key][$theid->farmer_badge];
            $rec->address = $request->land[$key];
            $rec->district_id = $request->sp_town_village[$key];
            $rec->proof_doc = $proof_doc;
            $rec->date = $request->date[$key];
            $rec->save();
        }

        return redirect('/provider/view/'.$provider->id)->with('success', 'Application successful');
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
    Search farmers by badgge number during registration. ajax/bloodhound call
     */
    public function searchBadge(Request $request)
    {   
        
       
        if(is_numeric($request->q))
            return \App\FarmerBadge::where('farmer_badge','LIKE',$request->q.'%')->get(['farmer_badge AS badgenum', 'farmer_id']);
        else
            return \App\FarmerBadge::where('old_badge_id','LIKE',html_entity_decode($request->q, ENT_QUOTES, 'UTF-8').'%')->get(['old_badge_id AS badgenum','farmer_id']);
        
    }
    /*
    search for land?
    */
    public function checkfrmnum(Request $request){
        $searchnum = $request->input('searchnum');

        if(is_numeric($request->input('searchnum'))){
            $isExists = \App\FarmerBadge::where('farmer_badge','LIKE',$searchnum.'%')->get(['farmer_badge']);
        }
        else{
            $searchnum = urldecode($request->input('searchnum'));
            $isExists = \App\FarmerBadge::where('old_badge_id','LIKE',$searchnum.'%')->get(['farmer_badge']);
        }
        if($isExists){
            
            return response()->json(array("exists" => true, "farmer_id" => $isExists->first()->farmer_badge));
        }
    }

    
    
    /*
    |
    |get the parcels of the farmers that sent the letter. Farmers mst be registered.
    |
    */
    public function search(Request $request)
    {

        if($request->ajax())
        {
            $searchterm = $request->search_sp;
            if(is_numeric($searchterm)){
                $searchterm = urldecode($searchterm);
                $farmer = \App\FarmerBadge::where('farmer_badge',$searchterm)->first();
                $parcels = $farmer->farmer()->first()->farmer()->parcels();
                foreach ($parcels as $parcel) {
                $lands[$farmer->registration_num][] = \App\Land::find($parcel->land_id);
                }
                $i = $request->farmernum;
                $farmerid = $farmer->farmer_badge;
                return view('provider.register.sp_parceladdress', compact('lands','i','farmerid'));
                //return compact('lands','i','farmerid');
            }
            else{
                
                $searchterm = urldecode($request->search_sp);
                $farmer = \App\FarmerBadge::where('old_badge_id',$searchterm)->first();
                
                $parcels = $farmer->farmer()->first()->farmer()->parcels();
                foreach ($parcels as $parcel) {
                $lands[$farmer->registration_num][] = \App\Land::find($parcel->land_id);
                }
                $i = $request->farmernum;
                $farmerid = $farmer->farmer_badge;
                return view('provider.register.sp_parceladdress', compact('lands','i','farmerid'));
            }
            
            
        }

           

    }

  
}
