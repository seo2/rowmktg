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
	
	
	if($_GET['camID'] ){
		$camID 	 	= $_GET['camID'];
		$sql  		= "select * from campana_v2 where camID = $camID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$camDesc 	= $r['camDesc'];
				if($r['camCad'] != '0000-00-00'){
					$camCad 	= date("d/m/Y", strtotime($r['camCad']));;
				}
				$camEst 	= $r['camEst'];
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
		    	<h2><?= $opcion; ?> Campaña</h2>
		    </div>

			<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
				<div class="row">
				
					<form action="ajax/graba-campana_v2.php" method="post" accept-charset="utf-8" id="formCampanaV2">
						
						<div class="form-group">
							<label class="ptdCan">Nombre:</label>
							<input type="text" class="form-control" id="camDesc" placeholder="Nombre de la campaña" name="camDesc" value="<?= $camDesc; ?>" required> 
							<? if($_GET['camID'] ){?>
							<input type="hidden" name="camID" 	value="<?= $camID; ?>">
							<? } ?>
						</div>
						
						<div class="form-group">
							<div class="row">
								<?
									$sql  = "select * from paises";
								  	$resultado = $db->rawQuery($sql);
									if($resultado){
										foreach ($resultado as $r) {
											$ok = 0;
											if($_GET['camID'] ){
												$ok = ask_pais_campana_v2($_GET['camID'] ,$r['paisID']);
											}
							    ?>   								
								<div class="col-xs-6">
								  <label >
								    <input type="checkbox" name="pais[]" value="<?php echo $r['paisID']; ?>" <? if($ok==1){ ?>checked<? } ?>>
								    <?php echo $r['paisNom']; ?>
								  </label>
								</div>
							    <? 		} 
								    } ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label class="ptdCan">Fecha de expiración:</label>
								
								<div class="input-group date">
								  <input type="text" class="form-control datepicker" id="camCad" placeholder="" name="camCad" value="<?= $camCad; ?>" required> <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								</div>
							</div>
							
							<div class="form-group col-sm-6">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="camEst" required id="camEst">
									<option value="0" <? if($camEst==0 && $_GET['camID']){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if(($camEst==1 && $_GET['camID']) || !$_GET['camID']){ ?>selected<? } ?>>Inactivo</option>
									<option value="2" <? if($camEst==2 && $_GET['camID']){ ?>selected<? } ?>>Archivado</option>
								</select>
							</div>
						</div>			
						<hr>
						<? if($_GET['camID'] ){?>
						<div class="row">
							<?
								$sql  = "select * from catalogo_v2 where camID = $camID";
					
							  	$resultado = $db->rawQuery($sql);
								if($resultado){
									foreach ($resultado as $r) {
						    ?>   
									<div class="col-xs-6 col-sm-4" id="catv2<?= $r['catID']; ?>">
									    	<? 
										    if($usuTipo==99){ 
											?>
											<?
										    	$tienecamp = check_ISC_campana($camID, $r['catID']);
												if($tienecamp == 1) { ?>

									    	<span class="fa-stack fa-lg conISC" data-toggle="tooltip" data-placement="right"  title="Con ISC">
											  <i class="fa fa-circle fa-stack-1x fa-inverse"></i>
											  <i class="fa fa-check-circle fa-stack-1x "></i>
											</span>
												<? }
											} ?>
										<div class="fotCat">
									    	<? 
										    if($usuTipo==99){ 
											?>
											<a href="formulario-catalogo_v2.php?camID=<?= $camID; ?>&catID=<?= $r['catID']; ?>" class="btncat btnedit"><i class="fa fa-edit"></i></a>
									    	<? } ?>
											<img src="resize2.php?img=<?= str_replace('../', '', $r['camFile']) ; ?>&width=200&height=200&mode=fit" class="img-responsive">
										</div>
										<a href="javascript:void(0);" class="btncat btntrash_V2" data-catid="<?= $r['catID']; ?>" data-camid="<?php echo $camID; ?>" ><i class="fa fa-trash"></i></a>
									</div>
						    <? 		} 
							    } ?>
						</div>		
						<hr>

			            <div class="input-group">
			                <label class="input-group-btn">
			                    <span class="btn btn-info">
			                        <i class="fa fa-camera"></i> Agregar Fotos <input type="file" style="display: none;" multiple name="foto[]" accept="image/*">
			                    </span>
			                </label>
			                <input type="text" class="form-control" readonly style="font-size: 10px;" placeholder="No ha seleccionado archivos">
			            </div>			
						<hr>	
						<? } ?>					
						<div class="row">
							<div class="form-group text-right col-xs-6" style="display:none;" id="subirFotos">
						    	<button type="button" class="btn btn-primary" id="btnAgregaFotos"><i class="fa fa-cloud-upload"></i> Subir Fotos</button>
							</div>
							<div class="form-group text-right col-xs-6 pull-right">
								<? 
									if($_GET['camID'] ){
										$boton = 'Actualizar';
									}else{
										$boton = 'Grabar';
									}
								?>
						    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> <?php echo $boton; ?></button>
							</div>
						</div>
					</form>
				
				</div>

			</div>
			<div class="clear"></div>
	    </div>
	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'campana_v2.php';		
							?>
							<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> <? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> Salir</a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>	
		
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-body text-center">
		      		<h3>Sus archivos se están cargando.</h3>
		      		<p id="titacabas">Por favor no cierre de esta ventana.</p>
		      		<div class="spinner">
					  <div class="bounce1"></div>
					  <div class="bounce2"></div>
					  <div class="bounce3"></div>
					</div>
					<small>Paciencia :)</small>
		      </div>
		    </div>
		  </div>
		</div>  

   
<? include('footer.php'); ?>