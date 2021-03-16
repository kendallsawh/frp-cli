<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Districts;
use App\Wards;
use App\Counties;
use Carbon\Carbon;
//use Illuminate\Support\Arr;
use DB;

class AppointmentController extends Controller
{

  public function ajaxGetAppointment(Request $request)
    {

    	try {

		$ward = Wards::find(Districts::find($request->districtid)->ward_id);
    	$county = Counties::find($ward->county_id)->id;
      $county_num = is_null(Counties::find($ward->county_id)->appointment_no)? 5:Counties::find($ward->county_id)->appointment_no;

    	

    	$available_dates = DB::table('appointments')
  						->selectRaw('count(appointment_date) as count, appointment_date')
  						->where('county_id',$county)
              ->havingRaw('Count(appointment_date) < ?', [5])
  						->whereDate('appointment_date', '>', Carbon::now() )
  						->orderBy('appointment_date','asc')
  						->groupBy('appointment_date')
  						->get();
  						//->pluck('count', 'appointment_date');
  		
  		

  		$html = '';
  		if (count($available_dates)==0) {
  			$last_date = Appointment::selectRaw('appointment_date')
                                ->where('county_id',$county)
                                ->where('appointment_date', '>', Carbon::now() )
                                ->orderBy('appointment_date','desc')
                                ->first();
        if($last_date){
          /*if all three dates are booked get the next available date and increment 3 times*/
          
          for ($i=1; $i < 4; $i++) { 
              $date = Carbon::parse($last_date->appointment_date)->addDays($i)->toDateString();
              $html = $html.'<input type="radio" id="appoint_date-'.$i.'" code="'.$i.'" '.' name="appointment_date" value="'.$date.'" class="appointment_date"><label for="appoint_date-"'.$i.' class=""> Date option '.$i.': '.$date.'. Available space left: '.(5).'</label><hr><br>';
              
          }
         
        }
        else{
          /*if no last date is found then increment 3 times.. this is just a fallback option*/
          for ($i=1; $i < 4; $i++) {
              $date = Carbon::today()->addDays($i)->toDateString();
              $html = $html.'<input type="radio" id="appoint_date-'.$i.'" code="'.$i.'" '.' name="appointment_date" value="'.$date.'" class="appointment_date"><label for="appoint_date-'.$i.'" class=""> Date option '.$i.': '.$date.'. Available space left: '.(5).'</label><hr><br>';
            }
          
          }
            
  		}
  		elseif (count($available_dates)==1) {
        /*if 1 date is found increment for the available dates*/
            $increment = 1;
            foreach ($available_dates as $date) {
              $html = $html.'<input type="radio" id="appoint_date-'.$increment.'" code="'.$increment.'" '.'  name="appointment_date" value="'.$date->appointment_date.'" class="appointment_date"><label for="appoint_date-'.$increment.'"> Date option '.$increment.': '.$date->appointment_date.'. Available space left: '.(5-$date->count).'</label><hr><br>';
              $increment ++;    
            }
            /*increment for the remainder dates to keep the continuity of 3 options*/
            for ($i=2; $i <4 ; $i++) { 
              $html = $html.'<input type="radio" id="appoint_date-'.$i.'" code="'.$i.'" '.'  name="appointment_date" value="'.Carbon::parse($available_dates->last()->appointment_date)->addDays($i-1)->toDateString().'" class="appointment_date"><label for="appoint_date'.$i.'"> Date option '.$i.': '.Carbon::parse($available_dates->last()->appointment_date)->addDays($i-1)->toDateString().' Available space left: 5</label><hr><br>';
            }
            

  		}
  		elseif (count($available_dates)==2) {
            /*if 2 date is found increment for the available dates*/
            $increment = 1;
            foreach ($available_dates as $date) {
              $html = $html.'<input type="radio" id="appoint_date-'.$increment.'" code="'.$increment.'" '.'  name="appointment_date" value="'.$date->appointment_date.'" class="appointment_date"><label for="appoint_date-'.$increment.'"> Date option '.$increment.': '.$date->appointment_date.'. Available space left: '.(5-$date->count).'</label><hr><br>';
              $increment ++;    
            }
            /*add one more option to keep the 3 available dates displayed*/
            $html = $html.'<input type="radio" id="appoint_date-3" name="appointment_date" value="'.Carbon::parse($available_dates->last()->appointment_date)->addDays(1)->toDateString().'" class="appointment_date"><label for="appoint_date-3"> Date option 3: '.Carbon::parse($available_dates->last()->appointment_date)->addDays(1)->toDateString().' Available space left: 5</label><hr><br>';
            
  		}
  		elseif (count($available_dates)==3) {
        /*if all three dates are open then increment for the three returned datess*/
  			$increment = 1;
  			foreach ($available_dates as $date) {
  				$html = $html.'<input type="radio" id="appoint_date-'.$increment.'" code="'.$increment.'" '.'  name="appointment_date" value="'.$date->appointment_date.'" class="appointment_date"><label for="appoint_date-'.$increment.'"> Date option '.$increment.': '.$date->appointment_date.'. Available space left: '.(5-$date->count).'</label><hr><br>';
  				$increment ++;		
  			}
        
  		}
  		
  		
    		
    		return $html;
    		
            
        } catch (Exception $e) {
            //return errors if fail
            return \Response::json(['status' => 500, 'message' => $e->getMessage()],442);
        }
    }
}
