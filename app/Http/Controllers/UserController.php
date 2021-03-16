<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\FarmerRegExport;
use App\FarmerExistReference;
use App\Districts;
use App\IndividualID;
use \App\Individual;
use App\Address;
use App\AddressLotType;
use App\IndividualAddress;
use DB;
use \App\ParcelTypeOfProduce;
use App\ParcelProofOfInterest;
use App\OldFarmerId;
use App\Commodities;
use App\FarmerPicExport;
use App\FarmerPrivateExport;
use Carbon\Carbon;
use \App\FarmerBadge;
use App\Application;
use App\PrintBadge;
use App\PrintRasBadge;
use \App\Farmer;
use App\StatelandUprn;
use \App\CommodityYieldStd;


class UserController extends Controller
{

    public function disable_listing()
    {
        $data = array(
            'nav' => ['nav-tab','nav-tab-6'],
            'navTabInt' => 'in',
            'title' => 'User Listing',
            'userlists' => \Auth::user()->role_id == 7? \Auth::user()->DisableUsersList : \Auth::user()->DisableUsersListCounty,
        );
        //return \Auth::user()->DisableUsersList;
        return view('countyuser.userdisable', $data);
    }




    public function destroy($id =0)
    {
        $this->softdeleteuser($id);
        $data = array(
            'nav' => ['nav-tab','nav-tab-1'],
            'navTabIn' => 'in',
            'title' => 'User Listing',
        );  
        if(User::withTrashed()->find($id)){
           return redirect('/user/view/disable/list')->with('message', ' User account disabled.');
       }
       else{
           return redirect('/user/view/disable/list')->with('message', ' User account not disabled.');
       }

   }

    protected function softdeleteuser($userId)
    {
      $user = User::find($userId); 
      $user->delete();
      $user->save();  

    }
    public function notifications(Request $request)
    {
      //return $request->user_id;
          $setNotif = User::find($request->user_id);
          $setNotif->show_notif = 1;
          $setNotif->save();
       
           return redirect('/home');
      
        

   }

   public function viewProfile(Request $request)
    {
      $data = array(
            'nav' => ['nav-tab','nav-tab-1'],
            'navTabIn' => 'in',
            'title' => 'User Listing',
            'user' => User::findOrFail($request->id),
        );
        //return \Auth::user()->DisableUsersList;
        return view('countyuser.view', $data);
   }

   public function countyStaffList()
    {
      $data = array(
            'nav' => ['nav-tab','nav-tab-1'],
            'navTabInt' => 'in',
            'title' => 'User Listing',
            'userlist' => \Auth::user()->role_id == 6? \Auth::user()->DfoAA3Assigned : \Auth::user()->DfoAssigned,
        );
        //return \Auth::user()->DisableUsersList;
        return view('countyuser.list', $data);
        //return 'bob';
   }

   /*add commodities*/
   public function newCommodity()
    {
      $comm_group = \App\CommodityGroup::all('CommodityGROUPID','CommodityGroupName');
      $comm_harvest_type = \App\CommodityHarvestType::all();
      $data = array(
            'nav' => ['nav-tab','nav-tab-1'],
            'navTabInt' => 'in',
            'title' => 'Add New Commodity',
            'commoditygroups' => $comm_group,
            'commharvtyps' => $comm_harvest_type,
            
        );
        //return $comm_harvest_type;
        return view('countyuser.add_commodity', $data);
        //return 'bob';
   }

   public function insertNewCommodity(Request $request)
    {

        //dd($request->all());//remove this line
        $commodity = new \App\Commodities;
        $comm_yield = new CommodityYieldStd;
        //----------save comodity--------------------
        $commodity->CommodityLocalName = $request->commodityname;
        $commodity->CommodityGROUPID = $request->commoditygroup;
        if ($request->variety) {
          $commodity->variety = strtoupper($request->variety);
        }
        else{
          $commodity->variety = 'General';
        }
        if ($request->sci_name) {
          $commodity->CommoditySciNamespp = strtoupper($request->sci_name);
        }
        if ($request->sci_name_class) {
         $commodity->CommoditySciNameclass = strtoupper($request->sci_name_class);
        }
        $commodity->save();
        //-----------save comm yeilds----------------
        $comm_yield->commodity_id = $commodity->id; 
        $comm_yield->comm_harvest_id = $request->harvest_type;
        $comm_yield->area_planted_ha = $request->area_planted;
        $comm_yield->created_by = \Auth::user()->id;
        if ($request->quarter_yield) {
          $comm_yield->avg_yield_quarter_kg = $request->quarter_yield;
        }
        if ($request->bi_annual_yield) {
          $comm_yield->avg_yield_biannual_kg = $request->bi_annual_yield;
        }
        if ($request->annual_yield) {
         $comm_yield->avg_yield_annual_kg = $request->annual_yield;
        }
        $comm_yield->save();

        //return view('home.dashboard', $data);
   }
   /*end add commodities*/

