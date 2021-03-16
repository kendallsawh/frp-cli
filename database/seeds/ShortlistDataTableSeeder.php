<?php

use Illuminate\Database\Seeder;

class ShortlistDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
    	DB::table('app_land_tenure')->insert([
    		['app_id' => '1', 'land_id' => '1','tenure_id' => '7'],
    		['app_id' => '2', 'land_id' => '2','tenure_id' => '2'],
    		['app_id' => '2', 'land_id' => '3','tenure_id' => '2'],
    		['app_id' => '2', 'land_id' => '6','tenure_id' => '2'],
    		['app_id' => '3', 'land_id' => '5','tenure_id' => '5'],
    		['app_id' => '3', 'land_id' => '1','tenure_id' => '5'],
    		['app_id' => '3', 'land_id' => '4','tenure_id' => '2'],
    		['app_id' => '4', 'land_id' => '1','tenure_id' => '8'],
    		['app_id' => '5', 'land_id' => '2','tenure_id' => '2'],
    		['app_id' => '5', 'land_id' => '2','tenure_id' => '1'],
    		['app_id' => '5', 'land_id' => '2','tenure_id' => '8'],
    		['app_id' => '5', 'land_id' => '1','tenure_id' => '5'],
    		['app_id' => '5', 'land_id' => '1','tenure_id' => '6'],
    		['app_id' => '5', 'land_id' => '1','tenure_id' => '7'],
    		['app_id' => '5', 'land_id' => '1','tenure_id' => '8'],
    		['app_id' => '6', 'land_id' => '1','tenure_id' => '6'],
    		['app_id' => '7', 'land_id' => '5','tenure_id' => '6'],
    		['app_id' => '8', 'land_id' => '1','tenure_id' => '5'],
    		['app_id' => '8', 'land_id' => '1','tenure_id' => '7'],
    		['app_id' => '8', 'land_id' => '1','tenure_id' => '8'],
    		['app_id' => '9', 'land_id' => '2','tenure_id' => '1'],
    		['app_id' => '9', 'land_id' => '2','tenure_id' => '2'],
    		['app_id' => '10', 'land_id' => '2','tenure_id' => '1'],
    		['app_id' => '10', 'land_id' => '2','tenure_id' => '2'],
    		['app_id' => '11', 'land_id' => '2','tenure_id' => '2'],
    		['app_id' => '11', 'land_id' => '3','tenure_id' => '2'],
    		['app_id' => '12', 'land_id' => '2','tenure_id' => '3'],
    		['app_id' => '13', 'land_id' => '3','tenure_id' => '2'],
    		['app_id' => '14', 'land_id' => '5','tenure_id' => '5'],
    		['app_id' => '15', 'land_id' => '1','tenure_id' => '7'],
    	]);
    }
}
