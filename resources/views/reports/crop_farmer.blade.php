@extends('layouts.app')

@section('content')



<div class="col-sm-12">
    <div class="wizard-header">
        <h2 class="wizard-title">{{$title}}</h2>
        
        <div class="row">
            <div class="alert alert-info text-center" style="height: 30px; margin-bottom: 0; padding: 5px;">
                <div class="container-fluid">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <i class="fa fa-info-circle" aria-hidden="true" style="color: white"></i> <b>
                    Select a crop and click search.</b>
                </div>
            </div>
        </div>  
    </div>
    <div class="card">
        <div class="row">
            <div class="card-content col-sm-12">
                <h3 class="card-title text-center" style="padding-left:25px;">
                    Select a crop
                </h3>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <form role="form" method="POST" action="{{ route('commodityStat') }}" id="commodityStatForm" enctype="multipart/form-data">
               {{ csrf_field() }}
                <div class="row"> 
                        <div class="col-sm-4">
                            <div class="form-group{{ $errors->has('animal_crop1') ? ' has-error' : '' }} label-floating" id="grp-animal_crop_1">
                                <label class="control-label">Specific Crop/Animal <span class="red">*</span></label>

                                <select id="animal_crop_1" name="animal_crop1" class="form-control dropdown animal_crop" crop="1">
                                    <option disabled="" selected=""></option>
                                    @foreach($animal_crops as $key=>$animal_crop)
                                    <option value="{{$animal_crop->animal_crop}}" {{old('animal_crop1')==++$key ? 'selected' : '' }}>{{$animal_crop->animal_crop}}</option>
                                    @endforeach
                                </select>

                                <span class="help-block">
                                    <strong id="err-animal_crop_1"></strong>
                                </span>
                            </div>
                        </div>
                        
                </div>
                <br>
                <div class="row">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="info-text" style="padding-left:25px;">
                                Search by County
                            </h4>
                        </div>
                        <div class="col-sm-1">
                            <h4 class="info-text" style="padding-left:25px;">
                                <b>OR</b>
                            </h4>
                        </div>
                        <div class="col-sm-4">
                            <h4 class="info-text" style="padding-left:25px;">
                               Search by your County's Community/Locality({{Auth::user()->county}})
                            </h4>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group{{ $errors->has('county') ? ' has-error' : '' }} label-floating" id="grp-county">
                            <label class="control-label">County</label>

                            <select id="county" name="county" class="form-control dropdown county" >
                                <option disabled="" selected=""></option>
                                @foreach($counties as $key=>$county)
                                <option value="{{$county->id}}" {{old('county')==++$key ? 'selected' : '' }}>{{$county->county}}</option>
                                @endforeach
                            </select>

                            <span class="help-block">
                                <strong id="err-county"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }} label-floating" id="grp-district">
                            <label class="control-label">District</label>

                            <select id="district" name="district" class="form-control dropdown district" >
                                <option disabled="" selected=""></option>
                                @foreach($districts as $key=>$district)
                                <option value="{{$district->id}}" {{old('district')==++$key ? 'selected' : '' }}>{{$district->district_name}}</option>
                                @endforeach
                            </select>

                            <span class="help-block">
                                <strong id="err-district"></strong>
                            </span>
                        </div>
                    </div>

                </div>
                
            </form>
        </div>
        
        <button type="submit" id="submit" class="btn btn-success pull-right loading-modal submit" form="commodityStatForm">Search</button>
    </div>
   <!-- ************************************************************************************** -->
    @if($crop_results >= 1 )
    @include('reports.common.crop_farmer_table')
   
    @endif

</div>

@endsection

@section('scripts')

<script type="text/javascript">
    var dropdownChanged1 = false;
    var dropdownChanged2 = false;
    var dropdownChanged3 = false;
    $( ".animal_crop3" ).change(function() {
        //if(dropdownChanged1 == true || dropdownChanged2 == true)
        var animal_crop = $('#animal_crop_1').val();
        var animal_crop2 = $('#animal_crop_2').val();
        if (!animal_crop) {

            $('#grp-animal_crop_1').addClass('has-error');
            $('#err-animal_crop_1').html('Please enter animal/crop');
            $('#submit').addClass('hide');
        }
        if (!animal_crop2) {


            $('#grp-animal_crop_2').addClass('has-error');
            $('#err-animal_crop_2').html('Please enter animal/crop');
            $('#submit').addClass('hide');
        }
        if (animal_crop && animal_crop2){
            $('#submit').removeClass('hide');
        }
                    
        
        /*$('#animal_crop_1 option').each(function() {
            if(this.selected)
                alert('true');
        });*/
        
    });
   $('#animal_crop_1').change(function(){
        dropdownChanged1 = true;
        if(dropdownChanged1 && dropdownChanged2){
            $('#submit').removeClass('hide');
        }
    });

   $('#animal_crop_2').change(function(){
        dropdownChanged2 = true;
        var animal_crop = $('#animal_crop_1').val();
        
        if (!animal_crop) {

            $('#grp-animal_crop_1').addClass('has-error');
            $('#err-animal_crop_1').html('Please enter animal/crop');
            $('#submit').addClass('hide');
        }
        if(dropdownChanged1 && dropdownChanged2){
            $('#submit').removeClass('hide');
        }
    });

</script>
@endsection

