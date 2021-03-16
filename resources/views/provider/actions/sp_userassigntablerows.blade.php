 <tr>

    <td>{{$userlist->Name}}</td>
    <td>{{$userlist->Role}}</td>
    <td>{{\App\Districts::find($userlist->district_id)->district}}</td>
    <td>{{$userlist->userassigncount()}}</td>
    <td class="td-actions text-center">
        <a href="{{url('/application/view/assign/')}}/{{$data->id}}/{{$userlist->id}}" rel="tooltip" class="btn btn-info" data-original-title="View Application" title="Assing the currently viewed application to the this user.">
            <i class="fa fa-hand-o-left" aria-hidden="true"></i>
            <div class="ripple-container"></div>
        </a>

    </td>

</tr>