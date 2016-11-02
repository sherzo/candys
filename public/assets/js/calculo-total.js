$('.importe').focusout(function() {

		var importe_s = 0;
		var cuota_s = 0;
		var importe_input = $('.importe');
		var cuota_input = $('.cuota');

		$.each(importe_input, function(index, input){

			if($(input).val() != null){

				var auxiliar = $(input).val();

				if(auxiliar != ''){
					importe_s = parseFloat(auxiliar) + parseFloat(importe_s);
				}
			}
		});
		if(importe_s != 0){
		$('#importe_s').val(importe_s.toFixed(2));
		}else {
		$('#importe_s').val(0);
		}
		if (importe_s != 0) {
			cuota_s = parseFloat(importe_s) / 44
			$('#cuota_s').val(cuota_s.toFixed(2));
		}else{
			$('#cuto_s').val(0);
		}

		var input = $(this).val();
		var importe = parseFloat(input) / 44;
		var id = $(this).attr('data');

		if(input != ''){
			$('.cuota'+id).val(importe.toFixed(2));	
		}else{
			$('.cuota'+id).val(0);	

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
					if(parseFloat(importe_fondo) >= parseFloat($('#fondo_real').val())){
						$('#importe_fondo').val('- '+importe_fondo.toFixed(2));
						$('#cuota_fondo').val('- '+cuota_fondo.toFixed(2))
						importe_t = parseFloat(importe_s) - parseFloat(importe_fondo);
						$('#importe_t').val(importe_t.toFixed(2));
						var cuota_t = parseFloat(importe_t) / 44;
						$('#cuota_t').val(cuota_t.toFixed(2));
					}else {
						console.log('h0');
						$('.alert').attr('class', 'show');
						$('alert').html('<strong>¡Cuidado!</strong> El monto a'+
						' descontar es mayor al real disponible');
					}
			}else if(option == '3'){

				var importe_fondo = valor;
				var cuota_fondo = parseFloat(importe_fondo) / 44;
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
			$('#importe_t').val(importe_s);
			$('#cuota_t').val((parseFloat(importe_s) / 44).toFixed(2))
		}

		if($('#importe_s').val() == '0'){
			$('#cuota_s').val(0);
		}
});

$('#opcion').on('change',function(e){
	
	if(e.target.value == ''){

		$('#valor').attr('disabled', true);
		$('#valor').val('');
		$('#importe_fondo').val(0);
		$('#cuota_fondo').val(0);
		if($('#importe_s').val() != '0'){
			$('#importe_t').val($('#importe_s').val());
		}

	}else if(e.target.value == '1' || e.target.value == '2'){
		$('#valor').val('');
		$('#importe_fondo').val(0);
		$('#cuota_fondo').val(0);
		$('#valor').attr('disabled', false);
		$('#valor').attr('type', 'number');
		$('#valor').attr('maxlength', '3');
		$('#valor').attr('title', 'El porcentaje debe estar entre de 1 a 100 %')

		$('#operacion').text('%');

		if ($('#importe_fondo').val() == '0') {
			$('#importe_t').val($('#importe_s').val());
		}

	}else if (e.target.value == '3' || e.target.value == '4'){
		$('#valor').val('');
		$('#importe_fondo').val(0);
		$('#cuota_fondo').val(0);
		$('#valor').attr('disabled', false);
		$('#valor').attr('disabled', false);
		$('#valor').attr('size', '6');
		$('#valor').attr('maxlength', '')
		$('#valor').attr('type', 'text');
		$('#valor').attr('title', 'Ingrese el monto en bs')
		$('#operacion').text('bs');


		if ($('#importe_fondo').val() == '0') {
			$('#importe_t').val($('#importe_s').val());
			$('#cuota_t').val((parseFloat($('#importe_t').val()) / 44).toFixed(2))
		}

	}

	if ($('#importe_fondo').val() == '0') {
			$('#importe_t').val($('#importe_s').val());
			$('#cuota_t').val((parseFloat($('#importe_t').val()) / 44).toFixed(2))
		}

});


$('#valor').focusout(function(){

	var valor = $(this).val();
	var a = $(this).attr('maxlength');
	var importe_s = $('#importe_s').val();
	var option = $('#opcion').val();
	var importe_t;

	if((valor <= 0 || valor >100) && (a != false)){

		$(this).val('');
		$('#importe_fondo').val(0);
		$('#cuota_fondo').val(0)

	}else {

		if(importe_s != 0 || a == false){ 

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
				if(valor == ''){
					$('#importe_fondo').val(0);
					$('#cuota_fondo').val(0)
					$('#importe_t').val(0);
					$('#cuota_t').val(0);
				}else{
					
					
					var importe_fondo = valor;
					var cuota_fondo = parseFloat(importe_fondo) / 44;
					$('#importe_fondo').val(parseFloat(importe_fondo).toFixed(2));
					$('#cuota_fondo').val(cuota_fondo.toFixed(2))
					importe_t = parseFloat(importe_fondo) + parseFloat(importe_s);
					$('#importe_t').val(importe_t.toFixed(2));
					var cuota_t = parseFloat(importe_t) / 44;
					$('#cuota_t').val(cuota_t.toFixed(2));
					
				}
			}else if(option == '4'){
				if(valor == ''){
					$('#importe_fondo').val(0);
					$('#cuota_fondo').val(0)
					$('#importe_t').val(0);
					$('#cuota_t').val(0);
				}else{

				var importe_fondo = valor;
				
				var cuota_fondo = importe_fondo / 44;
				$('#importe_fondo').val('- '+importe_fondo);
				$('#cuota_fondo').val('- '+cuota_fondo.toFixed(2))
				if(importe_s != '0'){
				importe_t = parseFloat(importe_s) - parseFloat(importe_fondo);
				$('#importe_t').val(importe_t.toFixed(2));
				var cuota_t = parseFloat(importe_t) / 44;
				$('#cuota_t').val(cuota_t.toFixed(2));
			
				}
			}

			}

		}else{

			$('#importe_fondo').val(0);
			$('#cuota_fondo').val(0)

		}

		if($('#importe_s').val() == '0'){
			$('#cuota_s').val(0);
		}

		

}

});