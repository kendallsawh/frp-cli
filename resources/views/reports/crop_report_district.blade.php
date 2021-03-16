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
            <form role="form" method="POST" action="{{ route('cropReport1Download') }}" id="commodityStatForm" enctype="multipart/form-data">
               {{ csrf_field() }}
                
                <div class="row">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="info-text" style="padding-left:25px;">
                                Search by District
                            </h4>
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }} label-floating" id="grp-district">
                            <label class="control-label">District</label>

                            <select id="district" name="district" class="form-control dropdown district" >
                                <option disabled="" selected=""></option>
                                @foreach($districts as $key=>$district)
                                <option value="{{$district->id}}" {{old('district')==++$key ? 'selected' : '' }}>{{$district->district_name}}</option>
                                @endforeach
                            </select>

                            <span class="help-block">
                                <strong id="err-district"></strong>
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