var url 	= 'http://dev.iscrmktg.com/';
var uploads = url + 'ajax/uploads/';


$('.checkbox-inline input').change(function () {
	temita = $(this).attr('id');
	console.log(temita);
    if ($('#'+temita).is(':checked')) {
	console.log('show');

		$(this).closest('div').find('i').fadeIn();
		$(this).closest('label').removeClass('sombra');
	
	}else{
	console.log('hide');
		$(this).closest('div').find('i').hide();
		$(this).closest('label').addClass('sombra');
		
	}
});

FormValidation.Validator.password = {
    validate: function(validator, $field, options) {
        var value = $field.val();
        if (value === '') {
            return true;
        }

        if (value.length < 8) {
            return false;
        }
        if (value === value.toLowerCase()) {
            return false;
        }
        if (value === value.toUpperCase()) {
            return false;
        }
        if (value.search(/[0-9]/) < 0) {
            return false;
        }

        return true;
    }
};

FormValidation.Validator.securePassword = {
    validate: function(validator, $field, options) {
        var value = $field.val();
        if (value === '') {
            return true;
        }

        // Check the password strength
        if (value.length < 6) {
            return {
                valid: false,
                message: 'Debe tener al menos 6 caracteres.'
            };
        }


        return true;
    }
};

$('#formUsuario')
        .formValidation({
	        framework: 'bootstrap',
	        excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
		        usuPass2: {
		            validators: {
		                identical: {
		                    field: 'usuPass',
		                    message: 'La contraseña no coincide'
		                }
		            }
		        },
                usuMail: {
                    validMessage: 'Con este e-mail entrarás a la plataforma',
                    validators: {
                        notEmpty: {
                            message: 'Debes ingresar un email'
                        },
                        emailAddress: {
	                        message: 'Debes ingresar un email valido'
	                    }
                    }
                }
            },
			locale: 'es_ES'
        })
        .on('success.field.fv', function(e, data) {
            var field  = data.field,        // Get the field name
                $field = data.element;      // Get the field element

            // Show the valid message element
            $field.next('.validMessage[data-field="' + field + '"]').show();
        })
        .on('err.field.fv', function(e, data) {
            var field  = data.field,        // Get the field name
                $field = data.element;      // Get the field element

            $field.next('.validMessage[data-field="' + field + '"]').hide();
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formUsuario');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(data) {
                    console.log(data);
			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado el usuario.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otro",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado  el usuario.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');

 
                }
            });
        });    

$('#formCambiar')
        .formValidation({
	        framework: 'bootstrap',
	        excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
		        usuPass2: {
		            validators: {
		                identical: {
		                    field: 'usuPass',
		                    message: 'La contraseña no coincide'
		                }
		            }
		        }
            },
			locale: 'es_ES'
        })
        .on('success.field.fv', function(e, data) {
            var field  = data.field,        // Get the field name
                $field = data.element;      // Get the field element

            // Show the valid message element
            $field.next('.validMessage[data-field="' + field + '"]').show();
        })
        .on('err.field.fv', function(e, data) {
            var field  = data.field,        // Get the field name
                $field = data.element;      // Get the field element

            $field.next('.validMessage[data-field="' + field + '"]').hide();
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formUsuario');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(data) {
                    console.log(data);
			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha cambiado la contraseña.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();   
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar'); 
                    
                }
            });
        });    


$('#formLogin')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    validMessage: 'OK',
                    validators: {
                        notEmpty: {
                            message: 'Debes ingresar un nombre de usuario'
                        }
                    }
                },
                password: {
                    validMessage: 'OK!',
                    validators: {
                        notEmpty: {
                            message: 'Debes ingresar una contraseña'
                        }
                    }
                }
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');

            // Do whatever you want here ...
			
			$('#btnLogin').html('Conectando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) { 
                    console.log(result);
                    if(result=='ok'){
                    	window.location.href='home.php';
                    }else{
	                    $('#error').show();
	                    $('#formLogin')[0].reset();
						$('#btnLogin').html('Ingresar <i class="fa fa fa-chevron-right"></i>');
                    }
                }
            });


            // Then submit the form as usual
            //fv.defaultSubmit();
        });    
        

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#fotoperfil').attr('src', e.target.result);
            $('#nofoto').hide();
            $('#fotito').fadeIn();
        }

        reader.readAsDataURL(input.files[0]);
    }
}

	
$("#uploadFoto").change(function(){
    readURL(this);
});
         
  
function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#fotoperfil3').attr('src', e.target.result);
            $('#fotito2').fadeIn();
        }

        reader.readAsDataURL(input.files[0]);
    }
}

	
$("#uploadFoto2").change(function(){
    readURL2(this);
});
         


// LEVANTAR MODAL DE ITEM:

$('a.subefoto').click(function(){
	$('#myModal').modal('show');
	
	itemID 		= $(this).data('itemid');
	itemrow     = '#item-'+itemID;
	
	ptdItem 	= $(this).data('ptditem');
	itemNom 	= $(itemrow).data('nom');
	itemFoto    = $(itemrow).data('foto');
	itemCom		= $(itemrow).data('com');
	
	console.log('Item: '+ptdItem);
	
	$('#myModal h3').html(itemNom);
	$('#ptdItem').val(ptdItem);
	$('#argTxt').val(itemCom);
	
	if(itemFoto){
		$('#fotito img').attr('src',uploads+itemFoto);
		$('#fotito').show();
		$('#subefoto').html('<i class="fa fa-camera"></i> Cambiar');
	}else{
		$('#fotito img').attr('src','');
		$('#fotito').hide();
		$('#subefoto').html('<i class="fa fa-camera"></i> Subir');
	}
	
});

$('a#logoutBtn').on('click', function() {
	swal({   title: "¿Seguro?",   text: "Cerrará la sesión.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#bc1c1c",   confirmButtonText: "Salir",    cancelButtonText: "Cancelar",  closeOnConfirm: false }, 
		function(){  	
		$('#logoutBtn').html(' <i class="fa fa fa-spinner fa-spin"></i> Saliendo');
		var url = "logout.php";
		$.ajax({
	       type: "POST",
	       url: url,
	        success: function(data) {
				console.log(data);
				if(data == "logout") {
					window.location.replace('index.php');
				}else{
					swal('Ha ocurrido un error, por favor vuelva a intentarlo.');
				}
	        }
	    });
    });
});

var insID = 0;






$("#tipoPedido").bind("change", function() {
	tipoPedido = $(this).val();
	if(tipoPedido==1){
		$('#agrega-pedido').removeClass('hide');
		$('#agrega-pedido_v2').addClass('hide');
	}else if(tipoPedido==2){
		$('#agrega-pedido_v2').removeClass('hide');
		$('#agrega-pedido').addClass('hide');
	}else{
		$('#agrega-pedido').addClass('hide');
		$('#agrega-pedido_v2').addClass('hide');
	}
});	


