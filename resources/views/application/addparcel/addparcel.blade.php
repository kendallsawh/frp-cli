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

            <form role="form" method="POST" action="{{ route('addParcelLand') }}" id="farmerRegForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                  
                <input type="hidden" name="applicationid" value="{{$data->id}}">
                <div class="wizard-header">
                    <h2 class="wizard-title">{{$title}}</h2>
                    <h5>Please enter your information correctly.

                    
                    @include('common.scanmsg')
                </div>
                
                <div class="wizard-navigation hidden-xs hidden-sm" id="wizard-navigation">
                    <ul>
                        <li><a href="#parcels" data-toggle="tab">Parcels</a></li>
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
                    @include('application.addparcel.parcels')
                   
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
    @include('application.addparcel.confirm')
    @include('farmer.register.tenureproof')
</div>
@endsection

@section('scripts')
    <script type="text/javascript">

    // validation
    @include('application.applicationedit.validation')

    // common scripts
    @include('farmer.common.editapplicationscripts')

 




</script>  
@endsection

