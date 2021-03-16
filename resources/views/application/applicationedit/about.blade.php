<div class="tab-pane" id="about" target="address">
    <div class="row">
        <h4 class="info-text">Let's start with the basic information</h4>
        <div class="col-sm-4">

            <div class="picture-container">
                <div class="picture">
                    <img src="{{session()->has('old_avatar')? asset('/storage/temp/'.session('old_avatar')) : asset('/img/default-avatar.png')}}" alt="Avatar" class="picture-src" id="wizardPicturePreview" title="" />
                    <input type="file" id="wizard-picture" name="avatar" accept="image/*">
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
                    <input id="firstname" name="firstname" type="text" class="form-control" value="{{old('firstname')}}">

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
                    <input id="middlename" name="middlename" type="text" class="form-control" value="{{old('middlename')}}">

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
                    <input id="lastname" name="lastname" type="text" class="form-control" value="{{old('lastname')}}">

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
                    <input id="alias" name="alias" type="text" class="form-control" value="{{old('alias')}}">

                    <span class="help-block">
                        <strong id="err-alias">{{ $errors->first('alias') }}</strong>
                    </span>
                </div>
            </div>
            <div class="row round-border-20">
                <div class = "row">
                    <div class="col-sm-12">
                        <!-- <label class="text-center">Optional </label> -->
                        <p class="text-center">Optional</p>
                        <!-- <h6 class="text-center">Let's start with the basic information</h6> -->
                    </div>
                </div>
                <div class = "row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_box</i>
                            </span>
                            <div id="grp-oldregistration" class="form-group{{ $errors->has('oldregistration') ? ' has-error' : '' }} label-floating">
                                <label class="control-label">Old Registration Number </label>
                                <input id="oldregistration" name="oldregistration" type="text" class="form-control oldregistration" value="{{old('oldregistration')}}">

                                <span class="help-block">                        
                                    <strong id="">Format AAAA/xxxx/xxxx</strong><br>
                                    <strong id="err-oldregistration">{{ $errors->first('oldregistration') }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div id="grp-dateofissue" class="form-group{{ $errors->has('dateofissue') ? ' has-error' : '' }} label-floating">
                                    <label class="control-label">Grant date of old badge </label>
                                    <input id="dateofissue" name="dateofissue" type="text" class="form-control datepicker" autocomplete="off" value="{{old('dateofissue')}}">

                                    <span class="help-block">
                                        <strong id="err-dateofissue">{{ $errors->first('dateofissue') }}</strong>
                                    </span>
                                </div>
                        </div>
                    </div> 
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
                    <label class="control-label">Date of Birth <span class="red">*</span></label>
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
                    <label class="control-label">National ID <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                    <input id="n_id" name="n_id" type="number" class="form-control" value="{{old('n_id')}}" autocomplete="false">

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
                    <label class="control-label">Passport Number <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                    <input id="passport" name="passport" type="text" class="form-control" value="{{old('passport')}}">

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
                    <label class="control-label">Home Contact <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                    <input id="homenumber" name="homenumber" type="text" class="form-control contact" value="{{old('homenumber')}}" autocomplete="false">

                    <span class="help-block">
                        <strong id="">Enter at least one type of contact</strong><br>
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
                        <strong id="">Enter at least one type of contact</strong><br>
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
                    <label class="control-label">Emergency Contact <span class="red">*</span></label>
                    <input id="emergencynumber" name="emergencynumber" type="text" class="form-control contact" value="{{old('emergencynumber')}}" autocomplete="false">

                    <span class="help-block">
                        <strong id="">format (xxx) xxx-xxxx</strong><br>
                        <strong id="err-emergencynumber">{{ $errors->first('emergencynumber') }}</strong>
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>