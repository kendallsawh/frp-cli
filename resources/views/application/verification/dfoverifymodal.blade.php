
<div class="modal fade" id="dfoVerifyModal" tabindex="-1" role="dialog" aria-labelledby="dfoVerifyModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="dfoVerifyModalLabel">Verify that the Application be recommended to move forward based on Field Investigation under the capacity of {{Auth::user()->RoleName}}</h4>
				<h5 class="description" id="dfoVerifyModalLabel">You are about to add dfo data for application: {{$data->id}}.</h5>
				@if($dfo_assigned !== '')
                                    <h5> <p class="text-danger  text-left">{{$dfo_assigned}}</p></h5>
                                    @endif
			</div>
			<div class="modal-body">


				<form method="POST" action="{{route('addDFOVerify')}}" id="dfoVerify_form"  enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="view_id" value="{{$data->id}}">
					
					
					<div class="row">
						<div class="col-md-4">
							<div class="card-title text-left">

								<h5 class="description"><span rel="tooltip" title="Name"><i class="fa fa-fw fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->name}}@if($data->applicant()->alias) <i>({{$data->applicant()->alias}})</i>@endif </span></h5>

							</div>

						</div>
						<div class="col-md-4">

							<div class="card-title text-left">
								<h5 class="description"><span rel="tooltip" title="Farmer Badge ID">Badge No: {{$data->applicant()->farmer()?$data->applicant()->farmer()->badge()->farmer_badge : ''}} </span></h5>
							</div>
						</div>
						@if($data->applicant()->nationalid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description"><span rel="tooltip" title="National ID"> <i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->nationalid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif

						@if($data->applicant()->driverid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description"><span rel="tooltip" title="Driver&#39;s Permit"> <i class="fa fa-fw fa-drivers-license-o" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->driverid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif

						@if($data->applicant()->passportid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description"><span rel="tooltip" title="Passport"> <i class="fa fa-fw fa-address-book" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->passportid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif
						</div>
						<div class="row">
							<div class="col-md-6 ">
								<div class="input-group">
									<span class="input-group-addon" >
										<i class="material-icons">perm_identity</i>
									</span>
									<div id="grp-parcel" class="form-group{{ $errors->has('parcel') ? ' has-error' : '' }} label-floating">
										<label class="control-label">Select Parcel Address<span class="red">*</span></label>
										<select id="dfo_parcel_verify" name="dfo_parcel_verify" class="form-control dropdown" >
											<option disabled="" selected=""></option>
											@foreach($data->parcels() as $parcel)

											@if($parcel->county == \Auth::user()->county)
											<option value="{{$parcel->id}}" {{old('parcel')==$parcel->id ? 'selected' : '' }}>{{$parcel->land->address->address}}</option>
											@endif
											@endforeach
										</select>

										<span class="help-block">
											<strong id="err-parcel">{{ $errors->first('parcel') }}</strong>
										</span>
									</div>
								</div>
							</div>
							 
						</div>
						<div class="row" id="checklist">
							
						</div>
							
             
					
				</form>
			</div>
			<div class="modal-footer">

				<button type="submit" class="btn btn-fill btn-success" form="dfoVerify_form">Confirm</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>