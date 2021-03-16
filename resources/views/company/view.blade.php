@extends('layouts.app')

@section('content')
<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{route('organizationList')}}">Organization List</a></li>
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
                                                    <img class="img" src="{{$data->logo}}" alt="Logo" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-title text-left">
                                                <h1 class="card-title"><i class="fa fa-building" aria-hidden="true" style="padding-right:10px"></i> {{$data->name}}</h1>
                                                @if(Auth::user()->county == $data->county)
                                                <h4 class="category text-gray" style="padding-left: 100px"><small><i><a href="{{url('/company/edit')}}/{{$data->id}}" >edit company data</a></i></small></h4>
                                                @endif
                                                <h6 class="category text-gray" style="padding-bottom: 20px">
                                                    Organization

                                                    <!-- Button to trigger modal -->
                                                    @if($data->parcelsCount())
                                                    <button type="button" class="btn btn-success btn-round btn-sm" data-toggle="modal" data-target="#parcelModal">View Parcels</button>
                                                    @else
                                                    <button type="button" class="btn btn-default btn-round btn-sm">No Parcels</button>
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-content text-left">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Organization Type"><i class="material-icons" aria-hidden="true" style="padding-right:10px">business_center</i> {{$data->organization_type}}</span></h5>  
                                        </div>

                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Registration Number"><i class="fa fa-hashtag fa-lg" aria-hidden="true" style="padding-right:10px"></i> {{$data->registration_num}}</span></h5> 
                                        </div>

                                        <div class="col-md-4">   
                                            <h5 class="description"><span rel="tooltip" title="VAT Number"><i class="fa fa-hashtag fa-lg" aria-hidden="true" style="padding-right:10px"></i> {{$data->vat_reg_num}}</span></h5> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Email"><i class="fa fa-fw fa-envelope" aria-hidden="true" style="padding-right:10px"></i> {{$data->email}}</span></h5>  
                                        </div>

                                        <div class="col-md-4">                                 
                                            <h5 class="description"><span rel="tooltip" title="Created On"> <i class="fa fa-fw fa-clock-o" aria-hidden="true" style="padding-right:10px"></i> {{$data->since}} <small><i>by {{$data->createdBy->name}}</i></small></span></h5>
                                        </div>

                                        @if($data->contact_id)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Home Contact"> <i class="fa fa-fw fa-phone" aria-hidden="true" style="padding-right:10px"></i> {{$data->contact->contact}}</span></h5>
                                        </div>
                                        @endif
                                    </div>

                                    <hr>

                                    <h5>Business Address</h5>

                                    <h5 class="description">
                                        <i class="fa fa-fw fa-map-marker" aria-hidden="true" style="padding-right:10px"></i> {{$data->address->address}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- Badge -->
                            @include('farmer.common.badge')

                            <div class="card">
                                <div class="card-content">
                                    <h3 class="card-title">
                                        Representatives
                                    </h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <th>Picture</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>ID</th>
                                                <th>Created On</th>
                                                <th class="text-center"><i class="fa fa-cogs"></i></th>
                                            </thead>
                                            <tbody>
                                                @forelse($data->reps as $rep)
                                                <tr class=" ">
                                                    <td><img class="img-thumbnail" src="{{$rep->avatar}}" alt="Avatar" style="max-width: 100px;max-height: 100px;"></td>
                                                    <td>{{$rep->name}}</td>
                                                    <td>{{$rep->contact}}</td>
                                                    <td>{{$rep->identification}}</td>
                                                    <td>{{$rep->since}}</td>
                                                    <td class="td-actions text-center">
                                                        <a href="{{url('/company/companyedit/companyrep/edit')}}/{{$rep->id}}/{{$data->id}}" rel="tooltip" class="btn btn-success" data-original-title="Edit Representative" title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

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