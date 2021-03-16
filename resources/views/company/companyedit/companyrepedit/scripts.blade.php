    

    


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
   

    

   
    $('#n_id, #dp, #passport').change(function() {
        $('#grp-n_id, #grp-dp, #grp-passport').removeClass('has-error');
        $('#err-n_id, #err-dp, #err-passport').html('');
    });

   

    // input mask for contact numbers
    $('.contact').inputmask({ mask: '(868) 999-9999' });

    


    

   

   

   

   






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
            if ($('#old_avatar').val() && $('.avatar1 img').attr('src')) 
                $('#conf-avatar1').attr('src', $('.avatar1 img').attr('src')); 
            else if ($('#old_avatar').val()) 
                $('#conf-avatar1').attr('src', '/storage/temp/'+$('#old_avatar').val());  // get avatar
            else
                $('#conf-avatar1').attr('src', $('.avatar1 img').attr('src'));  // get avatar

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

    

  

    // clear avatar error message
    $(document).on('change', '#wizard-picture', function() {
        // remove error messages
        $('#err-avatar').html('');
    });



   

 
