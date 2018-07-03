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
        columns: [
            { "width": "30%" },
            { "width": "30%" },
            { "width": "15%" },
            { "width": "25%" }
          ],
        pageLength: 8,
        responsive: true
    });

    $.fn.capturarDatos = function() {

        var llave = $('#llave').val();
        var valor = $('#valor').val(); 
        var valor_por_defecto = $('#valor_por_defecto').prop( "checked" );
       
        var form_data = new FormData();
        form_data.append('llave', llave);
        form_data.append('valor', valor);
        form_data.append('valor_por_defecto', valor_por_defecto);

        return form_data;
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

    ////////////////// ARL

    // Activación de funcionalidades para agregar una ARL
    $('#agregar_arl').on( 'click', function () { 
       
        var form_data = $.fn.capturarDatos();
        
        //Validar inputs vacios
        if(!$.fn.validarInputsVacios(form_data)){

            //Validar duplicado de llaves
            $.fn.validarDuplicadoArl(form_data);   
    
        }

    });

    //Función para validar el duplicado de llaves arl
    $.fn.validarDuplicadoArl = function(form_data) {
        
        $.ajax({
            url: route('arls.validarDuplicado'),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
            data : form_data
        }).done(function(response){
            
            if(response == 0){

                $.fn.crearArl(form_data);

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

    // Función para crear la nueva ARL
    $.fn.crearArl = function(form_data) {

        // Mostrar spiner
        $("#spiner").removeClass("ocultar");

        //Para limpiar tabla y luego actualizar con todos los datos
        t.clear().draw();

        $.ajax({
          url: route('arls.crearAjax'),
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
                    '<button id='+ element.id +' type="button" class="btn btn-outline-warning modificar_arl" style="padding: 0px 3px; margin-right: 4px" title="Modificar" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button><button id='+ element.id +' type="button" class="btn btn-outline-danger borrar_arl" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
                ] ).draw( false );

            });

            //Ocultar spinner
            $("#spiner").addClass("ocultar");

            $.notify({
                // options
                message: 'La ARL <b>'+form_data.get('valor')+'</b> se creó exitosamente', 
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

    // Función para agregar datos a los inputs para modificar una ARL seleccionada
    $('#example tbody').on( 'click', '.modificar_arl', function () {
        
        var id = $(this).attr('id');

        // Ubicar los datos en los inputs
        $.ajax({
            url: route('arls.consultarAjax',{id: id}),
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

            $("#agregar_arl").addClass("ocultar");
            $("#modificar_arl").addClass("mostrar");
            $("#reset_botones_arl").addClass("mostrar");
        });

    });

    // Resetear datos en inputs y botones de modificación
    $('#reset_botones_arl').on( 'click', function () {

        $('#llave').prop('readonly', false);
        $("#llave").val("");              
        $("#valor").val("");  
        $('#valor_por_defecto').prop('checked', false);


        $("#agregar_arl").removeClass("ocultar");
        $("#modificar_arl").removeClass("mostrar");
        $("#reset_botones_arl").removeClass("mostrar");

    });

    // Modificación de ARL
    $('#modificar_arl').on( 'click', function () {

        // Mostrar spiner
        $("#spiner").removeClass("ocultar");

        //Para limpiar tabla y luego actualizar con todos los datos
        t.clear().draw();     

        var form_data = $.fn.capturarDatos();

        $.ajax({
            url: route('arls.editarAjax'),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
            data : form_data
          }).done(function(response){
            console.log(response);

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
                    '<button id='+ element.id +' type="button" class="btn btn-outline-warning modificar_arl" style="padding: 0px 3px; margin-right: 4px" title="Modificar" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button><button id='+ element.id +' type="button" class="btn btn-outline-danger borrar_arl" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
                ] ).draw( false );

            });

            //Ocultar spinner
            $("#spiner").addClass("ocultar");

            $.notify({
                // options
                message: 'La ARL <b>'+form_data.get('valor')+'</b> se modificó exitosamente', 
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

            $("#agregar_arl").removeClass("ocultar");
            $("#modificar_arl").removeClass("mostrar");
            $("#reset_botones").removeClass("mostrar");
            
        });

    });

    // Eliminación de ARL    
    $('#example tbody').on( 'click', '.borrar_arl', function () {

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
		    title: 'Eliminar ARL',
		    content: '' +
		    '<form action="" class="formName">' +
		    '<div class="form-group">' +
		    '<label>Va a eliminar la ARL <b>'+llave+'</b> ¿Desea continuar? </label>' +
		    '</div>' +
		    '</form>',
		    buttons: {
		        formSubmit: {
		            text: 'Continuar',
		            btnClass: 'btn-blue',
		            action: function () {

		                $.ajax({
						  url: route('arls.eliminarAjax',{id: id}),
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
                                message: 'Se ha eliminado la ARL <b>'+ llave +'</b> exitosamente', 
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

    ////////////////// EPS

    // Activación de funcionalidades para agregar una ARL
    $('#boton_agregar_eps').on( 'click', function () {

        var form_data = $.fn.capturarDatos();
        
        //Validar inputs vacios
        if(!$.fn.validarInputsVacios(form_data)){

            //Validar duplicado de llaves
            $.fn.validarDuplicadoEps(form_data);   

        }

    }); 

    //Función para validar el duplicado de llaves eps
    $.fn.validarDuplicadoEps = function(form_data) {

        $.ajax({
            url: route('epss.validarDuplicado'),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
            data : form_data
        }).done(function(response){
  
            if(response == 0){

                $.fn.crearEps(form_data);

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

    // Función para crear la nueva EPS
    $.fn.crearEps = function(form_data) {

        // Mostrar spiner
        $("#spiner").removeClass("ocultar");

        //Para limpiar tabla y luego actualizar con todos los datos
        t.clear().draw(); 

        $.ajax({
          url: route('epss.crearAjax'),
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
                   '<button id='+ element.id +' type="button" class="btn btn-outline-warning modificar_eps" style="padding: 0px 3px; margin-right: 4px" title="Modificar" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button><button id='+ element.id +' type="button" class="btn btn-outline-danger borrar_eps" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
               ] ).draw( false );

           });

            //Ocultar spinner
            $("#spiner").addClass("ocultar");

           $.notify({
               // options
               message: 'La EPS <b>'+form_data.get('valor')+'</b> se creó exitosamente', 
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

    // Función para agregar datos a los inputs para modificar una EPS seleccionada
    $('#example tbody').on( 'click', '.modificar_eps', function () {
    
        var id = $(this).attr('id');

        // Ubicar los datos en los inputs
        $.ajax({
            url: route('epss.consultarAjax',{id: id}),
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

            $("#boton_agregar_eps").addClass("ocultar");
            $("#boton_modificar_eps").addClass("mostrar");
            $("#reset_botones_eps").addClass("mostrar");
        });

    });

    // Resetear datos en inputs y botones de modificación
    $('#reset_botones_eps').on( 'click', function () {

        $('#llave').prop('readonly', false);
        $("#llave").val("");              
        $("#valor").val("");  
        $('#valor_por_defecto').prop('checked', false);


        $("#boton_agregar_eps").removeClass("ocultar");
        $("#boton_modificar_eps").removeClass("mostrar");
        $("#reset_botones_eps").removeClass("mostrar");

    });

    // Modificación de una EPS
    $('#boton_modificar_eps').on( 'click', function () {

        // Mostrar spiner
        $("#spiner").removeClass("ocultar");

        //Para limpiar tabla y luego actualizar con todos los datos
        t.clear().draw();     

        var form_data = $.fn.capturarDatos();

        $.ajax({
            url: route('epss.editarAjax'),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
            data : form_data
          }).done(function(response){
            console.log(response);

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
                    '<button id='+ element.id +' type="button" class="btn btn-outline-warning modificar_eps" style="padding: 0px 3px; margin-right: 4px" title="Modificar" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button><button id='+ element.id +' type="button" class="btn btn-outline-danger borrar_eps" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
                ] ).draw( false );

            });

            //Ocultar spinner
            $("#spiner").addClass("ocultar");

            $.notify({
                // options
                message: 'La EPS <b>'+form_data.get('valor')+'</b> se modificó exitosamente', 
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

            $("#boton_agregar_eps").removeClass("ocultar");
            $("#boton_modificar_eps").removeClass("mostrar");
            $("#reset_botones_eps").removeClass("mostrar");
            
        });

    });

    // Eliminación de EPS    
    $('#example tbody').on( 'click', '.borrar_eps', function () {

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
		    title: 'Eliminar EPS',
		    content: '' +
		    '<form action="" class="formName">' +
		    '<div class="form-group">' +
		    '<label>Va a eliminar la EPS <b>'+llave+'</b> ¿Desea continuar? </label>' +
		    '</div>' +
		    '</form>',
		    buttons: {
		        formSubmit: {
		            text: 'Continuar',
		            btnClass: 'btn-blue',
		            action: function () {

		                $.ajax({
						  url: route('epss.eliminarAjax',{id: id}),
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
                                message: 'Se ha eliminado la EPS <b>'+ llave +'</b> exitosamente', 
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
    } );

    ////////////////// Fondos de cesantías

    // Activación de funcionalidades para agregar un fondo de cesantías
    $('#boton_agregar_fondos_cesantias').on( 'click', function () {
        
        var form_data = $.fn.capturarDatos();
       
        //Validar inputs vacios
        if(!$.fn.validarInputsVacios(form_data)){
            
            //Validar duplicado de llaves
            $.fn.validarDuplicadoFondoCesantias(form_data);   
    
        }

    });

    //Función para validar el duplicado de llaves fondo de cesantias
    $.fn.validarDuplicadoFondoCesantias = function(form_data) {
 
        $.ajax({
            url: route('fondos_cesantias.validarDuplicado'),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
            data : form_data
        }).done(function(response){

            if(response == 0){
                
                $.fn.crearFondoCesantias(form_data);

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

    // Función para crear la nuevo fonde de cesantías
    $.fn.crearFondoCesantias = function(form_data) {
        
        // Mostrar spiner
        $("#spiner").removeClass("ocultar");

        //Para limpiar tabla y luego actualizar con todos los datos
        t.clear().draw();     

        $.ajax({
          url: route('fondos_cesantias.crearAjax'),
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
                   '<button id='+ element.id +' type="button" class="btn btn-outline-warning modificar_fondo_cesantia" style="padding: 0px 3px; margin-right: 4px" title="Modificar" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button><button id='+ element.id +' type="button" class="btn btn-outline-danger borrar_fondo_cesantia" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
               ] ).draw( false );

           });

            //Ocultar spinner
            $("#spiner").addClass("ocultar");

           $.notify({
               // options
               message: 'El fondo de cesantías <b>'+form_data.get('valor')+'</b> se creó exitosamente', 
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

    // Función para agregar datos a los inputs para modificar un fonde de cesantias seleccionado
    $('#example tbody').on( 'click', '.modificar_fondo_cesantia', function () {
    
        var id = $(this).attr('id');

        // Ubicar los datos en los inputs
        $.ajax({
            url: route('fondos_cesantias.consultarAjax',{id: id}),
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

            $("#boton_agregar_fondos_cesantias").addClass("ocultar");
            $("#modificar_fondos_cesantias").addClass("mostrar");
            $("#reset_botones_fondos_cesantias").addClass("mostrar");
        });

    });

    // Resetear datos en inputs y botones de modificación
    $('#reset_botones_fondos_cesantias').on( 'click', function () {

        $('#llave').prop('readonly', false);
        $("#llave").val("");              
        $("#valor").val("");  
        $('#valor_por_defecto').prop('checked', false);


        $("#boton_agregar_fondos_cesantias").removeClass("ocultar");
        $("#modificar_fondos_cesantias").removeClass("mostrar");
        $("#reset_botones_fondos_cesantias").removeClass("mostrar");

    });

    // Modificación de un fondo de cesantías
    $('#modificar_fondos_cesantias').on( 'click', function () {

        // Mostrar spiner
        $("#spiner").removeClass("ocultar");

        //Para limpiar tabla y luego actualizar con todos los datos
        t.clear().draw();     

        var form_data = $.fn.capturarDatos();

        $.ajax({
            url: route('fondos_cesantias.editarAjax'),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
            data : form_data
          }).done(function(response){
            console.log(response);

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
                    '<button id='+ element.id +' type="button" class="btn btn-outline-warning modificar_fondo_cesantia" style="padding: 0px 3px; margin-right: 4px" title="Modificar" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></button><button id='+ element.id +' type="button" class="btn btn-outline-danger borrar_fondo_cesantia" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
                ] ).draw( false );

            });

            //Ocultar spinner
            $("#spiner").addClass("ocultar");

            $.notify({
                // options
                message: 'La EPS <b>'+form_data.get('valor')+'</b> se modificó exitosamente', 
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

            $("#boton_agregar_fondos_cesantias").removeClass("ocultar");
            $("#modificar_fondos_cesantias").removeClass("mostrar");
            $("#reset_botones_fondos_cesantias").removeClass("mostrar");
            
        });

    });

    // Eliminación de fondo de cesantías    
    $('#example tbody').on( 'click', '.borrar_fondo_cesantia', function () {

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
		    title: 'Eliminar fondo de cesantías',
		    content: '' +
		    '<form action="" class="formName">' +
		    '<div class="form-group">' +
		    '<label>Va a eliminar el fondo de cesantías <b>'+llave+'</b> ¿Desea continuar? </label>' +
		    '</div>' +
		    '</form>',
		    buttons: {
		        formSubmit: {
		            text: 'Continuar',
		            btnClass: 'btn-blue',
		            action: function () {

		                $.ajax({
						  url: route('fondos_cesantias.eliminarAjax',{id: id}),
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
                                message: 'Se ha eliminado el fondo de cesantías <b>'+ llave +'</b> exitosamente', 
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
    } );

    ////////////////// Fondos de pensiones

    // Activación de funcionalidades para agregar un fondo de cesantías
    $('#boton_agregar_fondos_pensiones').on( 'click', function () {
        
        var llave = $('#llave').val();
        var valor = $('#valor').val(); 

        var form_data = new FormData();
        form_data.append('llave', llave);
        form_data.append('valor', valor);
        
        //Validar inputs vacios
        if(!$.fn.validarInputsVacios(form_data)){

            //Validar duplicado de llaves
            $.fn.validarDuplicadoFondoPensiones(form_data);   
    
        }

    });

    //Función para validar el duplicado de llaves fondos de pensiones
    $.fn.validarDuplicadoFondoPensiones = function(form_data) {

        $.ajax({
            url: route('fondos_pensiones.validarDuplicado'),
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: 'POST',
            datatype:'json',
            contentType: false,
            cache: false,
            processData: false,
            data : form_data
        }).done(function(response){
            
            if(response == 0){

                $.fn.crearFondoPensiones(form_data);

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

    // Función para crear la nuevo fonde de pensiones
    $.fn.crearFondoPensiones = function(form_data) {

        $.ajax({
          url: route('fondos_pensiones.crearAjax'),
          headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
          type: 'POST',
          datatype:'json',
          contentType: false,
          cache: false,
          processData: false,
          data : form_data
        }).done(function(response){
           //console.log(response);

           if(response != null){

                t.row.add( [
                    response.llave,
                    response.valor,
                    '<button id="'+ response.id +'" type="button" class="btn btn-outline-danger borrar_fondo_pension" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
                ] ).draw( false );

                $.notify({
                    // options
                    message: 'El fondo de pensiones <b>'+form_data.get('valor')+'</b> se creó exitosamente', 
                },{
                    // settings
                    type: 'success',
                    delay:3000,
                    placement: {
                        from: "bottom",
                        align: "right"
                    }
                });

            }else{

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
            }

            $("#llave").val("");
            $("#valor").val("");

        });   
    }

    // Eliminación de fondo de cesantías    
    $('#example tbody').on( 'click', '.borrar_fondo_pension', function () {

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
		    title: 'Eliminar fondo de pensiones',
		    content: '' +
		    '<form action="" class="formName">' +
		    '<div class="form-group">' +
		    '<label>Va a eliminar el fondo de pensiones <b>'+llave+'</b> ¿Desea continuar? </label>' +
		    '</div>' +
		    '</form>',
		    buttons: {
		        formSubmit: {
		            text: 'Continuar',
		            btnClass: 'btn-blue',
		            action: function () {

		                $.ajax({
						  url: route('fondos_pensiones.eliminarAjax',{id: id}),
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
                                message: 'Se ha eliminado el fondo de pensiones <b>'+ llave +'</b> exitosamente', 
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
    } );

} );

