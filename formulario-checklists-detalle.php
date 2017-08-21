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
	
	$clID 		= $_GET['clID'];
	$checklist 	= get_checklist_nom($clID);
	
	if($_GET['cldID'] ){
		$cldID 	 	= $_GET['cldID'];
		$sql  		= "select * from checklist_detalle where clID = $clID and cldID = $cldID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$cldZona = $r['cldZona'];
				$cldItem = $r['cldItem'];
				$cldCom  = $r['cldCom'];
				$cldEst  = $r['cldEst'];
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
			    	<h2><?php echo $opcion; ?> ítem <?= $checklist; ?></h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-checklist-detalle.php" method="post" accept-charset="utf-8" id="formStd">
							<div class="form-group">
								<label for="ptdGra">Zona</label>
								<select class="form-control" name="cldZona" required id="cldZona" required>
									<option value="">Seleccione</option>
									<?
									$tema = $db->rawQuery('select * from checklist_zona');
									if($tema){
										foreach ($tema as $t) {
									?>
									<option value="<?= $t['clzID']; ?>" <? if($cldZona==$t['clzID']){ ?>selected<? } ?>><?= $t['clzNom']; ?></option>
									<?		
										}
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label class="ptdCan">Descripción:</label>
								<input type="text" class="form-control" id="cldItem" placeholder="Nombre del ítem" name="cldItem" value="<?= $cldItem; ?>" required>
								<input type="hidden" name="clID" 	value="<?= $clID; ?>">
								<? if($_GET['cldID'] ){?>
								<input type="hidden" name="cldID" 	value="<?= $cldID; ?>">
								<? } ?>
							</div>	
							<div class="form-group">
								<label class="ptdCan">Comentario:</label>
								<input type="text" class="form-control" id="cldCom" placeholder="Instrucción para observación" name="cldCom" value="<?= $cldCom; ?>">
							</div>
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="cldEst" required id="cldEst">
									<option value="0" <? if($cldEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($cldEst==1){ ?>selected<? } ?>>Inactivo</option>
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
		    	<a href="checklists-maestro-checklists-detalle.php?clID=<?php echo $clID; ?>" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    


   
<? include('footer.php'); ?>