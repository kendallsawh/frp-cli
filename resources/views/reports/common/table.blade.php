

    

    <div class="card">
        <div class="card-content text-center">
            <h3 class="card-title">
               Crop/Animal Details
           </h3>
           <h5><b>Total Parcel count: {{$parcel_count}}</b></h5>
           <h5>If a community is not mapped to a district then the community will be displayed instead.</h5>
           <div class="table-responsive">
                
                <table class="table">
                    <thead >

                        <th class="text-center">Crop/Animal</th>
                        <th class="text-center">Value: Area(Hectares)/Heads/Hives</th>
                        <th class="text-center">Farming District</th>
                        <th class="text-center">Community</th>

                    </thead>
                    <tbody>
                        @foreach($crop_results as $crop)


                        <tr class="text-center" title="Parcels recorded in hectares have been converted to acres. All other record types remain the same." data-toggle="tooltip" >
                            <td>
                                <a href="{{url('reports/commodity_parcel_listing')}}/{{$crop->wardid}}/{{$crop->crop_animal}}" target="_blank" title="Total of all selected crops for this ward." data-toggle="tooltip">{{$crop->crop_animal}}({{App\Commodities::where('id',$crop->crop_animal_id)->first()->Variety}})
                                </a>
                            </td>                        
                            <td>{{$crop->total_area}}</td>
                            <td>{{$crop->farming_district_name}}</td>
                            <td>{{$crop->community}}</td>

                        </tr>




                        @endforeach
                        
                    </tbody>
                </table>

               

            </div>
        </div>
    </div>
    <div class="card">
            
            <div class="row">
                <div class="card-content col-sm-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="col-md-4 text-center"></div>
                    <div class="col-md-4 text-center">
                        <button type="button" class="btn btn-primary btn-round btn-md" data-toggle="modal" data-target = "#statisticModal" style="width:70%;">View Graph</button>
                    </div>
                    <div class="col-md-4"></div>
                    
                    
       
                       
                    
                </div>
            </div>
    </div>

