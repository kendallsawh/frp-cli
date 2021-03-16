@extends('layouts.app')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="wizard-header">
            <h2 class="wizard-title">{{$title}}</h2>
        </div>
        <div class="col-md-12" id="errorDiv">@include('common.errors')</div>
       @if(Session::has('success'))
        <div class="alert alert-success">
            <div class="container-fluid">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <i class="fa fa-info-circle" aria-hidden="true" style="color: white"></i> <b>
                    <strong>Notice!</strong>{{ Session::get('success') }}</b>
                </div>
            
            
        </div>
        
        @endif
        <div class="col-lg-12">

                <div class="navbar-form navbar-right">
                    <div id="choose-type" class="col-md-4 div-inline" rel="tooltip" title="Create a new application for an individual farmer">
                        <h6 class="category text-gray">
                            <a href="{{route('farmerRegisterIndividual')}}" type="button" id="reference" class="btn btn-info btn-round btn-sm" name="reference">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Create New Application</a>
                        </h6>
                    </div>
                  
                    <div class="form-group row">

                        <label for="choose-type" class="col-md-3 form-control-label label-inline">Search by:</label>
                        <div id="choose-type" class="col-md-8 div-inline">
                           
                            <label class="radio-inline">
                                <input type="radio" class="radio-inline" name="search_type" id="namesearch" value="1" required=""> Name
                            </label>
                            <label class="radio-inline">
                                <input type="radio" class="radio-inline" name="search_type" id="idsearch" value="2" required=""> ID
                            </label>
                        </div>
                    </div>
                         
                    <label>
                       
                         <input type="text" class="form-control search_ind" id="search_ind" placeholder="Type to search users" autocomplete="off" >
                        
                    </label>
                </div>
            </div>
            <div class="row loading_spinner" id="loading_spinner">
                <div class="col-sm-2 col-sm-offset-5">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw "></i>
                    <span class="sr-only-focusable">Loading...</span>
                </div>
                
            </div>
            <div class="table_load" id="table_load">
                
            </div>

        
    </div>
</div>

@endsection

@section('scripts')
 <!-- Import typeahead.js -->
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
var val = 0;
$(window).on('load', function() {
    $.ajax({
             
        type : 'get',
                 
        url : '{{URL::to('load_uprn_data')}}',
                 
        success:function(data){
            if (data) {
                document.getElementById("loading_spinner").classList.add('hide');
                $('#table_load').html(data);
            }
        },
        error: function (data) {
            var errors = data.responseJSON;
            //console.log(data.message);
            console.log(errors);
            } 
    });
});
$(document).ready(function() {
            
    $('#namesearch').prop('checked', true);
    val = 1;
    $(document).on('change', '[name="search_type"]', function() {
            val = $(this).val();
            $('#search_ind').val('');
            //alert(val);
            //bloodhound.clear();
            $( ".tt-menu" ).remove();

            searchfunction_uprn(val)
        });
    searchfunction_uprn(1);
});

var bloodhound;
function searchfunction_uprn(val) {
   //alert(val);
  bloodhound = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: 'uprn/user/find?q=%QUERY%',
                    replace: function(url, uriEncodedQuery) {
                       
                        var newField = val; // get other field value
                        
                        var q = '{{URL::to('uprn/user/find')}}'+'?q=' + $('#search_ind').val();
                        url = q;
                        //console.log(url + '&searchtype=' + encodeURIComponent(newField));
                        return url + '&searchtype=' + encodeURIComponent(newField)
                    },  
                },
                cache: true,
            });
            $( ".list-group" ).remove();
            $('#search_ind').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'users',
                source: bloodhound,
                display: function(data) {
                    if (val == 1){
                        return data.f_name + ' ' + data.l_name
                    }
                    else
                        return data.id_num
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

                            var avatar = data.avatar != null? data.avatar:'' ;
                            //console.log(avatar);
                        return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item"><a href="{{url('individual/view/')}}/'+data.id+'" target="_blank"><img class="img" style="width:70px;height:70px;" src="'+avatar+'" />' +  data.f_name + ' ' + data.l_name + '</a></div></div>'
                    }
                    else
                        return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item"><a href="{{url('individual/view/')}}/'+data.id+'" target="_blank"><img class="img" style="width:70px;height:70px;" src="'+avatar+'" />' +   data.id_num + '</a></div></div>'
                    
                    }
                }
            });//end typeahead
}

$('#search_ind').blur(function(){ 
        var value=$('#search_ind').val();
        //alert(val);
        
            $.ajax({
             
                type : 'get',
                 
                url : '{{URL::to('searchuprn')}}',
                 
                data:{'search_ind':value, 'search_type':val},
                 
                success:function(data){

                        //console.log(data);
                 
                    if(data){
                      $('tbody').empty().html(data);  
                    }
                 
                },
                error: function (data) {
                var errors = data.responseJSON;
                //console.log(data.message);
                console.log(errors);
               
                

            }
             
            });
        
    });
$(document).keypress(function(e) {
    if(e.which == 13) {
        var value=$('#search_ind').val();

        
            $.ajax({
             
                type : 'get',
                 
                url : '{{URL::to('searchuprn')}}',
                 
                data:{'search_ind':value, 'search_type':val},
                 
                success:function(data){

                        //console.log(data);
                    if(data){
                      $('tbody').empty().html(data);  
                    }
                    
                 
                },
                error: function (data) {
                var errors = data.responseJSON;
                //console.log(data.message);
                console.log(errors);
               
                

            }
             
            });
        
    }
});
</script>
@endsection