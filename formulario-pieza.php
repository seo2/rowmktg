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
		$sql  		= "select * from instores where formID = $formID and insID = $pieID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$insNomGen = $r['insNomGen'];
				$insNomGes = $r['insNomGes']; 
				$insNomArg = $r['insNomArg']; 
				$insNomBra = $r['insNomBra']; 
				$insNomChi = $r['insNomChi']; 
				$insNomCol = $r['insNomCol']; 
				$insNomMex = $r['insNomMex']; 
				$insNomPer = $r['insNomPer']; 
				$insNomPan = $r['insNomPan']; 
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
						<form action="ajax/graba-pieza.php" method="post" accept-charset="utf-8" id="formPieza" >
					<? }else{ ?>
						<form action="ajax/graba-pieza_pais.php" method="post" accept-charset="utf-8" id="formPieza" >
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
				if($paisID==3 || $usuTipo==99){
					$nombre  = $t["insNomArg"];
?>		
							<div class="form-group">
								<label class="ptdCan">Nombre para Argentina:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomArg" value="<?= $insNomArg; ?>" required>
							</div>
<? 				}
				if($paisID==7 || $usuTipo==99){
					$nombre  = $t["insNomBra"];
?>
							<div class="form-group">
								<label class="ptdCan">Nombre para Brasil:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomBra" value="<?= $insNomBra; ?>" required>
							</div>
<? 				}
				if($paisID==1 || $usuTipo==99){
					$nombre  = $t["insNomChi"];
?>
							<div class="form-group">
								<label class="ptdCan">Nombre para Chile:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomChi" value="<?= $insNomChi; ?>" required>
							</div>
<? 				}
				if($paisID==2 || $usuTipo==99){
					$nombre  = $t["insNomCol"];
?>
							<div class="form-group">
								<label class="ptdCan">Nombre para Colombia:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomCol" value="<?= $insNomCol; ?>" required>
							</div>
<? 				}
				if($paisID==4 || $usuTipo==99){
					$nombre  = $t["insNomMex"];
?>
							<div class="form-group">
								<label class="ptdCan">Nombre para México:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomMex" value="<?= $insNomMex; ?>" required>
							</div>
<? 				}
				if($paisID==6 || $usuTipo==99){
					$nombre  = $t["insNomPan"];
?>
							<div class="form-group">
								<label class="ptdCan">Nombre para Panamá:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomPan" value="<?= $insNomPan; ?>" required>
							</div>
<? 				}
				if($paisID==5 || $usuTipo==99){
					$nombre  = $t["insNomPer"];
?>
							<div class="form-group">
								<label class="ptdCan">Nombre para Perú:</label>
								<input type="text" class="form-control" id="pieDesc" placeholder="Nombre del Instore" name="insNomPer" value="<?= $insNomPer; ?>" required>
							</div>
<?
				}
?>							
							
<!--
							<div class="form-group">
								<label for="ptdGra">Proveedor</label>
								<select class="form-control" name="pieProv" required id="pieProv" required>
									<option value="">Seleccione</option>
									<option value="0" <? if($pieProv==0){ ?>selected<? } ?>>No especifica</option>
									<?
									$tema = $db->rawQuery("select * from proveedores where provEst = 0 and paisID = $paisID");
									if($tema){
										foreach ($tema as $t) {
									?>
									<option value="<?= $t['provID']; ?>" <? if($pieProv==$t['provID']){ ?>selected<? } ?>><?= $t['provNom']; ?></option>
									<?		
										}
									}
									?>
								</select>
							</div>
-->
<!--
							<div class="form-group">
								<label for="ptdGra">Responsable</label>
								<select class="form-control" name="pieRes" required id="pieRes" required>
									<option value="">Seleccione</option>
									<?
									$tema = $db->rawQuery("select * from usuario where usuTipo = 2 and usuEst = 0 and paisID = $paisID");
									if($tema){
										foreach ($tema as $t) {
									?>
									<option value="<?= $t['usuID']; ?>" <? if($pieRes==$t['usuID']){ ?>selected<? } ?>><?= $t['usuNom']; ?> <?= $t['usuApe']; ?></option>
									<?		
										}
									}
									?>
								</select>
							</div>
-->
<!--
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="pieCan" value="1" <? if($pieCan==1){ ?>checked<? } ?>> Pide cantidad
								</label>
							</div>
-->
<!--
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="pieCat" value="1" <? if($pieCat==1){ ?>checked<? } ?>> Seleccionar del catálogo
								</label>
							</div>
-->
<!--
							<div class="form-group">
								<label for="ptdGra">Quién entrega:</label>
								<select class="form-control" name="pieEnt" required id="pieEnt">
									<option value="0" <? if($pieEnt==0){ ?>selected<? } ?>>Proveedor</option>
									<option value="1" <? if($pieEnt==1){ ?>selected<? } ?>>MM Responsable</option>
								</select>
							</div>	
-->
<!--
							<div class="form-group">
								<label class="ptdCan">Comentario:</label>
								<input type="text" class="form-control" id="pieCom" placeholder="Instrucción para observación" name="pieCom" value="<?= $pieCom; ?>">
							</div>
-->
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
								$opciones = get_total_opciones_instores($formID, $pieID);
								if($opciones>1){
							?>
							<div class="form-group text-right">
						    	<a href="opciones.php?formID=<?php echo $formID; ?>&pieID=<?php echo $pieID; ?>" class="btn btn-primary"><i class="fa fa-list"></i> Ver opciones</a>
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

	    	<footer class="animated bounceInRight">
		    	<a href="piezas.php?formID=<?php echo $formID; ?>" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    
<? include('footer.php'); ?>