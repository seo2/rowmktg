var loc = window.location.pathname;
var dir = loc.substring(0, loc.lastIndexOf('/'));
var url = document.location.origin+dir;

$('[data-toggle="tooltip"]').tooltip();

$('#formCampanaV2')
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
                type	 : 'POST',
                url		 : $form.attr('action'),
	            data	 : $form.serialize(),
	            dataType : "json",
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);
					if(data.success){
				         if(data.tipo=='2'){
						 	 swal({   title: "¡Excelente!",   text: data.message,   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
			            	function(isConfirm){   
				            	if (isConfirm) {  
									pagina = '/formulario-campana_v2.php?camID='; 
									window.location.href = url+pagina+data.elid;
					            } else{  
				            		javascript:window.history.back();   
			            		} 
			            	});
						}else if(data.tipo=='1'){
						 	 swal({   title: "¡Excelente!",   text: data.message,   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Subir fotos",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
			            	function(isConfirm){   
				            	if (isConfirm) {  
									pagina = '/formulario-campana_v2.php?camID='; 
									window.location.href = url+pagina+data.elid;
				            	}else{
									pagina = '/campana_v2.php'; 
									window.location.href = url+pagina;
				            	}
			            	});
							
						}
					}else{
						swal({ title: "Error",   text: "Ha ocurrido un error",   type: "error"});
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
        

 // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' archivos seleccionados' : label;

              input.val(log);
          if( numFiles > 0 ) {
              $('#subirFotos').fadeIn();
          } else {
              $('#subirFotos').hide();
          }

      });
  });      
        
