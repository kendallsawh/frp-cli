@extends('layouts.app')

@section('content')
<div class="col-sm-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb" id="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="#">Farmers</a></li>
        <li><a href="{{route('farmerRegister')}}">Registration</a></li>
        <li class="active">Individual</li>
    </ul>
    
    <!-- Display Validation Errors -->
    <div class="col-md-12" id="errorDiv">@include('common.errors')</div>

    <!--      Wizard container        -->
    <div class="wizard-container " id="wizard-container">
        <div class="card wizard-card" data-color="{{config('global.colour')}}" id="wizardProfile">

            <form role="form" method="POST" action="{{ route('farmerRegisterInsert') }}" id="farmerRegForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="job" value="{{$type['slug']}}">

                <div class="wizard-header">
                    <h2 class="wizard-title">{{$title}}</h2>
                    <h5>Please enter your information correctly.</h5>

                    
                </div>
                
                <div class="wizard-navigation hidden-xs hidden-sm" id="wizard-navigation">
                    <ul>
                        <li><a href="#about" data-toggle="tab">Personal Information</a></li>
                        <li><a href="#address" data-toggle="tab">Address</a></li>
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
                        <br>
                        <label>
                            <b>
                                Tip: Press the tab key to move to the next field.
                            </b>
                        </label>
                    </p>
                </div>
                <div class="tab-content">
                    @include('farmer.register.about')
                    @include('farmer.register.address')
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
    @include('farmer.register.confirm')
    @include('farmer.register.tenureproof')
    
</div>
@endsection

@section('scripts')
    <script type="text/javascript">

    // validation
    @include('farmer.register.validation')

    // common scripts
    @include('farmer.common.scripts')

    // to check national id
    //var ids = {!! $n_ids !!};
    var ids = "000000000000aaaaaaaaaaaaaaaaarrrrrrrrrrrrrrrrrrrrrrrrrrrr";
    var individual_link = ";"
    /*
    |Found in individual register controller
    |Ajax call to search for id number
    */
    function duplicateN_id(element){
        var nid = $(element).val();
        $.ajax({
            type: "POST",
            url: '{{url('checknid')}}',
            data: {nid:nid},
            dataType: "json",
            success: function(res) {
                if(res.exists){
                    //alert('true');
                    ids = nid;
                    individual_link = '{{URL::to('/individual/view')}}'+'/'+res.individual_view;
                }
            },
            error: function (jqXHR, exception) {

            }
        });
    }

    //show or hide uprn textbox based on application type
    function getval(sel)
    {
        var bla = $('#oldregistration').val();
        if(bla !== ""){
            if(sel.value == 4 || sel.value == 6 ||sel.value == 3 ||sel.value == 2)
            $('#uprn_row').removeClass('hide');
        else
            $('#uprn_row').addClass('hide');
        }
        
    }
    $(document).on('blur','#oldregistration', function(){
        if ($(this).val() != '') {
            $('#optional_hidden').removeClass('hidden');
        }
        else{
            $('#optional_hidden').addClass('hidden');
        }
    })
   

    // show/hide postal address and add confirm data
    $(document).on('click', '#postal_checkbox', function() {
        if ($(this).is(':checked')) {
            $('#conf-postal_checkbox').html('Same as above');
            $('#postal-address-div').hide();
            $('#conf-postaladdress').hide();
        } else {
            $('#conf-postal_checkbox').html('Not the same as above');
            $('#postal-address-div').show();
            $('#conf-postaladdress').show();
        }
    });

                /** Parcel Address **/
               
    var num = $('#parcels-added').val().split(",");

    for (i = 0, len = num.length; i < len; i++) { 
        var n = num[i];

        $('#parcel_reg_checkbox_'+n).change(function(){


            $('#parcel_lot_type_'+n).val($('#hometype option:selected').val())
            $('#parcel_street_number_'+n).val($('#street_number').val())
            $('#parcel_road_trace_'+n).val($('#road_trace').val())

            $('#parcel_town_village_'+n).val($('#town_village option:selected').val())

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
                        $('#county_check').text('This town is in county '+ res.assinged_county + res.assinged_farmdistrict + '.');
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
        

    }

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
                    $('#county_check').text('This town is in county '+ res.assinged_county + res.assinged_farmdistrict + '.').removeClass('hide');
                }
            },
            error: function (data) {
                var errors = data.responseJSON;
                //console.log(data.message);
                console.log(errors);
               
                

            }
        });
    });

    $("#btn-check").click(function() {
        //alert("f");
        ajaxAppointment($('#town_village').val())
    })
    var listingPath = "{{route('ajaxGetAppointment')}}"
    function ajaxAppointment(searchValue) {
        
         
        $.ajax({
            type: "POST",
            url: '{{url('get_appointment')}}',
            data: {
                districtid:searchValue,
                _token: "{{ csrf_token() }}",
            },
            dataType: "html",
            success: function(res) {
                
                    //alert(res.count);
                    
                    $('#radio-date').empty().html(res);
                    //console.log(res);
                    
                
            },
            error: function (data) {
                var errors = data.responseJSON;
                console.log(data.responseText);
                
               
                

            }
        });
    };

</script>  
@endsection

