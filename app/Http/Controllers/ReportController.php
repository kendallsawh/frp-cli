<?php

namespace App\Http\Controllers;

use App\Application;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use \App\Region;
use \App\Counties;
use \App\Districts;
use \App\Wards;
use \App\Commodities;
use \App\ParcelTypeOfProduce;
use \App\User;
use Carbon\Carbon;
use \App\Land;
use \App\Parcel;
use \App\LandType;
use \App\Individual;
use \App\FarmingDistrict;
use \App\CropReportByCounty;
use \App\CropReportByDistrict;
use \App\FarmerParcelCrop;
use ExcelReport;

class ReportController extends Controller
{
    /**
     * Display a report of the resource.
     *
     * 
     */
    /*--------------------------------------------------------------*/
    /**
     * Crop listing blade
     *
     * 
     */
    public function reportListing()
    {
        
        $data = array(
            'nav' => ['nav-rep','nav-rep-5'],
            'navRepIn' => 'in',
            'title' => 'Report Listing',
            
        );

        return view('reports.report_listing', $data);
    }


    public function farmerParcelCounty(Request $request){
        $data = array(
            'nav' => ['nav-rep','nav-rep-2'],
            'navRepIn' => 'in',
            'title' => 'Farmer-Crop-Parcel Report Generator',
            'counties' => Counties::ordered(),
           
        );

        return view('reports.farmer_parcel_crops', $data);
    }


