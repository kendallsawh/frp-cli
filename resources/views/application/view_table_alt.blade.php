<!-- Alternate table view -->
<tr class="{{$n % 2 == 0? 'active' : ''}}" id="parcelRow{{$parcel->id}}">
                                                        
                                                        <td >{{$parcel->land->address->address}}
                                                          
                                                          @if(Auth::user()->county_id == $data->registering_county)
                                                            @if(Auth::user()->role_id == 1)
                                                              @if($parcel->land_type->id == 7)
                                                                <i class="fa fa-times" aria-hidden="true" data-toggle="modal" data-target = "#deleteParcelModal" id="delete_parcel_button" rel="tooltip" title="Delete this parcel" parcelid="{{$parcel->id}}" style="color: red;"></i>
                                                              @endif
                                                            @endif
                                                        
                                                        @endif
                                                        </td>
                                                        <td >{{$parcel->land_type->land_type}}</td>
                                                        <td >{{$parcel->county}}</td>
                                                        <td >{{$parcel->area}}</td>
                                                        <td >{{$parcel->tenure->tenure}}</td>
                                                        <td >
                                                            @if(count($parcel->proofs))
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
                                                                          <input type="hidden" name="view_only" id="view_only" value="True"/>
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
                                                            @else
                                                              N/A
                                                            @endif
                                                        </td>
                                                        

                                                        <td>N/A</td>
                                                        <td>N/A</td>
                                                        <td class="text-right">N/A</td>


                                                        
                                                        <td class="text-center">
                                                          @if(Auth::user()->countyid == $data->registering_county)
                                                        <a href="{{url('/application/cropmonitor')}}/{{$parcel->id}}" type="button" id="cropMonitor" class="btn btn-success btn-round btn-sm" name="cropMonitor">Add Crop Monitoring <i class="fa fa-plus-square"></i></a>
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
                                                                        @if ($data->status_id <= 2 && $slvCompleted == 0)
                                                                            
                                                                                    <button type="button" id="slv_{{$parcel->id}}" name="slv_complete" data-field="{{$parcel->id}}" class="slv_complete btn btn-success btn-round btn-xs btn-block" data-toggle="modal" data-target = "#completeSlvModal">Complete Appendix C <i class="fa fa-check"></i></button>
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
                                                                    @if((Auth::user()->role_id === 1 || Auth::user()->role_id === 4) && (Auth::user()->countyid == $parcel->CountyId))
                                                                            <a href="{{url('/application/edit')}}/{{$data->id}}/{{$parcel->id}}" type="button" id="editParcel" class="btn btn-success btn-round btn-sm btn-block" name="editParcel">Edit Parcel <i class="fa fa-pencil"></i></a>
                                                                    @endif
                                                           
                                                            
                                                            
                                                            @endif
                                                        @elseif(Auth::user()->county_id == $data->registering_county)
                                                            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                                                <a href="{{url('/application/edit')}}/{{$data->id}}/{{$parcel->id}}" type="button" id="editParcel" class="btn btn-success btn-round btn-sm btn-block" name="editParcel">Edit Parcel <i class="fa fa-pencil"></i></a>
                                                            @endif
                                                        @else
                                                          N/A
                                                        @endif
                                                        @if(Auth::user()->county_id == 8 && Auth::user()->role_id !== 6)
                                                            <!-- <button type="button" class="btn btn-success btn-round btn-sm btn-block" action="{{route('force')}}" rel="tooltip" title="Move the applications up to the AO1 of the aplication process.">Fasttrack Recommend <i class="fa fa-check"></i></button> -->
                                                            <a href="{{url('/application/force')}}/{{$data->id}}" type="button" class="btn btn-success btn-round btn-sm" rel="tooltip" title="Move the applications up to the AO1 of the aplication process.">Fasttrack Recommend <i class="fa fa-check"></i></a>
                                                            
                                                        @endif
                                                        

                                                        <!-- end if in user county -->
                                                        </td>
                                                    
                                                    
                                                </tr>