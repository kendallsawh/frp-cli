
<div class="card">
    <div class="card-content">
        <h3 class="card-title">{{$appcount <= 0? 'No ': ''}}Parcel holdings {{$appcount <= 0? 'data found.' : ''}}</h3>
       
        @if($appcount >=1)
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    <th class="text-center hide">No</th>
                    <th >Type</th>
                    <th>Previous Badge Number</th>
                    <th>Status</th>
                    <th>Created On</th>
                    
                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    <tr>
                        <td class="text-center hide">{{$app->id}}</td>
                        <td >{{$app->type->application_type == 'Unknown'? $app->type->application_type.'(Please update information)' :$app->type->application_type}}</td>
                        <td>{{$app->applicant()->farmer()? ($app->applicant()->farmer()->badge()? $app->applicant()->farmer()->badge()->old_badge_id : 'N/A') : 'N/A'}}</td>
                        <td>{{$app->status->status}}</td>
                        <td>{{$app->createdOn}}</td>
                        
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
        
        @endif
    </div>
</div>
