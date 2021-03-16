<div class="tab-pane" id="list">
    <div class="col-sm-12">
        <div class="card-content table-responsive">
            <table id="list_table" class="table table-hover">
                <thead class="">
                    <th class="text-center">No</th>
                    <th>Applicant</th>
                    <th>Type</th>
                    <th>Registration</th>
                    <th>Status</th>
                    <th>Issue Date</th>
                    <th>Created By</th>
                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    <tr>
                        <td class="text-center">{{$app->id}}</td>
                        <td><a target="_blank" href="{{url('/individual/view')}}/{{$app->applicant()->id}}">{{$app->applicant()->f_name}} {{$app->applicant()->m_name}} {{$app->applicant()->l_name}}</a></td>
                        <td>{{$app->type->application_type}}</td>
                        <td>{{$app->registration->type}}</td>
                        <td>{{$app->status->status}}</td>
                        <td>{{$app->createdOn}}</td>
                        <td>{{$app->createdBy->name}}</td>
                        <td class="td-actions text-center">
                            <button type="button" rel="tooltip" class="btn btn-success" data-original-title="Renew Farmer" title="">
                                <i class="material-icons">edit</i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
   $(document).ready(function() {
    $('#list_table').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search applications",
        }

    });
});
</script>
@endsection