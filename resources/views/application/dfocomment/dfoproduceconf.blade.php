@if($specificcrops)

<div class="col-md-9 col-lg-9 col-sm-9 col-xs-9">
	<div class="input-group">
		<span class="input-group-addon">
			<i class="material-icons">speaker_notes</i>
		</span>
		<div class="form-group{{ $errors->has('check_list') ? ' has-error' : '' }}">
			<label class="control-label">Checklist of stated crops/livestock<span class="red">*</span></label></br>
			
			<ul style="margin: 0;list-style: none;float: left;" >
				@foreach($specificcrops as $n =>  $specificcrop)
				<li><input type="checkbox" name="parcel_crop[{{$specificcrop->specific_parcel}}]" id="parcel_crop{{$n}}">{{number_format($specificcrop->amt)}} {{$specificcrop->type->unit->parcel_unit}} for {{$specificcrop->specific_parcel}}</li>
				@endforeach
			</ul>
			<span class="help-block text-danger">
				<strong id="err-check_list">{{ $errors->first('check_list') }}</strong>
			</span>
		</div>
	</div>
</div>
@endif