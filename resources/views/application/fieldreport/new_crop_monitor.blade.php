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
        <div class="col-md-12" id="div-crops-1">
        <div class="row">
            <div class="col-sm-6">
                <div id="grp-officer" class="form-group{{ $errors->has('officer') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Officer</label>
                    <select id="officer" name="officer" class="form-control dropdown">
                        <option disabled="" selected=""></option>
                        @foreach($userlists as $userlist)
                        <option value="{{$userlist->id}}" {{old('officer')==$userlist->id ? 'selected' : '' }}>{{$userlist->name}}</option>
                        @endforeach
                    </select>

                    <span class="help-block">
                        <strong id="err-officer">{{ $errors->first('officer') }}</strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-check checkbox-inline">
                  <input class="form-check-input" type="radio" id="inlineCheckbox1" name="report_type" value="1">
                  <label class="form-check-label" for="inlineCheckbox1">AIP</label>
                </div>
                <div class="form-check checkbox-inline">
                  <input class="form-check-input" type="radio" id="inlineCheckbox2" name="report_type" value="2">
                  <label class="form-check-label" for="inlineCheckbox2">FVR</label>
                </div>
                <div class="form-check checkbox-inline">
                  <input class="form-check-input" type="radio" id="inlineCheckbox3" name="report_type" value="3" >
                  <label class="form-check-label" for="inlineCheckbox3">FRP</label>
                </div>
                <div class="form-check checkbox-inline">
                  <input class="form-check-input" type="radio" id="inlineCheckbox4" name="report_type" value="5" >
                  <label class="form-check-label" for="inlineCheckbox3">ADVISORY</label>
                </div>
                <div class="form-check checkbox-inline">
                  <input class="form-check-input" type="radio" id="inlineCheckbox5" name="report_type" value="5" >
                  <label class="form-check-label" for="inlineCheckbox3">OTHER</label>

                </div>
                <div class="form-check checkbox-inline">
                     <div style="display: block; padding-bottom: 15px;" id="other-text">
                      <input id="report_other" type="text" name="report_other" slug="other" placeholder="Other name" class="form-control" value="{{old('report_other')}}" style="text-transform:uppercase"/>
                    </div>
                </div>
          


            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <div id="grp-gps_coordinate" class="form-group{{ $errors->has('gps_coordinate') ? ' has-error' : '' }} label-floating">

                    <p id="warning"></p>
                    
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
        <div class="row">
            <div class="col-md-2" style="padding-top: 20px">
                <div class="input-group">
                                                       
                    <div id="grp-farm_visit_date" class="form-group{{ $errors->has('farm_visit_date') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Farm Visit Date</label>
                        <input id="farm_visit_date" name="farm_visit_date" type="text" class="form-control datepicker" autocomplete="off" >

                        <span class="help-block">
                            <strong id="">Please enter the date of investigation.</strong><br>
                        </span>
                    </div>

                </div>
            </div>
        </div>  
        
        <div id="accordion">
            <div class="hidden-input">
                
                <input type="hidden" name="app_id" id="app_id" value="{{$application_id}}"/>
                <input type="hidden" name="parcel_id" id="parcel_id" value="{{$current_parcel->id}}"/>
            </div>
            @for ($crop = 1; $crop <= 10; $crop++)
            <div class="hidden-input">
                <input type="hidden" name="crop_count[{{$crop}}]" id="crop_count_{{$crop}}" value="{{$crop}}">
               
            </div>

            <div class="card" >
                
                <div class="card-header">
                  <a class="card-link" data-toggle="collapse" href="#collapse-{{$crop}}">
                   
                    <button type="button" class="btn btn-default btn-round btn-sm" title="Show or hide this crop information."  rel="tooltip"> Crop Item {{$crop}} Show/Hide 
                    </button>
                    
                    </a>
                    <button type="button" class="btn btn-success btn-round btn-sm hide" title="Restore this crop information before submitting."  rel="tooltip" id="restore_crop{{$crop}}" onclick="restorecrop({{$crop}})"> Restore Crop
                    </button>
                </div>
                <div class="row collapse" style="background-color: #FCFCFC" id="collapse-{{$crop}}" data-parent="#accordion">
                                    <div class="col-md-12 round-border-20 card-body" style="padding-bottom: 50px;">
                                        <div class="row" >
                                            <div class="col-sm-12">
                                                <h4 class="info-text">
                                                    Type of Crops/Animals 
                                                    
                                                </h4>
                                            </div>
                                            <h6 class="info-text">
                                                <strong>Crop {{$crop}}</strong> 
                                                <a type="button" name="btn_remove_crop[{{$crop}}]" class="btn btn-danger btn-round btn-sm" onclick="removecrop({{$crop}})">  Remove</a>
                                                
                                            </h6>

                                            <div class="col-md-2">
                                                <div id="grp-parcel_type_{{$crop}}" class="form-group{{ $errors->has('parcel_type.'.'.'.$crop) ? ' has-error' : '' }} label-floating">
                                                    
                                                    
                                                    <input type="hidden" name="delete_crop[{{$crop}}]" id="delete_crop{{$crop}}" value="0"/>

                                                    <label class="control-label">Type of Crop/Animal</label>
                                                    <select id="parcel_type_{{$crop}}" name="parcel_type[{{$crop}}]" class="form-control dropdown parcel_type" parcel="{{$crop}}" crop="{{$crop}}">
                                                        <option disabled="" selected=""></option>
                                                        @foreach($parcel_types as $parcel_type)
                                                        <option value="{{$parcel_type->id}}" unit="{{$parcel_type->unit->parcel_unit}}"
                                                            >{{$parcel_type->parcel_type}}</option>

                                                            @endforeach
                                                        </select>

                                                        <span class="help-block">
                                                            <strong id="err-parcel_type_{{$crop}}">{{ $errors->first('parcel_type.'.'.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">

                                                    <div class="form-group{{ $errors->has('animal_crop.'.$crop) ? ' has-error' : '' }} label-floating" id="grp-animal_crop_{{$crop}}">
                                                        <label class="control-label">Specific Crop/Animal </label>
                                                        

                                                        <select id="animal_crop_{{$crop}}" name="animal_crop[{{$crop}}]" class="form-control dropdown animal_crop" parcel="{{$crop}}" crop="{{$crop}}">
                                                            <option disabled="" selected=""></option>
                                                             @foreach($animal_crops as $key=>$animal_crop)
                                            <option value="{{$animal_crop->id}}">{{$animal_crop->CommodityLocalName}}({{$animal_crop->Variety}})</option>
                                            @endforeach
                                                        </select>

                                                        <span class="help-block">
                                                            <strong id="err-animal_crop_{{$crop}}">{{ $errors->first('animal_crop.'.'.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">
                                                    <div class="form-group{{ $errors->has('parcel_amt.'.$crop) ? ' has-error' : '' }} label-floating" id="grp-parcel_amt_{{$crop}}">
                                                        <label class="control-label">Area Planted </label>
                                                        <div class="input-group">
                                                            <input id="parcel_amt_{{$crop}}" name="parcel_amt[{{$crop}}]" type="number" step="any" class="form-control parcel_amt" parcel="1"  min="0">
                                                            <span class="input-group-addon unit-addon" id="parcel_unit_1_{{$crop}}">
                                                                
                                                            </span>
                                                        </div>

                                                        <span class="help-block">
                                                            <strong id="err-parcel_amt_{{$crop}}">{{ $errors->first('parcel_amt.'.'.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">
                                                    <div id="grp-spacing_{{$crop}}" class="form-group{{ $errors->has('spacing.'.'.'.$crop) ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Spacing(sq. ft.)</label>
                                                        <input id="spacing_{{$crop}}" name="spacing[{{$crop}}]"  type="number" step="any" class="form-control spacing" parcel="1" value="{{old('spacing.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-spacing_{{$crop}}">{{ $errors->first('spacing.'.'.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">
                                                    <div id="grp-number_plants_{{$crop}}" class="form-group{{ $errors->has('number_plants.'.$crop) ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Number of plants</label>
                                                        <input id="number_plants_1" name="number_plants[{{$crop}}]"  type="number" step="any" class="form-control number_plants" parcel="1" value="{{old('number_plants.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-number_plants_{{$crop}}">{{ $errors->first('number_plants.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row" >
                                            <div class="col-md-2">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Estimated Pest Loss(%)</label>
                                                        <input id="parcel_area_1" name="pest_loss[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Deviation(# Plants)</label>
                                                        <input id="parcel_area_1" name="plant_diviation[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="-9999">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                        </div>
                                            
                                        <div class="row" >
                                                
                                                <div class="col-md-12 round-border">
                                                    <h6 class="text-center" style="padding-bottom: -50px">
                                                        Select Variance Code
                                                    </h6>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-D-{{$crop}}">
                                                                <input id="variance-D-{{$crop}}" type="radio" name="variancecode[{{$crop}}][1]" value="1" class="variancecode" slug="D-{{$crop}}" ><span class="circle"></span><span class="check"></span> DISEASE
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-L-{{$crop}}">
                                                                <input id="variance-L-{{$crop}}" type="radio" name="variancecode[{{$crop}}][2]" value="2" class="variancecode" slug="L-{{$crop}}" ><span class="circle"></span><span class="check"></span> LARCENY
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-P-{{$crop}}">
                                                                <input id="variance-P-{{$crop}}" type="radio" name="variancecode[{{$crop}}][3]" value="3" class="variancecode" slug="P-{{$crop}}" ><span class="circle"></span><span class="check"></span> PEST
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-F-{{$crop}}">
                                                                <input id="variance-F-{{$crop}}" type="radio" name="variancecode[{{$crop}}][4]" value="4" class="variancecode" slug="F-{{$crop}}" ><span class="circle"></span><span class="check"></span> FLOOD                   
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-B-{{$crop}}">
                                                                <input id="variance-B-{{$crop}}" type="radio" name="variancecode[{{$crop}}][5]" value="5" class="variancecode" slug="B-{{$crop}}" ><span class="circle"></span><span class="check"></span> FIRE                   
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-U-{{$crop}}">
                                                                <input id="variance-U-{{$crop}}" type="radio" name="variancecode[{{$crop}}][6]" value="6" class="variancecode" slug="U-{{$crop}}" ><span class="circle"></span><span class="check"></span> UNKNOWN
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-O-{{$crop}}">
                                                                <input id="variance-O-{{$crop}}" type="radio" name="variancecode[{{$crop}}][7]" value="7" class="variancecode" slug="O-{{$crop}}" ><span class="circle"></span><span class="check"></span> OTHER
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-T-{{$crop}}">
                                                                <input id="variance-T-{{$crop}}" type="radio" name="variancecode[{{$crop}}][8]" value="8" class="variancecode" slug="T-{{$crop}}" ><span class="circle"></span><span class="check"></span> DROUGHT
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-R-{{$crop}}">
                                                                <input id="variance-R-{{$crop}}" type="radio" name="variancecode[{{$crop}}][9]" value="9" class="variancecode" slug="R-{{$crop}}" ><span class="circle"></span><span class="check"></span> REPLANTING
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-NP-{{$crop}}">
                                                                <input id="variance-NP-{{$crop}}" type="radio" name="variancecode[{{$crop}}][10]" value="10" class="variancecode" slug="NP-{{$crop}}" ><span class="circle"></span><span class="check"></span> NEW PLANTING
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row" >
                                                <div class="col-md-2" style="padding-top: 20px">
                                                    <div class="input-group">
                                                       
                                                        <div id="grp-planting_date" class="form-group{{ $errors->has('planting_date') ? ' has-error' : '' }} label-floating">
                                                            <label class="control-label">Planting Date</label>
                                                            <input id="planting_date" name="planting_date[{{$crop}}]" type="text" class="form-control datepicker" autocomplete="off" value="">

                                                            <span class="help-block">
                                                                <strong id="">Please enter the date of registration.</strong><br>
                                                                <!-- <strong id="err-planting_date">{{ $errors->first('planting_date') }}</strong> -->
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-top: 20px">
                                                    <div class="input-group">
                                                       
                                                        <div id="grp-appdate" class="form-group{{ $errors->has('appdate') ? ' has-error' : '' }} label-floating">
                                                            <label class="control-label">Anticipated Harvest Date</label>
                                                            <input id="appdate" name="ant_harvest_date[{{$crop}}]" type="text" class="form-control datepicker" autocomplete="off" value="">

                                                            <span class="help-block">
                                                                <strong id="">Please enter the date of registration.</strong><br>
                                                                <!-- <strong id="err-appdate">{{ $errors->first('appdate') }}</strong> -->
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-top: 20px">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Antcipated Week</label>
                                                        <input id="parcel_area_1" name="ant_harvest_week[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-top: 20px">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Anticipated Harvest Time</label>
                                                        <input id="parcel_area_1" name="ant_harvest_time[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row" >
                                                <div class="col-md-2" >
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Avg Yield/Plant(kg)</label>
                                                        <input id="parcel_area_1" name="avg_yield[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" >
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Anticipated Volume at Harvest(kg)</label>
                                                        <input id="parcel_area_1" name="ant_vol[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Deviation(Yields)</label>
                                                        <input id="parcel_area_1" name="deviation[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="-9999">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="grp-percent_loss_{{$crop}}" class="form-group{{ $errors->has('percent_loss.'.$crop) ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Percent Loss %</label>
                                                        <input id="parcel_area_{{$crop}}" name="percent_loss[{{$crop}}]"  type="number" step="any" class="form-control percent_loss" parcel="1" value="{{old('percent_loss.'.$crop)}}" min="-9999">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('percent_loss.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                </div>
            </div>
            <br>
            @endfor
            <!-- activity and status -->
            <div class="row">
                <!-- row 1 -->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('record_keeping') ? ' has-error' : '' }}">
                            <label class="control-label">Record Keeping</label>
                            <textarea class="form-control" name="record_keeping" id="record_keeping" rows="2">{{old('record_keeping')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-record_keeping">{{ $errors->first('record_keeping') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('ff_sanitation') ? ' has-error' : '' }}">
                            <label class="control-label">Farm/Field Sanitation</label>
                            <textarea class="form-control" name="ff_sanitation" id="ff_sanitation" rows="2">{{old('ff_sanitation')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-ff_sanitation">{{ $errors->first('ff_sanitation') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- row 2 -->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('env_conservation') ? ' has-error' : '' }}">
                            <label class="control-label">Environment Conservation</label>
                            <textarea class="form-control" name="env_conservation" id="env_conservation" rows="2">{{old('env_conservation')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-env_conservation">{{ $errors->first('env_conservation') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('waste_mgmt') ? ' has-error' : '' }}">
                            <label class="control-label">Waste Management</label>
                            <textarea class="form-control" name="waste_mgmt" id="waste_mgmt" rows="2">{{old('waste_mgmt')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-waste_mgmt">{{ $errors->first('waste_mgmt') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- row 3 -->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('water_source') ? ' has-error' : '' }}">
                            <label class="control-label">Water Source</label>
                            <textarea class="form-control" name="water_source" id="water_source" rows="2">{{old('water_source')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-water_source">{{ $errors->first('water_source') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('irrigation') ? ' has-error' : '' }}">
                            <label class="control-label">Irrigation</label>
                            <textarea class="form-control" name="irrigation" id="irrigation" rows="2">{{old('irrigation')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-irrigation">{{ $errors->first('irrigation') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- row 4 -->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('pest_mgmt') ? ' has-error' : '' }}">
                            <label class="control-label">Pest Management</label>
                            <textarea class="form-control" name="pest_mgmt" id="pest_mgmt" rows="2">{{old('pest_mgmt')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-pest_mgmt">{{ $errors->first('pest_mgmt') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('disease_mgmt') ? ' has-error' : '' }}">
                            <label class="control-label">Disease Management</label>
                            <textarea class="form-control" name="disease_mgmt" id="disease_mgmt" rows="2">{{old('disease_mgmt')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-disease_mgmt">{{ $errors->first('disease_mgmt') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- row 5 -->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('comment_spacing') ? ' has-error' : '' }}">
                            <label class="control-label">Spacing</label>
                            <textarea class="form-control" name="comment_spacing" id="comment_spacing" rows="2">{{old('comment_spacing')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-comment_spacing">{{ $errors->first('comment_spacing') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('nutrition_mgmt') ? ' has-error' : '' }}">
                            <label class="control-label">Fertilizer/Nutrition Management</label>
                            <textarea class="form-control" name="nutrition_mgmt" id="nutrition_mgmt" rows="2">{{old('nutrition_mgmt')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-nutrition_mgmt">{{ $errors->first('nutrition_mgmt') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- row 6 -->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('technology') ? ' has-error' : '' }}">
                            <label class="control-label">Technology Use</label>
                            <textarea class="form-control" name="technology" id="technology" rows="2">{{old('technology')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-technology">{{ $errors->first('technology') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('marketing') ? ' has-error' : '' }}">
                            <label class="control-label">Marketing</label>
                            <textarea class="form-control" name="marketing" id="marketing" rows="2">{{old('marketing')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-marketing">{{ $errors->first('marketing') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- row 7 -->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('ph_handling') ? ' has-error' : '' }}">
                            <label class="control-label">Post Harvest Handling</label>
                            <textarea class="form-control" name="ph_handling" id="ph_handling" rows="2">{{old('ph_handling')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-ph_handling">{{ $errors->first('ph_handling') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('other_infra') ? ' has-error' : '' }}">
                            <label class="control-label">Access/Other Infrastructure</label>
                            <textarea class="form-control" name="other_infra" id="other_infra" rows="2">{{old('other_infra')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-other_infra">{{ $errors->first('other_infra') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- row 8 -->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('housing') ? ' has-error' : '' }}">
                            <label class="control-label">Housing</label>
                            <textarea class="form-control" name="housinghousing" id="housing" rows="2">{{old('housing')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-housing">{{ $errors->first('housing') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('pest_safety') ? ' has-error' : '' }}">
                            <label class="control-label">Pesticide Safety</label>
                            <textarea class="form-control" name="pest_safety" id="pest_safety" rows="2">{{old('pest_safety')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-pest_safety">{{ $errors->first('pest_safety') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- row 9 -->
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-62">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('innovation') ? ' has-error' : '' }}">
                            <label class="control-label">Innovation/Practicality</label>
                            <textarea class="form-control" name="innovation" id="innovation" rows="2">{{old('innovation')}}</textarea>


                            <span class="help-block">
                                <strong id=""></strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-innovation">{{ $errors->first('innovation') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">

                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">speaker_notes</i>
                        </span>
                        <div class="form-group{{ $errors->has('advice_given') ? ' has-error' : '' }}">
                            <label class="control-label">Advice Given</label>
                            <textarea class="form-control" name="advice_given" id="advice_given" rows="3">{{old('advice_given')}}</textarea>


                            
                            <span class="help-block text-danger">
                                <strong id="err-advice_given">{{ $errors->first('advice_given') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        </div>
    </div>
    

</div>