$(function()
{
    var URL = $('#main').data('url');

    $.get("getFichaTecnicaDatos", function (FichaTecnicadatos) {
        $('#TablaDatos').html(FichaTecnicadatos);
        $('#datosTabla').DataTable({
            responsive: true,
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }],
            language: {
                url: 'public/DataTables/Spanish.json',
                searchPlaceholder: "Buscar"
            }
        });
    });

});
