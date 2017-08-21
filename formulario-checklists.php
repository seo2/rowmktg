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
	
	if($_GET['clID'] ){
		$clID 	 	= $_GET['clID'];
		$sql  		= "select * from checklist where clID = $clID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$clNom 	= $r['clNom'];
				$clFor  = $r['clFor'];
				$clEst 	= $r['clEst'];
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
			    	<h2><?= $opcion; ?> Checklist</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-checklist.php" method="post" accept-charset="utf-8" id="formStd">
						<div class="form-group">
							<label for="ptdGra">Formato:</label>
							<select class="form-control" name="clFor" required id="clForm">
								<option value="">Seleccione</option>
								<?
								$tema = $db->rawQuery('select * from formatos');
								if($tema){
									foreach ($tema as $t) {
								?>
								<option value="<?= $t['formID']; ?>" <? if($t['formID']==$clFor){ ?>selected<? } ?>><?= $t['formDesc']; ?></option>
								<?		
									}
								}
								?>
							</select>	
						</div>
							<div class="form-group">
								<label class="ptdCan">Nombre:</label>
								<input type="text" class="form-control" id="clNom" placeholder="Nombre del checklist" name="clNom" value="<?= $clNom; ?>" required>
								<? if($_GET['clID'] ){?>
								<input type="hidden" name="clID" 	value="<?= $clID; ?>">
								<? } ?>
							</div>	
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="clEst" required id="clEst">
									<option value="0" <? if($clEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($clEst==1){ ?>selected<? } ?>>Inactivo</option>
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