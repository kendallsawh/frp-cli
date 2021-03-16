@extends('layouts.app_readonly')

@section('content')
@if(Auth::guest())
<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
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
                                            <h5 class="description"><a href="mailto:{{$data->email}}"><span rel="tooltip" title="Email"><i class="fa fa-fw fa-envelope" aria-hidden="true" style="padding-right:10px"></i> {{$data->email}}</span></a></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Gender"> <i class="fa fa-fw fa-{{strtolower($data->gender->gender)}}" aria-hidden="true" style="padding-right:10px"></i>  {{$data->gender->gender}}</span></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Age"> <i class="fa fa-fw fa-calendar" aria-hidden="true" style="padding-right:10px"></i> {{$data->age}} years</span></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Created On"> <i class="fa fa-fw fa-clock-o" aria-hidden="true" style="padding-right:10px"></i> {{$data->since}} <small><i>by {{$data->createdBy->name}}</i></small></span></h5>
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
                                            <h5 class="description"><span rel="tooltip" title="National ID"> <i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i><a href="{{$data->nationaliddoc}}" target="_blank">{{$data->nationalid}}</a> </span></h5>
                                        </div>
                                        @endif

                                        @if($data->driverid)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Driver&#39;s Permit"> <i class="fa fa-fw fa-drivers-license-o" aria-hidden="true" style="padding-right:10px"></i> {{$data->driverid}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->passportid)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Passport"> <i class="fa fa-fw fa-address-book" aria-hidden="true" style="padding-right:10px"></i><a href="{{$data->passportiddoc}}" target="_blank">{{$data->passportid}}</a> </span></h5>
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
                            @if($data->farmer())
                            @if($data->farmer()->badge())
                            <div class="card">
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <th class="text-center">Farmer #</th>
                                                <th>Badge</th>
                                                <th>Status</th>
                                                <th>Expiry Date</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                            </thead>
                                            <tbody>
                                                <tr class="{{$data->farmer()->badge()->expired? 'danger' : $data->farmer()->badge()->table_class}}">
                                                    <td class="text-center">{{$data->farmer()->id}}</td>
                                                    <td>{{$data->farmer()->badge()->farmer_badge}}</td>
                                                    <td>{{$data->farmer()->badge()->status}}</td>
                                                    <td>{{$data->farmer()->badge()->expiry_date}}</td>
                                                    <td>{{$data->farmer()->badge()->created_at}}</td>
                                                    <td>{{$data->createdBy->name}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endif

                            <!-- Applications -->
                            
                            <div class="card">
                                <div class="card-content">
                                    <h3 class="card-title">{{$appcount <= 0? 'No ': ''}}Parcel holdings {{$appcount <= 0? 'data found.' : ''}} {{empty($data->provider)? '' : 'This farmer may have been migrated from the NAMIS database(pre 2015 information)'}}</h3>

                                    @if($appcount >=1)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <th class="text-center hide">No</th>
                                                <th >Type</th>
                                                <th>Previous Badge Number</th>
                                                <th>Status</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th class="text-center"><i class="fa fa-cogs"></i></th>
                                            </thead>
                                            <tbody>
                                                @foreach($applications as $app)
                                                <tr>
                                                    <td class="text-center hide">{{$app->id}}</td>
                                                    <td >{{$app->type->application_type == 'Unknown'? $app->type->application_type.'(Please update information)' :$app->type->application_type}}</td>
                                                    <td>{{$app->applicant()->farmer()? ($app->applicant()->farmer()->badge()? $app->applicant()->farmer()->badge()->old_badge_id : 'N/A') : 'N/A'}}</td>
                                                    <td>{{$app->status->status}}</td>
                                                    <td>{{$app->createdOn}}</td>
                                                    <td>{{$app->createdBy->name}}</td>
                                                    <td class="td-actions text-center">

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                        @endif
                                    </div>
                                </div>


                            <!-- Enterprises -->
                            @if($data->enterprises()->count())
                            <div class="card">
                                <div class="card-content">
                                    <h3 class="card-title">Enterprises
                                    </h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <th>Enterprise</th>
                                                <th>Type</th>
                                            </thead>
                                            <tbody>
                                                @foreach($data->enterprises() as $ent)
                                                <tr>
                                                    <td>{{$ent->enterprise}}</td>
                                                    <td>{{$ent->type}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Tractors -->
                            @if($data->tractors->count())
                            <div class="card">
                                <div class="card-content">
                                    <h3 class="card-title">Service Provider Tractors <a href="{{url('/provider/view/'.$data->provider->id)}}" class="btn btn-sm btn-round btn-success">View Service Provider Information</a></h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <th>Registration Number</th>
                                                <th>Chassis Number</th>
                                                <th>Certified Copy</th>
                                                <th>Status</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                            </thead>
                                            <tbody>
                                                @foreach($data->tractors as $tractor)
                                                <tr>
                                                    <td>{{$tractor->registration_num}}</td>
                                                    <td>{{$tractor->chassis_num}}</td>
                                                    <td><a href="{{$tractor->cert}}" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> view</a></td>
                                                    <td>{{$tractor->status->status}}</td>
                                                    <td>{{$tractor->since}}</td>
                                                    <td>{{$tractor->createdBy->name}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="parcelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Parcels</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <th>Address</th>
                            <th>Land Type</th>
                            <th>County</th>
                            <th>Area</th>
                            <th>Tenure</th>
                            <th>Proof</th>
                            <th>Type of Crop/Animal</th>
                            <th>Specific Crop/Animal</th>
                            <th class="text-right">Amount</th>
                        </thead>
                        <tbody>
                            @foreach($data->parcels() as $n => $parcel)
                            @foreach($parcel->produce() as $i => $produce)
                            <tr class="{{$n % 2 == 0? 'active' : ''}}">
                                @if($i == 0)
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->land->address->address}}</td>
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->land_type->land_type}}</td>
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->county}}</td>
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->area}}</td>
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->tenure->tenure}}</td>
                                <td rowspan="{{$parcel->produce_count}}">
                                    @foreach($parcel->proofs as $proof)
                                    {{$proof->proof_code->proof}}
                                    <ul>
                                        @foreach($proof->documents as $doc)
                                        @if($doc)
                                        <li><a href="{{$doc->document}}" target="_blank">{{$doc->type}}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    @endforeach
                                </td>
                                @endif

                                <td>{{$produce->type->parcel_type}}</td>
                                <td>{{$produce->specific_parcel}}</td>
                                <td class="text-right">{{number_format($produce->amt)}} {{$produce->type->unit->parcel_unit}}</td>
                            </tr>
                            @endforeach
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