$("#ptdGra").bind("change", function() {
	insID   = $(this).val();
	formato = $(this).data('formato');
    $('#isc').val('');
    $('#fotito2').hide();
    $('#fotocatalogo').attr('src','');
    $('#itemcat').hide();
    GetOpciones(insID, formato);
});	

function GetOpciones(insID,formID) {
  if (insID > 0) {
        $("#ptdGraOp").get(0).options.length = 0;
        $("#ptdGraOp").get(0).options[0] = new Option("Cargando Opciones...", "-1"); 
		
 	    $.ajax({
            type: "POST",
            url: "ajax/opciones.php",
            data: { "formID": formID, "insID": insID },
			success: function(msg) {
	            console.log(msg);
				if(msg.opciones){
					total = msg.opciones.length;
					console.log('Total: '+total);
	                $("#ptdGraOp").get(0).options.length = 0;
	                
// 	                $("#ptdGraOp").get(0).options[0] = new Option("-- Seleccione Opción --", ""); 
	                
	                if(total>1){
	                	$("#ptdGraOp").get(0).options[0] = new Option("-- Seleccione Opción --", ""); 
		 				$("#opcionesgra").show();
	 				}else{
				 	    $.ajax({
				            type: "POST",
				            url: "ajax/opciones2.php",
				            data: { "formID": formID, "insID": insID, "insOpID": 1 },
							success: function(msg) {
					            console.log(msg);
								if(msg.opciones){
									total = msg.opciones.length;
					                $.each(msg.opciones, function(index, item) {
				
					                 	if(item.Display!=''){
									 		$("#opcionesgra").show();
					                 	}else{
									 		$("#opcionesgra").hide();
					                 	}
					                    if(item.pieCat==1){
						                    $('#itemcat').show();
						                    $('#isc').val('');
						                    $('#fotito2').hide();
						                    $('#fotocatalogo').attr('src','').attr('alt','');
					                    }else{
						                    $('#itemcat').hide();
						                 	archivo = item.archivo;
						                 	console.log(archivo);
						                    $('#fotito2').show();
						                    $('#fotocatalogo').attr('src',archivo).attr('alt',archivo);
						                    $('#isc').val(archivo);
						                    
					                    }
					                });
								}
				            },
				            error: function(xhr, status, error) {
								alert(status);
				        	}
				        });		
	 				}
	                $.each(msg.opciones, function(index, item) {
	                    $("#ptdGraOp").get(0).options[$("#ptdGraOp").get(0).options.length] = new Option(item.Display, item.Value);

	                });
				}
            },
            error: function(xhr, status, error) {
				alert(status);
        	}
        });
    }else{
        $("#ptdGraOp").get(0).options.length = 0;
    }
}


$("#ptdGraOp").bind("change", function() {
	insOpID   = $(this).val();
	formato = $("#ptdGra").data('formato');
    GetOpciones2(insOpID,insID, formato);
});	

function GetOpciones2(insOpID, insID,formID) {
	if (insID > 0) {

 	    $.ajax({
            type: "POST",
            url: "ajax/opciones2.php",
            data: { "formID": formID, "insID": insID, "insOpID": insOpID },
			success: function(msg) {
	            console.log(msg);
				if(msg.opciones){
					total = msg.opciones.length;
	                $.each(msg.opciones, function(index, item) {

	                    if(item.pieCat==1){
		                    $('#itemcat').show();
		                    $('#isc').val('');
		                    $('#fotito2').hide();
		                    $('#fotocatalogo').attr('src','');
	                    }else if(item.pieCat==0){
		                    $('#itemcat').hide();
		                 	
		                 	archivo = item.archivo;
		                 	console.log(archivo);
		                    $('#fotito2').show();
		                    $('#fotocatalogo').attr('src',archivo).attr('alt',archivo);
		                    $('#isc').val(archivo);
		                    
	                    }else{
		                    $('#itemcat').hide();
		                    $('#isc').val('');
		                    $('#fotito2').hide();
		                    $('#fotocatalogo').attr('src','').attr('alt','');	                    
	                    }
	                });
				}
            },
            error: function(xhr, status, error) {
				alert(status);
        	}
        });
    }
}


// V2 ISC FW 2017 --->

$("#ptdGra2").bind("change", function() {
	insID   = $(this).val();
	formato = $(this).data('formato');
    $('#isc').val('');
    $('#fotito2').hide();
    $('#fotocatalogo').attr('src','');
    GetOpciones_v2(insID, formato);
});	

function GetOpciones_v2(insID,formID) {
  if (insID > 0) {
        $("#ptdGraOp2").get(0).options.length = 0;
        $("#ptdGraOp2").get(0).options[0] = new Option("Cargando Opciones...", "-1"); 
		
 	    $.ajax({
            type: "POST",
            url: "ajax/opciones_v2.php",
            data: { "formID": formID, "insID": insID },
			success: function(msg) {
	            console.log(msg);
				if(msg.opciones){
					total = msg.opciones.length;
					console.log('Total: '+total);
	                $("#ptdGraOp2").get(0).options.length = 0;
	                
	                
	                if(total>1){
	                	$("#ptdGraOp2").get(0).options[0] = new Option("-- Seleccione Opción --", ""); 
		 				$("#opcionesgra").show();
	 				}else{
				 	    $.ajax({
				            type: "POST",
				            url: "ajax/opciones2_v2.php",
				            data: { "formID": formID, "insID": insID, "insOpID": 1 },
							success: function(msg) {
					            console.log(msg);
								if(msg.opciones){
									total = msg.opciones.length;
					                $.each(msg.opciones, function(index, item) {
				
					                 	if(item.Display!=''){
									 		$("#opcionesgra").show();
					                 	}else{
									 		$("#opcionesgra").hide();
					                 	}
					                 	archivo = item.archivo;
					                 	console.log(archivo);
					                    $('#fotito2').show();
					                    $('#fotocatalogo').attr('src',archivo).attr('alt',archivo);
					                    $('#isc').val(archivo);
					                });
								}
				            },
				            error: function(xhr, status, error) {
								alert(status);
				        	}
				        });		
	 				}
	                $.each(msg.opciones, function(index, item) {
	                    $("#ptdGraOp2").get(0).options[$("#ptdGraOp2").get(0).options.length] = new Option(item.Display, item.Value);

	                });
				}
            },
            error: function(xhr, status, error) {
				alert(status);
        	}
        });
    }else{
        $("#ptdGraOp").get(0).options.length = 0;
    }
}

$("#ptdGraOp2").bind("change", function() {
	insOpID   = $(this).val();
	formato = $("#ptdGra2").data('formato');
    GetOpciones2_v2(insOpID,insID, formato);
});	

