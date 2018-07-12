$(document).ready(function() {

    var t = $('#example').DataTable({
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No hay registros para mostrar",
            info: "Mostrando página _PAGE_ de _PAGES_ con _MAX_ registros",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(Filtrado de _MAX_ registros totales)",
            sSearch: "Buscar",
            paginate: {
            first:      "Primera",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Última"
        	}
        },
        order: [[ 1, "asc" ]],
        columns: [
            { "width": "20%" },
            { "width": "20%" },
            { "width": "20%" },
            { "width": "15%" },
            { "width": "25%" }
          ],
        pageLength: 9,
        responsive: true
    });

    $.fn.capturarDatos = function() {

        var modulo = $('#modulo').val();
        var codigo = $('#codigo').val();
        var nombre = $('#nombre').val(); 
        var nivel_riesgo_id = $('#nivel_riesgo_id').val(); 
       
        var form_data = new FormData();
        form_data.append('modulo', modulo);
        form_data.append('codigo', codigo);
        form_data.append('nombre', nombre);
        form_data.append('nivel_riesgo_id', nivel_riesgo_id);

        return form_data;
    }

    $.fn.nombreModulo = function(modulo) {

        var nombre_singular;
        var nombre_con_preposicion_mayuscula;
        var nombre_con_preposicion_minuscula;

        switch (modulo) {
            case 'centros_trabajo':
                nombre_singular = "Centro de trabajo ";
                nombre_con_preposicion_mayuscula = "El centro de trabajo ";    
                nombre_con_preposicion_minuscula = "el centro de trabajo ";             
                break;
            case 'cargos':
                nombre_singular = "Cargo";
                nombre_con_preposicion_mayuscula = "El cargo ";    
                nombre_con_preposicion_minuscula = "el cargo ";             
                break;
        }

        return [nombre_singular, nombre_con_preposicion_mayuscula, nombre_con_preposicion_minuscula];
    }

    // Valida si los inputs requeridos están vacios
    $.fn.validarInputsVacios = function(form_data) {

        if(form_data.get('codigo') == ''){
            $("#codigo").addClass("borde_error");
            $("#error_codigo").addClass("mostrar_error_input");
        }else{
            $("#codigo").removeClass("borde_error");
            $("#error_codigo").removeClass("mostrar_error_input"); 
        }

        if(form_data.get('nombre') == ''){
            $("#nombre").addClass("borde_error");
            $("#error_nombre").addClass("mostrar_error_input");
        }else{
            $("#nombre").removeClass("borde_error");
            $("#error_nombre").removeClass("mostrar_error_input");
        }

        if(form_data.get('codigo') == '' || form_data.get('nombre') == ''){
            return true;
        }
        else{
            return false;
        }

    }

    // Activación de funcionalidades para agregar un registro
    $('#agregar').on( 'click', function () { 
       
        var form_data = $.fn.capturarDatos();
        
        //Validar inputs vacios
        if(!$.fn.validarInputsVacios(form_data)){

            //Validar duplicado de llaves
            $.fn.validarRegistroDuplicado(form_data);   
    
        }

    });

    //Función para validar el duplicado de códigos
    $.fn.validarRegistroDuplicado = function(form_data) {
        
        $.ajax({
            url: route('centros_trabajo.validarDuplicado'),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
            data : form_data
        }).done(function(response){
            
            if(response == 0){

                $.fn.crearRegistro(form_data);

            }else{

                $.notify({
                    // options
                    message: 'El código <b>'+form_data.get('codigo')+'</b> ya está en uso', 
                },{
                    // settings
                    type: 'danger',
                    delay:3000,
                    placement: {
                        from: "bottom",
                        align: "right"
                    }
                });
            }
        });    
    }

    // Función para un nuevo registro
    $.fn.crearRegistro = function(form_data) {

        // Mostrar spiner
        $("#spiner").removeClass("ocultar");

        //Para limpiar tabla y luego actualizar con todos los datos
        t.clear().draw();

        $.ajax({
          url: route('centros_trabajo.crearAjax'),
          headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
          type: 'POST',
          datatype:'json',
          contentType: false,
          cache: false,
          processData: false,
          data : form_data
        }).done(function(response){
           //console.log(response);

           var activo;

            //Rearma la tabla con base en los datos del nuevo registro
            response.forEach(function(element){

                if(!element.activo){
                    activo= '<span class="badge badge-danger">No</span>';
                }
                else{
                    activo= '<span class="badge badge-success">Si</span>';
                }

                t.row.add( [
                    element.codigo,
                    element.nombre,
                    (element.llave != null || element.valor != null) ? element.llave+' - '+element.valor : '',
                    activo,
                    '<button id='+ element.id +' type="button" class="btn btn-outline-warning modificar" style="padding: 0px 3px; margin-right: 4px" title="Modificar" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button><button id='+ element.id +' type="button" class="btn btn-outline-danger borrar" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
                ] ).draw( false );

            });

            //Ocultar spinner
            $("#spiner").addClass("ocultar");

            $.notify({
                // options
                message: $.fn.nombreModulo(form_data.get('modulo'))[1]+'<b>'+form_data.get('codigo')+'</b> se creó exitosamente', 
            },{
                // settings
                type: 'success',
                delay:3000,
                placement: {
                    from: "bottom",
                    align: "right"
                }
            });

            $("#codigo").val("");
            $("#nombre").val("");
            $("#nivel_riesgo_id").val("");

        });   
    }

    // Función para agregar datos a los inputs para modificar un registro seleccionado
    $('#example tbody').on( 'click', '.modificar', function () {
        
        var id = $(this).attr('id');
        var modulo = $('#modulo').val();

        // Ubicar los datos en los inputs
        $.ajax({
            url: route('centros_trabajo.consultarAjax',{modulo: modulo, id: id}),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'GET',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
          }).done(function(response){
              console.log(response);
              
            $('#codigo').prop('readonly', true);
            $("#codigo").val(response.codigo);              
            $("#nombre").val(response.nombre);
            $("#nivel_riesgo_id").val(response.nivel_riesgo_id);


            $("#agregar").addClass("ocultar");
            $("#modificar").addClass("mostrar");
            $("#reset_botones").addClass("mostrar");
        });

    });

    // Resetear datos en inputs y botones de modificación
    $('#reset_botones').on( 'click', function () {

        $('#codigo').prop('readonly', false);
        $("#codigo").val("");              
        $("#nombre").val("");  
        $('#nivel_riesgo_id').val("");


        $("#agregar").removeClass("ocultar");
        $("#modificar").removeClass("mostrar");
        $("#reset_botones").removeClass("mostrar");

    });

});