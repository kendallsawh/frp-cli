<div class="modal fade" id="deleteDocumentModal" tabindex="-1" role="dialog" aria-labelledby="deleteDocumentLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="deleteDocumentLabel">You are about to <b>Delete</b> a Document</h3>
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
                                                              <h5 class="card-title"> Are you sure you want to delete this document? </h5>

                                                            </div>
                                                        </div>
                                                        
                                                            <form method="POST" action="{{route('deleteDocument')}}" id="deleteDocument"  enctype="multipart/form-data">

                                                                

                                                                <input type="hidden" name="delete_document_id" id="delete_document_id" value="">
                                                                

                                                                {{ csrf_field() }}
                                                                
                                                                
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

                <button type="submit" class="btn btn-fill btn-danger" id="submit_doc_delete" name="submit_doc_delete"  form="deleteDocument">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