    public function farmerParcelCountyDownload(Request $request){
            $title = 'Farmer-Crop-Parcel Report'; // Report title

            $farmercount = FarmerParcelCrop::select('name')->when(request('county', true), function ($query, $county) {
                            return $query->where('county_id', '=', $county);
                        })->distinct()->get();
            

            $meta = [ // For displaying filters description on header
                'Filtered by' => $request->county? Counties::find($request->county)->county : 'none',
                'Sort By' => 'default',
                'Total Unique Names' => $farmercount->count(),
                'Questions? email:' => 'kendall.sawh@gov.tt',
            ];

            $queryBuilder = FarmerParcelCrop::select(['name', 'contacts', 'parcel_address','county','parcel_size','commodity'])->when(request('county', true), function ($query, $county) {
                            return $query->where('county_id', '=', $county);
                        });
            
            $columns = [ // Set Column to be displayed
                'Farmer Name' => 'name',
                'Contacts' => 'contacts', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
                'Parcel Address' => 'parcel_address',
                'County' => 'county',
                'Parcel Size' => 'parcel_size',
                'Commodity' => 'commodity',
            ];

            // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                            ->download('report 1'); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
    /**
     * Crop farmer report by county blade
     *
     * 
     */
    public function cropFarmerReport1()
    {
        /*$districts = FarmingDistrict::whereIn('id',DB::table('farming_districts')
            ->join('districts','districts.farmer_district_id','=','farming_districts.id')
            ->join('wards','wards.id','=','districts.ward_id')
            ->join('counties','counties.id','=','wards.county_id')
            ->join('region','region.id','=','counties.region_id')
            ->where('region.id',\Auth::user()->regionid)
            ->where('farmer_district_id','<>','0')
            ->pluck('farming_districts.id')
            )->distinct()->get();*/

        $data = array(
            'nav' => ['nav-rep','nav-rep-2'],
            'navRepIn' => 'in',
            'title' => 'Crop-Parcel-County-Farmer Report Generator',
            'graphtitle' => 'Crop-Land Statistics',
            'type' => ['slug' => 'new_farmer', 'type' => 'Individual Registration'],            
            'counties' => Counties::ordered(),
            'animal_crops' => Commodities::select('CommodityLocalName as animal_crop')->distinct()->orderBy('CommodityLocalName','asc')->get(),
            
        );

        return view('reports.crop_report_counties', $data);
    }
    
    /**
     * Crop farmer report by county excel download
     *
     * 
     */
    public function cropFarmerReport1Download(Request $request)
    {
            
            //return $request->all();
            $title = 'Total crop-area cultivated by County'; // Report title

            $meta = [ // For displaying filters description on header
                'Filtered by' => $request->county? Counties::find($request->county)->county : 'none',
                'Sort By' => 'Crop,County,Farming District',
                'Questions? email:' => 'kendall.sawh@gov.tt',
            ];

            $queryBuilder = CropReportByCounty::select(['crop_animal', 'total_area', 'county','farming_district_name'])->when(request('county', true), function ($query, $county) {
                            return $query->where('county_id', '=', $county);
                        })
            ->orderBy('crop_animal','asc')
            ->orderBy('county','asc')
            ->orderBy('farming_district_name','asc');
            //return $queryBuilder->get();
            $columns = [ // Set Column to be displayed
                'Crop/Livestock' => 'crop_animal',
                'Total Area (Ha)' => 'total_area', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
                'County' => 'county',
                'District' => 'farming_district_name',
            ];

            // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                            ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                                'Total Area' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                            ])
                            ->download('report 1'); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
    /**
     * end
     *
     * 
     */
    /*---------------------------------------------------------------*/

    /*---------------------------------------------------------------*/
    /**
     * Crop farmer report by district blade
     *
     * 
     */
    public function cropFarmerReportByDistrict()
    {
        $districts = FarmingDistrict::whereIn('id',DB::table('farming_districts')
            ->join('districts','districts.farmer_district_id','=','farming_districts.id')
            ->join('wards','wards.id','=','districts.ward_id')
            ->join('counties','counties.id','=','wards.county_id')
            ->join('region','region.id','=','counties.region_id')
            ->where('region.id',\Auth::user()->regionid)
            ->where('farmer_district_id','<>','0')
            ->pluck('farming_districts.id')
            )->distinct()->get();

        $data = array(
            'nav' => ['nav-rep','nav-rep-2'],
            'navRepIn' => 'in',
            'title' => 'Crop-Parcel-District-Farmer Report Generator',
            'districts' => $districts,
            'animal_crops' => Commodities::select('CommodityLocalName as animal_crop')->distinct()->orderBy('CommodityLocalName','asc')->get(),
            
        );

        return view('reports.crop_report_district', $data);
    }
    
    /**
     * Crop farmer report by district excel download
     *
     * 
     */
    public function cropFarmerReportByDistrictDownload(Request $request)
    {
            $title = 'Total crop-area cultivated by County'; // Report title

            $meta = [ // For displaying filters description on header
                'Filtered by' => $request->district? FarmingDistrict::find($request->district)->district_name : 'none',
                'Sort By' => 'Crop,District,Community',
                'Questions? email:' => 'kendall.sawh@gov.tt',
            ];

            $queryBuilder = CropReportByDistrict::select(['crop_animal', 'total_area', 'district','community_name'])->when(request('district', true), function ($query, $district) {
                            return $query->where('farming_district_id', '=', $district);
                        })
            ->orderBy('crop_animal','asc')
            ->orderBy('district','asc')
            ->orderBy('farming_district_name','asc');
            //return $queryBuilder->get();
            $columns = [ // Set Column to be displayed
                'Crop/Livestock' => 'crop_animal',
                'Total Area (Ha)' => 'total_area', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
                'District' => 'district',
                'Community' => 'community_name',
            ];

            // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
            return ExcelReport::of($title, $meta, $queryBuilder, $columns)
                            ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                                'Total Area' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                            ])
                            ->download('report 1'); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
    /**
     * end
     *
     * 
     */
    /*---------------------------------------------------------------*/

    public function landTypes()
    {
        //SELECT land_types.land_type, count(land_type_id) FROM `parcels` INNER JOIN land_types on land_type_id = land_types.id GROUP BY land_type_id
        $landtypes = DB::table('parcels')
                 ->select('land_types.land_type', DB::raw('count(land_type_id) as total'))
                 ->join('land_types','land_type_id','=', 'land_types.id' )
                 ->groupBy('land_type_id')
                 ->get();
                 //return $landtypes;
        $counties = Counties::ordered();
        $dataPoints = array();
        foreach ($landtypes as $landtype) {
           //return $landtype->total;
           array_push($dataPoints, array("y" => $landtype->total,"legendText" => $landtype->land_type, "label" => $landtype->land_type));
        }

        $data = array(
               'nav' => ['nav-rep','nav-rep-1'],
               'navRepIn' => 'in',
               'title' => 'Number of parcels per land type',
               'dataPoints' => $dataPoints,
               'counties' => $counties,

        );
        return view('reports.landstatistics', $data);
    }

    /**
     * gather commodity data to send to page.
     *
     * 
     */
    public function commodity()
    {
        /*ini_set('max_execution_time', '6000');
         ParcelTypeOfProduce::chunk(250, function($things){           
                foreach ($things as $thing) {
                    if($thing->parcel_type_id == 1){
                        $thing->amt_std = $thing->amt*2.47105;
                        $thing->save(); 
                    }
                    else{
                         $thing->amt_std = $thing->amt;
                        $thing->save(); 
                    }
                    
                }
            });*/

            /* $tests = DB::table('parcel_types_of_produce')->where('specific_parcel','like','%,%')->get();

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

            /*$districts = districts::whereIn('id',DB::table('districts')
            ->join('wards','wards.id','=','districts.ward_id')
            ->join('counties','counties.id','=','wards.county_id')
            ->join('region','region.id','=','counties.region_id')
            ->where('region.id',\Auth::user()->regionid)
            ->pluck('districts.id')
        )->get();  */

        $districts = FarmingDistrict::whereIn('id',DB::table('farming_districts')
            ->join('districts','districts.farmer_district_id','=','farming_districts.id')
            ->join('wards','wards.id','=','districts.ward_id')
            ->join('counties','counties.id','=','wards.county_id')
            ->join('region','region.id','=','counties.region_id')
            ->where('region.id',\Auth::user()->regionid)
            ->where('farmer_district_id','<>','0')
            ->pluck('farming_districts.id')
            )->distinct()->get();


        /*$districts = districts::select('farmer_district_id')->whereIn('id',DB::table('districts')
            ->join('wards','wards.id','=','districts.ward_id')
            ->join('counties','counties.id','=','wards.county_id')
            ->join('region','region.id','=','counties.region_id')
            ->where('region.id',\Auth::user()->regionid)
            ->where('farmer_district_id','<>','0')
            ->pluck('districts.id')
        )->distinct()->get(); */ 
        //return $districts;   
        $data = array(
            'nav' => ['nav-rep','nav-rep-2'],
            'navRepIn' => 'in',
            'title' => 'Crop-Land Statistics',
            'graphtitle' => 'Crop-Land Statistics',
            'type' => ['slug' => 'new_farmer', 'type' => 'Individual Registration'],
            'districts' => $districts,
            'wards' => Wards::where('county_id', '=', \Auth::user()->CountyId)->get(),
            'counties' => Counties::ordered(),
            'animal_crops' => Commodities::select('CommodityLocalName as animal_crop')->distinct()->orderBy('CommodityLocalName','asc')->get(),
            'crop_results' => [],
            'datapoints' =>[],
        );

        return view('reports.cropstatistics', $data);
    }

    /**
     * Query commodity and return data.
     *
     */
    public function commodityStat(Request $request)
    {
        //return $request->all();
        $crop_animal = \App\CropReportByCounty::query()
        ->where('crop_animal',Input::get('animal_crop1'))
        ->when(Input::has('county'), function ($query) {
            return $query->where('county_id', Input::get('county'));
        })
        ->when(Input::has('district'), function ($query) {
            return $query->where('farmer_district_id', Input::get('district'));
        })
        ->orderBy('farmer_district_id','asc')
        ->orderBy('total_area','desc')
        ->get();

        //return $crop_animal->sum('total_area');
        //return dd($request->all());
        $dataPoints = array();
        $county = \Auth::user()->CountyId;
        $colour = ["#E7823A","#546BC1","#219909"];
        //$crop_animal = null;
        $crop_total = 0;
        $showgraph = True;
        $dist = $request->district;
        $coun = $request->county;
        
       
            /*$bobs =DB::table('parcel_types_of_produce')
                        ->select('parcel_types_of_produce.parcel_type_id')
                        ->join('parcels','parcel_types_of_produce.parcel_id','=', 'parcels.id' )
                        ->join('land','parcels.land_id','=', 'land.id' )
                        ->join('addresses','land.address_id','=', 'addresses.id' )
                        ->join('districts','addresses.district_id','=', 'districts.id' )
                        ->join('wards','districts.ward_id','=', 'wards.id' )
                        ->where('wards.id', '=', $request->ward)
                        ->whereIn('parcel_types_of_produce.specific_parcel', [$request->animal_crop1,($request->animal_crop2? $request->animal_crop2:null),($request->animal_crop3? $request->animal_crop3:null)])
                        ->groupBy('parcel_types_of_produce.parcel_type_id')
                        ->get();*/
       
        /*$bobs =DB::table('parcel_types_of_produce')
                    ->select('parcel_types_of_produce.parcel_type_id')
                    ->join('parcels','parcel_types_of_produce.parcel_id','=', 'parcels.id' )
                    ->join('land','parcels.land_id','=', 'land.id' )
                    ->join('addresses','land.address_id','=', 'addresses.id' )
                    ->join('districts','addresses.district_id','=', 'districts.id' )
                    ->join('wards','districts.ward_id','=', 'wards.id' )
                    ->join('counties','wards.county_id','=', 'counties.id' )
                    ->when($dist, function ($query, $dist) {
                            return $query->where('districts.farmer_district_id', '=', $dist);
                        })
                        ->when($coun, function ($query, $coun) {
                            return $query->where('counties.id', '=', $coun);
                        })
                    ->whereIn('parcel_types_of_produce.specific_parcel', [$request->animal_crop1,($request->animal_crop2? $request->animal_crop2:null),($request->animal_crop3? $request->animal_crop3:null)])
                    ->groupBy('parcel_types_of_produce.parcel_type_id')
                    ->get();*/
        
        /*foreach ($bobs as $bob) {
           if($bob->parcel_type_id>=3)
            $showgraph = False;
            break;

        }
        
         
        if ($request->animal_crop1) {
            $dist = $request->district;
            $coun = $request->county;
            $crop_animal = DB::table('parcel_types_of_produce')
                        ->select(DB::raw('farmer_db.parcel_types_of_produce.specific_parcel as crop_animal'),DB::raw('SUM(farmer_db.parcel_types_of_produce.amt_std) AS total_area'),'districts.district','districts.farmer_district_id as wardid')
                        ->join('parcels','parcel_types_of_produce.parcel_id','=', 'parcels.id' )
                        ->join('land','parcels.land_id','=', 'land.id' )
                        ->join('addresses','land.address_id','=', 'addresses.id' )
                        ->join('districts','addresses.district_id','=', 'districts.id' )
                        ->join('wards','districts.ward_id','=', 'wards.id' )
                        ->join('counties','wards.county_id','=', 'counties.id' )
                        ->when($dist, function ($query, $dist) {
                            return $query->where('districts.farmer_district_id', '=', $dist);
                        })
                        ->when($coun, function ($query, $coun) {
                            return $query->where('counties.id', '=', $coun);
                        })
                        ->whereIn('parcel_types_of_produce.specific_parcel', [$request->animal_crop1])
                        ->groupBy('parcel_types_of_produce.specific_parcel','districts.district')
                        ->get();
            if($showgraph){
                foreach ($crop_animal as $key=>$ca) {
                    $town = \App\FarmingDistrict::find($ca->wardid)?\App\FarmingDistrict::find($ca->wardid)->district_name:$ca->district.'(Town)';
                
                    array_push($dataPoints, array("y" => $ca->total_area,"legendText" => $ca->crop_animal, "label" => $town));
                    //$crop_total = $crop_total + $ca->total_area;
                }
            }
            $count = DB::table('parcels')
                        ->select(DB::raw('parcels.id'))
                        ->join('parcel_types_of_produce','parcel_types_of_produce.parcel_id','=', 'parcels.id' )
                        ->join('land','parcels.land_id','=', 'land.id' )
                        ->join('addresses','land.address_id','=', 'addresses.id' )
                        ->join('districts','addresses.district_id','=', 'districts.id' )
                        ->join('wards','districts.ward_id','=', 'wards.id' )
                        ->join('counties','wards.county_id','=', 'counties.id' )
                        ->when($dist, function ($query, $dist) {
                            return $query->where('districts.farmer_district_id', '=', $dist);
                        })
                        ->when($coun, function ($query, $coun) {
                            return $query->where('counties.id', '=', $coun);
                        })
                        ->whereIn('parcel_types_of_produce.specific_parcel', [$request->animal_crop1])
                        ->distinct()->count();
           
        }
        else{
            return 'Unknown request. Contact your administrator.';
        }*/

        $districts = FarmingDistrict::whereIn('id',DB::table('farming_districts')
            ->join('districts','districts.farmer_district_id','=','farming_districts.id')
            ->join('wards','wards.id','=','districts.ward_id')
            ->join('counties','counties.id','=','wards.county_id')
            ->join('region','region.id','=','counties.region_id')
            ->where('region.id',\Auth::user()->regionid)
            ->where('farmer_district_id','<>','0')
            ->pluck('farming_districts.id')
            )->distinct()->get();
        //return $crop_animal;
        $data = array(
            'nav' => ['nav-rep','nav-rep-2'],
            'navRepIn' => 'in',
            'title' => 'Crop-Land Statistics',
            'type' => ['slug' => 'new_farmer', 'type' => 'Individual Registration'],
            'districts' => $districts,
            'wards' => Wards::where('county_id', '=', \Auth::user()->CountyId)->get(),
            'counties' => Counties::ordered(),
            'animal_crops' => Commodities::select('CommodityLocalName as animal_crop')->where('display', 1)->distinct()->orderBy('CommodityLocalName','asc')->get(),
            'crop_results' => $crop_animal? $crop_animal : [],
            'datapoints' => $dataPoints,
            //'croptotal' => $crop_animal->sum('total_area'),
            'parcel_count' => $crop_animal->count(),
            'graphtitle' =>'',
            //'graphtitle' =>Districts::where('farmer_district_id','=',$request->district)->ward,
            );

        return view('reports.cropstatistics', $data);
        //return $crop_animal;
        
    }

    /**
     * Display the specified resource.
     *
     *
     */
    public function listing($id=0,$anicrop=0)
    {

        /*$indi = \App\Application::whereIn('id',DB::table('applications')
                    ->join('parcels','parcels.application_id','=','applications.id')
                    ->join('parcel_types_of_produce','parcels.id','=','parcel_types_of_produce.parcel_id')
                    ->join('land','land.id','=','parcels.land_id')
                    ->join('addresses','addresses.id','=','land.address_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->where('wards.id',$id)
                    ->where('parcel_types_of_produce.specific_parcel', $anicrop)
                    ->pluck('applications.id')       
                    )->paginate(10);*/
        $indi = \App\Application::whereIn('id',DB::table('applications')
                    ->join('parcels','parcels.application_id','=','applications.id')
                    ->join('parcel_types_of_produce','parcels.id','=','parcel_types_of_produce.parcel_id')
                    ->join('land','land.id','=','parcels.land_id')
                    ->join('addresses','addresses.id','=','land.address_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('farming_districts','farming_districts.id','=','districts.farmer_district_id')
                    ->where('farming_districts.id',$id)
                    ->where('parcel_types_of_produce.specific_parcel','like', '%'.$anicrop.'%')
                    ->pluck('applications.id')       
                    )->paginate(10);
        //return $indi;
        $data = array(
            'nav' => ['nav-rep','nav-rep-2'],
            'navApplIn' => 'in',
            'title' => 'Application List',
            'applications' => $indi,
            
        );

        return view('reports.common.list', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * 
     */
    public function destroy(Application $application)
    {
        //
    }

    /***********************************************************CSO_RAN_RAS_REPORT******************************************************************/

    public function csoRegionReport()
    {
        //If Region director, select counties of the region, else select all counties
            $counties = Auth::user()->role_id == 7? Counties::where('region_id','=',Auth::user()->regionid)->get() : Counties::find(Auth::user()->CountyId);

        $data = array(
           'nav' => ['nav-rep','nav-rep-3'],
           'navRepIn' => 'in',
           'title' => 'Report For CSO',
           'counties' => $counties,
           'path' => '/storage/usermanual/User_guide.pdf',
           
           
        );
        if(Auth::user()->role_id == 10){
            return view('reports.region_cso_listing', $data);
        }
        elseif (Auth::user()->regionid == 1) {
            return view('reports.ran_cso_reports', $data);
        } elseif(Auth::user()->regionid == 2) {
            return view('reports.ras_cso_reports', $data);
        }
        
        
    }
    public function csoListing($id=0,$dataType=0)
    {
        //If Region director, select counties of the region, else select all counties
            $counties = Auth::user()->role_id == 7? Counties::where('region_id','=',Auth::user()->regionid)->get() : Counties::find(Auth::user()->CountyId);

            $ind = \App\Individual::whereIn('id',
                    DB::table('individuals')
                    ->join('individual_address','individual_address.ind_id','=','individuals.id')
                    ->join('addresses','addresses.id','=','individual_address.add_id')
                    ->join('address_lot_types','address_lot_types.id','=','addresses.lot_type_id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->join('counties','counties.id','=','wards.county_id')
                    ->join('application_individual','individuals.id', '=','application_individual.ind_id')
                    ->join('applications','application_individual.app_id', '=','applications.id')
                    ->join('application_enterprise','applications.id', '=','application_enterprise.application_id')
                    ->join('enterprises','application_enterprise.enterprise_id', '=','enterprises.id')
                    ->where('counties.id',$id)
                    ->whereIn('individual_address.ind_add_type_id',[1,3])
                    ->whereIn('enterprises.id',[2,4,8,15,17,18,19,21])
                    ->pluck('individuals.id')
                    )->paginate(10);

            $org = \App\Organization::whereIn('id',
                    DB::table('organizations')
                    ->join('addresses','organizations.address_id','=','addresses.id')
                    ->join('districts','districts.id','=','addresses.district_id')
                    ->join('wards','wards.id','=','districts.ward_id')
                    ->join('counties','counties.id','=','wards.county_id')
                    ->where('counties.id',$id)
                    ->pluck('organizations.id')
                    )->paginate(10);

        $data = array(
           'nav' => ['nav-rep','nav-rep-3'],
           'navRepIn' => 'in',
           'title' => 'Post 2015 Results For CSO',
           'counties' => $counties,
           'path' => '/storage/usermanual/User_guide.pdf',
           'individuals' => $ind,
           'organizations' => $org,
           
           
        );


        return view('reports.common.post2015list', $data);
    }


    public function monthly()
    {   
        $dateS = Carbon::now()->startOfMonth();
        $dateE = Carbon::now()->endOfMonth();
        /*--------------------------------------queries for selected month--------------------------------------------------*/
            $new = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('registration_id',1)
                ->whereNotIn('applications.status_id', [7])
                ->whereBetween('created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $newcompleted = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('registration_id',1)
                ->whereIn('applications.status_id', [6])
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();

            /*$renewal = DB::table('applications')
                ->join('application_individual','application_individual.app_id','=','applications.id')
                ->join('individuals','individuals.id','=','application_individual.ind_id')
                ->join('farmer_individual','farmer_individual.ind_id','=','individuals.id')
                ->join('farmers','farmers.id','=','farmer_individual.farmer_id')
                ->join('farmer_badges','farmer_badges.farmer_id','=','farmers.id')
                ->where('farmer_badges.renew_process_check', 1)
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('applications.status_id', 6)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();*/

            $renewal = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('registration_id',2)
                ->whereNotIn('applications.status_id', [7])
                ->whereBetween('created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $bonifide = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->whereNotIn('applications.app_type_id', [12])
                ->whereNotIn('applications.status_id', [6,7])
                ->whereBetween('created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $stateoccupier = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->whereIn('applications.app_type_id', [12])
                ->whereNotIn('applications.status_id', [6,7])
                ->whereBetween('created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $total = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->whereBetween('created_at', [$dateS,$dateE])
                ->get()
                ->count();   
                
            $outofcounty = DB::table('applications')
                ->join('parcels','applications.id','=','parcels.application_id')
                ->join('land','parcels.land_id','=','land.id')
                ->join('addresses','land.address_id','=','addresses.id')
                ->join('districts','addresses.district_id','=','districts.id')
                ->join('wards','districts.ward_id','=','wards.id')
                ->join('counties','wards.county_id','=','counties.id')
                ->where('counties.county', Auth::user()->county)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->whereNotIn('applications.status_id', [6,7])
                ->whereNotIn('applications.registering_county', [Auth::user()->CountyId])
                ->select('applications.id')
                ->distinct() 
                ->get()
                ->count();  

            $inspectioncompleted = DB::table('applications')
                ->join('application_status','application_status.application_id','=','applications.id')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->whereNotIn('application_status.status', [1,2,7])
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();          
                            
            $completed = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('applications.status_id', 6)
                ->whereBetween('created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $recommended = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('applications.status_id', 5)
                ->whereBetween('created_at', [$dateS,$dateE])
                ->get()
                ->count(); 

            $flagged = DB::table('applications')
                ->join('application_individual','application_individual.app_id','=','applications.id')
                ->join('individuals','individuals.id','=','application_individual.ind_id')
                ->join('individual_address','individual_address.ind_id','=','individuals.id')
                ->join('addresses','addresses.id','=','individual_address.add_id')
                ->join('districts','districts.id','=','addresses.district_id')
                ->join('wards','wards.id','=','districts.ward_id')
                ->join('counties','counties.id','=','wards.county_id')
                ->where('counties.county', Auth::user()->county)
                ->where('applications.status_id', 7)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count(); 

            $totalothercounties = DB::table('applications')
                ->join('application_individual','application_individual.app_id','=','applications.id')
                ->join('individuals','individuals.id','=','application_individual.ind_id')
                ->join('individual_address','individual_address.ind_id','=','individuals.id')
                ->join('addresses','addresses.id','=','individual_address.add_id')
                ->join('districts','districts.id','=','addresses.district_id')
                ->join('wards','wards.id','=','districts.ward_id')
                ->join('counties','counties.id','=','wards.county_id')
                ->where('counties.county','<>', Auth::user()->county)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();
                //return [$approved,$totalothercounties,$new];   
        /*--------------------------------------end of selected month-----------------------------------------------------*/
         $districts = districts::whereIn('id',DB::table('districts')
            ->join('wards','wards.id','=','districts.ward_id')
            ->join('counties','counties.id','=','wards.county_id')
            ->join('region','region.id','=','counties.region_id')
            ->where('region.id',\Auth::user()->regionid)
            ->pluck('districts.id')
        )->get();     
        $data = array(
            'nav' => ['nav-rep','nav-rep-4'],
            'navRepIn' => 'in',
            'title' => 'Crop-Land Statistics',
            'type' => ['slug' => 'new_farmer', 'type' => 'Individual Registration'],
            'districts' => $districts,
            'wards' => Wards::where('county_id', '=', \Auth::user()->CountyId)->get(),
            'counties' => Counties::ordered(),
            'new' => $new,
            'newcompleted' => $newcompleted,
            'renewal' => $renewal,
            'bonifide' => $bonifide,
            'stateoccupier' => $stateoccupier,
            'total' => $total,
            'outofcounty' => $outofcounty,
            'inspectioncompleted' => $inspectioncompleted,
            'approved' => $completed,
            'recommended' => $recommended,
            'flagged' => $flagged,
            'month' => strtoupper(Carbon::now()->format('F')),
            'year' => $dateS->format('Y'),
        );
        //return $new;
        return view('reports.monthly_test',$data);
    }

    public function monthlySubmit(Request $request)
    {  
        $dateS = Carbon::parse($request->monthselect)->startOfMonth();
        $dateE = Carbon::parse($request->monthselect)->endOfMonth();
        $datePrevStart = Carbon::parse($request->monthselect)->startOfMonth()->subMonth(1);
        $datePrevEnd = Carbon::parse($request->monthselect)->endOfMonth()->subMonth(1);
        /*--------------------------------------queries for selected month--------------------------------------------------*/
            $new = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('registration_id',1)
                ->whereNotIn('applications.status_id', [6,7])
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $newcompleted = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('registration_id',1)
                ->whereNotIn('applications.status_id', [6,7])
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();

            /*$renewal = DB::table('applications')
                ->join('application_individual','application_individual.app_id','=','applications.id')
                ->join('individuals','individuals.id','=','application_individual.ind_id')
                ->join('farmer_individual','farmer_individual.ind_id','=','individuals.id')
                ->join('farmers','farmers.id','=','farmer_individual.farmer_id')
                ->join('farmer_badges','farmer_badges.farmer_id','=','farmers.id')
                ->where('farmer_badges.renew_process_check', 1)
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('applications.status_id', 6)
                ->where('registration_id',2)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();*/

            $renewal = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('registration_id',2)
                ->where('applications.status_id', 6)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $bonifide = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->whereNotIn('applications.app_type_id', [12])
                ->whereNotIn('applications.status_id', [6,7])
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $stateoccupier = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->whereIn('applications.app_type_id', [12])
                ->whereNotIn('applications.status_id', [6,7])
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $total = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();   
                
            $outofcounty = DB::table('applications')
                ->join('parcels','applications.id','=','parcels.application_id')
                ->join('land','parcels.land_id','=','land.id')
                ->join('addresses','land.address_id','=','addresses.id')
                ->join('districts','addresses.district_id','=','districts.id')
                ->join('wards','districts.ward_id','=','wards.id')
                ->join('counties','wards.county_id','=','counties.id')
                ->where('counties.county', Auth::user()->county)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->whereNotIn('applications.status_id', [6,7])
                ->whereNotIn('applications.registering_county', [Auth::user()->CountyId])
                ->select('applications.id')
                ->distinct() 
                ->get()
                ->count();            
                            
            $inspectioncompleted = DB::table('applications')
                ->join('application_status','application_status.application_id','=','applications.id')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->whereNotIn('application_status.status', [1,2,7])
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $recommended = DB::table('applications')
                ->join('application_status','application_status.application_id','=','applications.id')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('application_status.status', 5)
                ->whereBetween('application_status.created_at', [$dateS,$dateE])
                ->get()
                ->count(); 

            $completed = DB::table('applications')
                ->join('application_status','application_status.application_id','=','applications.id')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('application_status.status', 6)
                ->whereBetween('application_status.created_at', [$dateS,$dateE])
                ->get()
                ->count();

            $flagged = DB::table('applications')
                ->join('application_individual','application_individual.app_id','=','applications.id')
                ->join('individuals','individuals.id','=','application_individual.ind_id')
                ->join('individual_address','individual_address.ind_id','=','individuals.id')
                ->join('addresses','addresses.id','=','individual_address.add_id')
                ->join('districts','districts.id','=','addresses.district_id')
                ->join('wards','wards.id','=','districts.ward_id')
                ->join('counties','counties.id','=','wards.county_id')
                ->where('counties.county', Auth::user()->county)
                ->where('applications.status_id', 7)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count(); 

            $totalothercounties = DB::table('applications')
                ->join('application_individual','application_individual.app_id','=','applications.id')
                ->join('individuals','individuals.id','=','application_individual.ind_id')
                ->join('individual_address','individual_address.ind_id','=','individuals.id')
                ->join('addresses','addresses.id','=','individual_address.add_id')
                ->join('districts','districts.id','=','addresses.district_id')
                ->join('wards','wards.id','=','districts.ward_id')
                ->join('counties','counties.id','=','wards.county_id')
                ->where('counties.county','<>', Auth::user()->county)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();
                //return [$approved,$totalothercounties,$new];
            
            //$county = Auth::user()->CountyId;    
            /*$newissued = DB::table('applications')
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('registration_id',1)
                ->whereNotIn('applications.status_id', [6,7])
                ->whereBetween('created_at', [$dateS,$dateE])
                ->get()
                ->count();*/
        /*--------------------------------------end of selected month-----------------------------------------------------*/
         $data = array(
           'nav' => ['nav-rep','nav-rep-4'],
           'navRepIn' => 'in',
           'new' => $new,
           'newcompleted' => $newcompleted,
           'renewal' => $renewal,
           'bonifide' => $bonifide,
           'stateoccupier' => $stateoccupier,
           'total' => $total,
           'outofcounty' => $outofcounty,
           'inspectioncompleted' => $inspectioncompleted,
           'approved' => $completed,
           'recommended' => $recommended,
           'flagged' => $flagged,
           'month' => $dateS->format('F'),
           'year' => $dateS->format('Y'),
       
        );
        //return dd($data);
        return view('reports.monthly_test',$data);
    }

     /*
    |-----------------------------------------------------------------------------
    | Ajax
    |-----------------------------------------------------------------------------
    |
    |
    |
    */
    public function monthlybreakdown(Request $request){
        //return response()->json(array("exists" => true, "assinged_county" => 'hhh'));
        $dateS = Carbon::parse($request->date_select)->startOfMonth();
        $dateE = Carbon::parse($request->date_select)->endOfMonth();
        $datePrevStart = Carbon::parse($request->date_select)->startOfMonth()->subMonth(1);
        $datePrevEnd = Carbon::parse($request->date_select)->endOfMonth()->subMonth(1);
        try {
            $county = $request->input('county');
            $date = $request->input('date_select');
            $wards = \App\Counties::find($county)->wards;
            $districts = array();
            foreach ($wards as $ward) {
                 $districts[] = $ward->districts;
            };
            $districts = array_collapse($districts);
            //return response()->json($districts);

       $new = DB::table('applications')
                ->join('application_individual','application_individual.app_id','=','applications.id')
                ->join('individuals','individuals.id','=','application_individual.ind_id')
                ->join('farmer_individual','farmer_individual.ind_id','=','individuals.id')
                ->join('farmers','farmers.id','=','farmer_individual.farmer_id')
                ->join('farmer_badges','farmer_badges.farmer_id','=','farmers.id')
                ->where('farmer_badges.renew_process_check', 0)
                ->where('applications.registering_county', Auth::user()->CountyId)
                ->where('applications.status_id', 6)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();

        $renewal = DB::table('applications')
                ->join('parcels','applications.id','=','parcels.application_id')
                ->join('land','parcels.land_id','=','land.id')
                ->join('addresses','land.address_id','=','addresses.id')
                ->join('districts','addresses.district_id','=','districts.id')
                ->join('wards','districts.ward_id','=','wards.id')
                ->join('counties','wards.county_id','=','counties.id')
                ->where('applications.registering_county', $county)
                ->where('registration_id',2)
                ->where('applications.status_id', 6)
                ->whereBetween('applications.created_at', [$dateS,$dateE])
                ->get()
                ->count();
        return \Response::json(['new' => $new, 'renewal' => $renewal, 'dateS' => $dateS, 'enddate' => $dateE]);    
        } catch (Exception $e) {
            //return errors if fail
            return \Response::json(['status' => 500, 'message' => $e->getMessage()],442);
        }
        
    }

    public function victoria()
    {

        $path = '/storage/usermanual/RAS/COUNTY_VICTORIA_REPORT.xlsx';
        $data = array(
               'nav' => ['nav-rep','nav-rep-5'],
               'navRepIn' => 'in',
               'title' => 'Special report - County  Victoria',
               'path' => $path,
        );
        return view('reports.victorialist', $data);
    }

    public function landquery(){
        $data = array(
               'nav' => ['nav-rep','nav-rep-5'],
               'navRepIn' => 'in',
               'title' => 'Land Type Report',
               'landtypes' => LandType::all(),
               
        );
        return view('reports.landquery', $data);
    }

    public function landqueryresult(Request $request)
    {
        
        $in = $request->land_type;
            
        $individuals = Individual::whereIn('id',DB::table('individuals')
            ->join('application_individual','individuals.id','=','application_individual.ind_id')
            ->join('applications','application_individual.app_id','=','applications.id')
            ->join('parcels','applications.id','=','parcels.application_id')
                ->join('land','parcels.land_id','=','land.id')
                ->join('addresses','land.address_id','=','addresses.id')
                ->join('districts','addresses.district_id','=','districts.id')
                ->join('wards','districts.ward_id','=','wards.id')
                ->join('counties','wards.county_id','=','counties.id')
                ->where('counties.id', Auth::user()->countyid)
                ->when($in, function ($query, $in) {
                    return $query->where('land_type_id', $in);
                })
                ->pluck('individuals.id')
            )->get();

        if ($request->search_type==2) {
            $landtypes = Parcel::whereIn('id',DB::table('parcels')
                ->join('land','parcels.land_id','=','land.id')
                ->join('addresses','land.address_id','=','addresses.id')
                ->join('districts','addresses.district_id','=','districts.id')
                ->join('wards','districts.ward_id','=','wards.id')
                ->join('counties','wards.county_id','=','counties.id')
                ->where('counties.id', Auth::user()->countyid)
                ->when($in, function ($query, $in) {
                    return $query->where('land_type_id', $in);
                })
                ->pluck('parcels.id')
            )->get();
        }
        

        
    
        $result = (isset($landtypes)) ? $landtypes : null ;
        
        $data = array(
               'nav' => ['nav-rep','nav-rep-8'],
               'navRepIn' => 'in',
               'title' => ($request->search_type==1? count($individuals) :count($result)).'  records found for '.LandType::find($in)->land_type,
               'landtypes' => LandType::all(),
               'landdetailcount' => count($result),
               'parcels' => $result,
               'individuals' => $individuals,
               
        );
        if ($request->search_type==1) {
            return view('reports.common.landfarmertable',$data); 
        } else {
            return view('reports.common.landparceltable',$data); 
        }
        
        
        //return view('reports.landquery', $data);
        //return $data;
    }

    public function cropfarmer(Request $request)
    {
        
        $county = \Auth::user()->CountyId;
        $dist = $request->district;
        $coun = $request->county;



        $crop_animal = DB::table('individuals')
                        ->join('application_individual','individuals.id','=', 'application_individual.ind_id' )
                        ->join('applications','application_individual.app_id','=', 'applications.id' )
                        ->join('parcels','applications.id','=', 'parcels.app_id' )
                        ->join('land','parcels.land_id','=', 'land.id' )
                        ->join('addresses','land.address_id','=', 'addresses.id' )
                        ->join('districts','addresses.district_id','=', 'districts.id' )
                        ->join('wards','districts.ward_id','=', 'wards.id' )
                        ->join('counties','wards.county_id','=', 'counties.id' )
                        ->join('parcel_types_of_produce','parcels.id','=', 'parcel_types_of_produce.parcel_id' )
                        ->when($dist, function ($query, $dist) {
                            return $query->where('districts.farmer_district_id', '=', $dist);
                        })
                        ->when($coun, function ($query, $coun) {
                            return $query->where('counties.id', '=', $coun);
                        })
                        ->whereIn('parcel_types_of_produce.specific_parcel', [$request->animal_crop1])
                        ->get();
        
    }

    public function cropfarmerindex()
    {
        

        $districts = FarmingDistrict::whereIn('id',DB::table('farming_districts')
            ->join('districts','districts.farmer_district_id','=','farming_districts.id')
            ->join('wards','wards.id','=','districts.ward_id')
            ->join('counties','counties.id','=','wards.county_id')
            ->join('region','region.id','=','counties.region_id')
            ->where('region.id',\Auth::user()->regionid)
            ->where('farmer_district_id','<>','0')
            ->pluck('farming_districts.id')
            )->distinct()->get();


        
        $data = array(
            'nav' => ['nav-rep','nav-rep-2'],
            'navRepIn' => 'in',
            'title' => 'Crop - Farmer Listing',
            'districts' => $districts,
            'wards' => Wards::where('county_id', '=', \Auth::user()->CountyId)->get(),
            'counties' => Counties::ordered(),
            'animal_crops' => Commodities::select('CommodityLocalName as animal_crop')->distinct()->orderBy('CommodityLocalName','asc')->get(),
            'crop_results' => 0,
            
        );
        //return $data;
        return view('reports.crop_farmer', $data);
    }

}
