<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Districts;
use DB;

class FarmerBadgeController extends Controller
{
    public function renew(Request $request)
    {
        // get badge
        $badge = \App\FarmerBadge::find($request->badge_id);
        if (!$badge) return back()->with('flashed', 'Badge does not exist.');

        // get farmer and validate exists
        $farmer = \App\Farmer::find($badge->farmer_id)->farmer();
        if (!$farmer) return back()->with('flashed', 'Farmer does not exist.');

        // check if badge is not expired
        if (!$badge->expired) return back()->with('flashed', 'Farmer badge is not expired.');

        // save new badge
        /*$badge->date_issued = \Carbon\Carbon::now()->toDateString();
        $badge->user_id = \Auth::user()->id;
        $badge->valid = 1;
        $badge->save();*/ 

        //set renewal process to 1
        $badge->renew_process_check = 1;
        $badge->save();
        //reset applications to pending
        $applications = $farmer->applications();
        //return $applications;
        foreach ($applications as $key => $application) {
            $application->updated_at = \Carbon\Carbon::now()->toDateString();
            $application->status_id = 1;
            $application->registration_id = 2;
            $application->save();

            //soft delete application
            $checkdocexist = \App\ApplicationDocument::where('app_id',$application->id);
            if($checkdocexist){
               $deleteapp = \App\ApplicationDocument::where('app_id',$application->id)->delete(); 
            }

            //log who conducted renew
            $aov = new \App\OfficerApplicationVerification;
            $aov->application_id = $application->id;
            $aov->verification_id = 1;
            $aov->user_id = \Auth::user()->id;
            $aov->save();

            //assign to field officers
            $parcels = $application->parcels();
            foreach ($parcels as $key => $parcel) {
                $parcel->status_id = 1;
                $parcel->save();
                $dfouser = \App\User::whereIn('id',
                        DB::table('User_districts')
                        ->where('district_id',Districts::find($parcel->land->address->district_id)->farmer_district_id)//insert district_link here instead
                        ->pluck('user_districts.user_id')
                    )->first();
                    if($dfouser){
                      $this->insertApplicationUser($application->id,$dfouser->id,4,\Auth::user()->id);//app id, dfo id, app status, created by
                    }
            }
            
        }
        // log new badge
        /*$log = new \App\FarmerBadgeLog;
        $log->date_issued = $badge->date_issued;
        $log->badge_id = $badge->id;
        $log->colour_id = $badge->colour_id;
        $log->issued_by = $badge->user_id;
        $log->save();*/

        if ($farmer->type == 'Individual') 
            return redirect('/individual/view/'.$farmer->id)->with('success', 'Successfully started the renewal process. Please review and verify Farmer information.');
        else
            return redirect('/organization/view/'.$farmer->id)->with('success', 'Successfully started the renewal process. Please review and verify Farmer information.');
    }

    public function replace(Request $request)
    {
        //dd($request->police_report);

        // get badge
        $badge = \App\FarmerBadge::find($request->badge_id);
        if (!$badge) return back()->with('flashed', 'Badge does not exist.');

        // get farmer and validate exists
        $farmer = \App\Farmer::find($badge->farmer_id)->farmer();
        if (!$farmer) return back()->with('flashed', 'Farmer does not exist.');

        // check if badge is expired
        if ($badge->expired) return back()->with('flashed', 'Farmer badge is expired.');

        // validate 
        $validator = Validator::make($request->all(), [
            'badge_id' => 'required',
            'type' => 'required',
            'comments' => 'required',
            'police_report' => 'required',
        ]);

        $validator->after(function($validator)  use ($request) {
            // check for police report if lost (type = 1)
            if ($request->type == 1 && !$request->police_report) {
                $validator->errors()->add('police_report', 'Police report is required.');
            }
        });
        
        if ($validator->fails()) {
            if ($farmer->type == 'Individual') {
                return redirect('/individual/view/'.$farmer->id)
                    ->withInput()
                    ->withErrors($validator)
                    ->with('flashed', 'Please correct errors.')
                    ->with('fail', 'failed');
            }else{
                return redirect('/organization/view/'.$farmer->id)
                    ->withInput()
                    ->withErrors($validator)
                    ->with('flashed', 'Please correct errors.')
                    ->with('fail', 'failed');
            }
        }

        // log new badge
        $log = new \App\FarmerBadgeReplacement;
        $log->badge_id = $badge->id;
        $log->replacement_type_id = $request->type;
        $log->comments = $request->comments;
        $log->issued_by = \Auth::user()->id;
        $log->save();

        if ($request->type == 1) {
            if ($request->file('police_report')->isValid()) {
                $police_report = md5($log->id).'.'.$request->police_report->extension();
                // upload police_report
                $request->police_report->storeAs('public/police_report', $police_report);
                // save name to log
                $log->police_report = $police_report;
                $log->save();
            }
        }

        if ($farmer->type == 'Individual') 
            return redirect('/individual/view/'.$farmer->id)->with('success', 'Badge successfully replaced.');
        else
            return redirect('/organization/view/'.$farmer->id)->with('success', 'Badge successfully replaced.');
    }

    protected function insertApplicationUser($appId, $userId,$role,$creator)
    {
            $appuser = new ApplicationUser; 
            $appuser->app_id = $appId;
            $appuser->user_id = $userId;
            $appuser->user_role = $role;
            $appuser->created_by = $creator;
            $appuser->save();       
    }
}
