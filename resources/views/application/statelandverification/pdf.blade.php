
<!DOCTYPE html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8; IE=edge"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{url('/img/coat_of_arms.png')}}" />
	

	<!-- Styles -->
	<!-- Bootstrap core CSS     -->
	<link href="css/dash_css/bootstrap.min.css " rel="stylesheet" />

	<!--  Material Dashboard CSS    -->

	<link href="css/dash_css/material-dashboard.css " rel="stylesheet" />

	<!--<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />-->

	<!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="css/dash_css/demo.css " rel="stylesheet" />

	<!--     Fonts and icons     -->
	<link href="css/dash_css/font-awesome.min.css " rel="stylesheet" />
	<link href="css/pdf_css/pdf.css " rel="stylesheet"  />

	<link href="css/datepicker/bootstrap-datepicker.css " rel="stylesheet" />
	<link href="css/style.css " rel="stylesheet" />

	<link href="css/jquery-ui.css" rel="stylesheet" />
	<style>
	.page-break {
		page-break-after: always;
	}
</style>

</head>

<body style="background-color: #FFF;">

	<div class="content" >
		<div class="row">		
			<div class="card card-profile" style="background: white;;">

				<div class="card-content" style="background: white;;">
					<div class="row">

						<h4 class="category text-black" style="padding-bottom: 20px">MINISTRY OF AGRICULTURE, LAND AND FISHERIES</h4>
						<h4 class="category text-black" style="padding-bottom: 20px">VERIFICATION OF LAND STATUS(STATELAND) FOR FARMERS REGISTRATION</h4>
						<hr>
						<div class="card-content text-left">
							<h4 class="category" style="padding-bottom: 20px">SECTION A</h4>
						</div>
						<div class="col-md-12">
							<div class="card-title text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$user['user']->name}}@if($user['user']->alias) <i>({{$user['user']->alias}})</i>@endif</h5>

							</div>

						</div>

					</div>
				</div>

				<div class="card-content text-left text-black">
					<div class="row">


						<div class="col-md-4 col-sm-4 col-xs-4">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Age"> <i class="fa fa-fw fa-calendar" aria-hidden="true" style="padding-right:10px"></i> {{$user['user']->age}} years</span></h5>
						</div>

						@if($user['user']->nationalid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="National ID"> <i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i> {{$user['user']->nationalid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif

						@if($user['user']->driverid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Driver&#39;s Permit"> <i class="fa fa-fw fa-drivers-license-o" aria-hidden="true" style="padding-right:10px"></i> {{$user['user']->driverid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif

						@if($user['user']->passportid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Passport"> <i class="fa fa-fw fa-address-book" aria-hidden="true" style="padding-right:10px"></i> {{$user['user']->passportid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif

						@if($user['user']->homecontact)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Home Contact"> <i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i> {{$user['user']->homecontact}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif

						@if($user['user']->mobilecontact)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Mobile Contact"> <i class="fa fa-fw fa-mobile" aria-hidden="true" style="padding-right:10px"></i> {{$user['user']->mobilecontact}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif



						@if($user['user']->emergencycontact)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Emergency Contact"> <i class="fa fa-fw fa-phone" aria-hidden="true" style="padding-right:10px"></i> {{$user['user']->emergencycontact}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif

						@if($user['user']->address)
						<div class="col-md-4">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="District"> <i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i> {{$user['applicant_type'] === 'Individual'? $user['user']->home()->district->district : $user['user']->address->district->district}}</span></h5>
						</div>
						@endif

					</div>
					<hr>

					<h5>Address</h5>


					<div class="row">
						<div class="col-md-6">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;">
								<i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i> Home
								<br>
								<small>{{$user['home_address']}}</small>
							</h5>
						</div>
						@if($user['applicant_type'] === 'Individual')
						@if($user['user']->postal())
						<div class="col-md-6">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;">
								<i class="fa fa-fw fa-envelope" aria-hidden="true" style="padding-right:10px"></i> Postal
								<br>
								<small>{{$user['user']->postal()->address}}</small>
							</h5>
						</div>
						@endif
						@endif
					</div>
					<hr>

					<div class="page-break"></div>
				</div>
				<div class="card-content text-left">
					<h4>Section B</h4>
					<h5>State Land Section</h5>
					<h5>Status:</h5>
					<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label text-black" style="margin-top: -9px; color: #000000; font-size: 13px;">Recommended for SAL </label>
								<textarea class="form-control text-black" name="details" id="details">{{old('details')}}</textarea>

							</div>
							<hr style="margin-bottom: -7px; margin-top: 20px; margin-left: -1px;">
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label text-black" style="margin-top: -9px; color: #000000; font-size: 13px;">Cabinet Note</label>
								<textarea class="form-control text-black" name="details" id="details">{{old('details')}}</textarea>

							</div>
							<hr style="margin-bottom: -7px; margin-top: 20px; margin-left: -1px;">
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label class="control-label text-black" style="margin-top: -9px; color: #000000; font-size: 13px;">Years in Occupation</label>
								<textarea class="form-control text-black" name="details" id="details">{{old('details')}}</textarea>

							</div>
							<hr style="margin-bottom: -7px; margin-top: 20px; margin-left: -1px;">
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">

							<label class="control-label text-black" style="color: #000000; font-size: 13px;">UPRN</label>
							<textarea class="form-control text-black" name="details" id="details">{{old('details')}}</textarea>

						</div>
						<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
							<hr style="margin-bottom: -7px; margin-top: 40px; margin-left: -1px;">	
						</div>



					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label text-black" style="margin-top: -9px; color: #000000; font-size: 13px;">Comments/Remarks</label>
						</div>
						<hr style="margin-bottom: -9px; margin-top: 5px; margin-left: -1px;">
						<hr style="margin-bottom: -9px; margin-top: 27px; margin-left: -1px;">
						
					</div>
				</div>
				<div class="row" >
					<div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">

						<label class="control-label text-black" style="color: #000000; font-size: 13px;"> Enterprise</label>

					</div>
					<div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
						<!-- <label class="control-label fa fa-fw fa-square-o fa-lg"></label> -->
						<label class="control-label text-black" style="color: #000000; font-size: 10px;"><i class="fa fa-fw fa-square-o fa-lg"></i> CROPS</label>


					</div>
					<div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
						<!-- <label class="control-label fa fa-fw fa-square-o"></label> -->
						
						<label class="control-label text-black" style=" color: #000000; font-size: 10px;"><i class="fa fa-fw fa-square-o fa-lg"></i> LIVESTOCK</label>

					</div>
					<div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
						<!-- <label class="control-label fa fa-fw fa-square-o"></label> -->
						<label class="control-label text-blackl" style="color: #000000; font-size: 10px;"><i class="fa fa-fw fa-square-o fa-lg"></i> MIXED</label>
					</div>

				</div>
				<div class="row">
					<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">                       			
						<label class="control-label text-black" style="padding-top: 5px; color: #000000; font-size: 13px;"> Size of Plot</label>
						<hr style="margin-bottom: -5px; margin-top: 45px;">	
					</div>

					<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">

						<label class="control-label text-black" style="padding-top: 5px; color: #000000; font-size: 13px;"> Percentage Cultivation</label>
						<hr style="margin-bottom: -5px; margin-top: 45px;">
					</div>	


				</div>
				<br>
				<div class="row">
					<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">

						<label class="control-label text-black" style="margin-top: 20px; color: #000000; font-size: 13px;">District Stateland Offcer/Extention Officer Signature</label >

					</div>
					<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
						<hr style="margin-bottom: -1px; margin-top: 50px; margin-left: -1px;">	
					</div>
				</div>
				<div class="row" style="padding-bottom: 8px;">

					<div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
						<!-- <label class="control-label fa fa-fw fa-square-o fa-2x"></label> -->
						
						<label class="control-label text-black" style="color: #000000; font-size: 13px;"><i class="fa fa-fw fa-square-o fa-lg"></i> AIP Recommended</label>


					</div><div class="clearfix visible-xs"></div>
					<div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
						<!-- <label class="control-label fa fa-fw fa-square-o fa-2x"></label> -->
						
						<label class="control-label text-black" style="color: #000000; font-size: 13px;"><i class="fa fa-fw fa-square-o fa-lg"></i> AIP Not Recommended</label>

					</div><div class="clearfix visible-xs"></div>

				</div>
				<div class="row">

					<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">

						<label class="control-label text-black" style="margin-top: 25px;color: #000000; font-size: 13px;">AAIII/Stateland Offcer/AAIII Extention Officer Signature</label >

					</div>
					<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
						<hr style="margin-top: 50px; margin-left: -1px;">	
					</div>

				</div>

			</div>
		</div>
	</div> 


</body>          
</html>