$(function(){
  $.datepicker.setDefaults($.datepicker.regional["es"]);

  var URL = $('#main').data('url');

  $('#AnioDate').datetimepicker({
    format: 'YYYY',
    viewMode: "years",
  });

  $('#FechaEntrega').datetimepicker({
    format: 'YYYY-MM-DD',
  });

  $('#Alcance1').datetimepicker({
    format: 'YYYY-MM-DD',
  });

  $('#Alcance2').datetimepicker({
    format: 'YYYY-MM-DD',
  });

  $('#Alcance3').datetimepicker({
    format: 'YYYY-MM-DD',
  });

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
      $("#AgregarFichaD").modal('show');
      $("#Anio").removeAttr("readonly", "readonly");
      $("#Subdireccion").removeAttr("readonly", "readonly");
      $("#Objeto").removeAttr("readonly", "readonly");
      $("#Presupuesto").removeAttr("readonly", "readonly");
      $("#FechaEntrega").removeAttr("readonly", "readonly");
      $("#Observaciones").removeAttr("readonly", "readonly");
      $("#Alcance1").removeAttr("readonly", "readonly");
      $("#Alcance2").removeAttr("readonly", "readonly");
      $("#Alcance3").removeAttr("readonly", "readonly");
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

  $('body').delegate('button[data-funcion="verFicha"]','click',function (e) {
    $.get("getFichaTecnicaDatosOne/"+$(this).val(), function (FichaOne) {
      $("#Anio").val(FichaOne.Anio);
      $("#Subdireccion").val(FichaOne.Subdireccion_Id);
      $("#Objeto").val(FichaOne.Objeto);
      $("#Presupuesto").val(FichaOne.Presupuesto_Estimado);
      $("#FechaEntrega").val(FichaOne.Fecha_Entrega_Estimada);
      $("#Observaciones").val(FichaOne.Observacion);

      if(FichaOne.Alcance1 != '0000-00-00' || FichaOne.Alcance2 != '0000-00-00' || FichaOne.Alcance3 != '0000-00-00'){
        if(FichaOne.Alcance1 == '0000-00-00' || FichaOne.Alcance1 == null){
          $("#A1").hide('slow');
        }else{
          $("#A1").show('slow');
          $("#Alcance1").val(FichaOne.Alcance1);

        }

        if(FichaOne.Alcance2 == '0000-00-00' || FichaOne.Alcance2 == null){
          $("#A2").hide('slow');
        }else{
          $("#A2").show('slow');
          $("#Alcance2").val(FichaOne.Alcance2);
        }

        if(FichaOne.Alcance3 == '0000-00-00' || FichaOne.Alcance3 == null){
          $("#A3").hide('slow');
        }else{
          $("#A3").show('slow');
          $("#Alcance3").val(FichaOne.Alcance3);
        }

      }else{

      }
    }).done(function(){
      $("#AgregarFichaD").modal('show');
      $("#Anio").attr("readonly", "readonly");
      $("#Subdireccion").attr("readonly", "readonly");
      $("#Objeto").attr("readonly", "readonly");
      $("#Presupuesto").attr("readonly", "readonly");
      $("#FechaEntrega").attr("readonly", "readonly");
      $("#Observaciones").attr("readonly", "readonly");
      $("#Alcance1").attr("readonly", "readonly");
      $("#Alcance2").attr("readonly", "readonly");
      $("#Alcance3").attr("readonly", "readonly");
      $("#RegistrarFT").hide();
      $("#ModificarFT").hide();
    });
  });

  $('body').delegate('button[data-funcion="modificarFicha"]','click',function (e) {
    $.get("getFichaTecnicaDatosOne/"+$(this).val(), function (FichaOne) {
      $("#Anio").val(FichaOne.Anio);
      $("#Subdireccion").val(FichaOne.Subdireccion_Id);
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
    }).done(function(){
      $("#AgregarFichaD").modal('show');
      $("#RegistrarFT").hide('slow');
      $("#ModificarFT").show('slow');
      $("#Anio").removeAttr("readonly", "readonly");
      $("#Subdireccion").removeAttr("readonly", "readonly");
      $("#Objeto").removeAttr("readonly", "readonly");
      $("#Presupuesto").removeAttr("readonly", "readonly");
      $("#FechaEntrega").removeAttr("readonly", "readonly");
      $("#Observaciones").removeAttr("readonly", "readonly");
      $("#Alcance1").removeAttr("readonly", "readonly");
      $("#Alcance2").removeAttr("readonly", "readonly");
      $("#Alcance3").removeAttr("readonly", "readonly");
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
