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
        <div class="row">


            <div class="col-lg-12">

                <div class="navbar-form navbar-right row">
                    <div id="choose-type" class="col-md-3 div-inline {{Auth::user()->role_id !== 1? 'hidden' : ''}}" rel="tooltip" title="Create a new application for an individual farmer" style="padding-left: 10px;">
                        <h6 class="category text-gray">
                            <a href="{{route('farmerRegisterIndividual')}}" type="button" id="reference" class="btn btn-info btn-round btn-sm " name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Create New Application</a>
                            </h6>
                        </div>

                        <div class="form-group col-md-9 div-inline" >

                            <label for="choose-type" class="col-md-1 form-control-label label-inline" >Search by:</label>
                            <div id="choose-type" class="col-md-11 div-inline" >

                                <label class="radio-inline">
                                    <input type="radio" class="radio-inline" name="search_type" id="namesearch" value="1" required=""> Name
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="radio-inline" name="search_type" id="idsearch" value="2" required=""> ID
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="radio-inline" name="search_type" id="badgesearch" value="3" required=""> Badge
                                </label>
                                <label class="radio-inline">

                                 <input type="text" class="form-control search_ind" id="search_ind" placeholder="Type to search users" autocomplete="off" >

                             </label>
                         </div>

                     </div>


                 </div>
             </div>
         </div>
        <div class="card-content table-responsive">
            <table class="table table-hover">
                <thead class="">
                    
                    <th>Name</th>
                    <th>Type</th>
                    <th>County</th>
                    <th>Badge</th>
                    <th>Most Recent Badge</th>
                    <th class="text-center">Parcels</th>
                    <th class="text-center">Enterprises</th>
                    <th>Created On</th>
                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                </thead>
                <tbody>
                    @foreach($farmers as $farmer)
                    
                    
                    <tr>
                        
                        <td>{{$farmer->farmer() !== 0? $farmer->farmer()->name : 'N/A' }} </td>
                        <td>{{$farmer->type}}</td>
                        <td>{{$farmer->farmer() !== 0? $farmer->farmer()->county : ''}}</td>
                        <td>{{$farmer->registration_num}}</td>
                        <td>{{$farmer->old_badge_id}}</td>
                        <td class="text-center">{{$farmer->farmer() !== 0? $farmer->farmer()->parcelsCount() : ''}}</td>
                        <td class="text-center">{{$farmer->farmer() !== 0? $farmer->farmer()->enterpriseCount() : ''}}</td>
                        <td>{{$farmer->since}}</td>
                        <td class="td-actions text-center">
                            <a href="{{$farmer->type == 'Individual'? url('/individual/view') : url('/organization/view')}}/{{$farmer->farmer() !== 0? $farmer->farmer()->id : 0}}" rel="tooltip" class="btn btn-info" data-original-title="View Farmer" title="">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <div class="ripple-container"></div>
                            </a>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>

        </div>
        {{$farmers->links()}}
    </div>
</div>
@endsection

@section('scripts')
<!-- Import typeahead.js -->
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<script type="text/javascript">
    var val = 0;

    $(document).ready(function() {
                
        $('#namesearch').prop('checked', true);
        val = 1;
        if($('#namesearch').is(':checked'))
            searchfunction(1);
        $(document).on('change', '[name="search_type"]', function() {
                val = $(this).val();
                $('#search_ind').val('');
                $('#search_ind').typeahead('val', '');
                //alert(val);
                //bloodhound.clear();
                $( ".tt-menu" ).remove();

                searchfunction(val)
            });
        
        });


    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

    var bloodhound;
    function searchfunction(val) {
       //console.log(bloodhound);
       if(bloodhound){
        bloodhound.clear();
        bloodhound = null;
        //console.log(bloodhound);    
       }
       
         bloodhound = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: '/user/find?q=%QUERY%',
                        replace: function(url, uriEncodedQuery) {
                           
                            var newField = val; // get other field value
                                var searchstr = $('#search_ind').val();
                                if(val==3){
                                    searchstr = encodeURIComponent(searchstr);
                                }
                                
                                var q = '{{URL::to('/user/find')}}'+'?q=' + searchstr;
                            url = q;
                            //console.log(url + '&searchtype=' + encodeURIComponent(newField));
                            return url + '&searchtype=' + encodeURIComponent(newField)
                        }, 
                        cache: false, 
                    },
                    
                });
       
        
     
                $( ".list-group" ).remove();
                $('#search_ind').typeahead("destroy");//reinitialize typehead
                $('#search_ind').typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 1
                }, {
                    name: 'users',
                    source: bloodhound,
                    display: function(data) {
                        if (val == 1){
                            return data.f_name + ' ' + data.l_name;
                        }
                        else if(val == 2)
                            return data.id_num;
                        else if(val == 3){
                             if(isNaN($('#search_ind').val()))
                                return data.old_badge_id;
                            else
                                return data.farmer_badge;
                        }
                           
                          //Input value to be set when you select a suggestion. 
                    },
                    templates: {
                        empty: [
                            '<div class="list-group search-results-dropdown listresult"><div class="list-group-item">Nothing found.</div></div>'
                        ],
                        header: [
                            '<div class="list-group search-results-dropdown listresult">'
                        ],
                        suggestion: function(data) {
                            if (val == 1){
                                return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' +  data.f_name + ' ' + data.l_name + '</div></div>';
                            }
                            else if(val == 2){
                                return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' +  data.id_num + '</div></div>';
                            }
                            else if(val == 3){
                                if(isNaN($('#search_ind').val()))
                                    return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' +  data.old_badge_id + '</div></div>';
                                else
                                    return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' +  data.farmer_badge + '</div></div>';
                            }                           
                        }
                    },
                    
                });//end typeahead
    }

    $('#search_ind').blur(function(){ 
            var value=$('#search_ind').val();
            //alert(val);
            
                $.ajax({
                 
                    type : 'get',
                     
                    url : '{{URL::to('farmersearch')}}',
                     
                    data:{'search_ind':value, 'search_type':val},
                     
                    success:function(data){

                            console.log(data);
                     
                        if(data){
                          $('tbody').empty().html(data);  
                        }
                     
                    }
                 
                });
            
        });
    $(document).keypress(function(e) {
        if(e.which == 13) {
            var value=$('#search_ind').val();

            
                $.ajax({
                 
                    type : 'get',
                     
                    url : '{{URL::to('farmersearch')}}',
                     
                    data:{'search_ind':value, 'search_type':val},
                     
                    success:function(data){

                            console.log(data);
                        if(data){
                          $('tbody').empty().html(data);  
                        }
                        
                     
                    }
                 
                });
            
        }
    });

    function myFunction(val) {
        var t = val;
        
      $("#view_id").val(val);
      
      $("$ao1notice").innerHTML += (": "+val);
      
    }
</script>
@endsection
