<div class="tab-pane" id="appointment">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="info-text">Appointment Details</h4>
            </div>
        </div>
        <div class="row">
            <h4 class="info-text">Select an appointment date</h4>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <small>
                        <span class="text-danger">
                            <strong id="err-appointment">{{ $errors->first('appointment') }}</strong>
                        </span>
                    </small>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                
                <div class="row">
                    <div class="col-sm-8">
                        <div id="grp-appointment" class="form-group{{ $errors->has('appointment') ? ' has-error' : '' }} label-floating">
                            <div class="form-group available-dates" id="available-dates">

                                <div class="form-check custom-control custom-radio radio-date" id="radio-date">
                                    <input type="text" class="form-control" name="appointmentdate" id="appointmentdate" value="{{old('appointmentdate')}}" readonly="true" placeholder="available date">
                                </div>



                            </div>


                            <!-- <span class="help-block">
                                <strong id="">Please select and appointment date.</strong><br>
                                <strong id="err-appointment">{{ $errors->first('appointment') }}</strong>
                            </span> -->
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <button type="button" id="btn-check" class="btn btn-info">Check Available Appointment Date</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row">
            <h4 class="info-text">Select a time</h4>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <small>
                        <span class="text-danger">
                            <strong id="err-appointment-date">{{ $errors->first('app_time') }}</strong>
                        </span>
                    </small>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 text-center">
                
                <div id="grp-appointment-date" class="form-group{{ $errors->has('app_time') ? ' has-error' : '' }} label-floating">
                    <!-- <div class="form-group available-time" id="available-time"> -->

                        <div class="btn-group" role="group" aria-label="">
                            <label class="btn btn-info">
                                <input type="radio" class="app_time" name="app_time" id="app_time1">9am
                            </label>
                            <label class="btn btn-info">
                                <input type="radio" class="app_time" name="app_time" id="app_time2">10am
                            </label>
                            <label class="btn btn-info">
                                <input type="radio" class="app_time" name="app_time" id="app_time3">11am
                            </label>
                            <label class="btn btn-info">
                                <input type="radio" class="app_time" name="app_time" id="app_time4">1pm
                            </label>
                            <label class="btn btn-info">
                                <input type="radio" class="app_time" name="app_time" id="app_time5">2pm
                            </label>
                            <label class="btn btn-info">
                                <input type="radio" class="app_time" name="app_time" id="app_time6">3pm
                            </label>
                        </div>
                        <!-- <span class="help-block">
                            
                            <strong id="err-appointment-date">{{ $errors->first('app_time') }}</strong>
                        </span> -->
                    <!-- </div> -->
                </div>
                
            </div>
        </div>
        <hr>
        <div class="text-center"><strong>Additional Details</strong></div>
        <div class="row">
            <div class="col-sm-12">                    
                <div id="grp-comment" class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                    <label class="control-label">Reason (Optional)</label>
                    <textarea class="form-control comments upper-case" name="comments" id="comments" rows="2" placeholder="Optionally state the reason you are interested in registering as a farmer">{{old('comments')}}</textarea>
                     
                </div>

            </div>
        </div>
    </div>

</div>