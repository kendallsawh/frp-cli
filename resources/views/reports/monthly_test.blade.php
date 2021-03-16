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
                    MONTHLY REPORT FOR THE MONTH: {{$month}} {{$year}}
                </h3>
            </div>
        </div>
    	<div class="col-lg-12 col-md-12 col-sm-12" >
    		<div class = "row">
    			<div class="card-content table-responsive">
    				<table class="table table-hover">
    					<thead class="">
    						<th></th>
    						<th></th>
    						
    					</thead>
    					<tbody>



    						<tr>
    							<td class="text-center" rowspan="5">Number of Applications Received</td>							
    						</tr>
    						<tr>
                                <td>{{$new}}<br>
                                </td>
                                <td>New<br>
                                   ({{$newcompleted}} Approved)
                                </td>
                                
                            </tr>
                            
    						<tr>
    							<td>{{$renewal}}
    							</td>
    							<td>Renewal
    							</td>
    						</tr>
    						<tr>
    							<td>{{$outofcounty}}
    							</td>
    							<td>Out of County
    							</td>
    						</tr>
    						<tr>
    							<td><b>{{$new + $renewal + $outofcounty}}</b>
    							</td>
    							<td><b>Total</b>
    							</td>
    						</tr>
    						<tr>
    							<td class="text-center">Number of Applications Recommended (AOI)</td>
    							
    							<td>
    								<b>{{$recommended}}</b>
    							</td>
    							<td>
    								<b>Total</b>
    							</td>
    							
    							
    						</tr>
    						<tr>
    							<td class="text-center">Number of Bonifide Applications Recieved</td>
    							<td>
    								<b>0</b>
    							</td>
    							<td>
    								<b>Total</b>
    							</td>
    							
    						</tr>
    						<tr>
    							<td class="text-center">Number of Landless/State Occupiers Recieved</td>
    							<td>
    								<b>0</b>
    							</td>
    							<td>
    								<b>Total</b>
    							</td>
    							
    						</tr>
    						<tr>
    							<td class="text-center">Number of Cards Issued(New)</td>
    							<td>
    								<b>0</b>
    							</td>
    							<td>
    								<b>Total</b>
    							</td>
    							
    						</tr>
    						<tr>
    							<td class="text-center">Number of Cards Issued(Renew)</td>
    							<td>
    								<b>0</b>
    							</td>
    							<td>
    								<b>Total</b>
    							</td>
    							
    						</tr>
    						<tr>
    							<td class="text-center">Number of Inspection Completed</td>
    							<td>
    								<b>{{$inspectioncompleted}}</b>
    							</td>
    							<td>
    								<b>Total</b>
    							</td>
    							
    						</tr>
    						<tr>
                                <td class="text-center">Number of Applications Approved</td>
                                <td>
                                    <b>{{$approved}}</b>
                                </td>
                                <td>
                                    <b>Total</b>
                                </td>
                                
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
         //alert(user);
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

