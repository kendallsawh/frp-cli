
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

		    // validation
		   /* if (avatar.length == 0 && !old_avatar) {
		    	chk = false;
            	$('#err-avatar').html('Please select picture');
		    }*/
		    if (!dob) {
		    	chk = false;
		    	$('#grp-dateofbirth').addClass('has-error');
            	$('#err-dateofbirth').html('Please enter date of birth');
		    }else if(calculateAge(dob) < 18){
		    	chk = false;
		    	$('#grp-dateofbirth').addClass('has-error');
            	$('#err-dateofbirth').html('Applicant must be 18 years or older');
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

	    default:
	        return false;
	}
    
}
