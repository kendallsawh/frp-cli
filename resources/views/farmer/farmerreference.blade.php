@extends('layouts.app')

@section('content')

<div class="col-md-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">{{$title}}</li>
    </ul>

    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">{{$title}}</h2>
        </div>

        <div class="card-content table-responsive">
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
            searchPlaceholder: "Search references",
        }

    });
});
</script>
@endsection
