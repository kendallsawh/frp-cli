@extends('layouts.app')

@section('content')
<div class="col-sm-12">

    <!-- Breadcrumb -->
    <ul class="breadcrumb" id="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="#">Farmers</a></li>
        <li><a href="{{route('farmerRegister')}}">Registration</a></li>
        <li class="active">Individual</li>
    </ul>
    
    <!-- Display Validation Errors -->
    <div class="col-md-12" id="errorDiv">@include('common.errors')</div>

    <div class="row">
        <div class="alert alert-warning hide">
            <strong>Notice!</strong><p id="warning"></p>
            
        </div>
    </div>

    <!--      Wizard container        -->
    <div class="wizard-container " id="wizard-container">
        <div class="card wizard-card" data-color="{{config('global.colour')}}" id="wizardProfile">

            <form role="form" method="POST" action="{{ route('cropMonitorInsertNew') }}" id="cropMonitorForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="app_id" id="app_id" value="{{$application_id}}"/>

                <div class="wizard-header">
                    <!-- <h2 class="wizard-title">{{$title}}</h2> -->
                    <h5>Please enter your information correctly.

                    
                    @include('common.scanmsg')
                </div>
                
                <div class="wizard-navigation hidden-xs hidden-sm" id="wizard-navigation">
                    <ul>
                        <li><a href="#farmvisit" data-toggle="tab">Farm Visit Record</a></li>
                        
                    </ul>
                </div>
                <div class="col-md-12 required">
                    <p>
                        <label>
                            <span class="red">*</span> Required Fields <br>
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> At least one is required
                        </label>
                    </p>
                </div>
                <div class="tab-content">
                    
                    @include('application.fieldreport.new_crop_monitor')
                    
                </div>
                <div class="wizard-footer">
                    <div class="pull-right">
                        <a href="#wizard-navigation" type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' id="next">Next</a>
                        <a href="#confirm-card" type='button' id="confirm" class='btn btn-finish btn-fill btn-success btn-wd' name='confirm'>Continue</a>
                    </div>

                    <div class="pull-left">
                        <a href="#wizard-navigation" type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous'>Previous</a>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </form>
        </div>
    </div>

    <!-- wizard container -->
    @include('application.fieldreport.confirm')
   
    
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
          // validation
    @include('application.fieldreport.validation')

    // common scripts
    @include('application.fieldreport.scripts')

    
            
        
    function removecrop(num) {
        //set value of delete crop input from 0 to 1
        //on form submit the server will delete this record

            $('#delete_crop'+num).val(1);
            $('#collapse-'+num).addClass('hide');
            $('#restore_crop'+num).removeClass('hide');
            //alert("remove " + $('#delete_crop'+num).val());
    }
    function restorecrop(num) {
            //set value fro 1 to 0 so the server will not delete on form submit
            $('#delete_crop'+num).val(0);
            $('#collapse-'+num).removeClass('hide');
            $('#restore_crop'+num).addClass('hide');
            //alert("remove " + $('#delete_crop'+num).val());
    }
    var x = document.getElementById("warning");

    function getLocation() {
        //x = document.getElementById("warning");
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition,showError);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        //alert(document.getElementById("warning"));
        if (!hasClass(x,'hide')) {
            addClass(x,'hide');
        }
        else
            alert('ffff')
        
        success('Coordinates retrieved.')
      /*x.innerHTML = "Latitude: " + position.coords.latitude + 
      "<br>Longitude: " + position.coords.longitude;*/
      $('#gps_coordinate_lat').val(position.coords.latitude);
      $('#gps_coordinate_long').val(position.coords.longitude);
    }

    function showError(error) {
        if (hasClass(x,'hide')) {
            removeClass(x,'hide');
        }
      switch(error.code) {
        case error.PERMISSION_DENIED:
        x.innerHTML = "User denied the request for Geolocation."
        break;
        case error.POSITION_UNAVAILABLE:
        x.innerHTML = "Location information is unavailable."
        break;
        case error.TIMEOUT:
        x.innerHTML = "The request to get user location timed out."
        break;
        case error.UNKNOWN_ERROR:
        x.innerHTML = "An unknown error occurred."
        break;
        }
    }

    var hasClass = function (elem, className) {
    return elem.classList.contains(className)
    }

    var addClass = function (elem, className) {
    if (!elem || !className) {
      return
    }
    var classes = className.split(/\s+/)
    classes.forEach(function (className) {
      elem.classList.add(className)
    })
    }

    var removeClass = function (elem, className) {
    if (!elem || !className) {
      return
    }
    var classes = className.split(/\s+/)
        classes.forEach(function (className) {
          elem.classList.remove(className)
        })
    }

      var getChildByClass = function (elem, className) {
        for (var i = 0; i < elem.childNodes.length; i++) {
          if (hasClass(elem.childNodes[i], className)) {
            return elem.childNodes[i]
          }
        }
      }

      var show = function (elem, display) {
        if (!display) {
          display = 'block'
        }
        elem.style.opacity = ''
        elem.style.display = display
      }

      var hide = function (elem) {
        elem.style.opacity = ''
        elem.style.display = 'none'
      }

    
</script>  
@endsection

