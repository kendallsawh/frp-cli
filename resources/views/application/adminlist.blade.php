@extends('layouts.app')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">{{$title}}</h2>
        </div>

        <div class="card-content table-responsive">
            <table class="table table-hover list_table">
                <thead class="">
                    <th class="text-center">No</th>
                    <th>Applicant</th>
                    <th>County</th>
                    <th>District</th>
                    <th>Farmer</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    @if($app->applicant() && ($app->parcels()->count() >=1))
                    @if(Auth::user()->county == $app->applicant()->county or Auth::user()->county == $app->parcels()->first()->county)
                    <tr class="{{Auth::user()->county == $app->applicant()->county? '' : 'info'}}" title="{{Auth::user()->county == $app->applicant()->county? '' : 'Out of County'}}" data-toggle="tooltip" >
                        <td class="text-center">{{$app->id}}</td>
                        <!-- <td><a href="{{$app->applicant_type == 'Individual'? url('/individual/view') : url('/organization/view')}}/{{$app->applicant()->id}}">{{$app->applicant()->name}}</a></td> -->
                        <td><a href="{{url('/application/view/'.$app->id)}}" data-original-title="View Application" target="Auth::user()->role_id === 7? '_blank' : ''">{{$app->applicant()->name}}</a></td>
                        <td>{{$app->applicant()->county}}</td>
                        <td>{{$app->applicant()->district}}</td>
                        <td>{{$app->applicantType}}</td>
                        <td>{{$app->type->application_type}}</td>
                        <td>{{$app->status->status}}</td>
                        <td>{{$app->createdOn}}</td>
                        <td class="td-actions text-center">
                            <a href="{{url('/application/view/'.$app->id)}}" rel="tooltip" class="btn btn-info" data-original-title="View Application" title="">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <div class="ripple-container"></div>
                            </a>
<!--                             <button type="button" rel="tooltip" class="btn btn-danger hide" data-original-title="Remove Farmer" title="">
                                <i class="material-icons">close</i>
                            </button> -->
                        </td>
                    </tr>
                    @endif
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