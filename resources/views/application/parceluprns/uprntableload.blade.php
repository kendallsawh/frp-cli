<div class="card-content table-responsive">

            
            <table class="table table-striped table-hover">
                <thead class="">
                    
                    <th>Applicant</th>
                    
                    <th>Parcel Address</th>
                    <th>New Badge</th>
                    <th>Previous Badge</th>
                    
                    <th>UPRN</th>
                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                </thead>
                <tbody>
                    @foreach($data as $app)
                    @if($app->applicant())
                    
                    @foreach($app->parcels() as $n => $parcel)
                    <tr class="{{Auth::user()->county == $app->applicant()->county? '' : 'info'}}" title="{{Auth::user()->county == $app->applicant()->county? '' : 'Out of County from '.$app->applicant()->county}}" data-toggle="tooltip" >
                        
                        
                        <td><a href="{{url('/application/view/'.$app->id)}}" data-original-title="View Application" target="Auth::user()->role_id === 7? '_blank' : ''">{{$app->applicant()->name}}</a></td>
                        
                        <td>{{$parcel->land->address->address}}</td>
                        <td>{{!is_numeric($app->applicant()->farmer())? $app->applicant()->farmer()->badge()->farmer_badge : ''}}</td>
                        <td>{{!is_numeric($app->applicant()->farmer())? $app->applicant()->farmer()->badge()->old_badge_id : ''}}</td>
                        
                        <td>
                            <form method="POST" type = "hidden" action="{{route('listsubmitUprn')}}" id="insert_uprn" enctype="multipart/form-data">
                                <input type="hidden" name="parcel_id" value="{{$parcel->id}}">
                                <input type="hidden" name="view_id" value="{{$app->id}}">
                                {{ csrf_field() }}
                                <input id="uprns_number" placeholder="Enter UPRN Here" name="uprns_number" type="text" class="form-control" style="text-transform:uppercase">
                            </form>
                        </td>
                        <td class="td-actions text-center">

                            <button type="submit" class="btn btn-fill btn-success" form="insert_uprn">Submit UPRNs</button>
                            
                            
                        </td>
                    </tr>
                    @endforeach
                  
                    
                    

                    @endif
                    @endforeach
                </tbody>
            </table>

        </div>
        {{ $data->links() }}