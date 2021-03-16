
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @foreach($errors->all(':message') as $message)
                <div id="form-messages" class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @endforeach()
                <h4 class="modal-title" id="resetModalLabel">Confirm resetting of Application from Approved to Pending</h4>
                
            </div>
            <div class="modal-body">


                <form method="POST" action="{{route('resetApplication')}}" id="reset_form"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="view_id" value="{{$data->id}}">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-title text-left">
                                <h5 class="description"><i class="fa fa-fw fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->name}}@if($data->applicant()->alias) <i>({{$data->applicant()->alias}})</i>@endif</h5>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-fill btn-warning" form="reset_form">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>