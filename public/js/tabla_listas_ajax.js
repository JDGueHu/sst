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
        pageLength: 8,
        responsive: true
    });

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
    $('#boton_agregar_alr').on( 'click', function () {
        
        var llave = $('#llave').val();
        var valor = $('#valor').val(); 

        var form_data = new FormData();
        form_data.append('llave', llave);
        form_data.append('valor', valor);
        
        //Validar inputs vacios
        if(!$.fn.validarInputsVacios(form_data)){

            //Validar duplicado de llaves
            $.fn.validarDuplicadoArl(form_data);   
    
        }

    });

    //Función para validar el duplicado de llaves
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

                $.fn.crearARL(form_data);

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
    $.fn.crearARL = function(form_data) {

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

           if(response != null){

                t.row.add( [
                    response.llave+'<span style="opacity:0">-'+response.id+'</span>',
                    response.valor,
                    '<button id="borrar_arl" type="button" class="btn btn-outline-danger" style="padding: 0px 3px; margin-right: 4px" title="Eliminar" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>'
                ] ).draw( false );

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

    // Eliminación de ARL    
    $('#example tbody').on( 'click', '#borrar_arl', function () {

        var cadena = $(this).parents('tr').children().eq(0).text();
        var llave = $(this).parents('tr').children().eq(1).text();
        var array = cadena.split("-");

        if ( $(this).parents('tr').hasClass('eliminar') ) {
            $(this).parents('tr').removeClass('eliminar');
        }
        else {
            t.$('tr.eliminar').removeClass('eliminar');
            $(this).parents('tr').addClass('eliminar');
        }  

        $.confirm({
		    title: 'Eliminar ARL<',
		    content: '' +
		    '<form action="" class="formName">' +
		    '<div class="form-group">' +
		    '<label>Va a eliminar la ARL <b>'+llave+'</b> ¿Desea continuar? </label>' +
		    '</div>' +
		    '</form>',
		    buttons: {
		        formSubmit: {
		            text: 'Eliminar',
		            btnClass: 'btn-blue',
		            action: function () {

		                $.ajax({
						  url: route('arls.eliminarAjax',{id: array[1]}),
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
                                message: 'Se ha eliminado la ARL <b>'+ llave +' exitosamente', 
                            },{
                                // settings
                                type: 'success',
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

        // if (validate == true) {
        //     if ( $(this).parents('tr').hasClass('eliminar') ) {
        //         $(this).parents('tr').removeClass('eliminar');
        //     }
        //     else {
        //         t.$('tr.eliminar').removeClass('eliminar');
        //         $(this).parents('tr').addClass('eliminar');
        //     }   



        //     $.ajax({
        //           url: '../../administracion/vacaciones/'+array[1]+'/destroyAjax',
        //           type: 'GET'
        //         }).done(function(response){
        //             //console.log(response);
        //           t.row('.eliminar').remove().draw( false );
        //         });
        // }

    });

} );

