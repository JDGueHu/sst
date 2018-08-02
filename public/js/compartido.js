$( document ).ready(function() {

    // Se muestran las cantidades de errores en la pestaña
    $.fn.mostrarCantidadErroresPestana = function(nombre_pestaña, id_mostrar_error) {

        //Se consultan la cantidad de errores por pestaña
        var cantidad_errores = $('#'+nombre_pestaña+' .borde_error').length;

        if(cantidad_errores == 0)cantidad_errores = "";

        $('#'+id_mostrar_error).text(cantidad_errores);

        return cantidad_errores;

    }

    //Quitar classe y label de error en input al diligenciar datos
    $("input, select").change(function(){
        
        if($(this).hasClass("borde_error")){
            $(this).removeClass("borde_error");
            $('#'+'error_'+$(this).attr('id')).removeClass("mostrar_error_input"); 
        }

    });

});

// Se quita clase de error en los inputs donde se digiten datos
function quitarErrorInput(elemento){
    // $("#"+elemento.id).removeClass("borde_error");
    // $("#"+"error_"+elemento.id).removeClass("mostrar_error_input"); 
}