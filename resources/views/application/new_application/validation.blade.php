
function validate(tab) {

    var chk = true;

    switch(tab) {

	    case 'about':

		    // get values
		    var dob = $('#dateofbirth').val();
		    var avatar = $('#wizard-picture').val();
		    var old_avatar = $('#old_avatar').val();
		    var alias = $('#alias').val();
		    var firstname = $('#firstname').val();
		    var middlename = $('#middlename').val();
		    var lastname = $('#lastname').val();
		    var gender = $('#gender').val();
		    var email = $('#email').val();
		    var homenumber = $('#homenumber').val();
		    var mobilenumber = $('#mobilenumber').val();
		    var n_id = $('#n_id').val();
		    var passport = $('#passport').val();
		    var emergencynumber = $('#emergencynumber').val();
		    var old_badge_id = $('#oldregistration').val();
		    var obj = old_reg_ids;
		    var dateofissue = $('#dateofissue').val();
			var result = JSON.stringify(old_reg_ids); 
		    // validation
		    if (avatar.length == 0 && !old_avatar) {
		    	chk = false;
            	$('#err-avatar').html('Please select picture');
		    }
		    if (!dob) {
		    	chk = false;
		    	$('#grp-dateofbirth').addClass('has-error');
            	$('#err-dateofbirth').html('Please enter date of birth');
		    }else if(calculateAge(dob) < 18){
		    	chk = false;
		    	$('#grp-dateofbirth').addClass('has-error');
            	$('#err-dateofbirth').html('Applicant must be 18 years or older');
		    }else if(dob){
				var regEx = /^\d{4}-\d{2}-\d{2}$/;
				if(!dob.match(regEx)){
					chk = false;  // Invalid format
					$('#grp-dateofbirth').addClass('has-error');
            		$('#err-dateofbirth').html('Format of date should be (yyyy-mm-dd)');
				} 
				var d = new Date(dob);
				if(!d.getTime() && d.getTime() !== 0) {
					chk = false; // Invalid date
					$('#grp-dateofbirth').addClass('has-error');
	            	$('#err-dateofbirth').html('Please recheck the date entered.');
				} 
				
		    }
		    if (!firstname) {
		    	chk = false;
		    	$('#grp-firstname').addClass('has-error');
            	$('#err-firstname').html('Please enter first name');
		    }
		    if (!lastname) {
		    	chk = false;
		    	$('#grp-lastname').addClass('has-error');
            	$('#err-lastname').html('Please enter last name');
		    }
		    if (!gender) {
		    	chk = false;
		    	$('#grp-gender').addClass('has-error');
            	$('#err-gender').html('Please select gender');
		    }
		    if(emails.indexOf(email) != -1){
		    	chk = false;
		    	$('#grp-email').addClass('has-error');
            	$('#err-email').html('The email has already been taken.');
		    }
		    /*if (!emergencynumber) {
		    	chk = false;
		    	$('#grp-emergencynumber').addClass('has-error');
            	$('#err-emergencynumber').html('Please enter emergency number');
		    }*/
		    if (!n_id && !passport) {
		    	chk = false;
		        $('#grp-n_id, #grp-passport').addClass('has-error');
		        $('#err-n_id, #err-passport').html('Select at least one type of identification');
		    }
		    if (!homenumber && !mobilenumber) {
		    	chk = false;
		    	$('#grp-homenumber, #grp-mobilenumber').addClass('has-error');
		    }
		    if (n_id) {
		        if (isNaN(n_id)) {
			    	chk = false;
			    	$('#grp-n_id').addClass('has-error');
	            	$('#err-n_id').html('National ID must be numeric');
			    }else if (n_id.length != 11) {
			    	chk = false;
			    	$('#grp-n_id').addClass('has-error');
	            	$('#err-n_id').html('National ID must be 11 digits');
			    }else if(ids.indexOf(n_id) != -1){
			    	chk = false;
			    	$('#grp-n_id').addClass('has-error');
	            	$('#err-n_id').html('The National ID has already been taken.');
	            	
			    }
		    }
		   	if(passport){
		    	if(ids.indexOf(passport) != -1){
			    	chk = false;
			    	$('#grp-passport').addClass('has-error');
	            	$('#err-passport').html('The Passport number has already been taken.');
		    	}
		    }

		    
		    if(old_reg_ids.indexOf(old_badge_id) != -1){
		    	chk = false;
		    	$('#grp-oldregistration').addClass('has-error');
		    	$('#err-oldregistration').html('The Badge Number has already been taken.');
		    }
		    if (old_badge_id && !dateofissue) {
                chk = false;
                $('#grp-dateofissue').addClass('has-error');
                $('#err-dateofissue').html('Please enter the date of issue');
            }
		    

	        if (chk) {
	        	return true;
	        }else{
	        	return false;
	        }
	        
	        break;

	    case 'address':

		    // get values
		    var hometype = $('#hometype').val();
		    var street_number = $('#street_number').val();
		    var road_trace = $('#road_trace').val();
		    var town_village = $('#town_village').val();
		    var postal_checkbox = $('#postal_checkbox').val();  //delete
		    var postaltype = $('#postaltype').val();
		    var street_number2 = $('#street_number2').val();
		    var road_trace2 = $('#road_trace2').val();
		    var town_village2 = $('#town_village2').val();

		    // validation
		    if (!hometype) {
		    	chk = false;
		    	$('#grp-hometype').addClass('has-error');
            	$('#err-hometype').html('Please enter home type');
		    }
		    /*if (!street_number) {
		    	chk = false;
		    	$('#grp-street_number').addClass('has-error');
            	$('#err-street_number').html('Please enter street number');
		    }
		    if (!road_trace) {
		    	chk = false;
		    	$('#grp-road_trace').addClass('has-error');
            	$('#err-road_trace').html('Please enter road/trace');
		    }*/
		    if (!town_village) {
		    	chk = false;
		    	$('#grp-town_village').addClass('has-error');
            	$('#err-town_village').html('Please enter town/village');
		    }
		    // if home not same as postal
		    if (!$('#postal_checkbox').is(':checked')) {

			    if (!postaltype) {
			    	chk = false;
			    	$('#grp-postaltype').addClass('has-error');
	            	$('#err-postaltype').html('Please enter postal type');
			    }
			    if (!street_number2) {
			    	chk = false;
			    	$('#grp-street_number2').addClass('has-error');
	            	$('#err-street_number2').html('Please enter street number');
			    }
			    if (!road_trace2) {
			    	chk = false;
			    	$('#grp-road_trace2').addClass('has-error');
	            	$('#err-road_trace2').html('Please enter road/trace');
			    }
			    if (!town_village2) {
			    	chk = false;
			    	$('#grp-town_village2').addClass('has-error');
	            	$('#err-town_village2').html('Please enter town/village');
			    }
		    }else{
			    	$('#grp-postaltype, #grp-street_number2, #grp-road_trace2, #grp-town_village2').removeClass('has-error');
	            	$('#err-postaltype, #err-street_number2, #err-road_trace2, #err-town_village2').html('');

		    }

	        if (chk) {
	        	return true;
	        }else{
	        	return false;
	        }
	        break;

	    case 'enterprise':
	    	var cnt = 0;
	    	$('.enterprise').each(function () {
	    		if ($(this).is(':checked')) {
	    			var slug = $(this).attr('slug');
	    			cnt++;
	    			if (!$('#major-'+slug).is(':checked') && !$('#minor-'+slug).is(':checked')) {
	    				chk = false;
				    	$('#grp-ent-'+slug).addClass('has-error');
		            	$('#err-ent-'+slug).html('Please select major or minor for enterprise');
	    			}
	    			if (slug=='other') {
		    			//var other_name = $('#other_name').val();
		    			if (!$('#other_name').val()) {
					    	chk = false;
					    	//$('#grp-other_name').addClass('has-error');
			            	$('#err-ent-other').append('<br>Please enter other name');
					    }
	    			}
	    		}
			});

			if (!cnt) {
				chk = false;
            	$('#err-enterprise').html('Please select al least one');
			}

	        if (chk) {
	        	return true;
	        }else{
	        	return false;
	        }
	        break;

	    case 'parcels':

            /** Application Type **/
            var app_type = $('#app_type').val();
            if (!app_type) {
                chk = false; btn = false;
                $('#grp-app_type').addClass('has-error');
                $('#err-app_type').html('Please select application type');
            }
            var appdate = $('#appdate').val();
            if (!appdate) {
                chk = false;
                $('#grp-appdate').addClass('has-error');
                $('#err-appdate').html('Please enter the date of issue');
            }

	    	// get added parcel numbers
	    	var num = $('#parcels-added').val().split(",");
	    	for (i = 0, len = num.length; i < len; i++) { 
			    var n = num[i];
			    var btn = true;

			    /** Parcel Address **/
			   /* $('#parcel_reg_checkbox_'+n).change(function(){
			    	alert('rrrr');
			    	
			    });
			    
			    $('#parcel_reg_checkbox_'+n).on('click',function(){
			    	alert('rrrr');

			    });*/

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
				if (app && land_type && tenure) {
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
				}

			    /** Type of Crops/Animals **/
		    	// get added crop numbers
		    	var crop = $('#crops-added-'+n).val().split(",");
			    /*for (i2 = 0, len2 = crop.length; i2 < len2; i2++) { 
				    var c = crop[i2];

				    var parcel_type = $('#parcel_type_'+n+'_'+c).val();
				    if (!parcel_type) {
				    	chk = false; btn = false;
				    	$('#grp-parcel_type_'+n+'_'+c).addClass('has-error');
		            	$('#err-parcel_type_'+n+'_'+c).html('Please select crop/animal');
				    }
				    var animal_crop = $('#animal_crop_'+n+'_'+c).val();
				    if (!animal_crop) {
				    	chk = false; btn = false;
				    	$('#grp-animal_crop_'+n+'_'+c).addClass('has-error');
		            	$('#err-animal_crop_'+n+'_'+c).html('Please enter animal/crop');
				    }
				    var parcel_amt = $('#parcel_amt_'+n+'_'+c).val();
				    if (!parcel_amt) {
				    	chk = false; btn = false;
				    	$('#grp-parcel_amt_'+n+'_'+c).addClass('has-error');
		            	$('#err-parcel_amt_'+n+'_'+c).html('Please enter parcel amount');
				    }
				}*/
				    
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
