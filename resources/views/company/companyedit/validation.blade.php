function validate(tab) {

    var chk = true;

    switch(tab) {

        case 'about' :

            // get values
            var logo = $('#wizard-picture').val();
            var old_logo = $('#old_logo').val();
            var org_name = $('#org_name').val();
            var org_type = $('#org_type').val();
            var reg_num = $('#reg_num').val();
            var vat_num = $('#vat_num').val();
            var biz_email = $('#biz_email').val();
            var biz_phone = $('#biz_phone').val();
            var oldregistration = $('#oldregistration').val();
            var old_badge_id = $('#oldregistration').val();
            var dateofissue = $('#dateofissue').val();

            // validation
            if (oldregistration && !dateofissue) {
                chk = false;
                $('#grp-dateofissue').addClass('has-error');
                $('#err-dateofissue').html('Please enter the date of issue');
            }
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
            }
            if (!vat_num) {
                chk = false;
                $('#grp-vat_num').addClass('has-error');
                $('#err-vat_num').html('Please enter your V.A.T number');
            }
            if (!biz_phone) {
                chk = false;
                $('#grp-biz_phone').addClass('has-error');
                $('#err-biz_phone').html('Please enter your company' + "'" + 's number');
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

            if (chk) {
                return true;
            }else{
                return false;
            }

            break;

        case 'reps':
            
            var num = 1; /*change this back to 2 to validate two representatives*/
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

        

        default:
            return false;
    }

}