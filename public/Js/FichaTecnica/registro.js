$(function(){
  $.datepicker.setDefaults($.datepicker.regional["es"]);

  $('#AnioDate').datetimepicker({
    format: 'YYYY', 
    viewMode: "years", 
  });
  
  $('#FechaEntrega').datetimepicker({
    format: 'YYYY-MM-DD',
  });

  $("#RegistrarFT").on('click', function(){

  });
  
});