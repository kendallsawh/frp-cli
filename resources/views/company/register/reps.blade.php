<div class="tab-pane" id="reps" target="enterprise">
    <div class="row">
        <h4 class="info-text">Who's representing you?</h4>
        <!-- contacts -->
        @for($i = 1; $i <= 2; $i++)
        <div class="col-sm-6">
            <!--Picture -->
            <div class="picture-container">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px; border-radius: 50%;">
                        <img src="{{session()->has('old_avatar'.$i)? asset('/storage/temp/'.session('old_avatar'.$i)) : asset('/img/default-avatar.png')}}" alt="Avatar">
                    </div>
                    <div class="fileinput-preview fileinput-exists avatar{{$i}} thumbnail" style="max-width: 200px; max-height: 150px; border-radius: 50%;"></div>
                    <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input id="avatar{{$i}}" type="file" name="avatar{{$i}}" accept="image/*"></span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
                
                <input type="hidden" id="old_avatar{{$i}}" name="old_avatar{{$i}}" value="{{ session('old_avatar'.$i) }}" >

                <span class="help-block text-danger">
                    <strong id="err-avatar{{$i}}">{{ $errors->first('avatar'.$i) }}</strong>
                </span>
            </div>

            <!--Applicant Name-->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">face</i>
                </span>
                <div id="grp-app_fname{{$i}}" class="form-group{{ $errors->has('app_fname'.$i) ? ' has-error' : '' }} label-floating">
                    <label class="control-label">First Name <span class="red">*</span></label>
                    <input id="app_fname{{$i}}" name="app_fname{{$i}}" type="text" class="form-control" value="{{old('app_fname'.$i)}}" style="text-transform:uppercase"/>

                    <span class="help-block">
                        <strong id="err-app_fname{{$i}}">{{ $errors->first('app_fname'.$i) }}</strong>
                    </span>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">face</i>
                </span>
                <div id="grp-app_sname{{$i}}" class="form-group{{ $errors->has('app_sname'.$i) ? ' has-error' : '' }} label-floating">
                    <label class="control-label">Surname <span class="red">*</span></label>
                    <input id="app_sname{{$i}}" name="app_sname{{$i}}" type="text" class="form-control" value="{{old('app_sname'.$i)}}" style="text-transform:uppercase"/>

                    <span class="help-block">
                        <strong id="err-app_sname{{$i}}">{{ $errors->first('app_sname'.$i) }}</strong>
                    </span>
                </div>
            </div>

            <!--Primary Contact -->
            
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">phone</i>
                </span>
                <div id="grp-contact{{$i}}"  class="form-group{{ $errors->has('contact'.$i) ? ' has-error' : '' }} label-floating">

                    <label class="control-label">Contact  <span class="red">*</span></label>
                    <input id="contact{{$i}}" name="contact{{$i}}" type="text" class="form-control contact" value="{{old('contact'.$i)}}">

                    <span class="help-block">
                        <strong id="err-contact{{$i}}">{{ $errors->first('contact'.$i) }}</strong>
                    </span>
                </div>

            </div>

            <!-- ID -->
            
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">contacts</i>
                </span>

                <div class="row">
                    <div class="col-md-6">
                        <div id="grp-id_type{{$i}}"  class="form-group{{ $errors->has('id_type'.$i) ? ' has-error' : '' }} label-floating">
                            <label class="control-label">ID Type <span class="red">*</span></label>
                            <select id="id_type{{$i}}" name="id_type{{$i}}" class="form-control dropdown">
                                <option disabled="" selected=""></option>
                                @foreach($id_types as $id_type)
                                <option value="{{$id_type->id}}" {{old('id_type'.$i)==$id_type->id ? 'selected' : '' }}>{{$id_type->identification_type}}</option>
                                @endforeach
                            </select>

                            <span class="help-block">
                                <strong id="err-id_type{{$i}}">{{ $errors->first('id_type'.$i) }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="grp-id_num{{$i}}"  class="form-group{{ $errors->has('id_num'.$i) ? ' has-error' : '' }} label-floating">
                            <label class="control-label">ID Number <span class="red">*</span></label>
                            <input id="id_num{{$i}}" name="id_num{{$i}}" type="text" class="form-control" value="{{old('id_num'.$i)}}">

                            <span class="help-block">
                                <strong id="err-id_num{{$i}}">{{ $errors->first('id_num'.$i) }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endfor
    </div>
</div>