<div class="tab-pane" id="enterprise" target="parcels">
    <h4 class="info-text">
        Information on Enterprise<br>
        <small>
            <span class="text-danger text-center">
                <strong id="err-enterprise">{{ $errors->first('enterprise') }}</strong>
            </span>
        </small>
    </h4>

    <div class="row">
        <div class="col-sm-12">
            @foreach($enterprises as $enterprise)
            @if($enterprise->slug != 'other')
            <div class="col-sm-6 round-border" style="min-height: 90px">
                <div class="form-group has-error" id="grp-ent-{{$enterprise->slug}}">
                    <div class="">
                        <div class="col-sm-8">
                            <div class="checkbox">
                                <label for="ent-{{$enterprise->slug}}">
                                    <input id="ent-{{$enterprise->slug}}" type="checkbox" name="enterprise[{{$enterprise->slug}}]" slug="{{$enterprise->slug}}" class="enterprise" {{old('enterprise.'.$enterprise->slug)=='on' ? 'checked' : '' }}>
                                    {{$enterprise->enterprise}}
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 engage-level" style="display: {{old('enterprise.'.$enterprise->slug)=='on' ? 'block' : 'none' }};" id="majordiv-{{$enterprise->slug}}">
                            <div class="radio">
                                <label class="" for="major-{{$enterprise->slug}}">
                                    <input id="major-{{$enterprise->slug}}" type="radio" name="majorminor[{{$enterprise->slug}}]" value="major" class="majorminor" slug="{{$enterprise->slug}}" {{old('majorminor.'.$enterprise->slug)=='major' ? 'checked' : '' }}><span class="circle"></span><span class="check"></span> Major
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 engage-level" style="display: {{old('enterprise.'.$enterprise->slug)=='on' ? 'block' : 'none' }};" id="minordiv-{{$enterprise->slug}}">
                            <div class="radio">
                                <label class="" for="minor-{{$enterprise->slug}}">
                                    <input id="minor-{{$enterprise->slug}}" type="radio" name="majorminor[{{$enterprise->slug}}]" value="minor" class="majorminor" slug="{{$enterprise->slug}}" {{old('majorminor.'.$enterprise->slug)=='minor' ? 'checked' : '' }}><span class="circle"></span><span class="check"></span> Minor
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span class="text-danger">
                                <strong id="err-ent-{{$enterprise->slug}}">
                                    {{ $errors->first('enterprise.'.$enterprise->slug) }}
                                    {{ $errors->first('majorminor-'.$enterprise->slug) }}
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

            <div class="col-sm-6 round-border" style="min-height: 90px">
                <div class="form-group">
                    <div class="">
                        <div class="col-sm-8">
                            <div class="checkbox">
                                <label for="ent-other">
                                    <input id="ent-other" type="checkbox" name="enterprise[other]" slug="other" class="enterprise" {{old('enterprise.other')=='on' ? 'checked' : '' }}>
                                    Other
                                </label>
                            </div>
                            <div style="display: {{old('enterprise.other')=='on' ? 'block' : 'none' }}; padding-bottom: 10px;" id="other-text">
                                <input id="other_name" type="text" name="other_name" slug="other" placeholder="Enterprise name" class="form-control" value="{{old('other_name')}}" style="text-transform:uppercase"/>
                            </div>
                        </div>

                        <div class="col-sm-2 engage-level" style="display: {{old('enterprise.other')=='on' ? 'block' : 'none' }};" id="majordiv-other">
                            <div class="radio">
                                <label class="" for="major-other">
                                    <input id="major-other" type="radio" name="majorminor[other]" value="major" class="majorminor" slug="other" {{old('majorminor.other')=='major' ? 'checked' : '' }}>
                                    Major
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 engage-level" style="display: {{old('enterprise.other')=='on' ? 'block' : 'none' }};" id="minordiv-other">
                            <div class="radio">
                                <label class="" for="minor-other">
                                    <input id="minor-other" type="radio" name="majorminor[other]" value="minor" class="majorminor" slug="other" {{old('majorminor.other')=='minor' ? 'checked' : '' }}>
                                    Minor
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span class="text-danger">
                                <strong id="err-ent-other">
                                    {{ $errors->first('enterprise.other') }}
                                    {{ $errors->first('majorminor-other') }}<br>
                                    {{ $errors->first('other_name') }}
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>