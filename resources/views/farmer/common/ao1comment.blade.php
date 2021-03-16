@if($data->parcelao1comments())

<div class="card">
    <div class="card-content text-center">
        <h3 class="card-title">
           AO1 Comments
        </h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="">
                    
                    
                    <th>Comments</th>
                    <th>Date of Verification</th>
                    <th>Created By</th>
                    <th>Date Entered</th>
                </thead>
                <tbody>
                    @foreach($data->parcelao1comments() as $parcelao1comment)
                    <tr >
                        
                        
                        <td>{{$parcelao1comment->comments}}</td>
                        <td>{{$parcelao1comment->date_of_verification}}</td>
                        <td>{{$parcelao1comment->createdBy2($parcelao1comment->user_id)->name}}</td>
                        <td>{{$parcelao1comment->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endif