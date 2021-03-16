<div class="wizard-header">
            <h2 class="wizard-title">{{$title}}</h2>
        </div>
        
        <div class="card-content table-responsive">
            <table id="list_table" class="table table-hover">
                <thead class="">
                    
                    <th>Address</th>
                    <th>County</th>
                    <th>Tenure</th>
                    <th>Stated Area(size)</th>
                    <th class="text-center">Type of Crop/Amimal</th>
                    <th>Specific Crop/Animal</th>
                    <th class="text-center">Area Used</th>
                    
                    
                    
                </thead>
                <tbody>
                    @foreach($parcels as $n => $parcel)
                    	@if($parcel->produce()->count()==0)
                            <tr class="{{$n % 2 == 0? 'active' : ''}}" id="parcelRow{{$parcel->id}}">
                            	<td >{{$parcel->land->address->address}}</td>
                            	<td >{{$parcel->county}}</td>
                            	<td >{{$parcel->area}}</td>
                            	<td >{{$parcel->tenure->tenure}}</td>
                            	<td>N/A</td>
                            	<td>N/A</td>
                            	<td class="text-right">N/A</td>
                            </tr>
                        @else
                        	@foreach($parcel->produce() as $i => $produce)
			                    <tr class="{{$n % 2 == 0? 'active' : ''}}" id="parcelRow{{$parcel->id}}">
			                        @if($i == 0)
			                        <td rowspan="{{$parcel->produce_count}}">{{$parcel->land->address->address}}</td>
			                        <td rowspan="{{$parcel->produce_count}}">{{$parcel->county}}</td>
			                        <td rowspan="{{$parcel->produce_count}}">{{$parcel->tenure->tenure}}</td>
			                        <td rowspan="{{$parcel->produce_count}}">{{$parcel->area}}</td>
                                                    
                                                    
			                        @endif
			                        <td>{{$produce->type->parcel_type}}</td>
			                        <td>{{$produce->specific_parcel}}</td>
			                        <td class="text-center">{{number_format($produce->amt)}} {{$produce->type->unit->parcel_unit}}</td>
			                    </tr>
		                    @endforeach
                    	@endif
                    @endforeach
                </tbody>
            </table>
        </div> 