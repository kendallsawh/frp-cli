@extends('layouts.app')

@section('content')
<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb" id="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="#">Farmers</a></li>
        <li><a href="{{route('farmerRegister')}}">Registration</a></li>
        <li class="active">Organization</li>
    </ul>

    <!-- Display Validation Errors -->
    <div class="col-md-12" id="errorDiv">@include('common.errors')</div>

    <!--      Wizard container        -->
    <div class="wizard-container" id="wizard-container">
        <div class="card wizard-card" data-color="{{config('global.colour')}}" id="wizardProfile">

            <form role="form" method="POST" action="{{ route('organizationInsert') }}" id="farmerRegForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="job" value="{{$type['slug']}}">
                <div class="wizard-header">

                    <h2 class="wizard-title">{{$title}}</h2>
                    <h5>Please enter your information correctly.

                    <!-- delete this button -->
                    <br><button class="btn btn-success loading-modal hide">test post</button></h5>
                    @include('common.scanmsg')

                </div>
                
                <div class="wizard-navigation hidden-xs hidden-sm" id="wizard-navigation">
                    <ul>
                        <li><a href="#about" data-toggle="tab">Organization Information</a></li>
                        <li><a href="#address" data-toggle="tab">Address</a></li>
                        <li><a href="#reps" data-toggle="tab">Representatives</a></li>
                        <li><a href="#enterprise" data-toggle="tab">Enterprise</a></li>
                        <li><a href="#parcels" data-toggle="tab">Parcels</a></li>
                        <li><a href="#appointment" data-toggle="tab">Appointment</a></li>
                    </ul>
                </div>
                <div class="col-md-12 required">
                    <p>
                        <label>
                            <span class="red">*</span> Required Fields <br>
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> At least one is required
                        </label>
                    </p>
                </div>
                <div class="tab-content">
                    @include('company.register.about')
                    @include('company.register.address')
                    @include('company.register.reps')
                    @include('farmer.register.enterprise')
                    @include('farmer.register.parcels')
                    @include('farmer.register.appointment')

                </div>
                <div class="wizard-footer">
                    <div class="pull-right">
                        <a href="#wizard-navigation" type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' id="next">Next</a>
                        <a href="#confirm-card" type='button' id="confirm" class='btn btn-finish btn-fill btn-success btn-wd' name='confirm'>Continue</a>
                    </div>

                    <div class="pull-left">
                        <a href="#wizard-navigation" type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous'>Previous</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>

    <!-- wizard container -->
    @include('company.register.confirm')

</div>
@endsection

@section('scripts')
<script type="text/javascript">

    // to check vat nums
    var vat_nums = {!! $vat_nums !!};

    // to check reg nums
    var reg_nums = {!! $reg_nums !!};

    // validation
    @include('company.register.validation')

    // common scripts
    @include('farmer.common.scripts')

    // change confirm avatars
    $(".fileinput").on("change.bs.fileinput", function(){
        $('#conf-avatar1').attr('src',$('.avatar1 img').attr('src'));
        $('#conf-avatar2').attr('src',$('.avatar2 img').attr('src'));
    });


    /*
    |Found in individual register controller
    |Ajax call to search for county and officer based on district
    */
    $(document).on('change', '.parcel_town_village', function() {
         //$('#county_check').show();
         var d_id = $('.parcel_town_village').val();
         
        $.ajax({
            type: "POST",
            url: '{{url('checkdistrict')}}',
            data: {districtid:d_id},
            dataType: "json",
            success: function(res) {
                if(res.exists){
                    //console.log(res.assinged_user);
                    $('#county_check').empty();
                    $('#county_check').text('This town is in county '+ res.assinged_county);
                    $('#county_check').removeClass('hide');
                }
            },
            error: function (data) {
                var errors = data.responseJSON;
                //console.log(data.message);
                console.log(errors);
               
                

            }
        });
    });

</script>  
@endsection

