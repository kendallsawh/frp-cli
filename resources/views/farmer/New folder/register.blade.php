@extends('layouts.app')

@section('content')

<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb" id="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="#">Farmers</a></li>
        <li class="active">Registration</li>
    </ul>

    
    <form role="form" method="POST" action="{{ route('farmerRegisterType') }}" id="farmerRegForm" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="wizard-container " id="wizard-container">
            <div class="card wizard-card" data-color="{{config('global.colour')}}" id="wizardProfile">

                <div class="wizard-header">
                    <h2 class="wizard-title">{{$title}}</h2>
                    <h5>Please select registration type.</h5>

                    <div class="wizard-navigation hide">
                        <ul>
                            <li><a href="#type" data-toggle="tab">Application Type</a></li>
                        </ul>
                    </div>
                    <div class="tab-content reg-type-content">
                        <div class="tab-pane" id="type" target="about">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                @foreach($job_types as $type)
                                <div class="col-sm-2">
                                    <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="{{$type->tooltip}}">
                                        <input id="{{$type->slug}}" type="radio" name="type" value="{{$type->slug}}" class="form-control">
                                        <div class="icon">
                                            <i class="fa {{$type->icon}}" aria-hidden="true"></i>
                                        </div>
                                        <h6 id="label-{{$type->slug}}">{{$type->type}}</h6>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-sm-1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-footer reg-type-footer">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    // submit form
    $(document).on('click', '.choice', function() {
        $('#farmerRegForm').submit();
        $('#loadingModal').modal('show');
    });
</script>
@endsection
