@extends('layouts.app')

@section('content')

<div class="col-md-12">
    
    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{route('applicationList')}}">Application List</a></li>
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
                                                        <i class="fa fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->name}}{{$data->status->status == 'Denied'? ' (Flagged)' : '('.$data->status->status.')'}}{{$data->untenanted==1?($stateland == 1? '(Untenanted)': ''):''}}
                                                    </a>
                                                </h2>

                                                @if($data->old_registration_num)
                                                <h5  class="card-title">Registration Number: {{$data->old_registration_num}}</h5>
                                                @endif
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
                                        <div class="col-md-3">

                                            <h3 style="margin: 0;">Actions</h3>
                                            <!-- buttons area -->
                                            <div class="row no-padding">
                                                <!--  -->
                                                @if($data->application_document === null )
                                                    <form method="POST" type = "hidden" action="{{url('/statelandverification/application')}}/{{$data->applicant()->id}}" id="get_app_pdf" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="hidden-input">
                                                            <input type="hidden" name="app_id" id="app_id" value="{{$data->id}}"/>
                                                            <input type="hidden" name="type" value="{{$data->applicant_type}}"/>
                                                        </div>
                                                    </form>
                                                @endif
                                                <!--  -->
                                                <form method="POST" type = "hidden" action="{{route('appAssignToSelf')}}" id="assign_app_to_user" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="hidden-input">
                                                            <input type="hidden" name="app_id" id="app_id" value="{{$data->id}}"/>
                                                            <input type="hidden" name="userid" value="{{Auth::user()->id}}"/>
                                                    </div>
                                                </form>

                                               <!--grant access if parcel's county is same as user's county and user role is dfo OR the application's registering county is same as user's county -->
                                               <!--grant access  -->
                                                @if($grantAccess)
                                                <!-- application pdf button -->
                                                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                                        @if($document_exist)
                                                        
                                                            <a href="{{$data->documents->document}}" target="_blank" type='button' id="confirm" class='btn btn-info btn-round btn-sm btn-block ' rel="tooltip"  title="Retrieves most recent uploaded copy" style="width:50%;">Download App... <i class="fa fa-download"></i></a>
                                                        
                                                        
                                                        @elseif($generate_app)
                                                            <button type="submit" class="btn btn-info btn-round btn-sm btn-block loading-modal-dismiss" style="width:50%;" form="get_app_pdf" target="_blank" rel="tooltip" title="Generates pdf of the application form">Generate App... <i class="fa fa-download"></i></button>
                                                        @endif
                                                        @if($uploadform)
                                                            <button type="button" class="btn btn-primary btn-round btn-sm btn-block" data-toggle="modal" data-target = "#uploadApplication" style="width:50%;">Upload Application Form <i class="fa fa-upload"></i></button>
                                                        @endif
                                                    </div>
                                              
                                                
                                                    <!-- add dfo -->
                                                    @if(Auth::user()->role_id == '1' || Auth::user()->role_id == '4' || Auth::user()->role_id == '5' || Auth::user()->role_id == '6')
                                                        <div class="col-sm-12">
                                                            
                                                            <button type="button" class="btn btn-success btn-round btn-sm btn-block" data-toggle="modal" data-target = "#dfoModal" rel="tooltip" title="Add comments to the application">Add {{Auth::user()->role_slug === 'frc'? 'comments for DFO' : Auth::user()->role_slug}} Comment   <i class="fa fa-plus-square"></i></button>
                                                        </div>
                                                    @endif

                                                    <!-- end dfo -->
                                                    <!-- status -->
                                                    
                                                    @if ($data->status_id !== 6 && $data->status_id !== 7)
                                                    <!--verify button  -->

                                                       @if ($frc_dfo_recommend)
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-success btn-round btn-sm btn-block" data-target="#dfoVerifyModal" data-toggle="modal" rel="tooltip" title="Moves the applications along to the next stage of the aplication process.">Stateland/Field Officer Recommend <i class="fa fa-check"></i></button>
                                                            </div>

                                                        @elseif($normal_recommend)
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-success btn-round btn-sm btn-block" data-target="#verifyModal" data-toggle="modal" rel="tooltip" title="Move the applications along to the next stage of the aplication process.">{{Auth::user()->role_name}} Recommend <i class="fa fa-check"></i></button>
                                                            </div>
                                                        @endif
                                                        <!-- end verify  -->
                                                        <!-- assign -->
                                                        @if($userAssingned === 'False' && Auth::user()->county == $data->applicant()->county)
                                                            <div class="col-sm-12">
                                                                <button type="submit" class="btn btn-success btn-round btn-sm btn-block " form="assign_app_to_user" rel="tooltip" title="Add this application to your list of pending applications">Assign Application To Your List <i class="fa fa-check"></i></button>
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
                                                        @if(Auth::user()->county == $data->applicant()->county || $grantAccess == True)
                                                            <div class="col-sm-12">
                                                                
                                                                <button type="button" class="btn btn-danger btn-round btn-sm btn-block" data-toggle="modal" data-target = "#dnqModal" rel="tooltip" title="Disqualifies the current application and stores the specific details for the disqualification.">Disqualify Application <i class="fa fa-file-excel-o"></i></button>
                                                            </div>

                                                            <!-- send back -->
                                                            
                                                            <div class="col-sm-12">
                                                                
                                                                @if($data->status_id != 7 )
                                                                @if($showflag)
                                                                <button type="button" class="btn-warning btn-round btn-sm btn-block btn" data-toggle="modal" data-target = "#flagModal" rel="tooltip" title="Flags the current application and pauses the verification proccess until the matter is resolved.">Flag Application <i class="fa fa-flag"></i></button>
                                                                @endif
                                                                @endif
                                                            </div>
                                                            
                                                        @endif
                                                    <!-- end flag  -->
                                                    @elseif($data->status_id == 6 && Auth::user()->role_id == 1)
                                                        <button type="button" class="btn-warning btn-round btn-sm btn-block btn" data-toggle="modal" data-target = "#resetModal" rel="tooltip" title="Sets the current application status to pending, only if current status is approved">Reset Application Status<i class="fa fa-flag"></i></button>
                                                    @endif
                                                @elseif($aa3access)
                                                @include('application.application_action.aa3actions')
                                                @endif
                                                
                                            </div>
                                            <!-- end button area -->
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-title text-left">
                                                <h4>
                                                    <b>

                                                        @if($outofcounty == 'True' && $oocverified == 'False')
                                                        @if(Auth::user()->county_id == $data->registering_county)
                                                        This application has holdings in another County and may not move forward until verification is completed by the County the holdings is located in.
                                                        @else
                                                        This application has holdings in a County outside of it's registering County of {{\App\Counties::find($data->registering_county)->county}}.
                                                        @endif
                                                        @endif
                                                    </b>
                                                </h4>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-profile">
                                <div class="card-content">
                                    <h3 class="card-title">Parcels</h3>
                                   
                                    
                                    @if(Auth::user()->role_id == '1')
                                    <a href="{{url('/application/addparcel')}}/{{$data->id}}" type="button" id="addparcel" class="btn btn-success btn-round btn-sm" name="addparcel">Add Parcel</a>
                                    @endif
                                    @if($dfo_assigned !== '')
                                    <h5> <ul><li><p class="text-warning  text-left">{{$dfo_assigned}}</p></li></ul></h5>
                                    @endif
                                    @if($missingDoc === 'False')
                                    <h5><ul><li> <p class="text-warning text-left">Warning: This application is missing scanned documents required to move forward in the registration process. Please gather the required documents before attempting to continue.</p></li></ul></h5>
                                        @if($data->app_type_id == 9 || $data->app_type_id == 10 || $data->app_type_id == 11 || $data->app_type_id == 12)
                                        <h6><ul><li><p class="text-warning  text-left">Notice, the application may be missing a Stateland Verification Form. If this is incorrect then ignore this warning only.</p></li></ul></h6>
                                        @endif
                                    @endif
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
                                                <th class="text-center">Actions</th>
                                            </thead>
                                            <tbody>
                                                @foreach($data->eagerparcels as $n => $parcel)
                                                <!-- if no produce found use alternate table else use normal table -->
                                                @if($parcel->produce()->count()==0)
                                                @include('application.view_table_alt')
                                                @else

                                                @foreach($parcel->eagarproduce as $i => $produce)
                                                <tr class="{{$n % 2 == 0? 'active' : ''}}" id="parcelRow{{$parcel->id}}">
                                                    @if($i == 0)
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->land->address->address}}

                                                    </td>
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->land_type->land_type}}</td>
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->land->address->district->ward->county->county}}</td>
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->area}}</td>
                                                    <td rowspan="{{$parcel->produce_count}}">{{$parcel->tenure->tenure}}</td>
                                                    <td rowspan="{{$parcel->produce_count}}">
                                                        @foreach($parcel->proofs as $proof)
                                                        
                                                        <ul class="fa-ul">
                                                            {{$proof->proof_code->proof}}
                                                             @if($proof->documents->isEmpty() &&  $proof->proof_code->id !== 34)
                                                                <b>: Missing</b>
                                                             
                                                             @else
                                                             @endif

                                                            @if($proof->documents->isEmpty() && $parcel->CaroniState && $proof->proof_code->id === 34)
                                                            
                                                            
                                                            <form method="POST" type = "hidden" action="{{url('/statelandverification/pdf')}}/{{$data->applicant()->id}}" id="view_slv" enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="hidden-input">
                                                                    <input type="hidden" name="parcel_id" id="parcel_id" value="{{$parcel->id}}"/>
                                                                    <input type="hidden" name="view_only" id="view_only" value="False"/>
                                                                </div>
                                                            </form>
                                                            <li><span class="fa-li"><i class="fas fa-check-square"></i></span><button type="submit" class="btn btn-warning btn-round btn-xs btn-block loading-modal" form="view_slv" target="_blank">Generate Appendix C <i class="fa fa-file-text"></i></button></li>
                                                            @endif
                                                            @foreach($proof->documents as $doc)
                                                            

                                                                @if($doc && (Auth::user()->county == $parcel->county))
                                                                    <li><span class="fa-li"><i class="fa fa-check-square"></i></span><a href="{{$doc->document}}" target="_blank" type='button' id="confirm" class='btn btn-success btn-round btn-xs btn-block'>{{$doc->type}}</a></li>
                                                                @elseif($doc && (Auth::user()->countyid == $data->registering_county))
                                                                    <li><span class="fa-li"><i class="fa fa-check-square"></i></span><a href="{{$doc->document}}" target="_blank" type='button' id="confirm" class='btn btn-success btn-round btn-xs btn-block'>{{$doc->type}}</a></li>
                                                                @elseif($doc && (Auth::user()->role_id == 11 || Auth::user()->role_id == 7))
                                                                    <li><span class="fa-li"><i class="fa fa-check-square"></i></span><a href="{{$doc->document}}" target="_blank" type='button' id="confirm" class='btn btn-success btn-round btn-xs btn-block'>{{$doc->type}}</a></li>
                                                                @endif
                                                            
                                                            
                                                            @endforeach
                                                        </ul>
                                                        @endforeach
                                                    </td>
                                                    @endif
                                                    
                                                    <td>{{$produce->type->parcel_type}}</td>
                                                    <td>{{$produce->specific_parcel}}</td>
                                                    <td class="text-center">{{number_format($produce->amt,2)}} {{$produce->type->unit->parcel_unit}}</td>
                                                    
                                                    
                                                    @if($i == 0)
                                                    <td rowspan="{{$parcel->produce_count}}" class="text-center">

                                                        @if(Auth::user()->countyid == $data->registering_county)
                                                        <a href="{{url('/application/cropmonitor')}}/{{$parcel->id}}" type="button" id="cropMonitor" class="btn btn-success btn-round btn-sm" name="cropMonitor">Add Crop Monitoring <i class="fa fa-pencil"></i></a>
                                                        @endif
                                                        @if($parcel->maplink)
                                                            <a href="{{$parcel->maplink}}" type="button" target="_blank" id="cropMonitor" class="btn btn-success btn-round btn-sm" name="cropMonitor">View Map <i class="fa fa-pencil"></i></a>
                                                        @endif
                                                       <!-- if parcel in county -->
                                                        @if(Auth::user()->county == $parcel->county)
                                                        
                                                            @if ($data->status->status !== 'Denied')
                                                                @if($parcel->CaroniState)

                                                                    <!-- GIS  -->
                                                                        @if($parcel->parcel_verification())
                                                                            @if($parcel->parcel_verification()->gis_link())
                                                                                    <a href="{{$parcel->parcel_verification()->gis_link()->link}}" type="button" id="reference" class="btn btn-success btn-round btn-sm" name="reference" target="_blank" >View Parcel</a>
                                                                            @endif
                                                                        @endif
                                                                    <!-- end GIS -->
                                                                    <!--  if slv document already exists dont show-->

                                                                        
                                                                        <!-- if slv documents does not exists and status is pending -->
                                                                        @if ($data->status_id <= 2 && $slvCompleted == 0)
                                                                            
                                                                                    <button type="button" id="slv_{{$parcel->id}}" name="slv_complete" data-field="{{$parcel->id}}" class="slv_complete btn btn-success btn-round btn-xs btn-block" data-toggle="modal" data-target = "#completeSlvModal">Complete SLV <i class="fa fa-check"></i></button>
                                                                                    <input type="hidden" name="hidden_parcel_value" value="{{$parcel->id}}">

                                                                        @endif
                                                                    <!-- end slv document -->
                                                                    <!-- if uprn does not exist -->
                                                                        @if($data->parcel_uprn === null )
                                                                                <button type="button" class="btn btn-success btn-round btn-sm btn-block" data-toggle="modal" data-target = "#uprnsModal">Add UPRN/UPRS <i class="fa fa-plus"></i></button>
                                                                        @endif
                                                                    <!-- end if uprn -->
                                                                
                                                                @endif
                                                                <!-- end if caronistate -->
                                                                    @if(Auth::user()->role_id === 1 && (Auth::user()->countyid == $parcel->CountyId))
                                                                            <a href="{{url('/application/edit')}}/{{$data->id}}/{{$parcel->id}}" type="button" id="editParcel" class="btn btn-success btn-round btn-sm btn-block" name="editParcel">Edit Parcel <i class="fa fa-pencil"></i></a>
                                                                    @endif
                                                           
                                                            
                                                            
                                                            @endif
                                                        @elseif(Auth::user()->county_id == $data->registering_county)
                                                            @if(Auth::user()->role_id == 1)
                                                                <a href="{{url('/application/edit')}}/{{$data->id}}/{{$parcel->id}}" type="button" id="editParcel" class="btn btn-success btn-round btn-sm btn-block" name="editParcel">Edit Parcel <i class="fa fa-pencil"></i></a>
                                                            @endif
                                                        
                                                        @endif

                                                        
                                                        <!-- end if in user county -->
                                                        @if(Auth::user()->county_id == 8 && Auth::user()->role_id !== 6)
                                                            <!-- <button type="button" class="btn btn-success btn-round btn-sm btn-block" action="{{route('force')}}" rel="tooltip" title="Move the applications up to the AO1 of the aplication process.">Fasttrack Recommend <i class="fa fa-check"></i></button> -->
                                                            <a href="{{url('/application/force')}}/{{$data->id}}" type="button" class="btn btn-success btn-round btn-sm" rel="tooltip" title="Move the applications up to the AO1 of the aplication process.">Fasttrack Recommend <i class="fa fa-check"></i></a>
                                                            
                                                        @endif
                                                    </td>
                                                    
                                                    @endif

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
                                    <div class="pull-right hide">
                                        <button type='button' class='btn btn-next btn-fill btn-danger btn-wd'>Cancel</button>
                                        <button type='button' id="confirm" class='btn btn-fill btn-success btn-wd'>Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(count($data->eagercomments)>0)
                        <div class="col-md-12">
                            <!-- DFO -->
                            @include('farmer.common.dfocomment')
                            
                        </div>
                        @endif
                         @if(count($data->parcelaa3comments())>0)
                        <div class="col-md-12">
                            <!-- AA3 -->
                            @include('farmer.common.aa3comment')
                            
                        </div>
                        @endif
                         @if(count($data->parcelao1comments())>0)
                        <div class="col-md-12">
                            <!-- AO1 -->
                            @include('farmer.common.ao1comment')
                            
                        </div>
                        @endif
                        @if(count($data->dnqdetails())>0)
                        <div class="col-md-12">
                            <!-- FLAG -->
                            
                            @include('application.dnq.dnqdetails')
                            
                        </div>
                        @endif
                        @if(count($data->flagdetails())>0)
                        <div class="col-md-12">
                            <!-- FLAG -->
                            
                            @include('application.flag.flagdetails')
                            
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

