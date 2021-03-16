<div class="modal fade" id="completeSlvModal" tabindex="-1" role="dialog" aria-labelledby="completeSlvModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="completeSlvModalLabel">Complete State Land Verificsation Form</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="card-content" style="padding-top: 40px">

                        <div class="content">
                            <div class="container-fluid">
                                <form method="POST" action="{{route('completeSLV')}}" id="completeSlv_form"  enctype="multipart/form-data">
                                    <input type="hidden" name="modal_parcel_id" value="{{$parcel->id}}">
                                    <input type="hidden" name="view_id" value="{{$data->id}}">
                                    <input type="hidden" name="app_status_id" value="{{$data->status->id}}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-profile">

                                                <div class="card-content">
                                                    <div class="row">
                                        <!-- <div class="col-md-3">
                                            <div class="card-avatar">
                                                <a href="#">
                                                    <img class="img" src="{{$data->applicant()->avatar}}" alt="Avatar" />
                                                </a>
                                            </div>
                                        </div> 
                                        <h6 class="category text-gray" style="padding-bottom: 20px">
                                                    Individual
                                                    
                                                </h6>-->
                                                <h4 class="category text-black" style="padding-bottom: 20px">MINISTRY OF AGRICULTURE, LAND AND FISHERIES</h4>
                                                <h4 class="category text-black" style="padding-bottom: 20px">VERIFICATION OF LAND STATUS(STATELAND) FOR FARMERS REGISTRATION</h4>
                                                <hr>
                                                <div class="card-content text-left">
                                                   <h4 class="category text-black" style="padding-bottom: 20px">SECTION A</h4>
                                               </div>

                                               <div class="col-md-12">
                                                <div class="card-title text-center">
                                                    <h2 class="card-title"><i class="fa fa-user" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->name}}@if($data->applicant()->alias) <i>({{$data->applicant()->alias}})</i>@endif</h2>

                                                </div>
                                            </div>
                                            <!-- <div class="col-md-3"></div> -->
                                        </div>
                                    </div>

                                    <div class="card-content text-left">
                                        <div class="row">


                                            <div class="col-md-4">
                                                <h5 class="description"><span rel="tooltip" title="Age"> <i class="fa fa-fw fa-calendar" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->age}} years</span></h5>
                                            </div>
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



                                            @if($data->applicant()->emergencycontact)
                                            <div class="col-md-4">
                                                <h5 class="description"><span rel="tooltip" title="Emergency Contact"> <i class="fa fa-fw fa-phone" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->emergencycontact}}</span></h5>
                                            </div>
                                            @endif
                                            @if($data->applicant()->email)
                                            <div class="col-md-4">
                                                <h5 class="description"><a href="mailto:{{$data->applicant()->email}}"><span rel="tooltip" title="Email"><i class="fa fa-fw fa-envelope" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant()->email}}</span></a></h5>
                                            </div>
                                            @endif
                                            @if($data->applicant()->address)
                                            <div class="col-md-4">
                                                <h5 class="description"><span rel="tooltip" title="District"> <i class="fa fa-fw fa-home" aria-hidden="true" style="padding-right:10px"></i> {{$data->applicant_type == 'Individual'? $data->applicant()->home()->district->district : $data->applicant()->address->district->district}}</span></h5>
                                            </div>
                                            @endif
                                        </div>
                                        <hr>

                                        <h5>Address</h5>

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
                                        <hr>
                                        <h4>Section B</h4>
                                        <h5>State Land Section</h5>
                                        <h5>Status:</h5>
                                        <div class="row">
                                           <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                               <div class="form-group{{ $errors->has('sal_Recommendation') ? ' has-error' : '' }}">
                                                   <label class="control-label">Recommended for SAL <span class="red">*</span></label>
                                                   <textarea class="form-control sal_Recommendation" name="sal_Recommendation" id="sal_Recommendation">{{old('sal_Recommendation')}}</textarea>

                                               </div>

                                               <span class="help-block text-danger">
                                                   <strong id="err-sal_Recommendation">{{ $errors->first('sal_Recommendation') }}</strong>
                                               </span>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                               <div class="form-group{{ $errors->has('cabinet_Note') ? ' has-error' : '' }}">
                                                   <label class="control-label">Cabinet Note<span class="red">*</span></label>
                                                   <textarea class="form-control cabinet_Note" name="cabinet_Note" id="cabinet_Note">{{old('cabinet_Note')}}</textarea>

                                               </div>

                                               <span class="help-block text-danger">
                                                   <strong id="err-cabinet_Note">{{ $errors->first('cabinet_Note') }}</strong>
                                               </span>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                               <div class="form-group{{ $errors->has('years_Occupied') ? ' has-error' : '' }}">
                                                   <label class="control-label">Years in Occupation<span class="red">*</span></label>
                                                   <textarea class="form-control years_Occupied" name="years_Occupied" id="years_Occupied">{{old('years_Occupied')}}</textarea>

                                               </div>

                                               <span class="help-block text-danger">
                                                   <strong id="err-years_Occupied">{{ $errors->first('years_Occupied') }}</strong>
                                               </span>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                               <div class="form-group{{ $errors->has('uprn') ? ' has-error' : '' }}">
                                                   <label class="control-label">UPRN</label>
                                                   <textarea class="form-control uprn" name="uprn" id="uprn">{{old('uprn')}}</textarea>

                                               </div>

                                               <span class="help-block text-danger">
                                                   <strong id="err-uprn">{{ $errors->first('uprn') }}</strong>
                                               </span>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                               <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                                                   <label class="control-label">Comments/Remarks<span class="red">*</span></label>
                                                   <textarea class="form-control comments" name="comments" id="comments" rows="2">{{old('comments')}}</textarea>

                                               </div>

                                               <span class="help-block text-danger">
                                                   <strong id="err-comments">{{ $errors->first('comments') }}</strong>
                                               </span>
                                           </div>
                                       </div>
                                       <div>



                                          <div class="row">
                                            <div class="col-md-12">
                                             <div id="slv_enterprise" class="form-group{{ $errors->has('slv_enterprise') ? ' has-error' : '' }} label-floating">
                                                <label class="control-label">Enterprise <span class="red">*</span></label>
                                                <select id="slv_enterprise_type" name="slv_enterprise_type" class="form-control dropdown slv_enterprise_type">
                                                    <option disabled="" selected=""></option>

                                                    <option value="1" unit="Crop">Crop</option>
                                                    <option value="2" unit="Animal">Animal</option>
                                                    <option value="3" unit="Mixed">Mixed</option>

                                                </select>

                                                <span class="help-block">
                                                    <strong id="err-slv_enterprise_type">{{ $errors->first('slv_enterprise_type') }}</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">


                                        <div class="col-md-3">

					                        <!-- <div class="form-group{{ $errors->has('plot_Size') ? ' has-error' : '' }}">
					                            <label class="control-label">Size of Plot <span class="red">*</span></label>
					                            <textarea class="form-control" name="plot_Size" id="plot_Size" rows="2">{{old('plot_Size')}}</textarea>
					                            
					                        </div>
					                        
					                            <span class="help-block text-danger">
					                                <strong id="err-plot_Size">{{ $errors->first('plot_Size') }}</strong>
					                            </span> -->

                                                <div class="form-group{{ $errors->has('parcel_amt') ? ' has-error' : '' }} label-floating" id="grp-parcel_amt">
                                                    <label class="control-label">Size of Plot <span class="red">*</span></label>
                                                    <div class="input-group">
                                                        <input id="parcel_amt" name="parcel_amt" type="number" step="any" class="form-control parcel_amt"  value="{{old('parcel_amt')}}" min="0">
                                                        
                                                        
                                                        <select id="slv_enterprise_type" name="slv_enterprise_type" class="form-control dropdown slv_enterprise_type">

                                                            <option value="1" unit="Acres" selected>Acres</option>
                                                            <option value="2" unit="Acres">Hectares</option>


                                                        </select>
                                                    </div>

                                                    
                                                    
                                                    <span class="help-block  text-danger">
                                                        <strong id="err-parcel_amt">{{ $errors->first('parcel_amt') }}</strong>
                                                    </span>
                                                </div>

                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-group{{ $errors->has('percent_cultivation') ? ' has-error' : '' }} label-floating" id="grp-percent_cultivation">
                                                    <label class="control-label">Percentage Cultivation <span class="red">*</span></label>
                                                    <div class="input-group">
                                                        <input id="percent_cultivation" name="percent_cultivation" type="number" step="any" class="form-control percent_cultivation"  value="{{old('percent_cultivation')}}" min="0">
                                                        <span class="input-group-addon unit-addon" id="parcel_unit">
                                                            %
                                                        </span>
                                                    </div>

                                                    <span class="help-block  text-danger">
                                                        <strong id="err-percent_cultivation">{{ $errors->first('percent_cultivation') }}</strong>
                                                    </span>
                                                </div>

                                            </div>



                                        </div>

                                        <div class="row">
                                          <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                                           <label class="control-label" style="padding-right:80px">AIP Recommended</label>
                                           <label class="control-label">AIP Not Recommended</label>
                                           <div class="btn-group btn-block recommend" data-toggle="buttons">

                                            <label class="btn btn-xs btn-primary active" style="width: 50%" rel="tooltip" title="AIP Recommend">
                                                <input type="radio" name="recommend" id="option1" autocomplete="off" value="1" parcel="{{$parcel->id}}" checked><i class="fa fa-check"></i>
                                            </label>
                                            <label class="btn btn-xs btn-danger" style="width: 50%" rel="tooltip" data-placement="left" title="AIP Not Recommend">
                                                <input type="radio" name="recommend" id="option2" autocomplete="off" value="0" parcel="{{$parcel->id}}"><i class="fa fa-remove"></i>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                                        <label class="control-label">Upload completed SLV</label>
                                        <input id="proof_codes_file" class="proof_docs proof_docs" name="proof_codes_file" type="file" multiple style="opacity: inherit;position: relative; padding-top:10px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

</div>
</div>

</div>

<div class="modal-footer">
    <!-- <a href="{{url('/statelandverification/pdf')}}/{{$data->applicant()->id}}" type='button' id="confirm" class='btn btn-next btn-fill btn-success btn-wd' name='confirm'>Continue</a> -->
    <button type="submit" class="btn btn-fill btn-success" form="completeSlv_form">Confirm</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

