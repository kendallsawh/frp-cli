@if($data->parcelaa3comments())

<div class="card">
    <div class="card-content text-center">
        <h3 class="card-title">
           AAIII Comments
        </h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    
                    <th>Address</th>
                    <th>Comments</th>
                    <th>Date of Verification</th>
                    <th>Created By</th>
                    <th>Date Entered</th>
                </thead>
                <tbody>
                    @foreach($data->parcelaa3comments() as $parcelaa3comment)
                    <tr >
                        
                        <td>{{strtoupper($data->oneparcel_parcelid($parcelaa3comment->parcel_id)->land->address->address)}}</td>
                        <td>{{$parcelaa3comment->comments}}</td>
                        <td>{{$parcelaa3comment->date_of_verification}}</td>
                        <td>{{$parcelaa3comment->createdBy2($parcelaa3comment->user_id)->name}}</td>
                        <td>{{$parcelaa3comment->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endif