function GetOpciones2_v2(insOpID, insID,formID) {
	if (insID > 0) {

 	    $.ajax({
            type: "POST",
            url: "ajax/opciones2_v2.php",
            data: { "formID": formID, "insID": insID, "insOpID": insOpID },
			success: function(msg) {
	            console.log(msg);
				if(msg.opciones){
					total = msg.opciones.length;
	                $.each(msg.opciones, function(index, item) {
	                    if(item.pieCat==0){
		                 	archivo = item.archivo;
		                 	console.log(archivo);
		                    $('#fotito2').show();
		                    $('#fotocatalogo').attr('src',archivo).attr('alt',archivo);
		                    $('#isc').val(archivo);
	                    }else{
		                    $('#isc').val('');
		                    $('#fotito2').hide();
		                    $('#fotocatalogo').attr('src','').attr('alt','');	                    
	                    }
	                });
				}
            },
            error: function(xhr, status, error) {
				alert(status);
        	}
        });
    }
}


$("#camID").bind("change", function() {
    GetCatalogo($(this).val());
    $('#myDropdown').ddslick('destroy');
    $('#ptdCat').val('');
    $('#aca_va').html('');
});	

function GetCatalogo(camID) {
  if (camID > 0) {
	  	formID = $('#formID').val();
 	    $.ajax({
            type: "POST",
            url: "ajax/catalogo_v2.php",
            data: { "camID": camID,"formID": formID },
			success: function(msg) {
            	console.log(msg);

				$('#myDropdown').ddslick({
				    data:msg.ddData,
				    height:300,
				    selectText: "Elige el item del catálogo",
				    imagePosition:"right",
				    onSelected: function(selectedData){
					    console.log(selectedData);
					    console.log(selectedData.selectedData.value);
				        $('#ptdCat').val(selectedData.selectedData.value);
				        
						include = 'include-isc-campana.php?formID='+formID+'&camID='+camID+'&catID='+selectedData.selectedData.value;
						
						console.log(include);
						
						$.get(include, function(data) {
/*
							pines = $(data).find("#isc_camp");
							console.log(pines);
*/
							$('#aca_va').html( $(data).hide().fadeIn(2000));
				    	});		
				    }   
				});

            },
            error: function(xhr, status, error) {
				//alert(status);
        	}
        });
    }else{
        $("#ptdGraOp").get(0).options.length = 0;
    }
}



$('#agrega-pedido')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
                			
			$('#btngrabar').html('<i class="fa fa fa-spinner fa-spin"></i> Grabando');

			paisID		= $('#paisID').val();
			formID		= $('#formID').val();
			ptTie		= $('#ptTie').val();
			ptdGra		= $('#ptdGra2').val();
			ptdGraOp	= $('#ptdGraOp2').val();

			$.ajax({
                type: 'POST',
                url: 'ajax/comprueba-pedidos.php',
	            data: {'paisID':paisID, 'formID':formID, 'ptTie':ptTie, 'ptdGra': ptdGra,'ptdGraOp':ptdGraOp }
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			        if(data>0){
				         $('#ptdAlerta').val(1);
					 	 swal({   title: "¡Atención!",   text: "Este elemento ya se ha pedido con anterioridad. "+ data +" piezas. ¿Confirma su pedido?",   type: "warning",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: true , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  					
								// obtengo el archivo a subir
								var inputFileImage 	= document.getElementById("uploadFoto");
								var file 			= inputFileImage.files[0];
								var data 			= new FormData();
								data.append('foto',file);
								var other_data = $('#agrega-pedido').serializeArray();
								$.each(other_data,function(key,input){
									data.append(input.name,input.value);
								});
					
					 			$.ajax({
					                type: 'POST',
					                url: $form.attr('action'),
						            contentType:false,
						            data: data,
						            processData:false,
						            cache:false
					            })
					            .done(function( data, textStatus, jqXHR ) {
									if ( console && console.log ) {
									 	console.log(data);
										if(data==1){
										 	$('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
										 	swal({   title: "¡Excelente!",   text: "Se ha agregado el pedido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otro",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
							            	function(isConfirm){   
							            		if (isConfirm) {  
							            			location.reload();   
							            		} else {     
							            			javascript:window.history.back();   
							            		} 
							            	});	
										}else if(data==2){	
										 	$('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
										 	swal({   title: "¡Excelente!",   text: "Se ha editado el pedido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
							            	function(isConfirm){   
							            		if (isConfirm) {  
							            			javascript:window.history.back();  
							            		} else {     
							            			javascript:window.history.back();   
							            		} 
							            	});				 	
								        }else{
									    	swal('Ha ocurrido un error.');
								        }
									}	
								})
								.fail(function( jqXHR, textStatus, errorThrown ) {
								     if ( console && console.log ) {
						                    alert('Ha ocurrido un error. ' +textStatus);
								     }
								});							
							}else{
							
							
								$('#agrega-pedido').data('formValidation').resetForm();
								
							}
						});	
					}else{
						
						// obtengo el archivo a subir
						var inputFileImage 	= document.getElementById("uploadFoto");
						var file 			= inputFileImage.files[0];
						var data 			= new FormData();
						data.append('foto',file);
						var other_data = $('#agrega-pedido').serializeArray();
						$.each(other_data,function(key,input){
							data.append(input.name,input.value);
						});
			
			 			$.ajax({
			                type: 'POST',
			                url: $form.attr('action'),
				            contentType:false,
				            data: data,
				            processData:false,
				            cache:false
			            })
			            .done(function( data, textStatus, jqXHR ) {
							if ( console && console.log ) {
							 	console.log(data);
								if(data==1){
								 	$('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
								 	swal({   title: "¡Excelente!",   text: "Se ha agregado el pedido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otro",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
					            	function(isConfirm){   
					            		if (isConfirm) {  
					            			location.reload();   
					            		} else {     
					            			javascript:window.history.back();   
					            		} 
					            	});
					            }else if(data==2){
								 	$('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
								 	swal({   title: "¡Excelente!",   text: "Se ha modificado el pedido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
					            	function(isConfirm){   
					            		if (isConfirm) {  
					            			javascript:window.history.back();   
					               		} else {     
					            			javascript:window.history.back();   
					            		} 
					            	});	
						            					 	
						        }else{
							    	swal('Ha ocurrido un error.');
						        }
							}	
						})
						.fail(function( jqXHR, textStatus, errorThrown ) {
						     if ( console && console.log ) {
				                    alert('Ha ocurrido un error. ' +textStatus);
						     }
						});						
						
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});
        });    



////--> Graba formulario de pedido de campañas

$('#agrega-pedido_v2')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
                			
			$('#btngrabar2').html('<i class="fa fa fa-spinner fa-spin"></i> Grabando');

			// obtengo el archivo a subir

 			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
				if ( console && console.log ) {
				 	console.log(data);
					if(data==1){
					 	$('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
					 	swal({   title: "¡Excelente!",   text: "Se ha agregado el pedido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otro",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
		            		if (isConfirm) {  
		            			location.reload();   
		            		} else {     
		            			javascript:window.history.back();   
		            		} 
		            	});
		            }else if(data==2){
					 	$('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
					 	swal({   title: "¡Excelente!",   text: "Se ha modificado el pedido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
		            		if (isConfirm) {  
		            			javascript:window.history.back();   
		               		} else {     
		            			javascript:window.history.back();   
		            		} 
		            	});	
			            					 	
			        }else{
				    	swal('Ha ocurrido un error.');
			        }
				}	
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});						
			
			$('#btngrabar2').html('<i class="fa fa-floppy-o"></i> Grabar');

        }); 




////

$('#formCampana')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='2'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado la campaña.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});
					}else{
					 	 swal({   title: "¡Excelente!",   text: data,   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });  

$('#formProveedor')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado el proveedor.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otro",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado el proveedor.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        }); 


$('#formFormato')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado el formato.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado el formato.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });  

