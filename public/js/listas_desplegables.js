$(document).ready(function() {

    var t = $('#example').DataTable({
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No hay registros para mostrar",
            info: "Mostrando página _PAGE_ de _PAGES_ con _MAX_ registros",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(Filtrado de _MAX_ registros totales)",
            sSearch: "Buscar",
            buttons: {
                pageLength: {
                    _: "Mostrar %d registros",
                    '-1': "Mostrar todo"
                }
            },
            paginate: {
            first:      "Primera",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Última"
        	}
        },
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 registros', '25 registros', '50 registros', 'Mostrar todo' ]
        ],
        buttons: [
            'pageLength'
        ],
        order: [[ 1, "asc" ]],
        columns: [
            { "width": "30%" },
            { "width": "30%" },
            { "width": "15%" },
            { "width": "25%" }
          ],
        responsive: true
    });
    
    $.fn.capturarDatos = function() {

        var modulo = $('#modulo').val();
        var llave = $('#llave').val();
        var valor = $('#valor').val(); 
        var valor_por_defecto = $('#valor_por_defecto').prop( "checked" );
       
        var form_data = new FormData();
        form_data.append('modulo', modulo);
        form_data.append('llave', llave);
        form_data.append('valor', valor);
        form_data.append('valor_por_defecto', valor_por_defecto);

        return form_data;
    }

    $.fn.nombreModulo = function(modulo) {

        var nombre_singular;
        var nombre_con_preposicion_mayuscula;
        var nombre_con_preposicion_minuscula;

        switch (modulo) {
            case 'arl':
                nombre_singular = "ARL";
                nombre_con_preposicion_mayuscula = "La ARL ";    
                nombre_con_preposicion_minuscula = "la ARL ";             
                break;
            case 'eps':
                nombre_singular = "EPS";
                nombre_con_preposicion_mayuscula = "La EPS ";    
                nombre_con_preposicion_minuscula = "la EPS ";             
                break;
            case 'fondos_cesantias':
                nombre_singular = "Fondo de cesantías";
                nombre_con_preposicion_mayuscula = "El fondo de censatías ";    
                nombre_con_preposicion_minuscula = "el fondo de censatías ";             
                break;
            case 'fondos_pensiones':
                nombre_singular = "Fondo de penciones";
                nombre_con_preposicion_mayuscula = "El fondo de pensiones ";    
                nombre_con_preposicion_minuscula = "el fondo de pensiones ";             
                break;
            case 'tipos_identificacion':
                nombre_singular = "Tipo de identificación";
                nombre_con_preposicion_mayuscula = "El tipo de identificación ";    
                nombre_con_preposicion_minuscula = "el tipo de identificación ";             
                break;
            case 'generos':
                nombre_singular = "Género";
                nombre_con_preposicion_mayuscula = "El género ";    
                nombre_con_preposicion_minuscula = "el género ";             
                break;
            case 'grupos_sanguineos':
                nombre_singular = "Grupos sanguíneo";
                nombre_con_preposicion_mayuscula = "El grupo sanguíneo ";    
                nombre_con_preposicion_minuscula = "el grupo sanguíneo ";             
                break;
            case 'areas':
                nombre_singular = "Área";
                nombre_con_preposicion_mayuscula = "El área ";    
                nombre_con_preposicion_minuscula = "el área ";             
                break;
            case 'niveles_riesgo':
                nombre_singular = "Nivel de riesgo ";
                nombre_con_preposicion_mayuscula = "El nivel de riesgo ";    
                nombre_con_preposicion_minuscula = "el nivel de riesgo ";             
                break;
            case 'estados_civiles':
                nombre_singular = "Estado civil ";
                nombre_con_preposicion_mayuscula = "El estado civil ";    
                nombre_con_preposicion_minuscula = "el estado civil ";             
                break;
        }

        return [nombre_singular, nombre_con_preposicion_mayuscula, nombre_con_preposicion_minuscula];
    }

    // Valida si los inputs requeridos están vacios
    $.fn.validarInputsVacios = function(form_data) {

        if(form_data.get('llave') == ''){
            $("#llave").addClass("borde_error");
            $("#error_llave").addClass("mostrar_error_input");
        }else{
            $("#llave").removeClass("borde_error");
            $("#error_llave").removeClass("mostrar_error_input"); 
        }

        if(form_data.get('valor') == ''){
            $("#valor").addClass("borde_error");
            $("#error_valor").addClass("mostrar_error_input");
        }else{
            $("#valor").removeClass("borde_error");
            $("#error_valor").removeClass("mostrar_error_input");
        }

        if(form_data.get('llave') == '' || form_data.get('valor') == ''){
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

    //Función para validar el duplicado de llaves
    $.fn.validarRegistroDuplicado = function(form_data) {
        
        $.ajax({
            url: route('listas_desplegables.validarDuplicado'),
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
                    message: 'La llave <b>'+form_data.get('llave')+'</b> ya está en uso', 
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
          url: route('listas_desplegables.crearAjax'),
          headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
          type: 'POST',
          datatype:'json',
          contentType: false,
          cache: false,
          processData: false,
          data : form_data
        }).done(function(response){
           //console.log(response);
         
            var valor_por_defecto;

            //Rearma la tabla con base en los datos del nuevo registro
            response.forEach(function(element){

                if(element.valor_por_defecto == null){
                    valor_por_defecto= '<span class="badge badge-danger">No</span>';
                }
                else{
                    valor_por_defecto= '<span class="badge badge-success">Si</span>';
                }

                t.row.add( [
                    element.llave,
                    element.valor,
                    valor_por_defecto,
                    '<button id='+ element.id +' type="button" class="btn btn-outline-warning modificar" style="padding: 0px 3px; margin-right: 4px" title="Modificar" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button><button id='+ element.id +' type="button" class="btn btn-outline-danger borrar" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
                ] ).draw( false );

            });

            //Ocultar spinner
            $("#spiner").addClass("ocultar");

            $.notify({
                // options
                message: $.fn.nombreModulo(form_data.get('modulo'))[1]+'<b>'+form_data.get('llave')+'</b> se creó exitosamente', 
            },{
                // settings
                type: 'success',
                delay:3000,
                placement: {
                    from: "bottom",
                    align: "right"
                }
            });

            $("#llave").val("");
            $("#valor").val("");
            $('#valor_por_defecto').prop('checked', false);

        });   
    }

    // Función para agregar datos a los inputs para modificar un registro seleccionado
    $('#example tbody').on( 'click', '.modificar', function () {
        
        var id = $(this).attr('id');
        var modulo = $('#modulo').val();

        // Ubicar los datos en los inputs
        $.ajax({
            url: route('listas_desplegables.consultarAjax',{modulo: modulo, id: id}),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'GET',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
          }).done(function(response){
              //console.log(response);
              
            $('#llave').prop('readonly', true);
            $("#llave").val(response.llave);              
            $("#valor").val(response.valor);

            if(response.valor_por_defecto == null){
                $('#valor_por_defecto').prop('checked', false);
            }else{
                $('#valor_por_defecto').prop('checked', true);
            }

            $("#agregar").addClass("ocultar");
            $("#modificar").addClass("mostrar");
            $("#reset_botones").addClass("mostrar");
        });

    });

    // Resetear datos en inputs y botones de modificación
    $('#reset_botones').on( 'click', function () {

        $('#llave').prop('readonly', false);
        $("#llave").val("");              
        $("#valor").val("");  
        $('#valor_por_defecto').prop('checked', false);


        $("#agregar").removeClass("ocultar");
        $("#modificar").removeClass("mostrar");
        $("#reset_botones").removeClass("mostrar");

    });

    // Modificación de un registro
    $('#modificar').on( 'click', function () {

        // Mostrar spiner
        $("#spiner").removeClass("ocultar");

        //Para limpiar tabla y luego actualizar con todos los datos
        t.clear().draw();     

        var form_data = $.fn.capturarDatos();

        $.ajax({
            url: route('listas_desplegables.editarAjax'),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
            data : form_data
          }).done(function(response){
            //console.log(response);

            var valor_por_defecto;

            response.forEach(function(element){

                if(element.valor_por_defecto == null){
                    valor_por_defecto= '<span class="badge badge-danger">No</span>';
                }
                else{
                    valor_por_defecto= '<span class="badge badge-success">Si</span>';
                }

                t.row.add( [
                    element.llave,
                    element.valor,
                    valor_por_defecto,
                    '<button id='+ element.id +' type="button" class="btn btn-outline-warning modificar" style="padding: 0px 3px; margin-right: 4px" title="Modificar" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button><button id='+ element.id +' type="button" class="btn btn-outline-danger borrar" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
                ] ).draw( false );

            });

            //Ocultar spinner
            $("#spiner").addClass("ocultar");

            $.notify({
                // options
                message: $.fn.nombreModulo(form_data.get('modulo'))[1]+'<b>'+form_data.get('llave')+'</b> se modificó exitosamente', 
            },{
                // settings
                type: 'warning',
                delay:3000,
                placement: {
                    from: "bottom",
                    align: "right"
                }
            });

            $('#llave').prop('readonly', false);
            $("#llave").val("");
            $("#valor").val("");
            $('#valor_por_defecto').prop('checked', false);

            $("#agregar").removeClass("ocultar");
            $("#modificar").removeClass("mostrar");
            $("#reset_botones").removeClass("mostrar");
            
        });

    });

    // Borrar un registro    
    $('#example tbody').on( 'click', '.borrar', function () {

        // Mostrar spiner
        $("#spiner").removeClass("ocultar");

        var form_data = $.fn.capturarDatos();

        var id = $(this).attr('id');
        var llave = $(this).parents('tr').children().eq(1).text();

        if ( $(this).parents('tr').hasClass('eliminar') ) {
            $(this).parents('tr').removeClass('eliminar');
        }
        else {
            t.$('tr.eliminar').removeClass('eliminar');
            $(this).parents('tr').addClass('eliminar');
        }  

        $.confirm({
		    title: 'Eliminar '+$.fn.nombreModulo(form_data.get('modulo'))[0],
		    content: '' +
		    '<form action="" class="formName">' +
		    '<div class="form-group">' +
		    '<label>Va a eliminar '+$.fn.nombreModulo(form_data.get('modulo'))[2]+' <b>'+llave+'</b> ¿Desea continuar? </label>' +
		    '</div>' +
		    '</form>',
		    buttons: {
		        formSubmit: {
		            text: 'Continuar',
		            btnClass: 'btn-blue',
		            action: function () {

		                $.ajax({
						  url: route('listas_desplegables.eliminarAjax',{modulo: form_data.get('modulo'),id: id}),
						  headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
						  type: 'GET',
				  		  datatype:'json',
				          contentType: false,
				          cache: false,
						  processData: false,
						}).done(function(){
                            //console.log();

                            t.row('.eliminar').remove().draw( false );

                            $.notify({
                                // options
                                message: 'Se ha eliminado '+$.fn.nombreModulo(form_data.get('modulo'))[2]+' <b>'+ llave +'</b> exitosamente', 
                            },{
                                // settings
                                type: 'danger',
                                delay:3000,
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                }
                            });

						}).fail(function(response){ // Error en la petición
                            
                            $.notify({
                                // options
                                message: 'Se ha generado un error, por favor comuníquese con el administrador del sistema', 
                            },{
                                // settings
                                type: 'danger',
                                delay:3000,
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                }
                            });

                        });
                    
                    //Ocultar spinner
                    $("#spiner").addClass("ocultar");

		            }
		        },
		        Cancelar: function () {
		            //close
		        },
		    },
		    onContentReady: function () {
		        // bind to events
		        var jc = this;
		        this.$content.find('form').on('submit', function (e) {
		            // if the user submits the form by pressing enter in the field.
		            e.preventDefault();
		            jc.$$formSubmit.trigger('click'); // reference the button and click it
		        });
		    }	    
		});      

    });

});

