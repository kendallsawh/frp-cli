@extends('layouts.app')

@section('content')
<div class="fr-dashboard">
    

@if(Auth::user()->role_id !== 9 && Auth::user()->role_id !== 7)

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <!-- other background colour: purple, yellow -->
                <div class="card-header" data-background-color="blue">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                </div>
                <div class="card-content">
                    <p class="category">Application for Farmer's Badge</p>
                    <h3 class="card-title">Application Submitted</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-tag" aria-hidden="true"></i>
                        @if(\Auth::user()->userapplication)
                        <a href="{{url('/application/view/'.\Auth::user()->userapplication->application_id)}}">View Status</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <!-- other background colour: purple, yellow -->
                <div class="card-header" data-background-color="green">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <div class="card-content">
                    <p class="category">Agricultural Incentive Programmme</p>
                    <h3 class="card-title">Coming Soon</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-tag" aria-hidden="true"></i> <a href="#">View Status</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <!-- other background colour: purple, yellow -->
                <div class="card-header" data-background-color="purple">
                    <i class="fa fa-warning" aria-hidden="true"></i>
                </div>
                <div class="card-content">
                    <p class="category">Disaster Relief Programme</p>
                    <h3 class="card-title">Coming Soon</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-tag" aria-hidden="true"></i> <a href="#" >View Status</a>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endif


</div>
@endsection

@section('scripts')
<script type="text/javascript">
    
   
</script>
@endsection

