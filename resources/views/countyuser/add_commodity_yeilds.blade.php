@extends('layouts.app')

@section('content')

<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Function</a></li>
        <li><a href="{{route('individualList')}}">View Profile</a></li>
        <li class="active">{{$title}}</li>
    </ul>

    <div class="row">
        <div class="card-content" style="padding-top: 40px">

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-profile">

                                <div class="card-content">
                                    <div class="row">
                                    	<div class="card-header">
                                    		<h2 class="card-title">{{$title}}</h2>

                                    		</div>
                                        
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                          
            <form role="form" method="POST" action="{{ route('insertNewCommodityYield') }}" id="addCommodityyieldsForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="user" value="{{Auth::user()->id}}">

                
                
                
                <div class="col-md-12 required">
                    <p>
                        <label>
                            <span class="red">*</span> Required Fields <br>
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> At least one is required
                        </label>
                    </p>
                </div>
                <div class="row">
                	<div class="col-sm-12">
	                	
                		
                			<div class = "row">
                				<div class="col-sm-12">
                					<p class="text-center">The system can record the same crop but with alternate harvest types. Example: Banana yield by hectarage or banana yield by standard number of trees planted.</p>
                					
                				</div>
                			</div>
                			<div class = "row">
                				<div class="col-sm-6">
                					<div class="input-group">
                						<span class="input-group-addon">
                							<i class="material-icons">date_range</i>
                						</span>
                						<div id="grp-harvest_type" class="form-group{{ $errors->has('harvest_type') ? ' has-error' : '' }} label-floating">
                							<label class="control-label">Commodity Harvest Type <span class="red">*</span></label>
                							<select id="harvest_type" name="harvest_type" class="form-control dropdown">
                								<option disabled="" selected=""></option>
                								@foreach($commharvtyps as $commharvtyp)
                								<option value="{{$commharvtyp->id}}" {{old('harvest_type')==$commharvtyp->id ? 'selected' : '' }}>{{$commharvtyp->type}}</option>
                								@endforeach
                							</select>

                							<span class="help-block">
                								<strong id="err-harvest_type">{{ $errors->first('harvest_type') }}</strong>
                							</span>
                						</div>
                					</div>
                				</div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div id="grp-commodity" class="form-group{{ $errors->has('commodity') ? ' has-error' : '' }} label-floating">
                                            <label class="control-label">Commodity <span class="red">*</span></label>
                                            <select id="commodity" name="commodity" class="form-control dropdown">
                                                <option disabled="" selected=""></option>
                                                @foreach($commodities as $commodity)
                                                <option value="{{$commodity->id}}" {{old('commodity')==$commodity->id ? 'selected' : '' }}>{{$commodity->CommodityLocalName}}</option>
                                                @endforeach
                                            </select>

                                            <span class="help-block">
                                                <strong id="err-commodity">{{ $errors->first('commodity') }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                				<div class="col-sm-6">
                					<div class="input-group">
                						<span class="input-group-addon">
                							<i class="material-icons">account_box</i>
                						</span>
                						<div id="grp-quater_yield" class="form-group{{ $errors->has('quater_yield') ? ' has-error' : '' }} label-floating">
                							<label class="control-label">Average quaterly yield (kgs) <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                							<input id="quater_yield" name="quater_yield" type="number" class="form-control" value="{{old('quater_yield')}}" autocomplete="off">

                							<span class="help-block">                        
                								
                								<strong id="err-quater_yield">{{ $errors->first('quater_yield') }}</strong>
                							</span>
                						</div>
                					</div>
                				</div>
                				<div class="col-sm-6">
                					<div class="input-group">
                						<span class="input-group-addon">
                							<i class="material-icons">date_range</i>
                						</span>
                						<div id="grp-bi_annual_yield" class="form-group{{ $errors->has('bi_annual_yield') ? ' has-error' : '' }} label-floating">
                							<label class="control-label">Average bi-annual yield (kgs) <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
                							<input id="bi_annual_yield" name="bi_annual_yield" type="number" class="form-control" autocomplete="off" value="{{old('bi_annual_yield')}}">

                							<span class="help-block">
                								<!-- <strong id="">Date should be at least 3 years prior to application date on the application form</strong><br> -->
                								<strong id="err-bi_annual_yield">{{ $errors->first('bi_annual_yield') }}</strong>
                							</span>
                						</div>
                					</div>
                				</div>
                				

                					<div class="col-sm-6">
                						<div class="input-group">
                						<span class="input-group-addon">
                							<i class="material-icons">date_range</i>
                						</span>
	                						<div id="grp-annual_yield" class="form-group{{ $errors->has('annual_yield') ? ' has-error' : '' }} label-floating">
	                							<label class="control-label">Average annual yield (kgs) <i class="fa fa-exclamation-circle" aria-hidden="true"></i></label>
	                							<input id="annual_yield" name="annual_yield" type="number" class="form-control" value="{{old('annual_yield')}}" >

	                							<span class="help-block">
	                								<strong id="err-annual_yield">{{ $errors->first('annual_yield') }}</strong>
	                							</span>
	                						</div>
	                					</div>
                					</div>
                					<div class="col-sm-6">
                						<div class="input-group">
                						<span class="input-group-addon">
                							<i class="material-icons">date_range</i>
                						</span>
	                						<div id="grp-area_planted" class="form-group{{ $errors->has('area_planted') ? ' has-error' : '' }} label-floating">
	                							<label class="control-label">Area Planted (Ha) <span class="red">*</span></label>
	                							<input id="area_planted" name="area_planted" type="number" class="form-control" value="{{old('area_planted')}}">

	                							<span class="help-block">
	                								<strong id="err-area_planted">{{ $errors->first('area_planted') }}</strong>
	                							</span>
	                						</div>
	                					</div>
                					</div>
                				 
                			</div>
                		
                	</div>
                </div>
                <div class="wizard-footer">
                    
                    <div class="row">
                    	<div class="col-md-12">
                    		<button type="submit" id="submit" class="btn btn-success pull-right loading-modal submit" form="addCommodityyieldsForm">Submit</button>
                    		
                    	</div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </form>

                          
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    

</script>
@endsection