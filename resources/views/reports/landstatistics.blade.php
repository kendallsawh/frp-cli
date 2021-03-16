@extends('layouts.app')

@section('content')



<div class="row">

	<div class="col-md-9" style="float: none; margin: 0 auto;">
		<div class="card">
			<h3>Land-Application Statistics</h3>
			<div id="chartContainer"></div>
			<h1><br></h1>
				<h1><br></h1>
				<h1><br></h1>
				<h1><br></h1>

		</div>
	</div>

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
    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: {!! json_encode($title) !!}
            },
            exportFileName: "Pie Chart",
            exportEnabled: true,
            animationEnabled: true,
            legend: {
                verticalAlign: "center",
                horizontalAlign: "left",
                fontSize: 20,
                fontFamily: "Helvetica"
            },
            theme: "light2",
            data: [
            {
                type: "pie",
                indexLabelFontFamily: "Garamond",
                indexLabelFontSize: 20,
                indexLabel: "{label} {y}",
                startAngle: -20,
                showInLegend: true,
                toolTipContent: "{legendText} {y}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
   
</script>
@endsection

