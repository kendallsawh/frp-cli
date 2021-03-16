@extends('layouts.app')

@section('content')



<div class="col-sm-12">
    <div class="wizard-header">
        <h2 class="wizard-title">{{$title}}</h2>
        
        <div class="row">
            <div class="alert alert-info text-center" style="height: 30px; margin-bottom: 0; padding: 5px;">
                <div class="container-fluid">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <i class="fa fa-info-circle" aria-hidden="true" style="color: white"></i> <b>
                    Select one or more crops and click search.</b>
                </div>
            </div>
        </div>  
    </div>
    
   @include('reports.common.optionselect')
    @if(count($crop_results) >= 1 )
        @include('reports.common.table')
        @include('reports.common.graph')
    <!-- <div class="card">
            <div class="row">
                <div class="card-content col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12" >
       
                        <div id="chartContainer">

                            
                        </div>
                    </div>
                </div>
            </div>
    </div> -->
     @endif

</div>



<!-- <div class="row ">
    <div class="col-lg-12 col-md-12 col-sm-12" >
        <div class="card">



        </div>
    </div>

</div> -->



@endsection

@section('scripts')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
    var dropdownChanged1 = false;
    var dropdownChanged2 = false;
    var dropdownChanged3 = false;
    $( ".animal_crop3" ).change(function() {
        //if(dropdownChanged1 == true || dropdownChanged2 == true)
        var animal_crop = $('#animal_crop_1').val();
        var animal_crop2 = $('#animal_crop_2').val();
        if (!animal_crop) {

            $('#grp-animal_crop_1').addClass('has-error');
            $('#err-animal_crop_1').html('Please enter animal/crop');
            $('#submit').addClass('hide');
        }
        if (!animal_crop2) {


            $('#grp-animal_crop_2').addClass('has-error');
            $('#err-animal_crop_2').html('Please enter animal/crop');
            $('#submit').addClass('hide');
        }
        if (animal_crop && animal_crop2){
            $('#submit').removeClass('hide');
        }
                    
        
        /*$('#animal_crop_1 option').each(function() {
            if(this.selected)
                alert('true');
        });*/
        
    });
   $('#animal_crop_1').change(function(){
        dropdownChanged1 = true;
        if(dropdownChanged1 && dropdownChanged2){
            $('#submit').removeClass('hide');
        }
    });

   $('#animal_crop_2').change(function(){
        dropdownChanged2 = true;
        var animal_crop = $('#animal_crop_1').val();
        
        if (!animal_crop) {

            $('#grp-animal_crop_1').addClass('has-error');
            $('#err-animal_crop_1').html('Please enter animal/crop');
            $('#submit').addClass('hide');
        }
        if(dropdownChanged1 && dropdownChanged2){
            $('#submit').removeClass('hide');
        }
    });
    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
              /* text: {!! json_encode($title) !!} +' '+ {!! json_encode($graphtitle) !!}*/
               text: {!! json_encode($title) !!}
            },
            animationEnabled: true,
            legend: {
                fontSize: 20,
                fontFamily: "Helvetica"
            },
            theme: "light2",
            data: [
            {
                type: "doughnut",
                indexLabelFontFamily: "Garamond",
                indexLabelFontSize: 20,
                indexLabel: "{label} {y}",
                startAngle: -20,
                showInLegend: true,
                toolTipContent: "{legendText} {y}",
                dataPoints: <?php echo json_encode($datapoints, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });

</script>
@endsection

