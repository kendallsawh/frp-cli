@extends('layouts.app')

@section('content')

<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
       
        <li class="active">{{$title}}</li>
    </ul>
    @if(Session::has('success'))
        <div class="alert alert-success">
            <strong>Notice!</strong>{{ Session::get('success') }}
            
        </div>
        
        @endif
        @if(Session::has('message')) 
        <div class="alert alert-danger"> 
            <strong>Notice!</strong> {{Session::get('message')}} 
        </div> 
        @endif
    <div class="row">
        <div class="card-content" style="padding-top: 40px">

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-profile">

                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card-avatar">
                                                <a href="#">
                                                    <img class="img" src="{{$data->avatar}}" alt="Avatar" />
                                                    <!-- <img class="img" src="{{$data->avatar}}" alt="Avatar" /> -->
                                                    
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-title text-left">
                                                <h2 class="card-title"><i class="fa fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->name}}@if($data->alias) <i>({{$data->alias}})</i>@endif</h2>
                                                
                                                
                                                <h6 class="category text-gray" style="padding-bottom: 20px">
                                                    Individual
                                                    <!-- Button to trigger modal -->
                                                    
                                                    
                                                    @if($data->parcelsCount())
                                                        <button type="button" class="btn btn-success btn-round btn-sm" data-toggle="modal" data-target="#parcelModal">View Parcels</button>
                                                    @else
                                                        <button type="button" class="btn btn-default btn-round btn-sm">No Parcels</button>
                                                    @endif
                                                    
                                                    
                                                    
                                                </h6>
                                                
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-3"></div> -->
                                    </div>
                                </div>
                                
                                <div class="card-content text-left">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Email"><i class="fa fa-fw fa-envelope" aria-hidden="true" style="padding-right:10px"></i> {{$data->email}}</span></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Gender"> <i class="fa fa-fw fa-{{strtolower($data->gender->gender)}}" aria-hidden="true" style="padding-right:10px"></i>  {{$data->gender->gender}}</span></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Age"> <i class="fa fa-fw fa-calendar" aria-hidden="true" style="padding-right:10px"></i> {{$data->age}} years</span></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Created On"> <i class="fa fa-fw fa-clock-o" aria-hidden="true" style="padding-right:10px"></i> {{$data->since}}</span></h5>
                                        </div>

                                        @if($data->homecontact)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Home Contact"> <i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i> {{$data->homecontact}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->mobilecontact)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Mobile Contact"> <i class="fa fa-fw fa-mobile" aria-hidden="true" style="padding-right:10px"></i> {{$data->mobilecontact}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->nationalid)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="National ID"> <i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i>{{$data->nationalid}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->driverid)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Driver&#39;s Permit"> <i class="fa fa-fw fa-drivers-license-o" aria-hidden="true" style="padding-right:10px"></i> {{$data->driverid}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->passportid)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Passport"> <i class="fa fa-fw fa-address-book" aria-hidden="true" style="padding-right:10px"></i>{{$data->passportid}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->emergencycontact)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Emergency Contact"> <i class="fa fa-fw fa-phone" aria-hidden="true" style="padding-right:10px"></i> {{$data->emergencycontact}}</span></h5>
                                        </div>
                                        @endif

                                    </div>
                                    <hr>

                                    <h5>Address</h5>

                                    <div class="row">
                                        <div class="{{$data->postal()? 'col-md-6' : 'col-md-12'}}">
                                            <h5 class="">
                                                <i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i> Home
                                                <br>
                                                {{$data->home()->address}}
                                            </h5>
                                        </div>

                                        @if($data->postal())
                                        <div class="col-md-6">
                                            <h5 class="description text-black">
                                                <i class="fa fa-fw fa-envelope" aria-hidden="true" style="padding-right:10px"></i> Postal
                                                <br>
                                                {{$data->postal()->address}}
                                            </h5>
                                        </div>
                                        @endif
                                    </div>

                                    <a href="#" class="btn btn-success btn-round hide">Follow</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- Badge -->
                            @include('farmer.common.badge')

                            <!-- Applications -->
                            @include('farmer.common.applications')

                            <!-- Enterprises -->
                            @include('farmer.common.enterprises')

                            <!-- Tractors -->
                            @include('farmer.common.tractors')

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Parcels Modal -->


@include('farmer.common.parcelmodal')


@endsection

@section('scripts')
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 1,
        endDate: "now()",
        color: 'green',
        autoclose: true,
        startView: 2
    });

    function transferChk() {
        var chk = confirm('Are you certain of transfering this Farmer?');
        if (!chk) {return false}
    }
    function renewChk() {
        var chk = confirm('Renew badge?');
        if (!chk) return false;
    }

    function replaceChk() {
        var chk = confirm('Replace badge?');
        if (!chk) return false;
    }

    $(document).on('change', '.type', function() {
        var val = $(this).val();
        if (val == '1') 
            $('#police_report_div').removeClass('hide');
        else
            $('#police_report_div').addClass('hide');
    });

    @if (session('fail'))
    $('#replaceModal').modal('show');
    @endif
   
</script>
@endsection