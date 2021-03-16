
<div class="modal fade" id="dfoModal" tabindex="-1" role="dialog" aria-labelledby="dfoModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="dfoModalLabel">Add DFO data as {{Auth::user()->role_name}}</h4>
				<h5 class="description" id="dfoModalLabel">You are about to add dfo data for application: {{$data->id}}.</h5>

			</div>
			<div class="modal-body">


				<form method="POST" action="{{route('addServiceProviderComment')}}" id="addDFOComment_form"  enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="view_id" value="{{$data->id}}">
					<input type="hidden" name="badge_id" value="{{$data->provider->farmer()? $data->provider->farmer()->badge()->farmer_badge : ''}}">
					
					<div class="row">
						<div class="col-md-4">
							<div class="card-title text-left">

								<h5 class="description"><span rel="tooltip" title="Name"><i class="fa fa-fw fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->provider->name}}@if($data->provider->alias) <i>({{$data->provider->alias}})</i>@endif </span></h5>

							</div>

						</div>
						<div class="col-md-4">

							<div class="card-title text-left">
								<h5 class="description"><span rel="tooltip" title="Farmer Badge ID">Badge No: {{$data->provider->farmer()?$data->provider->farmer()->badge()->farmer_badge : ''}} </span></h5>
							</div>
						</div>
						@if($data->provider->nationalid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description"><span rel="tooltip" title="National ID"> <i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i> {{$data->provider->nationalid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif

						@if($data->provider->driverid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description"><span rel="tooltip" title="Driver&#39;s Permit"> <i class="fa fa-fw fa-drivers-license-o" aria-hidden="true" style="padding-right:10px"></i> {{$data->provider->driverid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif

						@if($data->provider->passportid)
						<div class="col-md-4  col-sm-4 col-xs-4">
							<h5 class="description"><span rel="tooltip" title="Passport"> <i class="fa fa-fw fa-address-book" aria-hidden="true" style="padding-right:10px"></i> {{$data->provider->passportid}}</span></h5>
						</div>
						<div class="clearfix visible-xs"></div>
						@endif
						</div>
						
							
						
						<div class="row">
							<div class="col-md-10 col-lg-10 col-sm-10 col-xs-10">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">speaker_notes</i>
									</span>
									<div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
										<label class="control-label">Comments/Recommendation<span class="red">*</span></label>
										<textarea class="form-control" name="comments" id="comments" rows="2">{{old('comments')}}</textarea>


										<span class="help-block">
											<strong id="">Tip: Press Enter to go to a new line</strong><br>
										</span>
										<span class="help-block text-danger">
											<strong id="err-comments">{{ $errors->first('comments') }}</strong>
										</span>
									</div>
								</div>
							</div>

						</div> 
						<div class="row">
							<div class="col-md-10 col-lg-10 col-sm-10 col-xs-10">
								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">date_range</i>
									</span>
									<div id="grp-dateofverification" class="form-group{{ $errors->has('dateofverification') ? ' has-error' : '' }} label-floating">
										<label class="control-label">Date of inspection </label>
										<input id="dateofverification" name="dateofverification" type="text" class="form-control datepicker" autocomplete="off" value="{{Carbon\Carbon::today()->toDateString()}}">

										<span class="help-block">
											<strong id="">Date should be at least 3 years prior to application date on the application form</strong><br>
											<strong id="err-dateofverification">{{ $errors->first('dateofverification') }}</strong>
										</span>
									</div>
								</div>
							</div> 
						</div>              
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-fill btn-success" form="addDFOComment_form">Confirm</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>