 <tr>

    <td>{{$userlist->Name}}</td>
    <td>{{$userlist->RoleName}}</td>
    <td>{{\App\Districts::find($userlist->district_id)->district}}</td>
    <td>{{$userlist->userassigncount()}}</td>
    <td class="td-actions text-center">
        <a href="{{route('viewProfile')}}/{{$userlist->id}}" rel="tooltip" class="btn btn-info" data-original-title="View User Information" title="Assing the currently viewed application to the this user.">
            <i class="fa fa-eye" aria-hidden="true"></i>
            <div class="ripple-container"></div>
        </a>

    </td>

</tr>