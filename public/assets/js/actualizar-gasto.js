$(document).ready(function(){
  $('.actualizar').on('click', function(e){
    e.preventDefault();
    var a = $(this);
    var gasto = $(this).attr('data');

    $.get('gastos/actualizar/' + gasto, function(data){

      var estatus = data.estatus ? 'Activo' : 'Inactivo';
      var clase = data.estatus ? 'label label-success pull-right' : 'label label-warning pull-right';
      $('span', a).text(estatus);
      $('span', a).attr('class', clase);
    });
  });
});
