<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SidebarViewController extends Controller{

    public function index()
    {
        if (session()->exists('view')) {
        	session()->forget('view');
        	//return response()->json(['msg' => session()->exists('view')], 200);
        }else{
        	session(['view' => 'sidebar-mini']);
        	//return response()->json(['msg' => session()->exists('view')], 200);
        }
    }
}
