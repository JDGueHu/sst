$(document).ready(function() {    

    //// Restringir la seleccion de fecha hasta la fecha actual en Empleados ////
	// var today = new Date();
	// var dd = today.getDate();
	// var mm = today.getMonth()+1; //January is 0!
	// var yyyy = today.getFullYear();
	//  if(dd<10){
	//         dd='0'+dd
	//     } 
	//     if(mm<10){
	//         mm='0'+mm
	//     } 

    // today = dd+'/'+mm+'/'+yyyy;
    // $('#fecha_nacimiento').val(today)
	

    //////////////////////////////////////////////////////////////////////
    
    // Activación del botón guardar
    $('.guardar').on( 'click', function () { 
       
        //Función para validar inputs
        $.fn.validarInputs()

    });
    
    // Validación de inputs
    $.fn.validarInputs = function() {

        // Pestaña 1

        if($('#tipo_identificacion_id').val() == ''){
            $("#tipo_identificacion_id").addClass("borde_error");
            $("#error_tipo_identificacion_id").addClass("mostrar_error_input");
        }else{
            $("#tipo_identificacion_id").removeClass("borde_error");
            $("#error_tipo_identificacion_id").removeClass("mostrar_error_input"); 
        }

        if($('#identificacion').val() == ''){
            $("#identificacion").addClass("borde_error");
            $("#error_identificacion").addClass("mostrar_error_input");
        }else{
            $("#identificacion").removeClass("borde_error");
            $("#error_identificacion").removeClass("mostrar_error_input"); 
        }    

        if($('#nombres').val() == ''){
            $("#nombres").addClass("borde_error");
            $("#error_nombres").addClass("mostrar_error_input");
        }else{
            $("#nombres").removeClass("borde_error");
            $("#error_nombres").removeClass("mostrar_error_input"); 
        } 

        if($('#apellidos').val() == ''){
            $("#apellidos").addClass("borde_error");
            $("#error_apellidos").addClass("mostrar_error_input");
        }else{
            $("#apellidos").removeClass("borde_error");
            $("#error_apellidos").removeClass("mostrar_error_input"); 
        } 

        if($('#genero_id').val() == ''){
            $("#genero_id").addClass("borde_error");
            $("#error_genero_id").addClass("mostrar_error_input");
        }else{
            $("#genero_id").removeClass("borde_error");
            $("#error_genero_id").removeClass("mostrar_error_input"); 
        } 

        if($('#grupo_sanguineo_id').val() == ''){
            $("#grupo_sanguineo_id").addClass("borde_error");
            $("#error_grupo_sanguineo_id").addClass("mostrar_error_input");
        }else{
            $("#grupo_sanguineo_id").removeClass("borde_error");
            $("#error_grupo_sanguineo_id").removeClass("mostrar_error_input"); 
        }

        if($('#fecha_nacimiento').val() == ''){
            $("#fecha_nacimiento").addClass("borde_error");
            $("#error_fecha_nacimiento").addClass("mostrar_error_input");
        }else{
            $("#fecha_nacimiento").removeClass("borde_error");
            $("#error_fecha_nacimiento").removeClass("mostrar_error_input"); 
        }

        if($('#ciudad_nacimiento').val() == ''){
            $("#ciudad_nacimiento").addClass("borde_error");
            $("#error_ciudad_nacimiento").addClass("mostrar_error_input");
        }else{
            $("#ciudad_nacimiento").removeClass("borde_error");
            $("#error_ciudad_nacimiento").removeClass("mostrar_error_input"); 
        }

        if($('#estado_civil_id').val() == ''){
            $("#estado_civil_id").addClass("borde_error");
            $("#error_estado_civil_id").addClass("mostrar_error_input");
        }else{
            $("#estado_civil_id").removeClass("borde_error");
            $("#error_estado_civil_id").removeClass("mostrar_error_input"); 
        }

        //Pestaña 2
        if($('#ciudad_direccion').val() == ''){
            $("#ciudad_direccion").addClass("borde_error");
            $("#error_ciudad_direccion").addClass("mostrar_error_input");
        }else{
            $("#ciudad_direccion").removeClass("borde_error");
            $("#error_ciudad_direccion").removeClass("mostrar_error_input"); 
        }  
        
        var error = 0;

        // Se envia la pestaña y el id del lugar donde mostrar el número de errores, se ejecuta por cada pestaña
        error = error + $.fn.mostrarCantidadErroresPestana('nav-home', 'error_nav-tab');
        error = error + $.fn.mostrarCantidadErroresPestana('nav-profile', 'error_nav-profile');
        error = error + $.fn.mostrarCantidadErroresPestana('nav-contact', 'error_nav-contact');

        if(error == 0){
            $("#example_form").submit();
        }
        


    }

});