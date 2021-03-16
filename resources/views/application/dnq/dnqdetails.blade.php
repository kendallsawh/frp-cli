

<div class="card">
    <div class="card-content text-center">
        <h3 class="card-title">
           Denial(Flag) Details
        </h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    
                    
                    <th class="text-center">Details</th>
                
                    <th class="text-center">Flagged By</th>
                    <th class="text-center">Date Entered(Flagged)</th>
                </thead>
                <tbody>
                    @foreach($data->dnqdetails() as $dnqdetail)
                    
                    <tr >
                        
                        
                        <td>{{$dnqdetail->details}}</td>
                        
                        <td>{{$data->createdBy2($dnqdetail->created_by)->name}}</td>
                        <td>{{$dnqdetail->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



