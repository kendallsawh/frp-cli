<div class="tab-pane" id="parcels">
    <div class="col-sm-12">
        <input type="hidden" id="parcel_num" name="parcel_num" value="{{old('parcel_num')? old('parcel_num') : '1'}}">
        <input type="hidden" id="parcels-added" name="parcels_added" value="{{old('parcels_added')? old('parcels_added') : '1'}}">
        <input type="hidden" id="parcels-removed" name="parcels_removed" value="{{old('parcels_removed')? old('parcels_removed') : ''}}">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="info-text">
                    Information on Parcels Farmed/ Utilized
                    <button type="button" class="btn btn-success btn-round btn-fab btn-fab-mini" title="Add another parcel"  rel="tooltip" id="btn-add-parcel">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <div class="ripple-container"></div>
                    </button>
                </h4>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12 round-border-20">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </span>
                    <div id="grp-app_type" class="form-group{{ $errors->has('app_type') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Application Type <span class="red">*</span></label>
                        <select id="app_type" name="app_type" class="form-control dropdown app_type">
                            <option disabled="" selected=""></option>
                            @foreach($application_types as $type)
                            <option value="{{$type->id}}" {{old('app_type')==$type->id ? 'selected' : '' }}>{{$type->application_type}}</option>
                            @endforeach
                        </select>
                         
                         <i class="fa fa-question-circle-o fa-lg" aria-hidden="true" data-toggle="modal" data-target = "#applistModal"></i>

                         

                        <span class="help-block">
                            <strong id="err-app_type">{{ $errors->first('app_type') }}</strong>
                        </span>
                    </div>
                </div>

            </div>
            <div class="col-md-12 round-border-20">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                    </span>
                    <div id="grp-appdate" class="form-group{{ $errors->has('appdate') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Application Date <span class="red">*</span></label>
                        <input id="appdate" name="appdate" type="text" class="form-control datepicker" autocomplete="off" value="{{Carbon\Carbon::today()->toDateString()}}">

                        <span class="help-block">
                            <strong id="">Please enter the date of registration.</strong><br>
                            <!-- <strong id="err-appdate">{{ $errors->first('appdate') }}</strong> -->
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- parcel button row -->
        <div class="row text-center{{old('parcels_added')==1? '' : ' hide'}}" id="row-parcel-btns">
            <div class="col-sm-12 round-border-20" id="parcel-btns">
                @for($x=1; $x<=$parcel_count; $x++)
                <button type="button" class="btn btn-{{$x==1? 'success' : 'default'}} {{in_array($x, explode(',', old('parcels_added'))) || $x==1? '' : 'hide'}} btn-round parcel-view" target="parcel-pane-{{$x}}" id="btn-add-parcel-{{$x}}">Parcel {{$x}}<div class="ripple-container"></div></button>
                @endfor
            </div>
        </div>
        <div id="parcel-panes">
            @for($x=1; $x<=$parcel_count; $x++)
            <div class="parcel-pane {{$x==1? '' : 'hide'}}" id="parcel-pane-{{$x}}">
                <div class="row">
                    <div class="col-sm-12 round-border-20">

                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="info-text">
                                    Parcel Address <i><small>(Parcel {{$x}})</small></i> 
                                    @if($x !== 1)
                                    <button type="button" class="btn btn-danger btn-round btn-fab btn-fab-mini btn-del-parcel" title="Remove parcel"  rel="tooltip" pane="{{$x}}">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                        <div class="ripple-container"></div>
                                    </button>
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-5">
                                <div id="grp-parcel_lot_type_{{$x}}" class="form-group{{ $errors->has('parcel_lot_type.'.$x) ? ' has-error' : '' }} label-static">
                                    <label class="control-label">Lot Type <span class="red">*</span></label>
                                    <select id="parcel_lot_type_{{$x}}" name="parcel_lot_type[{{$x}}]" class="form-control dropdown parcel_lot_type" parcel="{{$x}}">
                                        <option disabled="" selected=""></option>
                                        @foreach($lot_types as $lot_type)
                                        <option value="{{$lot_type->id}}" {{old('parcel_lot_type.'.$x)==$lot_type->id ? 'selected' : '' }}>{{$lot_type->lot_type}}</option>
                                        @endforeach
                                    </select>

                                    <span class="help-block">
                                        <strong id="err-parcel_lot_type_{{$x}}">
                                            {{ $errors->first('parcel_lot_type.'.$x) }}
                                        </strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div id="grp-parcel_street_number_{{$x}}" class="form-group{{ $errors->has('parcel_street_number.'.$x) ? ' has-error' : '' }} label-static">
                                    <label class="control-label">Street Number <span class="red">*</span></label>
                                    <input id="parcel_street_number_{{$x}}" name="parcel_street_number[{{$x}}]" type="text" class="form-control parcel_street_number" parcel="{{$x}}" value="{{old('parcel_street_number.'.$x)}}" style="text-transform:uppercase">

                                    <span class="help-block">
                                        <strong id="err-parcel_street_number_{{$x}}">{{ $errors->first('parcel_street_number.'.$x) }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="grp-parcel_road_trace_{{$x}}" class="form-group{{ $errors->has('parcel_road_trace.'.$x) ? ' has-error' : '' }} label-static">
                                    <label class="control-label">Road/Street/Trace Name <span class="red">*</span></label>
                                    <input id="parcel_road_trace_{{$x}}" name="parcel_road_trace[{{$x}}]" type="text" class="form-control parcel_road_trace" parcel="{{$x}}" value="{{old('parcel_road_trace.'.$x)}}" style="text-transform:uppercase">

                                    <span class="help-block">
                                        <strong id="err-parcel_road_trace_{{$x}}">{{ $errors->first('parcel_road_trace.'.$x) }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="grp-parcel_town_village_{{$x}}" class="form-group{{ $errors->has('parcel_town_village.'.$x) ? ' has-error' : '' }} label-static">
                                    <label class="control-label">Town/Village/Settlement <span class="red">*</span></label>
                                    <select id="parcel_town_village_{{$x}}" name="parcel_town_village[{{$x}}]" class="form-control dropdown parcel_town_village" parcel="{{$x}}">
                                        <option disabled="" selected=""></option>
                                        @foreach($districts as $district)
                                        <option value="{{$district->id}}" {{old('parcel_town_village.'.$x)==$district->id ? 'selected' : '' }}>{{$district->district}}</option>
                                        @endforeach
                                    </select>

                                    <span class="help-block">
                                        <strong id="err-parcel_town_village_{{$x}}">{{ $errors->first('parcel_town_village.'.$x) }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 round-border-20">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="info-text">Lands Details</h4>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div id="grp-parcel_area_type_{{$x}}" class="form-group{{ $errors->has('parcel_area_type.'.$x) ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Area Unit <span class="red">*</span></label>
                                    <select id="parcel_area_type_{{$x}}" name="parcel_area_type[{{$x}}]" class="form-control dropdown parcel_area_type" parcel="{{$x}}">
                                        <option disabled="" selected=""></option>
                                        @foreach($area_types as $area_type)
                                        <option value="{{$area_type->id}}" {{old('parcel_area_type.'.$x)==$area_type->id ? 'selected' : '' }}>{{$area_type->area_type}}</option>
                                        @endforeach
                                    </select>

                                    <span class="help-block">
                                        <strong id="err-parcel_area_type_{{$x}}">{{ $errors->first('parcel_area_type.'.$x) }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div id="grp-parcel_area_{{$x}}" class="form-group{{ $errors->has('parcel_area.'.$x) ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Area <span class="red">*</span></label>
                                    <input id="parcel_area_{{$x}}" name="parcel_area[{{$x}}]"  type="number" step="any" class="form-control parcel_area" parcel="{{$x}}" value="{{old('parcel_area.'.$x)}}" min="0">

                                    <span class="help-block">
                                        <strong id="err-parcel_area_{{$x}}">{{ $errors->first('parcel_area.'.$x) }}</strong>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div id="grp-land_type_{{$x}}" class="form-group{{ $errors->has('land_type.'.$x) ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Land Type <span class="red">*</span></label>
                                    <select id="land_type_{{$x}}" name="land_type[{{$x}}]" class="form-control dropdown land_type" parcel="{{$x}}">
                                        <option disabled="" selected=""></option>
                                        @foreach($land_types as $land_type)
                                        <option value="{{$land_type->id}}" {{old('land_type.'.$x)==$land_type->id ? 'selected' : '' }}>{{$land_type->land_type}}</option>
                                        @endforeach
                                    </select>

                                    <span class="help-block">
                                        <strong id="err-land_type_{{$x}}">{{ $errors->first('land_type.'.$x) }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div id="grp-tenure_{{$x}}" class="form-group{{ $errors->has('tenure.'.$x) ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Tenure Code <span class="red">*</span></label>
                                    <select id="tenure_{{$x}}" name="tenure[{{$x}}]" class="form-control dropdown tenure" parcel="{{$x}}">
                                        <option disabled="" selected=""></option>
                                        @foreach($tenure_codes as $tenure)
                                        <option value="{{$tenure->id}}" {{old('tenure.'.$x)==$tenure->id ? 'selected' : '' }}>{{$tenure->tenure_code}} {{$tenure->tenure}}</option>
                                        @endforeach
                                    </select>

                                    <span class="help-block">
                                        <strong id="err-tenure_{{$x}}">{{ $errors->first('tenure.'.$x) }}</strong>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-12 round-border-20">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="info-text">
                                    Proof of Interest in Lands Utilized<br>
                                    <small>
                                        <span class="text-danger text-center">
                                            <strong id="err-proof_codes_{{$x}}">{{ $errors->first('proof_codes.'.$x) }}</strong>
                                        </span>
                                    </small>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group line-height-40">
                                @foreach($proof_codes as $code)
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 proofs proofs_{{$x}}" id="proofs_{{$x}}_{{$code->id}}">
                                    <div class="checkbox">
                                        <label for="proof_codes_{{$x}}_{{$code->id}}">
                                            <input id="proof_codes_{{$x}}_{{$code->id}}" name="proof_codes[{{$x}}][{{$code->id}}]" type="checkbox" parcel="{{$x}}" code="{{$code->id}}" class="proof_codes proof_codes_{{$x}}" {{old('proof_codes.'.$x.'.'.$code->id)? 'checked' : '' }}>
                                            {{$code->id}}. {{$code->proof}} 
                                            <span id="proof_star_{{$x}}_{{$code->id}}" class="proof_star proof_star_{{$x}} red hide" style="font-size: larger;">**</span>
                                            <span id="proof_opt_{{$x}}_{{$code->id}}" class="proof_option proof_option_{{$x}} hide" style="font-size: larger;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                                        </label>
                                    </div>

                                    <input id="proof_codes_file_{{$x}}_{{$code->id}}" class="proof_docs proof_docs_{{$x}}" name="proof_codes_file[{{$x}}][{{$code->id}}][]" type="file" multiple style="opacity: inherit;position: relative;">

                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div> 
                </div>
                <div class="row">
                    <div class="col-sm-12 round-border-20" id="div-crops-{{$x}}">
                        <input type="hidden" id="crops-added-{{$x}}" name="crops_added[{{$x}}]" value="{{old('crops_added.'.$x)? old('crops_added.'.$x) : '1'}}">

                        @if(old('crops_added.'.$x) == null)

                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="info-text">
                                    Type of Crops/Animals 
                                    <button type="button" class="btn btn-success btn-round btn-fab btn-fab-mini btn-add-crop" title="Add another crop/animal"  rel="tooltip" pane="{{$x}}" nextcrop="2">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </h4>
                            </div>
                        </div>

                        <div class="row vertical-divider">
                            <div class="col-sm-3">
                                <div id="grp-parcel_type_{{$x}}_1" class="form-group{{ $errors->has('parcel_type.'.$x.'.1') ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Type of Crop/Animal <span class="red">*</span></label>
                                    <select id="parcel_type_{{$x}}_1" name="parcel_type[{{$x}}][1]" class="form-control dropdown parcel_type" parcel="{{$x}}" crop="1">
                                        <option disabled="" selected=""></option>
                                        @foreach($parcel_types as $parcel_type)
                                        <option value="{{$parcel_type->id}}" unit="{{$parcel_type->unit->parcel_unit}}" {{old('parcel_type.'.$x.'.1')==$parcel_type->id ? 'selected' : '' }}>{{$parcel_type->parcel_type}}</option>
                                        @endforeach
                                    </select>

                                    <span class="help-block">
                                        <strong id="err-parcel_type_{{$x}}_1">{{ $errors->first('parcel_type.'.$x.'.1') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group{{ $errors->has('animal_crop.'.$x.'.1') ? ' has-error' : '' }} label-floating" id="grp-animal_crop_{{$x}}_1">
                                    <label class="control-label">Specific Crop/Animal <span class="red">*</span></label>
                                    <!-- <input id="animal_crop_{{$x}}_1" name="animal_crop[{{$x}}][1]" type="text" class="form-control animal_crop" parcel="{{$x}}" value="{{old('animal_crop.'.$x.'.1')}}" style="text-transform:uppercase"> -->
                                    <select id="animal_crop_{{$x}}_1" name="animal_crop[{{$x}}][1]" class="form-control dropdown animal_crop" parcel="{{$x}}" crop="1">
                                        <option disabled="" selected=""></option>
                                        @foreach($animal_crops as $key=>$animal_crop)
                                        <option value="{{$animal_crop->id}}" {{old('animal_crop.'.$x.'.1')==++$key ? 'selected' : '' }}>{{$animal_crop->CommodityLocalName}}({{$animal_crop->Variety}})</option>
                                        @endforeach
                                    </select>

                                    <span class="help-block">
                                        <strong id="err-animal_crop_{{$x}}_1">{{ $errors->first('animal_crop.'.$x.'.1') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group{{ $errors->has('parcel_amt.'.$x.'.1') ? ' has-error' : '' }} label-floating" id="grp-parcel_amt_{{$x}}_1">
                                    <label class="control-label">Amount <span class="red">*</span></label>
                                    <div class="input-group">
                                        <input id="parcel_amt_{{$x}}_1" name="parcel_amt[{{$x}}][1]" type="number" step="any" class="form-control parcel_amt" parcel="{{$x}}" value="{{old('parcel_amt.'.$x.'.1')}}" min="0">
                                        <span class="input-group-addon unit-addon" id="parcel_unit_{{$x}}_1">
                                            {{old('parcel_type.'.$x.'.1')? App\ParcelType::find(old('parcel_type.'.$x.'.1'))->unit->parcel_unit: ''}}
                                        </span>
                                    </div>

                                    <span class="help-block">
                                        <strong id="err-parcel_amt_{{$x}}_1">{{ $errors->first('parcel_amt.'.$x.'.1') }}</strong>
                                    </span>
                                </div>
                                <!-- fix here to only show if not crops -->
                                
                            </div>
                        </div>

                        @else
                        @foreach(explode(',', old('crops_added.'.$x)) as $n => $crop)

                        <div id="pane-{{$x}}-parcel-{{$crop}}">
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="info-text">
                                        Type of Crops/Animals 
                                        <button type="button" class="btn btn-success btn-round btn-fab btn-fab-mini btn-add-crop" title="Add another crop/animal"  rel="tooltip" pane="{{$x}}">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            <div class="ripple-container"></div>
                                        </button>
                                        @if($n != 0)
                                        <button type="button" class="btn btn-danger btn-round btn-fab btn-fab-mini btn-del-crop" title="Remove this crop/animal" rel="tooltip" target="pane-{{$x}}-parcel-{{$crop}}" pane="{{$x}}" crop="{{$crop}}"> <i class="fa fa-minus" aria-hidden="true"></i> <div class="ripple-container"></div> </button>
                                        @endif
                                    </h4>
                                </div>
                            </div>

                            <div class="row vertical-divider">
                                <div class="col-sm-3">
                                    <div id="grp-parcel_type_{{$x}}_{{$crop}}" class="form-group{{ $errors->has('parcel_type.'.$x.'.'.$crop) ? ' has-error' : '' }} label-floating">
                                        <label class="control-label">Type of Crop/Animal <span class="red">*</span></label>
                                        <select id="parcel_type_{{$x}}_{{$crop}}" name="parcel_type[{{$x}}][{{$crop}}]" class="form-control dropdown parcel_type" parcel="{{$x}}" crop="{{$crop}}">
                                            <option disabled="" selected=""></option>
                                            @foreach($parcel_types as $parcel_type)
                                            <option value="{{$parcel_type->id}}" unit="{{$parcel_type->unit->parcel_unit}}" {{old('parcel_type.'.$x.'.'.$crop)==$parcel_type->id ? 'selected' : '' }}>{{$parcel_type->parcel_type}}</option>
                                            @endforeach
                                        </select>

                                        <span class="help-block">
                                            <strong id="err-parcel_type_{{$x}}_{{$crop}}">{{ $errors->first('parcel_type.'.$x.'.'.$crop) }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group{{ $errors->has('animal_crop.'.$x.'.'.$crop) ? ' has-error' : '' }} label-floating" id="grp-animal_crop_{{$x}}_{{$crop}}">
                                        <label class="control-label">Specific Crop/Animal <span class="red">*</span></label>
                                        <input id="animal_crop_{{$x}}_{{$crop}}" name="animal_crop[{{$x}}][{{$crop}}]" type="text" class="form-control animal_crop" parcel="{{$x}}" value="{{old('animal_crop.'.$x.'.'.$crop)}}" style="text-transform:uppercase">

                                        <span class="help-block">
                                            <strong id="err-animal_crop_{{$x}}_{{$crop}}">{{ $errors->first('animal_crop.'.$x.'.'.$crop) }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group{{ $errors->has('parcel_amt.'.$x.'.'.$crop) ? ' has-error' : '' }} label-floating" id="grp-parcel_amt_{{$x}}_{{$crop}}">
                                        <label class="control-label">Amount <span class="red">*</span></label>
                                        <div class="input-group">
                                            <input id="parcel_amt_{{$x}}_{{$crop}}" name="parcel_amt[{{$x}}][{{$crop}}]" type="number" step="any" class="form-control parcel_amt" parcel="{{$x}}" value="{{old('parcel_amt.'.$x.'.'.$crop)}}" min="0">
                                            <span class="input-group-addon unit-addon" id="parcel_unit_{{$x}}_{{$crop}}">
                                                {{old('parcel_type.'.$x.'.'.$crop)? App\ParcelType::find(old('parcel_type.'.$x.'.'.$crop))->unit->parcel_unit : ''}}
                                            </span>
                                        </div>

                                        <span class="help-block">
                                            <strong id="err-parcel_amt_{{$x}}_{{$crop}}">{{ $errors->first('parcel_amt.'.$x.'.'.$crop) }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                    </div>
                </div>
                <div class="row round-border-20">
                    <h4 class="info-text">DFO Recommendations(Backlog applications)</h4>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">                    
                        <div id="grp-comment_{{$x}}" class="form-group{{ $errors->has('comments.'.$x) ? ' has-error' : '' }}">
                            <label class="control-label">Comments/Recommendation<span class="red">*</span></label>
                            <textarea class="form-control comments" name="comments[{{$x}}]" id="comments_{{$x}}" parcel="{{$x}}" rows="2" style="text-transform:uppercase">{{old('comments.'.$x)}}</textarea>
                            <span class="help-block">
                                <strong id="">Tip: Press Enter to go to a new line</strong><br>
                            </span>
                            <span class="help-block text-danger">
                                <strong id="err-comments_{{$x}}">{{ $errors->first('comments.'.$x) }}</strong>
                            </span>
                        </div>
                        
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        
                        
                        <div id="grp-dateofverification_{{$x}}" class="form-group{{ $errors->has('dateofverification.'.$x) ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Date of inspection </label>
                            <input id="dateofverification_{{$x}}" name="dateofverification[{{$x}}]" parcel="{{$x}}" type="text" class="form-control datepicker" autocomplete="off" value="1900-01-01">

                            <span class="help-block">
                                <strong id="">Date should be at least 3 years prior to application date on the application form</strong><br>
                                <strong id="err-dateofverification_{{$x}}">{{ $errors->first('dateofverification.'.$x) }}</strong>
                            </span>
                        </div>
                        
                    </div>
                </div>
            </div>

            @endfor
        </div>
        
    </div>
</div>