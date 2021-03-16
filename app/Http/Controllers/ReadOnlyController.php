<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Individual;
use App\Counties;

class ReadOnlyController extends Controller
{
	public function listing()
    {
        $county = \Auth::user()->countyid;
       

        
        
        return"hello";
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
            'applications' => $user->applications(),
            'counties' => Counties::all(),
            'appcount' => empty($user->applications()->count())? 0 : $user->applications()->count(),
		);
		//return $user->applications();
        return view('individual.view_readonly', $data);
    }
}
