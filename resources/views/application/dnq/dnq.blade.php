
<div class="modal fade" id="dnqModal" tabindex="-1" role="dialog" aria-labelledby="dnqModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @foreach($errors->all(':message') as $message)
                <div id="form-messages" class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @endforeach()
                <h4 class="modal-title" id="dnqModalLabel">Confirm DNQ of Application</h4>
                <h5 class="description" id="verifyModalLabel">This application will not be recommended to move any further in the verification process.</h5>
            </div>
            <div class="modal-body">


                <form method="POST" action="{{route('dnqApplication')}}" id="dnq_form" onSubmit="return flagChk()" enctype="multipart/form-data">
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

                        <div class="row">

                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </span>
                                    <div id="grp-flag_type" class="form-group{{ $errors->has('flag_type') ? ' has-error' : '' }} label-floating">
                                        <label class="control-label">Disqualification Type <span class="red">*</span></label>
                                        <select id="flag_type" name="flag_type" class="form-control dropdown flag_type">
                                            <option disabled="" selected=""></option>
                                            @foreach($flagTypes as $type)
                                            <option value="{{$type->id}}" {{old('flag_type')==$type->id ? 'selected' : '' }}>{{$type->flag_type}}</option>
                                            @endforeach
                                        </select>

                                        <span class="help-block">
                                            <strong id="err-flag_type">{{ $errors->first('flag_type') }}</strong>
                                        </span>
                                    </div>
                                </div>

                            </div>
                         <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                             <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                 <label class="control-label">Specific details for flagging<span class="red">*</span></label>
                                 <textarea class="form-control details" name="details" id="details" rows="2">{{old('details')}}</textarea>

                             </div>

                             <span class="help-block text-danger">
                                 <strong id="err-details">{{ $errors->first('details') }}</strong>
                             </span>
                         </div>
                     </div>

                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-fill btn-danger" form="dnq_form">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>