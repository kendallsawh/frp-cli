<div class="modal fade" id="viewreferenceModal" tabindex="-1" role="dialog" aria-labelledby="viewrefModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="viewrefModalLabel">Add as farmer?</h4>
            </div>
            <div class="modal-body">
                
            	<table id="list_table" class="table table-hover">
            		<thead class="">
            			<th>Badge Number</th>
            			<th>Year</th>
            			<th>Issue Date</th>
            			<th>Indiviidual ID</th>
            			<th>Name</th>
            			<th>Phone</th>
            			<th>Home Addess</th>
            			<th>Farm Address</th>
            			<th>Acre</th>
            			<th>Commodity</th>
            			<th>Company Name</th>
            			<th>Tenure</th>
            			<th>District</th>
            			<th>Card</th>

            		</thead>
            		<tbody>
            			@foreach($farmerreferences as $farmerreference)
            			<tr>
            				<td class="text-right">{{$farmerreference->reg_badge}}</td>
            				<td class="text-center">{{$farmerreference->year_}}</td>
            				<td>{{$farmerreference->issue_date}}</td>
            				<td>{{$farmerreference->individual_id}}</td>
            				<td>{{$farmerreference->first_name}} {{$farmerreference->last_name}}</td>
            				<td>{{$farmerreference->phone}}</td>
            				<td>{{$farmerreference->home_address}}</td>
            				<td>{{$farmerreference->farm_address}}</td>
            				<td>{{$farmerreference->acre}}</td>
            				<td>{{$farmerreference->commodity}}</td>
            				<td>{{$farmerreference->company_name}}</td>
            				<td>{{$farmerreference->tenure}}</td>
            				<td>{{$farmerreference->district}}</td>
            				<td>{{$farmerreference->card}}</td>

            			</tr>
            			@endforeach
            		</tbody>
            	</table>

                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-fill btn-blue" form="flag_form">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>