

<div class="modal fade" id="slvModal" tabindex="-1" role="dialog" aria-labelledby="slvModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="slvModalLabel">Request State Land Verification Investigation</h3>
            </div>
            <div class="modal-body">
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
                                                    <img class="img" src="{{$data->applicant()->avatar}}" alt="Avatar" />
                                                </a>
                                            </div>
                                        </div>
                                        <h6 class="category text-gray" style="padding-bottom: 20px">
                                                    Individual
                                                    
                                                </h6>
                                        <div class="col-md-12">
                                            <div class="card-title text-center">
                                                <h2 class="card-title"><i class="fa fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->name}}@if($data->applicant()->alias) <i>({{$data->applicant()->alias}})</i>@endif</h2>
                                                
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-3"></div> -->
                                    </div>
                                </div>
                                <form method="POST" action="{{url('/statelandverification/pdf')}}/{{$data->applicant()->id}}" id="slvsubmit_form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="hidden-input">
                                        <input type="hidden" name="parcel_id" id="parcel_id" value=""/>
                                        <input type="hidden" name="view_only" id="view_only" value="False"/>
                                    </div>
                                  </form>  
                                <div class="card-content text-left">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="description"><a href="mailto:{{$data->applicant()->email}}"><span rel="tooltip" title="Email"><i class="fa fa-fw fa-envelope" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->email}}</span></a></h5>
                                        </div>
                                       
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Age"> <i class="fa fa-fw fa-calendar" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant_type == 'Individual'? $data->applicant()->age.' years' : 'Not Applicable'}} </span></h5>
                                        </div>
                                        

                                        @if($data->applicant()->homecontact)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Home Contact"> <i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->homecontact}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->applicant()->mobilecontact)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Mobile Contact"> <i class="fa fa-fw fa-mobile" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->mobilecontact}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->applicant()->nationalid)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="National ID"> <i class="fa fa-fw fa-id-card" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->nationalid}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->applicant()->driverid)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Driver&#39;s Permit"> <i class="fa fa-fw fa-drivers-license-o" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->driverid}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->applicant()->passportid)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Passport"> <i class="fa fa-fw fa-address-book" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->passportid}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->applicant()->emergencycontact)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="Emergency Contact"> <i class="fa fa-fw fa-phone" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->emergencycontact}}</span></h5>
                                        </div>
                                        @endif

                                        @if($data->applicant()->address)
                                        <div class="col-md-4">
                                            <h5 class="description"><span rel="tooltip" title="District"> <i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant_type == 'Individual'? $data->applicant()->home()->address : $data->applicant()->address->district->district}}</span></h5>
                                        </div>
                                        @endif

                                    </div>
                                    <hr>

                                    <h5>Address of Holding</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="description">
                                                <i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i> Home
                                                <br>
                                                <small>{{$data->applicant_type == 'Individual'? $data->applicant()->home()->address : $data->applicant()->address->address}}</small>
                                            </h5>
                                        </div>
                                        @if($data->applicant_type == 'Individual')
                                        @if($data->applicant()->postal())
                                        <div class="col-md-6">
                                            <h5 class="description">
                                                <i class="fa fa-fw fa-envelope" aria-hidden="true" style="padding-right:10px"></i> Postal
                                                <br>
                                                <small>{{$data->applicant()->postal()->address}}</small>
                                            </h5>
                                        </div>
                                        @endif
                                        @endif
                                    </div>

                                    
                                </div>
                            <!-- </form> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
            
</div>
           
            <div class="modal-footer">
                <!-- <a href="{{url('/statelandverification/pdf')}}/{{$data->applicant()->id}}" type='button' id="confirm" class='btn btn-next btn-fill btn-success btn-wd' target="_blank" name='confirm'>Continue</a> -->
                <button type="submit" class="btn btn-primary" form="slvsubmit_form">Confirm</button>
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>