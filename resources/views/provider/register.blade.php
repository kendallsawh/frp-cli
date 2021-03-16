@extends('layouts.app')

@section('content')
<div class="col-sm-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb" id="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="#">Farmers</a></li>
        <li><a href="{{route('farmerRegister')}}">Registration</a></li>
        <li class="active">Service Provider</li>
    </ul>

    <!-- Display Validation Errors -->
    <div class="col-md-12" id="errorDiv">@include('common.errors')</div>

    <!--      Wizard container        -->
    <div class="wizard-container" id="wizard-container">
        <div class="card wizard-card" data-color="{{config('global.colour')}}" id="wizardProfile">

            <form role="form" method="POST" action="{{ route('farmerInsertProvider') }}" id="farmerRegForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="job" value="{{$type['slug']}}">
                <!-- data from previous page -->
                <input type="hidden" autocomplete="false" id="newexist" name="newexist" value="{{$newexist? $newexist : old('newexist')}}">
                <input type="hidden" autocomplete="false" id="farmertype" name="farmertype" value="{{$farmertype? $farmertype : old('farmertype')}}">
                <input type="hidden" autocomplete="false" id="indorg" name="indorg" value="{{$indorg? $indorg : old('indorg')}}">
                <input type="hidden" autocomplete="false" id="indorg_id" name="indorg_id" value="{{$indorg_id? $indorg_id : old('indorg_id')}}">

                <div class="wizard-header">
                    <h2 class="wizard-title">{{$title}}</h2>
                    
                    @include('common.scanmsg')
                    </div>
                    
                    <div class="wizard-navigation hidden-xs hidden-sm" id="wizard-navigation">
                        <ul>
                            @if($farmertype == 'org' || old('farmertype') == 'org')
                            <li><a href="#about" data-toggle="tab">Organization Information</a></li>
                            @endif
                            @if($farmertype == 'ind' || old('farmertype') == 'ind')
                            <li><a href="#about" data-toggle="tab">Personal Information</a></li>
                            @endif
                            @if($newexist == 'new' || old('newexist') == 'new')
                            <li><a href="#address" data-toggle="tab">Address</a></li>
                            @endif
                            @if($farmertype == 'org' || old('farmertype') == 'org')
                            <li><a href="#reps" data-toggle="tab">Representatives</a></li>
                            @endif
                            <li><a href="#service" data-toggle="tab">Service</a></li>
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
                        @if($farmertype == 'org')
                            @include('company.register.about')
                            @include('company.register.address')
                            @include('company.register.reps')
                        @endif
                        @if($farmertype == 'ind')
                            @include('farmer.register.about')
                            @include('farmer.register.address')
                        @endif
                        @include('provider.register.service_new')
                    </div>
                    <div class="wizard-footer">
                        <div class="pull-left">
                            <a href="#wizard-navigation" class='btn btn-previous btn-fill btn-default btn-wd' name='previous'>Previous</a>
                        </div>

                        <div class="pull-right">
                            <a href="#wizard-navigation" class='btn btn-next btn-fill btn-success btn-wd' name='next' id="next">Next</a>
                            <a href="#confirm-card" id="confirm" class='btn btn-finish btn-fill btn-success btn-wd' name='confirm'>Continue</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </form>
            </div>
        </div>
        <!-- wizard container -->

        @include('provider.register.confirm')
    </div>
    @endsection

    @section('scripts')
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    // common scripts
    @include('farmer.common.scripts')

    // validation
    @include('provider.register.validation')

    // to check national id
    
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

    // clear error status and add confirm data
    $(document).on('click', '#cert_copy', function() {
        $('#err-cert_copy').html('');
        $('#grp-cert_copy').removeClass('has-error');
    });
    $(document).on('click', '.farmers', function() {
        $('#err-rec_msg').html('');
    });
    
    $(document).on('click', '.recs', function() {
        var num = $(this).attr('num');
        $('#err-rec_msg').html('');
        $('#grp-rec_'+num).removeClass('has-error');
    });

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

    // clear error status and add confirm data
   /* $(document).on('change', '.landselect', function() {
        $('#conf-land_'+$(this).attr('num')).html($('option:selected', this).text());
    });*/

    $(document).on('change', '.districtselect', function() {
        $('#conf-district_'+$(this).attr('num')).html($('option:selected', this).text());
    });
    $(document).on('change', '.recs', function() {
        if ($(this).val().length != 0) 
            $('#conf-proof_doc_'+$(this).attr('num')).html('File chosen');
        else
            $('#conf-proof_doc_'+$(this).attr('num')).html('No file chosen');
    });
    $(document).on('change', '#cert_copy', function() {
        if ($(this).val().length != 0) 
            $('#conf-cert_copy').html('File chosen');
        else
            $('#conf-cert_copy').html('No file chosen');
    });



</script>  
@endsection

