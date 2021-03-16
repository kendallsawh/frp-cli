<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="userAssignModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="userAssignModal">Assign this application to anyone in the following list</h4>
            </div>
            <div class="modal-body">
                <form method="POST" type = "hidden" action="{{url('/profiles/user_view')}}/{{$userlist->id}}" id="assign_app_to_user" enctype="multipart/form-data">
                    {{ csrf_field() }}

                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <th>User Name</th>
                            <th>Role</th>
                            <th>District</th>
                            <th>Number Assigned</th>
                            <th class="text-right">Assign</th>
                        </thead>
                        <tbody>
                            @if (Auth::user()->role_id == 6)
                            @foreach (Auth::user()->UsersList as $userlist)

                            @include('countyuser.userassigntablerows')
                            @endforeach
                            @elseif(Auth::user()->role_id ==  5)
                            @foreach (Auth::user()->UsersListAA3 as $userlist)

                            @include('countyuser.userassigntablerows')
                            @endforeach

                            @endif
                    </tbody>

                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>