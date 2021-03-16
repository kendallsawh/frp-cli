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
    <div class="col-lg-12 col-md-12 col-sm-12" >
            <form role="form" method="POST" action="{{ route('farmerParcelCountyDownload') }}" id="commodityStatForm" enctype="multipart/form-data">
               {{ csrf_field() }}
                
           
                <div class="row">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="info-text" style="padding-left:25px;">
                                Search by County or
                            </h4>
                        </div>
                        
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group{{ $errors->has('county') ? ' has-error' : '' }} label-floating" id="grp-county">
                            <label class="control-label">County</label>

                            <select id="county" name="county" class="form-control dropdown county" >
                                <option disabled="" selected=""></option>
                                @foreach($counties as $key=>$county)
                                <option value="{{$county->id}}" {{old('county')==++$key ? 'selected' : '' }}>{{$county->county}}</option>
                                @endforeach
                            </select>

                            <span class="help-block">
                                <strong id="err-county"></strong>
                            </span>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <button type="submit" id="submit" class="btn btn-success pull-right loading-modal submit" form="commodityStatForm">Search</button>
                </div>
            </form>
        </div>
   

</div>


@endsection