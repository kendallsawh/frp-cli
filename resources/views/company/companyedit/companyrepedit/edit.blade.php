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

            <form role="form" method="POST" action="{{ route('organizationRepEditInsert') }}" id="farmerRegForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="repid" value="{{$rep->id}}"/>
                <div class="wizard-header">

                    <h2 class="wizard-title">{{$title}}</h2>
                    <h5>Please enter your information correctly.

                    <!-- delete this button -->
                    <br><button class="btn btn-success loading-modal hide">test post</button></h5>
                    @include('common.scanmsg')

                </div>
                
                <div class="wizard-navigation hidden-xs hidden-sm" id="wizard-navigation">
                    <ul>
                        
                        <li><a href="#reps" data-toggle="tab">Representatives</a></li>
                        
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
                    
                    @include('company.companyedit.companyrepedit.editreps')
                    

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
    @include('company.companyedit.companyrepedit.confirm')

</div>
@endsection

@section('scripts')
<script type="text/javascript">

   

    // validation
    @include('company.companyedit.companyrepedit.validation')

    // common scripts
    @include('company.companyedit.companyrepedit.scripts')

    // change confirm avatars
    $(".fileinput").on("change.bs.fileinput", function(){
        $('#conf-avatar1').attr('src',$('.avatar1 img').attr('src'));
        $('#conf-avatar2').attr('src',$('.avatar2 img').attr('src'));
    });

</script>  
@endsection

