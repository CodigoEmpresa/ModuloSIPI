$(function()
{
    $('#agregar-item').on('click', function(e)
    {
        $('#modal-agregar-item').modal('show');
        
        e.preventDefault();
    });
});
