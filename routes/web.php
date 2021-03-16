<?php

Route::get('/',  function () {
    //return view('welcome');
    return view('welcome');
});
Auth::routes(['verify' => true]);
	
	Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');;
	Route::get('/changePassword','HomeController@showChangePasswordForm');
	Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

	/**Admin Routes**/
	
	

	/** Farmer Registration Routes **/
	Route::get('/farmer/register', 'FarmerController@register')->name('farmerRegister');
	Route::post('farmer/type', 'FarmerController@type')->name('farmerRegisterType');
	/*Route::get('/farmer/list', 'FarmerController@listing')->name('farmerList');*/


	// Individual routes
	Route::get('/farmer/register/individual', 'IndividualRegisterController@registerIndividual')->name('farmerRegisterIndividual');
	Route::post('farmer/register/individual', 'IndividualRegisterController@individualInsert')->name('farmerRegisterInsert');
	Route::post('/checknid','IndividualRegisterController@checknid')->name('farmerRegisterCheckNid');
	Route::post('/checkdistrict','IndividualRegisterController@districtCountyCheck');
		

	// Organization routes
	/*Route::get('/farmer/register/organization', 'OrganizationRegisterController@register')->name('organizationRegister');
	Route::get('/company/edit/{id?}', 'OrganizationRegisterController@editOrganizationView')->name('organizationEdit');
	Route::get('/company/companyedit/companyrep/edit/{id?}/{companyid}', 'OrganizationRegisterController@editOrganizationRepsView')->name('organizationEditReps');
	Route::post('/farmer/register/organization', 'OrganizationRegisterController@organizationInsert')->name('organizationInsert');
	Route::post('company/edit/organization', 'OrganizationRegisterController@organizationEditInsert')->name('editOrganizationData');
	Route::post('/company/edit/organization.rep', 'OrganizationRegisterController@organizationRepEditInsert')->name('organizationRepEditInsert');
	
	// Service Provider routes
	Route::get('/farmer/register/provider', 'ProviderRegisterController@registerProvider')->name('farmerRegisterProvider');
	Route::post('farmer/register/provider', 'ProviderRegisterController@insertProvider')->name('farmerInsertProvider');*/


	/** Individual routes **/
	
	Route::get('/individual/view/{id?}', 'IndividualController@view');

	/** Organization routes **/
	
	Route::get('/organization/view/{id?}', 'OrganizationController@view');

	/** Service Provider routes **/
	
	Route::get('/provider/view/{id?}', 'ProviderController@view');


	/** Application list **/
	
	Route::get('/application/view/{id?}', 'ApplicationController@view'); 

	/**/

/** sidebar ajax **/
Route::get('/sidebar', 'SidebarViewController@index')->name('setSidebarMini');

Route::post('/get_appointment', 'AppointmentController@ajaxGetAppointment')->name('ajaxGetAppointment');
/*
Route::get('/test', function(){
	//echo phpinfo();
	$dt = \Carbon\Carbon::parse('2014-07-25');
		$now = \Carbon\Carbon::now();
		echo $dt->diffInYears($now)."<br>";
        if ($dt->diffInYears($now) >= 3) 
	        echo 'true';
	    else
	    	echo 'false';
})->name('test');*/

