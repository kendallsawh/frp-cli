
<div class="modal fade" id="dfoModal" tabindex="-1" role="dialog" aria-labelledby="dfoModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="dfoModalLabel">Add {{Auth::user()->role_slug === 'frc'? 'DFO/SLO' : strtoupper(Auth::user()->role_slug)}} data as {{Auth::user()->RoleName}}</h4>
				<h5 class="description" id="dfoModalLabel">You are about to add {{strtoupper(Auth::user()->role_slug)}} comments for application: {{$data->id}}.</h5>
				<h5 class="description" id="dfoModalLabel">If you are entering comments on behalf of another user, please state thier name in the comment.</h5>


			</div>
			<div class="modal-body">


				<form method="POST" action="{{route('addApplicationComment')}}" id="addDFOComment_form" class="addDFOComment_form"  enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="view_id" value="{{$data->id}}">
					<input type="hidden" name="badge_id" value="{{$data->applicant()->farmer()? ($data->applicant()->farmer()->badge()? $data->applicant()->farmer()->badge()->farmer_badge : ''):''}}">
					
					<div class="row">
						<div class="col-md-4">
							<div class="card-title text-left">

								<h5 class="description"><span rel="tooltip" title="Name"><i class="fa fa-fw fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->name}}@if($data->applicant()->alias) <i>({{$data->applicant()->alias}})</i>@endif </span></h5>

							</div>

						</div>
						<div class="col-md-4">

							<div class="card-title text-left">
								<h5 class="description"><span rel="tooltip" title="Farmer Badge ID">Badge No: {{$data->applicant()->farmer()? ($data->applicant()->farmer()->badge()? $data->applicant()->farmer()->badge()->farmer_badge : ''):''}} </span></h5>
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
							@if(!(auth()->user()->role_id == 6 ))
							<div class="col-md-6 ">
								<div class="input-group">
									<span class="input-group-addon" >
										<i class="material-icons">perm_identity</i>
									</span>
									<div id="grp-parcel" class="form-group{{ $errors->has('parcel') ? ' has-error' : '' }} label-floating">
										<label class="control-label">Select Parcel Address<span class="red">*</span></label>
										<select id="dfo_parcel" name="parcel" class="form-control dropdown" >
											<option disabled="" selected=""></option>
											@foreach($data->parcels() as $parcel)
											<option value="{{$parcel->id}}" {{old('parcel')==$parcel->id ? 'selected' : '' }}>{{$parcel->land->address->address}}</option>
											@endforeach
										</select>

										<span class="help-block">
											<strong id="err-parcel">{{ $errors->first('parcel') }}</strong>
										</span>
									</div>
								</div>
							</div>
						@endif
							
							
						</div>
						<div class="row" id="checklist">
							<!-- this is where the list of all produc is listed depending to the parcel selected -->
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
										<label class="control-label">Date of inspection<span class="red">*</span> </label>
										<input id="dateofverification" name="dateofverification" type="text" class="form-control datepicker" autocomplete="off">

										<span class="help-block">
											<strong id="">Date should be at least 3 years prior to application date on the application form</strong><br>
											<strong id="err-dateofverification">{{ $errors->first('dateofverification') }}</strong>
										</span>
									</div>
								</div>
							</div> 
						</div>              
					
				</form>
				<h5 class="text-warning">
					@if(Auth::user()->role_id == 5 && $data->status_id !== 3)
						It is recommended to add comments <b>after</b> the application has been recommended by the <b>Investigating Officer</b>. Application has only been recommended by the <b>FRP Clerk</b> Please request that the appropiate person clicks the recommend button from thoer profile.
					@endif
					@if(Auth::user()->role_id == 6 && $data->status_id !== 4)
						It is recommended to add comments <b>after</b> the application has been recommended by the <b>AAIII</b>. Please request that the appropiate person clickes the recommend button from thoer profile.
					@endif
				</h5>
			</div>
			<div class="modal-footer">
				<div>
					@if($dfo_assigned !== '')
                                    <h5> <p class="text-warning  text-left">{{$dfo_assigned}}</p></h5>
                                    @endif
				</div>
				
				<button type="submit" class="btn btn-fill btn-success add_comment_btn" form="addDFOComment_form" >Confirm</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>