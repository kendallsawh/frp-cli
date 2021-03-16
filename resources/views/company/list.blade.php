@extends('layouts.app')

@section('content')

<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">{{$title}}</li>
    </ul>

    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">{{$title}}</h2>
        </div>

        <div class="card-content table-responsive">
            <table class="table table-hover list_table">
                <thead class="">
                    <th>No</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>County</th>
                    <th class="text-center">Parcels</th>
                    <th class="text-center">Enterprises</th>
                    <th>Created On</th>
                    <th>Created By</th>
                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                </thead>
                <tbody>
                    @foreach($organizations as $org)
                    @if(Auth::user()->county == $org->county)
                    <tr>
                        <td>{{$org->id}}</td>
                        <td class="text-center">
                            <div class="list-avatar">
                                <a href="{{url('/organization/view')}}/{{$org->id}}">
                                    <img class="img" src="{{$org->logo}}" alt="Logo"/>
                                </a>
                            </div>
                        </td>
                        <td><a href="{{url('/organization/view')}}/{{$org->id}}">{{$org->name}}</a></td>
                        <td>{{$org->county}}</td>
                        <td class="text-center">{{$org->parcelsCount()}}</td>
                        <td class="text-center">{{$org->enterpriseCount()}}</td>
                        <td>{{$org->since}}</td>
                        <td>{{$org->createdBy->name}}</td>
                        <td class="td-actions text-center">
                            <a href="{{url('/organization/view')}}/{{$org->id}}" rel="tooltip" class="btn btn-info" data-original-title="View Farmer" title="">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <div class="ripple-container"></div>
                            </a>
                            <button type="button" rel="tooltip" class="btn btn-success" data-original-title="Edit Farmer" title="">
                                <i class="material-icons">edit</i>
                            </button>
                            <button type="button" rel="tooltip" class="btn btn-danger hide" data-original-title="Remove Farmer" title="">
                                <i class="material-icons">close</i>
                            </button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
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
