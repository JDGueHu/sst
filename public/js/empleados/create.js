$( document ).ready(function() {

	//// Calcular edad empleado al seleccionar la fecha de nacimiento
	$( "#fecha_nacimiento" ).change(function() {

	    var hoy = new Date();
	    var cumpleanos = new Date($("#fecha_nacimiento").val());
	    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
	    var mes = hoy.getMonth() - cumpleanos.getMonth();

	    if (mes < 0 || (mes  === 0 && hoy.getDate() < cumpleanos.getDate())) {
	        edad--;
	    }

	    $("#edad").val(edad);
	});
	
	//// Obtener nivel de riesgo por centro de trabajo
	$('#centro_trabajo_id').change(function() {
	
		if($("#centro_trabajo_id").val() != ""){
	  	  			
			$.ajax({
			  url: route('centros_trabajo.consultarAjax',{centro_trabajo_id: $("#centro_trabajo_id").val()}),
			  headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
			  type: 'GET',
			  datatype:'json'
			}).done(function(response){

				$("#nombre_riesgo_centro_trabajo").val(response[0].llave);
				$("#riesgo_centro_trabajo").val(response[0].valor);
				
				//Calcular riesgo total
				if($("#riesgo_cargo").val() == ""){				
					$("#riesgo_total").val(parseFloat(response[0].valor));
				}else{
					$("#riesgo_total").val(parseFloat(response[0].valor)+parseFloat($("#riesgo_cargo").val()));
				}		

			});
		}else{

			$("#nombre_riesgo_centro_trabajo").val('');
			$("#riesgo_centro_trabajo").val('');

			//Calcular riesgo total
			if($("#riesgo_cargo").val() == ""){$("#riesgo_total").val('');}
			else{$("#riesgo_total").val(parseFloat($("#riesgo_cargo").val()));}

		}

	});

	//// Obtener nivel de riesgo por cargo
	$('#cargo_id').change(function() {riesgo_total
	
		if($("#cargo_id").val() != ""){
	  	  			
			$.ajax({
			  url: route('cargos.consultarAjax',{cargo_id: $("#cargo_id").val()}),
			  headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
			  type: 'GET',
			  datatype:'json'
			}).done(function(response){

				$("#nombre_riesgo_cargo").val(response[0].llave);
				$("#riesgo_cargo").val(response[0].valor);	
					
				//Calcular riesgo total
				if($("#riesgo_centro_trabajo").val() == ""){				
					$("#riesgo_total").val(parseFloat(response[0].valor));
				}else{
					$("#riesgo_total").val(parseFloat(response[0].valor)+parseFloat($("#riesgo_centro_trabajo").val()));
				}	

			});

		}else{
			$("#nombre_riesgo_cargo").val('');
			$("#riesgo_cargo").val('');

			//Calcular riesgo total
			if($("#riesgo_centro_trabajo").val() == ""){$("#riesgo_total").val('');}
			else{$("#riesgo_total").val(parseFloat($("#riesgo_centro_trabajo").val()));}
			
		}

	});

    
});