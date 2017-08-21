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
                message: 'Deve ter pelo menos 6 caracteres.'
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
		                    message: 'As senhas não coincidem'
		                }
		            }
		        },
                usuMail: {
                    validMessage: 'Com este e-mail vai entrar na plataforma',
                    validators: {
                        notEmpty: {
                            message: 'Informe um e-mail'
                        },
                        emailAddress: {
	                        message: 'Informe um e-mail válido'
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
			
			$('#btnSalvar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(data) {
                    console.log(data);
			         if(data=='1'){
					 	 swal({   title: "Excelente!",   text: "Usuário adicionado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Adicionar outro",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "Excelente!",   text: "Usuário alterado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');

 
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
		                    message: 'As senhas não coincidem'
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
			
			$('#btnSalvar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(data) {
                    console.log(data);
			         if(data=='1'){
					 	 swal({   title: "Excelente!",   text: "Senha alterada.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();   
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
					}else{
						
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar'); 
                    
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
                            message: 'Você deve digitar um nome de usuário'
                        }
                    }
                },
                password: {
                    validMessage: 'OK!',
                    validators: {
                        notEmpty: {
                            message: 'Informe uma senha'
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
		$('#subefoto').html('<i class="fa fa-camera"></i> Alterar');
	}else{
		$('#fotito img').attr('src','');
		$('#fotito').hide();
		$('#subefoto').html('<i class="fa fa-camera"></i> Envio');
	}
	
});

$('a#logoutBtn').on('click', function() {
	
	$('#logoutBtn').html(' <i class="fa fa fa-spinner fa-spin"></i> Cerrando');
	var url = "logout.php";
	$.ajax({
       type: "POST",
       url: url,
        success: function(data) {
			console.log(data);
			if(data == "logout") {
				window.location.replace('index.php');
			}else{
				swal('Ocorreu um erro, Tente novamente.');
			}
        }
     });
});

var insID = 0;

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
        $("#ptdGraOp").get(0).options[0] = new Option("Carregando opções...", "-1"); 
		
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
	                	$("#ptdGraOp").get(0).options[0] = new Option("-- Selecione a Opção --", ""); 
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
						                    $('#fotocatalogo').attr('src','');
						                    $('#fotocatalogo').attr('alt','');
					                    }else{
						                    $('#itemcat').hide();
						                 	archivo = item.archivo;
						                 	console.log(archivo);
						                    $('#fotito2').show();
						                    $('#fotocatalogo').attr('src',archivo);
						                    $('#fotocatalogo').attr('alt',archivo);
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
		                    $('#fotocatalogo').attr('src',archivo);
							$('#fotocatalogo').attr('alt',archivo);
		                    $('#isc').val(archivo);
		                    
	                    }else{
		                    $('#itemcat').hide();
		                    $('#isc').val('');
		                    $('#fotito2').hide();
		                    $('#fotocatalogo').attr('src','');	                    
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
});	

function GetCatalogo(camID) {
  if (camID > 0) {
 	    $.ajax({
            type: "POST",
            url: "ajax/catalogo.php",
            data: { "camID": camID },
			success: function(msg) {
            	console.log(msg);

				$('#myDropdown').ddslick({
				    data:msg.ddData,
				    height:300,
				    selectText: "Escolha um item do catálogo",
				    imagePosition:"right",
				    onSelected: function(selectedData){
					    console.log(selectedData);
					    console.log(selectedData.selectedData.value);
				        $('#ptdCat').val(selectedData.selectedData.value);
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
                			
			$('#btnSalvar').html('<i class="fa fa fa-spinner fa-spin"></i> Salvando');

			paisID		= $('#paisID').val();
			formID		= $('#formID').val();
			ptTie		= $('#ptTie').val();
			ptdGra		= $('#ptdGra').val();
			ptdGraOp	= $('#ptdGraOp').val();

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
					 	 swal({   title: "Atenção!",   text: "Este elemento já foi pedido anteriormente. "+ data +"  peças. Deseja confirmar o pedido?",   type: "warning",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: true , allowOutsideClick: true}, 
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
										 	$('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
										 	swal({   title: "Excelente!",   text: "Pedido adicionado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Adicionar outro",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
							            	function(isConfirm){   
							            		if (isConfirm) {  
							            			location.reload();   
							            		} else {     
							            			javascript:window.history.back();   
							            		} 
							            	});	
										}else if(data==2){	
										 	$('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
										 	swal({   title: "Excelente!",   text: "Se ha editado el pedido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
							            	function(isConfirm){   
							            		if (isConfirm) {  
							            			javascript:window.history.back();  
							            		} else {     
							            			javascript:window.history.back();   
							            		} 
							            	});				 	
								        }else{
									    	swal('Ocorreu um erro.');
								        }
									}	
								})
								.fail(function( jqXHR, textStatus, errorThrown ) {
								     if ( console && console.log ) {
						                    alert('Ocorreu um erro. ' +textStatus);
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
								 	$('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
								 	swal({   title: "Excelente!",   text: "Pedido adicionado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Adicionar outro",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
					            	function(isConfirm){   
					            		if (isConfirm) {  
					            			location.reload();   
					            		} else {     
					            			javascript:window.history.back();   
					            		} 
					            	});
					            }else if(data==2){
								 	$('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
								 	swal({   title: "Excelente!",   text: "Ele mudou a ordem.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
					            	function(isConfirm){   
					            		if (isConfirm) {  
					            			javascript:window.history.back();   
					               		} else {     
					            			javascript:window.history.back();   
					            		} 
					            	});	
						            					 	
						        }else{
							    	swal('Ocorreu um erro.');
						        }
							}	
						})
						.fail(function( jqXHR, textStatus, errorThrown ) {
						     if ( console && console.log ) {
				                    alert('Ocorreu um erro. ' +textStatus);
						     }
						});						
						
						
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
			     }
			});




        });    



////






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
			
			$('#btnSalvar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='2'){
					 	 swal({   title: "Excelente!",   text: "Se ha modificado la campaña.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});
					}else{
					 	 swal({   title: "Excelente!",   text: data,   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
						
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
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
			
			$('#btnSalvar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "Excelente!",   text: "Fornecedor adicionado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Adicionar outro",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "Excelente!",   text: "Fornecedor alterado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
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
			
			$('#btnSalvar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "Excelente!",   text: "Se ha agregado el formato.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "Excelente!",   text: "Se ha modificado el formato.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
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
			
			$('#btnSalvar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "Excelente!",   text: "Se ha agregado el formato.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "Excelente!",   text: "Se ha modificado el formato.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
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
			
			$('#btnSalvar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

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
					 	 swal({   title: "Excelente!",   text: "Se ha agregado la opción.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "Excelente!",   text: "Se ha modificado la opción.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
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
 	
	swal({   title: "Tem certeza?",   text: "Você vai aprovar toda a ordem.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#0084D6",   confirmButtonText: "Si, aprobar.",    cancelButtonText: "No",  closeOnConfirm: false }, 
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
	                swal("Erro", "Escolha um fornecedor para cada item", "error");
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
	swal({   title: "Tem certeza?",   text: "Você irá rejeitar toda a ordem.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#d9534f",   confirmButtonText: "Si, rechazar.",    cancelButtonText: "No",  closeOnConfirm: false }, 
	function(){   	
		$.ajax({
            url: 'ajax/cambiar-estado-pedido.php',
            type: 'POST',
            data: { "paisID": paisID, "pdID": pdID, "estini":1,"estfin":2,"ptdRes":ptdRes},
            success: function(result) {
                console.log(result);
                if(result=='1'){
	               swal({   title: "Pronto",   text: "Pedido recusado.",   type: "warning",   showCancelButton: false,   confirmButtonColor: "#d9534f",   confirmButtonText: "OK",    cancelButtonText: "No",  closeOnConfirm: false }, 
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
	                    alert('Ocorreu um erro. ' +textStatus);
			     }
			});

        });   




/*
$('.btn-rechazar').on('click',function(){
	pdID 	= $(this).data('ptid');
	ptdItem = $(this).data('ptditem');
	
	swal({   title: "Tem certeza?",   text: "",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Sim",     cancelButtonText: "No", closeOnConfirm: false }, function(){   
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
                swal("Erro", "Você deve primeiro escolher um provedor", "error");
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
			 	 swal({   title: "Feito!",   text: "Ele aprovou a cotação.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
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
	swal({   title: "Tem certeza?",   text: "Você vai passar toda a cotação.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#0084D6",   confirmButtonText: "Sim",    cancelButtonText: "No",  closeOnConfirm: false }, 
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
	swal({   title: "Tem certeza?",   text: "Você irá rejeitar toda a cotação.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#d9534f",   confirmButtonText: "Si, rechazar.",    cancelButtonText: "No",  closeOnConfirm: false }, 
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
	swal({   title: "Tem certeza?",   text: "Este item será completamente cancelada",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Sim",     cancelButtonText: "No", closeOnConfirm: false }, function(){   
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
			
			$('#btnGrabaFecha').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "Excelente!",   text: "Tem ordem atualizados sido.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	
					}else{
						
					}
                    $('#btnGrabaFecha').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
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
	swal({   title: "Tem certeza?",   text: "Este item será completamente cancelada",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Sim",     cancelButtonText: "No", closeOnConfirm: false }, function(){   
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
			
			$('#btnObjetar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "Excelente!",   text: "Pedido foi atualizado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	
					}else{
						
					}
                    $('#btnObjetar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
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
			
			$('#btnComentar').html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "",   text: "Cometario agregado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
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
	                    alert('Ocorreu um erro. ' +textStatus);
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
			
			$('#btnRecibir').html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');

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
					 	 swal({   title: "",   text: "Pedido Entregado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
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
	                    alert('Ocorreu um erro. ' +textStatus);
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
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');
	$.ajax({
        url: 'ajax/procesa-pedidos-proveedor.php',
        type: 'POST',
        success: function(result) {
            console.log(result);
            if(result=='1'){
		        swal("Excelente", "E-mail enviado para fornecedor correspondente.", "success");
				$('.btnenviar1').html('Enviar para fornecedor <i class="fa fa-envelope" aria-hidden="true"></i>');
            }else{
                
            }
        }
    });	
});


$('.btnenviar2').on('click',function(){
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');
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
				$('.btnenviar2').html('Enviar para fornecedor <i class="fa fa-envelope" aria-hidden="true"></i>');
			 	 swal({   title: "Excelente",   text: "E-mail enviado para fornecedor correspondente.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
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
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');
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
			 	 swal({   title: "Excelente",   text: "Cotação enviada.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
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
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');
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
			 	 swal({   title: "Excelente",   text: "Cotação aprovada.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
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
		
		$('#btnGrabaFechaEntrega').html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');

		$.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
        })
        .done(function( data, textStatus, jqXHR ) {
		     if ( console && console.log ) {
		        console.log(data);

		         if(data=='1'){
				 	 swal({   title: "",   text: "Data confirmada.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
	            	function(isConfirm){   
		            	if (isConfirm) {  
		            		location.reload();  
		            	}
	            	});
            	
				}else{
					
				}
                $('#btnGrabaFechaEntrega').html('<i class="fa fa-comments"></i> Salvar');
			
			}	
				
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
		     if ( console && console.log ) {
                    alert('Ocorreu um erro. ' +textStatus);
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
		
		$('#btnGrabaFotos').html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');

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
				 	 swal({   title: "",   text: "Foto enviada.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
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
                    alert('Ocorreu um erro. ' +textStatus);
		     }
		});

    });  
  
$('a.btnadjuntar').click(function(){
	$('#ModalArchivos').modal('show');
	vitID 	= $(this).data('ptditem');
	vitrow	= '#peddet-'+vitID;
	
	tiendaID 	= $('#cajaposiciones').data('tiendaid');
	
	vitNom 		= $(vitrow).data('nom');
	
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
			
			$('#btnGrabaArchivos').html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');

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
					 	 swal({   title: "",   text: "Arquivo enviado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
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
	                    alert('Ocorreu um erro. ' +textStatus);
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
		
		$('#btnGrabaValor').html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');

		$.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
        })
        .done(function( data, textStatus, jqXHR ) {
		     if ( console && console.log ) {
		        console.log(data);

		         if(data=='1'){
				 	 swal({   title: "",   text: "Valor registrado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
	            	function(isConfirm){   
		            	if (isConfirm) {  
		            		location.reload();  
		            	}
	            	});
            	
				}else{
					
				}
                $('#btnGrabaValor').html('<i class="fa fa-comments"></i> Salvar');
			
			}	
				
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
		     if ( console && console.log ) {
                    alert('Ocorreu um erro. ' +textStatus);
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
			
			$('#btnSalvar').html('<i class="fa fa fa-spinner fa-spin"></i> Salvando ');

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
					 	 swal({   title: "Excelente!",   text: "Item adicionado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "Excelente!",   text: "Item alterado.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						swal("Ocorreu um erro", "Por favor, tente novamente", "error");
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
			     }
			});

        });      
   				

    

// Procesar y Aprobar Pedido
$('.btnenviar5').on('click',function(){	
	ptID 	= $(this).data('ptid');
	paisID 	= $(this).data('paisid');	
	$('.btnenviar5').html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');
	swal({   title: "Tem certeza?",   text: "Esta ação irá processar, aprovar e enviar o pedido ao fornecedor",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Sim",   closeOnConfirm: false, cancelButtonText: "No", }, 
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
							 	swal({   title: "Pedido processado e enviado ao fornecedor.",   text: "Agora, você voltará à página inicial.",   type: "success", confirmButtonColor: "#DD6B55",   confirmButtonText: "OK",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
				            	function(isConfirm){   
					            	if (isConfirm) {
										window.location.replace("home.php"); 
					            	}else{
					            		javascript:window.history.back();   
					            	}
				            	});						        
						        
						        
				            }else{
				                swal("Erro", "Tente novamente.", "error");
								$('.btnenviar5').html('Procesar y Aprobar Pedido <i class="fa fa-check" aria-hidden="true"></i>');
				            }
				        }
				    });	
                }else{
	                swal("Erro", "Escolha um fornecedor para cada item", "error");
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
swal({   title: "Tem certeza?",   text: "Esta ação irá processar o pedido para sua aprovação posterior",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Sim",   closeOnConfirm: false, cancelButtonText: "No", }, function(){   
		
		$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');
		$.ajax({
	        url: 'ajax/procesa-pedido-admin-aprobar.php',
	        type: 'POST',
	        data: { "paisID": paisID, "ptID": ptID},
	        success: function(result) {
	            console.log(result);
	            if(result=='1'){
			        swal("Excelente", "Ele processou a ordem.", "success");
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
			
			$('#btnSalvar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='1'){
					 	 swal({   title: "Excelente!",   text: "Loja adicionada.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Agregar otra",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
	            	} else if(data=='2') { 
					 	 swal({   title: "Excelente!",   text: "Loja alterada.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});

					}else{
						
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
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
			
			$('#btnSalvar').html('Salvando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type: 'POST',
                url: $form.attr('action'),
	            data: $form.serialize(),
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);

			         if(data=='2'){
					 	 swal({   title: "Excelente!",   text: "Ele modificou o registo.",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Saída",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		javascript:window.history.back();  
				            } else{  
			            		javascript:window.history.back();   
		            		} 
		            	});
					}else if(data=='1'){
					 	 swal({   title: "Excelente!",   text: "Registro foi adicionada",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Adicionar outro",   cancelButtonText: "Saída",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
		            	function(isConfirm){   
			            	if (isConfirm) {  
			            		location.reload();
			            	}else{
			            		javascript:window.history.back();   
			            	}
		            	});
						
					}else{
						swal("Ocorreu um erro", 'Mensaje: '+data , "error");
					}
                    $('#btnSalvar').html('<i class="fa fa-floppy-o"></i> Salvar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ocorreu um erro. ' +textStatus);
			     }
			});

        });  

$('#btnAgregaChecklist').on('click',function(){
	
	tieID 	= $(this).data('tieid');
	usuID 	= $(this).data('usuid');
	
	swal({   title: "Tem certeza?",   text: "Crearás un nuevo checklist.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#0084D6",   confirmButtonText: "Si, crear.",    cancelButtonText: "No",  closeOnConfirm: false }, 
	function(){   	
		$.ajax({
            url: 'ajax/agrega-checklist-x-tienda.php',
            type: 'POST',
            data: { "tieID": tieID, "usuID": usuID},
            success: function(result) {
                console.log(result);
                if(result=='1'){
			        //location.reload();
                }else{
	                
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
    
    
 $('a.btnFotosChecklists').click(function(){
	$('#ModalFotos').modal('show');
	clxtdClID 	= $(this).data('clxtdclid');
	clxtdClDID 	= $(this).data('clxtdcldid');
	
	$('#ClID').val(clxtdClID);
	$('#ClDID').val(clxtdClDID);

});    
    
    
 $('.btnenviarChecklist').on('click',function(){
	
	$(this).html('<i class="fa fa fa-spinner fa-spin"></i> Transmissão ');
	
	clxtID 	= $(this).data('clxtid');

	$.ajax({
        url: 'ajax/comprueba-checklist.php',
        type: 'POST',
        data: { "clxtID": clxtID},
        success: function(result) {
            console.log(result);
            if(result==0){
				swal({   title: "Tem certeza?",   text: "Esta acción dará por terminado el checklist y se lo enviará por e-mail",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Sim",   closeOnConfirm: false, cancelButtonText: "No", }, function(isConfirm){    
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
					                swal("Ocorreu um erro", 'Tente novamente.', "error");
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