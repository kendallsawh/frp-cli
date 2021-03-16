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
                    Generated data for County Victoria.</b>
                </div>
            </div>
        </div>  
    </div>
@if(Auth::user()->countyid == 9)
    <div class="row">
        
        <div class="col-lg-5 col-md-6 col-sm-6">
            
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <div class="card-content">
                    <p class="category">Joint Select Committee on Land and Physical Infrastructure Report</p>
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-footer  text-center">
                    <div class="stats">
                        <a href="{{asset($path)}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> View Document Report</a>
                        <!-- <i class="fa fa-tag" aria-hidden="true"></i> <a href="{{url('/application/list/approved')}}">View NAMIS List</a> -->
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endif   

</div>



<!-- <div class="row ">
    <div class="col-lg-12 col-md-12 col-sm-12" >
        <div class="card">



        </div>
    </div>

</div> -->



@endsection

@section('scripts')

@endsection

