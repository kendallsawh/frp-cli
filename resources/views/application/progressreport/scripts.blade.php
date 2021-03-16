  
    
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
        ;
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

    // parcel unit
    $(document).on('change', '.parcel_type', function() {
        var unit = $('option:selected', this).attr('unit');
        var parcel = $(this).attr('parcel');
        var crop = $(this).attr('crop');
        $('#parcel_unit_'+parcel+'_'+crop).html(unit);
        $('#conf-parcel_unit_'+parcel+'_'+crop).html(unit);
    });

    

   

