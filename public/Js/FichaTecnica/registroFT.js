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

    $("#Agregar_Ficha").on('click', function(){
        document.getElementById("registroFichaTecnicaF").reset();
        $("#Anio").selectpicker('refresh');
        $("#Subdireccion").selectpicker('refresh');
        $("#AgregarFichaD").modal('show');
        $("#RegistrarFT").show();
        $("#ModificarFT").hide();
        $("#A1").hide('slow');
        $("#A2").hide('slow');
        $("#A3").hide('slow');
    });

    $("#RegistrarFT").on('click', function(){

        var formData = new FormData($("#registroFichaTecnicaF")[0]);
        var token = $("#token").val();

        $.ajax({
            type: 'POST',
            url: 'addFichaTecnica',
            headers: {'X-CSRF-TOKEN': token},
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            data: formData,
            beforeSend: function(){
            },
            success: function (xhr) {
                $('#registroFichaTecnicaF .form-group').removeClass('has-error');
                document.getElementById("registroFichaTecnicaF").reset();
                $('#mensaje').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
                $('#mensaje').show(60);
                $('#mensaje').delay(1500).hide(600);

                $.get("getFichaTecnicaDatosOne/"+xhr.Id, function (FichaOne) {
                    var t = $('#datosTabla').DataTable();
                    t.row.add( [
                        FichaOne.Codigo_Proceso,
                        FichaOne.Anio,
                        FichaOne.subdireccion.Nombre_Subdireccion,
                        FichaOne.persona.Primer_Nombre+' '+FichaOne.persona.Segundo_Nombre+' '+FichaOne.persona.Primer_Apellido+' '+FichaOne.persona.Segundo_Apellido,
                        '<a href="'+URL+'/fichaTecnica/'+xhr.Id+'/detalles" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="bottom" title="Detalles"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>',
                        '<button type="button" class="btn btn-xs btn-primary" data-funcion="modificarFicha" value="'+xhr.Id+'" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>'
                    ] ).draw( false );
                });
                setTimeout(function(){
                    $("#AgregarFichaD").modal('hide');
                }, 2000);
            },
            error: function (xhr){
                validador_erroresRegistro(xhr.responseJSON);
            }
        });
    });

    var validador_erroresRegistro = function(data){
        $('#registroFichaTecnicaF .form-group').removeClass('has-error');
        $.each(data, function(i, e){
            $("#"+i).closest('.form-group').addClass('has-error');
        });
    }

    $('body').delegate('button[data-funcion="modificarFicha"]','click',function (e) {
        $.get("getFichaTecnicaDatosOne/"+$(this).val()).done(function(FichaOne)
        {
            $("#Anio").selectpicker('val', FichaOne.Anio);
            $("#Subdireccion").selectpicker('val', FichaOne.Subdireccion_Id);
            $("#Objeto").val(FichaOne.Objeto);
            $("#Presupuesto").val(FichaOne.Presupuesto_Estimado);
            $("#FechaEntrega").val(FichaOne.Fecha_Entrega_Estimada);
            $("#Observaciones").val(FichaOne.Observacion);
            $("#Id_FT").val(FichaOne.Id);
            $("#A1").show('slow');
            $("#A2").show('slow');
            $("#A3").show('slow');
            $("#Alcance1").val(FichaOne.Alcance1);
            $("#Alcance2").val(FichaOne.Alcance2);
            $("#Alcance3").val(FichaOne.Alcance3);

            $("#AgregarFichaD").modal('show');
            $("#RegistrarFT").hide('slow');
            $("#ModificarFT").show('slow');
        });
    });

    $("#ModificarFT").on('click', function(){

        var formData = new FormData($("#registroFichaTecnicaF")[0]);
        var token = $("#token").val();

        $.ajax({
            type: 'POST',
            url: 'editFichaTecnica',
            headers: {'X-CSRF-TOKEN': token},
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            data: formData,
            beforeSend: function(){
            },
            success: function (xhr) {
                $('#registroFichaTecnicaF .form-group').removeClass('has-error');
                document.getElementById("registroFichaTecnicaF").reset();
                $('#mensaje').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong>'+xhr.Mensaje+'</div>');
                $('#mensaje').show(60);
                $('#mensaje').delay(1500).hide(600);
                setTimeout(function(){
                    $("#AgregarFichaD").modal('hide');
                }, 2000);
            },
            error: function (xhr){
                validador_erroresRegistro(xhr.responseJSON);
            }
        });
    });

});
