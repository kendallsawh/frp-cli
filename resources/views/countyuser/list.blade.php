@extends('layouts.app')

@section('content')

<div class="col-xs-12">
    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">{{$title}}</h2>
        </div>
       
        
        <div class="card-content table-responsive">
            
            <table class="table table-fit table-striped table-hover list_table">
                <thead class="">
                            <th>User Name</th>
                            <th>Role</th>
                            <th>District</th>
                            <th>Number Assigned</th>
                            <th>View Profile</th>
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
</div>

@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection