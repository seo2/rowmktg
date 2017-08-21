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
	
	
	if($_GET['clzID'] ){
		$clzID 	 	= $_GET['clzID'];
		$sql  		= "select * from checklist_zona where clzID = $clzID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$clzNom  = $r['clzNom'];
				$clzMail = $r['clzMail'];
				$clzEst  = $r['clzEst'];
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
			    	<h2><?= $opcion; ?> Zona</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-zona.php" method="post" accept-charset="utf-8" id="formStd">
							
							<div class="form-group">
								<label class="ptdCan">Nombre:</label>
								<input type="text" class="form-control" id="clzNom" placeholder="Nombre de la zona" name="clzNom" value="<?= $clzNom; ?>">
								<? if($_GET['clzID'] ){?>
								<input type="hidden" name="clzID" 	value="<?= $clzID; ?>">
								<? } ?>
							</div>
	
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="clzEst" required id="clzEst">
									<option value="0" <? if($clzEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($clzEst==1){ ?>selected<? } ?>>Inactivo</option>
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
		    	<a href="checklits-maestro-zonas.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    

   
<? include('footer.php'); ?>