 $(document).ready(function(){
    // loading modal scaffolding
    $('.loading-modal')
        .attr('data-toggle',"modal")
        .attr('data-target',"#loadingModal");

    $('.submit').attr('data-loading-text',"<i class='fa fa-spinner fa-pulse fa-fw'></i>");
    
    // loading state after post
    $('form').submit(function(){
        $('.submit').button('loading');
    });
});

$(document).ready(function(){
    // loading modal scaffolding
    $('.loading-modal-dismiss')
        .attr('data-toggle',"modal")
        .attr('data-target',"#loadingModalDismiss");

    $('.submit').attr('data-loading-text',"<i class='fa fa-spinner fa-pulse fa-fw'></i>");
    
    // loading state after post
    $('form').submit(function(){
        $('.submit').button('loading');
    });
});

$(document).ready(function(){
    // loading modal scaffolding
    $('.loading-modal-alt')
        .attr('data-toggle',"modal")
        .attr('data-target',"#loadingModalAlt");

    $('.submit').attr('data-loading-text',"<i class='fa fa-spinner fa-pulse fa-fw'></i>");
    
    // loading state after post
    $('form').submit(function(){
        $('.submit').button('loading');
    });
});

// age function from https://stackoverflow.com/questions/5524743/jquery-age-calculation-on-date
function calculateAge(dob) {
    dob = new Date(dob);
    var today = new Date();
    return Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
}