$('#btnAgregaFotos').on('click',function(){
	$('#myModal').modal({
	  backdrop: 'static',
	  keyboard: false
	}).modal('show');
	$('#btnvolver').hide();


	var form = $('#formCampanaV2')[0]; // You need to use standard javascript object here
	var formData = new FormData(form);

	$.ajax({
        type	 : 'POST',
        url		 : 'ajax/graba-catalogo-multi_v2.php',
        data	 : formData,
        dataType : "json",
        contentType:false,
        processData:false,
        cache:false
    })
    .done(function( data, textStatus, jqXHR ) {
	     if ( console && console.log ) {
	        console.log(data);
			if(data.success){
		         if(data.tipo=='2'){
				 	 swal({   title: "¡Excelente!",   text: data.message,   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
	            	function(isConfirm){   
		            	if (isConfirm) {  
		            		javascript:window.history.back();  
			            } else{  
		            		javascript:window.history.back();   
	            		} 
	            	});
				}else if(data.tipo=='1'){
				 	 swal({   title: "¡Excelente!",   text: data.message+' ¿Qué desea hacer ahora?',   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Seguir editando",   cancelButtonText: "Salir",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
	            	function(isConfirm){   
		            	if (isConfirm) {  
							pagina = '/formulario-campana_v2.php?camID='; 
							window.location.href = url+pagina+data.elid;
		            	}else{
		            		javascript:window.history.back(); 
		            	}
	            	});
					
				}
			}else{
				swal({ title: "Error",   text: "Ha ocurrido un error",   type: "error"});
			}
		
		}	
			
	})
	.fail(function( jqXHR, textStatus, errorThrown ) {
	     if ( console && console.log ) {
                alert('Ha ocurrido un error. ' +textStatus);
	     }
	});
	
	
	
	
});

        
$('.btntrash_V2').on('click',function(){
	camid 	= $(this).data('camid');
	catid 	= $(this).data('catid');
	swal({   title: "¿Estás seguro?",   text: "Este item se eliminará definitivamente.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si",     cancelButtonText: "No", closeOnConfirm: true }, function(){   
		$.ajax({
	        url: 'ajax/eliminar-item-catalogo_v2.php',
	        type: 'POST',
	        data: { "camid": camid,"catid": catid},
	        success: function(result) {
	            console.log(result);
	            if(result=='1'){
		            $('#catv2'+catid).fadeOut();
	            }else{
		            swal({ title: "Error",   text: "Ha ocurrido un error",   type: "error"});
	            }
	        }
	    });		
	});	
});        
   
   
$('#formFormCat')
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
			
			$('#btnGrabaFormCat').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type	 : 'POST',
                url		 : $form.attr('action'),
	            data	 : $form.serialize(),
	            dataType : "json",
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);
					if(data.success){
				         if(data.tipo=='2'){
						 	
						}else if(data.tipo=='1'){
						 	 swal({   title: "¡Excelente!",  text:  "Formatos Agregados",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, function(isConfirm){   
				            	if (isConfirm) {  
			            			location.reload(); 
				            	}
			            	});
							
						}
					}else{
						swal({ title: "Error",   text: "Ha ocurrido un error",   type: "error"});
					}
                    $('#btnGrabaFormCat').html('<i class="fa fa-floppy-o"></i> Confirmar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        });     
   
   
$('.formISCFormCat')
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
			
// 			$('#btnGrabaFormCat').html('Grabando <i class="fa fa fa-spinner fa-spin"></i>');

			$.ajax({
                type	 : 'POST',
                url		 : $form.attr('action'),
	            data	 : $form.serialize(),
	            dataType : "json",
            })
            .done(function( data, textStatus, jqXHR ) {
			     if ( console && console.log ) {
			        console.log(data);
					if(data.success){
				         if(data.tipo=='2'){
						 	
						}else if(data.tipo=='1'){
						 	 swal({   title: "¡Excelente!",  text:  "ISC Agregados",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ok",   cancelButtonText: "Salir",  showCancelButton: false,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, function(isConfirm){   
				            	if (isConfirm) {  
			            			location.reload(); 
				            	}
			            	});
							
						}
					}else{
						swal({ title: "Error",   text: "Ha ocurrido un error",   type: "error"});
					}
//                     $('#btnGrabaFormCat').html('<i class="fa fa-floppy-o"></i> Confirmar');
				
				}	
					
			})
			.fail(function( jqXHR, textStatus, errorThrown ) {
			     if ( console && console.log ) {
	                    alert('Ha ocurrido un error. ' +textStatus);
			     }
			});

        }); 

$('.borraISC').on('click',function(){
	camid 	= $(this).data('camid');
	catid 	= $(this).data('catid');
	formid 	= $(this).data('formid');
	iscid 	= $(this).data('iscid');
	swal({   title: "¿Estás seguro?",   text: "Este item se eliminará de este formato.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si",     cancelButtonText: "No", closeOnConfirm: true }, function(){   
		$.ajax({
	        url: 'ajax/eliminar-isc-formato-catalogo.php',
	        type: 'POST',
	        data: { "camid": camid,"catid": catid, "formid": formid,"iscid": iscid},
	        success: function(result) {
	            console.log(result);
	            if(result=='1'){
		            $('#borraISC_'+formid+'_'+iscid).fadeOut();
	            }else{
		            swal({ title: "Error",   text: "Ha ocurrido un error",   type: "error"});
	            }
	        }
	    });		
	});	
});  

$('.borraFormato').on('click',function(){
	camid 	= $(this).data('camid');
	catid 	= $(this).data('catid');
	formid 	= $(this).data('formid');
	swal({   title: "¿Estás seguro?",   text: "Este formato se eliminará de esta imagen.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Si",     cancelButtonText: "No", closeOnConfirm: true }, function(){   
		$.ajax({
	        url: 'ajax/eliminar-formato-catalogo.php',
	        type: 'POST',
	        data: { "camid": camid,"catid": catid, "formid": formid},
	        success: function(result) {
	            console.log(result);
	            if(result=='1'){
		            $('#borraFormato_'+formid).fadeOut();
	            }else{
		            swal({ title: "Error",   text: "Ha ocurrido un error",   type: "error"});
	            }
	        }
	    });		
	});	
}); 



        
$("#formExcel2").validate({
	  submitHandler: function(form) {
		$("#btnSubir").html('<i class="fa fa fa-spinner fa-spin"></i> espere...');

		// obtengo el archivo a subir
		var inputFileImage 	= document.getElementById("upload");
		var file 			= inputFileImage.files[0];
		var data 			= new FormData();
		data.append('archivo',file);
		
		var other_data = $('#formExcel').serializeArray();
		$.each(other_data,function(key,input){
			data.append(input.name,input.value);
		});
		
		$.ajax({
            type: "POST",
            url: "ajax/subirExcelv2.php",
            contentType:false,
            data: data,
            processData:false,
            cache:false,
            success: function(msg) {
				console.log(msg);
            	if(msg==0){
					swal('Ha ocurrido un error, por favor vuelva a intentarlo.');
            	}else{
            						
	            	swal({   title: "¡Excelente!",   text: "El archivo se ha subido correctamente. ¿Qué desea hacer ahora?",   type: "success",     confirmButtonColor: "#DD6B55",   confirmButtonText: "Ir al home",   cancelButtonText: "Subir otro archivo",  showCancelButton: true,   closeOnConfirm: false,   closeOnCancel: false , allowOutsideClick: true}, 
	            	function(isConfirm){   
	            	if (isConfirm) {  
	            		window.location.replace("home.php");  
	            	} else {     
	            		window.location.reload();     
	            	} });
            	

            	}
            	$("#btnSubir").html('<i class="fa fa-dot-circle-o"></i> Subir');
            },
            error: function(xhr, status, error) {
				//alert(status);
			}
		
		
		});
	}
}); // fin validate   



$('#formCatalogoV2')
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
			var other_data = $('#formCatalogoV2').serializeArray();
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
   			
     $('.datepicker').datepicker({
	     format: "dd/mm/yyyy",
	     weekStart: 1,
	     language: "es"
     });
     
  
     
     