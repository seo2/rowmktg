<? 
	
session_start();
	if($_SESSION['todos']['Logged']){ 
	
	//setcookie('id', $_SESSION['todos']['id']);
 
	$usuID = $_SESSION['todos']['id'];
	
	setcookie("id", $usuID, time()+3600, "/");
 
 }elseif($_COOKIE['id']) { 
 	$usuID = $_COOKIE['id'];
 }else{ ?>
 <script>
 		window.location.replace("index.php");
 </script>
	

<?  }  ?>

<? 
	include('header.php');
?>
    <div class="container" id="argumentos">
	    

		    <div id="cajaposiciones">

				<div class="row">
			    <div class="col-md-12">
                    <form class="form-horizontal" id="formExcel" method="post" accept-charset="utf-8">
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h2>Cargar en batch</h2>
			            </div>
			            <div class="panel-body">
				            			    
				            <div class="row">
				            	<div class="col-sm-6">
				                    <div class="form-group">
				                        <label class="col-md-3 control-label" for="text-input">Evento</label>
				                        <div class="col-md-9">
				                            <input type="text" class="form-control required" placeholder="Nombre del evento" name="eveNombre" required>
				                        </div>
				                    </div>			                    		
				            	</div>
				            </div>
			                <div class="row">
			                	<div class="col-sm-6">
									<div class="form-group">
				                        <label class="col-md-3 control-label" for="file-input">Archivo Excel</label>
				                        <div class="col-md-9">
				                            <input type="file" id="upload" name="upload" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
				                            <input type="hidden" name="usuID" value="<?= $_usuID; ?>">
				                            <input type="hidden" name="empresa" value="<?= $_usuEmp; ?>">
				                        </div>
				                    </div>
			                	</div>
			                	<div class="col-sm-6">
	
			                	</div>
			                </div>
			            </div>
			            <div class="panel-footer">
			                <button type="submit" class="btn btn-sm btn-primary" id="btnSubir"><i class="fa fa-upload"></i> Subir</button>
			            </div>
			        </div>

			        </form>

			    </div>
			</div>
			<!--/.row-->
		    </div>	    	
		    <footer class="animated bounceInRight">
		    	<a href="javascript:window.history.back();" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	  
		

		    
<? include('footer.php'); ?>
<script>
	$("#formExcel").validate({
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
            url: "ajax/subirExcel.php",
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
</script>