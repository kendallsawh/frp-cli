<div class="col-sm-12">
	
	<button type="button" class="btn btn-success btn-round btn-sm btn-block" data-toggle="modal" data-target = "#dfoModal" rel="tooltip" title="Add comments to the application">Add {{Auth::user()->role_slug === 'frc'? 'comments for DFO' : Auth::user()->role_slug}} Comment   <i class="fa fa-plus-square"></i></button>
</div>