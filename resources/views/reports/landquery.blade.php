@extends('layouts.app')

@section('content')



    <div class="card hide">
        <div class="row">
            <div class="card-content col-sm-12">
                <h3 class="card-title text-center" style="padding-left:25px;">
                    Crops/Animals List Options
                </h3>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 " >
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
                    {{$title}}
                </h3>
            </div>
            
        </div>
    	<div class="col-lg-12 col-md-12 col-sm-12" >
    		<div class = "row">
    			<form method="POST" type = "hidden" action="{{route('landqueryresult')}}" id="seachlandtype" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="hidden-input">

                    </div>
                    <div class="col-sm-4">
                        <div id="grp-land_type" class="form-group{{ $errors->has('land_type') ? ' has-error' : '' }} label-floating">
                            <label class="control-label">Select Land Type <span class="red">*</span></label>
                            <select id="land_type" name="land_type" class="form-control dropdown">
                                <option disabled="" selected=""></option>
                                @foreach($landtypes as $landtype)
                                <option value="{{$landtype->id}}" {{old('landtype')==$landtype->id ? 'selected' : '' }}>{{$landtype->land_type}}</option>
                                @endforeach
                            </select>

                            <span class="help-block">
                                <strong id="err-land_type">{{ $errors->first('land_type') }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-8">

                        
                            
                                <div class="form-group row">

                                    <label for="choose-type" class="col-md-1 form-control-label label-inline">Return:</label>
                                    <div id="choose-type" class="col-md-8 div-inline">

                                        <label class="radio-inline">
                                            <input type="radio" class="radio-inline" name="search_type" id="namesearch" value="1" required=""> Farmers
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" class="radio-inline" name="search_type" id="idsearch" value="2" required=""> Parcels
                                        </label>
                                    </div>
                                </div>

                               
                        
                    </div>
                </form>
    		</div>
            <div class="card-content col-sm-12">
            <div class="row hide">
               <button type="submit" id="submit_land" class="btn btn-success loading-modal pull-right submit" form="seachlandtype">Search</button>
            </div>
        </div>
    	</div>
    	<div class="row">
            <div class="card-content col-sm-12">
                <button type="button" id="detailed_report" class="btn btn-success pull-right">More</button>
                
            </div>
        </div>
    </div>
    
</div>
        <div class="card" id="more_details" tabindex="44">
            
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
        var land_type = $('#land_type').val();
        //alert(user);
        $.ajax({
         	type: "POST",
         	url: '{{url('reports/landqueryresult')}}',
         	data: {land_type:land_type, county:county, search_type:val},
         	
         	success: function(res) {
         		//console.log(res);
                $('#more_details').empty().html(res);
                
                //$('tbody').empty().html(res);
                $('#list_table').DataTable({
                "pagingType": "numbers",
                
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                }

            }); 
                //$('#more_details').removeClass('hide');
                //$('#table_title').empty().html(res);
                //$('body').animate({ scrollTop: $('#more_details').offset().top },500);
                
                $("#more_details").attr("tabindex",44).focus();
         	},
         	error: function (data) {
         		var errors = data.responseJSON;
                //console.log(data.message);
                console.log(errors);

                

            }
        });
        /*$('html,body').animate({scrollTop: $('#more_details').offset().top}, 1000, function() {
                    $('#more_details').focus();
                });*/
       
        
        
        //$('html,body').animate({ scrollTop: $('#more_details').offset().top },500);
     });

  
    $("#seachlandtype").submit(function(e) {
       
        e.preventDefault(); // avoid to execute the actual submit of the form.
        
        var form = $(this);
        var url = form.attr('reports/landqueryresult');

        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               dataType: "json",
               success: function(res)
               {
                   console.log(res); // show response from the php script.
                   if(res){
                      $('#more_details').empty().html(res.data);  
                    }
               },
               error: function (b) {
                    var errors = b.responseJSON;
                    //console.log(data.message);
                    console.log(errors);

                    

                }
             });


    });

    /*------------------------------------------------------------------*/
    var val = 0;

 $(document).ready(function() {
            
    $('#namesearch').prop('checked', true);
    //alert(val);
    val = 1;
    //alert(val);
    $(document).on('change', '[name="search_type"]', function() {
            val = $(this).val();
            $('#search_ind').val('');
            //alert($(this).val());
            //bloodhound.clear();
            $( ".tt-menu" ).remove();

            
        });
    
    });
</script>  
@endsection