$('#formPieza')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado el formato.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado el formato.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });  

$('#formPieOp')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			// obtengo el archivo a subir
			var inputFileImage 	= document.getElementById("uploadFoto");
			var file 			= inputFileImage.files[0];
			var data 			= new FormData();
			data.append('foto',file);
			var other_data = $('#formPieOp').serializeArray();
			$.each(other_data,function(key,input){
				data.append(input.name,input.value);
			});

 			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            contentType:false,
	            data: data,
	            processData:false,
	            cache:false
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado la opción.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado la opción.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });  
        
$("#usuTipo").bind("change", function() {
    if($(this).val()==4){
	    $("#proveedor").removeClass('hide');
    }else{
	    $("#proveedor").addClass('hide');
    }
    
    if($(this).val()==4 || $(this).val()==2){
	    $("#formatos").removeClass('hide');
    }else{
	    $("#formatos").addClass('hide');
    }
});	


$('#btn-all-aprobar').on('click',function(){
	
	paisID = $(this).data('paisid');
	pdID = $(this).data('ptid');
	ptdRes = $(this).data('ptdres');
	console.log(pdID);
 	
	swal({   title: "¿Seguro?",   text: "Aprobarás todo el pedido.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#0084D6",   confirmButtonText: "Si, aprobar.",    cancelButtonText: "No",  closeOnConfirm: false }, 
	function(){   	
		$.ajax({
            url: 'ajax/comprobar-proveedor-pedido.php',
            type: 'POST',
            data: { "paisID": paisID, "pdID": pdID, "ptdRes":ptdRes},
            success: function(result) {
                console.log(result);
                if(result=='1'){
					$.ajax({
			            url: 'ajax/cambiar-estado-pedido.php',
			            type: 'POST',
			            data: { "paisID": paisID, "pdID": pdID, "estini":1,"estfin":3,"ptdRes":ptdRes},
			            success: function(result) {
			                console.log(result);
			                if(result=='1'){
						        location.reload();
			                }else{
				                
			                }
			            }
			        });	
                }else{
	                swal("Error", "Debe elegir primero un proveedor para cada ítem", "error");
                }
            }
        });	
	});
});


$('#btn-all-rechazar').on('click',function(){
	
	paisID = $(this).data('paisid');
	pdID = $(this).data('ptid');
	ptdRes = $(this).data('ptdres');
	console.log(pdID);
	swal({   title: "¿Seguro?",   text: "Rechazarás todo el pedido.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#d9534f",   confirmButtonText: "Si, rechazar.",    cancelButtonText: "No",  closeOnConfirm: false }, 
	function(){   	
		$.ajax({
            url: 'ajax/cambiar-estado-pedido.php',
            type: 'POST',
            data: { "paisID": paisID, "pdID": pdID, "estini":1,"estfin":2,"ptdRes":ptdRes},
            success: function(result) {
                console.log(result);
                if(result=='1'){
	               swal({   title: "Listo",   text: "Pedido Rechazado.",   type: "warning",   showCancelButton: false,   confirmButtonColor: "#d9534f",   confirmButtonText: "OK",    cancelButtonText: "No",  closeOnConfirm: false }, 
				   function(){  
			        	window.history.back();
			        });
                }else{
	                
                }
            }
        });	
	});
});

$('.btn-rechazar').on('click',function(){
	pdID 	= $(this).data('ptid');
	ptdItem = $(this).data('ptditem');
	vm	 	= $(this).data('vm');

	vitID 	= $(this).data('ptditem');
	vitrow	= '#peddet-'+vitID;
	
	console.log(vitrow);
	
	tiendaID 	= $('#cajaposiciones').data('tiendaid');
	
	vitNom 		= $(vitrow).data('nom');
	
	$('#ptdItem4').val(vitID);
	$('#vm').val(vm);
	
	$('#ModalObjetar').modal('show');

});




