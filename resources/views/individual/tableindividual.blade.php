 @foreach($individuals as $ind)

 <tr>
 	<td class="text-right">{{$ind->id}}</td>
 	<td class="text-center">
 		<div class="list-avatar">
 			<a href="{{url('/individual/view')}}/{{$ind->id}}">
 				<img class="img" src="{{$ind->avatar}}" alt="Avatar"/>
 			</a>
 		</div>
 	</td>
 	<td><a href="{{url('/individual/view')}}/{{$ind->id}}">{{$ind->name}}@if($ind->alias) <i>({{$ind->alias}})</i>@endif</a></td>
 	<td>{{$ind->gender->gender}}</td>
 	<td class="text-center">{{$ind->age}}</td>
 	<td>{{$ind->county}}</td>
 	<td class="text-center">{{$ind->parcelsCount()}}</td>
 	<td class="text-center">{{$ind->enterpriseCount()}}</td>
 	<td>{{$ind->since}}</td>
 	<td>{{$ind->createdBy->name}}</td>
 	<td class="td-actions text-center">
 		<a href="{{url('/individual/view')}}/{{$ind->id}}" rel="tooltip" class="btn btn-info" data-original-title="View Farmer" title="">
 			<i class="fa fa-eye" aria-hidden="true"></i>
 			<div class="ripple-container"></div>
 		</a>
 		<a href="{{url('/individual/edit')}}/{{$ind->id}}" rel="tooltip" class="btn btn-success" data-original-title="View Farmer" title="">
 			<i class="fa fa-edit" aria-hidden="true"></i>
 			<div class="ripple-container"></div>
 		</a>
 		<button type="button" rel="tooltip" class="btn btn-success hide" data-original-title="Edit Farmer" title="">
 			<i class="material-icons">edit</i>
 		</button>
 		<button type="button" rel="tooltip" class="btn btn-danger hide" data-original-title="Remove Farmer" title="">
 			<i class="material-icons">close</i>
 		</button>
 	</td>
 	
 </tr>
 
 @endforeach