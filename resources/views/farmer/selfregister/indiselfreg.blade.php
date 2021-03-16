@extends('layouts.app')

@section('content')
<div class="col-sm-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb" id="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="#">Farmers</a></li>
        <li><a href="{{route('individualList')}}">Edits</a></li>
        <li class="active">Individual</li>
    </ul>
    
    <!-- Display Validation Errors -->
    <div class="col-md-12" id="errorDiv">@include('common.errors')</div>

    <!--      Wizard container        -->
    <div class="wizard-container " id="wizard-container">
        <div class="card wizard-card" data-color="{{config('global.colour')}}" id="wizardProfile">

            <form role="form" method="POST" action="{{ route('editIndividualData') }}" id="farmerRegFormEdit" enctype="multipart/form-data">
                {{ csrf_field() }}
                 <input type="hidden" name="usersid" value="{{$userdata->id}}"> 

                <div class="wizard-header">
                    <h2 class="wizard-title">{{$title}}</h2>
                    <h5>Please enter your information correctly.

                    
                    @include('common.scanmsg')
                </div>
                
                <div class="wizard-navigation hidden-xs hidden-sm" id="wizard-navigation">
                    <ul>
                        <li><a href="#about" data-toggle="tab">Personal Information</a></li>
                        <li><a href="#address" data-toggle="tab">Address</a></li>
                        <!-- <li><a href="#enterprise" data-toggle="tab">Enterprise</a></li>
                        <li><a href="#parcels" data-toggle="tab">Parcels</a></li> -->
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
                    @include('farmer.edits.aboutedit')
                    @include('farmer.edits.addressedit')
                   
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
    @include('farmer.edits.confirmedit')
    
</div>
@endsection

@section('scripts')
    <script type="text/javascript">

    // validation
    @include('farmer.edits.validation')

    // common scripts
    @include('farmer.common.editscripts')

    // to check national id
    var ids = {!! $n_ids !!};


    $( "#postal_checkbox" ).load(function() {
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

	$( "#postal_checkbox" ).ready(function() {
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

    // show/hide postal address and add confirm data
    $(document).on('change', '#postal_checkbox', function() {
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



</script>  
@endsection