$('#formObjetar')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btnComentar2').html('<i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			        if(data=='1'){
	            		location.reload();
					}else{
						
					}
                    $('#btnComentar2').html('<i class="fa fa-times"></i> Confirmar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });   




/*
$('.btn-rechazar').on('click',function(){
	pdID 	= $(this).data('ptid');
	ptdItem = $(this).data('ptditem');
	
	swal({   title: "¿Estás seguro?",   text: "",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si",     cancelButtonText: "No", closeOnConfirm: false }, function(){   
		$.ajax({
	        url: 'ajax/cambiar-estado-item-pedido.php',
	        type: 'POST',
	        data: { "pdID": pdID, "ptdItem": ptdItem,"estfin": 2},
	        success: function(result) {
	            console.log(result);
	            if(result=='1'){
			        location.reload();
	            }else{
	                
	            }
	        }
	    });		
	});	
});
*/



$('.btn-aprobar').on('click',function(){
	paisID 	= $(this).data('paisid');
	pdID 	= $(this).data('ptid');
	ptdItem = $(this).data('ptditem');
	$.ajax({
        url: 'ajax/comprobar-proveedor-item-pedido.php',
        type: 'POST',
        data: { "paisID": paisID, "pdID": pdID, "ptdItem": ptdItem},
        success: function(result) {
            console.log(result);
            if(result=='1'){
				$.ajax({
			        url: 'ajax/cambiar-estado-item-pedido.php',
			        type: 'POST',
			        data: {  "paisID": paisID, "pdID": pdID, "ptdItem": ptdItem,"estfin": 3},
			        success: function(result) {
			            console.log(result);
			            if(result=='1'){
					        location.reload();
			            }else{
			                
			            }
			        }
			    });	
            }else{
                swal("Error", "Debe elegir primero un proveedor", "error");
            }
        }
    });		
	
	
	

});

$('.btn-aprobarcot').on('click',function(){
	paisID 	= $(this).data('paisid');
	pdID 	= $(this).data('ptid');
	ptdItem = $(this).data('ptditem');
	$.ajax({
        url: 'ajax/cambiar-estado-item-pedido.php',
        type: 'POST',
        data: { "paisID":paisID, "pdID": pdID, "ptdItem": ptdItem,"estfin": 5},
        success: function(result) {
            console.log(result);
            if(result=='1'){
			 	 swal({   title: "¡Listo!",   text: "Se ha aprobado la cotización.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
            	function(isConfirm){   
	            	if (isConfirm) {  
						location.reload();
	            	}else{
	            		javascript:window.history.back();   
	            	}
            	});	            
            }else{
                
            }
        }
    });	
});

$('.btn-rechazarcot').on('click',function(){
	paisID 	= $(this).data('paisid');
	pdID 	= $(this).data('ptid');
	ptdItem = $(this).data('ptditem');
	$.ajax({
        url: 'ajax/rechaza-cotizacion.php',
        type: 'POST',
        data: { "paisID":paisID, "pdID": pdID, "ptdItem": ptdItem,"estfin": 3},
        success: function(result) {
            console.log(result);
            if(result=='1'){
		        //location.reload();
            }else{
                
            }
        }
    });	
});

$('#btn-all-aprobarcot').on('click',function(){
	paisID 	= $(this).data('paisid');
	pdID = $(this).data('ptid');
	ptdRes = $(this).data('ptdres');
	swal({   title: "¿Seguro?",   text: "Aprobarás toda la cotización.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#0084D6",   confirmButtonText: "Si, aprobar.",    cancelButtonText: "No",  closeOnConfirm: false }, 
	function(){   	
		$.ajax({
            url: 'ajax/cambiar-estado-pedido-x-responsable.php',
            type: 'POST',
            data: { "paisID":paisID, "pdID": pdID, "estini":4,"estfin":5, "ptdRes":ptdRes},
            success: function(result) {
                console.log(result);
                if(result=='1'){
			        location.reload();
                }else{
	                
                }
            }
        });	
	});
});


$('#btn-all-rechazarcot').on('click',function(){
	paisID 	= $(this).data('paisid');
	pdID = $(this).data('ptid');
	ptdRes = $(this).data('ptdres');
	swal({   title: "¿Seguro?",   text: "Rechazarás toda la cotización.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#d9534f",   confirmButtonText: "Si, rechazar.",    cancelButtonText: "No",  closeOnConfirm: false }, 
	function(){   	
		$.ajax({
            url: 'ajax/cambiar-estado-pedido-x-responsable.php',
            type: 'POST',
            data: { "paisID":paisID, "pdID": pdID, "estini":4,"estfin":3, "ptdRes":ptdRes},
            success: function(result) {
                console.log(result);
                if(result=='1'){
			        location.reload();
                }else{
	                
                }
            }
        });	
	});
});


$('.btn-eliminar').on('click',function(){
	paisID 	= $(this).data('paisid');
	pdID 	= $(this).data('ptid');
	ptdItem = $(this).data('ptditem');
	swal({   title: "¿Estás seguro?",   text: "Este item se eliminará definitivamente.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si",     cancelButtonText: "No", closeOnConfirm: false }, function(){   
		$.ajax({
	        url: 'ajax/eliminar-item-pedido.php',
	        type: 'POST',
	        data: { "paisID":paisID, "pdID": pdID, "ptdItem": ptdItem},
	        success: function(result) {
	            console.log(result);
	            if(result=='1'){
			        location.reload();
	            }else{
	                
	            }
	        }
	    });		
	});	
});





$('#formPedido')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btnGrabaFecha').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha actualizado el pedido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	
					}else{
						
					}
                    $('#btnGrabaFecha').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });  
        
$('a.detped').click(function(){
	$('#myModal').modal('show');
	$('#titacabas').html('Revisar Pedido');
	
	vitID 	= $(this).data('ptditem');
	vitrow	= '#peddet-'+vitID;
	
	console.log(vitrow);
	
	tiendaID 	= $('#cajaposiciones').data('tiendaid');
	
	vitNom 		= $(vitrow).data('nom');
	vitFoto    	= $(vitrow).data('foto');
	vitCom		= $(vitrow).data('com');
	pedEst		= $(vitrow).data('est');
	usutipo		= $(vitrow).data('usutipo');
	fecen		= $(vitrow).data('fecen');

	ptdItem 	= $(this).data('ptditem');

	if(pedEst == 3 && usutipo == 4){
		$('.fechapedido').removeClass('hide');
		$('#btnGrabaFecha').removeClass('hide');
		$('#argTxt').addClass('hide');
	}else{
		$('.fechapedido').addClass('hide');
		$('#btnGrabaFecha').addClass('hide');
		$('#argTxt').removeClass('hide');
	}

	if(pedEst == 4){	
		$('.fechapedido').removeClass('hide');
		$('.fechapedido input').prop('disabled', true);
	}else{
		$('.fechapedido input').prop('disabled', false);
	}
	
	$('#tiendaID').val(tiendaID);
	$('#nombre').val(vitNom);
	$('#argTxt').val(vitCom);
	$('#ptdItem').val(vitID);
	$('#ptdFecEn').val(fecen);

});
  
        
$('#btn-all-entregar').click(function(){
	$('#ModalEntrega').modal('show');
	titulo = $(this).data('titulo');
	$('#titacabas2').html(titulo);
	vitID 	= $(this).data('ptditem');
	vitrow	= '#peddet-'+vitID;	
	tiendaID 	= $('#cajaposiciones').data('tiendaid');
	vitFoto    	= $(this).data('foto');
});     
  
        
$('a.pedfoto').click(function(){
	$('#myModal2').modal('show');
	titulo = $(this).data('titulo');
	$('#titacabas2').html(titulo);
	
	vitID 	= $(this).data('ptditem');
	vitrow	= '#peddet-'+vitID;
	
	tiendaID 	= $('#cajaposiciones').data('tiendaid');
	
	vitFoto    	= $(this).data('foto');

	$('#fotoperfil2').attr('src','resize3.php?img='+vitFoto+'&width=640&height=640&mode=fit');

});     


$('a.btncomentar').click(function(){
	$('#ModalComentarios').modal('show');
	vitID 	= $(this).data('ptditem');
	vitrow	= '#peddet-'+vitID;
	
	console.log(vitrow);
	
	tiendaID 	= $('#cajaposiciones').data('tiendaid');
	
	vitNom 		= $(vitrow).data('nom');
	
	$('#ptdItem3').val(vitID);
});
$('a.btn-cotizar').click(function(){
	$('#ModalCotizar').modal('show');
	vitID 	= $(this).data('ptditem');
	vitrow	= '#peddet-'+vitID;
	vitNom  = $(vitrow).data('nom');
	
	console.log(vitrow);
	
	tiendaID 	= $('#cajaposiciones').data('tiendaid');
	
	vitNom 		= $(vitrow).data('nom');
	
	$('#nombre2').val(vitNom);
	$('#ptdItem7').val(vitID);
});





$('.btntrash').on('click',function(){
	catid 	= $(this).data('catid');
	swal({   title: "¿Estás seguro?",   text: "Este item se eliminará definitivamente.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si",     cancelButtonText: "No", closeOnConfirm: false }, function(){   
		$.ajax({
	        url: 'ajax/eliminar-item-catalogo.php',
	        type: 'POST',
	        data: { "catid": catid},
	        success: function(result) {
	            console.log(result);
	            if(result=='1'){
			        location.reload();
	            }else{
	                
	            }
	        }
	    });		
	});	
});


