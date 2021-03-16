

    // to check tenure document relations
    var doc_mandatory = {!! json_encode($proof_mandatory) !!};
    var doc_optional = {!! json_encode($proof_optional) !!};
    var shortlist = {!! json_encode($shortlist) !!};

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
    });


    // show or hide enterprise major/minor and add confirm data
    $(document).on('change', '.enterprise', function() {
        var slug = $(this).attr('slug');
        var text = $("label[for='ent-"+slug+"']").text();
        
        if ($(this).is(':checked')) {
            $('#majordiv-'+slug).show();
            $('#minordiv-'+slug).show();
            $('#conf-enterprise').append('<div id="conf-ent-'+slug+'">'+text+': <strong id="conf-ent-level-'+slug+'"></strong></div>');
            if (slug == 'other') {
                $('#other-text').show();
                $('#other_name').focus();
            }
        }else{
            $('#conf-ent-'+slug).remove();
            $('#majordiv-'+slug).hide();
            $('#minordiv-'+slug).hide();
            $('input[name="majorminor['+slug+']"]').prop('checked', false);
            if (slug == 'other') {
                $('#other-text').hide();
                $('#other_name').val('');
            }
        }
    });

    


    // if other selected in enterprise add confirm data
    $(document).on('change', '#other_name', function() {
        var val = $(this).val();
        if ($('[name = "majorminor[other]"]').is(':checked')) 
            var level = $('[name = "majorminor[other]"]').val();
        else
            var level = '';

        $('#conf-ent-other').remove();
        $('#conf-enterprise').append('<div class="col-lg-4" id="conf-ent-other">'+val+' (Other): <strong id="conf-ent-level-other">'+level+'</strong></div>');
    });

    // major/minor add confirm data
    $(document).on('change', '.majorminor', function() {
        var val = $(this).val();
        var slug = $(this).attr('slug');
        $('#conf-ent-level-'+slug).html(val);
    });

    // add parcel crop
    var cropNum = 1;
    @if(old('animal_crop')) // add crops to num if returned from validation
    @foreach(old('animal_crop') as $ca)
    cropNum+= {{count($ca)}};
    @endforeach
    @endif
    $(document).on('click', '.btn-add-crop', function() {
        //kendall commented this off to allow for adding new crop to existing list from db
        //cropNum++;

        cropNum = $(this).attr('nextcrop')
        var pane = $(this).attr('pane');
        $("#div-crops-"+pane).append('@include("farmer.register.parcel.newcrop")');
        // add crop number to list
        $('#crops-added-'+pane).val($('#crops-added-'+pane).val()+','+cropNum);
        // add crop to confirm pane
        $("#div-crops-conf-"+pane).append('@include("farmer.register.parcel.newcrop_conf")');

    });

    // delete parcel crop
    $(document).on('click', '.btn-del-crop', function() {
        var chk = confirm('are you sure?');
        if (chk) {
            var row = $(this).attr('target');
            var pane = $(this).attr('pane');
            var crop = $(this).attr('crop');
            $('#'+row+', #conf-'+row).remove();

            // remove crop from list
            var num = $('#crops-added-'+pane).val().split(",");
            for (i = 0, len = num.length; i < len; i++) {
                if (num[i] == crop) {
                    num.splice(i, 1);
                    $('#crops-added-'+pane).val(num.toString());
                }
            }
        }
    });

    // add parcel
    var parcelNum = $('#parcel_num').val();
    $(document).on('click', '#btn-add-parcel', function() {
        var removed = $('#parcels-removed').val().split(",");
        if (removed[0]) {
            // add button for new parcel pane
            $('#btn-add-parcel-'+removed[0]).removeClass('hide');
            // view new parcel pane
            $('button[target="parcel-pane-'+removed[0]+'"]').click();

            // show confirm section
            $('#conf-parcel-div-'+removed[0]).removeClass('hide');

            // add parcel number to list
            $('#parcels-added').val($('#parcels-added').val()+','+removed[0]);

            removed.splice(0, 1);
            $('#parcels-removed').val(removed.toString());
        }else{
            parcelNum++;
            $('#parcel_num').val(parcelNum);

            // show button row
            $('#row-parcel-btns').removeClass('hide');
            // add button for new parcel pane
            $('#btn-add-parcel-'+parcelNum).removeClass('hide');
            // view new parcel pane
            $('button[target="parcel-pane-'+parcelNum+'"]').click();

            // show confirm section
            $('#conf-parcel-div-'+parcelNum).removeClass('hide');
            if (parcelNum <= {{$parcel_count}}) {
                // add parcel number to list
                $('#parcels-added').val($('#parcels-added').val()+','+parcelNum);
            } 
        }

        // disable add button once max is reached
        if (parcelNum >= {{$parcel_count}} && !removed[0]) 
            $(this).removeClass('btn-success').addClass('btn-default').tooltip('destroy');

    });



    // remove all entered data in parcel
    function clearParcel(parcel) {
        $('#tenure_'+parcel+" > option").each(function() {
            $("#tenure_"+parcel+" > option[value='" + this.value + "']").hide();
        });
        $("#tenure_"+parcel+", #land_type_"+parcel).prop('selectedIndex',0).parent().addClass('is-empty');

        $('.rowParcel-'+parcel+', .conf-proof-'+parcel).remove();

        // remove crop from list
        var num = $('#crops-added-'+parcel).val('1');

        $('#err-proof_codes_'+parcel).html('');
        $('.proof_star_'+parcel+', .proof_option_'+parcel+', .proofs_'+parcel).addClass('hide');
        $('.proof_codes_'+parcel).each(function() {
            if ($(this).is(':checked')) {$(this).prop('checked', false);}
        });
        $('.proof_docs_'+parcel).each(function() {$(this).val('');});
    }

    // view parcel pane
    $(document).on('click', '.parcel-view', function() {
        var target = $(this).attr('target');
        $('.parcel-pane').addClass('hide');
        $('#'+target).removeClass('hide');
        $('.parcel-view').removeClass('btn-success').addClass('btn-default');
        $(this).removeClass('btn-default').addClass('btn-success');
        //alert(target);
    });

    // parcel unit
    $(document).on('change', '.parcel_type', function() {
        var unit = $('option:selected', this).attr('unit');
        var parcel = $(this).attr('parcel');
        var crop = $(this).attr('crop');
        $('#parcel_unit_'+parcel+'_'+crop).html(unit);
        $('#conf-parcel_unit_'+parcel+'_'+crop).html(unit);
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

    // proof of interest add confirm data
    $(document).on('change', '.proof_codes', function() {
        var parcel = $(this).attr('parcel');
        var code = $(this).attr('code');
        var text = $("label[for='proof_codes_"+parcel+"_"+code+"']").text();
        
        if ($(this).is(':checked')) {
            $('#conf-proof_codes_'+parcel).append('<div id="conf-proof-'+code+'" class="conf-proof-'+parcel+' conf-proof-all">'+text+'</div>');
        }else{
            $('#conf-proof-'+code).remove();
        }
    });

    // clear enterprise error message
    $(document).on('change', '.enterprise, .majorminor, #other_name', function() {
        var slug = $(this).attr('slug');
        // remove error messages
        $('#err-enterprise, #err-ent-'+slug).html('');
    });

  /*  // clear avatar error message
    $(document).on('change', '#wizard-picture', function() {
        // remove error messages
        $('#err-avatar').html('');
    });*/

    // tenure required documents after app type change
    $(document).on('click', '.app_type', function() {
        var parcel = $(this).attr('parcel');
        var app = $('#app_type').val();
        //alert(app+' app - '+land_type+' lt - '+tenure+' tenure');

        // shortlist
        // app type -> land type -> tenure
        //console.log(shortlist);
        $(".land_type > option").each(function() {
            $(".land_type > option[value='" + this.value + "']").hide();
        });
        $('.tenure > option').each(function() {
            //$(".tenure > option[value='" + this.value + "']").hide();
        });
        //$('.land_type, .tenure').prop('selectedIndex',0).parent().addClass('is-empty');

        $('#err-proof_codes').html('');
        //$('.proof_star, .proof_option, .proofs').addClass('hide');
       /* $('.proof_codes').each(function() {
            if ($(this).is(':checked')) {$(this).prop('checked', false);}
        });
        $('.proof_docs').each(function() {$(this).val('');});*/

        //kens edit
        /*$('.proof_codes_'+parcel).each(function() {if ($(this).is(':checked')) {$(this).prop('checked', false);}
        });
        $('.proof_docs_'+parcel).each(function() {$(this).val('');})*/;



        //$('.conf-proof-all').remove();

        if (app) {
            $.each(shortlist, function(index, item) {
                if (index === app) {
                    $.each(item, function(land, tenur) {
                        $(".land_type > option[value='" + land + "']").show();
                    });
                }
            });
        }
    });

    $(document).on('click', '.land_type', function() {
        var parcel = $(this).attr('parcel');
        var app = $('#app_type').val();
        var land_type = $('#land_type_'+parcel).val();
        //alert(app+' app - '+land_type+' lt - '+tenure+' tenure');

        // shortlist
        // app type -> land type -> tenure
        //console.log(shortlist);
        $('#tenure_'+parcel+" > option").each(function() {
            $("#tenure_"+parcel+" > option[value='" + this.value + "']").hide();
        });
        $("#tenure_"+parcel).prop('selectedIndex',0).parent().addClass('is-empty');
        $('.conf-proof-'+parcel).remove();

        if (app && land_type) {
            $.each(shortlist, function(index, item) {
                if (index === app) {
                    $.each(item, function(land, tenur) {
                        if (land === land_type) {
                            $.each(tenur, function (i, value) {
                                $("#tenure_"+parcel+" > option[value='" + value + "']").show();
                            });   
                        }
                    });
                }
            });
        }
    });

   

    // tenure required documents
    $(document).on('click', '.tenure', function() {
        var parcel = $(this).attr('parcel');
        var app = $('#app_type').val();
        var land_type = $('#land_type_'+parcel).val();
        var tenure = $('#tenure_'+parcel).val();

        //alert(app+' app - '+land_type+' lt - '+tenure+' tenure');
        //alert(proofparcel)

        $('#err-proof_codes_'+parcel).html('');
        $('.proof_star_'+parcel+', .proof_option_'+parcel+', .proofs_'+parcel).addClass('hide');
        $('.proof_codes_'+parcel).each(function() {if ($(this).is(':checked')) {$(this).prop('checked', false);}});
        $('.proof_docs_'+parcel).each(function() {$(this).val('');});
        $('.conf-proof-'+parcel).remove();

        if (app && land_type && tenure) {
            //alert(app+' app - '+land_type+' lt - '+tenure+' tenure');
            // mandatory
            if( typeof(doc_mandatory) != 'undefined' &&
                typeof(doc_mandatory[app]) != 'undefined' &&
                typeof(doc_mandatory[app][land_type]) != 'undefined' &&
                typeof(doc_mandatory[app][land_type][tenure]) != 'undefined' 
                ) {
                //alert(doc_mandatory[app][land_type][tenure] + ' ' + doc_mandatory[app] + ' ' + doc_mandatory[app][land_type] + ' ' + doc_mandatory);
            doc_mandatory[app][land_type][tenure].forEach(function(item, index, arr) {
                $('#proof_star_'+parcel+'_'+item+', #proofs_'+parcel+'_'+item).removeClass('hide');
            });

            // optional
            if( typeof(doc_optional) != 'undefined' &&
                typeof(doc_optional[app]) != 'undefined' &&
                typeof(doc_optional[app][land_type]) != 'undefined' &&
                typeof(doc_optional[app][land_type][tenure]) != 'undefined' 
                ) {
                //alert(doc_optional[app][land_type][tenure]);
                doc_optional[app][land_type][tenure].forEach(function(item, index, arr) {
                    $('#proof_opt_'+parcel+'_'+item+', #proofs_'+parcel+'_'+item).removeClass('hide');
                });
            }
        }
    }
});
