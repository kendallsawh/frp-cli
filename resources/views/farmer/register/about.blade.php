<div class="tab-pane" id="about" target="address">
    <div class="row">
        <h4 class="info-text">Let's start with the basic information</h4>
        <hr>
        <h6 class="info-text">Application Type</h6>
        <div class="col-sm-12 col-md-offset-5">
            <div class="input-group">
                <div id="grp-regtype" class="form-group{{ $errors->has('regtype') ? ' has-error' : '' }} ">
                    <div class="col-sm-4 engage-level"  >
                        <div class="radio">
                            <label class="" for="option2">
                                <input type="radio" class="regtype" slug="New" name="regtype" id="option2" value="1"><span class="circle"></span><span class="check"></span> New
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4 engage-level" >
                        <div class="radio">
                            <label class="" for="option3">
                                <input type="radio" class="regtype" slug="Renewal" name="regtype" id="option3" value="2"><span class="circle"></span><span class="check"></span> Renewal
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span class="text-danger">
                            <strong id="err-regtype">{{ $errors->first('regtype') }}</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <h6 class="info-text">Personal Information</h6>
        
        <div class="col-sm-4">

            <div class="picture-container">
                <div class="picture">
                    <img src="{{session()->has('avatar')? asset('/storage/temp/'.session('avatar')) : asset('/img/default-avatar.png')}}" alt="Avatar" class="picture-src" id="wizardPicturePreview" title="" />
                    <input type="file" id="wizard-picture" name="avatar" accept="image/*" value="{{ old('avatar') }}">
                    <input type="text" id="old_avatar" name="old_avatar" value="{{ session('old_avatar') }}">
                </div>
                <h6>
                    Choose Picture <span class="red">*</span>
                    <br>
                    <small>
                        <span class="text-danger text-center">
                            <strong id="err-avatar">{{$errors->first('avatar')}}</strong>
                        </span>
                    </small>
                </h6>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">account_box</i>
                </span>
                <!-- if on submit an the validation fails, then show error, but also on clicking the highlightd field after the requird validation things, the validation blade fills the error field with the error -->
                <div id="grp-firstname" class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">First Name <span class="red">*</span></label>
                    <input id="firstname" name="firstname" type="text" class="form-control" value="{{old('firstname')}}" style="text-transform:uppercase">

                    <span class="help-block">
                        <strong id="err-firstname">{{ $errors->first('firstname') }}</strong>
                    </span>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">account_box</i>
                </span>
                <div id="grp-middlename" class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Middle Name </label>
                    <input id="middlename" name="middlename" type="text" class="form-control" value="{{old('middlename')}}" style="text-transform:uppercase">

                    <span class="help-block">
                        <strong id="err-middlename">{{ $errors->first('middlename') }}</strong>
                    </span>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">account_box</i>
                </span>
                <div id="grp-lastname" class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Last Name <span class="red">*</span></label>
                    <input id="lastname" name="lastname" type="text" class="form-control" value="{{old('lastname')}}" style="text-transform:uppercase">

                    <span class="help-block">
                        <strong id="err-lastname">{{ $errors->first('lastname') }}</strong>
                    </span>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">face</i>
                </span>
                <div id="grp-alias" class="form-group{{ $errors->has('alias') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Alias </label>
                    <input id="alias" name="alias" type="text" class="form-control" value="{{old('alias')}}" style="text-transform:uppercase">

                    <span class="help-block">
                        <strong id="err-alias">{{ $errors->first('alias') }}</strong>
                    </span>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">date_range</i>
                </span>
                <div id="grp-dateofbirth" class="form-group{{ $errors->has('dateofbirth') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Date of Birth(yyyy-mm-dd) <span class="red">*</span></label>
                    <input id="dateofbirth" name="dateofbirth" type="text" class="form-control datepicker" autocomplete="off" value="{{old('dateofbirth')}}">

                    <span class="help-block">
                        <strong id="err-dateofbirth">{{ $errors->first('dateofbirth') }}</strong>
                    </span>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">perm_identity</i>
                </span>
                <div id="grp-gender" class="form-group{{ $errors->has('gender') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Gender <span class="red">*</span></label>
                    <select id="gender" name="gender" class="form-control dropdown">
                        <option disabled="" selected=""></option>
                        @foreach($genders as $gender)
                        <option value="{{$gender->slug}}" {{old('gender')==$gender->slug ? 'selected' : '' }}>{{$gender->gender}}</option>
                        @endforeach
                    </select>

                    <span class="help-block">
                        <strong id="err-gender">{{ $errors->first('gender') }}</strong>
                    </span>
                </div>
            </div>
            
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">credit_card</i>
                </span>
                <div id="grp-n_id" class="form-group{{ $errors->has('n_id') ? ' has-error' : '' }} label-floating">
                    <div class="col-md-9 col-lg-9 col-sm-9 col-xs-9">
                        <label class="control-label">National ID <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                        <input id="n_id" name="n_id" type="number" onblur="duplicateN_id(this)" class="form-control" value="{{old('n_id')}}" autocomplete="false" style="text-transform:uppercase">
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3" >
                        <label class="control-label">   Upload Scan (Optional)</label>
                        <input id="nid_file" class="nid_docs" name="nid_file" type="file" multiple style="opacity: inherit;position: relative; padding-top:10px">
                    </div>
                    <span class="help-block">
                        <strong id="err-n_id">{{ $errors->has('n_id') ? $errors->first('n_id') : 'Select at least one type of identification' }}</strong>
                    </span>
                </div>
                
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">account_box</i>
                </span>
                <div id="grp-passport" class="form-group{{ $errors->has('passport') ? ' has-error' : '' }} label-floating">
                    <div class="col-md-9 col-lg-9 col-sm-9 col-xs-9">
                        <label class="control-label">Passport Number <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                        <input id="passport" name="passport" onblur="duplicateN_id(this)" type="text" class="form-control" value="{{old('passport')}}">
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                        <label class="control-label">   Upload Scan (Optional)</label>
                        <input id="passport_file" class="passport_docs" name="passport_file" type="file" multiple style="opacity: inherit;position: relative; padding-top:10px" style="text-transform:uppercase">
                    </div>
                    <span class="help-block">
                        <strong id="err-passport">{{ $errors->has('passport') ? $errors->first('passport') : 'Select at least one type of identification' }}</strong>
                    </span>
                </div>
            </div>

        </div>
        <div class="col-sm-6">

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">email</i>
                </span>
                <div id="grp-email" class="form-group{{ $errors->has('email') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Email</label>
                    <input id="email" name="email" type="email" class="form-control" value="{{old('email')}}"/>

                    <span class="help-block">
                        <strong id="err-email">{{ $errors->first('email') }}</strong>
                    </span>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">home</i>
                </span>
                <div id="grp-homenumber" class="form-group{{ $errors->has('homenumber') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Home/Work Contact <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                    <input id="homenumber" name="homenumber" type="text" class="form-control contact" value="{{old('homenumber')}}" autocomplete="false">

                    <span class="help-block">
                        <strong id="">Enter either a home or mobile contact</strong><br>
                        <strong id="">Format (xxx) xxx-xxxx</strong><br>
                        <strong id="err-homenumber">{{ $errors->first('homenumber') }}</strong>
                    </span>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">phonelink_ring</i>
                </span>
                <div id="grp-mobilenumber" class="form-group{{ $errors->has('mobilenumber') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Mobile Contact <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                    <input id="mobilenumber" name="mobilenumber" type="text" class="form-control contact" value="{{old('mobilenumber')}}" autocomplete="false">

                    <span class="help-block">
                        <strong id="">Enter either a home or mobile contact</strong><br>
                        <strong id="">Format (xxx) xxx-xxxx</strong><br>
                        <strong id="err-mobilenumber">{{ $errors->first('mobilenumber') }}</strong>
                    </span>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">contact_phone</i>
                </span>
                <div id="grp-emergencynumber" class="form-group{{ $errors->has('emergencynumber') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Emergency Contact </label>
                    <input id="emergencynumber" name="emergencynumber" type="text" class="form-control contact" value="{{old('emergencynumber')}}" autocomplete="false">

                    <span class="help-block">
                        <strong id="">format (xxx) xxx-xxxx</strong><br>
                        <strong id="err-emergencynumber">{{ $errors->first('emergencynumber') }}</strong>
                    </span>
                </div>
            </div>

        </div>
        <div class="col-sm-6 hide" id="n_id_pp"  align="center">
            <div>
               <h6><strong>This ID already exists in the database. Would you like to go to the individual?</strong></h6> 
            </div>
            <div>
                <h5><b><a class="btn btn-info btn-round btn-lg" id="n_id_pp_link" href="#" type="button">Go to individual</a></b></h5>
            </div>
            
        </div>
    </div>
</div>