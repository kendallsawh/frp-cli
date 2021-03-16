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
                    Select the report you want.</b>
                </div>
            </div>
        </div>  
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 " >
            <div class="row">
                    
                    <div class="col-sm-4 col-sm-offset-4">
                        <!-- <div class="btn-group btn-block" role="group" aria-label="Basic example"> -->
                            <a href="{{route('cropReport1')}}" target="_blank" type='button' id="report1" class='btn btn-info btn-round btn-sm btn-block ' rel="tooltip"  title="Generates an excel of farmer information based on selected County" >County-Farmer-Crop <i class="fa fa-download"></i></a>
                            <a href="{{route('cropFarmerReportByDistrict')}}" target="_blank" type='button' id="report2" class='btn btn-info btn-round btn-sm btn-block ' rel="tooltip"  title="Generates an excel of farmer information based on selected Farming District" >District-Farmer-Crop <i class="fa fa-download"></i></a>
                            <a href="{{route('farmerParcelCounty')}}" type="button" id="reference" class="btn btn-success btn-round btn-sm btn-block" name="reference" target="_blank" >Farmer Parcel Report</a>
                            <a href="#" type="button" id="reference" class="btn btn-success btn-round btn-sm btn-block" name="reference" target="_blank" >Report 4 Coming Soon</a>
                       <!--  </div> -->
                    </div>
                    
                </div>
        </div>
   

</div>


@endsection