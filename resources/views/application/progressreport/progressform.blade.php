<div class="tab-pane" id="farmvisit">
  
    <!-- crop production sysyem - major crops -->
    <h4 class="info-text">
        Information on Crops<br>
        <small>
            <span class="text-danger text-center">
                <strong id="err-enterprise">{{ $errors->first('enterprise') }}</strong>
            </span>
        </small>
    </h4>
    <hr>
    <div class="row">
        <div class="hidden-input">
                    
                    <input type="hidden" name="app_id" id="app_id" value="{{$application_id}}"/>
                    <input type="hidden" name="parcel_id" id="parcel_id" value="{{$current_parcel->id}}"/>
                </div>
        <!-- section 1 --> 
        <div class="col-md-12">
            
            
            <!-- county and date -->
            <div class="row">
                <div class="col-sm-4">
                    <div id="grp-county" class="form-group{{ $errors->has('county') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">County </label>
                    <input disabled id="county" name="county" type="text" class="form-control county" value="{{$current_parcel->county}}">
                    </div>          
                </div>
                <div class="col-sm-4 col-sm-offset-4">
                    <div id="grp-appdate" class="form-group{{ $errors->has('appdate') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Date(yyy-mm-dd) <span class="red">*</span></label>
                        <input id="appdate" name="appdate" type="text" class="form-control datepicker" autocomplete="off" value="">

                        <span class="help-block">
                            <strong id="err-appdate">{{ $errors->first('appdate') }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            <!-- uprn pid survey plan no -->
            <div class="row">
                

                    <div class="col-sm-6">
                        <div id="grp-uprns" class="form-group{{ $errors->has('uprns') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Please Enter UPRN  </label>

                            <input id="uprns" name="uprns" type="text" class="form-control uprns"  value="{{old('uprns')}}" style="text-transform:uppercase">

                            <span class="help-block">
                                <strong id="err-uprns">{{ $errors->first('uprns') }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="grp-pid" class="form-group{{ $errors->has('pid') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Please Enter PID  </label>

                            <input id="pid" name="pid" type="text" class="form-control pid"  value="{{old('pid')}}" style="text-transform:uppercase">

                            <span class="help-block">
                                <strong id="err-pid">{{ $errors->first('pid') }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div id="grp-surveyplan" class="form-group{{ $errors->has('surveyplan') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Sketch/Survey Plan No.  </label>

                            <input id="surveyplan" name="surveyplan" type="text" class="form-control surveyplan"  value="{{old('surveyplan')}}" style="text-transform:uppercase">

                            <span class="help-block">
                                <strong id="err-surveyplan">{{ $errors->first('surveyplan') }}</strong>
                            </span>
                        </div>
                    </div>
                
            </div>
            <!-- location hectarage -->
            <div class="row">
                <div class="col-sm-8">
                        <div id="grp-location" class="form-group label-floating">
                            <label class="control-label">District  </label>

                            <input disabled id="location" name="location" type="text" class="form-control location"  value="{{$current_parcel->land->address->address}}" style="text-transform:uppercase">

                            
                        </div>
                </div>
                <div class="col-sm-4">
                    <div id="grp-parcel_area" class="form-group{{ $errors->has('parcel_area') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Area(Ha) <span class="red">*</span></label>
                        <input id="parcel_area" name="parcel_area"  type="number" step="any" class="form-control parcel_area" parcel="" value="{{$current_parcel->land->area_amt}}" min="0">

                        <span class="help-block">
                            <strong id="err-parcel_area">{{ $errors->first('parcel_area') }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            <!-- district ward block name -->
             <div class="row">
                

                    <div class="col-sm-6">
                        <div id="grp-district" class="form-group label-floating">
                            <label class="control-label">District  </label>

                            <input disabled id="district" name="district" type="text" class="form-control district"  value="{{$current_parcel->land->address->district->farmdistrict ? $current_parcel->land->address->district->farmdistrict->district_name : 'No district set'}}" style="text-transform:uppercase">

                            
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div id="grp-ward" class="form-group label-floating">
                            <label class="control-label">Ward  </label>

                            <input disabled id="ward" name="ward" type="text" class="form-control ward"  value="{{$current_parcel->land->address->district->ward->ward}}" style="text-transform:uppercase">

                            
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div id="grp-blockname" class="form-group{{ $errors->has('blockname') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Block Name  </label>

                            <input id="blockname" name="blockname" type="text" class="form-control blockname"  value="{{old('blockname')}}" style="text-transform:uppercase">

                            <span class="help-block">
                                <strong id="err-blockname">{{ $errors->first('blockname') }}</strong>
                            </span>
                        </div>
                    </div>
                
            </div>
            <div class="row">
            </div>

            <!-- GPS -->
            <div class="row">
                <div class="col-sm-5">
                    <div id="grp-gps_coordinate" class="form-group{{ $errors->has('gps_coordinate') ? ' has-error' : '' }} label-floating">
                        <!-- warining if gps errors occur -->
                        <div class="row">
                            <div class="alert alert-warning hide">
                                <strong>Notice!</strong><p id="warning"></p>

                            </div>
                        </div>

                        <input type="text" class="form-control" id="gps_coordinate_lat" name="gps_coordinate_lat"  placeholder="Latitude value" />


                        <span class="help-block">
                            <strong id="err-gps_coordinate">{{ $errors->first('gps_coordinate') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="col-sm-5">

                    <div id="grp-gps_coordinate" class="form-group{{ $errors->has('gps_coordinate') ? ' has-error' : '' }} label-floating">



                        <input type="text" class="form-control" id="gps_coordinate_long" name="gps_coordinate_long" placeholder="Longitude value"/>

                        <span class="help-block">
                            <strong id="err-gps_coordinate">{{ $errors->first('gps_coordinate') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="col-sm-1 " >
                    <div class="input-group">
                        <span class="input-group-addon ">
                            <i class="fa fa-map-marker fa-2x " aria-hidden="true"rel="tooltip" title="Automatically gets GPS location if you are at the site of the parcel" onclick="getLocation()" style="display: flex;justify-content: left;padding-left: -100px !important;   margin: 0 !important; padding-top: 25px"></i>
                        </span>
                    </div>
                </div>
            </div> 
        </div>
        <!-- section 2 --> 
        <div class="col-md-12">
            
        </div>

    </div>
    <!-- crop loss -->
    <h4 class="info-text">
        Crop Loss<br>
        <small>
            <span class="text-danger text-center">
                <strong id="err-enterprise">{{ $errors->first('enterprise') }}</strong>
            </span>
        </small>
    </h4>

</div>