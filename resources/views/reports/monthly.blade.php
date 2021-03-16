@extends('layouts.app')

@section('content')



    <div class="card">
        <div class="row">
            <div class="card-content col-sm-12">
                <h3 class="card-title text-center" style="padding-left:25px;">
                    Crops/Animals List Options
                </h3>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12" >
            <form role="form" method="POST" action="{{ route('monthlyReportSubmit') }}" id="commodityStatForm" enctype="multipart/form-data">
               {{ csrf_field() }}
                <div class="row"> 
                      <div class="col-sm-6">

                			<div class="input-group">
                				<span class="input-group-addon">
                					<i class="material-icons">date_range</i>
                				</span>
                				<div id="grp-monthselect" class="form-group{{ $errors->has('monthselect') ? ' has-error' : '' }} label-floating">
                					<label class="control-label">Select Report Month <span class="red">*</span></label>
                					<input id="monthselect" name="monthselect" type="text" class="form-control datepicker" autocomplete="off" value="{{old('monthselect')}} "readonly>


                					<span class="help-block">
                						<strong id="err-monthselect">{{ $errors->first('monthselect') }}</strong>
                					</span>
                				</div>
                			</div>


                		</div>
                		
                </div>
                
                
            </form>
        </div>
        <div class="card-content col-sm-12">
	        <div class="row">
	           <button type="submit" id="submit" class="btn btn-success pull-right loading-modal submit" form="commodityStatForm">Search</button>
	        </div>
        </div>
    </div>
    
    <div class="card">
    	<div class="row">
            <div class="card-content col-sm-12">
                <h3 class="card-title text-center" style="padding-left:25px;">
                    MONTHLY REPORTS FOR THE MONTH: {{$month}} {{$year}}
                </h3>
            </div>
            <div class="col-sm-12">
                <h3 class="card-title  text-left" style="padding-left:25px;">
                    APPLICATIONS (NEW)
                </h3>
            </div>
        </div>
    	<div class="col-lg-12 col-md-12 col-sm-12" >
    		<div class = "row">
    			<div class="card-content table-responsive">
    				<table class="table table-hover table-sm ">
    					<thead class="thead-dark">
    						<th>Districts</th>
    						<th>B/f</th>
    						<th>Recommended</th>
    						<th>Bonafide</th>
    						<th>Landless</th>
    						<th>Total</th>
    					</thead>
    					<tbody>
    						<tr class="info">
    							<td><b>BARRACKPORE</b></td>
    							<td></td>
    							<td></td>
    							<td></td>
    							<td></td>
    							<td></td>
    						</tr>
    						<tr>
    							<td class="text-center">Farmer</td>
    							<td>1230</td>
    							<td>10</td>
    							<td>10</td>
    							<td>0</td>
    							<td>1240</td>
    						</tr>
    						<tr>
    							<td class="text-center">Squatter</td>
    							<td>153</td>
    							<td>1</td>
    							<td>0</td>
    							<td>1</td>
    							<td>154</td>
    						</tr>
    							
    						
    						<tr class="info">
    							<td><b>MORUGA</b></td>
    							<td></td>
    							<td></td>
    							<td></td>
    							<td></td>
    							<td></td>
    						</tr>
    						<tr>
    							<td class="text-center">Farmer</td>
    							<td>1395</td>
    							<td>13</td>
    							<td>13</td>
    							<td>0</td>
    							<td>1408</td>
    						</tr>
    						<tr>
    							<td class="text-center">Squatter</td>
    							<td>356</td>
    							<td>3</td>
    							<td>0</td>
    							<td>3</td>
    							<td>359</td>
    						</tr>

    						<tr class="success">
    							<td><b>TOTAL</b></td>
    							<td>3134</td>
    							<td>27</td>
    							<td>23</td>
    							<td>4</td>
    							<td>3161</td>
    						</tr>
    					</tbody>
    				</table>

    			</div>
    		</div>
    	</div>
    	<div class="row">
            <div class="card-content col-sm-12">
                <button type="button" id="detailed_report" class="btn btn-success pull-right">More</button>
            </div>
        </div>
    </div>
    <div class="card" id="more_details">
    </div>
@endsection

@section('scripts')
<script type="text/javascript">


	$(".datepicker").datepicker( {
		format: "dd-mm-yyyy",
		viewMode: "months", 
		minViewMode: "months"
	}).datepicker("setDate", new Date());

	/*
    |Found in report controller
    |Ajax call to return more data on monthly report
    */
    $(document).on('click', '#detailed_report', function() {
         //$('#county_check').show();
         var county = {!!auth()->user()->CountyId!!};
         var date_range = $('.datepicker').val();
         //alert(date_range);
         $.ajax({
         	type: "POST",
         	url: '{{url('monthly_breakdown')}}',
         	data: {date_select:date_range, county:county},
         	dataType: "json",
         	success: function(res) {
         		console.log(res);
         	},
         	error: function (data) {
         		var errors = data.responseJSON;
                //console.log(data.message);
                console.log(errors);

                

            }
        });
     });
</script>  
@endsection