   /*add commodity yields*/
   public function newCommodityYield()
    {
      $comm = \App\Commodities::all('id','CommodityLocalName');
      $comm_harvest_type = \App\CommodityHarvestType::all();
      $data = array(
            'nav' => ['nav-tab','nav-tab-3'],
            'navTabInt' => 'in',
            'title' => 'Add New Commodity Yield Data',
            'commodities' => $comm,
            'commharvtyps' => $comm_harvest_type,
            
        );
        //return $comm_harvest_type;
        return view('countyuser.add_commodity_yeilds', $data);
        //return 'bob';
   }

   public function insertNewCommodityYield(Request $request)
    {
        //return redirect()->back();
        //dd($request->all());//remove this line
        $comm_yield = new CommodityYieldStd;
        $comm_yield->commodity_id = $request->commodity; 
        $comm_yield->comm_harvest_id = $request->harvest_type;
        $comm_yield->area_planted_ha = $request->area_planted;
        $comm_yield->created_by = \Auth::user()->id;
        if ($request->quarter_yield) {
          $comm_yield->avg_yield_quarter_kg = $request->quarter_yield;
        }
        if ($request->bi_annual_yield) {
          $comm_yield->avg_yield_biannual_kg = $request->bi_annual_yield;
        }
        if ($request->annual_yield) {
         $comm_yield->avg_yield_annual_kg = $request->annual_yield;
        }
        $comm_yield->save();

        return redirect()->back();
        //return view('countyuser.add_commodity_yeilds', $data);
   }

   /*end commodity yeilds*/


