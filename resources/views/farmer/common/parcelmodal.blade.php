<div class="modal fade" id="parcelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Parcels</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="">
                            <th>Address</th>
                            <th>Land Type</th>
                            <th>County</th>
                            <th>Area</th>
                            <th>Tenure</th>
                            <th>Proof</th>
                            <th>Type of Crop/Animal</th>
                            <th>Specific Crop/Animal</th>
                            <th class="text-right">Amount</th>
                        </thead>
                        <tbody>
                            @foreach($data->parcels() as $n => $parcel)
                            @foreach($parcel->produce() as $i => $produce)
                            <tr class="{{$n % 2 == 0? 'active' : ''}}">
                                @if($i == 0)
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->land->address->address}}</td>
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->land_type->land_type}}</td>
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->county}}</td>
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->area}}</td>
                                <td rowspan="{{$parcel->produce_count}}">{{$parcel->tenure->tenure}}</td>
                                <td rowspan="{{$parcel->produce_count}}">
                                    @foreach($parcel->proofs as $proof)
                                    {{$proof->proof_code->proof}}
                                    <ul>
                                        @foreach($proof->documents as $doc)
                                        @if($doc)
                                        <li><a href="{{$doc->document}}" target="_blank">{{$doc->type}}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    @endforeach
                                </td>
                                @endif

                                <td>{{$produce->type->parcel_type}}</td>
                                <td>{{$produce->specific_parcel}}</td>
                                <td class="text-right">{{number_format($produce->amt)}} {{$produce->type->unit->parcel_unit}}</td>
                            </tr>
                            @endforeach
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>