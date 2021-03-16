
<!DOCTYPE html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8; IE=edge"/>
	
	
	
	
	
	<!-- Styles -->
	<!-- Bootstrap core CSS     -->
	<!-- <link href="css/dash_css/bootstrap.min.css " rel="stylesheet" />


	<link href="css/dash_css/material-dashboard.css " rel="stylesheet" /> -->
	
<!-- <link href="css/pdf-custom.css " rel="stylesheet" /> -->
	

	<!--     Fonts and icons     -->
	
	
	


<style type="text/css">
	.page-break {
		page-break-after: always;
	}



	.col-wrap{
		overflow: hidden; 
	}

	.less-padding{
		padding-bottom:-20px;
		padding-top:-15px
	}

	#tb-parcel td {
		padding:0; margin:0;
	}

	#tb-parcel,#tb-parcel-doc,#tb-parcel-info,#tb-enterpise td {
		padding:0; margin:0;
	}


	table.full {
		margin-left:auto; 
		margin-right:auto;
		table-layout: fixed;
		width: 100%;  
	}
	.tg  {border-collapse:collapse;border-spacing:0;}
	.tg td{border-color:gray;border-style:solid;border-width:1px;font-size:12px;
		overflow:hidden;padding:5px 5px;word-break:normal;}
	.tg th{border-color:gray;border-style:solid;border-width:1px;font-size:12px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
	.tg .tg-1wig{font-weight:bold;text-align:left;vertical-align:top}
	.tg .tg-baqh{text-align:center;vertical-align:top}
	.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
	.tg .tg-0lax{text-align:left;vertical-align:top}
	.tg .border-none{border: none;}
	.tg .tg-bleft{border-left: none;}
	.tg .tg-bright{border-right: : none;}
	.tg .tg-top{border-top:none;}
	.tg .tg-bot{border-bottom:none;}
	.tg .tg-topbot{border-top:none;border-bottom:none;}
	.tg .tg-bleftright{border-left: none;border-right:none;}
	.tg .tg-kftd{background-color:#f5f5f5;text-align:left;vertical-align:top}
	.text-left{text-align:left;}
	.text-right{text-align:right;}
	.text-center{text-align:center;}
	.text-bold{font-weight:bold;}
	.notice-category {color: #1e1e1e;font-size: 14px;text-decoration: underline;}
	.notice-category-small {color: #1e1e1e;font-size: 12px;}
	.td-none{display: none;}

	.table>tbody>tr.active>td,.table>tbody>tr.active>th,.table>tbody>tr>td.active,.table>tbody>tr>th.active,.table>tfoot>tr.active>td,.table>tfoot>tr.active>th,.table>tfoot>tr>td.active,.table>tfoot>tr>th.active,.table>thead>tr.active>td,.table>thead>tr.active>th,.table>thead>tr>td.active,.table>thead>tr>th.active {
		background-color: #f5f5f5
	}
	.table>tbody>tr.td-slim>td,.table>tbody>tr.td-slim>th,.table>tbody>tr>td.td-slim,.table>tbody>tr>th.td-slim,.table>tfoot>tr.td-slim>td,.table>tfoot>tr.td-slim>th,.table>tfoot>tr>td.td-slim,.table>tfoot>tr>th.td-slim,.table>thead>tr.td-slim>td,.table>thead>tr.td-slim>th,.table>thead>tr>td.td-slim,.table>thead>tr>th.td-slim{padding:0; margin:0;}
</style>

</head>

<body style="background-color: #FFF;">
	<!-- header and bio data-->
	<div>

		<table class="tg full">
			<tr>
				<th class="tg-baqh tg-bot" colspan="12"><img src="{{public_path()}}/img/{{basename('coat_of_arms.png')}}" alt="Coat of Arms" width="70" height="70"></th>
			</tr>
			<tr>
				<td class="tg-baqh tg-topbot" colspan="12">MINISTRY OF AGRICULTURE, LAND AND FISHERIES</td>
			</tr>
			<tr>
				<td class="tg-baqh tg-top" colspan="12">APPLICATION FORM FOR FARMERS REGISTRATION</td>
			</tr>
			<tr>
				<td class="tg-0lax tg-bright" colspan="5">
					SECTION A<br>
					APPLICATION NUMBER: {{$user['data']->id}}<br>
					APPLICATION DATE: {{$user['data']->created_on_numeric}}<br>
				</td>
				<!-- <td class="tg-0lax tg-header-hide"></td> -->
				<td class="tg-0lax border-none"></td>
				<td class="tg-0lax border-none"></td>
				<td class="tg-0lax border-none"></td>
				<td class="tg-0lax tg-bleft" colspan="4"><img src="{{public_path() }}/storage/avatars/{{basename($user['user']->avatar)}}" alt="Farmer Photo" width="150" height="160"></td>
			</tr>
			<tr>
				<td class="tg-0lax tg-bleftright" colspan="12"></td>
			</tr>
			<tr>
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">SURNAME:</span> {{ucfirst($user['user']->l_name)}}</td>
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">FARMER ID:</span>{{$user['user']->farmer()? $user['user']->farmer()->farmer_badge : 'N/A'}}</td>
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">PREVIOUS ID:</span> {{$user['user']->farmer()? ($user['user']->farmer()->badge()? $user['user']->farmer()->badge()->old_badge_id : '') : ''}}</td>
			</tr>
			<tr>
				<td class="tg-0lax tg-bright" colspan="4"><span style="font-weight:bold">FIRSTNAME:</span> {{ucfirst($user['user']->f_name)}}@if($user['user']->alias) <i>({{$user['user']->alias}})</i>@endif</td>
				<td class="tg-0lax tg-bleftright" colspan="4"></td>
				<td class="tg-0lax tg-bleft" colspan="4"></td>
			</tr>
			<tr>
				<td class="tg-0lax tg-bright" colspan="4"><span style="font-weight:bold">MIDDLENAME:</span> {{ucfirst($user['user']->m_name)}}</td>
				<td class="tg-0lax tg-bleftright" colspan="4"></td>
				<td class="tg-0lax tg-bleft" colspan="4"></td>
			</tr>
			<tr>
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">SEX:</span> {{$user['user']->gender->gender}}</td>
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">D.O.B:</span> {{$user['user']->dob}} ({{$user['user']->age}} years)</td>
				@if($user['user']->nationalid)
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">NATIONAL ID:</span> {{$user['user']->nationalid}}</td>
				@else
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">NATIONAL ID:</span></td>
				@endif
			</tr>
			<tr>
				@if($user['user']->homecontact)
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">HOME:</span> {{$user['user']->homecontact}}</td>
				@else
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">HOME:</span></td>
				@endif
				@if($user['user']->mobilecontact)
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">MOBILE:</span> {{$user['user']->mobilecontact}}</td>
				@else
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">MOBILE:</span></td>
				@endif
				@if($user['user']->passportid)
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">PASSPORT:</span> {{$user['user']->passportid}}</td>
				@else
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">PASSPORT:</span></td>
				@endif
			</tr>
			<tr>
				@if($user['user']->email)
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">EMAIL:</span> {{$user['user']->email}}</td>
				@else
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">EMAIL:</span></td>
				@endif
				@if($user['user']->emergencycontact)
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">EMERGENCY:</span>  {{$user['user']->emergencycontact}}</td>
				@else
				<td class="tg-0lax" colspan="4"><span style="font-weight:bold">EMERGENCY:</span></td>
				@endif
				<td class="tg-0lax" colspan="4"></td>
			</tr>
			<tr>
				<td class="tg-baqh" colspan="12"><span style="font-weight:bold">ADDRESS</span></td>
			</tr>
			<tr>
				<td class="tg-0lax" colspan="2"><span style="font-weight:bold">HOME</span></td>
				<td class="tg-0lax" colspan="10">{{ucwords($user['home_address'])}}</td>
			</tr>
			@if($user['applicant_type'] === 'Individual')
				@if($user['user']->postal())
					<tr>
						<td class="tg-0lax" colspan="2"><span style="font-weight:bold">POSTAL</span></td>
						<td class="tg-0lax" colspan="10">{{ucfirst($user['user']->postal()->address)}}</td>
					</tr>
				@else
					<tr>
						<td class="tg-0lax" colspan="2"><span style="font-weight:bold">POSTAL</span></td>
						<td class="tg-0lax" colspan="10">SAME AS ABOVE</td>
					</tr>
				@endif
			@endif
		</table>
	</div>
	<!-- Enterprise --> 
	
	<div>
		@if($user['data']->enterprises()->count() >=4)
			<h5 class="notice-category-small text-left less-padding" >ENTERPRISE INFORMATION FOR APPLICATION NUMBER {{$user['data']->id}}</h5>
		@else
		<h5 class="notice-category-small text-left less-padding" >ENTERPRISE INFORMATION</h5>
		@endif				
		<table class="tg full">
			<thead >
				<tr class="td-slim">
					<th class="tg-1wig">Enterprise</th>
					<th class="tg-1wig">Type</th>
				</tr>
			</thead>
			<tbody>
				@foreach($user['data']->enterprises() as $ent)
				<tr class="td-slim">
					<td class="tg-kftd">{{$ent->enterprise}}</td>
					<td class="tg-kftd">{{ucfirst($ent->type)}}</td>
				</tr>
				@endforeach
			</tbody>
			
		</table>
	</div> 
	<!--  -->
	 @if($user['data']->enterprises()->count() + $user['data']->parcels()->count() >= 7 || $user['data']->enterprises()->count() + $user['data']->producecount() >= 15 ) 
	<div class="page-break"></div>
	@endif
	<div style=" overflow-x: visible">
		<h5 class="notice-category-small text-left less-padding">INFORMATION ON THE PARCELS FARMED/UTILIZED FOR APPLICATION NUMBER {{$user['data']->id}}</h5>
		<table class="tg full table">
			<thead>
				<!-- <tr>
					<th colspan="5">
						INFORMATION ON THE PARCELS FARMED/UTILIZED FOR APPLICATION NUMBER {{$user['data']->id}}
					</th>
				</tr> -->
				<tr class="td-slim">
					<th class="tg-1wig">Address</th>
					<th class="tg-1wig">Area(Size)</th>
					<th class="tg-1wig">Tenure</th>
					<th class="tg-1wig">Specific Crop/Animal</th>
					<th class="tg-1wig">Amount</th>
				</tr>
			</thead>
			<tbody>
				@foreach($user['data']->parcels() as $n => $parcel)
					@if(!$parcel->produce()->isEmpty())
						@foreach($parcel->produce() as $i => $produce)
						<tr class="{{$n % 2 == 0? 'active' : ''}} td-slim">
							@if($i == 0)
							<td rowspan="{{$parcel->produce_count}}">{{$parcel->land->address->address}} {{$i}}
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
	</div> 
	<!--  -->
	@if($user['data']->enterprises()->count() + $user['data']->parcels()->count() <= 6 || $user['data']->enterprises()->count() + $user['data']->producecount()  <= 8 )
	
	<div class="page-break"></div>
	@endif	
	<div>
		<h6 class="notice-category-small text-left text-bold less-padding" >SUBMITTED DOCUMENTS FOR APPLICATION NUMBER {{$user['data']->id}} </h6>
		<table class="tg full table">
			<thead >
				<tr >
					<th  class="text-center">Parcel Number</th>
					<th>Submitted Documents</th>
					<th>Brief Description</th>
				</tr>
			</thead>
			<tbody>

				@foreach($user['data']->parcels() as $n => $parcel)


				@foreach($parcel->proofs as $i => $proof)
				<tr class="td-slim">
					@if($i == 0)
					<td rowspan="{{count($parcel->proofs)}}" class="text-center" >{{$n+1}}</td>
					@endif
					<td>{{$proof->proof_code->proof}}</td>
					<td>-</td>

				</tr>
				@endforeach

				@endforeach

			</tbody>
		</table>
	</div>
	<!--  @if($user['data']->enterprises()->count() + $user['data']->parcels()->count() <= 6 || $user['data']->enterprises()->count() + $user['data']->producecount()  <= 6 )
	<div class="page-break"></div>
	@endif -->
	<div>
		<h6 class="notice-category-small text-left text-bold less-padding" >SIGNATURES FOR APPLICATION NUMBER {{$user['data']->id}} </h6>
		
		<table class="tg full" style="padding-bottom:5px">
			<tr class="tg-bot">
				<td class="tg-bright tg-bot">SIGNATURE OF {{strtoupper($user['user']->name)}}@if($user['user']->alias) <i>({{strtoupper($user['user']->alias)}})</i>@endif</td>
				<td class="tg-bleft tg-bot">DATE: 	{{Carbon\Carbon::now()->format('d-m-Y')}}</td>
			</tr>
			<tr class="">
				<td class="tg-bright tg-top">_______________________________________________________</td>
				<td class="tg-bleft tg-top"></td>
			</tr>
			<tr class="tg-bot">
				<td class="tg-bright tg-bot">SIGNATURE OF FARMER REGISTRATION CLERK</td>
				<td class="tg-bleft tg-bot">DATE: 	{{Carbon\Carbon::now()->format('d-m-Y')}}</td>
			</tr>
			<tr class="">
				<td class="tg-bright tg-top">_______________________________________________________</td>
				<td class="tg-bleft tg-top"></td>
			</tr>
		</table>
		
		

		
	</div>
	<div>
		<div class="notice-category-small text-left" style="background: grey;padding-top:-5px;padding-bottom:-5px">
			<h5 >FOR OFFICIAL USE ONLY (APPLICATION NUMBER: {{$user['data']->id}})</h5>
		</div>
		<h6 class="notice-category-small text-left less-padding" >VERIFICATION OF PARCEL USE FOR: {{$user['user']->name}}@if($user['user']->alias) <i>({{$user['user']->alias}})</i>@endif</h6>
		<table  class=" tg full table" >
			<tr class="td-slim">
				<th rowspan="2" style="width:15px">Item No</th>
				<th class="text-center" colspan="3">Location of Parcels</th>

				<th rowspan="2" style="width:20px">Verified Tenure</th>
				<th class="text-center" colspan="3" rowspan="2" style="width:250px">Documents Supplied</th>
			</tr>
			<tr class="td-slim">

				<th >County</th>
				<th >District</th>
				<th>Locality</th>

			</tr>
			<tbody>
				@foreach($user['data']->parcels() as $n => $parcel)
				@foreach($parcel->produce() as $i => $produce)
				@if($i == 0)
				<tr class="td-slim">

					<td class="text-center" rowspan="3">{{$n+1}}</td>
					<td class="text-center" rowspan="3">{{$parcel->land->address->district->ward->county->county}}</td>
					<td class="text-center" rowspan="3">{{$parcel->land->address->district->farmer_district_id !=0? $parcel->land->address->district->farmdistrict()->first()->district_name : $parcel->land->address->district->district}}</td>
					<td class="text-center" rowspan="3">{{$parcel->land->address->locality}}</td>
					<td class="text-center" rowspan="3">{{$parcel->tenure->id}} {{$parcel->tenure->tenure}}</td>
					<td class="text-left" colspan="3" rowspan="3" style="padding-bottom: -5px">
						@foreach($parcel->proofs as $i => $proof)

						<ul class="" style="list-style-type:none;padding:0px;">
							<li class=""><input type="checkbox" style="text-align:left;vertical-align:bottom;padding-top:-7px;">{{$proof->proof_code->proof}}</li>

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
	<div>
		@if($user['data']->parceldocumentcount() >= 4)
			<div class="notice-category-small text-left" style="background: grey;padding-top:-5px;padding-bottom:-5px">
			<h5 class="category" >FOR OFFICIAL USE ONLY (APPLICATION NUMBER: {{$user['data']->id}})</h5>
			</div>

			<h6 class="notice-category-small text-left less-padding" >VERIFICATION OF PARCEL USE FOR: {{$user['user']->name}}@if($user['user']->alias) <i>({{$user['user']->alias}})</i>@endif</h6>
		@endif

		<table class="tg full table" style="padding-top: 10px">
			<thead >
				<tr  >

					<th height="180" colspan="2" style="vertical-align:top;">Remarks:</th>
					<th colspan="2" style="vertical-align:top;">Remarks:</th>
					<th colspan="2" style="vertical-align:top;">Remarks:</th>
				</tr>	
			</thead>								
			<tbody >
				@if($user['data']->parcelcomments()||$user['data']->parcelaa3comments()||$user['data']->parcelao1comments())

				<tr  class="tg-kftd td-slim">
					<td colspan="2" >
						<h6><small>
							@foreach($user['parcelcomments'] as $parcelcomment)
							{{$parcelcomment->comments}}<br>
						@endforeach</small></h6>
					</td>
					<td colspan="2" >
						<h6><small>
							@foreach($user['data']->parcelaa3comments() as $parcelaa3comment)
							{{$parcelaa3comment->comments}}<br>
						@endforeach</small></h6>
					</td>

					<td colspan="2" >
						<h6><small>
							@foreach($user['data']->parcelao1comments() as $parcelao1comment)
							{{$parcelao1comment->comments}}<br>
						@endforeach</small></h6>
					</td>

				</tr>

				@endif

				<tr class="td-slim">											
					<td width="20"><h6 style="color: #000000; font-size: 10px;">OFFICER NAME</h6></td>					
					<td width="60" ></td>
					<td width="20" ><h6 style="color: #000000; font-size: 10px;">AAIII NAME</h6></td>												
					<td width="60" ></td>
					<td width="20" ><h6 style="color: #000000; font-size: 10px;">AOI NAME</h6></td>												
					<td width="60" ></td>
				</tr>
				<tr class="td-slim">

					<td width="20" ><h6 style="color: #000000; font-size: 10px;">SIGNATURE</h6></td>

					<td width="60" ></td>
					<td width="20" ><h6 style="color: #000000; font-size: 10px;">SIGNATURE</h6></td>												
					<td width="60" ></td>
					<td width="20" ><h6 style="color: #000000; font-size: 10px;">SIGNATURE</h6></td>												
					<td width="60" ></td>
				</tr>
				<tr class="td-slim">
					<td width="20" ><h6 style="color: #000000; font-size: 10px;">DATE</h6></td>

					<td width="60" ></td>
					<td width="20" ><h6 style="color: #000000; font-size: 10px;">DATE</h6></td>												
					<td width="60" ></td>
					<td width="20" ><h6 style="color: #000000; font-size: 10px;">DATE</h6></td>												
					<td width="60" ></td>
				</tr>
			</tbody>
		</table>
	</div>

</body>          
</html>