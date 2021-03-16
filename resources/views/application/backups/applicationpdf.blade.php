
<!DOCTYPE html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8; IE=edge"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
	<!-- Styles -->
	<!-- Bootstrap core CSS     -->
	<link href="css/dash_css/bootstrap.min.css " rel="stylesheet" />

	<!--  Material Dashboard CSS    -->

	<link href="css/dash_css/material-dashboard.css " rel="stylesheet" />

	<!--<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />-->

	

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

	.table-bordered-pdf,.table-bordered-pdf>tbody>tr>td,.table-bordered-pdf>tbody>tr>th,.table-bordered-pdf>thead>tr>th{
	border-collapse: collapse;
     border: 1px solid black;
}

.col{
    margin-bottom: -99999px;
    padding-bottom: 99999px;
   
}

.col-wrap{
    overflow: hidden; 
}

.rem-padding{
	padding-bottom:-15px;
	padding-top:-15px
}

#tb-parcel td {
   padding:0; margin:0;
}

#tb-parcel,#tb-parcel-doc,#tb-parcel-info,#tb-enterpise td {
   padding:0; margin:0;
}
</style>

</head>

<body style="background-color: #FFF;">

	<div class="content" >
		<div class="row">		
			<div class="card card-profile" style="background: white;">

				<div class="card-content" style="background: white;">
					<div class="row">

						<img class="img" src="{{public_path()}}/img/{{basename('coat_of_arms.png')}}" alt="Avatar" style="max-width: 90px;max-height: 90px;"/>

						<h5 class="category text-black" style="padding-bottom: 0px">MINISTRY OF AGRICULTURE, LAND AND FISHERIES</h5>
						<h5 class="category text-black" style="padding-bottom: 5px">APPLICATION FORM FOR FARMERS REGISTRATION</h5>
						
						<hr>
						
						<div class="col-xs-4" >
							<div class="card-content text-left">
								<h6 class="category" style="padding-top: -25px"><strong>SECTION A</strong>
									<br>
									<strong>APPLICATION NUMBER:</strong> {{$user['data']->id}} 
									<br>
									<strong>APPLICATION DATE:</strong> {{$user['data']->created_at}}
								</h6>
							</div>
						</div>
						<div class="col-xs-2" > </div>
						<div class="col-xs-4" >
							<div class="pull-right" style="padding-top: 10px">                                                    
								<img class="" src="{{public_path() }}/storage/avatars/{{basename($user['user']->avatar)}}" alt="Avatar" style="width:150px;height:160px;">

							</div>
						</div>

					</div>
				</div>

				
			</div>
			<div class="card-content" style="background: white;">
					<!-- <hr> -->
					<div class="row " style="outline: 1px solid gray;padding-bottom:0px">
						<div class="col-xs-4 rem-padding" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><strong>SURNAME:</strong> {{ucfirst($user['user']->l_name)}}</h5>

							</div>

						</div>
						<div class="col-xs-4 rem-padding" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><strong>FARMER ID:</strong> {{$user['user']->farmer()? $user['user']->farmer()->farmer_badge : 'N/A'}}</h5>

							</div>

						</div>
						<div class="col-xs-4 rem-padding" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;padding-left:-30"><strong>PREVIOUS ID:</strong> {{$user['user']->farmer()? ($user['user']->farmer()->badge()? $user['user']->farmer()->badge()->old_badge_id : '') : ''}}</h5>

							</div>

						</div>
						

					</div>
					<div class="row col-wrap"  style="outline: 1px solid gray;">
						<div class="col-xs-4 rem-padding" style="outline: 0px solid gray">
							
							<div class="text-left text-black" >
								<h5 class="description" style="color: #000000; font-size: 15px;"><strong>FIRSTNAME:</strong> {{ucfirst($user['user']->f_name)}}@if($user['user']->alias) <i>({{$user['user']->alias}})</i>@endif</h5>

							</div>

						</div>
						<div class="col-xs-4" style="outline: 1px solid gray;" >
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"> </h5>
							

						</div>
						<div class="col-xs-4"  style="outline: 1px solid gray;">
							
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"> </h5>

						</div>
					</div>
					<div class="row col-wrap"  style="outline: 1px solid gray;">
						<div class="col-xs-4  rem-padding" style="outline: 0px solid gray">
							
							<div class="text-left text-black" >
								<h5 class="description" style="color: #000000; font-size: 15px;"><strong>MIDDLENAME:</strong> {{ucfirst($user['user']->m_name)}}</h5>

							</div>

						</div>
						<div class="col-xs-4" style="outline: 1px solid gray;" >
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"> </h5>
							

						</div>
						<div class="col-xs-4"  style="outline: 1px solid gray;">
							
							<h5 class="description text-black" style="color: #000000; font-size: 15px;"> </h5>

						</div>
					</div>

				</div>
			<div class="card-content text-left">
				<div class="row col-wrap  rem-padding" style="outline: 1px solid gray;">


					<div class="col-xs-3 col" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><strong>SEX:</strong> {{$user['user']->gender->gender}}</h5>
					</div>

					<div class="col-xs-4 col" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"></i><strong>D.O.B:</strong> {{$user['user']->dob}} ({{$user['user']->age}} years)</h5>
					</div>

					@if($user['user']->nationalid)
					<div class="col-xs-4 col" style="outline: 1px solid gray;padding-right:-10px">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="National ID"><strong>NATIONAL ID:</strong> {{$user['user']->nationalid}}</span></h5>
					</div>
					@else
					<div class="col-xs-4 col" style="outline: 1px solid gray;padding-right:-10px">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><strong>NATIONAL ID:</strong> </h5>
					</div>
					@endif

				</div>
				<div class="row col-wrap  rem-padding" style="outline: 1px solid gray;">

					@if($user['user']->homecontact)
					<div class="col-xs-3" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Home Contact"><strong>HOME:</strong> {{$user['user']->homecontact}}</span></h5>
					</div>
					@else
					<div class="col-xs-3" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"> </h5>
					</div>
					@endif

					@if($user['user']->mobilecontact)
					<div class="col-xs-4" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Mobile Contact"><strong>MOBILE:</strong> {{$user['user']->mobilecontact}}</span></h5>
					</div>
					@else
					<div class="col-xs-4" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"> </h5>
					</div>
					@endif

					@if($user['user']->passportid)
					<div class="col-xs-4" style="outline: 1px solid gray;padding-right:-10px">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Passport"><strong>PASSPORT:</strong> {{$user['user']->passportid}}</span></h5>
					</div>
					@else
					<div class="col-xs-4" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><strong>PASSPORT:</strong> </h5>
					</div>

					@endif

				</div>
				<div class="row col-wrap rem-padding" style="outline: 1px solid gray;">
					@if($user['user']->email)
					<div class="col-xs-3 col" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Emergency Contact"> <strong>EMAIL:</strong> {{$user['user']->email}}</span></h5>
					</div>
					@else
					<div class="col-xs-3 col" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Emergency Contact"> <strong>EMAIL:</strong> N/A</span></h5>
					</div>
					@endif
					@if($user['user']->emergencycontact)
					<div class="col-xs-4 col" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Emergency Contact"> <strong>EMERGENCY:</strong> {{$user['user']->emergencycontact}}</span></h5>
					</div>
					@else
					<div class="col-xs-4 col" style="outline: 1px solid gray;">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"> </h5>
					</div>

					@endif

					<div class="col-xs-4 col" style="outline: 1px solid gray;padding-right:-10px">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;"> </h5>
					</div>


				</div>

				<div class="row " style="outline: 1px solid gray;">
					<h5 style="color: #000000;padding-bottom:-15px; padding-left:10px">Address</h5>
					<div class="col-md-6 rem-padding" style="padding-bottom:-10px">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;padding-bottom:-15px">
							<strong> HOME</strong></h5>
							
							<h5 class="description text-black" style="color: #000000; font-size: 15px;">{{ucwords($user['home_address'])}}</h5>
						
					</div>
					@if($user['applicant_type'] === 'Individual')
					@if($user['user']->postal())
					<div class="col-md-6 rem-padding" style="padding-bottom:-10px">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;padding-bottom:-15px">
							<strong> POSTAL</strong></h5>
							
							<h5 class="description text-black" style="color: #000000; font-size: 15px;">{{ucfirst($user['user']->postal()->address)}}</h5>
						
					</div>
					@else
					<div class="col-md-6 rem-padding" style="padding-bottom:-10px">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;padding-bottom:-15px">
							<strong> POSTAL</strong></h5>
							
							<h5 class="description text-black" style="color: #000000; font-size: 15px;">Same As Above</h5>
						
					</div>
					@endif
					@endif
				</div>


				

				<div class="row table-bordered table-condensed rem-padding">
					@if($user['data']->enterprises()->count() >=4)
					<h5 class="category text-left" style="padding-bottom: -25px;padding-top: 10px">ENTERPRISE INFORMATION FOR APPLICATION NUMBER {{$user['data']->id}}</h5>
					@endif
					
					<table id="tb-enterpise" class="table">
						<thead >
							<tr >
								<th style="color: #000000;">Enterprise</th>
								<th style="color: #000000;">Type</th>
							</tr>
						</thead>
						<tbody>
							@foreach($user['data']->enterprises() as $ent)
							<tr>
								<td>{{$ent->enterprise}}</td>
								<td>{{ucfirst($ent->type)}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					
				</div>

				
				
				
				<!--  -->
				<!-- @if($user['data']->enterprises()->count() + $user['data']->parcels()->count() >= 13 || $user['data']->enterprises()->count() + $user['data']->producecount() >= 19 )
					<div class="page-break"></div>
					@endif -->
				<!-- <div class="page-break"></div> -->
				@if($user['data']->enterprises()->count() + $user['data']->parcels()->count() >= 7 || $user['data']->enterprises()->count() + $user['data']->producecount() >= 10 )
					<div class="page-break"></div>
					@endif
					<div class="row">
													
									<h6 class="category text-left" style="padding-TOP: 5px">INFORMATION ON THE PARCELS FARMED/UTILIZED FOR APPLICATION NUMBER {{$user['data']->id}}</h6>
									
										<table cellspacing="0" cellpadding="0" id="tb-parcel" class="table table-bordered rem-padding" style="outline: 1px solid black;">
											<thead>
												<tr>
												<th>Address</th>
												<th>Area(Size)</th>
												<th>Tenure</th>
												<th>Specific Crop/Animal</th>
												<th>Amount</th>
											</tr>
											</thead>
											
											<tbody>
												@foreach($user['data']->parcels() as $n => $parcel)
													@if(!$parcel->produce()->isEmpty())
													@foreach($parcel->produce() as $i => $produce)
													<tr class="{{$n % 2 == 0? 'active' : ''}}" >
														@if($i == 0)
															<td rowspan="{{$parcel->produce_count}}">{{$parcel->land->address->address}}
															</td>
															<td rowspan="{{$parcel->produce_count}}">{{$parcel->area}}

															</td>
															<td rowspan="{{$parcel->produce_count}}">{{$parcel->tenure->tenure}}</td>
														@endif
														<td>{{ucfirst($produce->specific_parcel)}}</td>
														<td>{{number_format($produce->amt,2)}} {{$produce->type->unit->parcel_unit}}</td> 
													</tr>
													@endforeach
													@else
														<tr class="{{$n % 2 == 0? 'active' : ''}}" >
														
															<td>{{$parcel->land->address->address}}
															</td>
															<td>{{$parcel->area}}

															</td>
															<td>{{$parcel->tenure->tenure}}</td>
														
														<td></td>
														<td></td> 
													</tr>
													@endif
												@endforeach
											</tbody>
										</table>
									
							
						
						<div class="clearfix visible-xs visible-sm visible-md visible-lg"></div>
					</div>
					@if($user['data']->enterprises()->count() + $user['data']->parcels()->count() >= 7 || $user['data']->enterprises()->count() + $user['data']->producecount()  >= 10 )
					@else
					<div class="page-break"></div>
					@endif
				<div class="row " style="outline: 1px solid black;">
					<table id="tb-parcel-doc" class="table table-bordered">
						<thead >
							<tr >
								<th  class="text-center"  style="color: #000000;">Parcel Number</th>
								<th  style="color: #000000;">Submitted Documents</th>
								<th  style="color: #000000;">Brief Description</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach($user['data']->parcels() as $n => $parcel)


							@foreach($parcel->proofs as $i => $proof)
							<tr>
								@if($i == 0)
								<td rowspan="{{count($parcel->proofs)}}" class="text-center" style="padding:0; margin:0;">{{$n+1}}</td>
								@endif
								<td style="padding:0; margin:0;">{{$proof->proof_code->proof}}</td>
								<td style="padding:0; margin:0;">-</td>
							
							</tr>
							@endforeach

							@endforeach

						</tbody>
					</table>
				</div>
				<!-- <hr> -->
				<div class="container">
					<div class="row" style="padding-top:-8px">
						<h6 class="category text-left" >SIGNATURES FOR APPLICATION NUMBER {{$user['data']->id}} </h6>
					</div> 
					<div class="row" style="outline: 1px solid black;">
						<div class="col-xs-6 text-left">
							<h5 class="description text-black" style="color: #000000; font-size: 12px;">
								SIGNATURE OF {{strtoupper($user['user']->name)}}@if($user['user']->alias) <i>({{strtoupper($user['user']->alias)}})</i>@endif
								
							</h5>
							
								<h5 class="description text-black" style="color: #000000; font-size: 15px;">_______________________________________________________</h5>
						</div>
						<div class="col-xs-4">
							<h5 class="description text-black" style="color: #000000; font-size: 12px;">DATE: 	{{Carbon\Carbon::now()->format('d-m-Y')}}</h5>
						</div>
					</div>
					<div class="row" style="outline: 1px solid gray;">
						<div class="col-xs-6">
							<h5 class="description text-black" style="color: #000000; font-size: 12px;">
								SIGNATURE OF FARMER REGISTRATION CLERK
								
							</h5>
							
								<h5 class="description text-black" style="color: #000000; font-size: 15px;">_______________________________________________________</h5>
						</div>
						<div class="col-xs-4">
							<h5 class="description text-black" style="color: #000000; font-size: 12px;">DATE: 	{{Carbon\Carbon::now()->format('d-m-Y')}}</h5>
						</div>
					</div>
					
					
					<!-- <div class="page-break"></div> -->
					
					<div class="row">
						<div class="text-left" style="background: grey;padding-top:-5px;padding-bottom:-5px">
							<h6 class="category" >FOR OFFICIAL USE ONLY (APPLICATION NUMBER: {{$user['data']->id}})</h6>
						</div>
						<h6 class="category text-left" style="padding-top:-5px;padding-bottom:-5px">VERIFICATION OF PARCEL USE FOR: {{$user['user']->name}}@if($user['user']->alias) <i>({{$user['user']->alias}})</i>@endif</h6>

						<table id="tb-parcel-info" class="table table-bordered table-sm" style="border: 1px solid black">
							<tr>
								<th rowspan="2" style="width:15px">Item No</th>
								<th class="text-center" colspan="3">Location of Parcels</th>

								<th rowspan="2" style="width:20px">Verified Tenure</th>
								<th class="text-center" colspan="3" rowspan="2" style="width:250px">Documents Supplied</th>
							</tr>
							<tr>

								<th >County</th>
								<th >District</th>
								<th>Locality</th>

							</tr>
							<tbody>
								@foreach($user['data']->parcels() as $n => $parcel)
								@foreach($parcel->produce() as $i => $produce)
								@if($i == 0)
								<tr>

									<td class="text-center" rowspan="3">{{$n+1}}</td>
									<td class="text-center" rowspan="3">{{$parcel->land->address->district->ward->county->county}}</td>
									<td class="text-center" rowspan="3">{{$parcel->land->address->district->farmer_district_id !=0? $parcel->land->address->district->farmdistrict()->first()->district_name : $parcel->land->address->district->district}}</td>
									<td class="text-center" rowspan="3">{{$parcel->land->address->locality}}</td>
									<td class="text-center" rowspan="3">{{$parcel->tenure->id}} {{$parcel->tenure->tenure}}</td>
									<td class="text-center" colspan="3" rowspan="3" style=";padding-bottom: -5px">
										@foreach($parcel->proofs as $i => $proof)
									
										<ul class="list-inline" style="display:block">
											<li class="list-inline-item"><input type="checkbox">{{$proof->proof_code->proof}}</li>
											
										</ul>
									
									@endforeach
									</td>
									

								</tr>
								<tr ></tr>
								<tr ></tr>
								@endif
								@endforeach
								@endforeach

							</tbody>
						</table>
					</div>
					@if($user['data']->parcels()->count() >= 3)
					<div class="page-break"></div>
					@endif
					<div class="row">
						@if($user['data']->parceldocumentcount() >= 4)
						<div class="text-left" style="background: grey;">
							<h6 class="category" >FOR OFFICIAL USE ONLY (APPLICATION NUMBER: {{$user['data']->id}})</h6>
						</div>

						<h6 class="category text-left" >VERIFICATION OF PARCEL USE FOR: {{$user['user']->name}}@if($user['user']->alias) <i>({{$user['user']->alias}})</i>@endif</h6>
						@endif
						<table class="table table-bordered" style="border: 1px solid black;padding-top: -10px">
							<thead style="border: 1px solid black;">
										<tr  style="border: 1px solid black;">

											<th height="100" colspan="2" style="vertical-align:top;border: 1px solid black;">Remarks:</th>
											<th colspan="2" style="vertical-align:top;border: 1px solid black;">Remarks:</th>
											<th colspan="2" style="vertical-align:top;border: 1px solid black;">Remarks:</th>
										</tr>	
										</thead>								
									<tbody style="border: 1px solid black;">
										@if($user['data']->parcelcomments()||$user['data']->parcelaa3comments()||$user['data']->parcelao1comments())

										<tr  style="border: 1px solid black;">
											<td colspan="2" style="border: 1px solid black;">
												<h6><small>
												@foreach($user['parcelcomments'] as $parcelcomment)
													{{$parcelcomment->comments}}<br>
												@endforeach</small></h6>
											</td>
											<td colspan="2" style="border: 1px solid black;">
												<h6><small>
												@foreach($user['data']->parcelaa3comments() as $parcelaa3comment)
													{{$parcelaa3comment->comments}}<br>
												@endforeach</small></h6>
											</td>
											
											<td colspan="2" style="border: 1px solid black;">
												<h6><small>
												@foreach($user['data']->parcelao1comments() as $parcelao1comment)
													{{$parcelao1comment->comments}}<br>
												@endforeach</small></h6>
											</td>

										</tr>
										
										@endif
										
										<tr style="border: 1px solid black;">											
											<td width="40" style="border: 1px solid black;padding:0; margin:0;"><h6 style="color: #000000; font-size: 10px;">OFFICER NAME</h6></td>					
											<td width="40" style="border: 1px solid black;padding-bottom: -15px"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;padding:0; margin:0;"><h6 style="color: #000000; font-size: 10px;">AAIII NAME</h6></td>												
											<td width="40" style="border: 1px solid black;padding-bottom: -15px"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;padding:0; margin:0;"><h6 style="color: #000000; font-size: 10px;">AOI NAME</h6></td>												
											<td width="40" style="border: 1px solid black;padding-bottom: -15px"><input type="text" size="12"></td>
										</tr>
										<tr style="border: 1px solid black;">
											
											<td style="border: 1px solid black;padding:0; margin:0;"><h6 style="color: #000000; font-size: 10px;">SIGNATURE</h6></td>
												
											<td width="40" style="border: 1px solid black;padding-bottom: -15px"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;padding:0; margin:0;"><h6 style="color: #000000; font-size: 10px;">SIGNATURE</h6></td>												
											<td width="40" style="border: 1px solid black;padding-bottom: -15px"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;padding:0; margin:0;"><h6 style="color: #000000; font-size: 10px;">SIGNATURE</h6></td>												
											<td width="40" style="border: 1px solid black;padding-bottom: -15px"><input type="text" size="12"></td>
										</tr>
										<tr style="border: 1px solid black;">
											<td style="border: 1px solid black;padding:0; margin:0;"><h6 style="color: #000000; font-size: 10px;">DATE</h6></td>
												
											<td width="40" style="border: 1px solid black;padding-bottom: -15px"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;padding:0; margin:0;"><h6 style="color: #000000; font-size: 10px;">DATE</h6></td>												
											<td width="40" style="border: 1px solid black;padding-bottom: -15px"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;padding:0; margin:0;"><h6 style="color: #000000; font-size: 10px;">DATE</h6></td>												
											<td width="40" style="border: 1px solid black;padding-bottom: -15px"><input type="text" size="12"></td>
										</tr>
									</tbody>
						</table>
					</div>

				
			</div>
		</div>
	</div> 


</body>          
</html>