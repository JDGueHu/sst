$(document).ready(function() {    

    //// Calcular edad para vistas Show y Edit
    var hoy = new Date();
    var cumpleanos = new Date($("#fecha_nacimiento").val());
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var mes = hoy.getMonth() - cumpleanos.getMonth();

    if (mes < 0 || (mes  === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    $("#edad").text(edad);
    $("#edad").val(edad);
	

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
    
        if($('#direccion').val() == ''){
            $("#direccion").addClass("borde_error");
            $("#error_direccion").addClass("mostrar_error_input");
        }else{
            $("#direccion").removeClass("borde_error");
            $("#error_direccion").removeClass("mostrar_error_input"); 
        }  
    
        if($('#email_personal').val() == ''){
            $("#email_personal").addClass("borde_error");
            $("#error_email_personal").addClass("mostrar_error_input");
        }else{
            $("#email_personal").removeClass("borde_error");
            $("#error_email_personal").removeClass("mostrar_error_input"); 
        }  

        if($('#telefono_celular').val() == ''){
            $("#telefono_celular").addClass("borde_error");
            $("#error_telefono_celular").addClass("mostrar_error_input");
        }else{
            $("#telefono_celular").removeClass("borde_error");
            $("#error_telefono_celular").removeClass("mostrar_error_input"); 
        }  

        if($('#eps_id').val() == ''){
            $("#eps_id").addClass("borde_error");
            $("#error_eps_id").addClass("mostrar_error_input");
        }else{
            $("#eps_id").removeClass("borde_error");
            $("#error_eps_id").removeClass("mostrar_error_input"); 
        } 

        if($('#arl_id').val() == ''){
            $("#arl_id").addClass("borde_error");
            $("#error_arl_id").addClass("mostrar_error_input");
        }else{
            $("#arl_id").removeClass("borde_error");
            $("#error_arl_id").removeClass("mostrar_error_input"); 
        }

        if($('#fondo_cesantias_id').val() == ''){
            $("#fondo_cesantias_id").addClass("borde_error");
            $("#error_fondo_cesantias_id").addClass("mostrar_error_input");
        }else{
            $("#fondo_cesantias_id").removeClass("borde_error");
            $("#error_fondo_cesantias_id").removeClass("mostrar_error_input"); 
        }

        if($('#fondo_pensiones_id').val() == ''){
            $("#fondo_pensiones_id").addClass("borde_error");
            $("#error_fondo_pensiones_id").addClass("mostrar_error_input");
        }else{
            $("#fondo_pensiones_id").removeClass("borde_error");
            $("#error_fondo_pensiones_id").removeClass("mostrar_error_input"); 
        }
   
        if($('#area_id').val() == ''){
            $("#area_id").addClass("borde_error");
            $("#error_area_id").addClass("mostrar_error_input");
        }else{
            $("#area_id").removeClass("borde_error");
            $("#error_area_id").removeClass("mostrar_error_input"); 
        }

        if($('#centro_trabajo_id').val() == ''){
            $("#centro_trabajo_id").addClass("borde_error");
            $("#error_centro_trabajo_id").addClass("mostrar_error_input");
        }else{
            $("#centro_trabajo_id").removeClass("borde_error");
            $("#error_centro_trabajo_id").removeClass("mostrar_error_input"); 
        }

        if($('#cargo_id').val() == ''){
            $("#cargo_id").addClass("borde_error");
            $("#error_cargo_id").addClass("mostrar_error_input");
        }else{
            $("#cargo_id").removeClass("borde_error");
            $("#error_cargo_id").removeClass("mostrar_error_input"); 
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

/////  Google place autocompletar  /////

var autocomplete, autocomplete1, autocomplete2;
var componentForm = {
locality: 'long_name',
administrative_area_level_1: 'short_name',
country: 'long_name',
};

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('ciudad_nacimiento')),
        {types: ['geocode']});
    autocomplete1 = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('ciudad_direccion')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
    autocomplete1.addListener('place_changed', fillInAddress1);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        //var addressType = place.address_components[i].types[0];

        if (place.address_components[i].types[0] == 'locality') {          
            document.getElementById('ciudad_nacimiento').value = place.address_components[i].long_name;
        } else if (place.address_components[i].types[0] == 'administrative_area_level_1') {
            document.getElementById('departamento_nacimiento').value = place.address_components[i].long_name;
        } else if (place.address_components[i].types[0] == 'country') {
            document.getElementById('pais_nacimiento').value = place.address_components[i].long_name;
        }

    }
}

function fillInAddress1() {
    // Get the place details from the autocomplete object.
    var place = autocomplete1.getPlace();

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        //var addressType = place.address_components[i].types[0];

        if (place.address_components[i].types[0] == 'locality') {          
            document.getElementById('ciudad_direccion').value = place.address_components[i].long_name;
        } else if (place.address_components[i].types[0] == 'administrative_area_level_1') {
            document.getElementById('departamento_direccion').value = place.address_components[i].long_name;
        } else if (place.address_components[i].types[0] == 'country') {
            document.getElementById('pais_direccion').value = place.address_components[i].long_name;
        }

    }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
        autocomplete1.setBounds(circle.getBounds());
    });
    }
}