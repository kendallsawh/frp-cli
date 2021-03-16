    // to check email
    var emails = {!! $emails !!};

    // to check old badge id
    var old_reg_ids = {!! $old_reg_id !!};

    // to check tenure document relations
    var doc_mandatory = {!! json_encode($proof_mandatory) !!};
    var doc_optional = {!! json_encode($proof_optional) !!};
    var proof_conditions = {!! json_encode($proof_conditions) !!};
    var shortlist = {!! json_encode($shortlist) !!};
    //console.log(proof_conditions);

    // change default enter press
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    // clear error status and add confirm data
    $(document).on('change', '.form-control', function() {
        var id = $(this).prop('id');
        $('#grp-'+id).removeClass('has-error');
        $('#err-'+id).html('');

        if ($(this).hasClass('dropdown'))
            $('#conf-'+id).html($('#'+id+' option:selected').text());
        else
            $('#conf-'+id).html($(this).val());

        var parcel = $(this).attr('parcel');
        btn_clear(parcel);
    });
    $(document).on('change', '.proof_codes', function() {
        var parcel = $(this).attr('parcel');
        $('#err-proof_codes_'+parcel).html('');
        btn_clear(parcel);
    });

    //Date Pickers
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 1,
        endDate: "now()",
        color: 'green',
        autoclose: true,
        startView: 2
    });

    function btn_clear(parcel) {
        $('#btn-add-parcel-'+parcel)
        .removeClass('btn-danger')
        .addClass('btn-success')
        .attr('title','')
        .tooltip('destroy');
    }
    $('#n_id, #dp, #passport').change(function() {
        $('#grp-n_id, #grp-dp, #grp-passport').removeClass('has-error');
        $('#err-n_id, #err-dp, #err-passport').html('');
        $('#n_id_pp').addClass('hide');
        $('#n_id_pp_link').prop("href", "");
    });

   

    // input mask for contact numbers
    $('.contact').inputmask({ mask: '(868) 999-9999' });

    // show or hide enterprise major/minor and add confirm data
    


    // if other selected in enterprise add confirm data
    

    // major/minor add confirm data
    

    // add parcel crop
   

    // delete parcel crop
    

    // add parcel
    

    // delete parcel
    

    // remove all entered data in parcel
   

    // view parcel pane
   

    // parcel unit
    

    // error alert
    function errorAlert(msg) {
        $.notify({
            icon: "warning",
            message: msg

        },{
            type: 'danger',
            timer: 1000,
            placement: {
                from: 'top',
                align: 'center'
            }
        });
    }

    // confirm button clicked
    $(document).on('click', '#confirm', function() {
        var tab = $('.tab-pane.active').prop('id');
        var chk = validate(tab);
        if (chk) {
            // check if old avatar exists first
            if ($('#old_avatar').val() && $('#wizardPicturePreview').attr('src')) 
                $('#conf-avatar').attr('src', $('#wizardPicturePreview').attr('src')); 
            else if ($('#old_avatar').val()) 
                $('#conf-avatar').attr('src', '/storage/temp/'+$('#old_avatar').val());  // get avatar
            else
                $('#conf-avatar').attr('src', $('#wizardPicturePreview').attr('src'));  // get avatar

            $('#confirm-card').show();
            $('#errorDiv').hide();
            $('.wizard-container').hide();
            
        }else errorAlert('Please check errors to proceed');
    });

    // edit button clicked
    $(document).on('click', '#edit', function() {
        $('#wizard-container').show();
        $('#confirm-card').hide();
        
    });

    // proof of interest add confirm data
    

    // clear enterprise error message
    

    // clear avatar error message
    $(document).on('change', '#wizard-picture', function() {
        // remove error messages
        $('#err-avatar').html('');
    });

    // tenure required documents after app type change
    
   

    // tenure required documents
    
