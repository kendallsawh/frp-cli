<div class="tab-pane" id="address" target="enterprise">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="info-text">Home Address </h4>
            </div>
        </div>
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
                    <input id="street_number" name="street_number" type="text" class="form-control" value="{{old('street_number')}}">

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
                    <input id="road_trace" name="road_trace" type="text" class="form-control" value="{{old('road_trace')}}">

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
        <div class="row">
            <div class="col-sm-12">
                <h4 class="info-text">Postal/Mailing Address </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="checkbox">
                    <label>
                        <input id="postal_checkbox" type="checkbox" name="postal_checkbox" {{old('postal_checkbox')=='on' ? 'checked' : '' }}>
                        Same as above?
                    </label>
                </div>
            </div>
        </div>

        <div id="postal-address-div" style="{{old('postal_checkbox')=='on' ? 'display:none' : '' }}">
            <div class="row">
                <div class="col-sm-6">
                    <div id="grp-postaltype" class="form-group{{ $errors->has('postaltype') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Lot Type <span class="red">*</span></label>
                        <select id="postaltype" name="postaltype" class="form-control dropdown">
                            <option disabled="" selected=""></option>
                            @foreach($lot_types as $lot_type)
                            <option value="{{$lot_type->id}}" {{old('postaltype')==$lot_type->id ? 'selected' : '' }}>{{$lot_type->lot_type}}</option>
                            @endforeach
                        </select>

                        <span class="help-block">
                            <strong id="err-postaltype">{{ $errors->first('postaltype') }}</strong>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="grp-street_number2" class="form-group{{ $errors->has('street_number2') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Street Number <span class="red">*</span></label>
                        <input id="street_number2" name="street_number2" type="text" class="form-control" value="{{old('street_number2')}}">

                        <span class="help-block">
                            <strong id="err-street_number2">{{ $errors->first('street_number2') }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="grp-road_trace2" class="form-group{{ $errors->has('road_trace2') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Road/Street/Trace Name <span class="red">*</span></label>
                        <input id="road_trace2" name="road_trace2" type="text" class="form-control" value="{{old('road_trace2')}}">

                        <span class="help-block">
                            <strong id="err-road_trace2">{{ $errors->first('road_trace2') }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="grp-town_village2" class="form-group{{ $errors->has('town_village2') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Town/Village/Settlement <span class="red">*</span></label>
                        <select id="town_village2" name="town_village2" class="form-control dropdown">
                            <option disabled="" selected=""></option>
                            @foreach($districts as $district)
                            <option value="{{$district->id}}" {{old('town_village2')==$district->id ? 'selected' : '' }}>{{$district->district}}</option>
                            @endforeach
                        </select>

                        <span class="help-block">
                            <strong id="err-town_village2">{{ $errors->first('town_village2') }}</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>