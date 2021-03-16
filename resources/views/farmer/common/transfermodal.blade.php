<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="transModalLabel"><strong>Farmer Information Transfer Form</strong></h2>
                <h4 class="modal-title" id="transModalLabel"><strong>You are about to transfer {{$data->name}} to another County.</strong></h4><h5> <p class="text-warning">This form is for use when a farmer has changed his area of residency.</p></h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('farmerTransfer')}}" id="transfer_form"  enctype="multipart/form-data" onSubmit="return transferChk()">
                    {{ csrf_field() }}
                    <input type="hidden" name="individual_id" value="{{$data->id}}">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                            <h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Age"> <i class="fa fa-fw fa-user-o" aria-hidden="true" style="padding-right:10px"></i> User initiating transfer: {{Auth::user()->name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                            <h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Age"> <i class="fa fa-fw fa-map-marker" aria-hidden="true" style="padding-right:10px"></i> County making the transfer: {{Auth::user()->county}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div>
                            <h5 class="description text-black" style="color: #000000; font-size: 15px;"><span rel="tooltip" title="Age"> <i class="fa fa-fw fa-calendar" aria-hidden="true" style="padding-right:10px"></i> Transfer date: {{Carbon\Carbon::today()->toDateString()}}</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">account_box</i>
                                </span>
                                <div id="grp-oldregistration" class="form-group{{ $errors->has('oldregistration') ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Farmer's Badge Number in your records: <span class="red">*</span></label>
                                    <input id="oldregistration" name="oldregistration" type="text" class="form-control oldregistration" value="{{old('oldregistration')}}">

                                    <span class="help-block">                        
                                        <strong id="">Format AAAA/xxxxx/xxxx</strong><br>
                                        <strong id="err-oldregistration">{{ $errors->first('oldregistration') }}</strong>
                                    </span>
                                </div>
                            </div>

                            <!-- <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">date_range</i>
                                </span>
                                <div id="grp-dateofissue" class="form-group{{ $errors->has('dateofissue') ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Date of Issue <span class="red">*</span></label>
                                    <input id="dateofissue" name="dateofissue" type="text" class="form-control datepicker" autocomplete="off" value="1900-01-01">

                                    <span class="help-block">
                                        <strong id="err-dateofissue">{{ $errors->first('dateofissue') }}</strong>
                                    </span>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">edit_location</i>
                                </span>
                            <div id="grp-county" class="form-group{{ $errors->has('county') ? ' has-error' : '' }} label-floating">
                                <label class="control-label">Transfer to County: <span class="red">*</span></label>
                                <select id="county" name="county" class="form-control dropdown">
                                    <option disabled="" selected=""></option>
                                    @foreach($counties as $county)
                                    <option value="{{$county->id}}" {{old('county')==$county->id ? 'selected' : '' }}>{{$county->county}}</option>
                                    @endforeach
                                </select>

                                <span class="help-block">
                                    <strong id="err-county">{{ $errors->first('county') }}</strong>
                                </span>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">chat</i>
                                </span>
                                               <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                                                   <label class="control-label">Comments/Remarks<span class="red">*</span></label>
                                                   <textarea class="form-control comments" name="comments" id="comments" rows="2">{{old('comments')}}</textarea>

                                               </div>

                                               <span class="help-block text-danger">
                                                   <strong id="err-comments">{{ $errors->first('comments') }}</strong>
                                               </span>
                                           </div>
                                           </div>
                    </div>
                </form>                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-fill btn-blue" form="transfer_form">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>