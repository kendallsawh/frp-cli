@extends('layouts.app')

@section('content')

<div class="col-md-12">
    
    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        
        <li class="active">{{$title}}</li>
    </ul>
    
    <!-- Display Validation Errors -->
    <div class="col-md-12" id="errorDiv">@include('common.errors')</div>
    
    <div class="row">
        @if(Session::has('success'))
        <div class="alert alert-success">
            <strong>Notice!</strong>{{ Session::get('success') }}
            @if(Session::has('printAppNotice'))
            <b>{{Session::get('printAppNotice')}}</b>
            @endif
        </div>
        
        @endif
        @if(Session::has('warning'))
        <div class="alert alert-warning">
            <strong>Notice!</strong>{{ Session::get('warning') }}{{$data->applicant()->name}}'s application has been flagged.
            
        </div>
        
        @endif
        @if(Session::has('warning_2'))
        <div class="alert alert-warning">
            <strong>Notice!</strong>{{ Session::get('warning_2') }}
            
        </div>
        @endif
        @if(Session::has('message')) 
        <div class="alert alert-danger"> 
            {{Session::get('message')}} 
        </div> 
        @endif
        <!-- @foreach($errors->all(':message') as $message)
            <div id="form-messages" class="alert alert-danger" role="alert">
            {{ $message }}
            </div>
        @endforeach() -->
        
        <div class="card-content" style="padding-top: 40px">
            
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card card-profile">
                                
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card-avatar">
                                                <a href="#">
                                                    <img class="img" src="{{$data->applicant_type == 'Individual'? $data->applicant()->avatar : $data->applicant()->logo}}" alt="Avatar" />
                                                </a>
                                            </div>
                                            <h6 class="category text-gray" style="padding-top: 10px">{{$data->applicant_type}}</h6>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-title text-left">
                                                <h2 class="card-title">
                                                    <a href="{{$data->applicant_type == 'Individual'? url('/individual/view') : url('/organization/view')}}/{{$data->applicant()->id}}">
                                                        <i class="fa fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->name}}{{$data->status->status == 'Denied'? ' (Flagged)' : '('.$data->status->status.')'}}
                                                    </a>
                                                </h2>

                                                
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="">
                                                            <th>Enterprise <a href="" title="Edit Enterprises"  rel="tooltip"><i class="fa fa-cogs"></i></a></th>
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
                                        
                                        
                                    </div>
                                    

                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-title text-left">
                                                <h4>
                                                     <b>Currently Assigned Officer:</b> {{$data->dfoname()}}
                                                </h4>
                                                <h4>
                                                   <b>Currently Assigned AAIII:</b> {{$data->aa3name()}}
                                                </h4>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-profile">
                                <div class="card-content">
                                    <h3 class="card-title">Parcels</h3>
                                   
                                    
                                    
                                    
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="">
                                                <th>Address</th>
                                                <th>Land Type</th>
                                                <th>County</th>
                                                <th>Stated Area(size)</th>
                                                <th>Tenure</th>
                                                <th>Proof</th>
                                                <th>Type of Crop/Animal</th>
                                                <th>Specific Crop/Animal</th>
                                                <th class="text-right">Area Used</th>
                                                
                                            </thead>
                                            <tbody>
                                                @foreach($data->parcels() as $n => $parcel)
                                                <!-- if no produce found use alternate table else use normal table -->
                                                @if($parcel->produce()->count()==0)
                                                @include('application.view_table_alt')
                                                @else

                                                @foreach($parcel->produce() as $i => $produce)
                                                <tr class="{{$n % 2 == 0? 'active' : ''}}" id="parcelRow{{$parcel->id}}">
                                                    @if($i == 0)
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->land->address->address}}
                                                    </td>
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->land_type->land_type}}</td>
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->county}}</td>
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->area}}</td>
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->tenure->tenure}}</td>
                                                    <td rowspan="{{$parcel->produce_count}}">
                                                        @foreach($parcel->proofs as $proof)
                                                        
                                                        <ul class="fa-ul">
                                                            {{$proof->proof_code->proof}}
                                                             @if($proof->documents->isEmpty() &&  $proof->proof_code->id !== 34)

                                                                <b>: Missing</b>
                                                                
                                                             @endif

                                                        </ul>
                                                        @endforeach
                                                    </td>
                                                    @endif
                                                    
                                                    <td>{{$produce->type->parcel_type}}</td>
                                                    <td>{{$produce->specific_parcel}}
                                                        
                                                    </td>
                                                    <td class="text-center produce-amt" produce="{{$produce->id}}">{{number_format($produce->amt,2)}} {{$produce->type->unit->parcel_unit}}</td>
                                                    
                                                    
                                                    

                                                </tr>
                                                @endforeach
                                                @endif
                                                @endforeach
                                                
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Applications -->
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>

<!-- add slvmodal -->



@endsection

@section('scripts')

<script type="text/javascript">
    
</script>


@endsection