$(function(e)
{
    var apu = {};
    var table_apu = $('#table_apu').DataTable();

    var procesarAPU = function(current_apu)
    {
        apu[current_apu.Id] = current_apu;
        table_apu.clear().draw(false);
        $.each(apu, function(i, e)
        {
            var $tr = $('<tr data-id="'+e.Id+'">'+
                '<td width="30px">'+e.Codigo+'</td>'+
                '<td>'+e.Nombre+'</td>'+
                '<td>'+e.Unidad_De_Medida+'</td>'+
                '<td>'+e.Cantidad+'</td>'+
                '<td>'+e.Precio_Oficial+'</td>'+
                '<td>'+(e.Cantidad * e.Precio_Oficial)+'</td>'+
                '<td class="no-sort"> <a class="btn btn-xs btn-primary" href="#" data-toggle="tooltip" data-placement="bottom" title="Remover"><i class="fa fa-trash"></i></a> </td>'+
            '</tr>');

            table_apu.row.add($tr).draw(false);
        });
    }

    $('#agregar-apu').on('click', function(e)
    {
        var id_apu = $('input[name="id_apu"]').val();
        var cantidad_apu = $('input[name="cantidad_apu"]').val();

        if (id_apu == 0 || +cantidad_apu == 0)
        {
            bootbox.alert({
                title: 'Error',
                message: 'Debe seleccionar un APU y cantidad',
                buttons: {
                    ok: {
                        label: 'Volver',
                        className: 'btn-default'
                    }
                }
            });

            return false;
        }

        $.get(
            $('#agregar-apu').data('url')+'/'+id_apu,
            {},
            'json'
        ).done(function(apu)
        {
            apu.Precio_Oficial = 'NaN';
            $.each(apu.cotizaciones, function(i, e)
            {
                if (e.Precio_Oficial == '1')
                {
                    apu.Precio_Oficial = e.Precio;
                    return false;
                }
            });
            apu.Cantidad = cantidad_apu;

            procesarAPU(apu);
        }).fail(function(xhr, status, error)
        {
            alert(status);
        });
    });
});
