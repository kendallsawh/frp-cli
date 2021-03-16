<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class TableController extends Controller
    {
        public function table()
        {
        	$data = array(
                'nav' => ['nav-tab','nav-tab-1'],
                'navTabIn' => 'in',
    			'title' => 'Table',
    		);
    		
            return view('table.table', $data);
        }
    }
