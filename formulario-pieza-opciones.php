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
	
	$formID 	= $_GET['formID'];
	$formDesc 	= get_formato($formID);
	$pieID 		= $_GET['insID'];
	$pieDesc 	= get_instore_desc($formID, $pieID);
	$insNomGen  = get_instore_gen($formID, $pieID);
	$ruta 		= get_carpeta_ISC($formID);
	
	if($_GET['insOpID'] ){
		$opcID 	 	= $_GET['insOpID'];
		$sql  		= "select * from instores_opciones where formID = $formID and insID = $pieID and insOpID = $opcID";
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$opcDesc  	= $r['insOpNom'];
				$insOpCat 	= $r['insOpCat'];
				$opcEst   	= $r['insOPEst'];
				$insOpFoto	= $r['insOpFoto'];
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
			    	<h2><?= $opcion; ?> Opción Instore</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-pieza-opciones.php" method="post" accept-charset="utf-8" id="formPieOp">
							<fieldset <? if($usuTipo!=99){ ?>disabled<? } ?> >
								<div class="form-group">
									<label for="ptdGra">Formato</label>
									<input type="text" class="form-control" id="formDesc"  name="formDesc" value="<?= $formDesc; ?>" readonly>
									<input type="hidden" name="formID" 	value="<?= $formID; ?>">
								</div>
								<label for="ptdGra">Instore</label>
									<input type="text" class="form-control" id="formDesc"  name="formDesc" value="<?= $pieDesc; ?>" readonly>
									<input type="hidden" name="insID" 	value="<?= $pieID; ?>">
								</div>
								<div class="form-group">
									<label class="ptdCan">Nombre:</label>
									<input type="text" class="form-control" id="opcDesc" placeholder="Nombre de la opción" name="insOpNom" value="<?= $opcDesc; ?>" required <? if($usuTipo!=99){ ?>disabled<? } ?>>
									<? if($_GET['insOpID'] ){?>
									<input type="hidden" name="insOpID" 	value="<?= $opcID; ?>">
									<? } ?>
								</div>
		
								<div class="form-group">
							    	<div class="col-xs-10 col-xs-offset-1" id="campofoto" style="display:none;">
										<input type="file" id="uploadFoto" name="foto">
							    	</div>
								</div>
								<? if($_GET['insOpID'] ){ // Modificación o consulta?>
									<? if($insOpFoto){ // tiene foto personalizada ?>
										<div class="row">
											<div class="col-xs-offset-3 col-xs-6">
									    		<div id="fotito" style="margin-bottom:10px; padding:5px; border:1px solid #ccc;">
												<?	$archivo = 'ajax/uploads/ISC/'.$insOpFoto; ?>	
									    			<img src="<?php echo $archivo; ?>" class="img-responsive" id="fotoperfil" >
									    		</div>
									    	</div>	
										</div>
											<? if($usuTipo==99){ ?>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-offset-3 col-xs-6">
										    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
														<i class="fa fa-camera"></i> Cambiar Foto
													</button>
												</div>
											</div>
										</div>		
											<? } ?>
										<? }else{ // tiene foto por batch o no tiene foto?>	
										<div class="row">
											<div class="col-xs-offset-3 col-xs-6">
									    		<div id="fotito" style="margin-bottom:10px; padding:5px; border:1px solid #ccc;" >
										    		<? $archivo = '/'.$ruta.quitatodo($insNomGen).quitatodo($opcDesc).'.jpg'; ?>
									    			<img src="<?php echo $archivo; ?>" class="img-responsive" id="fotoperfil" >
									    		</div>
									    	</div>	
										</div>
											<? if($usuTipo==99){ ?>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-offset-3 col-xs-6">
										    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
														<i class="fa fa-camera"></i> Agregar Foto
													</button>
												</div>
											</div>
										</div>		
										<? } ?>
									<? } ?>									
									
								
								
								<? }else{ // agregar nuevo registro ?>
										<div class="row">
											<div class="col-xs-offset-3 col-xs-6">
									    		<div id="fotito" style="margin-bottom:10px; padding:5px; border:1px solid #ccc; display:none;" >
									    			<img src="" class="img-responsive" id="fotoperfil" >
									    		</div>
									    	</div>	
										</div>
											<? if($usuTipo==99){ ?>
										<div class="form-group">
											<div class="row">
												<div class="col-xs-offset-3 col-xs-6">
										    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
														<i class="fa fa-camera"></i> Agregar Foto
													</button>
												</div>
											</div>
										</div>		
										<? } ?>
								<? } ?>
								
								
								
								
								
								
									
								<div class="row">
									<div class="col-xs-offset-3 col-xs-6">
										<div class="checkbox">
											<label>
											  <input type="checkbox" name="insOpCat" value="1" <? if($insOpCat==1){ ?>checked<? } ?> <? if($usuTipo!=99){ ?>disabled<? } ?>> Seleccionar del catálogo
											</label>
										</div>
									</div>
								</div>										
								<div class="form-group">
									<label for="ptdGra">Estado:</label>
									<select class="form-control" name="insOPEst" required id="opcEst" <? if($usuTipo!=99){ ?>disabled<? } ?>>
										<option value="0" <? if($opcEst==0){ ?>selected<? } ?>>Activo</option>
										<option value="1" <? if($opcEst==1){ ?>selected<? } ?>>Inactivo</option>
									</select>
								</div>			
								<hr>
								<? if($usuTipo==99){ ?>
								<div class="form-group text-right">
							    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> Grabar</button>
								</div>
								<? } ?>
							</fieldset>
						</form>
					
					</div>

				</div>
				<div class="clear"></div>
		    </div>

	    	<footer class="animated bounceInRight">
		    	<a href="javascript:window.history.back();" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    
   
<? include('footer.php'); ?>