@extends('layouts.app')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">{{$title}}</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="">
                    <th>User Name</th>
                    <th>Role</th>
                    <th>District</th>
                    <th>Number of assigned Applications</th>
                    <th class="text-right">Action</th>
                </thead>
                <tbody>
                    @foreach ($userlists as $userlist)
                    <tr>

                        <td>{{$userlist->Name}}</td>
                        <td>{{$userlist->RoleName}}</td>
                        <td>{{\App\Districts::find($userlist->district_id)->district}}</td>
                        <td>{{$userlist->userassigncount()}}</td>
                        <td class="td-actions text-center">
                            <a href="{{url('/user/view/disable/list')}}/{{$userlist->id}}" rel="tooltip" class="btn btn-info" data-original-title="Disable This User's Account" title="">
                                <i class="fa fa-user-times" aria-hidden="true"></i>
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
@endsection