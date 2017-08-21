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
	
	if($_GET['pieID'] ){
		$pieID 	 	= $_GET['formID'];
		$sql  		= "select * from formatos where formID = $formID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$formDesc 	= $r['formDesc'];
				$formEst 	= $r['formEst'];
	 		} 
	    }		
		$opcion = 'Modificar';	
	}else{
		
		$opcion = 'Agregar';
	}
	
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span></span>
	    </header>

		    <div id="cajaposiciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    	<h2><?= $opcion; ?> Formato</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-formatos.php" method="post" accept-charset="utf-8" id="formFormato">
							<div class="form-group">
								<label class="ptdCan">Descripción:</label>
								<input type="text" class="form-control" id="formDesc" placeholder="Nombre del formato" name="formDesc" value="<?= $formDesc; ?>" required>
								<? if($_GET['formID'] ){?>
								<input type="hidden" name="formID" 	value="<?= $formID; ?>">
								<? } ?>
							</div>
	
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="formEst" required id="formEst">
									<option value="0" <? if($formEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($formEst==1){ ?>selected<? } ?>>Inactivo</option>
								</select>
							</div>			
							<hr>
							<div class="form-group text-right">
						    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> Grabar</button>
							</div>
							
						</form>
					
					</div>

				</div>
				<div class="clear"></div>
		    </div>

	    	<footer class="animated bounceInRight">
		    	<a href="javascript:window.history.back();" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    
   
<? include('footer.php'); ?>