    public function adminStuff()
    {
      /*die();
      return redirect('/home');*/
      ini_set('max_execution_time', '200000');
      $puprns = \App\ParcelUprn::all();
      foreach ($puprns as $puprn) {
        $uprn = StatelandUprn::find($puprn->uprn_id);
        $app = Application::find($puprn->app_id);
        $uprn->parcel_id = $app->parcels->first()->id;
        $uprn->save();
      }
      //-----------import gps-------------//
        /*$recs = \App\GpsImport::all();
        foreach ($recs as $rec) {
          
          $inds = \App\Parcel::whereIn('id',
          DB::table('parcels')
          ->join('applications','applications.id','=','parcels.application_id')
          ->join('application_individual','application_individual.app_id','=','applications.id')
          ->join('individuals','individuals.id','=','application_individual.ind_id')
          ->where(DB::raw("CONCAT(individuals.f_name, ' ',individuals.l_name)"), 'LIKE', "%".$rec->name."%")
          ->orWhere(DB::raw("CONCAT(individuals.f_name, ' ',individuals.m_name, ' ',individuals.l_name)"), 'LIKE', "%".$rec->name."%")
          ->where('applications.registering_county','=',1)
          ->pluck('parcels.id')
          )->get();
          
          foreach ($inds as $key => $ind) {
            $ind->easting = $rec->easting;
            $ind->northing = $rec->northing;
            $ind->longitude = $rec->longitude;
            $ind->latitude = $rec->latitude;
            $ind->maplink = "http://maps.google.com/maps?&z=20&t=k&q=".$rec->longitude."+".$rec->latitude;
            $ind->save();
            $rec->delete();
            
          }
          
        }*/
      //------------end gps------------------//
      //------------stad---------------//
      /*$sls = \App\StadList::all();
      foreach ($sls as $sl) {
        //return $sl;
        $farmerbadge = FarmerBadge::where('old_badge_id','like','%'.$sl->farmer_num.'%')->first();
        if ($farmerbadge) {
          //return $farmerbadge;
          $badgeyr = $sl->year_;//get year from that table
          $oldnum = substr($farmerbadge->old_badge_id,0,11);//get part of old badge
          $newnum = $oldnum.$badgeyr;//concatenate to create new badge
          //return $newnum;
          $farmerbadge->old_badge_id = $newnum;
          $farmerbadge->date_issued = $sl->year_.'-01-01';
          $farmerbadge->valid = 1;
          $farmerbadge->save();
          $sl->delete();
          //return $farmerbadge;
        }
      }*/
      //------------------------------------------add crop id to produce--// table---------------------------------------------------//
      
      /*$ptps = \App\ParcelTypeOfProduce::all();
      foreach ($ptps as $ptp) {
        if ($ptp->commodity_id == 0) {
          if(Commodities::where('CommodityLocalName','=',trim($ptp->specific_parcel))->first()){
            $ptp->commodity_id = Commodities::where('CommodityLocalName','=',trim($ptp->specific_parcel))->first()->id;
          $ptp->save();
          //return Commodities::where('CommodityLocalName','=',trim($ptp->specific_parcel))->get(). ' '.$ptp;
          }
          
          
        }
       
      }*/
      //-----------------------------------------------end crop---// prod---------------------------------------------------------//
      //---------------------------------------------begin caro-----------------------------------------------------------//
      /*$out;
      //return 'f';
      $fers = FarmerExistReference::all();
      //return $fers;    
      //if (strtotime($fers->issue_date)== FALSE) {
                      //return $fers;
                    //}       
                  foreach ($fers as $fer) {
                    
                      if($fer->IndividualId() !== 'false'){//find indi id
                        DB::beginTransaction();//BEGIN THE PROCESS
                        try{
                        //return explode(",",$fer->commodity);
                        $individual = Individual::findOrFail($fer->IndividualId());//find indi
                        //return $individual;
                        $farmer = $individual->farmer();//check if farmer record exist
                        if ($farmer) {
                          //return $farmer;
                          $farmerbadge = $farmer->badge();//find badge record
                          if ($farmerbadge) {//if badge record exist
                            if ($farmerbadge->old_badge_id) {//check if old badge
                              $badgeyr = $fer->year_;//get year from that table
                              $oldnum = substr($farmerbadge->old_badge_id,0,11);//get part of old badge
                              $newnum = $oldnum.$badgeyr;//concatenate to create new badge
                              if ((int)substr($farmerbadge->old_badge_id,11,14) < (int)$badgeyr) {
                                //if year is less than year from that table then update and save
                                $farmerbadge->old_badge_id = $newnum;
                                if (strtotime($fer->issue_date) !== FALSE) {

                                    $farmerbadge->date_issued = Carbon::parse($fer->issue_date)->format('Y-m-d');
                                  
                                  
                                }
                                $farmerbadge->save();
                                if((int)$badgeyr == 2019){
                                  //do some stuff like update crops
                                }
                              }
                              //return substr($farmerbadge->old_badge_id,11,14);
                              //return $newnum.' '.substr($farmerbadge->old_badge_id,11,14);
                            }
                            else{//add badge number
                              $regnum = $fer->reg_num;
                              if(strlen($fer->reg_num)==1){
                                $regnum = '0000'.$fer->reg_num;
                              }
                              elseif(strlen($fer->reg_num)==2){
                                $regnum = '000'.$fer->reg_num;
                              }
                              elseif(strlen($fer->reg_num)==3){
                                $regnum = '00'.$newfarmer->id;
                              }
                              elseif(strlen($fer->reg_num)==4){
                                $regnum = '0'.$fer->reg_num;
                              }
                              $farmerbadge->old_badge_id = 'CARO/'.$regnum.'/'.$fer->year_;;
                              $farmerbadge->save();
                            }
                            
                          }
                        }
                        $fer->delete();
                        DB::commit();
                        } catch (Exception $e) {
                        DB::rollBack();

                        }
                      }
                      
                      //return false;
                    
      };
*/
      //-----------------------------------------end caro---------------------------------------------------------------//
      /*$prbs = \App\PrintRASBadge::all();
      foreach ($prbs as $prb) {
        //return $prb->badge_id;
        $farmerbadge = FarmerBadge::where('farmer_badge', '=', $prb->badge_id)->first();
        if ( $farmerbadge) {
          $farmer = Farmer::where('id', $farmerbadge->farmer_id)->first();
          if ($farmer) {
            $individual = $farmer->farmer();
            if ($individual) {
              $application = $individual->applications()->first();
              if ($application) {
                $county = \App\Counties::find($application->registering_county);
                //return $county->slug;
                $prb->county = $county->slug;
                $prb->save();
              }
              
        
            }
        
          }
        
        }
        
      }*/
              
      /*Individual::chunk(400, function($individuals){           
                  foreach ($individuals as $individual) {
                    
                      
                      if($individual->farmer()){
                        $farmer = $individual->farmer();
                        if($farmer->badge()){
                          $application = $individual->applications()->first();
                          $badge=$farmer->badge();
                          $ind_county = \App\Districts::find($individual->home()->district_id)->ward->county->county_index;
                          $increment_for_id = $badge->id;
                          if(strlen($badge->id)==1){
                            $increment_for_id = '00000'.$badge->id;
                          }
                          elseif(strlen($badge->id)==2){
                            $increment_for_id = '0000'.$badge->id;
                          }
                          elseif(strlen($badge->id)==3){
                            $increment_for_id = '000'.$badge->id;
                          }
                          elseif(strlen($badge->id)==4){
                            $increment_for_id = '00'.$badge->id;
                          }
                          elseif(strlen($badge->id)==5){
                            $increment_for_id = '0'.$badge->id;
                          }
                          //FARMER REGISTRATION NUMBER FORMAT: 1-APP_ID-APP_YEAR-COUNTY-INCREMENT_NUMBER
                          $prevnumber = $badge->farmer_badge;
                          $badge->farmer_badge = '1'.$ind_county.Carbon::parse($application->created_at)->format('y').$increment_for_id;
                          $badge->save();
                          $farmer->registration_num = $badge->farmer_badge;
                          $farmer->save();
                         

                          $printbadge = PrintBadge::where('badge_id',$prevnumber)->first();
                          if($printbadge){
                            $printbadge->badge_id=$badge->farmer_badge;
                            $printbadge->save();

                          }
                          

                          $printbadge2 = PrintRasBadge::where('badge_id',$prevnumber)->first();
                          if($printbadge2){
                            $printbadge2->badge_id=$badge->farmer_badge;
                            $printbadge2->save(); 
                          }
                                        
                        }
                          
                      }
                    
                  }

              });*/
     

      return redirect('/home');
      /*----------------------------------------------------------------------------------------------------------------------*/
        /*$out;
        FarmerPicExport::chunkById(400, function ($fpes) use(&$out) {
            foreach ($fpes as $f) {
              //$out = $f;
              if($f->individualid()){
               
                 $i = $f->individualid();
                 if($i->entity()->first()){
                  $individual = $i->entity()->first();
                    
                   DB::beginTransaction();
                   try{
                          //sql inserts
                          if(basename($individual->avatar) == "blank.png") {
                           $out = basename($individual->avatar);
                            $individual->avatar = $f->Description.".jpeg";
                            $individual->save();
                            //delete record from farmer app export table
                              $f->delete();  
                              
                          }
                          DB::commit();
                            
                    } catch (Exception $e) {
                        DB::rollBack();

                      }
                 }
              }
              //$user->delete();
            }

             
             
          });
          
          //return $out;
          return redirect('/home');*/
        /*----------------------------------------------------------------------------------------------------------------------*/
          /*----------------------------------------------------------------------------------------------------------------------*/
           /*FarmerRegExport::chunk(250, function($exports){           
                  foreach ($exports as $export) {
                         // create individual
                         $dis = Districts::where('district', 'like' ,$export->DistrictName)->first();
                         $indNId = IndividualID::where('id_num', '=', $export->NationalIDCardNumber);
                         $indPPId = IndividualID::where('id_num', '=', $export->PassportNumber);

                         if($indNId->count() >=1){
                          //return $indNId->id_num;
                         }
                          elseif($indPPId->count() >=1){
                            //return $indPPId->id_num;
                          }
                          else{
                              if ($dis){

                                  $individual = new Individual;
                                  $individual->f_name = strtoupper($export->FirstName);
                                  $individual->m_name = strtoupper($export->MiddleName);
                                  $individual->l_name = strtoupper($export->LastName);
                                  $individual->alias = strtoupper($export->AliasName);
                                  $individual->gender_slug = $export->Sex;
                                  $individual->dob = $export->dob;
                                  $individual->email = $export->Email;
                                  $individual->created_by = \Auth::user()->id;
                                  $individual->save();

                                  $address = new Address;
                                  $address->lot_type_id = AddressLotType::where('lot_type','like',$export->MainAddressNumberType)->first()->id;
                                  $address->house_num = strtoupper($export->MainAddressNumber);
                                  $address->road = strtoupper($export->MainAddress1);
                                  $address->district_id = $dis->id;
                                  $address->save();

                                  // check if postal address is same as home


                                  // link address and individual
                                  $indAddress = new IndividualAddress;
                                  $indAddress->ind_id = $individual->id;
                                  $indAddress->add_id = $address->id;
                                  $indAddress->ind_add_type_id = 3;
                                  $indAddress->save();

                                  if ($export->NationalIDCardNumber) {
                                  // save id
                                      $dp = new IndividualID;
                                      $dp->individual_id = $individual->id;
                                      $dp->id_type_id = 1;
                                      $dp->id_num = $export->NationalIDCardNumber;
                                      $dp->save();
                                  }
                                  if ($export->DriversPermitNumber) {
                                  // save id
                                      $dp = new IndividualID;
                                      $dp->individual_id = $individual->id;
                                      $dp->id_type_id = 2;
                                      $dp->id_num = $export->DriversPermitNumber;
                                      $dp->save();
                                  }
                                  if ($export->PassportNumber) {
                                  // save id
                                      $dp = new IndividualID;
                                      $dp->individual_id = $individual->id;
                                      $dp->id_type_id = 3;
                                      $dp->id_num = $export->PassportNumber;
                                      $dp->save();
                                  }
                          
                              }

                          }

                         
                      
                 
             

                  }

              });*/

          /*----------------------------------------------------------------------------------------------------------------------*/

            /*$tests = DB::table('parcel_types_of_produce')->where('specific_parcel','like','%,%')->get();

            foreach ($tests as $key => $value){
                foreach ($yrrr = array_reverse(explode(',', $value->specific_parcel)) as $key2 => $value2) {
                   if($key2<=count($yrrr)-2){
                    $newtype = new ParcelTypeOfProduce;
                    $newtype->parcel_id =  $value->parcel_id;
                    $newtype->parcel_type_id =  $value->parcel_type_id;
                    $newtype->specific_parcel =  $value2;
                    $newtype->amt =  $value->amt;
                    $newtype->save();

                   }
                   else{
                    $crop = ParcelTypeOfProduce::find($value->id);
                    if(isset($crop)){
                        $crop->specific_parcel = $value2;
                        $crop->save();
                    }
                                       
                   }

                }
               
            };*/

          /*----------------------------------------------------------------------------------------------------------------------*/

              /*$addresses = \App\Address::whereIn('id',DB::table('addresses')
                      ->join('districts','districts.id','=','addresses.district_id')
                      ->join('wards','wards.id','=','districts.ward_id')
                      ->join('counties','counties.id','=','wards.county_id')
                      ->where('counties.id', 1)
                      ->pluck('addresses.id')       
                      )->get();
              foreach ($addresses as $key => $address) {
                //return $address1->district->district;
                $address->road = $address->road.', '.$address->district->district;
                $address->save();
              }*/
          /*----------------------------------------------------------------------------------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------------------*/

            //$fapp = \App\FarmerAppExport::all();//GET ALL DATA FROM TABLE
            
            /*foreach ($fapp as $key => $f) {//LOOP THRU REACH RECORD
              $district = \App\Districts::where('district',$f->MainCity)->first();
              if($district){//IF CITY EXIST IN FARM DB
                if($f->individualid()){//CHECK IF INDIVIDUAL ID EXISTS IN FARMER DB
                  $i = $f->individualid();//IF IT DOES SET IT TO A VATIABLE
                  if($i->entity()->first()){//IF ID IS ASSIGNED TO A PERSON
                    $individual = $i->entity()->first();//ASSIGN TO A VARIABLE: THE PERSONS DETAILS
                    $app_exists = \App\ApplicationIndividual::where('ind_id',$individual->id)->first();//check if app exists for individual
                    
                    if($app_exists){//if application alread exists
                      DB::beginTransaction();//BEGIN THE PROCESS
                      try{
                        
                        // address
                          $parcelAddress = new \App\Address;
                          $parcelAddress->lot_type_id = \App\AddressLotType::where('lot_type', $f->MainAddressNumberType)->first()->id;
                          $parcelAddress->house_num = strtoupper($f->MainAddressNumber);
                          $parcelAddress->road = strtoupper($f->MainAddress1);
                          $parcelAddress->district_id = $district->id;
                          $parcelAddress->save();
                        // save land parcel
                          $land = new \App\Land;
                          $land->address_id = $parcelAddress->id;
                          $land->area_amt = $f->EstimatedTotalCertified >= 0.01? $f->EstimatedTotalCertified: $f->EstimatedTotalAcreage;
                          $land->area_type_id = 1;
                          $land->save();
                          
                        // save parcel
                          $parcel = new \App\Parcel;
                          $parcel->application_id = $app_exists->app_id;
                          $parcel->land_id = $land->id;
                          $parcel->land_type_id = 7;
                          $parcel->tenure_code_id = 10;
                          $parcel->save();
                        //delete record from farmer app export table
                          $f->delete();
                        DB::commit();
                      } catch (Exception $e) {
                          DB::rollBack();

                        }
                    }else{
                      
                      $address = $individual->address;//GET ADDRESS OF THE INDIVIDUAL
                      if ($address->district->ward->county){//IF THE DISTRICT HAS A COUNTY
                        DB::beginTransaction();//BEGIN THE PROCESS
                        try{
                          // create application
                            $application = new \App\Application;
                            $application->app_type_id = 17;
                            $application->registration_id = 2;
                            $application->created_by = 1;
                            $application->registering_county = $address->district->ward->county->id;
                            $application->status_id = 6;
                            $application->save();
                            
                            $application->application_num = '10'.$address->district->ward->county->id.'00'.$application->id;
                            $application->save();
                            
                            //$application = DB::table('users')->insertGetId(
                              //[
                                //'app_type_id' => 'john@example.com', 
                                //'registration_id' => 0,
                                //'created_by' => 'john@example.com', 
                                //'registering_county' => 0,
                                //'application_num' => 'john@example.com', 
                               
                              //]
                            //);

                          // link application to individual
                            $applicationInd = new \App\ApplicationIndividual;
                            $applicationInd->app_id = $application->id;
                            $applicationInd->ind_id = $individual->id;
                            $applicationInd->save();
                          // address
                            $parcelAddress = new \App\Address;
                            $parcelAddress->lot_type_id = \App\AddressLotType::where('lot_type', $f->MainAddressNumberType)->first()->id;
                            $parcelAddress->house_num = strtoupper($f->MainAddressNumber);
                            $parcelAddress->road = strtoupper($f->MainAddress1);
                            $parcelAddress->district_id = $district->id;
                            $parcelAddress->save();
                          // save land parcel
                            $land = new \App\Land;
                            $land->address_id = $parcelAddress->id;
                            $land->area_amt = $f->EstimatedTotalCertified >= 0.01? $f->EstimatedTotalCertified: $f->EstimatedTotalAcreage;
                            $land->area_type_id = 1;
                            $land->save();
                            
                          // save parcel
                            $parcel = new \App\Parcel;
                            $parcel->application_id = $application->id;
                            $parcel->land_id = $land->id;
                            $parcel->land_type_id = 7;
                            $parcel->tenure_code_id = 10;
                            $parcel->save();
                          //delete record from farmer app export table
                            $f->delete();
                          DB::commit();
                        } catch (Exception $e) {
                          DB::rollBack();

                        }
                      }
                    }//end if app exists
                  }//end if assinged to person
                }//end if individual id exist
              }
            }*/
            
            //return $f->individualid()->entity()->first(); //$i->entity()->first();




            /*$farmerapp = DB::table('farmer_app_exports')
            ->join('individual_ids',function ($join) {
            $join->on('farmer_app_exports.NationalIDCardNumber', '=', 'individual_ids.id_num')->orOn('farmer_app_exports.DriversPermitNumber', '=', 'individual_ids.id_num')->orOn('farmer_app_exports.PassportNumber', '=', 'individual_ids.id_num');
            })
            ->join('individual_ids.individual_id', '=','individuals.id' )
            ->get();*/




        /*------------------------------------------------------------------------------------------------------------*/

         /*OldFarmerId::chunk(250, function($fid){           
            foreach ($fid as $f) {
              $cApp = 0;
              $cFarm = 0;
              $cDistrict = 0;
              if($f->individualid()){//CHECK IF INDIVIDUAL ID EXISTS IN FARMER DB
                $i = $f->individualid();//IF IT DOES SET IT TO A VATIABLE
                if($i->entity()->first()){//IF ID IS ASSIGNED TO A PERSON
                  $individual = $i->entity()->first();//ASSIGN TO A VARIABLE: THE PERSONS DETAILS
                  $app_exists = \App\ApplicationIndividual::where('ind_id',$individual->id)->first();//check if app exists for individual
                  $district = \App\Districts::find($individual->home()->district_id);//check if district exists
                  $farmer_exists = \App\FarmerIndividual::where('ind_id',$individual->id)->first();//check if farmer record exists for individual
                  if($district){
                    $cDistrict = 1;
                  }
                  if($app_exists){//if application already exists
                   $cApp = 1;
                  }//end if app exists
                          
                  if($farmer_exists){//if farmer already exists 

                  }
                  else{
                     $cFarm = 1;//set check to 1
                  }//end if farmer exists
                  //---------insert into the tables---------//
                    DB::beginTransaction();//BEGIN THE PROCESS
                    try{
                          //sql inserts
                            //------------------------application update--------------------------//
                              if($cApp==1 && $cFarm == 1 && $cDistrict == 1){
                                $application = \App\Application::where('id', $app_exists->app_id)->first();
                                $application->old_registration_num = $f->farmer_id;
                                $application->save();

                              //------------------------farmer inserts--------------------------//
                                    $ind_county = $district->ward->county->county_index;

                                    $newfarmer = new \App\Farmer;//new record
                                    $newfarmer->registration_num = 1;//set temp badge
                                    $newfarmer->old_badge_id = $f->farmer_id;//record old number
                                    $newfarmer->save();//save
                                    //create new increment number
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
                                    //FARMER REGISTRATION NUMBER FORMAT: 1-APP_ID-APP_YEAR-COUNTY-INCREMENT_NUMBER//
                                    $newfarmer->registration_num = '1'.$ind_county.Carbon::parse($application->created_at)->format('y').$application->id.$increment_for_id;
                                    $newfarmer->save();

                                  //farmer individual link
                                    $farmerindividual = new \App\FarmerIndividual;
                                    $farmerindividual->farmer_id = $newfarmer->id;
                                    $farmerindividual->ind_id = $individual->id;
                                    $farmerindividual->save();

                                  //farmer badge
                                    $farmerbadge = new \App\FarmerBadge;
                                    $farmerbadge->old_badge_id = $f->farmer_id;
                                    $farmerbadge->farmer_badge = $newfarmer->registration_num;
                                    $farmerbadge->date_issued = $f->OldMinistryRegistrationDate;
                                    $farmerbadge->farmer_id = $newfarmer->id;
                                    if( $application->app_type_id!=12){
                                      $farmerbadge->colour_id = 1;  
                                    }else{
                                      $farmerbadge->colour_id = 2;
                                    };
                                    $farmerbadge->user_id = 1;
                                    $farmerbadge->valid = 0;
                                    $farmerbadge->save(); 

                                  //delete record from farmer app export table
                                    $f->delete();  

                                  }//end farmer record




                                  DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();

                      }
                           //----end inserts----//

                }//end if assinged to person
              }//end if individual id exist

            }

          });*/

        /*----------------------------------------end old farmer insert--------------------------------------------------------------------*/
          
        //return FarmerPicExport::find(2);
        /*$fapp = FarmerPicExport::all();
        return $fapp;*/


    }
}
