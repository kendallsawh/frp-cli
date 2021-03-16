<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator; 
use Illuminate\Support\Collection;
use App\RegistrationType;
use App\ApplicationType;
use App\Application;
use App\Farmer;
use App\FarmerIndividual;
use App\FarmerBadge;
use App\FarmerExistReference;
use App\Individual;
use Validator;
use DB;
use Carbon\Carbon;

class FarmerController extends Controller
{



    public function paginate($items, $perPage = 10, $page = null,$pageName = 'page', $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
        'path' => LengthAwarePaginator::resolveCurrentPath(),
        'pageName' => $pageName,
      ]);
    }
    public function listing()
    {

        $ind = \App\Farmer::whereIn('id',DB::table('farmers')
                    ->join('farmer_individual','farmer_individual.farmer_id','=','farmers.id')
                    ->join('individuals','individuals.id','=','farmer_individual.ind_id')
                    ->join('individual_address','individual_address.ind_id','=','individuals.id')
                    ->join('addresses','addresses.id','=','individual_address.add_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->join('counties','counties.id','=','wards.county_id')
                    ->where('counties.id', \Auth::user()->countyid)
                    ->pluck('farmers.id')       
                    )->get();

        $org = \App\Farmer::whereIn('id',DB::table('farmers')
                    ->join('farmer_organization','farmer_organization.farmer_id','=','farmers.id')
                    ->join('organizations','organizations.id','=','farmer_organization.org_id')
                    ->join('addresses','addresses.id','=','organizations.address_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->join('counties','counties.id','=','wards.county_id')
                    ->where('counties.id', \Auth::user()->countyid)
                    ->pluck('farmers.id')       
                    )->get();

        $farmer = $ind->merge($org);
        $farmer = $this->paginate($farmer);
        

        $data = array(
            'nav' => ['nav-funct','nav-funct-3'],
            'navFunctIn' => 'in',
            'title' => 'Farmer List',
            'farmers' => $farmer,
            );
        

        /*$emptyorg = \App\FarmerOrganization::first();
        if($emptyorg == null){
            
        };*/
        //return (Farmer::all());
        

        return view('farmer.list', $data);
    }

    public function ajax_listing()
    {

        $ind = \App\Farmer::whereIn('id',DB::table('farmers')
                    ->join('farmer_individual','farmer_individual.farmer_id','=','farmers.id')
                    ->join('individuals','individuals.id','=','farmer_individual.ind_id')
                    ->join('individual_address','individual_address.ind_id','=','individuals.id')
                    ->join('addresses','addresses.id','=','individual_address.add_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->join('counties','counties.id','=','wards.county_id')
                    ->where('counties.id', \Auth::user()->countyid)
                    ->pluck('farmers.id')       
                    )->get();

        $org = \App\Farmer::whereIn('id',DB::table('farmers')
                    ->join('farmer_organization','farmer_organization.farmer_id','=','farmers.id')
                    ->join('organizations','organizations.id','=','farmer_organization.org_id')
                    ->join('addresses','addresses.id','=','organizations.address_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->join('counties','counties.id','=','wards.county_id')
                    ->where('counties.id', \Auth::user()->countyid)
                    ->pluck('farmers.id')       
                    )->get();

        $farmer = $ind->merge($org);
        $farmer = $this->paginate($farmer);
        

        $data = array(
            'nav' => ['nav-funct','nav-funct-3'],
            'navFunctIn' => 'in',
            'title' => 'Farmer List',
            'farmers' => $farmer,
            );
        return view('farmer.ajax_fmr_list', $data);
    }

    public function register()
    {
        $data = array(
            'nav' => ['nav-funct','nav-funct-1'],
            'navFunctIn' => 'in',
            'title' => 'Farmer Registration',
            'registration_types' => RegistrationType::ordered(),
            /*'individuals' => \App\Individual::all(),
            'organizations' => \App\Organization::all(),*/
            );
        
        return view('farmer.register', $data);
    }

    public function servProviderExistFarm(){
        ini_set('max_execution_time', '900');
        $ind = \App\Individual::whereIn('id',
        DB::table('individuals')
        ->join('individual_address','individual_address.ind_id','=','individuals.id')
        ->join('addresses','addresses.id','=','individual_address.add_id')
        ->join('address_lot_types','address_lot_types.id','=','addresses.lot_type_id')
        ->join('districts','districts.id','=','addresses.district_id')
        ->join('wards','wards.id','=','districts.ward_id')
        ->join('counties','counties.id','=','wards.county_id')
        ->where('counties.id',\Auth::user()->countyid)
        ->whereIn('individual_address.ind_add_type_id',[1,3])
        ->pluck('individuals.id')
        )->get();
        $data = array(
        'individuals' => $ind,
        'organizations' => \App\Organization::all()->take(1),
        );

        
        //return 'hello';
        return view('farmer.entitytable', compact('data'));
         //return response()->json(array("exists" => '<p>true<p>'));
    }

    public function listreference($id=0){
        $user = Individual::find($id);

        

        if (!$user->nationalid == 0){
            $userid = $user->nationalid;
        }
        elseif(!$user->driverid  == 0){
            $userid = $user->driverid;
        }
        elseif (!$user->passportid  == 0) {
            $userid = $user->passportid;
        }
        else{
            $userid = 0;
        }
        
        /*->orWhere('first_name', $user->f_name)
        ->orWhere('last_name', $user->l_name)*/

        /*$farmerreference = FarmerExistReference::where('individual_id','LIKE', '%'.$userid.'%')
        ->orWhere('first_name', $user->f_name)
        ->orWhere('last_name', $user->l_name)
        ->distinct()->get();
*/
        $farmerreference = FarmerExistReference::all();
        if(!$user) return back()->with('flashed', 'That Individual does not exist');
        $data = array(
            'nav' => ['nav-funct','nav-funct-3'],
            'navFunctIn' => 'in',
            'title' => 'Farmer Reference List',
            'farmerreferences' => $farmerreference,
            );
        //return ($userid);
        return view('farmer.farmerreference', $data);
    }

    
    // method for new registration selection
    public function type(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'newexist' => 'required',
            'farmertype' => '',
            'selected' => '',
        ]);
        $msg = 'Please select a valid application type.';
        
        if ($validator->fails()) {
            return redirect('/farmer/register')
            ->withInput()
            ->withErrors($validator)
            ->with('flashed', $msg);
        }
        //return "fff";
        return redirect()->route('farmerRegisterProvider')->with(['data' => $request->all()]);
    }

    //tester
    public function tester()
    {
        $data = array(
            'applications' => Application::all(),
        );
        return view('farmer.replacement.replacement', $data);
    }

    public function addindfarmer(Request $request)
    {
        //return dd($request->all());
        // check if farmer exists
        //$farmerexist = $farmer->farmer();
        if (FarmerIndividual::where('ind_id',$request->individual_id)->exists() == False)
        {
           $ind = \App\Individual::find($request->individual_id);
           $ind_county = \App\Districts::find($ind->home()->district_id)->ward->county->county_index;

           $farmer = FarmerIndividual::where('ind_id',$request->individual_id);
           $application = $ind->applications()->first();

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
            $newfarmer->registration_num = '1'.$ind_county.Carbon::parse($application->created_at)->format('y').$application->id.$increment_for_id;
            $newfarmer->save();
            
            //return view('individual.view', $request->view_id->toArray());

            $farmerindividual = new FarmerIndividual;
            $farmerindividual->farmer_id = $newfarmer->id;
            $farmerindividual->ind_id = $request->individual_id;
            $farmerindividual->save();

            $farmerbadge = new FarmerBadge;
            $farmerbadge->old_badge_id = html_entity_decode(strtoupper($request->oldregistration), ENT_QUOTES, 'UTF-8');
            $farmerbadge->farmer_badge = $newfarmer->registration_num;
            $farmerbadge->date_issued = $request->dateofissue;
            $farmerbadge->farmer_id = $newfarmer->id;
            if( $ind->app_type_id !== 12){
                  $farmerbadge->colour_id = 1;
              }else{
                $farmerbadge->colour_id = 2;
              };
            $farmerbadge->user_id = \Auth::user()->id;
            //add if statement to check date of issue to determin if badge will be valid
            $farmerbadge->valid = 1;
            $farmerbadge->save();
        
            return redirect('/individual/view/'.$ind->id)->with('success', ' Added as farmer.');
        }
        else{
          return redirect('/individual/view/'.$ind->id)->with('flashed', ' Farmer badge record found for this farmer.');
        }
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
                    $farmers= \App\Farmer::whereIn('id',
                                    DB::table('farmers')
                                    ->join('farmer_individual','farmer_individual.farmer_id','=','farmers.id')
                                    ->join('individuals','individuals.id','=','farmer_individual.ind_id')
                                    ->where('individuals.f_name','=',$first_name)
                                    ->where('individuals.l_name','=',$last_name)
                                    ->pluck('farmers.id')
                                    )->get();
                    if($farmers)
                    {
                        //return $farmers->farmer();
                        return view('farmer.tablefarmer', compact('farmers'));
                    }
                    else
                        return False;
                }
            }
            //end search 1
            elseif ($request->search_type == 2) {
                 $farmers= \App\Individual::whereIn('id',
                                        DB::table('individuals')
                                        ->join('individual_ids','individuals.id','=','individual_ids.individual_id')
                                        ->where('individual_ids.id_num', $request->search_ind)
                                        ->pluck('individuals.id')
                                    )->get()->first()->farmer();
                if($farmers)
                    {
                        //return $individuals;
                        return view('farmer.tablefarmer', compact('farmers'));
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
                        
                        $farmers = $farmbadge->farmer()->first();
                        
                        if($farmers){
                            
                           
                            
                                return view('farmer.tablefarmer', compact('farmers'));
                                //return $individuals;
                            
                           
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
