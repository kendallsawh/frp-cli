
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

	.table-bordered-pdf,.table-bordered-pdf>tbody>tr>td,.table-bordered-pdf>tbody>tr>th,.table-bordered>thead>tr>th{
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
						<hr style="padding-bottom: -25px; padding-top: -50px">
						<div class="col-xs-5" >
							<div class="card-content text-left">
								<h6><br><strong>APPLICATION NUMBER:</strong> {{$user['data']->id}} <br><strong>APPLICATION DATE:</strong> {{$user['data']->created_at}}</h6>
								<div class="text-left text-black">
									<h6 class="description" style="color: #000000; font-size: 15px;padding-bottom: -25px; padding-top: -20px"><i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px;"></i><strong>FARMER ID:</strong> {{$user['user']->farmer()? $user['user']->farmer()->badge()->farmer_badge : 'N/A'}}</h6>

								</div>
								<div class="text-left text-black">
									<h6 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i><strong>PREVIOUS ID:</strong> {{$user['user']->farmer()? $user['user']->farmer()->badge()->old_badge_id : 'N/A'}}</h6>

								</div>
							</div>
						</div>

						
						<div class="col-xs-3" >
							<div class="card-avatar  rounded mx-auto d-block" style="padding-top: 50px">
								<h6>Representative 1</h6>                                                    
								<img class="img" src="{{public_path()}}/storage/avatars/reps/{{basename($user['user']->reps->first()->avatar)}}" alt="Avatar" style="max-width: 150px;max-height: 150px;"/>

							</div>
						</div>
						<div class="col-xs-3" >
							<div class="card-avatar rounded mx-auto d-block" style="padding-top: 50px">   
								<h6>Representative 2</h6>                                                 
								<img class="img" src="{{public_path() }}/storage/avatars/reps/{{basename($user['user']->reps->get(1)->avatar)}}" alt="Avatar" style="max-width: 150px;max-height: 150px;"/>

							</div>
						</div>
					</div> 
                         <hr style="padding-bottom: 0px; padding-top: -10px">                      

					<div class="row" style="padding-bottom:-5px">
						<h5><strong>INFORMATION ON THE ORGANIZATION</strong></h5>
						<div class="col-xs-12" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-user" aria-hidden="true" style="padding-right:10px"></i><strong>ORGANIZATION NAME:</strong> {{ucfirst($user['user']->organization_name)}}</h5>

							</div>

						</div>
					</div>
					<div class="row" style="padding-bottom:-5px">
						
						<div class="col-xs-12" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i><strong>TYPE OF ORGANIZATION:</strong> {{$user['user']->organization_type? $user['user']->organization_type : 'N/A'}}</h5>

							</div>

						</div>
					</div>
					<!-- vat num and reg num -->
					<div class="row" style="padding-bottom:-5px">
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i><strong>REGISTRATION NO.:</strong> {{$user['user']->registration_num? $user['user']->registration_num : 'N/A'}}</h5>

							</div>

						</div>
						
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i><strong>VAT REGISTRATION NO.:</strong> {{$user['user']->vat_reg_num? $user['user']->vat_reg_num : 'N/A'}}</h5>

							</div>

						</div>
						
					</div>
					<!-- email telephone -->
					<div class="row" style="padding-bottom:-5px">
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-envelope" aria-hidden="true" style="padding-right:10px"></i><strong>EMAIL:</strong> {{$user['user']->email? $user['user']->email : 'N/A'}}</h5>

							</div>

						</div>
						
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-fa-phone" aria-hidden="true" style="padding-right:10px"></i><strong>TELEPHONE:</strong> {{$user['user']->contact->contact? $user['user']->contact->contact : 'N/A'}}</h5>

							</div>

						</div>
						
					</div>
					<!-- rep 1 surname firstname -->
					<div class="row" >
						<h5><strong>INFORMATION ON REPRESENTATIVES</strong></h5>
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-user" aria-hidden="true" style="padding-right:10px"></i><strong>REP 1 SURNAME NAME:</strong> {{ucfirst($user['user']->reps->first()->l_name)}}</h5>

							</div>

						</div>
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-user " aria-hidden="true" style="padding-right:10px"></i><strong>FIRST NAME:</strong> {{ucfirst($user['user']->reps->first()->f_name)}}</h5>

							</div>

						</div>


					</div>
					<!-- rep1 id type and contact -->
					<div class="row" >
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i><strong>ID TYPE AND NUMBER:</strong> {{ucfirst($user['user']->reps->first()->identification)}}</h5>

							</div>

						</div>
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-phone" aria-hidden="true" style="padding-right:10px"></i><strong>TELEPHONE NUMBER:</strong> {{ucfirst($user['user']->reps->first()->contact)}}</h5>

							</div>

						</div>


					</div>
					<!-- rep 2 surname firstname -->
					<div class="row" >
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-user" aria-hidden="true" style="padding-right:10px"></i><strong>REP 2 SURNAME NAME:</strong> {{ucfirst($user['user']->reps->get(1)->l_name)}}</h5>

							</div>

						</div>
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-user " aria-hidden="true" style="padding-right:10px"></i><strong>FIRST NAME:</strong> {{ucfirst($user['user']->reps->get(1)->f_name)}}</h5>

							</div>

						</div>


					</div>
					
					<div class="row" >
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i><strong>ID TYPE AND NUMBER:</strong> {{ucfirst($user['user']->reps->get(1)->identification)}}</h5>

							</div>

						</div>
						<div class="col-xs-6" >
							
							<div class="text-left text-black">
								<h5 class="description" style="color: #000000; font-size: 15px;"><i class="fa fa-fw fa-phone" aria-hidden="true" style="padding-right:10px"></i><strong>TELEPHONE NUMBER:</strong> {{ucfirst($user['user']->reps->get(1)->contact)}}</h5>

							</div>

						</div>


					</div>
				
				
				</div>
				<hr>
				<div class="card-content text-left">

					
					<div class="row" style="outline: 1px solid gray;">
						
						<div class="col-md-6" style="padding-bottom:-25px">
							<h5 class="description text-black" style="color: #000000; font-size: 15px;">
								<i class="fa fa-fw fa-building" aria-hidden="true" style="padding-right:10px"></i> <strong>BUSINESS ADDRESS</strong>
								<br>
								<h5 class="description text-black" style="color: #000000; font-size: 15px;">{{ucwords($user['home_address'])}}</h5>
							</h5>
						</div>
						
					</div>
					<div class="clearfix visible-xs"></div>
					

					
						<div class="row table-bordered table-condensed" style="outline: 1px solid gray;">
							<table class="table">
								<thead>
									<tr class="">
										<th>Enterprise</th>
										<th>Type</th>
									</tr>
								</thead>
								<tbody>
									@foreach($user['data']->enterprises() as $ent)
									<tr>
										<td>{{$ent->enterprise}}</td>
										<td>{{ucwords($ent->type)}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					
				</div>
				<!-- @if($user['data']->enterprises()->count() >=9)
				<div class="page-break"></div>
				@endif -->
				
				
				<!--  -->
				<!-- @if($user['data']->enterprises()->count() + $user['data']->parcels()->count() >= 13 || $user['data']->enterprises()->count() + $user['data']->producecount() >= 19 )
					<div class="page-break"></div>
					@endif -->
					<div class="page-break"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="card card-profile">
								<div class="card-content">
									<h4 class="category text-left" style="padding-bottom: 20px">PARCELS FOR APPLICATION NUMBER {{$user['data']->id}}</h4>
									<div class="">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Address</th>
													<th>Area</th>
													<th>Tenure</th>
													<th>Specific Crop/Animal</th>
													<th>Amount</th>
												</tr>
											</thead>
											
											<tbody>
												@foreach($user['data']->parcels() as $n => $parcel)
												@foreach($parcel->produce() as $i => $produce)
												<tr class="{{$n % 2 == 0? 'active' : ''}}" >
													@if($i == 0)
													<td rowspan="{{$parcel->produce_count}}">{{$parcel->land->address->address}}</td>
													<td rowspan="{{$parcel->produce_count}}">{{$parcel->area}}

													</td>
													<td rowspan="{{$parcel->produce_count}}">{{$parcel->tenure->tenure}}</td>
													@endif
													<td>{{ucwords($produce->specific_parcel)}}</td>
													<td>{{number_format($produce->amt)}} {{$produce->type->unit->parcel_unit}}</td> 
												</tr>
												@endforeach
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix visible-xs visible-sm visible-md visible-lg"></div>
					</div>
				<div class="row " style="outline: 1px solid gray;">
					<table class="table table-bordered">
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
								<td rowspan="{{count($parcel->proofs)}}" class="text-center">{{$n+1}}</td>
								@endif
								<td>{{$proof->proof_code->proof}}</td>
								<td>-</td>
							
							</tr>
							@endforeach

							@endforeach

						</tbody>
					</table>
				</div>
				<hr>
				<div class="row" style="outline: 1px solid gray;">
					<div class="col-xs-6 text-left">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;">
							<i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i>SIGNATURE OF REPRESENTATIVE 1

						</h5>
						<br>
						<h5 class="description text-black" style="color: #000000; font-size: 15px;">_______________________________________________________</h5>
					</div>
					<div class="col-xs-4">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;">DATE 	{{Carbon\Carbon::parse($user['data']->created_at)->format('d-m-Y')}}</h5>
					</div>
				</div>
				<div class="row" style="outline: 1px solid gray;">
					<div class="col-xs-6 text-left">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;">
							<i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i>SIGNATURE OF REPRESENTATIVE 2
							
						</h5>
						<br>
						<h5 class="description text-black" style="color: #000000; font-size: 15px;">_______________________________________________________</h5>
					</div>
					<div class="col-xs-4">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;">DATE 	{{Carbon\Carbon::parse($user['data']->created_at)->format('d-m-Y')}}</h5>
					</div>
				</div>
				<div class="row" style="outline: 1px solid gray;">
					<div class="col-xs-6">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;">
							<i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i>SIGNATURE OF FARMER REGISTRATION CLERK

						</h5>
						<br>
						<h5 class="description text-black" style="color: #000000; font-size: 15px;">_______________________________________________________</h5>
					</div>
					<div class="col-xs-4">
						<h5 class="description text-black" style="color: #000000; font-size: 15px;">DATE 	{{Carbon\Carbon::parse($user['data']->created_at)->format('d-m-Y')}}</h5>
					</div>
				</div>
					
					
					<div class="page-break"></div>
					<div class="row">
						<div class="text-left" style="background: grey;">
							<h6 class="category" >FOR OFFICIAL USE ONLY (APPLICATION NUMBER: {{$user['data']->id}})</h6>
						</div>
						<h6 class="category text-left" >VERIFICATION OF PARCEL USE FOR: {{$user['user']->name}}@if($user['user']->alias) <i>({{$user['user']->alias}})</i>@endif</h6>

						<table class="table table-bordered">
							<tr>
								<th rowspan="2" style="width:15px">Item No</th>
								<th class="text-center" colspan="3">Location of Parcels</th>

								<th rowspan="2" style="width:20px">Verified Tenure</th>
								<th class="text-center" colspan="3" rowspan="2" style="width:350px">Documents Supplied</th>
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
									<td class="text-center" rowspan="3">{{$parcel->land->address->district->district}}</td>
									<td class="text-center" rowspan="3">{{$parcel->land->address->district->ward->ward}}</td>
									<td class="text-center" rowspan="3">{{$parcel->tenure->id}} {{$parcel->tenure->tenure}}</td>
									<td class="text-center" colspan="3" rowspan="3" style=";padding-bottom: -5px">
										@foreach($parcel->proofs as $i => $proof)

										<ul class="list-inline" style="display:block;">
											<li class="list-inline-item"><input type="checkbox">{{$proof->proof_code->proof}}</li>
											
										</ul>

										@endforeach
									</td>

								</tr>
								<tr></tr>
								<tr></tr>
								@endif
								@endforeach
								@endforeach

							</tbody>
						</table>
					</div>
					<div class="row">
						<table class="table table-bordered" style="border: 1px solid black;">
							<thead style="border: 1px solid black;">
										<tr  style="border: 1px solid black;">

											<th height="200" colspan="2" style="vertical-align:top;border: 1px solid black;">DFO Remarks:</th>
											<th colspan="2" style="vertical-align:top;border: 1px solid black;">AAIII Remarks:</th>
											<th colspan="2" style="vertical-align:top;border: 1px solid black;">AOI Remarks:</th>
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
											<td width="40" style="border: 1px solid black;"><h6 ><small>NAME OF OFFICER BLOCK LETTERS</small></h6></td>					
											<td width="40" style="border: 1px solid black;"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;"><h6 ><small>AAIII NAME BLOCK LETTERS</small></h6></td>												
											<td width="40" style="border: 1px solid black;"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;"><h6 ><small>AOI NAME BLOCK LETTERS</small></h6></td>												
											<td width="40" style="border: 1px solid black;"><input type="text" size="12"></td>
										</tr>
										<tr style="border: 1px solid black;">
											
											<td style="border: 1px solid black;"><h6 ><small>SIGNATURE OF OFFICER</small></h6></td>
												
											<td width="40" style="border: 1px solid black;"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;"><h6 ><small>SIGNATURE</small></h6></td>												
											<td width="40" style="border: 1px solid black;"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;"><h6 ><small>SIGNATURE</small></h6></td>												
											<td width="40" style="border: 1px solid black;"><input type="text" size="12"></td>
										</tr>
										<tr style="border: 1px solid black;">
											<td style="border: 1px solid black;"><h6 ><small>DATE</small></h6></td>
												
											<td width="40" style="border: 1px solid black;"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;"><h6 ><small>DATE</small></h6></td>												
											<td width="40" style="border: 1px solid black;"><input type="text" size="12"></td>
											<td width="40" style="border: 1px solid black;"><h6 ><small>DATE</small></h6></td>												
											<td width="40" style="border: 1px solid black;"><input type="text" size="12"></td>
										</tr>
									</tbody>
						</table>
					</div>

				<!-- 	<div class="page-break"></div>
					<div class="row">
						
						<div class="col-xs-3 text-left" style="border: 1px solid; padding-bottom:50px; width: 200px">Remarks1:</div>
						<div class="col-xs-1" style="padding-bottom:50px; width: 2px"></div>
						<div class="col-xs-3 text-left" style="border: 1px solid; padding-bottom:50px; width: 200px">Remarks2:</div>
						<div class="col-xs-1" style="bpadding-bottom:50px; width: 2px"></div>
						<div class="col-xs-3 text-left" style="border: 1px solid; padding-bottom:50px; width: 200px">Remarks3:</div>	
					</div>
					<div class="row">
						<div class="col-xs-1">
								<label class="control-label">NAME OF OFFICER BLOCK LETTERS</label>	
						</div>
						<div class="col-xs-2" style="border: 1px solid; padding-bottom:50px">
							<h6 ><small style="color: white">sign here</small></h6>
						</div>
						<div class="col-xs-1">
								<label class="control-label">NAME OF OFFICER BLOCK LETTERS</label>	
						</div>
						<div class="col-xs-2" style="border: 1px solid; padding-bottom:50px">
							<h6 ><small style="color: white">sign here</small></h6>
						</div>
						<div class="col-xs-1">
								<label class="control-label">NAME OF OFFICER BLOCK LETTERS</label>	
						</div>
						<div class="col-xs-2" style="border: 1px solid; padding-bottom:50px">
							<h6 ><small style="color: white">sign here</small></h6>
						</div>
					</div> -->
				
				
				
			</div>
		</div>
	</div> 


</body>          
</html>