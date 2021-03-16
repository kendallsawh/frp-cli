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

    
@if(Auth::user()->role_id==10)

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
                            <td>Caroni</td>
                            <td>
                                <a href="{{url('reports/cso_listing')}}/1/{{0}}" type="button" id="reference" class="hide btn btn-success btn-round btn-xs loading-modal" name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                <a href="{{asset('/storage/usermanual/RAN/FRP_CARO.xlsx')}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            <td>
                                
                                <a href="{{asset('/storage/usermanual/RAN/CARO.xlsx')}}" type="button" id="reference" class="hide btn btn-primary btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>St. Andrew/St. David</td>
                            <td>
                                <a href="{{url('reports/cso_listing')}}/4/{{0}}" type="button" id="reference" class="hide btn btn-success btn-round btn-xs  " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                <a href="{{asset('/storage/usermanual/RAN/FRP_STAD.xlsx')}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            <td>
                               
                                <a href="{{asset('/storage/usermanual/RAN/STAD.xlsx')}}" type="button" id="reference" class="hide btn btn-primary btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>St. George East</td>
                            <td>
                                <a href="{{url('reports/cso_listing')}}/6/{{0}}" type="button" id="reference" class="hide btn btn-success btn-round btn-xs  " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                <a href="{{asset('/storage/usermanual/RAN/FRP_STGE.xlsx')}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            <td>
                                
                                <a href="{{asset('/storage/usermanual/RAN/STGE.xlsx')}}" type="button" id="reference" class="hide btn btn-primary btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>St. George West</td>
                            <td>
                                <a href="{{url('reports/cso_listing')}}/10/{{0}}" type="button" id="reference" class="hide btn btn-success btn-round btn-xs  loading-modal" name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                <a href="{{asset('/storage/usermanual/RAN/FRP_STGW.xlsx')}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            <td>
                                
                                <a href="{{asset('/storage/usermanual/RAN/STGW.xlsx')}}" type="button" id="reference" class="hide btn btn-primary btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Victoria</td>
                            <td>
                                <a href="#" type="button" id="reference" class="hide btn btn-success btn-round btn-xs loading-modal" name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                <a href="{{asset('/storage/usermanual/RAS/FRP_VICT.xlsx')}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            <td>
                                
                                <a href="{{asset('/storage/usermanual/RAS/VICT.xlsx')}}" type="button" id="reference" class="hide btn btn-primary btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>Nariva/Mayaro</td>
                            <td>
                                <a href="#" type="button" id="reference" class="hide btn btn-success btn-round btn-xs  " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                <a href="{{asset('/storage/usermanual/RAN/FRP_NAMY.xlsx')}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            <td>
                               
                                <a href="{{asset('/storage/usermanual/RAS/NAMY.xlsx')}}" type="button" id="reference" class="hide btn btn-primary btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>St. Patrick East</td>
                            <td>
                                <a href="#" type="button" id="reference" class="hide btn btn-success btn-round btn-xs  " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                <a href="{{asset('/storage/usermanual/RAS/FRP_STPE.xlsx')}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            <td>
                                
                                <a href="{{asset('/storage/usermanual/RAS/STPE.xlsx')}}" type="button" id="reference" class="hide btn btn-primary btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>St. Patrick West</td>
                            <td>
                                <a href="#" type="button" id="reference" class="hide btn btn-success btn-round btn-xs  loading-modal" name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> View FRP List</a>
                                <a href="{{asset('/storage/usermanual/RAS/FRP_STPW.xlsx')}}" type="button" id="reference" class="btn btn-success btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            <td>
                                
                                <a href="{{asset('/storage/usermanual/RAS/STPW.xlsx')}}" type="button" id="reference" class="hide btn btn-primary btn-round btn-xs " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Download as Excel</a>
                            </td>
                            
                        </tr>

                        
                    </tbody>
                </table>

            </div>
        </div>

         
    </div>

@else
    

    
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

