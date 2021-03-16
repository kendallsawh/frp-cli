@foreach($applications as $app)
@if($app->applicant())

	<tr class="{{Auth::user()->county == $app->applicant()->county? '' : 'info'}}" title="{{Auth::user()->county == $app->applicant()->county? '' : 'Out of County from '.$app->applicant()->county}}" data-toggle="tooltip" >
		<td class="text-center">{{$app->id}}</td>

		<td><a href="{{url('/application/view/'.$app->id)}}" data-original-title="View Application" target="_blank">{{$app->applicant()->name}}</a></td>
		<td>{{$app->applicant()->county}}</td>
		<td>{{$app->applicant()->district}}</td>
		<td>{{$app->applicantType}}</td>
		<td>{{$app->type->application_type}}</td>
		<td>{{$app->status->status}}</td>
		<td>{{$app->createdOn}}</td>
		<td class="td-actions text-center">
			<a href="{{url('/application/view/'.$app->id)}}" rel="tooltip" class="btn btn-info" data-original-title="View Application" title="View Application">
				<i class="fa fa-eye" aria-hidden="true"></i>
				<div class="ripple-container"></div>
			</a>
			@if(Auth::user()->role_id == 7 and $director == 1)

			<a href="{{url('/application/list/director_approval/'.$app->id.'/'.$app->applicant()->id)}}" rel="tooltip" class="btn btn-success" data-original-title="Approve Farmer's Application" title="Approve Farmer's Application">
				<i class="fa fa-check" aria-hidden="true"></i>
				<div class="ripple-container"></div>
			</a>
			@endif

			@if(Auth::user()->role_id == 6 and $ao1 == 1 and $app->status_id ==4)


			<button onclick="myFunction({!!$app->id!!})" type="button" class="btn btn-success" data-toggle="modal" data-target = "#ao1QuickModal" rel="tooltip" title="Recommend Farmer's Application"  ><i class="fa fa-check" aria-hidden="true"></i>
				<div class="ripple-container"></div></button>

				@endif
		</td>
	</tr>



	@endif
	@endforeach