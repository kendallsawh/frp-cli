<?php

Route::group(['prefix' => 'admin'], function () {
	Voyager::routes();
});

Auth::routes();


/*
|-----------------------------------------------------------------------------
| Middleware role groups for access
|-----------------------------------------------------------------------------
|
| Supported: "auth", "role_frc", "role_c2", "role_cc", "role_dfo", "role_aa3", 
| "role_ao1", "role_director", "role_admin",
|
*/
Route::group(['middleware' => ['auth','sanitize']], function () {

	/** Home and Dashboard **/
	Route::get('/', function () {
	    //return view('welcome');
		return redirect('home');
	});
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/changePassword','HomeController@showChangePasswordForm');
	Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

	/**Admin Routes**/
	Route::get('/user/admin', 'UserController@adminStuff')->name('adminLvl');
	

	/** Farmer Registration Routes **/
	Route::get('/farmer/register', 'FarmerController@register')->name('farmerRegister');
	Route::post('farmer/type', 'FarmerController@type')->name('farmerRegisterType');
	Route::get('/farmer/list', 'FarmerController@listing')->name('farmerList');
	Route::get('/farmer/list/reference/{id?}', 'FarmerController@listreference');
	Route::post('farmer/register/addfarmer', 'FarmerController@addindfarmer')->name('farmerAddFarmer');
	Route::get('/entitytable', 'FarmerController@servProviderExistFarm');

	// Individual routes
	Route::get('/farmer/register/individual', 'IndividualRegisterController@registerIndividual')->name('farmerRegisterIndividual');
	Route::post('farmer/register/individual', 'IndividualRegisterController@individualInsert')->name('farmerRegisterInsert');
	Route::post('/checknid','IndividualRegisterController@checknid')->name('farmerRegisterCheckNid');
	Route::post('/checkdistrict','IndividualRegisterController@districtCountyCheck');
	


	Route::post('farmer/renew', 'FarmerBadgeController@renew')->name('farmerRenew');
	Route::post('farmer/replace', 'FarmerBadgeController@replace')->name('farmerReplace');

	// Organization routes
	Route::get('/farmer/register/organization', 'OrganizationRegisterController@register')->name('organizationRegister');
	Route::get('/company/edit/{id?}', 'OrganizationRegisterController@editOrganizationView')->name('organizationEdit');
	Route::get('/company/companyedit/companyrep/edit/{id?}/{companyid}', 'OrganizationRegisterController@editOrganizationRepsView')->name('organizationEditReps');
	Route::post('/farmer/register/organization', 'OrganizationRegisterController@organizationInsert')->name('organizationInsert');
	Route::post('company/edit/organization', 'OrganizationRegisterController@organizationEditInsert')->name('editOrganizationData');
	Route::post('/company/edit/organization.rep', 'OrganizationRegisterController@organizationRepEditInsert')->name('organizationRepEditInsert');
	
	// Service Provider routes
	Route::get('/farmer/register/provider', 'ProviderRegisterController@registerProvider')->name('farmerRegisterProvider');
	Route::post('farmer/register/provider', 'ProviderRegisterController@insertProvider')->name('farmerInsertProvider');


	/** Individual routes **/

	Route::get('/individual/list', 'IndividualController@listing')->name('individualList');
	Route::get('/individual/webregistered', 'IndividualController@listingWebRegister')->name('individualListWebRegistered');
	Route::get('/individual/view/{id?}', 'IndividualController@view');
	Route::get('/individual/edit/{id?}', 'IndividualRegisterController@editIndividual');
	Route::post('farmer/edit/individual', 'IndividualRegisterController@personalInfoEdit')->name('editIndividualData');
	//Route::post('farmer/edit/individual/application', 'IndividualRegisterController@individualApplicationEdit')->name('editIndividualApplicationData');
	Route::get('/search','IndividualController@search');
	Route::get('/searchuprn','IndividualController@searchUprn');
	Route::get('/user/find', 'IndividualController@searchName');
	Route::get('/ajaxIndLnk','ApplicationController@ajaxReturnData');
	

	/** Organization routes **/
	Route::get('/organization/list', 'OrganizationController@listing')->name('organizationList');
	Route::get('/organization/view/{id?}', 'OrganizationController@view');

	/** Service Provider routes **/
	Route::get('/provider/list', 'ProviderController@listing')->name('providerList');
	Route::get('/provider/view/{id?}', 'ProviderController@view');
	Route::post('provider/flag', 'ProviderController@flagApplication')->name('flagServiceProvider');
	Route::post('provider/verify', 'ProviderController@verification')->name('verifyServiceProvider');
	Route::post('provider/add_comment', 'ProviderController@addDFOComments')->name('addServiceProviderComment');
	Route::post('provider/add_dfo_comment', 'ProviderController@addDFOVerify')->name('addSPDFOVerify');
	Route::post('/provider/assign/{id?}/{parcelid}', 'ApplicationUserController@assingnServProvToSelf')->name('appSpAssignToSelf');
	Route::get('/badge/find', 'ProviderRegisterController@searchBadge');
	Route::post('/checkfrmnum','ProviderRegisterController@checkfrmnum');
	Route::get('/sp_search','ProviderRegisterController@search');

	/** Application list **/
	Route::get('/application/list/all', 'ApplicationController@listing')->name('applicationList');
	Route::get('/application/list/pending', 'ApplicationController@pending')->name('applicationListPending');
	Route::get('/application/list/approved', 'ApplicationController@approved')->name('applicationListApproved');
	Route::get('/application/list/flagged', 'ApplicationController@flagged')->name('applicationListFlagged');
	Route::get('/application/list/outofcounty', 'ApplicationController@ooc_listing')->name('applicationListOurofCounty');
	Route::get('/application/view/{id?}', 'ApplicationController@view'); 
	Route::get('/application/edit/{id?}/{parcelid}', 'ApplicationController@editApplication');
	Route::get('/application/addparcel/{id?}', 'ApplicationController@addParcel');
	Route::post('application/upload', 'ApplicationController@appScanUpload')->name('uploadApp');
	Route::post('/application/addparcelland/{id?}', 'ApplicationController@addParcelLand')->name('addParcelLand');
	Route::get('/application/add_application/{id?}', 'ApplicationController@addApplication')->name('addApplication');
	Route::get('/application/force/{id?}', 'ApplicationController@forceApprove')->name('force');
	Route::post('/application/insert_application/', 'ApplicationController@insertNewApplication')->name('insertNewApplicationData');
	Route::post('/application/edit_app/', 'ApplicationController@applicationEditCommit')->name('postApplicationDataEdits');
	Route::post('/updateArea','ApplicationController@updateAreaData');
	Route::post('/application/transfer/', 'ApplicationController@transfer')->name('farmerTransfer');
	/** Application approval routes **/
	Route::get('/application/list/director_approval/{id?}/{indid}', 'ApplicationController@directorListVerification');
	Route::post('/application/list/ao1_approval', 'ApplicationController@ao1ListVerification')->name('ao1ListVerification');

	/** Application Parcel **/
	Route::get('/application/list/add_uprn', 'ApplicationController@uprnlist')->name('parcelUprnList');
	Route::post('/application/list/submit_uprn/', 'ApplicationController@listaddUPRNS')->name('listsubmitUprn');
	

	/**Application Executive view list**/
	Route::get('/application/list/pending/{id?}', 'ApplicationController@execPending');
	Route::get('/application/list/approved/{id?}', 'ApplicationController@execApproved');
	Route::get('/application/list/flagged/{id?}', 'ApplicationController@execFlagged');
	/**Application User routes**/
	Route::get('/application/list/your_pending/', 'ApplicationUserController@listing')->name('applicationUserPending');
	Route::post('/application/view/assign', 'ApplicationUserController@assingnAppToSelf')->name('appAssignToSelf');
	Route::get('/application/view/assign/{id?}/{parcelid}', 'ApplicationUserController@assingnAppToUser')->name('appAssignToUser');
	Route::get('/producelist/{id?}', 'ApplicationUserController@producechecklist');

	/*Crop Monitoring Routes*/
	
	Route::post('application/cropmonitor/upload', 'CropMonitorController@insert')->name('cropMonitorInsert');
	Route::get('/application/cropmonitor/{id?}', 'CropMonitorController@view')->name('cropMonitor');
	/*user routes*/
	Route::get('/user/view/disable/list', 'UserController@disable_listing')->name('disableUserAcctList');
	Route::get('/user/view/disable/list/{id?}', 'UserController@destroy')->name('disableUserAcct');
	Route::post('/home', 'UserController@notifications')->name('showNotifications');
	Route::get('/view/profiles/user/{id?}', 'UserController@viewProfile')->name('viewProfile');
	Route::get('/view/county_user/list', 'UserController@countyStaffList')->name('countyStaffList');

	/**State Land Verification routes**/
	Route::get('application/statelandverification/statelandform', 'StateLandVerifyController@index')->name('testRenew');
	/**Complete SLV application routes**/
	Route::post('application/statelandverification/complete', 'StateLandVerifyController@insert')->name('completeSLV');
	/*Staeland uprns list*/
	Route::post('application/add_uprns', 'ApplicationController@addUPRNS')->name('addUPRNS');
	//Route::get('application/stateland_uprns/list','StateLandVerifyController@listing')->name('statelandList');

	/**Pdf routes**/
	Route::post('/statelandverification/pdf/{id}','PdfController@downloadPDF');
	Route::post('/statelandverification/application/{id}','PdfController@applicationPDF');
	Route::post('/serviceprovider/application/{id}','PdfController@spApplicationPDF');

	/**DNQ application routes**/
	Route::post('application/dnq', 'ApplicationController@dnqApplication')->name('dnqApplication');

	/**Flag application routes**/
	Route::post('application/flag', 'ApplicationController@flagApplication')->name('flagApplication');

	/**Reset application status routes**/
	Route::post('application/reset_status', 'ApplicationController@resetAppStatus')->name('resetApplication');

	/**Verification application routes**/
	Route::post('application/verify', 'ApplicationController@verification')->name('verifyApplication');

	/*Add User comments to application*/
	Route::post('application/add_comment', 'ApplicationController@addDFOComments')->name('addApplicationComment');
	Route::post('application/add_dfo_comment', 'ApplicationController@addDFOVerify')->name('addDFOVerify');

	/**Report Routes**/
	Route::get('reports/land_types_statistics', 'ReportController@landTypes')->name('landTypes');
	Route::get('reports/commodity_statistics', 'ReportController@commodity')->name('commodityIndex');
	Route::post('reports/commodity_statistics', 'ReportController@commodityStat')->name('commodityStat');
	Route::get('reports/commodity_parcel_listing/{id?}/{anicrop}','ReportController@listing')->name('commodityStatListing');
	Route::get('reports/cso_report', 'ReportController@csoRegionReport')->name('csoReport');
	Route::get('reports/cso_listing/{id?}/{dataType}', 'ReportController@csoListing')->name('csoListing');
	Route::get('reports/monthly', 'ReportController@monthly')->name('monthlyReport');
	Route::post('reports/monthly_submit', 'ReportController@monthlySubmit')->name('monthlyReportSubmit');
	Route::post('/monthly_breakdown', 'ReportController@monthlybreakdown')->name('monthlyReportBreakdown');
	Route::get('reports/victoria/report_1', 'ReportController@victoria')->name('victoria');
	Route::get('reports/landquery','ReportController@landquery')->name('landquery');
	Route::post('reports/landqueryresult','ReportController@landqueryresult')->name('landqueryresult');
	

	Route::get('storage/avatars/{filename}', function ($filename)
	{
		$path = storage_path('public/avatars/' . $filename);

		if (!File::exists($path)) {
			abort(404);
		}

		$file = File::get($path);
		$type = File::mimeType($path);

		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);

		return $response;
	});


});

/** sidebar ajax **/
Route::get('/sidebar', 'SidebarViewController@index')->name('setSidebarMini');
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