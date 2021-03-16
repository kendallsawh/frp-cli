@extends('layouts.app')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">Farmer Table</h2>
        </div>

        <div class="card-content table-responsive">
            <table class="table">
                <thead class="">
                    <th class="text-center">No</th>
                    <th>Name</th>
                    <th>County</th>
                    <th class="text-center">No. of Enterprises</th>
                    <th class="text-center">No. of Parcels</th>
                    <th>Status</th>
                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Dakota Rice</td>
                        <td>Caroni</td>
                        <td class="text-center">4</td>
                        <td class="text-center">2</td>
                        <td class="text-success">Verified</td>
                        <td class="td-actions text-center">
                            <button type="button" rel="tooltip" class="btn btn-info" data-original-title="View Farmer" title="">
                                <i class="material-icons">person</i>
                                <div class="ripple-container"></div></button>
                                <button type="button" rel="tooltip" class="btn btn-success" data-original-title="Edit Famer" title="">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-danger" data-original-title="Remove Farmer" title="">
                                    <i class="material-icons">close</i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

        </div>
    </div>
</div>
@endsection
