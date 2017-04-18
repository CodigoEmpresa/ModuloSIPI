$(function()
{
    $('input[name="Unidad_De_Medida"]').autocomplete(
    {
        source: function (request, response) {
            var matcher = request.term;
            $.get(
                $('input[name="Unidad_De_Medida"]').data('url')+'/'+matcher,
                {},
                'json'
            ).done(function(data){
                console.log(data);
                response($.map(data, function(k, v){
                    return {
                        label: v,
                        value: v
                    };
                }));
            });
        }
    });
});
