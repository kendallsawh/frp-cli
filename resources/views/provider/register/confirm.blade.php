<div class="card " id="confirm-card" style="padding: 30px; display: none;">
    <div class="tab-content">
        <div class="row">
            <h2>
                Please confirm that the application data is correct.
                <a href="#wizard-navigation" type='button' class='btn btn-danger pull-right' id="edit">Edit</a>
            </h2>
        </div>
        <form class="form-horizontal">
            <h4>Application Type</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Job:</label>
                <div class="col-lg-10" id="conf-job">{{$type['type']}}</div>
            </div>

            @if($farmertype == 'org')
            <h4>Organization's Information</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Logo:</label>
                <img id="conf-avatar" src="{{asset('/img/blank-img.png')}}" alt="Avatar" class="img-thumbnail avatar">
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Organization Name:</label>
                <div class="col-lg-10" id="conf-org_name">{{old('org_name')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Organization Type:</label>
                <div class="col-lg-10" id="conf-org_type">{{old('org_type')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Registration Number:</label>
                <div class="col-lg-10" id="conf-reg_num">{{old('reg_num')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">V.A.T Registration Number:</label>
                <div class="col-lg-10" id="conf-vat_num">{{old('vat_num')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Email:</label>
                <div class="col-lg-10" id="conf-biz_email">{{old('biz_email')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Telephone Number:</label>
                <div class="col-lg-10" id="conf-biz_phone">{{old('biz_phone')}}</div>
            </div>

            <h4>Organization Address</h4>
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

            <h4>Organization Repressentatives</h4>
            @for($x=1; $x<=2; $x++)
            <h5><small>Rep {{$x}}</small></h5>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Avatar:</label>
                <img id="conf-avatar{{$x}}" src="{{asset('/img/default-avatar.png')}}" alt="Avatar" class="img-thumbnail avatar">
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">First Name:</label>
                <div class="col-lg-10" id="conf-app_fname{{$x}}">
                    {{old('app_fname'.$x)}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Surname:</label>
                <div class="col-lg-10" id="conf-app_sname{{$x}}">
                    {{old('app_sname'.$x)}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Contact:</label>
                <div class="col-lg-10" id="conf-contact{{$x}}">
                    {{old('contact'.$x)}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">ID Type:</label>
                <div class="col-lg-10" id="conf-id_type{{$x}}">
                    {{old('id_type'.$x)}}
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">ID Number:</label>
                <div class="col-lg-10" id="conf-id_num{{$x}}">
                    {{old('id_num'.$x)}}
                </div>
            </div>
            @endfor
            @endif

            @if($farmertype == 'ind')
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
            @endif

            <h4>Tractor Details</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Registration Number:</label>
                <div class="col-lg-10" id="conf-reg_number">{{old('reg_number')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Chasis Number:</label>
                <div class="col-lg-10" id="conf-chasis_number">{{old('chasis_number')}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Certified Copy:</label>
                <div class="col-lg-10" id="conf-cert_copy">No file chosen</div>
            </div>

            <h4>Recommendations</h4>
            @for($i = 1; $i <= $rec_count; $i++)
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Farmer Number {{$i}}:</label>
                <div class="col-lg-10" id="conf-farmer_{{$i}}">{{old('farmer.'.$i)}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Date {{$i}}:</label>
                <div class="col-lg-10" id="conf-date_{{$i}}">{{old('date.'.$i)}}</div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Land {{$i}}:</label>
                <div class="col-lg-10" id="conf-land_{{$i}}"></div>
            </div>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Document {{$i}}:</label>
                <div class="col-lg-10" id="conf-proof_doc_{{$i}}">No file chosen</div>
            </div>
            @endfor

        </form>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" id="submit" class="btn btn-success pull-right loading-modal submit" form="farmerRegForm">Submit</button>
                <a href="#wizard-navigation" type='button' class='btn btn-danger pull-right' id="edit">Edit</a>
            </div>
        </div>
    </div>
</div>