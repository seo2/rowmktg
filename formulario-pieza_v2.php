<? 
	
session_start();
	if($_SESSION['todos']['Logged']){ 
 
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
	
	$formID = $_GET['formID'];
	
	if($_GET['pieID'] ){
		$pieID 	 	= $_GET['pieID'];
		$sql  		= "select * from instores_v2 where formID = $formID and insID = $pieID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$insNomGen = $r['insNomGen'];
				$insNomGes = $r['insNomGes']; 
/*
				$insNomArg = $r['insNomArg']; 
				$insNomBra = $r['insNomBra']; 
*/
				$insNomChi = $r['insNomChi']; 
/*
				$insNomCol = $r['insNomCol']; 
				$insNomMex = $r['insNomMex']; 
				$insNomPer = $r['insNomPer']; 
				$insNomPan = $r['insNomPan']; 
*/
				$insFormID = $r['insFormID']; 
				$insEst    = $r['insEst'];
	 		} 
	    }	
	    
	    
		$opcion = 'Consultar';	
	    
	    if($usuTipo==99){ 
			$opcion = 'Modificar';	
	    }
	    	
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
			    	<h2><?= $opcion; ?> Instore</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					<? if($usuTipo==99){ ?>
						<form action="ajax/graba-pieza_v2.php" method="post" accept-charset="utf-8" id="formPieza" >
					<? }else{ ?>
						<form action="ajax/graba-pieza_pais_v2.php" method="post" accept-charset="utf-8" id="formPieza" >
					<? } ?>
							<fieldset  >
							<div class="form-group">
								<label for="ptdGra">Formato</label>
							<? if($_GET['formID']){ 
								
								$formDesc = get_formato($formID);
								
							?>
								<input type="text" class="form-control" id="formDesc"  name="formDesc" value="<?= $formDesc; ?>" readonly>
								<input type="hidden" name="formID" 	value="<?= $formID; ?>">
							<? }else{ ?>
								<select class="form-control" name="formID" required id="formID" required>
									<option value="">Seleccione</option>
									<?
									$tema = $db->rawQuery('select * from formatos');
									if($tema){
										foreach ($tema as $t) {
									?>
									<option value="<?= $t['formID']; ?>"><?= $t['formDesc']; ?></option>
									<?		
										}
									}
									?>
								</select>
							<? } ?>
							</div>
							<div class="form-group">
								<label class="ptdCan">Nombre genérico inglés:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomGen" value="<?= $insNomGen; ?>" required <? if($usuTipo!=99){ ?>disabled<? } ?>>
								<? if($usuTipo!=99){ ?>
								<input type="hidden" name="paisID" 	value="<?= $paisID; ?>">
								<? } ?>
								 
								<? if($_GET['pieID'] ){?>
								<input type="hidden" name="pieID" 	value="<?= $pieID; ?>">
								<? } ?>
							</div>
							<div class="form-group">
								<label class="ptdCan">Nombre genérico en español:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomGes" value="<?= $insNomGes; ?>" required <? if($usuTipo!=99){ ?>disabled<? } ?>>
							</div>
<? 				
				if($paisID==1 || $usuTipo==99){
					$nombre  = $t["insNomChi"];
?>
							<div class="form-group">
								<label class="ptdCan">Nombre para Chile:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomChi" value="<?= $insNomChi; ?>" required>
							</div>
<? 				}
?>			
						
							<? if($usuTipo==99){ ?>
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="insEst" required id="pieEst">
									<option value="0" <? if($insEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($insEst==1){ ?>selected<? } ?>>Inactivo</option>
								</select>
							</div>	
							<? } ?>		
							<hr>
							<div class="form-group text-right">
						    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> Grabar</button>
							</div>
							</fieldset>
						</form>			
					</div>
					<? if($pieID){ ?>
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4">
							<?
								$opciones = get_total_opciones_instores_v2($formID, $pieID);
								if($opciones>1){
							?>
							<div class="form-group text-right">
						    	<a href="opciones_v2.php?formID=<?php echo $formID; ?>&pieID=<?php echo $pieID; ?>" class="btn btn-primary"><i class="fa fa-list"></i> Ver opciones</a>
							</div>
							<?		
								}	
							?>
						</div>
					</div>
					<? } ?>
				</div>
				<div class="clear"></div>
		    </div>
	
	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
		
			    	<?

							$back = 'piezas_v2.php?formID='. $formID;
					?>							
							<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> <? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> <? if($paisID==7){ ?>Sair<? }else{ ?>Salir<? } ?></a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>	
	    	    
<? include('footer.php'); ?>