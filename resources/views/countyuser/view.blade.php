@extends('layouts.app')

@section('content')

<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Function</a></li>
        <li><a href="{{route('individualList')}}">View Profile</a></li>
        <li class="active">{{$title}}</li>
    </ul>

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
                                                    <img class="img" src="{{$user->avatar}}" alt="Avatar" />
                                                   
                                                    
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-title text-left">
                                                <h2 class="card-title"><i class="fa fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$user->name}}</h2>
                                               
                                                
                                                
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-3"></div> -->
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                          
                            <!-- Applications -->
                            @include('countyuser.applications')

                          
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

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

</script>
@endsection