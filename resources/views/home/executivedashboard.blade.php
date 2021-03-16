<ul class="nav nav-pills  nav-justified" role="tablist" >
@foreach($counties as $key=>$county)

    <li id="nav-item">
        <a class="nav-link" id="pills-{{$county->id}}-tab" data-toggle="pill" href="#pills-bhh-{{$county->id}}" role="tab" aria-controls="pills-bhh-{{$county->id}}">

            <i class="fa fa-pie-chart" aria-hidden="true"></i><h3 class="card-title">{{$county->county}}</h3>
        </a>
        
    </li>
@endforeach
</ul>

<div class="tab-content" id="pills-tabContent">
    @foreach($counties as $county)

        <div class="tab-pane fade" id="pills-bhh-{{$county->id}}" role="tabpanel" aria-labelledby="pills-{{$county->id}}-tab">
            <div class="row">
                <!-- Pending -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <div class="card-content">
                            <p class="category">Pending In-County Applications for {{$county->county}}</p>
                            <h3 class="card-title">{{$county->pending_app}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="fa fa-warning" aria-hidden="true"></i>
                                <a href="{{url('/application/list/pending/'.$county->id)}}">View Pending Applications...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- approved -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </div>
                        <div class="card-content">
                            <p class="category">Approved In-County Applications for {{$county->county}}</p>
                            <h3 class="card-title">{{$county->approved_app}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="fa fa-tag" aria-hidden="true"></i> <a href="{{url('/application/list/approved/'.$county->id)}}">View Approved Applications</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- flagged -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="red">
                            <i class="fa fa-flag" aria-hidden="true"></i>
                        </div>
                        <div class="card-content">
                            <p class="category">Flagged In-County Applications for {{$county->county}}</p>
                            <h3 class="card-title">{{$county->flaged_app >= 1? $county->flaged_app : 0}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="fa fa-flag" aria-hidden="true"></i> <a href="{{url('/application/list/flagged/'.$county->id)}}" >View Flagged Applications</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- out of county -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="blue">
                            <i class="fa fa-archive"></i>
                        </div>
                        <div class="card-content">
                            <p class="category">Out of County for {{$county->county}}</p>
                            <h3 class="card-title">{{$county->out_app}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="fa fa-pencil" aria-hidden="true"></i> <a href="#">View Applications</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- migrated -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <div class="card-content">
                            <p class="category">Number of Farmer Records for {{$county->county}}</p>
                            <h3 class="card-title">{{$county->Totalind}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="fa fa-pencil" aria-hidden="true"></i> <a href="#">View Applications</a>
                            </div>
                        </div>
                    </div>        
                </div>
                <!-- web registered -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="fa fa-cloud-download" aria-hidden="true"></i>
                        </div>
                        <div class="card-content">
                            <p class="category">Web-Registered Applications</p>
                            <h3 class="card-title">{{$county->WebRegister}}</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="fa fa-pencil" aria-hidden="true"></i> <a href="#">View Web Registered Applications</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
</div>

