@if($data->cropinvestigations())

<div class="card">
    <div class="card-content text-center">
        <h3 class="card-title">
           Crop Investigations
        </h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    
                    <th>Investiation Type</th>
                    <th>View Data</th>
                    <th>Date of Investigation</th>
                    
                </thead>
                <tbody>
                    @foreach($data->cropinvestigations() as $cropinvestigation)
                    <tr >
                        
                        <td>{{strtoupper($data->oneparcel_parcelid($parcelaa3comment->parcel_id)->land->address->address)}}</td>
                        <td>{{$parcelaa3comment->comments}}</td>
                        <td>{{$parcelaa3comment->date_of_verification}}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endif