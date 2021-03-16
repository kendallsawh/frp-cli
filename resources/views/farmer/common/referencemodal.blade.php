<div class="modal fade" id="referenceModal" tabindex="-1" role="dialog" aria-labelledby="refModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="refModalLabel">Add {{$data->name}} as farmer?</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('farmerAddFarmer')}}" id="ref_form"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="individual_id" value="{{$data->id}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">account_box</i>
                                </span>
                                <div id="grp-oldregistration" class="form-group{{ $errors->has('oldregistration') ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Farmer's Registration Number <span class="red">*</span></label>
                                    <input id="oldregistration" name="oldregistration" type="text" class="form-control oldregistration" value="{{old('oldregistration')}}">

                                    <span class="help-block">                        
                                        <strong id="">Format AAAA/xxxx/xxxx</strong><br>
                                        <strong id="err-oldregistration">{{ $errors->first('oldregistration') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="input-group">
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
                            </div>
                        </div>
                    </div>
                </form>                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-fill btn-blue" form="ref_form">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>