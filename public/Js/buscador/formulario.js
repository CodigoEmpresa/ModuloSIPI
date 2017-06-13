$(function()
{
    $('a.ver-mas').on('click', function(e)
    {
        if ($(this).closest('.list-group-item').find('.mas').is(':visible'))
        {
            $(this).text('ver más');
            $(this).closest('.list-group-item').find('.mas').fadeOut();
        } else {
            $(this).text('ver menos');
            $(this).closest('.list-group-item').find('.mas').fadeIn();
        }

        e.preventDefault();
    });
});