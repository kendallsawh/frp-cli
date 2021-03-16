<div class="row">
        <div class="col-md-12" id="div-crops-1">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="info-text">
                    Type of Crops/Animals 
                    <button type="button" class="btn btn-success btn-round btn-fab btn-fab-mini btn-add-crop" title="Add another crop/animal"  rel="tooltip" crop="" nextcrop="" pane="1">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <div class="ripple-container"></div>
                    </button>
                </h4>
            </div>
        </div>
        
        @for ($crop = 1; $crop <= $current_parcel->produce()->count(); $crop++)
                            
                                <!-- <hr>
                                <div class="row">
                                    <div class="col-sm-12 round-border-20" id="div-crops-1">
                                        <h4 class="info-text">
                                            Type of Crops/Animals 
                                            <button type="button" class="btn btn-success btn-round btn-fab btn-fab-mini btn-add-crop" title="Add another crop/animal"  rel="tooltip" pane="1" nextcrop="{{$current_parcel->produce()->count()+1}}">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                <div class="ripple-container"></div>
                                            </button>
                                            
                                        </h4>
                                    </div>
                                </div> -->
                                <div class="row" style="background-color: #FCFCFC">
                                    <div class="col-md-12 round-border-20" style="padding-bottom: 50px;">
                                        <div class="row" >
                                            <h6 class="info-text">
                                                <strong>Crop {{$crop}}</strong> <a href="#" type="button" class="btn btn-danger btn-round btn-sm">  Remove</a>
                                            </h6>

                                            <div class="col-md-2">
                                                <div id="grp-parcel_type_1_{{$crop}}" class="form-group{{ $errors->has('parcel_type.'.'1'.'.'.$crop) ? ' has-error' : '' }} label-floating">

                                                    <input type="hidden" id="crops-added-1" name="crops_added_id[1][{{$crop}}]" value="{{$crop-1!=0? $current_parcel->produce()->slice($crop-1,1)[$crop-1]['id']: $current_parcel->produce()->first()->id}}">


                                                    <label class="control-label">Type of Crop/Animal</label>
                                                    <select id="parcel_type_1_{{$crop}}" name="parcel_type[1][{{$crop}}]" class="form-control dropdown parcel_type" parcel="1" crop="{{$crop}}">
                                                        <option disabled="" selected=""></option>
                                                        @foreach($parcel_types as $parcel_type)
                                                        <option value="{{$parcel_type->id}}" unit="{{$parcel_type->unit->parcel_unit}}" {{$crop-1==0 ? ($current_parcel->produce()->first()->parcel_type_id==$parcel_type->id ? 'selected' : '') : ($current_parcel->produce()->slice($crop-1,1)[$crop-1]['parcel_type_id']==$parcel_type->id ? 'selected' : '')}} 

                                                            >{{$parcel_type->parcel_type}}</option>

                                                            @endforeach
                                                        </select>

                                                        <span class="help-block">
                                                            <strong id="err-parcel_type_1_{{$crop}}">{{ $errors->first('parcel_type.'.'1'.'.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">

                                                    <div class="form-group{{ $errors->has('animal_crop.'.'1'.'.'.$crop) ? ' has-error' : '' }} label-floating" id="grp-animal_crop_1_{{$crop}}">
                                                        <label class="control-label">Specific Crop/Animal </label>
                                                        <!-- <input id="animal_crop_1_{{$crop}}" name="animal_crop[1][{{$crop}}]" type="text" class="form-control animal_crop" parcel="1" value="{{$crop-1==0 ? $current_parcel->produce()->first()->specific_parcel : $current_parcel->produce()->slice($crop-1,1)[$crop-1]['specific_parcel'] }}"> -->

                                                        <select id="animal_crop_1_{{$crop}}" name="animal_crop[1][{{$crop}}]" class="form-control dropdown animal_crop" parcel="1" crop="1">
                                                            <option disabled="" selected=""></option>
                                                             @foreach($animal_crops as $key=>$animal_crop)
                                            <option value="{{$animal_crop->id}}" {{($current_parcel->produce()->slice($crop-1,1)[$crop-1]['commodity_id']==$animal_crop->id? 'selected' : '')}}>{{$animal_crop->CommodityLocalName}}({{$animal_crop->Variety}})</option>
                                            @endforeach
                                                        </select>

                                                        <span class="help-block">
                                                            <strong id="err-animal_crop_1_{{$crop}}">{{ $errors->first('animal_crop.'.'1'.'.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">
                                                    <div class="form-group{{ $errors->has('parcel_amt.'.'1'.'.'.$crop) ? ' has-error' : '' }} label-floating" id="grp-parcel_amt_1_{{$crop}}">
                                                        <label class="control-label">Area Planted </label>
                                                        <div class="input-group">
                                                            <input id="parcel_amt_1_{{$crop}}" name="parcel_amt[1][{{$crop}}]" type="number" step="any" class="form-control parcel_amt" parcel="1" value="{{$crop-1==0 ? $current_parcel->produce()->first()->amt : $current_parcel->produce()->slice($crop-1,1)[$crop-1]['amt'] }}" min="0">
                                                            <span class="input-group-addon unit-addon" id="parcel_unit_1_{{$crop}}">
                                                                {{$crop-1!=0 ?$current_parcel->produce()->slice($crop-1,1)[$crop-1]->type()->first()->unit()->first()->parcel_unit:$current_parcel->produce()->first()->type()->first()->unit()->first()->parcel_unit}}
                                                            </span>
                                                        </div>

                                                        <span class="help-block">
                                                            <strong id="err-parcel_amt_1_{{$crop}}">{{ $errors->first('parcel_amt.'.'1'.'.'.$crop) }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('spacing.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Spacing(sq. ft.) <span class="red">*</span></label>
                                                        <input id="parcel_area_1" name="spacing[{{$crop}}]"  type="number" step="any" class="form-control spacing" parcel="1" value="{{old('spacing.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('spacing.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Number of plants <span class="red">*</span></label>
                                                        <input id="parcel_area_1" name="number_plants[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row" >
                                            <div class="col-md-2">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Estimated Pest Loss(%) <span class="red">*</span></label>
                                                        <input id="parcel_area_1" name="pest_loss[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                            <div class="col-md-2">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Deviation(# Plants) <span class="red">*</span></label>
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
                                                                <input id="variance-D-{{$crop}}" type="radio" name="variancecode-D[{{$crop}}]" value="D" class="variancecode" slug="D-{{$crop}}" ><span class="circle"></span><span class="check"></span> DISEASE
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-L-{{$crop}}">
                                                                <input id="variance-L-{{$crop}}" type="radio" name="variancecode-L[{{$crop}}]" value="L" class="variancecode" slug="L-{{$crop}}" ><span class="circle"></span><span class="check"></span> LARCENY
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-P-{{$crop}}">
                                                                <input id="variance-P-{{$crop}}" type="radio" name="variancecode-P[{{$crop}}]" value="P" class="variancecode" slug="P-{{$crop}}" ><span class="circle"></span><span class="check"></span> PEST
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-F-{{$crop}}">
                                                                <input id="variance-F-{{$crop}}" type="radio" name="variancecode-F[{{$crop}}]" value="F" class="variancecode" slug="F-{{$crop}}" ><span class="circle"></span><span class="check"></span> FLOOD                   
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-B-{{$crop}}">
                                                                <input id="variance-B-{{$crop}}" type="radio" name="variancecode-B[{{$crop}}]" value="B" class="variancecode" slug="B-{{$crop}}" ><span class="circle"></span><span class="check"></span> FIRE                   
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-U-{{$crop}}">
                                                                <input id="variance-U-{{$crop}}" type="radio" name="variancecode-U[{{$crop}}]" value="U" class="variancecode" slug="U-{{$crop}}" ><span class="circle"></span><span class="check"></span> UNKNOWN
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-O-{{$crop}}">
                                                                <input id="variance-O-{{$crop}}" type="radio" name="variancecode-O[{{$crop}}]" value="O" class="variancecode" slug="O-{{$crop}}" ><span class="circle"></span><span class="check"></span> OTHER
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-T-{{$crop}}">
                                                                <input id="variance-T-{{$crop}}" type="radio" name="variancecode-T[{{$crop}}]" value="T" class="variancecode" slug="T-{{$crop}}" ><span class="circle"></span><span class="check"></span> DROUGHT
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-R-{{$crop}}">
                                                                <input id="variance-R-{{$crop}}" type="radio" name="variancecode-R[{{$crop}}]" value="R" class="variancecode" slug="R-{{$crop}}" ><span class="circle"></span><span class="check"></span> REPLANTING
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 engage-level" style="display: block;" >
                                                        <div class="radio">
                                                            <label class="" for="variance-NP-{{$crop}}">
                                                                <input id="variance-NP-{{$crop}}" type="radio" name="variancecode-NP[{{$crop}}]" value="NP" class="variancecode" slug="NP-{{$crop}}" ><span class="circle"></span><span class="check"></span> NEW PLANTING
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row" >
                                                <div class="col-md-2" style="padding-top: 20px">
                                                    <div class="input-group">
                                                       
                                                        <div id="grp-appdate" class="form-group{{ $errors->has('appdate') ? ' has-error' : '' }} label-floating">
                                                            <label class="control-label">Planting Date <span class="red">*</span></label>
                                                            <input id="appdate" name="appdate[{{$crop}}]" type="text" class="form-control datepicker" autocomplete="off" value="{{Carbon\Carbon::today()->toDateString()}}">

                                                            <span class="help-block">
                                                                <strong id="">Please enter the date of registration.</strong><br>
                                                                <!-- <strong id="err-appdate">{{ $errors->first('appdate') }}</strong> -->
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-top: 20px">
                                                    <div class="input-group">
                                                       
                                                        <div id="grp-appdate" class="form-group{{ $errors->has('appdate') ? ' has-error' : '' }} label-floating">
                                                            <label class="control-label">Anticipated Harvest Date<span class="red">*</span></label>
                                                            <input id="appdate" name="ant_harvest_date[{{$crop}}]" type="text" class="form-control datepicker" autocomplete="off" value="{{Carbon\Carbon::today()->toDateString()}}">

                                                            <span class="help-block">
                                                                <strong id="">Please enter the date of registration.</strong><br>
                                                                <!-- <strong id="err-appdate">{{ $errors->first('appdate') }}</strong> -->
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-top: 20px">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Antcipated Week <span class="red">*</span></label>
                                                        <input id="parcel_area_1" name="ant_harvest_week[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-top: 20px">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Anticipated Harvest Time <span class="red">*</span></label>
                                                        <input id="parcel_area_1" name="ant_harvest_time[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row" >
                                                <div class="col-md-2" >
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Avg Yield/Plant(kg) <span class="red">*</span></label>
                                                        <input id="parcel_area_1" name="avg_yield[{{$crop}}]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" >
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Anticipated Volume at Harvest(kg) <span class="red">*</span></label>
                                                        <input id="parcel_area_1" name="ant_vol[1]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="0">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div id="grp-parcel_area_1" class="form-group{{ $errors->has('parcel_area.'.'1') ? ' has-error' : '' }} label-floating">
                                                        <label class="control-label">Deviation(Yields) <span class="red">*</span></label>
                                                        <input id="parcel_area_1" name="deviation[1]"  type="number" step="any" class="form-control parcel_area" parcel="1" value="{{old('parcel_area.'.'1')}}" min="-9999">

                                                        <span class="help-block">
                                                            <strong id="err-parcel_area_1">{{ $errors->first('parcel_area.'.'1') }}</strong>
                                                        </span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <br>
                            @endfor
        </div>
    </div>