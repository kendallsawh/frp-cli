@if($data->tractors->count())
<div class="card">
    <div class="card-content">
    <h3 class="card-title">Service Provider Tractors <a href="{{url('/provider/view/'.$data->provider->id)}}" class="btn btn-sm btn-round btn-success">View Service Provider Information</a></h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    <th>Registration Number</th>
                    <th>Chassis Number</th>
                    <th>Certified Copy</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th>Created By</th>
                </thead>
                <tbody>
                    @foreach($data->tractors as $tractor)
                    <tr>
                        <td>{{$tractor->registration_num}}</td>
                        <td>{{$tractor->chassis_num}}</td>
                        <td><a href="{{$tractor->cert}}" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> view</a></td>
                        <td>{{$tractor->status->status}}</td>
                        <td>{{$tractor->since}}</td>
                        <td>{{$tractor->createdBy->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif