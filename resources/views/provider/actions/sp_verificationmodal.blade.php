
<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="verifyModalLabel">Confirm {{Auth::user()->role_name}} Verification of Application</h4>
                <h5 class="description" id="verifyModalLabel">You are about to recommend this application.</h5>
                </h5>
            </div>
            <div class="modal-body">
                 

                <form method="POST" action="{{route('verifyServiceProvider')}}" id="verify_form"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="view_id" value="{{$data->id}}">
                    <input type="hidden" name="app_status_id" value="{{$data->status->id}}">
                     @if(Auth::user()->role_id == 6)
                     <input type="hidden" name="director" value="{{Auth::user()->director()}}"/>
                     @endif
                     
                     @if($data->status_id==5)
                     <input type="hidden" name="ind_id" value="{{$data->provider->id}}">
                     @endif
                <div class="row">
                   	<div class="col-md-12">
				      	<div class="card-title text-left">
				            <h5 class="description"><i class="fa fa-fw fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->provider->name}}@if($data->provider->alias) <i>({{$data->provider->alias}})</i>@endif</h5>
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
                                       
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        

                            <span class="help-block text-danger">
                                <strong id="err-details">{{ $errors->first('details') }}</strong>
                            </span>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-fill btn-success" form="verify_form">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>