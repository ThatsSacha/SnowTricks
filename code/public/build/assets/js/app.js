$(function() {
    $('.btn-toggle .round').click(function() {
        $(this).toggleClass('active');
        
        // Is not an image
        if ($(this).children('input').val() == '0') {
            $(this).children('input').val('1');
            $(this).parent().parent().parent().children('.textarea').removeClass('is-active');
            $(this).parent().parent().parent().children('.url').addClass('is-active');
        } else {
            $(this).children('input').val('0');
            $(this).parent().parent().parent().children('.textarea').addClass('is-active');
            $(this).parent().parent().parent().children('.url').removeClass('is-active');
        }
    });
});