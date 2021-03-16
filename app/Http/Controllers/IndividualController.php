<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Storage;
use DB;
use App\Enterprise;
use App\FarmerBadge;
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
use App\Counties;
use App\TenureProofRelation;
use App\TenureProofRelOpt;
use App\ApplicationType;
use Carbon\Carbon;

class IndividualController extends Controller
{
    public function listing()
    {
        $county = \Auth::user()->countyid;
       

        $ind = \App\Individual::whereIn('id',
        DB::table('individuals')
        ->join('individual_address','individual_address.ind_id','=','individuals.id')
        ->join('addresses','addresses.id','=','individual_address.add_id')
        ->join('address_lot_types','address_lot_types.id','=','addresses.lot_type_id')
        ->join('districts','districts.id','=','addresses.district_id')
        ->join('wards','wards.id','=','districts.ward_id')
        ->join('counties','counties.id','=','wards.county_id')
        ->where('counties.id',$county)
        ->whereIn('individual_address.ind_add_type_id',[1,3])
        ->pluck('individuals.id')
        )->paginate(10);

        $data = array(
            'nav' => ['nav-funct','nav-funct-5'],
            'navFunctIn' => 'in',
            'title' => 'Individual List',
            'individuals' => $ind,

        );
        
        return view('individual.list', $data);
    }

    /*
    | testing ajax code to make application load faster
    |
    |
     */
    public function ajaxlisting()
    {
        $county = \Auth::user()->countyid;
       

        $ind = \App\Individual::whereIn('id',
        DB::table('individuals')
        ->join('individual_address','individual_address.ind_id','=','individuals.id')
        ->join('addresses','addresses.id','=','individual_address.add_id')
        ->join('address_lot_types','address_lot_types.id','=','addresses.lot_type_id')
        ->join('districts','districts.id','=','addresses.district_id')
        ->join('wards','wards.id','=','districts.ward_id')
        ->join('counties','counties.id','=','wards.county_id')
        ->where('counties.id',$county)
        ->whereIn('individual_address.ind_add_type_id',[1,3])
        ->pluck('individuals.id')
        )->paginate(10);

        $data = array(
            'nav' => ['nav-funct','nav-funct-5'],
            'navFunctIn' => 'in',
            'title' => 'Individual List',
            'individuals' => $ind,

        );
        
        return view('individual.ajax_ind_list', $data);
    }

    
    public function view($id=0)
    {
    	$user = Individual::find($id);
       //return $user->nationaliddoc;
        if(!$user) return back()->with('flashed', 'That Individual does not exist');
        $provider = $user->provider? $user->provider->count() : 0;
        $containapp = !empty($user->applications())? 1 : 0;
    	$data = array(
			'nav' => ['nav-funct', 'nav-funct-5'],
            'navFunctIn' => 'in',
			'title' => $user->name,
			'data' => $user,
            'appcount' => empty($user->applications()->count())? 0 : $user->applications()->count(),
            'applications' => $user->applications(),
            'rep_types' => \App\ReplacementType::all(),
            'counties' => Counties::all(),
            'provcount' => $provider,
            'containapp' => $containapp,
		);
		//return $user->applications();
        return view('individual.view', $data);
    }

    public function listingWebRegister()
    {
        $county = \App\Districts::find(\Auth::user()->district_id)->ward->county->id;
       

        $ind = \App\Individual::whereIn('id',
        DB::table('individuals')
        ->join('individual_address','individual_address.ind_id','=','individuals.id')
        ->join('addresses','addresses.id','=','individual_address.add_id')
        ->join('address_lot_types','address_lot_types.id','=','addresses.lot_type_id')
        ->join('districts','districts.id','=','addresses.district_id')
        ->join('wards','wards.id','=','districts.ward_id')
        ->join('counties','counties.id','=','wards.county_id')
        ->where('counties.id',$county)
        ->where('individuals.created_online', 1)
        ->whereIn('individual_address.ind_add_type_id',[1,3])
        ->whereNull('districts.deleted_at')
        ->pluck('individuals.id')
        )->paginate(10);

        $data = array(
            'nav' => ['nav-funct','nav-funct-5'],
            'navFunctIn' => 'in',
            'title' => 'Individual List',
            'individuals' => $ind,

        );
        
        return view('individual.list', $data);
    }
    

