
function validate(tab) {

    var chk = true;

    switch(tab) {


	    case 'parcels':

            /** Application Type **/
          /*  var app_type = $('#app_type').val();
            if (!app_type) {
                chk = false; btn = false;
                $('#grp-app_type').addClass('has-error');
                $('#err-app_type').html('Please select application type');
            }*/

	    	// get added parcel numbers
	    	var num = $('#parcels-added').val().split(",");
	    	for (i = 0, len = num.length; i < len; i++) { 
			    var n = num[i];
			    var btn = true;

			    /** Parcel Address **/
			    var type = $('#parcel_lot_type_'+n).val();
			    if (!type) {
			    	chk = false; btn = false;
			    	$('#grp-parcel_lot_type_'+n).addClass('has-error');
	            	$('#err-parcel_lot_type_'+n).html('Please enter lot type');
			    }
			    var street_number = $('#parcel_street_number_'+n).val();
			    if (!street_number) {
			    	chk = false; btn = false;
			    	$('#grp-parcel_street_number_'+n).addClass('has-error');
	            	$('#err-parcel_street_number_'+n).html('Please enter street number');
			    }
			    var road_trace = $('#parcel_road_trace_'+n).val();
			    if (!road_trace) {
			    	chk = false; btn = false;
			    	$('#grp-parcel_road_trace_'+n).addClass('has-error');
	            	$('#err-parcel_road_trace_'+n).html('Please enter road/trace');
			    }
			    var town_village = $('#parcel_town_village_'+n).val();
			    if (!town_village) {
			    	chk = false; btn = false;
			    	$('#grp-parcel_town_village_'+n).addClass('has-error');
	            	$('#err-parcel_town_village_'+n).html('Please enter town/village');
			    }

			    /** Lands Details **/
			    var area_type = $('#parcel_area_type_'+n).val();
			    if (!area_type) {
			    	chk = false; btn = false;
			    	$('#grp-parcel_area_type_'+n).addClass('has-error');
	            	$('#err-parcel_area_type_'+n).html('Please enter area type');
			    }
			    var area = $('#parcel_area_'+n).val();
			    if (!area) {
			    	chk = false; btn = false;
			    	$('#grp-parcel_area_'+n).addClass('has-error');
	            	$('#err-parcel_area_'+n).html('Please enter area');
			    }
			    var land_type = $('#land_type_'+n).val();
			    if (!land_type) {
			    	chk = false; btn = false;
			    	$('#grp-land_type_'+n).addClass('has-error');
	            	$('#err-land_type_'+n).html('Please enter land type');
			    }
			    var tenure = $('#tenure_'+n).val();
			    if (!tenure) {
			    	chk = false; btn = false;
			    	$('#grp-tenure_'+n).addClass('has-error');
	            	$('#err-tenure_'+n).html('Please enter tenure');
			    }
			    var app = $('#app_type').val();
				/*if (app && land_type && tenure) {
					var opts = true;
					var codes = true;
					//alert(app+' app - '+land_type+' lt - '+tenure+' tenure');
					// app type -> land type -> tenure -> document
		            if( 
		                typeof(doc_mandatory) != 'undefined' &&
		                typeof(doc_mandatory[app]) != 'undefined' &&
		                typeof(doc_mandatory[app][land_type]) != 'undefined' &&
		                typeof(doc_mandatory[app][land_type][tenure]) != 'undefined' 
		            ) {
						doc_mandatory[app][land_type][tenure].forEach(function(item, index, arr) {
							if (!$('#proof_codes_'+n+'_'+item).is(':checked')) {
								codes=false;
								//$('#err-proof_codes_'+n).html('mandy.');
							}
						});
					}

		            if( 
		                typeof(doc_optional) != 'undefined' &&
		                typeof(doc_optional[app]) != 'undefined' &&
		                typeof(doc_optional[app][land_type]) != 'undefined' &&
		                typeof(doc_optional[app][land_type][tenure]) != 'undefined' 
		            ) {
						opts = false;
						doc_optional[app][land_type][tenure].forEach(function(item, index, arr) {
							if ($('#proof_codes_'+n+'_'+item).is(':checked')) {
								opts = true;
							}
						});
					}

					if (!codes || !opts) {
						chk = false; btn = false;
						$('#err-proof_codes_'+n).html('The marked documents are required.');
					}
				}else{
					chk = false; btn = false;
					$('#err-proof_codes_'+n).html('app type -> land type -> tenure -> document fail.');
				}*/

			    /** Type of Crops/Animals **/
		    	// get added crop numbers
		    	var crop = $('#crops-added-'+n).val().split(",");
			    for (i2 = 0, len2 = crop.length; i2 < len2; i2++) { 
				    var c = crop[i2];

				    var parcel_type = $('#parcel_type_'+n+'_'+c).val();
				    var animal_crop = $('#animal_crop_'+n+'_'+c).val();
				    var parcel_amt = $('#parcel_amt_'+n+'_'+c).val();
				    if(!parcel_type && !animal_crop && !parcel_amt){

				    }
				    else{
				    	if (!parcel_type) {
				    	chk = false; btn = false;
				    	$('#grp-parcel_type_'+n+'_'+c).addClass('has-error');
		            	$('#err-parcel_type_'+n+'_'+c).html('Please select crop/animal');
				    }
				    
				    if (!animal_crop) {
				    	chk = false; btn = false;
				    	$('#grp-animal_crop_'+n+'_'+c).addClass('has-error');
		            	$('#err-animal_crop_'+n+'_'+c).html('Please enter animal/crop');
				    }
				    
				    if (!parcel_amt) {
				    	chk = false; btn = false;
				    	$('#grp-parcel_amt_'+n+'_'+c).addClass('has-error');
		            	$('#err-parcel_amt_'+n+'_'+c).html('Please enter parcel amount');
				    }
				    }
				    
				}
				    
			    // add red colour to parcel button
			    if (!btn) {
		        	$('#btn-add-parcel-'+n)
		        		.removeClass('btn-success, btn-default')
		        		.addClass('btn-danger')
		        		.attr('title','errors')
		        		.attr('rel','tooltip')
		        		.attr('data-placement','bottom')
		        		.tooltip('show');
		        }
			}

	        if (chk) {
	        	return true;
	        }else{
	        	return false;
	        }
	        break;

	    default:
	        return false;
	}
    
}
