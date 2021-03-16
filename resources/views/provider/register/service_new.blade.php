<div class="tab-pane" id="service">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="info-text">
                    Information on Service Provided
                </h4>
            </div>
        </div>
        <div id="service-pane">
            <div class="row">
                <div class="col-sm-12 round-border-20">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="info-text">Tractor Details</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div id="grp-reg_number" class="form-group{{ $errors->has('reg_number') ? ' has-error' : '' }} label-floating">
                                <label class="control-label">Registration Number</label>
                                <input id="reg_number" name="reg_number" type="text" class="form-control" value="{{old('reg_number')}}">

                                <span class="help-block">
                                    <strong id="err-reg_number">{{ $errors->first('reg_number') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div id="grp-chasis_number" class="form-group{{ $errors->has('chasis_number') ? ' has-error' : '' }} label-floating">
                                <label class="control-label">Chasis Number <span class="red">*</span></label>
                                <input id="chasis_number" name="chasis_number" type="text" class="form-control" value="{{old('chasis_number')}}">

                                <span class="help-block">
                                    <strong id="err-chasis_number">{{ $errors->first('chasis_number') }}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div id="grp-cert_copy" class="form-group{{ $errors->has('cert_copy') ? ' has-error' : '' }} label-floating">
                                <label class="control-label">Certified Copy <span class="red">*</span></label>
                                <input id="cert_copy" name="cert_copy" type="file" multiple style="opacity: inherit;position: relative;">
                            </div>

                            <span class="help-block text-danger">
                                <strong id="err-cert_copy">{{ $errors->first('cert_copy') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 round-border-20">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="info-text">
                                Recommendations <i><small>(upload originals)</small></i>

                                <div class="help-block text-danger">
                                    <strong id="err-rec_msg">{{ $errors->first('rec_msg') }}</strong>
                                    @if($errors->has('rec_msg2'))<br><strong>{{ $errors->first('rec_msg2') }}</strong>@endif
                                    @if($errors->has('rec_msg3'))<br><strong>{{ $errors->first('rec_msg3') }}</strong>@endif
                                </div>
                            </h4>
                        </div>
                    </div>
                    <div id="recommend-panes">
                        <div class="row">
                            <input type="hidden" id="rec_count" name="rec_count" value="{{$rec_count}}">
                            @for($i = 1; $i <= $rec_count; $i++)
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12" style="min-height: 225px">
                                <div id="grp-farmer_{{$i}}" class="form-group{{ $errors->has('farmer.'.$i) ? ' has-error' : '' }} line-height-40 label-floating">
                                    <label class="control-label" for"farmer_{{$i}}">Farmer Number {{$i}} <span class="red">*</span></label>
                                    <input class="farmers form-control" id="farmer_{{$i}}" name="farmer[{{$i}}]"   value="{{old('farmer.'.$i)}}" style="text-transform:uppercase">

                                    <span class="help-block">
                                        <strong id="err-farmer_{{$i}}">{{ $errors->first('farmer.'.$i) }}</strong>
                                    </span>
                                </div>
                                <div id="grp-name_{{$i}}" class="form-group{{ $errors->has('name.'.$i) ? ' has-error' : '' }} line-height-40 label-floating">
                                    <label class="control-label" for"name_{{$i}}">Farmer Name <span class="red">*</span></label>
                                    <input class="farmers form-control" id="name_{{$i}}" name="name[{{$i}}]"   value="{{old('name.'.$i)}}" style="text-transform:uppercase">

                                    <span class="help-block">
                                        <strong id="err-name_{{$i}}">{{ $errors->first('name.'.$i) }}</strong>
                                    </span>
                                </div>
                                <div id="grp-date_{{$i}}" class="form-group{{ $errors->has('date.'.$i) ? ' has-error' : '' }} line-height-40 label-floating">
                                    <label class="control-label" for"date_{{$i}}">Date on Leter {{$i}} <span class="red">*</span></label>
                                    <input class="form-control datepicker" id="date_{{$i}}" name="date[{{$i}}]" value="{{old('date.'.$i)}}">

                                    <span class="help-block">
                                        <strong id="err-date_{{$i}}">{{ $errors->first('date.'.$i) }}</strong>
                                    </span>
                                </div>
                                <div id="grp-land_{{$i}}" class="form-group{{ $errors->has('land.'.$i) ? ' has-error' : '' }} line-height-40 label-floating lands_{{$i}}">
                                    <label class="control-label" for"land_{{$i}}">Holding Address {{$i}} <span class="red">*</span></label>
                                    <input class="form-control landselect landselect_{{$i}}" id="land_{{$i}}" name="land[{{$i}}]" num="{{$i}} value="{{old('land.'.$i)}}" style="text-transform:uppercase" >
                                    
                                    <span class="help-block">
                                        <strong id="err-land_{{$i}}">{{ $errors->first('land.'.$i) }}</strong>
                                    </span>
                                </div>
                                <div id="grp-sp-town_village_{{$i}}" class="form-group{{ $errors->has('sp_town_village.'.$i) ? ' has-error' : '' }} label-floating">
                                    <label class="control-label" for="sp_town_village_{{$i}}">Town/Village/Settlement <span class="red">*</span></label>
                                    <select id="sp_town_village_{{$i}}" name="sp_town_village[{{$i}}]" class="form-control dropdown districtselect districtselect_{{$i}}" num="{{$i}}>
                                        <option disabled="" selected=""></option>
                                        @foreach($districts as $district)
                                        <option value="{{$district->id}}" {{old('sp_town_village.'.$i)==$district->id ? 'selected' : '' }}>{{$district->district}}</option>
                                        @endforeach
                                    </select>

                                    <span class="help-block">
                                        <strong id="err-sp_town_village">{{ $errors->first('sp_town_village.'.$i) }}</strong>
                                    </span>
                                </div>
                                
                                <input id="proof_doc_{{$i}}" name="proof_doc[{{$i}}]" type="file" style="opacity: inherit;position: relative;" num="{{$i}}" class="recs">
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>