    public function viewBadge($id=0)
    {
        $user = Individual::find($id);
       
        if(!$user) return back()->with('flashed', 'That Individual does not exist');

        $data = array(
            'nav' => ['nav-funct', 'nav-funct-5'],
            'navFunctIn' => 'in',
            'data' => $user,
            'rep_types' => \App\ReplacementType::all(),
            'avatarpath'=> $user->avatar,
            'farmertype' => 'Individual',
        );
        
        return view('individual.userbadge', $data);
    }
    public function edit($id=0)
    {
        $user = Individual::find($id);
        if(!$user) return back()->with('flashed', 'That Individual does not exist');

        $data = array(
            'nav' => ['nav-funct', 'nav-funct-5'],
            'navFunctIn' => 'in',
            'title' => $user->name,
            'data' => $user,
            'rep_types' => \App\ReplacementType::all(),
            'genders' => Gender::all(),
            'emails' => Individual::pluck('email'),
            'n_ids' => IndividualID::pluck('id_num'),
            'individuals' => Individual::all(),
        );
        
        return view('individual.edit', $data);
    }

    public function searchName(Request $request)
    {
        /*if($request->ajax())
        {
            $individuals= Individual::where('f_name','LIKE',"%{$request->search_ind}%")->get();
            if($individuals)
            {
                //return $individuals;
                return view('individual.tableindividual', compact('individuals'));
            }
        }*/

        if($request->searchtype == 1)

            return Individual::where(DB::raw("CONCAT(`f_name`, ' ', `l_name`)"),'LIKE',$request->q.'%')->orWhere(DB::raw("CONCAT(`l_name`, ' ', `f_name`)"),'LIKE',$request->q.'%')->get();
        elseif($request->searchtype == 2){
            return \App\IndividualID::where('id_num','LIKE',$request->q.'%')->get();
        }
        elseif($request->searchtype == 3){
            if(is_numeric($request->q))
                return \App\FarmerBadge::where('farmer_badge','LIKE',$request->q.'%')->get();
            else
               return \App\FarmerBadge::where('old_badge_id','LIKE',html_entity_decode($request->q, ENT_QUOTES, 'UTF-8').'%')->get(); 
        }

    }

    public function search(Request $request)
    {

        if($request->ajax())
        {
            //return $request->search_type;
            if($request->search_type == 1){
                if (!empty($request->search_ind)) {

                    $splitName = explode(' ', $request->search_ind, 2); // Restricts it to only 2 values, for names like Billy Bob Jones

                    $first_name = $splitName[0];
                    $last_name = !empty($splitName[1]) ? $splitName[1] : ''; // If last name doesn't exist, make it empty
                    $individuals= Individual::where('f_name','=',$first_name)
                                    ->where('l_name','=',$last_name)
                                    ->get();
                    if($individuals)
                    {
                        //return $individuals;
                        return view('individual.tableindividual', compact('individuals'));
                    }
                    else
                        return False;
                }
            }
            //end search 1
            elseif ($request->search_type == 2) {
                 $individuals= \App\Individual::whereIn('id',
                                        DB::table('individuals')
                                        ->join('individual_ids','individuals.id','=','individual_ids.individual_id')
                                        ->where('individual_ids.id_num', $request->search_ind)
                                        ->pluck('individuals.id')
                                    )->get();
                if($individuals)
                    {
                        //return $individuals;
                        return view('individual.tableindividual', compact('individuals'));
                    }
                    else
                        return False;
            }
            // end search 2
            elseif ($request->search_type == 3) {
                if (!empty($request->search_ind)) {
                    $farmbadge = FarmerBadge::where('old_badge_id','=',html_entity_decode($request->search_ind, ENT_QUOTES, 'UTF-8'))->first();
                    //return html_entity_decode($request->search_ind, ENT_QUOTES, 'UTF-8');
                    if($farmbadge){
                        
                        $farmer = $farmbadge->farmer()->first();
                        
                        if($farmer){
                            $individual = \App\FarmerIndividual::where('farmer_id',$farmer->id)->first();
                            $organization = \App\FarmerOrganization::where('farmer_id',$farmer->id)->first();
                            if ($individual) 
                                $individuals = \App\Individual::where('id',$individual->ind_id)->get();
                            elseif($organization)
                                $individuals = \App\Organization::where($organization->org_id)->get();
                            else
                                $individuals = 0;
                           //$individuals = $farmer->farmer();
                            if($individuals){
                                return view('individual.tableindividual', compact('individuals'));
                                //return $individuals;
                            }
                            else
                                return False; 
                        }
                        else
                            return False;

                        
                    }
                    else
                        return False;
                    
                    //return $individuals? $individuals:$farmer;
                }
                else{
                    return False;
                }                
            }
            //end search 3    
            
        }

           

    }

    

    

}
