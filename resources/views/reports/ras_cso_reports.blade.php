@extends('layouts.app')

@section('content')



<div class="col-sm-12">
    <div class="wizard-header">
        <h2 class="wizard-title">{{$title}}</h2>
        
        <div class="row">
            <div class="alert alert-info text-center" style="height: 30px; margin-bottom: 0; padding: 5px;">
                <div class="container-fluid">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <i class="fa fa-info-circle" aria-hidden="true" style="color: white"></i> <b>
                    Select which dataset you are interested in.</b>
                </div>
            </div>
        </div>  
    </div>
@if(Auth::user()->role_id !== 9 && Auth::user()->role_id !== 7)
    <div class="row">
        <div class="col-lg-3 col-lg-offset-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <div class="card-content">
                    <p class="category">2015-current Farmer Registration Data</p>
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-footer text-center">
                    <div class="stats ">
                        <a href="{{url('reports/cso_listing')}}/{{$counties->id}}/{{1}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                        <!-- <i class="fa fa-tag" aria-hidden="true"></i> <a href="{{url('/application/list/approved')}}">View FRP List</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <div class="card-content">
                    <p class="category">Pre-2015 data imported from NAMIS</p>
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-footer  text-center">
                    <div class="stats">
                        <a href="{{url('reports/cso_listing')}}/{{$counties->id}}/{{2}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> View NAMIS List</a>
                        <!-- <i class="fa fa-tag" aria-hidden="true"></i> <a href="{{url('/application/list/approved')}}">View NAMIS List</a> -->
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@else
    <!-- <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <div id="county_item" class="card">

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
                            
                            @if($county->id == 1)
                            <div class="col-lg-3 col-lg-offset-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header" data-background-color="green">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">2015-current Farmer Registration Data</p>
                                        <h3 class="card-title"></h3>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="stats ">
                                            <a href="{{url('reports/cso_listing')}}/{{$county->id}}/{{1}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header" data-background-color="green">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </div>
                                    <div class="card-content">
                                        <p class="category">Pre-2015 data imported from NAMIS</p>
                                        <h3 class="card-title"></h3>
                                    </div>
                                    <div class="card-footer  text-center">
                                        <div class="stats">
                                            <a href="{{url('reports/cso_listing')}}/{{$county->id}}/{{2}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View NAMIS List</a>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                           
                            @if($county->id == 4)
                                <div class="col-lg-3 col-lg-offset-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header" data-background-color="green">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">2015-current Farmer Registration Data</p>
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="stats ">
                                                <a href="{{url('reports/cso_listing')}}/{{$county->id}}/{{1}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header" data-background-color="green">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">Pre-2015 data imported from NAMIS</p>
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <div class="card-footer  text-center">
                                            <div class="stats">
                                                <a href="{{url('reports/cso_listing')}}/{{$county->id}}/{{2}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i> View NAMIS List</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                             @endif
                             @if($county->id == 6)
                                <div class="col-lg-3 col-lg-offset-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header" data-background-color="green">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">2015-current Farmer Registration Data</p>
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="stats ">
                                                <a href="{{url('reports/cso_listing')}}/{{$county->id}}/{{1}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header" data-background-color="green">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">Pre-2015 data imported from NAMIS</p>
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <div class="card-footer  text-center">
                                            <div class="stats">
                                                <a href="{{url('reports/cso_listing')}}/{{$county->id}}/{{2}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i> View NAMIS List</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                             @endif
                             @if($county->id == 10)
                                <div class="col-lg-3 col-lg-offset-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header" data-background-color="green">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">2015-current Farmer Registration Data</p>
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <div class="card-footer text-center">
                                            <div class="stats ">
                                                <a href="{{url('reports/cso_listing')}}/{{$county->id}}/{{1}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header" data-background-color="green">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <p class="category">Pre-2015 data imported from NAMIS</p>
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <div class="card-footer  text-center">
                                            <div class="stats">
                                                <a href="{{url('reports/cso_listing')}}/{{$county->id}}/{{2}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i> View NAMIS List</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                             @endif
                        </div>


                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div> -->

    <div class="col-md-12">
    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">FRP Dataset</h2>
        </div>

        <div class="card-content table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-light">
                    <th>County</th>
                    <th>FRP Data(2015-present)</th>
                    <th>Namis Data(pre-2015)</th>
                    
                </thead>
                <tbody>
                    <tr>
                        <td>NAMY</td>
                        <td>
                            <a href="#" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                            <a href="#" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                        </td>
                        <td>
                            
                            <a href="{{asset('/storage/usermanual/RAN/CARO.xlsx')}}" type="button" id="reference" class="btn btn-primary btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>St. Patrick East</td>
                        <td>
                            <a href="#" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                            <a href="#" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                        </td>
                        <td>
                           
                            <a href="#" type="button" id="reference" class="btn btn-primary btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>St. Patrick West</td>
                        <td>
                            <a href="#" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                            <a href="#" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                        </td>
                        <td>
                            
                            <a href="#" type="button" id="reference" class="btn btn-primary btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Victoria</td>
                        <td>
                            <a href="#" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                            <a href="#" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                        </td>
                        <td>
                            
                            <a href="#" type="button" id="reference" class="btn btn-primary btn-round btn-xs " name="reference">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                        </td>
                        
                    </tr>
                    
                </tbody>
            </table>

        </div>
    </div>

</div>
@endif   

</div>



<!-- <div class="row ">
    <div class="col-lg-12 col-md-12 col-sm-12" >
        <div class="card">



        </div>
    </div>

</div> -->



@endsection

@section('scripts')

@endsection

