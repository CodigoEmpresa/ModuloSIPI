$(function()
{
    $('a.ver-mas').on('click', function(e){
        $('.mas').fadeOut();

        $(this).closest('li.list-group-item').find('.mas').fadeIn();
    });
});