<div class="modal fade" id="changeCropModal" tabindex="-1" role="dialog" aria-labelledby="changeCropLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="changeCropLabel"></h3>
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

                                                       
                                                        
                                                            <form method="POST" action="{{route('changeCrop')}}" id="changeCrop"  enctype="multipart/form-data">

                                                                <input type="hidden" name="app_id" value="{{$data->id}}">
                                                                <input type="hidden" name="produce_id" id="produce_id" value="">

                                                                {{ csrf_field() }}
                                                                <div class="col-md-12" id="commoditylist" name="commoditylist">
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

                <button type="submit" class="btn btn-fill btn-success" form="changeCrop">Change</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

