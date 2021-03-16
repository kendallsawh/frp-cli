<div class="wizard-header">
            <h2 class="wizard-title">{{$title}}</h2>
        </div>
        
        <div class="card-content table-responsive">
            <table id="list_table" class="table table-hover">
                <thead class="">
                    
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th class="text-center">Age</th>
                    <th>County</th>
                    <th class="text-center">Parcels</th>
                    <th class="text-center">Enterprises</th>
                    <th>Created On</th>
                    
                    
                </thead>
                <tbody>
                    @foreach($individuals as $ind)
                    
                    <tr>
                        
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
                        
                        
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>