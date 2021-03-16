@extends('layouts.app')

@section('content')

 <li class=""><a href="{{ route('farmerRegister') }}">Farmer Registration</a></li>



<!-- <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card">
            <div class="card-header card-header-tabs" data-background-color="rose">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <span class="nav-tabs-title">Tasks:</span>
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="active">
                                <a href="#profile" data-toggle="tab">
                                    <i class="material-icons">announcement</i> Announcements
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                            <li class="">
                                <a href="#messages" data-toggle="tab">
                                    <i class="material-icons">report_problem</i> Bulletin
                                    <div class="ripple-container"></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <table class="table">
                          <thead>
                            <tr>
                                <th>No.</th>
                                <th>Details</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>Having trouble registering a person? then download the usermanual today! Click the green arrow to get the pdf</td>
                                <td class="td-actions text-right">
                                    <a href="{{asset($path)}}" target="_blank" type='button' id="confirm" title="Downlad User Manual" class="btn btn-primary btn-simple btn-xs"><i class="fa fa-sign-out"></i></a>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="messages">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Details</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        1
                                    </td>
                                    <td>Flooded? Disaster relief is comming your way!
                                    </td>
                                    <td class="td-actions text-right">
                                        
                                        <a href="#" target="_blank" type='button' id="confirm" class="btn btn-primary btn-simple btn-xs"><i class="fa fa-sign-out"></i></a>
                                        <!-- <button type="button" rel="tooltip" title="View More" class="btn btn-primary btn-simple btn-xs">
                                            <i class="fa fa-sign-out"></i>
                                        </button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-calendar">
            <div class="card-content">
            <div id="fullCalendar" class="fc fc-unthemed fc-ltr"></div>
            </div>
        </div>
    </div>

</div> -->
@include('home.notifications')
@endsection

@section('scripts')
<script type="text/javascript">
   
</script>
@endsection

