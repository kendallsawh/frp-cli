<div class="tab-pane" id="about" target="address">
    <div class="row">
        <h4 class="info-text">Let's start with the basic information</h4>
    </div>
    <div class="row round-border-20">
        <div class = "row">
            <div class="col-sm-12">
                <!-- <label class="text-center">Optional </label> -->
                <h6 class="info-text">Optional</h6>
                <!-- <h6 class="text-center">Let's start with the basic information</h6> -->
            </div>
        </div>
        <div class = "row">
            <div class="col-sm-5">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">account_box</i>
                    </span>
                    <div id="grp-oldregistration" class="form-group{{ $errors->has('oldregistration') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Most Recent Registration Number </label>
                        <input id="oldregistration" name="oldregistration" type="text" class="form-control oldregistration" value="{{old('oldregistration')}}" style="text-transform:uppercase">

                        <span class="help-block">                        
                            <strong id="">Format AAAA/xxxxx/xxxx</strong><br>
                            <strong id="err-oldregistration">{{ $errors->first('oldregistration') }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">date_range</i>
                    </span>
                    <div id="grp-dateofissue" class="form-group{{ $errors->has('dateofissue') ? ' has-error' : '' }} label-floating">
                        <label class="control-label">Issue date of old badge </label>
                        <input id="dateofissue" name="dateofissue" type="text" class="form-control datepicker" autocomplete="off" value="">

                        <span class="help-block">
                            <strong id="">Date should be at least 3 years prior to application date on the application form</strong><br>
                            <strong id="err-dateofissue">{{ $errors->first('dateofissue') }}</strong>
                        </span>
                    </div>
                </div>
            </div> 
        </div>
        <br>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="picture-container">
                <div class="picture">
                    <img src="{{session()->has('old_logo')? asset('/storage/temp/'.session('old_logo')) : asset('/img/blank-img.png')}}" alt="Logo" class="picture-src" id="wizardPicturePreview" title="" />
                    <input type="file" id="wizard-picture" name="logo" accept="image/*">
                    <input type="text" id="old_logo" name="old_logo" value="{{ session('old_logo') }}">
                </div>
                <h6>
                    Company Logo
                    <br>
                    <small>
                        <span class="text-danger text-center">
                            <strong id="err-logo">{{$errors->first('logo')}}</strong>
                        </span>
                    </small>
                </h6>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">business</i>
                </span>
                <div id="grp-org_name" class="form-group{{ $errors->has('org_name') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Organization Name <span class="red">*</span></label>
                    <input id="org_name" name="org_name" type="text" class="form-control" value="{{old('org_name')}}" style="text-transform:uppercase"/>

                    <span class="help-block">
                        <strong id="err-org_name">{{ $errors->first('org_name') }}</strong>
                    </span>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">business_center</i>
                </span>
                <div id="grp-org_type" class="form-group{{ $errors->has('org_type') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Type of Organization <span class="red">*</span></label>
                    <input id="org_type" name="org_type" type="text" class="form-control" value="{{old('org_type')}}" ')}}" style="text-transform:uppercase"/>

                    <span class="help-block">
                        <strong id="err-org_type">{{ $errors->first('org_type') }}</strong>
                    </span>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-hashtag fa-lg" aria-hidden="true"></i>
                </span>
                <div id="grp-reg_num" class="form-group{{ $errors->has('reg_num') ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Registration Number <span class="red">*</span></label>
                    <input id="reg_num" name="reg_num" type="text" class="form-control" value="{{old('reg_num')}}"/>

                    <span class="help-block">
                        <strong id="err-reg_num">{{ $errors->first('reg_num') }}</strong>
                    </span>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-hashtag fa-lg" aria-hidden="true"></i>
                        </span>
                        <div id="grp-vat_num" class="form-group{{ $errors->has('vat_num') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">VAT Registration Number <span class="red">*</span></label>
                            <input id="vat_num" name="vat_num" type="text" class="form-control" value="{{old('vat_num')}}"/>

                            <span class="help-block">
                                <strong id="err-vat_num">{{ $errors->first('vat_num') }}</strong>
                            </span>
                        </div>
                    </div>


                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div id="grp-biz_email" class="form-group{{ $errors->has('biz_email') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Email <span class="red">*</span></label>
                            <input id="biz_email" name="biz_email" type="email" class="form-control" value="{{old('biz_email')}}"/>

                            <span class="help-block">
                                <strong id="err-biz_email">{{ $errors->first('biz_email') }}</strong>
                            </span>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
                        </span>
                        <div id="grp-biz_phone" class="form-group{{ $errors->has('biz_phone') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Telephone Number  <span class="red">*</span></label>
                            <input id="biz_phone" name="biz_phone" type="text" class="form-control contact" value="{{old('biz_phone')}}" autocomplete="false">

                            <span class="help-block">
                                <strong id="">Format (xxx) xxx-xxxx</strong><br>
                                <strong id="err-biz_phone">{{ $errors->first('biz_phone') }}</strong>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>