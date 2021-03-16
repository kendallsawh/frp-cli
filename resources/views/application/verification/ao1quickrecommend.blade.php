
<div class="modal fade" id="ao1QuickModal" tabindex="-1" role="dialog" aria-labelledby="ao1QuickModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ao1QuickModalLabel">Recommend application in the capacity of {{Auth::user()->RoleName}}</h4>
                <h5 class="description" id="ao1notice">Please add {{strtoupper(Auth::user()->role_slug)}} comments for application</h5>

            </div>
            <div class="modal-body">


                <form method="POST" action="{{route('ao1ListVerification')}}" id="ao1QuickRecommend"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="view_id" id="view_id" value="">
                    
                    
                   
                      
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
                                        <label class="control-label">Date of recommendation </label>
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
                
                
                <button type="submit" class="btn btn-fill btn-success" form="ao1QuickRecommend">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>