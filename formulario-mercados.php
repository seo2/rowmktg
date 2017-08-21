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
	
	if($_GET['paisID'] ){
		$tieID 	 	= $_GET['paisID'];
		$sql  		= "select * from paises where paisID = $tieID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$paisNom 	= $r['paisNom'];
				$tieEst 	= $r['paisEst'];
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
			    	<h2><?= $opcion; ?> País</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-mercados.php" method="post" accept-charset="utf-8" id="formStd">
							<div class="form-group">
								<label class="ptdCan">Nombre:</label>
								<input type="text" class="form-control" id="tieNom" placeholder="Nombre del país" name="paisNom" value="<?= $paisNom; ?>" required>
								<? if($_GET['paisID'] ){?>
								<input type="hidden" name="paisID" 	value="<?= $tieID; ?>">
								<? } ?>
							</div>	
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="paisEst" required id="paisEst">
									<option value="0" <? if($tieEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($tieEst==1){ ?>selected<? } ?>>Inactivo</option>
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
		    	<a href="mercados.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    
   
<? include('footer.php'); ?>