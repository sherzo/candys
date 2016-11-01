$(document).ready(function(){

	$('.remove_gasto').on('click', function(){
        $(this).parents('tr').first().remove();
    });

	$('#agregar_gasto').on('click', function(){

		var contador = 1;
		var data = true;
		var importe_s = 0;

		while(data != null){
			
			data = $('input[data="'+contador+'"]').attr('data');
			if(data != null){ 
				contador++;
		}
		}

		var html = '<tr><td><input type="text" '+
		'name="gasto_extra[]" class="form-control input-sm">'+
		'</td><td><div class="input-group"><input type="text" name="importe_extra[]"'+
		'class="form-control input-sm importe" data="'+contador+'" size="8"><span class="input-group-addon">bs</span></div></td>'+
		'<td><div class="input-group"><input type="text" name="cuota[]" '+ 
		'class="form-control input-sm cuota cuota'+contador+'" disabled size="8" value="0"><span class="input-group-addon">bs</span></div>'+
		'</td><td align="center"><button class="btn btn-danger btn-xs remover_gasto"'+ 
		'><span class="glyphicon glyphicon-remove"></span></button>'+ 
		'</td></tr>';

		$('#gastos').append(html);

		$('.remover_gasto').on('click', function(){
            $(this).parents('tr').first().remove();

            var importe_s = 0;
            var importe_input = $('.importe');
            var auxiliar = 0;
			$.each(importe_input, function(index, input){
				
				var data = $(input).val();

				if(data != null){

					auxiliar = $(input).val();
					
					if(auxiliar != ''){
						importe_s = parseFloat(auxiliar) + parseFloat(importe_s);
					}
				}
			});

			$('#importe_s').val(importe_s.toFixed(2));
			if (importe_s != 0) {
				var cuota_s = parseFloat(importe_s) / 44
				$('#cuota_s').val(cuota_s.toFixed(2));
			}

        });

        $('.importe').focusout(function() {
		
		var input = $(this).val();
		var importe = parseFloat(input) / 44;
		var id = $(this).attr('data');

		if(input != ''){
			$('.cuota'+id).val(importe.toFixed(2));	
		}else{
			$('.cuota'+id).val(0);	
		}

		var importe_s = 0;
		var importe_input = $('.importe');

		$.each(importe_input, function(index, input){
			
			var data = $(input).val();

			if(data != null){

				var auxiliar = $(input).val();
				
				if(auxiliar != ''){
					importe_s = parseFloat(auxiliar) + parseFloat(importe_s);
				}
			}
		});

		$('#importe_s').val(importe_s.toFixed(2));
		if (importe_s != 0) {
			var cuota_s = parseFloat(importe_s) / 44
			$('#cuota_s').val(cuota_s.toFixed(2));
		}


		//Calculo de reserva si esta ya fue realizada
		var valor = $('#valor').val();
		var importe_s = $('#importe_s').val();
		var option = $('#opcion').val();
		var importe_t;
		
		if (valor != '' && valor != 0) {
			if (option == '1') {

				var importe_fondo = importe_s * (valor / 100);
				var cuota_fondo = importe_fondo / 44;
				$('#importe_fondo').val(importe_fondo.toFixed(2));
				$('#cuota_fondo').val(cuota_fondo.toFixed(2))
				importe_t = parseFloat(importe_fondo) + parseFloat(importe_s);
				$('#importe_t').val(importe_t.toFixed(2));
				var cuota_t = parseFloat(importe_t) / 44;
				$('#cuota_t').val(cuota_t.toFixed(2));

			}else if (option == '2') {

				var importe_fondo = importe_s * (valor / 100);
				var cuota_fondo = importe_fondo / 44;
				$('#importe_fondo').val('- '+importe_fondo.toFixed(2));
				$('#cuota_fondo').val('- '+cuota_fondo.toFixed(2))
				importe_t =  parseFloat(importe_s) - parseFloat(importe_fondo);
				$('#importe_t').val(importe_t.toFixed(2));
				var cuota_t = parseFloat(importe_t) / 44;
				$('#cuota_t').val(cuota_t.toFixed(2));

			}else if(option == '3'){

				var importe_fondo = valor;
				var cuota_fondo = importe_fondo / 44;
				$('#importe_fondo').val(parseFloat(importe_fondo).toFixed(2));
				$('#cuota_fondo').val(cuota_fondo.toFixed(2))
				importe_t = parseFloat(importe_fondo) + parseFloat(importe_s);
				$('#importe_t').val(importe_t.toFixed(2));
				var cuota_t = parseFloat(importe_t) / 44;
				$('#cuota_t').val(cuota_t.toFixed(2));

			}else if(option == '4'){
				
				var importe_fondo = valor;
				var cuota_fondo = importe_fondo / 44;
				$('#importe_fondo').val('- '+importe_fondo);
				$('#cuota_fondo').val('- '+cuota_fondo.toFixed(2))
				importe_t = parseFloat(importe_s) - parseFloat(importe_fondo);
				$('#importe_t').val(importe_t.toFixed(2));
				var cuota_t = parseFloat(importe_t) / 44;
				$('#cuota_t').val(cuota_t.toFixed(2));

			}
		}

		if ($('#importe_fondo').val() == '0') {
			$('#importe_t').val($('#importe_s').val());
			$('#cuota_t').val((parseFloat($('#importe_s').val()) / 44).toFixed(2));
		}

		if($('#importe_s').val() == '0'){
			$('#cuota_s').val(0);
		}

	});
	});

});