$('#formPedido2')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btnObjetar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha actualizado el pedido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	
					}else{
						
					}
                    $('#btnObjetar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        }); 
 $('#formComentario')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btnComentar').html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "",   text: "Cometario agregado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();  
			            	}
		            	});
	            	
					}else{
						
					}
                    $('#btnComentar').html('<i class="fa fa-comments"></i> Enviar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });   
        
$('#formEntrega')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btnRecibir').html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');

			// obtengo el archivo a subir
			var inputFileImage 	= document.getElementById("uploadFoto");
			var file 			= inputFileImage.files[0];
			var data 			= new FormData();
			data.append('foto',file);
			var other_data = $('#formEntrega').serializeArray();
			$.each(other_data,function(key,input){
				data.append(input.name,input.value);
			});

 			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            contentType:false,
	            data: data,
	            processData:false,
	            cache:false
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "",   text: "Pedido Entregado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();  
			            	}
		            	});
	            	
					}else{
						
					}
                    $('#btnRecibir').html('<i class="fa fa-comments"></i> Enviar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });      
   				


$('.btnfinaliza').on('click',function(){
	paisID 	= $(this).data('paisid');
	pdID 	= $(this).data('ptid');
	ptdItem = $(this).data('ptditem');
	$.ajax({
        url: 'ajax/cambiar-estado-item-pedido.php',
        type: 'POST',
        data: { "paisID":paisID,"pdID": pdID, "ptdItem": ptdItem,"estfin": 8},
        success: function(result) {
            console.log(result);
            if(result=='1'){
		        location.reload();
            }else{
                
            }
        }
    });	
});


$('.btnenviar1').on('click',function(){
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');
	$.ajax({
        url: 'ajax/procesa-pedidos-proveedor.php',
        type: 'POST',
        success: function(result) {
            console.log(result);
            if(result=='1'){
		        swal("Excelente", "Se ha enviado el mail a los proveedores correspondientes.", "success");
				$('.btnenviar1').html('Enviar a Proveedor <i class="fa fa-envelope" aria-hidden="true"></i>');
            }else{
                
            }
        }
    });	
});


$('.btnenviar2').on('click',function(){
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');
	paisID 	= $(this).data('paisid');
	pdID 	= $(this).data('ptid');
	paisID 	= $(this).data('paisid');
	$.ajax({
        url: 'ajax/procesa-pedidos-proveedor.php',
        type: 'POST',
        data: { "paisID": paisID, "pdID": pdID},
        success: function(result) {
            console.log(result);
            if(result=='1'){
				$('.btnenviar2').html('Enviar a Proveedor <i class="fa fa-envelope" aria-hidden="true"></i>');
			 	 swal({   title: "Excelente",   text: "Se ha enviado el mail a los proveedores correspondientes.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
            	function(isConfirm){   
	            	if (isConfirm) {  
						location.reload();  
	            	}
            	});	
            }else{
                
            }
        }
    });	
});

$('.btnenviar3').on('click',function(){
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');
	paisID 	= $(this).data('paisid');
	ptID 		= $(this).data('ptid');
	ptdProv 	= $(this).data('ptdprov');
	console.log(ptdProv);
	$.ajax({
        url: 'ajax/procesa-cotizacion.php',
        type: 'POST',
        data: { "paisID":paisID,"ptID": ptID, "ptdProv": ptdProv},
        success: function(result) {
            console.log(result);
            if(result=='1'){
			 	 swal({   title: "Excelente",   text: "Se ha enviado la cotizacion.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
            	function(isConfirm){   
	            	if (isConfirm) {  
	            		location.reload();  
	            	}
            	});		        
            }else{
                
            }
        }
    });	
});

$('.btnenviar4').on('click',function(){
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');
	paisID 	= $(this).data('paisid');
	ptID 	= $(this).data('ptid');
	ptdRes  = $(this).data('ptdres');
	$.ajax({
        url: 'ajax/confirma-cotizacion.php',
        type: 'POST',
        data: { "paisID":paisID,"ptID": ptID, "ptdRes": ptdRes},
        success: function(result) {
            console.log(result);
            if(result=='1'){
			 	 swal({   title: "Excelente",   text: "Se ha confirmado la cotizacion.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
            	function(isConfirm){   
	            	if (isConfirm) {  
	            		location.reload();  
	            	}
            	});	
            }else{
                
            }
        }
    });	
});

$('a#btn-all-recibir').click(function(){
	$('#ModalFechaEntrega').modal('show');	
});
  
$('#formFechaEntrega')
    .formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		locale: 'es_ES'
    })
    .on('success.form.fv', function(e) {
        e.preventDefault();

        var $form = $(e.target),
            fv    = $(e.target).data('formValidation');
		
		$('#btnGrabaFechaEntrega').html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');

		$.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
        })
        .done(function( data, textStatus, jqXHR ) {
		     if ( console && console.log ) {
		        console.log(data);

		         if(data=='1'){
				 	 swal({   title: "",   text: "Fecha confirmada.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
	            	function(isConfirm){   
		            	if (isConfirm) {  
		            		location.reload();  
		            	}
	            	});
            	
				}else{
					
				}
                $('#btnGrabaFechaEntrega').html('<i class="fa fa-comments"></i> Grabar');
			
			}	
				
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
		     if ( console && console.log ) {
                    alert('Ha ocurrido un error. ' +textStatus);
		     }
		});

    });   
    
      
$('a.btnFotos').click(function(){
	$('#ModalFotos').modal('show');
	vitID 	= $(this).data('ptditem');
	vitrow	= '#peddet-'+vitID;
	
	tiendaID 	= $('#cajaposiciones').data('tiendaid');
	
	vitNom 		= $(vitrow).data('nom');
	
	$('#ptdItem6').val(vitID);

});     
    
    
    
 	$('#formFotos')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btnGrabaFotos').html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');

			// obtengo el archivo a subir
			var inputFileImage 	= document.getElementById("uploadFoto2");
			var file 			= inputFileImage.files[0];
			var data 			= new FormData();
			data.append('foto',file);
			var other_data = $('#formFotos').serializeArray();
			$.each(other_data,function(key,input){
				data.append(input.name,input.value);
			});
			
 			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            contentType:false,
	            data: data,
	            processData:false,
	            cache:false
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "",   text: "Se ha subido la foto.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();  
			            	}
		            	});
	            	
					}else{
						
					}
                    $('#btnGrabaFotos').html('<i class="fa fa-comments"></i> Enviar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });    
        
     

$('a.btnadjuntar').click(function(){
	$('#ModalArchivos').modal('show');
	vitID 	= $(this).data('ptditem');
	vitrow	= '#peddet-'+vitID;
	
	tiendaID 	= $('#cajaposiciones').data('tiendaid');
	
	vitNom 		= $(vitrow).data('nom');
	console.log(vitID);
	$('#ptdItem8').val(vitID);

});       

$('#formArchivos')
    .formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		locale: 'es_ES'
    })
    .on('success.form.fv', function(e) {
        e.preventDefault();

        var $form = $(e.target),
            fv    = $(e.target).data('formValidation');
		
		$('#btnGrabaArchivos').html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');

		// obtengo el archivo a subir
		var inputFileImage 	= document.getElementById("uploadFoto2");
		var file 			= inputFileImage.files[0];
		var data 			= new FormData();
		data.append('foto',file);
		var other_data = $('#formArchivos').serializeArray();
		$.each(other_data,function(key,input){
			data.append(input.name,input.value);
		});
		
			$.ajax({
            type: 'POST',
            url: $form.attr('action'),
            contentType:false,
            data: data,
            processData:false,
            cache:false
        })
        .done(function( data, textStatus, jqXHR ) {
		     if ( console && console.log ) {
		        console.log(data);

		         if(data=='1'){
				 	 swal({   title: "",   text: "Se ha subido el archivo.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
	            	function(isConfirm){   
		            	if (isConfirm) {  
		            		location.reload();  
		            	}
	            	});
            	
				}else{
					
				}
                $('#btnGrabaArchivos').html('<i class="fa fa-comments"></i> Enviar');
			
			}	
				
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
		     if ( console && console.log ) {
                    alert('Ha ocurrido un error. ' +textStatus);
		     }
		});

    });    
   
        
  
$('#formPrecioItem')
    .formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		locale: 'es_ES'
    })
    .on('success.form.fv', function(e) {
        e.preventDefault();

        var $form = $(e.target),
            fv    = $(e.target).data('formValidation');
		
		$('#btnGrabaValor').html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');

		$.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
        })
        .done(function( data, textStatus, jqXHR ) {
		     if ( console && console.log ) {
		        console.log(data);

		         if(data=='1'){
				 	 swal({   title: "",   text: "Valor grabado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
	            	function(isConfirm){   
		            	if (isConfirm) {  
		            		location.reload();  
		            	}
	            	});
            	
				}else{
					
				}
                $('#btnGrabaValor').html('<i class="fa fa-comments"></i> Grabar');
			
			}	
				
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
		     if ( console && console.log ) {
                    alert('Ha ocurrido un error. ' +textStatus);
		     }
		});

    });              
    
    
