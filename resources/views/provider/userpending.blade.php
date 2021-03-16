<div class="col-md-12">

    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">Your Service Provider List</h2>
        </div>

        <div class="card-content table-responsive">
            <table class="table table-hover list_table">
                <thead class="">
                    <th>Name</th>
                    <th>Type</th>
                    <th>County</th>
                    <th class="text-center">Tractors</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th>Created By</th>
                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                </thead>
                <tbody>
                    @foreach($serviceProvidersList as $provider)
                    @if(Auth::user()->county == $provider->provider->county)
                    <tr>
                        <td><a href="{{url('/provider/view')}}/{{$provider->id}}">{{$provider->name}}</a></td>
                        <td>{{$provider->type}}</td>
                        <td>{{$provider->provider->county}}</td>
                        <td class="text-center">{{$provider->provider->tractors->count()}}</td>
                        <td>{{$provider->status->status}}</td>
                        <td>{{$provider->since}}</td>
                        <td>{{$provider->createdBy->name}}</td>
                        <td class="td-actions text-center">
                            <a href="{{url('/provider/view/'.$provider->id)}}" rel="tooltip" class="btn btn-info" data-original-title="View Service Provider" title="">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <div class="ripple-container"></div>
                            </a>
                            <button type="button" rel="tooltip" class="btn btn-success" data-original-title="Edit Service Provider" title="">
                                <i class="material-icons">edit</i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-danger hide" data-original-title="Remove Service Provider" title="">
                                <i class="material-icons">close</i>
                            </button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $serviceProvidersList->links() }}
    </div>
</div>