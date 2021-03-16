

<div class="card">
    <div class="card-content text-center">
        <h3 class="card-title">
           Flag Details(Comments should be resolved by appropiate staff)
        </h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    
                    
                    <th class="text-center">Details</th>
                
                    <th class="text-center">Flagged By</th>
                    <th class="text-center">Date Entered(Flagged)</th>
                </thead>
                <tbody>
                    @foreach($data->flagdetails() as $flagdetail)
                    
                    <tr >
                        
                        
                        <td>{{$flagdetail->details}}</td>
                        
                        <td>{{$data->createdBy2($flagdetail->user_id)->name}}</td>
                        <td>{{$flagdetail->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



