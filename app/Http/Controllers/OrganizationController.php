<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use DB;

class OrganizationController extends Controller
{
    public function view($id)
    {
       $org = \App\Organization::find($id);
        if(!$org) return back()->with('flashed', 'That Organization does not exist');

        $data = array(
            'nav' => ['nav-funct', 'nav-funct-6'],
            'navFunctIn' => 'in',
            'title' => $org->name,
            'data' => $org,
            'appcount' => empty($org->applications()->count())? 0 : $org->applications()->count(),
            'applications' => $org->applications(),
            'rep_types' => \App\ReplacementType::all(),
        );
        
        return view('company.view', $data);
    }

    public function listing()
    {
        $data = array(
            'nav' => ['nav-funct','nav-funct-6'],
            'navFunctIn' => 'in',
            'title' => 'Organization List',
            'organizations' => \App\Organization::all(),
        );
        
        return view('company.list', $data);
    }
}
