<div class="card " id="confirm-card" style="padding: 30px; display: none;">
    <div class="tab-content">
        <div class="row">
            <h2>
                Please confirm that the application data is correct.
                <a href="#wizard-navigation" type='button' class='btn btn-danger pull-right' id="edit">Edit</a>
            </h2>
        </div>
        <form class="form-horizontal">
            <h4>Application Type</h4>
            <div class="form-group">
                <label for="" class="col-lg-2 control-label">Job:</label>
                <div class="col-lg-10" id="conf-job">{{$type['type']}}</div>
            </div>

            

            <h4>Enterprise</h4>
            <div class="form-group">
                <label for="enterprise" class="col-lg-2 control-label">Enterprises:</label>
                <div class="col-lg-10" id="conf-enterprise"></div>
            </div>

            <h4>Parcels</h4>
            @for($x=1; $x<=$parcel_count; $x++)
            <div id="conf-parcel-div-{{$x}}" class="{{in_array($x, explode(',', old('parcels_added'))) || $x==1? '' : 'hide'}}">
                <h5><small>Parcel {{$x}}</small></h5>
                <h6><small>Parcel Address</small></h6>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Lot Type:</label>
                    <div class="col-lg-10" id="conf-parcel_lot_type_{{$x}}">
                        {{old('parcel_lot_type.'.$x)? old('parcel_lot_type.'.$x) : App\AddressLotType::find($current_parcel->land->address->lot_type_id)->lot_type}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Street Number:</label>
                    <div class="col-lg-10" id="conf-parcel_street_number_{{$x}}">{{old('parcel_street_number.'.$x)? old('parcel_street_number.'.$x) : $current_parcel->land->address->house_num}}</div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Road/Street/Trace Name:</label>
                    <div class="col-lg-10" id="conf-parcel_road_trace_{{$x}}">{{old('parcel_road_trace.'.$x)? old('parcel_road_trace.'.$x) : $current_parcel->land->address->road}}</div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Town/Village/Settlement:</label>
                    <div class="col-lg-10" id="conf-parcel_town_village_{{$x}}">
                        {{old('parcel_town_village.'.$x)? old('parcel_town_village.'.$x) : App\Districts::find($current_parcel->land->address->district_id)->district}}
                    </div>
                </div>

                <h6><small>Lands Details</small></h6>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Area</label>
                    <div class="col-lg-10">
                        <span id="conf-parcel_area_{{$x}}">{{old('parcel_area.'.$x)}}</span> 
                        <span id="conf-parcel_area_type_{{$x}}">
                            {{old('parcel_area_type.'.$x)? old('parcel_area_type.'.$x) : $current_parcel->land->area_amt.' '.App\AreaType::find($current_parcel->land->area_type_id)->area_type}}
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Land Type</label>
                    <div class="col-lg-10" id="conf-land_type_{{$x}}">
                        {{old('land_type.'.$x)? old('land_type.'.$x) : App\LandType::find($current_parcel->land_type_id)->land_type}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-lg-2 control-label">Tenure</label>
                    <div class="col-lg-10" id="conf-tenure_{{$x}}">
                        {{old('tenure.'.$x)? App\TenureCode::find(old('tenure.'.$x))->tenure_code.' '.App\TenureCode::find(old('tenure.'.$x))->tenure : App\TenureCode::find($current_parcel->tenure_code_id)->tenure_code.' '.App\TenureCode::find($current_parcel->tenure_code_id)->tenure}}
                    </div>
                </div>

                <h6><small>Proof of Interest in Lands Utilized</small></h6>
                <div class="form-group">
                    <label for="enterprise" class="col-lg-2 control-label">Documents:</label>
                    <div class="col-lg-10" id="conf-proof_codes_{{$x}}">
                        @if(old('proof_codes.'.$x))
                        @foreach(old('proof_codes.'.$x) as $c_proof => $on)
                        <div id="conf-proof-{{$c_proof}}">
                            {{App\ProofOfInterestCode::find($c_proof)->proof_code}}. {{App\ProofOfInterestCode::find($c_proof)->proof}}
                        </div>
                        @endforeach
                        @else
                        @foreach($current_parcel->proofs as $parcel)
                        <div id="conf-proof-{{$parcel}}">
                            {{App\ProofOfInterestCode::find($parcel->proof_code->id)->id}}. {{App\ProofOfInterestCode::find($parcel->proof_code->id)->proof}}
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <h6><small>Type of Crops/Animals</small></h6>
                @if(old('crops_added.'.$x) == null)
                @for ($crop = 1; $crop <= $current_parcel->produce()->count(); $crop++)
                <div id="div-crops-conf-{{$x}}">
                    <!-- use old('crops_added.'.$x) for old crops -->
                    
                    <!-- <h5><small>Crop</small></h5>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Type of Crop/Animal</label>
                        <div class="col-lg-10" id="conf-parcel_type_{{$x}}_1"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Specific Crop/Animal</label>
                        <div class="col-lg-10" id="conf-animal_crop_{{$x}}_1"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Amount</label>
                        <div class="col-lg-10"><span id="conf-parcel_amt_{{$x}}_1"></span> <span id="conf-parcel_unit_{{$x}}_1"></span></div>
                    </div> -->
                    <h5><small>Crop</small></h5>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Type of Crop/Animal</label>
                            <div class="col-lg-10" id="conf-parcel_type_{{$x}}_{{$crop}}">{{old('parcel_type.'.$x.'.'.$crop)? App\ParcelType::find(old('parcel_type.'.$x.'.'.$crop))->parcel_type : App\ParcelType::find($current_parcel->produce()->first()->parcel_type_id)->parcel_type}}</div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Specific Crop/Animal</label>
                            <div class="col-lg-10" id="conf-animal_crop_{{$x}}_{{$crop}}">{{old('animal_crop.'.$x.'.'.$crop)? old('animal_crop.'.$x.'.'.$crop) :App\Commodities::find($current_parcel->produce()->slice($crop-1,1)[$crop-1]['commodity_id'])->CommodityLocalName}}</div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Amount</label>
                            <div class="col-lg-10"><span id="conf-parcel_amt_{{$x}}_{{$crop}}">{{old('parcel_amt.'.$x.'.'.$crop)}}</span> <span id="conf-parcel_unit_{{$x}}_{{$crop}}">{{old('parcel_type.'.$x.'.'.$crop)? App\ParcelType::find(old('parcel_type.'.$x.'.'.$crop))->unit->parcel_unit : ($crop-1==0 ? $current_parcel->produce()->first()->amt : $current_parcel->produce()->slice($crop-1,1)[$crop-1]['amt'])}}</span></div>
                        </div>
                </div>
                @endfor
                @else
                    <div id="div-crops-conf-{{$x}}">
                    @foreach(explode(',', old('crops_added.'.$x)) as $crop)
                        <!-- use old('crops_added.'.$x) for old crops -->
                        
                        <h5><small>Crop</small></h5>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Type of Crop/Animal</label>
                            <div class="col-lg-10" id="conf-parcel_type_{{$x}}_{{$crop}}">{{old('parcel_type.'.$x.'.'.$crop)? App\ParcelType::find(old('parcel_type.'.$x.'.'.$crop))->parcel_type : ''}}</div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Specific Crop/Animal</label>
                            <div class="col-lg-10" id="conf-animal_crop_{{$x}}_{{$crop}}">{{old('animal_crop.'.$x.'.'.$crop)}}</div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-lg-2 control-label">Amount</label>
                            <div class="col-lg-10"><span id="conf-parcel_amt_{{$x}}_{{$crop}}">{{old('parcel_amt.'.$x.'.'.$crop)}}</span> <span id="conf-parcel_unit_{{$x}}_{{$crop}}">{{old('parcel_type.'.$x.'.'.$crop)? App\ParcelType::find(old('parcel_type.'.$x.'.'.$crop))->unit->parcel_unit : ''}}</span></div>
                        </div>
                    @endforeach
                    </div>
                @endif
            </div>
            @endfor
        </form>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" id="submit" class="btn btn-success pull-right loading-modal submit" form="farmerRegForm">Submit</button>
                <a href="#wizard-navigation" type='button' class='btn btn-danger pull-right' id="edit">Edit</a>
            </div>
        </div>
    </div>
</div>