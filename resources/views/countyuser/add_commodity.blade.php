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
                          
                            <form role="form" method="POST" action="{{ route('insertNewCommodity') }}" id="addCommodityForm" enctype="multipart/form-data">
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
	                		<div class="input-group">
	                			<span class="input-group-addon">
	                				<i class="material-icons">date_range</i>
	                			</span>
	                			<div id="grp-commoditygroup" class="form-group{{ $errors->has('commoditygroup') ? ' has-error' : '' }} label-floating">
	                				<label class="control-label">Commodity Group <span class="red">*</span></label>
	                				<select id="commoditygroup" name="commoditygroup" class="form-control dropdown">
	                					<option disabled="" selected=""></option>
	                					@foreach($commoditygroups as $commoditygroup)
	                					<option value="{{$commoditygroup->CommodityGROUPID}}" {{old('commoditygroup')==$commoditygroup->CommodityGROUPID ? 'selected' : '' }}>{{$commoditygroup->CommodityGroupName}}</option>
	                					@endforeach
	                				</select>

	                				<span class="help-block">
	                					<strong id="err-commoditygroup">{{ $errors->first('commoditygroup') }}</strong>
	                				</span>
	                			</div>
	                		</div>
	                	
                		
                		<div class="input-group">
                			<span class="input-group-addon">
                				<i class="material-icons">account_box</i>
                			</span>
                			<div id="grp-commodityname" class="form-group{{ $errors->has('commodityname') ? ' has-error' : '' }} label-floating">
                				<label class="control-label">Commodity Name <span class="red">*</span></label>
                				<input id="commodityname" name="commodityname" type="text" class="form-control" value="{{old('commodityname')}}" style="text-transform:uppercase">

                				<span class="help-block">
                					<strong id="err-commodityname">{{ $errors->first('commodityname') }}</strong>
                				</span>
                			</div>
                		</div>
                		<div class="input-group">
                			<span class="input-group-addon">
                				<i class="material-icons">account_box</i>
                			</span>
                			<div id="grp-variety" class="form-group{{ $errors->has('variety') ? ' has-error' : '' }} label-floating">
                				<label class="control-label">Variety(Leave blank to set as General) </label>
                				<input id="variety" name="variety" type="text" class="form-control" value="{{old('variety')}}" style="text-transform:uppercase">

                				<span class="help-block">
                					<strong id="err-variety">{{ $errors->first('variety') }}</strong>
                				</span>
                			</div>
                		</div>
                		<div class="input-group">
                			<span class="input-group-addon">
                				<i class="material-icons">face</i>
                			</span>
                			<div id="grp-sci_name" class="form-group{{ $errors->has('sci_name') ? ' has-error' : '' }} label-floating">
                				<label class="control-label">Scientific Name </label>
                				<input id="sci_name" name="sci_name" type="text" class="form-control" value="{{old('sci_name')}}" style="text-transform:uppercase">

                				<span class="help-block">
                					<strong id="err-sci_name">{{ $errors->first('sci_name') }}</strong>
                				</span>
                			</div>
                		</div>
                		<div class="input-group">
                			<span class="input-group-addon">
                				<i class="material-icons">face</i>
                			</span>
                			<div id="grp-sci_name_class" class="form-group{{ $errors->has('sci_name_class') ? ' has-error' : '' }} label-floating">
                				<label class="control-label">Scientific Class Name </label>
                				<input id="sci_name_class" name="sci_name_class" type="text" class="form-control" value="{{old('sci_name_class')}}" style="text-transform:uppercase">

                				<span class="help-block">
                					<strong id="err-sci_name_class">{{ $errors->first('sci_name_class') }}</strong>
                				</span>
                			</div>
                		</div>
                		<div class="row round-border-20">
                			<div class = "row">
                				<div class="col-sm-12">
                					<p class="text-center">Optional/Additional Information</p>
                					
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
                							<i class="material-icons">account_box</i>
                						</span>
                						<div id="grp-quater_yield" class="form-group{{ $errors->has('quater_yield') ? ' has-error' : '' }} label-floating">
                							<label class="control-label">Average quaterly yield (kgs) </label>
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
                							<label class="control-label">Average bi-annual yield (kgs) </label>
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
	                							<label class="control-label">Average annual yield (kgs) </label>
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
	                							<label class="control-label">Area Planted (Ha) </label>
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
                </div>
                <div class="wizard-footer">
                    <!-- <div class="pull-right">
                        <a href="#wizard-navigation" type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' id="next">Next</a>
                        <a href="#confirm-card" type='button' id="confirm" class='btn btn-finish btn-fill btn-success btn-wd' name='confirm'>Continue</a>
                    </div>
 -->
                    <div class="row">
                    	<div class="col-md-12">
                    		<button type="submit" id="submit" class="btn btn-success pull-right loading-modal submit" form="addCommodityForm">Submit</button>
                    		
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