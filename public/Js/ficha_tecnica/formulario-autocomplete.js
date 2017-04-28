$(function()
{
    $('body').delegate('i[data-role="cancel-add-apu"]', 'click', function(e)
    {
        $('input[name="apu"]').val('');
        $('input[name="id_apu"]').val(0);
        $('#apu_seleccionado').html('No se ha seleccionado ningún APU');
        $('#addon_unidad').html('Unidad');
    });

    $('input[name="apu"]').autocomplete(
    {
        source: function (request, response) {
            var matcher = request.term;
            $.get(
                $('input[name="apu"]').data('url')+'/'+matcher,
                {},
                'json'
            ).done(function(data){
                response($.map(data, function(k, v){
                    return {
                        label: k.Codigo+' | '+k.Nombre,
                        value: k.Id,
                        nombre: k.Nombre,
                        codigo: k.Codigo,
                        unidad_de_medida: k.Unidad_De_Medida
                    };
                }));
            });
        },
        select: function (event, ui) {
            event.preventDefault();
            console.log(ui.item);
            $('input[name="apu"]').val(ui.item.label);
            $('#apu_seleccionado').html('<span>'+ui.item.label+' <i data-role="cancel-add-apu" class="pointer fa fa-close"></i></span>');
            $('#addon_unidad').html(ui.item.unidad_de_medida);
        	$('input[name="id_apu"]').val(ui.item.value);
        },
        focus: function (event, ui) {
            event.preventDefault();
            $('input[name="apu"]').val(ui.item.label);
            $('#apu_seleccionado').html('<span>'+ui.item.label+' <i data-role="cancel-add-apu" class="pointer fa fa-close"></i></span>');
            $('#addon_unidad').html(ui.item.unidad_de_medida);
        	$('input[name="id_apu"]').val(ui.item.value);
        }
    });
});
