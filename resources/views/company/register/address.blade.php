    <div class="tab-pane" id="address" target="reps">
        <div class="row">
            <h5 class="info-text">Business Address</h5>
        </div>
        <div class="">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div id="grp-hometype" class="form-group{{ $errors->has('hometype') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Lot Type <span class="red">*</span></label>
                            <select id="hometype" name="hometype" class="form-control dropdown">
                                <option disabled="" selected=""></option>
                                @foreach($lot_types as $lot_type)
                                <option value="{{$lot_type->id}}" {{old('hometype')==$lot_type->id ? 'selected' : '' }}>{{$lot_type->lot_type}}</option>
                                @endforeach
                            </select>

                            <span class="help-block">
                                <strong id="err-hometype">{{ $errors->first('hometype') }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="grp-street_number" class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Street Number <span class="red">*</span></label>
                            <input id="street_number" name="street_number" type="text" class="form-control" value="{{old('street_number')}}" style="text-transform:uppercase">

                            <span class="help-block">
                                <strong id="err-street_number">{{ $errors->first('street_number') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="grp-road_trace" class="form-group{{ $errors->has('road_trace') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Road/Street/Trace Name <span class="red">*</span></label>
                            <input id="road_trace" name="road_trace" type="text" class="form-control" value="{{old('road_trace')}}" style="text-transform:uppercase">

                            <span class="help-block">
                                <strong id="err-road_trace">{{ $errors->first('road_trace') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="grp-town_village" class="form-group{{ $errors->has('town_village') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Town/Village/Settlement <span class="red">*</span></label>
                            <select id="town_village" name="town_village" class="form-control dropdown">
                                <option disabled="" selected=""></option>
                                @foreach($districts as $district)
                                <option value="{{$district->id}}" {{old('town_village')==$district->id ? 'selected' : '' }}>{{$district->district}}</option>
                                @endforeach
                            </select>

                            <span class="help-block">
                                <strong id="err-town_village">{{ $errors->first('town_village') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>