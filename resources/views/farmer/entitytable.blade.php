
                                        <thead class="">
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>County</th>
                                            <th>Created On</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach($data['individuals'] as $ind)
                                            <tr>
                                                <td><a href="{{url('/individual/view')}}/{{$ind->id}}">{{$ind->name}}@if($ind->alias) <i>({{$ind->alias}})</i>@endif</a></td>
                                                <td>Individual</td>
                                                <td>{{$ind->county}}</td>
                                                <td>{{$ind->since}}</td>
                                                <td>
                                                    <div class="radio">
                                                        <label class="" for="ind-{{$ind->id}}">
                                                            <input id="ind-{{$ind->id}}" type="radio" name="selected" value="ind-{{$ind->id}}" class=""><span class="circle"></span><span class="check"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @if($data['organizations']->count() >= 1 || $data['organizations'] !== null)
                                            @foreach($data['organizations'] as $org)
                                            <tr>
                                                <td><a href="{{url('/organization/view')}}/{{$org->id}}">{{$org->name}}</a></td>
                                                <td>Organization</td>
                                                <td>{{$org->county}}</td>
                                                <td>{{$org->since}}</td>
                                                <td>
                                                    <div class="radio">
                                                        <label class="" for="org-{{$org->id}}">
                                                            <input id="org-{{$org->id}}" type="radio" name="selected" value="org-{{$org->id}}" class=""><span class="circle"></span><span class="check"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    