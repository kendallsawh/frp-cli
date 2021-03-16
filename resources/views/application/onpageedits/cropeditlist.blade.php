<div class="form-group{{ $errors->has('animal_crop') ? ' has-error' : '' }} label-floating" id="grp-animal_crop">
    <label class="control-label">Specific Crop/Animal <span class="red">*</span></label>

    <select id="animal_crop" name="animal_crop" class="form-control dropdown animal_crop" >
        <option disabled="" selected=""></option>
        @foreach($animal_crops as $key=>$animal_crop)
        <option value="{{$animal_crop->id}}" {{old('animal_crop')==$animal_crop->id ? 'selected' : '' }}>{{$animal_crop->CommodityLocalName}}({{$animal_crop->Variety}})</option>
        @endforeach
    </select>

    <span class="help-block">
        <strong id="err-animal_crop">{{ $errors->first('animal_crop') }}</strong>
    </span>
</div>