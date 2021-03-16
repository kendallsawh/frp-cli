
<div class="modal fade" id="uprnsModal" tabindex="-1" role="dialog" aria-labelledby="uprnModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="uprnModalLabel">Add UPRN/S data as {{Auth::user()->role_name}}</h4>
				<h5 class="description" id="uprnModalLabel">You are about to add Stateland information for Application: {{$data->id}}.</h5>

			</div>
			<div class="modal-body">


				<form method="POST" action="{{route('addUPRNS')}}" id="uprns_form"  enctype="multipart/form-data">
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
								<h5 class="description"><span rel="tooltip" title="Farmer Badge ID">Badge No: {{$data->applicant()->farmer()? ($data->applicant()->farmer()->badge()? $data->applicant()->farmer()->badge()->farmer_badge : 'Not Assigned'):'Not Assigned'}} </span></h5>
							</div>
						</div>
						@if($data->applicant()->nationalid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<div class="text-left">
								<h5 class="description"><span rel="tooltip" title="National ID"> <i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->nationalid}}</span></h5>
							</div>
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
						<div class="col-sm-4  col-sm-4 col-xs-4">
							<h5 class="description"><span rel="tooltip" title="Passport"> <i class="fa fa-fw fa-address-book" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->passportid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif
						</div>
						<div class="row">
							<div class="col-sm-8">
								<div id="grp-uprns_number" class="form-group{{ $errors->has('uprns_number') ? ' has-error' : '' }} label-floating">
									<label class="control-label">UPRN/S Number </label>
									<input id="uprns_number" name="uprns_number" type="text" class="form-control" value="{{old('uprns_number')}}" style="text-transform:uppercase">

									<span class="help-block">
										<strong id="err-uprns_number">{{ $errors->first('uprns_number') }}</strong>
									</span>
								</div>
							</div>
							 
						</div>
						<div class="row" id="checklist">
							
						</div>
							
             
					
				</form>
			</div>
			<div class="modal-footer">

				<button type="submit" class="btn btn-fill btn-success" form="uprns_form">Confirm</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>