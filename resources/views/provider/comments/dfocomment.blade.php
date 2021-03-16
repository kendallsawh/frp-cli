@if($data->serv_prov_comments())

<div class="card">
    <div class="card-content text-center">
        <h3 class="card-title">
           DFO Comments
        </h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    <th class="text-center">Service Provider ID</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">Comments</th>
                    <th class="text-center">Date of Verification</th>
                    <th class="text-center">Created By</th>
                    <th class="text-center">Date Entered(Returned)</th>
                </thead>
                <tbody>
                    @foreach($data->serv_prov_comments() as $spcomment)
                    <tr >
                        <td class="text-center">{{$spcomment->service_provider_id}}</td>
                        <td>{{strtoupper($data->provider->address->address)}}</td>
                        <td>{{$spcomment->comments}}</td>
                        <td>{{$spcomment->date_of_verification}}</td>
                        <td>{{$spcomment->createdBy($spcomment->user_id)->name}}</td>
                        <td>{{$spcomment->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endif