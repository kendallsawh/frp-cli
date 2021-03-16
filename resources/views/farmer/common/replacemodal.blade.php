
<div class="modal fade" id="replaceModal" tabindex="-1" role="dialog" aria-labelledby="replaceModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="replaceModalLabel">Replace Badge</h4>
            </div>
            <div class="modal-body">
                <p><label><span class="red">*</span> Required Fields</label></p>

                <form method="POST" action="{{route('farmerReplace')}}" id="replace_form" onSubmit="return replaceChk()" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="badge_id" value="{{$data->farmer()->badge()->id}}">
                    
                    <div class="col-md-12" style="top: 10px;">
                        <label>Reason <span class="red">*</span></label>

                        <span class="help-block text-danger">
                            <strong id="err-type">{{ $errors->first('type') }}</strong>
                        </span>
                    </div>
                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        @foreach($rep_types as $rep_type)
                        <div class="col-md-6">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="type" class="type" value="{{$rep_type->id}}" {{old('type')==$rep_type->id ? 'checked' : '' }}> {{$rep_type->replacement_type}}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-12 {{old('type')=='1' ? '' : 'hide' }} " id="police_report_div">
                        <div class="form-group{{ $errors->has('police_report') ? ' has-error' : '' }}">
                            <label class="control-label">Police Report <span class="red">*</span></label>
                            <input id="police_report" name="police_report" type="file" multiple style="opacity: inherit;position: relative;">
                        </div>

                            <span class="help-block text-danger">
                                <strong id="err-police_report">
                                {{ $errors->first('police_report') }}
                                {{old('type')=='1' ? 'Please upload police report again.' : '' }}
                                </strong>
                            </span>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            <label class="control-label">Comments <span class="red">*</span></label>
                            <textarea class="form-control" name="comments" id="comments">{{old('comments')}}</textarea>
                        </div>

                            <span class="help-block text-danger">
                                <strong id="err-comments">{{ $errors->first('comments') }}</strong>
                            </span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-fill btn-success" form="replace_form">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>