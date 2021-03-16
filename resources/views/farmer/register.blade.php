@extends('layouts.app')

@section('content')
<div class="col-sm-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb" id="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/') }}">Farmers</a></li>
        <li class="active">Registration</li>
    </ul>

    <!--      Wizard container        -->
    <div class="wizard-container">
        <div class="card wizard-card" data-color="green" id="wizardProfile">
            <form role="form" id="farmer_reg" method="POST" action="{{ route('farmerRegisterType') }}">
                {{ csrf_field() }}
                <div class="wizard-header" style="padding: 20px 0 0 0 !important">
                    <h2 class="wizard-title">{{$title}}</h2>
                    <p id="farmerChoice">Please select registration type.</p>
                    
                </div>
                <div class="wizard-navigation hidden-xs hidden-sm hide">
                    <ul>
                        <li><a href="#farmer" data-toggle="tab">Farmer</a></li>
                    </ul>
                </div>
                <div class="tab-content register">
                    <div class="tab-pane" id="farmer">
                        <div class="row">
                            <div class="col-sm-2 col-sm-offset-3">
                                <div class="choice farmer" rel="tooltip" title="Create a new application for an individual farmer">
                                    @if(\Auth::user()->userapplication)
                                    <a href="{{\Auth::user()->userapplication->type!==1? route('farmerRegisterIndividual') : '#'}}">
                                        <div class="icon">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                        <h6 class="wizard-h6" id="label-ind">Individual</h6>
                                        @if(\Auth::user()->userapplication->type==1)
                                        <h6 class="wizard-h6" id="label-ind"><b>Application already exists!</b></h6>
                                        @endif

                                    </a>
                                    @else
                                    <a href="{{route('farmerRegisterIndividual')}}">
                                        <div class="icon">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                        <h6 class="wizard-h6" id="label-ind">Individual</h6>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="choice farmer" rel="tooltip" title="">
                                    <a href="#">
                                        <div class="icon">
                                            <i class="fa fa-building" aria-hidden="true"></i>
                                        </div>
                                        <h6 class="wizard-h6" id="label-org">Organization</h6>
                                        <h6 class="wizard-h6" id="label-org"><small>Comming soon</small></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="choice" id="sp" rel="tooltip" title="">
                                    <a href="#">
                                        <div class="icon">
                                            <i class="fa fa-truck" aria-hidden="true"></i>
                                        </div>
                                        <h6 class="wizard-h6">Service Provider</h6>
                                        <h6 class="wizard-h6" id="label-org"><small>Comming soon</small></h6>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Service Provider type -->
                        <div class="row hide" id="newexistdiv">
                            <div class="col-sm-3 col-sm-offset-3">
                                <div class="radio">
                                    <label class="" for="new">
                                        <input id="new" type="radio" name="newexist" value="new" class="" slug=""><span class="circle"></span><span class="check"></span> <i class="fa fa-user-plus" aria-hidden="true"></i> New Farmer
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label class="" for="exist">
                                        <input id="exist" type="radio" name="newexist" value="exist" class="" slug=""><span class="circle"></span><span class="check"></span> <i class="fa fa-users" aria-hidden="true"></i> Existing Farmer
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- New farmer type for service provider -->
                        <div class="row hide" id="farmertypediv">
                            <div class="col-sm-3 col-sm-offset-3">
                                <div class="radio">
                                    <label class="" for="newind">
                                        <input id="newind" type="radio" name="farmertype" value="ind" class="" slug=""><span class="circle"></span><span class="check"></span> <i class="fa fa-user" aria-hidden="true"></i> Individual
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label class="" for="neworg">
                                        <input id="neworg" type="radio" name="farmertype" value="org" class="" slug=""><span class="circle"></span><span class="check"></span> <i class="fa fa-building" aria-hidden="true"></i> Organization
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row hide" id="farmertable">
                            <div class="col-sm-12" id="colfarmertable">
                                <div class="table-responsive">

                                    <table class="table table-hover" id="list_table">
                                        <thead class="">
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>County</th>
                                            <th>Created On</th>
                                            <th></th>
                                        </thead>
                                        <tbody></tbody>

                                    </table>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
                <div class="wizard-footer hide" id="wizard-footer">
                    <div class="text-center">
                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' value='Previous' />
                        <input type='button' class='btn btn-next btn-fill btn-success btn-wd' id='next' value='Continue'>
                        <button id="submit" type='submit' class='btn btn-finish btn-fill btn-success btn-wd loading-modal'>Continue</button>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </form>
        </div>
    </div>
    <!-- wizard container -->
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
       

        $(document).on('click', '#sp', function() {
            $(this).addClass('active');
            $('.farmer').css('opacity',0.3);
            $('#newexistdiv').removeClass('hide');
        });

        $(document).on('change', '[name="newexist"]', function() {
            var val = $(this).val();
            //alert(val);
            if (val == 'new') {
                $('#farmertypediv').removeClass('hide');
                $('#farmertable').addClass('hide');
            }else{
                $('#farmertypediv').addClass('hide');
                $('#farmertable').removeClass('hide');
            }
            $('#wizard-footer').addClass('hide');
            $('input[name="farmertype"], input[name="selected"]').prop('checked', false);
        });

        $(document).on('change', '[name="farmertype"], [name="selected"]', function() {
            $('#wizard-footer').removeClass('hide');

        });
    });
    $(document).on('click', '#exist',function(){
        $('#loadingModal').modal('show');
           
             /*$.get("{{URL::to('/entitytable')}}",function(data){
                $('#list_table').empty().html(data);
                 var table = $('#list_table').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": 10,
                    "bLengthChange": false,
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search",
                            }

                });
                $('#loadingModal').modal('hide');
            });*/
            $.ajax({
                 
                    type : 'get',
                     
                    url : "{{URL::to('/entitytable')}}",
                     
                    success:function(data){
                        $('#list_table').empty().html(data);
                 var table = $('#list_table').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": 10,
                    "bLengthChange": false,
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search",
                            }

                });
                $('#loadingModal').modal('hide');
                     
                    },
                    error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
                 
                });

        });

</script>  
@endsection

