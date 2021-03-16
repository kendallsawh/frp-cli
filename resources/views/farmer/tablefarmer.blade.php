 @foreach($farmers as $farmer)               
                    <tr>                        
                        <td class="text-center">{{$farmer->farmer() !== 0? $farmer->farmer()->name : 'N/A' }} </td>
                        <td>{{$farmer->type}}</td>
                        <td>{{$farmer->farmer() !== 0? $farmer->farmer()->county : ''}}</td>
                        <td>{{$farmer->registration_num}}</td>
                        <td>{{$farmer->old_badge_id}}</td>
                        <td class="text-center">{{$farmer->farmer() !== 0? $farmer->farmer()->parcelsCount() : ''}}</td>
                        <td class="text-center">{{$farmer->farmer() !== 0? $farmer->farmer()->enterpriseCount() : ''}}</td>
                        <td>{{$farmer->since}}</td>
                        <td class="td-actions text-center">
                            <a href="{{$farmer->type == 'Individual'? url('/individual/view') : url('/organization/view')}}/{{$farmer->farmer() !== 0? $farmer->farmer()->id : 0}}" rel="tooltip" class="btn btn-info" data-original-title="View Farmer" title="">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <div class="ripple-container"></div>
                            </a>
                        </td>
                    </tr>
                    
@endforeach