@extends('layouts.app')

@section('content')
<div class="col-sm-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb" id="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="#">Farmers</a></li>
        <li><a href="#">Renewal</a></li>
        <li class="active">Individual</li>
    </ul>

    <!-- Display Validation Errors -->
    <div class="col-md-12" id="errorDiv">@include('common.errors')</div>

    <!--      Wizard container        -->
    <div class="wizard-container " id="wizard-container">
        <div class="card wizard-card" data-color="{{config('global.colour')}}" id="wizardProfile">

            <form role="form" method="POST" action="" id="farmerRegForm1" enctype="multipart/form-data">
               

                <div class="wizard-header">
                    <h2 class="wizard-title">Renewal</h2>
                    <h5>Please select the correct farmer.

                    </div>
                    <div class="wizard-navigation hidden-xs hidden-sm">
                        <ul>
                            <li><a href="#about" tab="about" data-toggle="tab">Replacement Form</a></li>
                            <li><a href="#address" tab="address" data-toggle="tab">Confirmation</a></li>
                        </ul>
                        <input type="hidden" id="nextTab" value="address" autocomplete="false">
                    </div>
                    <div class="col-md-12 required">
                        <p>
                            <label>
                                <span class="red">*</span> Required Fields <br>
                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i> At least one is required
                            </label>
                        </p>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="about" target="address">
                            <div class="card-content table-responsive">
                                <table id="list_table" class="table table-hover">
                                    <thead class="">
                                        <th>No</th>
                                        <th>Picture</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th class="text-center">Age</th>
                                        <th>County</th>
                                        <th>Created On</th>
                                        <th>Created By</th>
                                        <th class="text-center"><i class="fa fa-cogs"></i></th>
                                    </thead>
                                    <tbody>
                                        @foreach($applications as $app)
                                        <tr>
                                            <td>{{$app->id}}</td>
                                            <td class="text-center">
                                                <div class="list-avatar">
                                                    <a href="{{url('/individual/view')}}/{{$app->id}}">
                                                        <img class="img" src="{{$app->avatar}}" alt="Avatar"/>
                                                    </a>
                                                </div>
                                            </td>
                                            <td><a href="{{url('/individual/view')}}/{{$app->id}}">{{$app->name}}@if($app->alias) <i>({{$app->alias}})</i>@endif</a></td>
                                            <td>{{$app->gender['gender']}}</td>
                                            <td class="text-center">{{$app->age}}</td>
                                            <td>{{$app->county}}</td>
                                            <td>{{$app->since}}</td>
                                            <td>{{$app->createdBy->name}}</td>
                                            <td class="td-actions text-center">
                                                <a href="#" rel="tooltip" class="btn btn-info" data-original-title="Select Farmer" title="">
                                                    <i class="material-icons">person</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="address">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h5 style="font-weight:bold;">Farmer ID:</h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5><i class='material-icons'>credit_card</i>12345678</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h5 style="font-weight:bold;">Farmer Name:</h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5><i class="material-icons">account_box</i>John Doe</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h5 style="font-weight:bold;">New Expiration Date</h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5><i class="material-icons">date_range</i>25-07-2020</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-footer">
                        <div class="pull-right">
                            <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Next' id="next">
                            <input type='button' id="confirm" class='btn btn-finish btn-fill btn-success btn-wd' name='confirm' value='Continue' />
                        </div>

                        <div class="pull-left">
                            <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </form>
            </div>
        </div>
        <!-- wizard container -->
        
    </div>
    @endsection


@section('scripts')
<script type="text/javascript">
   $(document).ready(function() {
    $('#list_table').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search individuals",
        }

    });
});
</script>
@endsection
