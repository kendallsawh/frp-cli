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
            /*if (!reg_num) {
                chk = false;
                $('#grp-reg_num').addClass('has-error');
                $('#err-reg_num').html('Please enter your registration number');
            }else*/ if(reg_nums.indexOf(reg_num) != -1){
                chk = false;
                $('#grp-reg_num').addClass('has-error');
                $('#err-reg_num').html('The registration number has already been taken.');
            }
            /*if (!vat_num) {
                chk = false;
                $('#grp-vat_num').addClass('has-error');
                $('#err-vat_num').html('Please enter your V.A.T number');
            }else*/ if(vat_nums.indexOf(vat_num) != -1){
                chk = false;
                $('#grp-vat_num').addClass('has-error');
                $('#err-vat_num').html('The VAT number has already been taken.');
            }
            /*if (!biz_email) {
                chk = false;
                $('#grp-biz_email').addClass('has-error');
                $('#err-biz_email').html('Please enter your email');
            }else*/ if(emails.indexOf(biz_email) != -1){
                chk = false;
                $('#grp-biz_email').addClass('has-error');
                $('#err-biz_email').html('The email has already been taken.');
            }
            if (!biz_phone) {
                chk = false;
                $('#grp-biz_phone').addClass('has-error');
                $('#err-biz_phone').html('Please enter your company' + "'" + 's number');
            }
            if(old_reg_ids.indexOf(oldregistration) != -1){
                chk = false;
                $('#grp-oldregistration').addClass('has-error');
                $('#err-oldregistration').html('The Badge Number has already been taken.');
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

            //** Application Type
            var app_type = $('#app_type').val();
            if (!app_type) {
                chk = false; btn = false;
                $('#grp-app_type').addClass('has-error');
                $('#err-app_type').html('Please select application type');
            }

            // get added parcel numbers
            var num = $('#parcels-added').val().split(",");
            for (i = 0, len = num.length; i < len; i++) { 
                var n = num[i];
                var btn = true;

                //** Parcel Address
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

                //** Lands Details
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
                }

                //** Type of Crops/Animals
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