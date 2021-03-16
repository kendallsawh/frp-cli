@extends('layouts.app')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">{{$title}}</h2>
        </div>

        <div class="card-content table-responsive">
            <table class="table table-hover list_table">
                <thead class="">
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    
                </thead>
                <tbody>
                    @foreach($individuals as $individual)
                    
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                    </tr>
                    
                    

                   
                    @endforeach
                </tbody>
            </table>

        </div>
        {{ $individuals->links() }}
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection