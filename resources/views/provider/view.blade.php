@extends('layouts.app')

@section('content')
<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{route('providerList')}}">Service Provider List</a></li>
        <li class="active">{{$title}}</li>
    </ul>

    <div class="row">
        <div class="card-content">

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-profile">
                                <div class="card-content text-left">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card-avatar">
                                                <a href="#">
                                                    <img class="img" src="{{$data->type == 'Individual'? $data->provider->avatar : $data->provider->logo}}" alt="Logo" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h2 class="card-title">
                                                @if($data->type == 'Individual')
                                                <a href="{{url('/individual/view')}}/{{$data->provider->id}}">
                                                    <i class="fa fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->name}}{{$data->status->status == 'Denied'? ' (Flagged)' : '('.$data->status->status.')'}}
                                                @else
                                                <a href="{{url('/organization/view')}}/{{$data->provider->id}}">
                                                    <i class="fa fa-building" aria-hidden="true" style="padding-right:10px"></i> {{$data->name}}{{$data->status->status == 'Denied'? ' (Flagged)' : '('.$data->status->status.')'}}
                                                @endif
                                                </a>
                                                <br>
                                                <small class="category text-gray">
                                                    Service Provider
                                                </small>
                                            </h2>
                                        <hr>
                                            <h5>
                                                Address
                                                <br>
                                                <small>{{$data->provider->address->address}}, {{$data->provider->county}}</small>
                                            </h5>
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <form method="POST" type = "hidden" action="{{url('/provider/assign/')}}/{{$data->id}}/{{Auth::user()->id}}" id="assign_servp_to_self" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    
                                                </form>
                                            <h3 style="margin: 0;">Actions</h3>
                                            <!-- buttons area -->
                                            <div class="row no-padding">
                                                <!--  -->
                                               <form method="POST" type = "hidden" action="{{url('/serviceprovider/application')}}/{{$data->id}}" id="get_app_pdf" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="hidden-input">
                                                        <input type="hidden" name="app_id" id="app_id" value="{{$data->id}}"/>
                                                        <input type="hidden" name="type" value="{{$data->type}}"/>
                                                    </div>
                                                </form>

                                               <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                                   
                                                    <button type="submit" class="btn btn-info btn-round btn-sm btn-block loading-modal" style="width:50%;" form="get_app_pdf" target="_blank" rel="tooltip" title="Generates pdf of the application and stores a copy">Download App... <i class="fa fa-download"></i></button>
                                                   
                                                </div>
                                        
                                              
                                                
                                                <!-- add dfo -->
                                              @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4' || Auth::user()->role_id == '5' || Auth::user()->role_id == '6')
                                                <div class="col-sm-12">
                                                    
                                                    <button type="button" class="btn btn-success btn-round btn-sm btn-block" data-toggle="modal" data-target = "#dfoModal" rel="tooltip" title="Add comments to the application">Add {{Auth::user()->role_slug === 'frc'? 'comments for DFO' : Auth::user()->role_slug}} Info   <i class="fa fa-plus-square"></i></button>
                                                </div>
                                               @endif
                                                <!-- end dfo -->
                                                <!-- status -->
                                               @if ($data->status->status !== 'Approved' && $data->status->status !== "Denied")
                                               <!--verify button  -->

                                                @if ($roleStatus == 'True')
                                                <div class="col-sm-12">
                                                    <button type="button" class="btn btn-success btn-round btn-sm btn-block" data-target="#verifyModal" data-toggle="modal" rel="tooltip" title="Moves the applications along to the next stage of the aplication process.">{{Auth::user()->role_name}} Verify <i class="fa fa-check"></i></button>
                                                </div>

                                               @endif
                                                <!-- end verify  -->
                                                <!-- assign -->
                                                @if($userAssingned === 'False' && Auth::user()->countyid == $data->reg_county)
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-success btn-round btn-sm btn-block " form="assign_servp_to_self" rel="tooltip" title="Add this application to your list of pending applications">Assign Application To Your List <i class="fa fa-check"></i></button>
                                                </div>
                                                @endif
                                                <!-- end assign  -->
                                                <!-- ao1 -->
                                                
                                                @if(Auth::user()->role_id == '6' || Auth::user()->role_id == '5')
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-info btn-round btn-sm btn-block " data-target="#assignModal" data-toggle="modal">Assign to staff<i class="fa fa-check"></i></button>
                                                </div>
                                                @endif
                                                
                                                <!-- end ao1  -->
                                                <!-- flag -->
                                                 @if(Auth::user()->countyid == $data->reg_county)
                                                <div class="col-sm-12">
                                                    
                                                    <button type="button" class="btn btn-danger btn-round btn-sm btn-block" data-toggle="modal" data-target = "#flagModal" rel="tooltip" title="Flags the current application and stores the specific details fo the flagging.">Flag <i class="fa fa-flag"></i></button>
                                                </div>
                                                @endif
                                                <!-- end flag  -->
                                                @endif
                                                
                                                
                                            </div>
                                            <!-- end button area -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content">
                                    <h3 class="card-title">Tractors</h3>
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
                                                @foreach($data->provider->tractors as $tractor)
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
                            <div class="card">
                                <div class="card-content">
                                    <h3 class="card-title">Recommendations</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <th>Farmer</th>
                                                <th>Land</th>
                                                <th>Letter Date</th>
                                                <th>Scan</th>
                                                <th>Created On</th>
                                            </thead>
                                            <tbody>
                                                @foreach($data->recommendations() as $rec)
                                                <tr>
                                                    <td>
                                                        
                                                        {{$rec->rec_name()}}
                                                        </a>
                                                    </td>
                                                    <td>{{$rec->address()}}</td>
                                                    <td>{{$rec->date}}</td>
                                                    <td><a href="{{$rec->proof}}" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> view</a></td>
                                                    <td>{{$rec->since}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                        @if(count($data->serv_prov_comments())>0)
                        <div class="col-md-12">
                            <!-- DFO -->
                            @include('provider.comments.dfocomment')
                            
                        </div>
                        @endif
                         @if(count($data->serv_prov_aa3comments())>0)
                        <div class="col-md-12">
                            <!-- AA3 -->
                            @include('provider.comments.aa3comment')
                            
                        </div>
                        @endif
                         @if(count($data->serv_prov_ao1comments())>0)
                        <div class="col-md-12">
                            <!-- AO1 -->
                            @include('provider.comments.ao1comment')
                            
                        </div>
                        @endif
                        @if(count($data->dnqdetails())>0)
                        <div class="col-md-12">
                            <!-- FLAG -->
                            
                            
                            
                        </div>
                        @endif
                    </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@include('provider.actions.spflag')
@include('provider.actions.sp_addcommentsmodal')
@include('provider.actions.sp_verificationmodal')
@include('provider.actions.sp_dfoverifymodal')
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