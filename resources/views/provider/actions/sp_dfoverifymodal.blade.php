
<div class="modal fade" id="dfoVerifyModal" tabindex="-1" role="dialog" aria-labelledby="dfoVerifyModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="dfoVerifyModalLabel">Add DFO data as {{Auth::user()->role_name}}</h4>
				<h5 class="description" id="dfoVerifyModalLabel">You are about to add dfo data for application: {{$data->id}}.</h5>

			</div>
			<div class="modal-body">


				<form method="POST" action="{{route('addSPDFOVerify')}}" id="dfoVerify_form"  enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="view_id" value="{{$data->id}}">
					
					
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
						
							
             
					
				</form>
			</div>
			<div class="modal-footer">

				<button type="submit" class="btn btn-fill btn-success" form="dfoVerify_form">Confirm</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>