$('#formCatalogo')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('<i class="fa fa fa-spinner fa-spin"></i> Grabando ');

			// obtengo el archivo a subir
			var inputFileImage 	= document.getElementById("uploadFoto");
			var file 			= inputFileImage.files[0];
			var data 			= new FormData();
			data.append('foto',file);
			var other_data = $('#formCatalogo').serializeArray();
			$.each(other_data,function(key,input){
				data.append(input.name,input.value);
			});

 			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            contentType:false,
	            data: data,
	            processData:false,
	            cache:false
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado el item.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado el item.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						swal("Ha ocurrido un error", "Por favor intentelo nuevamente", "error");
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });      
   				

    

// Procesar y Aprobar Pedido
$('.btnenviar5').on('click',function(){	
	ptID 	= $(this).data('ptid');
	paisID 	= $(this).data('paisid');	
	$('.btnenviar5').html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');
	swal({   title: "¿Estás seguro?",   text: "Esta acción procesará, aprobará y enviará el pedido al proveedor.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si",   closeOnConfirm: false, cancelButtonText: "No", }, 
	function(isConfirm){   	
		$.ajax({
            url: 'ajax/comprobar-proveedor-pedido_admin.php',
            type: 'POST',
	        data: { "paisID": paisID, "ptID": ptID},
            success: function(result) {
                console.log(result);
                if(result=='1'){
					$.ajax({
				        url: 'ajax/procesa-pedido-mm.php',
				        type: 'POST',
				        data: { "paisID": paisID, "ptID": ptID},
				        success: function(result) {
				            console.log(result);
				            if(result=='1'){
							 	swal({   title: "Pedido procesado y enviado a proveedores.",   text: "Ahora volverá al inicio.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
				            	function(isConfirm){   
					            	if (isConfirm) {
										window.location.replace("home.php"); 
					            	}else{
					            		javascript:window.history.back();   
					            	}
				            	});						        
						        
						        
				            }else{
				                swal("Error", "Por favor vuelva a intentarlo.", "error");
								$('.btnenviar5').html('Procesar y Aprobar Pedido <i class="fa fa-check" aria-hidden="true"></i>');
				            }
				        }
				    });	
                }else{
	                swal("Error", "Debe elegir primero un proveedor para cada ítem", "error");
					$('.btnenviar5').html('Procesar y Aprobar Pedido <i class="fa fa-check" aria-hidden="true"></i>');
                }
            }
        });	
	});
});    
    
    
    
// Procesar Pedido
$('.btnenviar6').on('click',function(){
	
	ptID 	= $(this).data('ptid');
	paisID 	= $(this).data('paisid');
swal({   title: "¿Estás seguro?",   text: "Esta acción procesará el pedido para su posterior aprobación.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si",   closeOnConfirm: false, cancelButtonText: "No", }, function(){   
		
		$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');
		$.ajax({
	        url: 'ajax/procesa-pedido-admin-aprobar.php',
	        type: 'POST',
	        data: { "paisID": paisID, "ptID": ptID},
	        success: function(result) {
	            console.log(result);
	            if(result=='1'){
			        swal("Excelente", "Se ha procesado el pedido.", "success");
			        location.reload();  
	            }else{
	                
	            }
	        }
	    });	
	
	});	
});
    
    
$('#formTiendas')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado la tienda.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado la tienda.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });  

