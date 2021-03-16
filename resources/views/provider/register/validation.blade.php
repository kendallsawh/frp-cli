
function validate(tab) {

    var chk = true;
	
	var newexist = $('#newexist').val();
	var farmertype = $('#farmertype').val();
	var indorg = $('#indorg').val();
	var indorg_id = $('#indorg_id').val();

    switch(tab) {
	    case 'about':

			if (farmertype == 'ind') {
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
	            	$('#n_id_pp').removeClass('hide');
	            	$('#n_id_pp_link').prop("href", "http://www.google.com/");
	            	
			    }
		    }
		   	if(passport){
		    	if(ids.indexOf(passport) != -1){
			    	chk = false;
			    	$('#grp-passport').addClass('has-error');
	            	$('#err-passport').html('The Passport number has already been taken.');
	            	$('#n_id_pp').removeClass('hide');
	            	$('#n_id_pp_link').prop("href", "http://www.google.com/");
		    	}
		    }

		    
		    /*if(old_reg_ids.indexOf(old_badge_id) != -1){
		    	chk = false;
		    	$('#grp-oldregistration').addClass('has-error');
		    	$('#err-oldregistration').html('The Badge Number has already been taken.');
		    }*/
		    if (old_badge_id && !dateofissue) {
                chk = false;
                $('#grp-dateofissue').addClass('has-error');
                $('#err-dateofissue').html('Please enter the date of issue');
            }
			}
			if (farmertype == 'org'){
				// to check vat nums
			    var vat_nums = {!! $vat_nums !!};
			    // to check reg nums
			    var reg_nums = {!! $reg_nums !!};
			    // to check reg nums
			    var biz_emails = {!! $biz_emails !!};

				// get values
	            var logo = $('#wizard-picture').val();
	            var old_logo = $('#old_logo').val();
	            var org_name = $('#org_name').val();
	            var org_type = $('#org_type').val();
	            var reg_num = $('#reg_num').val();
	            var vat_num = $('#vat_num').val();
	            var biz_email = $('#biz_email').val();
	            var biz_phone = $('#biz_phone').val();

	            // validation
	            /*if (logo.length == 0 && !old_logo) {
	            	chk = false;
	            	$('#err-logo').html('Please select picture');
	            }*/
	            if (!org_name) {
	            	chk = false;
	            	$('#grp-org_name').addClass('has-error');
	            	$('#err-org_name').html('Please enter the name of your organization');
	            }
	            if (!org_type) {
	            	chk = false;
	            	$('#grp-org_type').addClass('has-error');
	            	$('#err-org_type').html('Please enter the type of your organization');
	            }
	            if (!reg_num) {
	            	chk = false;
	            	$('#grp-reg_num').addClass('has-error');
	            	$('#err-reg_num').html('Please enter your registration number');
	            }else if(reg_nums.indexOf(reg_num) != -1){
	                chk = false;
	                $('#grp-reg_num').addClass('has-error');
	                $('#err-reg_num').html('The registration number has already been taken.');
	            }
	            if (!vat_num) {
	            	chk = false;
	            	$('#grp-vat_num').addClass('has-error');
	            	$('#err-vat_num').html('Please enter your V.A.T number');
	            }else if(vat_nums.indexOf(vat_num) != -1){
	                chk = false;
	                $('#grp-vat_num').addClass('has-error');
	                $('#err-vat_num').html('The VAT number has already been taken.');
	            }
	            if (!biz_email) {
	            	chk = false;
	            	$('#grp-biz_email').addClass('has-error');
	            	$('#err-biz_email').html('Please enter your email');
	            }else if(biz_emails.indexOf(biz_email) != -1){
	            	chk = false;
	            	$('#grp-biz_email').addClass('has-error');
	            	$('#err-biz_email').html('The email has already been taken.');
	            }
	            if (!biz_phone) {
	            	chk = false;
	            	$('#grp-biz_phone').addClass('has-error');
	            	$('#err-biz_phone').html('Please enter your company' + "'" + 's number');
	            }
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

		    // validation
		    if (!hometype) {
		    	chk = false;
		    	$('#grp-hometype').addClass('has-error');
            	$('#err-hometype').html('Please enter home type');
		    }
		    if (!street_number) {
		    	chk = false;
		    	$('#grp-street_number').addClass('has-error');
            	$('#err-street_number').html('Please enter street number');
		    }
		    if (!road_trace) {
		    	chk = false;
		    	$('#grp-road_trace').addClass('has-error');
            	$('#err-road_trace').html('Please enter road/trace');
		    }
		    if (!town_village) {
		    	chk = false;
		    	$('#grp-town_village').addClass('has-error');
            	$('#err-town_village').html('Please enter town/village');
		    }

			if (farmertype == 'ind') {
			    var postal_checkbox = $('#postal_checkbox').val();  //delete
			    var postaltype = $('#postaltype').val();
			    var street_number2 = $('#street_number2').val();
			    var road_trace2 = $('#road_trace2').val();
			    var town_village2 = $('#town_village2').val();

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
			}

	        if (chk) {
	        	return true;
	        }else{
	        	return false;
	        }
	        break;

        case 'reps':
            
            var num = 2;
            for (i = 1; i <= num; i++) { 

                var app_avatar = $('#avatar'+i).val();
                var app_fname = $('#app_fname'+i).val();
                var app_sname = $('#app_sname'+i).val();
                var contact = $('#contact'+i).val();
                var id_type = $('#id_type'+i).val();
                var id_num = $('#id_num'+i).val();

                if (app_avatar.length == 0) {
                    chk = false;
                    $('#err-avatar'+i).html('Please select picture');
                }

                if (!app_fname) {
                    chk = false;
                    $('#grp-app_fname'+i).addClass('has-error');
                    $('#err-app_fname'+i).html('Please enter your rep' + "'" + 's first name');
                }
                if (!app_sname) {
                    chk = false;
                    $('#grp-app_sname'+i).addClass('has-error');
                    $('#err-app_sname'+i).html('Please enter your rep' + "'" + 's surname');
                }
                if (!contact) {
                    chk = false;
                    $('#grp-contact'+i).addClass('has-error');
                    $('#err-contact'+i).html('Please enter contact number');
                }
                if (!id_type) {
                    chk = false;
                    $('#grp-id_type'+i).addClass('has-error');
                    $('#err-id_type'+i).html('Please select id type');
                }
                if (!id_num) {
                    chk = false;
                    $('#grp-id_num'+i).addClass('has-error');
                    $('#err-id_num'+i).html('Please enter id number');
                }

            }


            if (chk) {
                return true;
            }else{
                return false;
            }

            break;

	    case 'service':

		    // get values
		    var reg_number = $('#reg_number').val();
		    var chasis_number = $('#chasis_number').val();
		    var cert_copy = $('#cert_copy').val();
		    var rec_count = $('#rec_count').val();

		    // validation
		     /*if (!reg_number) {
		    	chk = false;
		    	$('#grp-reg_number').addClass('has-error');
            	$('#err-reg_number').html('Please enter registration number.');
		    } */
		    if (!chasis_number) {
		    	chk = false;
		    	$('#grp-chasis_number').addClass('has-error');
            	$('#err-chasis_number').html('Please enter chasis number.');
		    }
		    if (cert_copy.length == 0) {
		    	chk = false;
		    	$('#grp-cert_copy').addClass('has-error');
            	$('#err-cert_copy').html('Please upload certified copy.');
		    }
		    // recommendations
		    var d = false;
		    for (var i = 1; i <= rec_count; i++) {
		    	var farmer = $('#farmer_'+i).val();
		    	var date = $('#date_'+i).val();
		    	var land = $('#land_'+i).val();
		    	var name = $('#name_'+i).val();
		    	var name_array = name.split(" ");
		    	//alert($('#farmer_'+i).attr('frmnum'));
		    	var proof = $('#proof_doc_'+i).val();

		    	if (!farmer || proof.length == 0) {
			    	chk = false;
			    	$('#grp-farmer_'+i).addClass('has-error');
            		$('#err-rec_msg').html('Please make sure that '+rec_count+' recommendations are uploaded and the farmer is selectd.');
			    }
			    if (!name) {
			    	chk = false;
			    	$('#grp-name_'+i).addClass('has-error');
	            	$('#err-name_'+i).html('Please enter farmer name.');
			    }
			    if (name_array.length <=1) {
			    	chk = false;
			    	$('#grp-name_'+i).addClass('has-error');
	            	$('#err-name_'+i).html('No surname detected. Please recheck farmer name.');
			    }
			    if (!land) {
			    	chk = false;
			    	$('#grp-land_'+i).addClass('has-error');
	            	$('#err-land_'+i).html('Please enter farmer holding address.');
			    }
			    if (!date) {
			    	chk = false;
			    	$('#grp-date_'+i).addClass('has-error');
	            	$('#err-date_'+i+'_'+farmer).html('Please enter recommendation date.');
			    }

			    // check for duplication
			    for (var n = 1; n <= rec_count; n++) {
			    	if (i != n) {
			    		if (farmer == $('#farmer_'+n).val() && $('#farmer_'+n).val()) {
					    	chk = false;
					    	d = true;
		    				$('#grp-farmer_'+i).addClass('has-error');
			    		}
			    	}
			    }
		    }
		    if (d) { // duplicates
            	$('#err-rec_msg').append('<br>Please make sure the farmers are not duplicated.');
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
