$(function()
{
    function populateItem(item)
    {
        $.each(item, function(key, value)
        {
            $('#modal-agregar-item *[name="'+key+'"]').val(value);
        });

        $('#modal-agregar-item').modal('show');
    }


    $('#agregar-item').on('click', function(e)
    {
        var item = {
            Id_Item: 0,
            Codigo: '',
            Unidad_De_Medida: '',
            Nombre: '',
            Descripcion: ''
        }

        populateItem(item);
        e.preventDefault();
    });
});
