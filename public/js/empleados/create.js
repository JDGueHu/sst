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
    
});