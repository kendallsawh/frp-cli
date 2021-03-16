<div class="modal fade" id="uploadApplication" tabindex="-1" role="dialog" aria-labelledby="uploadAplicationLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="uploadAplicationLabel">Upload Signed Application Form With DFO Data</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="card-content" >

                        <div class="content">
                            <div class="container-fluid">
                                <form method="POST" action="{{route('uploadApp')}}" id="appUpload_form"  enctype="multipart/form-data">
                                    
                                    <input type="hidden" name="app_id" value="{{$data->id}}">
                                    
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-profile">

                                              <div class="card-content">
                                                <div class="row">

                                                  <h4 class="category text-black" >MINISTRY OF AGRICULTURE, LAND AND FISHERIES</h4>

                                                  <hr>


                                                  <div class="col-md-12">
                                                    <div class="card-title text-center">
                                                      <h5 class="card-title"><i class="fa fa-user" aria-hidden="true" style="padding-right:10px"></i> Application form upload for {{$data->applicant()->name}}@if($data->applicant()->alias) <i>({{$data->applicant()->alias}})</i>@endif</h5>

                                                    </div>
                                                  </div>

                                                </div>
                                              </div>

                                    <div class="card-content text-left">
                                        
                                        <hr>
                                       
                                       
                                       
                                       <div>


                                    <div class="row">


                                        
                                            
                                      



                                        </div>

                                        <div class="row">
                                          
                                    <div class="col-md-5">
                                        <label class="control-label">Select the scanned file</label>
                                        <input id="app_upload_file"  name="app_upload_file" type="file" multiple style="opacity: inherit;position: relative;">
                                    </div>
                                    <div class="col-md-7">
                                        
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <div id="grp-alias" class="form-group label-floating">
                                                <label class="control-label">Enter your name </label>
                                                <input id="alias" name="alias" type="text" class="form-control" value="{{old('alias')}}">

                                                
                                            </div>
                                        </div>
                                            
                                        
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
    <button type="submit" class="btn btn-fill btn-success" form="appUpload_form">Upload</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>

