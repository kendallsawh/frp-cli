<div class="card">
        <div class="card-content text-center">
            <h3 class="card-title">
               Crop/Animal Details
           </h3>
           <h5><b>Total Farmer Count: {{$parcel_count}}</b></h5>
           
           <div class="table-responsive">
                
                <table class="table">
                    <thead >

                        <th class="text-center">Farmer Name</th>
                        <th class="text-center">Age</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Parcel Address</th>
                        <th class="text-center">Parcel Size</th>

                    </thead>
                    <tbody>
                        @foreach($crop_results as $crop)


                        <tr class="text-center" title="Parcels recorded in hectares have been converted to acres. All other record types remain the same." data-toggle="tooltip" >
                            <td>
                                <a href="{{url('reports/commodity_parcel_listing')}}/{{$crop->wardid}}/{{$crop->crop_animal}}" target="_blank" title="Total of all selected crops for this ward." data-toggle="tooltip">{{$crop->crop_animal}}
                                </a>
                            </td>                        
                            <td>{{$crop->total_area}}</td>
                            <td>{{\App\FarmingDistrict::find($crop->wardid)?\App\FarmingDistrict::find($crop->wardid)->district_name:$crop->district.'(Town)'}}</td>

                        </tr>




                        @endforeach
                        <!-- <tr class="text-center" title="" data-toggle="tooltip" >
                            <td>Total</td>                        
                            <td>{{$croptotal}}</td>
                            <td>{{$graphtitle}}</td>

                        </tr> -->
                    </tbody>
                </table>

               

            </div>
        </div>
    </div>