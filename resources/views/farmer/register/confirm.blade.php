<div class="card " id="confirm-card" style="padding: 30px; display: none;">
    <div class="tab-content">
        <div class="row">
            <h2>
                Please confirm that the application data is correct.
                <a href="#wizard-navigation" type='button' class='btn btn-danger pull-right' id="edit">Edit</a>
            </h2>
        </div>
        <form class="form-horizontal">
            <!-- <h4>Application Type</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Job:</label>
                <div class="col-lg-10" id="conf-job">{{$type['type']}}</div>
            </div> -->

            <h4>Registration Type</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Registration Type:</label>
                <div class="col-lg-10" id="conf-regtype">{{old('regtype')}}</div>
            </div>

            <h4>Personal Information</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Avatar:</label>
                <img id="conf-avatar" src="{{asset('/img/default-avatar.png')}}" alt="Avatar" class="img-thumbnail avatar">
            </div>

            <div class="form-group">
                <label for="" class="col-lg-2 control-label">First Name:</label>
                <div class="col-lg-10" id="conf-firstname">{{old('firstname')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Middle Name:</label>
                <div class="col-lg-10" id="conf-middlename">{{old('middlename')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Last Name:</label>
                <div class="col-lg-10" id="conf-lastname">{{old('lastname')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Alias:</label>
                <div class="col-lg-10" id="conf-alias">{{old('alias')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Date of Birth:</label>
                <div class="col-lg-10" id="conf-dateofbirth">{{old('dateofbirth')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Gender:</label>
                <div class="col-lg-10" id="conf-gender">
                    {{old('gender')? App\Gender::where('slug',old('gender'))->first()->gender : ''}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Email:</label>
                <div class="col-lg-10" id="conf-email">{{old('email')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Home Contact:</label>
                <div class="col-lg-10" id="conf-homenumber">{{old('homenumber')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Mobile Contact:</label>
                <div class="col-lg-10" id="conf-mobilenumber">{{old('mobilenumber')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">National ID:</label>
                <div class="col-lg-10" id="conf-n_id">{{old('n_id')}}</div>
            </div>
            <div class="form-group hide">
                <label for="" class="col-lg-2 control-label">Driver's Permit Number:</label>
                <div class="col-lg-10" id="conf-dp">{{old('dp')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Passport Number:</label>
                <div class="col-lg-10" id="conf-passport">{{old('passport')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Emergency Contact:</label>
                <div class="col-lg-10" id="conf-emergencynumber">{{old('emergencynumber')}}</div>
            </div>

            <h4>Home Address</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Lot Type:</label>
                <div class="col-lg-10" id="conf-hometype">
                    {{old('hometype')? App\AddressLotType::find(old('hometype'))->lot_type : ''}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Street Number:</label>
                <div class="col-lg-10" id="conf-street_number">{{old('street_number')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Road/Street/Trace Name:</label>
                <div class="col-lg-10" id="conf-road_trace">{{old('road_trace')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Town/Village/Settlement:</label>
                <div class="col-lg-10" id="conf-town_village">
                    {{old('town_village')? App\Districts::find(old('town_village'))->district : ''}}
                </div>
            </div>

            <h4>Postal/Mailing Address</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Same?:</label>
                <div class="col-lg-10" id="conf-postal_checkbox">{{old('postal_checkbox')}}</div>
            </div>
            <div id="conf-postaladdress">
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Lot Type:</label>
                    <div class="col-lg-10" id="conf-postaltype">
                        {{old('postaltype')? App\AddressLotType::find(old('postaltype'))->lot_type : ''}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Street Number:</label>
                    <div class="col-lg-10" id="conf-street_number2">{{old('street_number2')}}</div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Road/Street/Trace Name:</label>
                    <div class="col-lg-10" id="conf-road_trace2">{{old('road_trace2')}}</div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Town/Village/Settlement:</label>
                    <div class="col-lg-10" id="conf-town_village2">
                        {{old('town_village2')? App\Districts::find(old('town_village2'))->district : ''}}
                    </div>
                </div>
            </div>

            <h4>Enterprise</h4>
            <div class="form-group">
                <label for="enterprise" class="col-lg-2 control-label">Enterprises:</label>
                <div class="col-lg-10" id="conf-enterprise"></div>
            </div>

            <h4>Parcels</h4>
            @for($x=1; $x<=$parcel_count; $x++)
            <div id="conf-parcel-div-{{$x}}" class="{{in_array($x, explode(',', old('parcels_added'))) || $x==1? '' : 'hide'}}">
                <h5><small>Parcel {{$x}}</small></h5>
                <h6><small>Parcel Address</small></h6>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Lot Type:</label>
                    <div class="col-lg-10" id="conf-parcel_lot_type_{{$x}}">
                        {{old('parcel_lot_type.'.$x)? App\AddressLotType::find(old('parcel_lot_type.'.$x))->lot_type : ''}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Street Number:</label>
                    <div class="col-lg-10" id="conf-parcel_street_number_{{$x}}">{{old('parcel_street_number.'.$x)}}</div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Road/Street/Trace Name:</label>
                    <div class="col-lg-10" id="conf-parcel_road_trace_{{$x}}">{{old('parcel_road_trace.'.$x)}}</div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Town/Village/Settlement:</label>
                    <div class="col-lg-10" id="conf-parcel_town_village_{{$x}}">
                        {{old('parcel_town_village.'.$x)? App\Districts::find(old('parcel_town_village.'.$x))->district : ''}}
                    </div>
                </div>

                <h6><small>Lands Details</small></h6>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Area</label>
                    <div class="col-lg-10">
                        <span id="conf-parcel_area_{{$x}}">{{old('parcel_area.'.$x)}}</span> 
                        <span id="conf-parcel_area_type_{{$x}}">
                            {{old('parcel_area_type.'.$x)? App\AreaType::find(old('parcel_area_type.'.$x))->area_type : ''}}
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Land Type</label>
                    <div class="col-lg-10" id="conf-land_type_{{$x}}">
                        {{old('land_type.'.$x)? App\LandType::find(old('land_type.'.$x))->land_type : ''}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Tenure</label>
                    <div class="col-lg-10" id="conf-tenure_{{$x}}">
                        {{old('tenure.'.$x)? App\TenureCode::find(old('tenure.'.$x))->tenure_code.' '.App\TenureCode::find(old('tenure.'.$x))->tenure : ''}}
                    </div>
                </div>

                <h6><small>Proof of Interest in Lands Utilized</small></h6>
                <div class="form-group">
                    <label for="enterprise" class="col-lg-2 control-label">Documents:</label>
                    <div class="col-lg-10" id="conf-proof_codes_{{$x}}">
                        @if(old('proof_codes.'.$x))
                        @foreach(old('proof_codes.'.$x) as $c_proof => $on)
                        <div id="conf-proof-{{$c_proof}}">
                            {{App\ProofOfInterestCode::find($c_proof)->proof_code}}. {{App\ProofOfInterestCode::find($c_proof)->proof}}
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <h6><small>Type of Crops/Animals</small></h6>
                @if(old('crops_added.'.$x) == null)
                <div id="div-crops-conf-{{$x}}">
                    <!-- use old('crops_added.'.$x) for old crops -->
                    
                    <h5><small>Crop</small></h5>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Type of Crop/Animal</label>
                        <div class="col-lg-10" id="conf-parcel_type_{{$x}}_1"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Specific Crop/Animal</label>
                        <div class="col-lg-10" id="conf-animal_crop_{{$x}}_1"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Amount</label>
                        <div class="col-lg-10"><span id="conf-parcel_amt_{{$x}}_1"></span> <span id="conf-parcel_unit_{{$x}}_1"></span></div>
                    </div>
                </div>
                @else
                    <div id="div-crops-conf-{{$x}}">
                    @foreach(explode(',', old('crops_added.'.$x)) as $crop)
                        <!-- use old('crops_added.'.$x) for old crops -->
                        
                        <h5><small>Crop</small></h5>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Type of Crop/Animal</label>
                            <div class="col-lg-10" id="conf-parcel_type_{{$x}}_{{$crop}}">{{old('parcel_type.'.$x.'.'.$crop)? App\ParcelType::find(old('parcel_type.'.$x.'.'.$crop))->parcel_type : ''}}</div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Specific Crop/Animal</label>
                            <div class="col-lg-10" id="conf-animal_crop_{{$x}}_{{$crop}}">{{old('animal_crop.'.$x.'.'.$crop)}}</div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Amount</label>
                            <div class="col-lg-10"><span id="conf-parcel_amt_{{$x}}_{{$crop}}">{{old('parcel_amt.'.$x.'.'.$crop)}}</span> <span id="conf-parcel_unit_{{$x}}_{{$crop}}">{{old('parcel_type.'.$x.'.'.$crop)? App\ParcelType::find(old('parcel_type.'.$x.'.'.$crop))->unit->parcel_unit : ''}}</span></div>
                        </div>
                    @endforeach
                    </div>
                @endif
            </div>
            @endfor

            <h4>Appointment Details</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Slected appointment date:</label>
                <div class="col-lg-10" id="conf-appointment">{{old('appointment')}}</div>

                <label for="" class="col-lg-2 control-label">Additional details:</label>
                <div class="col-lg-10" id="conf-appointment-comment">{{old('comment')}}</div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" id="submit" class="btn btn-success pull-right loading-modal submit" form="farmerRegForm">Submit</button>
                <a href="#wizard-navigation" type='button' class='btn btn-danger pull-right' id="edit">Edit</a>
            </div>
        </div>
    </div>
</div>