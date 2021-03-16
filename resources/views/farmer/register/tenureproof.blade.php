

<div class="modal fade" id="applistModal" tabindex="-1" role="dialog" aria-labelledby="applistModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="applistModalLabel">Application-Land-Tenure-Docs table</h4>
                <h5 class="description" id="applistModalLabel">You are about to add dfo data for application:</h5>

            </div>
            <div class="modal-body">

               <div class="card">
                    <div class="card-content text-center">

                     <div class="table-responsive">
                        <table class="table app_table" id="app_table">
                            <thead class="">
                                <th class="text-center">Application Type</th>
                                <th class="text-center">Land Type</th>
                                <th class="text-center">Tenure Code</th>
                                <th class="text-center">Proof Documents</th>
                                
                            </thead>
                            <tbody>
                                @foreach($doc_lists as $n => $doc_list)
                                <tr class="{{$n % 2 == 0? 'active' : ''}}" >
                                    <td class="text-center">{{$doc_list->application->application_type}}</td>
                                    <td>{{$doc_list->land->land_type}}</td>
                                    <td>{{$doc_list->tenure->tenure}}</td>
                                    <td>{{$doc_list->proof->proof}}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="modal-footer">
            
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>

