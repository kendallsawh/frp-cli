@forelse($lands as $farmer => $landset)
    <div id="grp-land_{{$i}}_{{$farmerid}}" class="form-group{{ $errors->has('land.'.$i.'.'.$farmerid) ? ' has-error' : '' }} line-height-40 label-floating lands_{{$i}}">
        <label class="control-label" for"land_{{$i}}_{{$farmerid}}">Farmer Land {{$i}} <span class="red">*</span></label>
        <select id="land_{{$i}}_{{$farmerid}}" name="land[{{$i}}][{{$farmerid}}]" num="{{$i}}" class="form-control dropdown landselect landselect_{{$i}}_{{$farmerid}}">
            <option disabled="" selected=""></option>
            @forelse($landset as $land)
            <option value="{{$land->id}}" {{old('land.'.$i.'.'.$farmer) == $land->id? 'selected' : ''}}>{{$land->address->address}}</option>
            @empty
            @endforelse
        </select>
    </div>
@empty
@endforelse