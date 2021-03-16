<div class="modal fade" id="deleteParcelModal" tabindex="-1" role="dialog" aria-labelledby="deleteParcelLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="deleteParcelLabel">You are about to <b>Delete</b> a parcel</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="card-content" >

                        <div class="content">
                            <div class="container-fluid">
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-profile">

                                                <div class="card-content">
                                                    <div class="row">

                                                        <h4 class="category text-black" >MINISTRY OF AGRICULTURE, LAND AND FISHERIES</h4>

                                                        <hr>


                                                        <div class="col-md-12">
                                                            <div class="card-title text-center">
                                                              <h5 class="card-title"> Are you sure you want to delete this parcel? </h5>

                                                            </div>
                                                        </div>
                                                        
                                                            <form method="POST" action="{{route('deleteParcel')}}" id="deleteParcel"  enctype="multipart/form-data">

                                                                <input type="hidden" name="app_id" value="{{$data->id}}">

                                                                <input type="hidden" name="delete_parcel_id" id="delete_parcel_id" value="">
                                                                <input type="hidden" id="username_challenge" name="username_challenge" value="{{\Auth::user()->name}}">

                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label for="delete_challenge">Enter your name to continue</label>
                                                                    <input type="text" name="delete_challenge" id="delete_challenge" value="">
                                                                </div>
                                                                
                                                            </form>
                                                        

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


            <div class="modal-footer">

                <button type="submit" class="btn btn-fill btn-danger" id="submit_parcel_delete" name="submit_parcel_delete" disabled="" form="deleteParcel">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

