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

    var evaluarTotales = function()
    {
        var presupuestado = $('input[name="Presupuesto_Estimado"]').val();
        var total = 0;
        var porcentaje = 0;
        var clase = 'progress-bar-success';

        if (+presupuestado > 0)
        {
            $.each(apu, function(i, a)
            {
                total += a.Cantidad * a.Precio_Oficial;
            });

            porcentaje = (total * 100) / +presupuestado;

            if(porcentaje > 100)
                clase = 'progress-bar-danger';
            else if(porcentaje > 0)
                clase = 'progress-bar-success';

            porcentaje = porcentaje > 100 ? 100 : porcentaje;

            $('#Presupuesto_Utilizado').text(total);

        } else {
            porcentaje = 0;
        }

        $('#progress').removeClass('progress-bar-danger progress-bar-warning progress-bar-success').addClass(clase).css('width', porcentaje+'%');
    }

    var procesarAPU = function(current_apu)
    {
        var perfil = $('#table_apu').data('perfil');

        apu[current_apu.Id] = current_apu;
        table_apu.clear().draw(false);
        $.each(apu, function(i, e)
        {
            var $tr = $('<tr data-id="'+e.Id+'">'+
                '<td width="30px">'+e.Id_Item.pad(4)+'-'+e.Id+'</td>'+
                '<td>'+e.Nombre+'</td>'+
                '<td>'+e.Cantidad+'</td>'+
                '<td>'+(+e.Precio_Oficial)+'</td>'+
                '<td>'+(e.Cantidad * e.Precio_Oficial)+'</td>'+
                '<td>'+e.Unidad_De_Medida+'</td>'+
                '<td class="no-sort">'+(perfil == 'Gestor' ? '<a class="btn btn-xs btn-primary" data-role="Remover" href="#" data-toggle="tooltip" data-placement="bottom" title="Remover"><i class="fa fa-trash"></i></a>' : '')+'</td>'+
            '</tr>');

            table_apu.row.add($tr).draw(false);
        });

        evaluarTotales();
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

    $('input[name="Presupuesto_Estimado"]').on('change', function(e){
        evaluarTotales();
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

    $('#agregar_alcance').on('click', function(e)
    {
        if(!$('#div_alcance_1').is(':visible'))
            $('#div_alcance_1').fadeIn();
        else if(!$('#div_alcance_2').is(':visible'))
            $('#div_alcance_2').fadeIn();
        else if(!$('#div_alcance_3').is(':visible'))
            $('#div_alcance_3').fadeIn();
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
