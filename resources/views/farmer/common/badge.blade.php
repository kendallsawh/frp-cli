@if($data->farmer())
@if($data->farmer()->badge())
<div class="card">
    <div class="card-content">
        <h3 class="card-title">
            @if(!$data->farmer()->badge()->expired)
           
            @else

            <span class="text-danger" title='Expired' rel="tooltip"><strong>Badge {{$data->farmer()->badge()->renew_process_check == 1? 'renewal in process': ''}}</strong>
                
            </span>
            &nbsp;&nbsp;
            
            @endif
        </h3>
        
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    <th class="text-center">Farmer #</th>
                    <th>Badge</th>
                    <th>Status</th>
                    <th>Expiry Date</th>
                    <th>Created On</th>
                    <th>Created By</th>
                </thead>
                <tbody>
                    <tr class="{{$data->farmer()->badge()->expired? 'danger' : $data->farmer()->badge()->table_class}}">
                        <td class="text-center">{{$data->farmer()->id}}</td>
                        <td>{{$data->farmer()->badge()->farmer_badge}}</td>
                        <td>{{$data->farmer()->badge()->status}}</td>
                        <td>{{$data->farmer()->badge()->expiry_date}}</td>
                        <td>{{$data->farmer()->badge()->created_at}}</td>
                        <td>{{$data->createdBy->name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if($data->farmer()->badge()->renew_process_check == 1)
        <h6 >
            *Renewal will be completed when this application has been approved by the region director. 
        </h6>
        @endif
    </div>
</div>



@endif
@endif