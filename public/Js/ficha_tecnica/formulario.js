$(function(e)
{
    var apu = {};
    var old_apus = $.parseJSON($('input[name="apus"]').val() || null) || {};
    var table_apu = $('#table_apu').DataTable();

    var ajustarAPU = function(apu, cantidad)
    {
        apu.Cantidad = cantidad;

        return apu;
    }

    var procesarAPU = function(current_apu)
    {
        apu[current_apu.Id] = current_apu;
        table_apu.clear().draw(false);
        $.each(apu, function(i, e)
        {
            var $tr = $('<tr data-id="'+e.Id+'">'+
                '<td width="30px">'+e.Id_Item.pad(3)+'-'+e.Id+'</td>'+
                '<td>'+e.Nombre+'</td>'+
                '<td>'+e.Unidad_De_Medida+'</td>'+
                '<td>'+e.Cantidad+'</td>'+
                '<td>'+e.Precio_Oficial+'</td>'+
                '<td>'+(e.Cantidad * e.Precio_Oficial)+'</td>'+
                '<td class="no-sort"> <a class="btn btn-xs btn-primary" data-role="Remover" href="#" data-toggle="tooltip" data-placement="bottom" title="Remover"><i class="fa fa-trash"></i></a> </td>'+
            '</tr>');

            table_apu.row.add($tr).draw(false);
        });
    }

    $('#table_apu tbody').delegate('a[data-role="Remover"]', 'click', function(e)
    {
        delete apu[$(this).closest('tr').data('id')];
        table_apu.row( $(this).closest('tr') )
                .remove()
                .draw(false);

        e.preventDefault();
    });

    $('#form-ficha-tecnica').on('submit', function(e)
    {
        $('input[name="apus"]').val(JSON.stringify(apu));
    });

    $('#agregar-apu').on('click', function(e)
    {
        var id_apu = $('input[name="id_apu"]').val();
        var cantidad_apu = $('input[name="cantidad_apu"]').val();

        if (id_apu == 0 || +cantidad_apu == 0)
        {
            bootbox.alert({
                title: 'Error',
                message: 'Debe seleccionar un insumo y cantidad',
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
            procesarAPU(ajustarAPU(apu, cantidad_apu));
        }).fail(function(xhr, status, error)
        {
            alert(status);
        });
    });

    if(!$.isEmptyObject(old_apus))
    {
        $.each(old_apus, function(i, apu)
        {
            if (apu.pivot)
                procesarAPU(ajustarAPU(apu, apu.pivot.Cantidad));
            else
                procesarAPU(ajustarAPU(apu, apu.Cantidad));
        });
    }
});