<!-- add slvmodal -->
@include('common.loading_modal_dismiss')
@include('application.statelandverification.view')
@include('application.recommendationdata.districtofficermodal')
@if($data->parcels()->first())
@include('application.statelandverification.modalcompleteslv')
@endif
@include('application.parceluprns.uprnsmodal')
@include('application.userassignmodal')
@include('application.modaluploadapp')
@include('application.dnq.dnq')
@include('application.flag.flag')
@include('application.resetappstatus.resetapp')
@include('application.verification.verificationmodal')
@if((Auth::user()->role_id == 4 || Auth::user()->role_id == 1) && $roleStatus == 'True')
@include('application.verification.dfoverifymodal')
@endif
@endsection

@section('scripts')

<script type="text/javascript">
    
    
    // $(document).ready(function() {    
    //     $('#input-director-add').bind('click', function() {
    //         alert("test");
    //     });
    // });
    //Date Pickers
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 1,
        endDate: "now()",
        color: 'green',
        autoclose: true,
        startView: 2
    });
    
    function flagChk() {
        var chk = confirm('Flag this application?');
        if (!chk) {return false}
    }
    
    $(document).on('change', '[name="recommend"]', function() {
        var val = $(this).val();
        var parcel = $(this).attr('parcel');
        //alert(parcel);
        if (val === 'yes') {
            $('#parcelRow'+parcel+' > td').removeClass('danger');
            // ajax to change parcel status
            success('Parcel recommended successfuly.');
            }else{
            $('#parcelRow'+parcel+' > td').addClass('danger');
            // ajax to change parcel status
            success('Parcel not recommended successfuly.');
        }
    });    
    
    $(document).on('click', '.open-slvdialog', function () {
        var parcelID = $(this).data('id');
        $('.hidden-input #parcel_id').val(parcelID);
    });

    $(document).on('click', '.slv_complete', function () {
        var parcelID = $(this).attr('data-field');
        $("input[name='modal_parcel_id']").val(parcelID);
    });
    
    

    $('#uploadCheck').on('change',function(){
     $("#confirmVerify").attr("form","verify_form") ; 
     $("#confirmVerify").removeClass("disabled") ; 
     
        
    });


    $(document).ready(function(){ 
        var user = {!!auth()->user()->role_id!!};
        if(user !== 1 && user !== 6){
            
            $("#confirmVerify").removeClass("disabled");
            $("#uploadCheckLabel").addClass("hidden");
            $("#confirmVerify").attr("form","verify_form");
            $("#noticeText").addClass("hidden");
            $("#noticeText2").removeClass("hidden");
            
        }
     });

    //fill recommend modal with a checkleist of items planted o the land
    /*AJAX*/
    $('#dfo_parcel').on('change',function(){
       //alert( $(this).val());
        $.get("{{URL::to('/producelist')}}/".concat($(this).val()),function(data){
           $('#checklist').empty().html(data);
        })
    })
  
    @if(Session::has('fail'))
    setTimeout(function(){  $('#flagModal').modal('show'); }, 500);
   
    @endif
    
    @if(Session::has('useradded'))
    setTimeout(function(){ $('#assignModal').modal('show'); }, 500);
    
    @endif


</script>


@endsection