$('#formStd')
        .formValidation({
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
			locale: 'es_ES'
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');
			
			$('#btngrabar').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='2'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha modificado el registro.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});
					}else if(data=='1'){
					 	 swal({   title: "¡Excelente!",   text: "Se ha agregado el registro",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otro",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
						
					}else{
						swal("Ha ocurrido un error", 'Mensaje: '+data , "error");
					}
                    $('#btngrabar').html('<i class="fa fa-floppy-o"></i> Grabar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });  

$('#btnAgregaChecklist').on('click',function(){
	
	tieID 	= $(this).data('tieid');
	usuID 	= $(this).data('usuid');
	
	swal({   title: "¿Seguro?",   text: "Crearás un nuevo checklist.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#0084D6",   confirmButtonText: "Si, crear.",    cancelButtonText: "No",  closeOnConfirm: false }, 
	function(){   	
		$.ajax({
            url: 'ajax/agrega-checklist-x-tienda.php',
            type: 'POST',
            data: { "tieID": tieID, "usuID": usuID},
            success: function(result) {
                console.log(result);
                if(result.success){
					clxtID = result.clxtID;
			        window.location.href='formulario-checklists-x-tienda.php?clxtID='+clxtID;
                }else{
					swal("Error", 'Ha ocurrido un error', "error");
                }
            }
        });	
	});
});
    
    
$('.clxtdStatus').on('change',function(){    
	clxtID 		= $(this).data('clxtid');
	clxtdClID 	= $(this).data('clxtdclid');
	clxtdClDID 	= $(this).data('clxtdcldid');
	clxtdStatus = $(this).val();  
	$.ajax({
        url: 'ajax/graba-checklist-x-tienda-status.php',
        type: 'POST',
        data: { "clxtID": clxtID, "clxtdClID": clxtdClID,"clxtdClDID": clxtdClDID, "clxtdStatus": clxtdStatus},
        success: function(result) {
            console.log(result);
            if(result=='1'){
                
            }else{
                
            }
        }
    });	
});


    
$('.clxtdCom').on('blur',function(){    
	clxtID 		= $(this).data('clxtid');
	clxtdClID 	= $(this).data('clxtdclid');
	clxtdClDID 	= $(this).data('clxtdcldid');
	clxtdCom 	= $(this).val();  
	$.ajax({
        url: 'ajax/graba-checklist-x-tienda-comentario.php',
        type: 'POST',
        data: { "clxtID": clxtID, "clxtdClID": clxtdClID,"clxtdClDID": clxtdClDID, "clxtdCom": clxtdCom},
        success: function(result) {
            console.log(result);
            if(result=='1'){
                
            }else{
               
            }
        }
    });	
});  
    
$('.clxtCom').on('blur',function(){    
	clxtID 		= $(this).data('clxtid');
	clxtdClID 	= $(this).data('clxtdclid');
	clxtCom 	= $(this).val();  
	console.log({ "clxtID": clxtID, "clxtdClID": clxtdClID,"clxtCom": clxtCom});
	$.ajax({
        url: 'ajax/graba-checklist-x-tienda-comentario-general.php',
        type: 'POST',
        data: { "clxtID": clxtID, "clxtdClID": clxtdClID,"clxtCom": clxtCom},
        success: function(result) {
            console.log(result);
            if(result=='1'){
                
            }else{
               
            }
        }
    });	
});  
    
 $('.clxtIntro').on('blur',function(){    
	clxtID 		= $(this).data('clxtid');
	clxtdClID 	= $(this).data('clxtdclid');
	clxtIntro 	= $(this).val();  
	console.log({ "clxtID": clxtID, "clxtdClID": clxtdClID,"clxtIntro": clxtIntro});
	$.ajax({
        url: 'ajax/graba-checklist-x-tienda-introduccion.php',
        type: 'POST',
        data: { "clxtID": clxtID, "clxtdClID": clxtdClID,"clxtIntro": clxtIntro},
        success: function(result) {
            console.log(result);
            if(result=='1'){
                
            }else{
               
            }
        }
    });	
}); 
    
 $('a.btnFotosChecklists').click(function(){
	$('#ModalFotos').modal('show');
	clxtdClID 	= $(this).data('clxtdclid');
	clxtdClDID 	= $(this).data('clxtdcldid');
	
	$('#ClID').val(clxtdClID);
	$('#ClDID').val(clxtdClDID);

});    
    
    
 $('.btnenviarChecklist').on('click',function(){
	
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Enviando ');
	
	clxtID 	= $(this).data('clxtid');

	$.ajax({
        url: 'ajax/comprueba-checklist.php',
        type: 'POST',
        data: { "clxtID": clxtID},
        success: function(result) {
            console.log(result);
            if(result==0){
				swal({   title: "¿Estás seguro?",   text: "Esta acción dará por terminado el checklist y se lo enviará por e-mail",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si",   closeOnConfirm: false, cancelButtonText: "No", }, function(isConfirm){    
	            	if (isConfirm) {  
		            	html = $('.sa-button-container').html();
		            	$('.sa-button-container').html('<i class="fa fa fa-spinner fa-spin"></i>');
						$.ajax({
					        url: 'ajax/procesa-checklist.php',
					        type: 'POST',
					        data: { "clxtID": clxtID},
					        success: function(result) {
					            console.log(result);
									$('.sa-button-container').html(html);
					            if(result=='1'){
						            
									swal({   title: "Excelente",   text: "Se ha enviado el checklist.",   type: "success",   showCancelButton: false,   confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   closeOnConfirm: false, cancelButtonText: "No", }, function(isConfirm){  
										if (isConfirm) {  
											javascript:window.history.back();
										}
									});
					            }else{
					                swal("Ha ocurrido un error", 'Por favor vuelva a intentarlo.', "error");
									$('.btnenviarChecklist').html('Terminar y Enviar <i class="fa fa-envelope" aria-hidden="true"></i>');
					            }
					        }
					    });	
		            } else{  
						$('.btnenviarChecklist').html('Terminar y Enviar <i class="fa fa-envelope" aria-hidden="true"></i>');
            		}   
				
				});
            }else{
				swal("Checklist incompleto", 'Debe completar todos los ítems.', "error");
				$('.btnenviarChecklist').html('Terminar y Enviar <i class="fa fa-envelope" aria-hidden="true"></i>');
            }
        }
    });	
		
});
       
    
    
$('#aaaa').on('change',function(){
	
	mm = $('#mm').val();
	if(mm==''){
		cola = '?aaaa='+$(this).val();
	}else{
		cola = '?aaaa='+$(this).val()+'&mm='+mm;
	}
	
	
	var url = 'http://' + window.location.hostname + window.location.pathname;
	window.location = url + cola; // redirect
	return false;
}); 
    
$('#mm').on('change',function(){
	
	mm = $(this).val();
	if(mm==''){
		cola = '?aaaa='+$('#aaaa').val();
	}else{
		cola = '?aaaa='+$('#aaaa').val()+'&mm='+mm;
	}
	var url = 'http://' + window.location.hostname + window.location.pathname;
	window.location = url + cola; // redirect
	return false;
});      
    

$('.pedProv').on('change',function(){    
	paisID 		= $(this).data('paisid');
	ptID 		= $(this).data('ptid');
	ptdItem 	= $(this).data('ptditem');
	proveedor 	= $(this).val();  
	$.ajax({
        url: 'ajax/graba-proveedor-item-pedido.php',
        type: 'POST',
        data: { "paisID": paisID, "ptID": ptID,"ptdItem": ptdItem, "proveedor": proveedor},
        success: function(result) {
            console.log(result);
            if(result=='1'){
                
            }else{
                
            }
        }
    });	
});
    
    
 $('.btnPDF').on('click',function(){
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> PDF');
	camID = $(this).data('camid');
	console.log(camID);
	$.ajax({
	    url: 'ajax/pdf_campana.php',
	    type: 'POST',
	    data: { "camID": camID},
	    success: function(result) {
		    console.log(result);
			$('.btnPDF').html('<i class="fa fa-file-pdf-o"></i> PDF');
	        window.open(result,'_blank');
	    }
	});
	
}); 