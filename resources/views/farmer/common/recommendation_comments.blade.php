@if($data->applications()->count())
<div class="card">
    <div class="card-content">
        <h3 class="card-title">Applications</h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    <th class="text-center">No</th>
                    <th hidden>Type</th>
                    <th>Old Number</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th>Created By</th>
                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                </thead>
                <tbody>
                    @foreach($data->applications() as $app)
                    <tr>
                        <td class="text-center">{{$app->id}}</td>
                        <td hidden>{{$app->type->application_type}}</td>
                        <td>{{$app->old_registration_num? $app->old_registration_num : 'N/A'}}</td>
                        <td>{{$app->status->status}}</td>
                        <td>{{$app->createdOn}}</td>
                        <td>{{$app->createdBy->name}}</td>
                        <td class="td-actions text-center">
                            <a href="{{url('/application/view/'.$app->id)}}" rel="tooltip" class="btn btn-info" data-original-title="View Application" title="">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <div class="ripple-container"></div>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif