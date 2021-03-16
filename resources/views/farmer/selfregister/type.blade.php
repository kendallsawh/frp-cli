<div class="tab-pane" id="type" target="about">
    <h4 class="info-text">
        What are you doing?<br>
        <small>
            <span class="text-danger text-center">
            <strong>{{ $errors->first('job') }}</strong>
            </span>
        </small>
    </h4>
    <div class="row">
        <div class="col-sm-1">
        </div>
            @foreach($job_types as $type)
            <div class="col-sm-2">
                <div class="choice{{old('job')==$type->slug ? ' active' : ''}}" data-toggle="wizard-radio" rel="tooltip" title="{{$type->tooltip}}">
                    <input id="{{$type->slug}}" type="radio" name="job" value="{{$type->slug}}" class="form-control" {{old('job')==$type->slug ? 'checked' : ''}}>
                    <div class="icon">
                        <i class="fa {{$type->icon}}" aria-hidden="true"></i>
                    </div>
                    <h6 id="label-{{$type->slug}}">{{$type->type}}</h6>
                </div>
            </div>
            @endforeach
        <div class="col-sm-1">
        </div>
    </div>
</div>
