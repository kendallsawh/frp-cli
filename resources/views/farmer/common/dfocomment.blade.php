@if($data->parcelcomments())

<div class="card">
    <div class="card-content text-center">
        <h3 class="card-title">
           DFO Comments
        </h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    
                    <th class="text-center">Address</th>
                    <th class="text-center">Comments</th>
                    <th class="text-center">Date of Verification</th>
                    <th class="text-center">Created By</th>
                    <th class="text-center">Date Entered(Returned)</th>
                </thead>
                <tbody>
                    @foreach($parcelcomments as $parcelcomment)
                    <tr >
                        
                        <td>{{strtoupper($data->oneparcel_parcelid($parcelcomment->parcel_id)->land->address->address)}}</td>
                        <td>{{$parcelcomment->comments}}</td>
                        <td>{{$parcelcomment->date_of_verification}}</td>
                        <td>{{$parcelcomment->createdBy2($parcelcomment->user_id)->name}}</td>
                        <td>{{$parcelcomment->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endif