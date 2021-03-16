@if($data->enterprises()->count())
<div class="card">
    <div class="card-content">
        <h3 class="card-title">Enterprises
        </h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    <th>Enterprise</th>
                    <th>Type</th>
                </thead>
                <tbody>
                    @foreach($data->enterprises() as $ent)
                    <tr>
                        <td>{{$ent->enterprise}}</td>
                        <td>{{$ent->type}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif