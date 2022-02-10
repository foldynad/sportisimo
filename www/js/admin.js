$(document).ready(function(){

    $.nette.init();

    $.nette.ext('snippets').after(function ($el) {
        init();
    });

    init();
});

function init()
{
    $('.flash').fadeOut(5000);
    $('.modal').modal();

    if ($('#brandFormModal').hasClass('opened')) {
        $('#brandFormModal').modal('open');
    } else {
        //$('#brandFormModal').modal('destroy');
        $('body').css('overflow', 'auto');
    }
}