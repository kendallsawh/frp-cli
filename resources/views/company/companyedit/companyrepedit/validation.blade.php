function validate(tab) {

    var chk = true;

    switch(tab) {

       

        case 'reps':
            
            var num = 1; /*change this back to 2 to validate two representatives*/
            for (i = 1; i <= num; i++) { 

                var app_avatar = $('#avatar'+i).val();
                var app_fname = $('#app_fname'+i).val();
                var app_sname = $('#app_sname'+i).val();
                var contact = $('#contact'+i).val();
                var id_type = $('#id_type'+i).val();
                var id_num = $('#id_num'+i).val();

                /*if (app_avatar.length == 0) {
                    chk = false;
                    $('#err-avatar'+i).html('Please select picture');
                }*/

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