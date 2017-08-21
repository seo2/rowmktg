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
	
	$camID = $_GET['camID'];
	
	$campana = get_campana_desc_v2($camID);
	
	if($_GET['catID'] ){
		$catID = $_GET['catID'];
		$sql  = "select * from catalogo_v2 where camID = $camID and catID = $catID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				
				$camDesc = $r['camDesc'];
				$camFile = $r['camFile'];
				$camEst  = $r['camEst'];
				
	 		} 
	    }	
		$opcion = 'Modificar';		
	}else{
		$opcion = 'Agregar';
	}
	
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span>Campaña <?= $campana; ?></span>
	    </header>

		    <div id="cajaposiciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    	<h2><?= $opcion; ?> Item Catálogo</h2>
			    </div>
 
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
					<form action="ajax/graba-catalogo-single_v2.php" method="post" accept-charset="utf-8" id="formCatalogoV2"> 
					
							<div class="form-group">
								<label class="ptdCan">Nombre:</label>
								<input type="text" class="form-control" id="camDesc" placeholder="Nombre del elemento" name="camDesc" value="<?= $camDesc; ?>" required  <? if($usuTipo!=99){ ?>disabled<? } ?>>
								<input type="hidden" name="camID" value="<?= $camID; ?>">
								<? if($_GET['catID'] ){?>
								<input type="hidden" name="catID" 	value="<?= $catID; ?>">
								<input type="hidden" name="camFile" value="<?= $camFile; ?>">
								<? } ?>
							</div>
							<? if($camFile){ 
								
								$txtboton = 'Cambiar Foto';
							?>
						<div class="form-group">
					    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
								<input type="file" id="uploadFoto" name="foto">
					    	</div>
						</div>
						<div class="row">
							<div class="col-xs-offset-3 col-xs-6">
					    		<div id="fotito">
					    			<img src="resize2.php?img=<?= $camFile; ?>&width=640&height=640&mode=fit" class="img-responsive" id="fotoperfil" >
					    		</div>
					    	</div>	
						</div>	
						<? }else{
								$txtboton = 'Agregar Foto';
						?>					
					
						<div class="form-group">
					    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
								<input type="file" id="uploadFoto" name="foto">
					    	</div>
						</div>	
						<div class="row">
							<div class="col-xs-offset-3 col-xs-6">
					    		<div id="fotito" style="display:none;">
					    			<img src="" class="img-responsive" id="fotoperfil" >
					    		</div>
					    	</div>	
						</div>	
						<? } ?>		
						<hr><? if($usuTipo==99){ ?>
						<div class="row">
							<div class="form-group col-sm-6">
					    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
									<i class="fa fa-camera"></i> <?php echo $txtboton; ?>
								</button>
							</div>	
							<div class="form-group col-sm-6 pull-right">
					    		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
									<i class="fa fa-plus"></i> Agregar Formatos
								</button>
							</div>
						</div>	<? } ?>
						<hr>
						<?	if($catID){
										$sql  = "select * from formatos where formID <> 9 order by formOrder";
									  	$resultado = $db->rawQuery($sql);
										if($resultado){
											foreach ($resultado as $r) {
												$formID = $r['formID'];
								      							
							$sql  = "select * from catalogo_x_formato where camID = $camID and catID = $catID and formID = $formID";
						  	$resultado = $db->rawQuery($sql);
							if($resultado){
								foreach ($resultado as $r) {
					    ?>   								
							<div class="row" style="margin:0 0 20px;" id="borraFormato_<?php echo $formID; ?>">
								<div class="col-sm-12 posicion2">
									<div class="row">
										<div class="col-xs-8 formatito">
											<? if($usuTipo==99){ ?><a href="javascript:void(0);" class="borraFormato" data-catid="<?= $catID; ?>" data-camid="<?php echo $camID; ?>" data-formid="<?php echo $r['formID']; ?>" ><i class="fa fa-times-circle" aria-hidden="true"></i></a> <? } ?><?php echo get_formato($r['formID']); ?>
										</div>
										<? if($usuTipo==99){ ?>
										<div class="col-xs-4 text-right posvotos">
											<a href="javascript:void(0);" class="btn btn-default" data-toggle="modal" data-target="#myModal<?php echo $r['formID']; ?>"><i class="fa fa-plus"></i> <span class="hidden-xs">Agregar ISC </span></a> 
										</div>
										<? } ?>
									</div>
								</div>
							<?
								$formID = $r['formID'];
								$sql  = "select * from catalogo_x_formato_x_ISC where camID = $camID and catID = $catID and formID = $formID";
							  	$resultado = $db->rawQuery($sql);
								if($resultado){
									foreach ($resultado as $ic) {
						    ?>  
								<div class="col-sm-12 posicion1">
									<div class="row">
										<div class="col-xs-12 formatito" id="borraISC_<?php echo $formID; ?>_<?php echo $ic['iscID']; ?>">
											<? if($usuTipo==99){ ?>
											<a href="javascript:void(0);" class="borraISC"  data-catid="<?= $catID; ?>" data-camid="<?php echo $camID; ?>" data-formid="<?php echo $formID; ?>" data-iscid="<?php echo $ic['iscID']; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a> 
											<? } ?>
											<?php echo get_isc_camp($formID,$ic['iscID']); ?> <span class="medida"><small><?php echo get_isc_med($formID,$ic['iscID']); ?></small></span>
										</div>
									</div>
								</div>									
						
						    <? 		} 
							    } ?>	
							</div>												
						
					    <? 		} 
						    } 
						}
						}
						}?>						
						<hr>
						<? if($usuTipo==99){ ?>
						<div class="form-group">
							<label for="ptdGra">Estado:</label>
							<select class="form-control" name="camEst" required id="pieEst">
								<option value="0" <? if($camEst==0){ ?>selected<? } ?>>Activo</option>
								<option value="1" <? if($camEst==1){ ?>selected<? } ?>>Inactivo</option>
							</select>
						</div>	
						<div class="form-group text-right">
					    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> Grabar</button>
						</div>
						<? } ?>
					</form>
						<?
						if($catID){
							$sql  = "select * from catalogo_x_formato where camID = $camID and catID = $catID";
						  	$resultado = $db->rawQuery($sql);
							if($resultado){
								foreach ($resultado as $r) {
					    ?>   		
							<div class="modal fade" id="myModal<?php echo $r['formID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-body">
								      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
							      		<div class="row text-center">
								      		<div class="col-sm-12">
									  			<p id="titacabas"><strong>Agregar ISC <?php echo get_formato($r['formID']); ?>:</strong></p>
								      		</div>
							      		</div>
							      		<div class="row">
								  			<form method="post" action="ajax/graba-isc-formatos-catalogo.php" accept-charset="utf-8" class="formISCFormCat col-xs-12">
									  					  			
												<input type="hidden" name="camID" value="<?= $camID; ?>">
												<input type="hidden" name="catID" value="<?= $catID; ?>">
												<input type="hidden" name="formID" value="<?= $r['formID']; ?>">
												
												<div class="form-group">
													<?
														$formID = $r['formID'];
														$sql  = "select * from instores_campanas where formID = $formID";
													  	$instores_campanas = $db->rawQuery($sql);
														if($instores_campanas){
															foreach ($instores_campanas as $ic) {
																$ok = ISCxformatoxcatalogo($camID,$catID,$formID,$ic['inCaID']);
												    ?>   								
													<div class="checkbox">
													  <label>
													    <input type="checkbox" name="isc[]" value="<?php echo $ic['inCaID']; ?>" <? if($ok){ ?>checked<? } ?>>
													    <?php echo $ic['inCaNom']; ?>  <span class="medida"><small><?php echo $ic['inCaMed']; ?></small></span>
													  </label>
													</div>
												    <? 		} 
													    } ?>
													
												</div>
								  			
												<div class="form-group">
													<div class="col-xs-6 col-xs-offset-3">
														<button type="submit" class="btn btn-primary" data-posicion="" id="btnGrabaFormCat"><i class="fa fa-floppy-o"></i> Confirmar</button>
													</div>
												</div>
								  			</form>
							      		</div>
							      </div>
							    </div>
							  </div>
							</div>  							
						
					    <? 		} 
						    } 
						}
						?>					
					
					</div>

				</div>
				<div class="clear"></div>
		    </div>
   
	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'javascript:window.history.back();';		
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

			<!-- Modal Formatos -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
			      <div class="modal-body">
				      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
			      		<div class="row text-center">
				      		<div class="col-sm-12">
					  			<p id="titacabas"><strong>Agregar Formatos:</strong></p>
				      		</div>
			      		</div>
			      		<div class="row">
				  			<form method="post" action="ajax/graba-formatos-catalogo.php" accept-charset="utf-8" id="formFormCat" class="col-xs-12">
					  					  			
										<input type="hidden" name="camID" value="<?= $camID; ?>">
										<input type="hidden" name="catID" value="<?= $catID; ?>">
								
								<div class="form-group <?php echo $hide; ?>" id="formatos">
									<?
										$sql  = "select * from formatos where formID <> 9 order by formOrder";
									  	$resultado = $db->rawQuery($sql);
										if($resultado){
											foreach ($resultado as $r) {
												$ok = formatoxcatalogo($camID,$catID,$r['formID']);
								    ?>   								
									<div class="checkbox">
									  <label>
									    <input type="checkbox" name="formato[]" value="<?php echo $r['formID']; ?>" <? if($ok){ ?>checked<? } ?>>
									    <?php echo $r['formDesc']; ?>
									  </label>
									</div>
								    <? 		} 
									    } ?>
									
								</div>
				  			
								<div class="form-group">
									<div class="col-xs-8 col-xs-offset-2">
										<button type="submit" class="btn btn-primary" data-posicion="" id="btnGrabaFormCat"><i class="fa fa-floppy-o"></i> Confirmar</button>
									</div>
								</div>
				  			</form>
			      		</div>
			      </div>
			    </div>
			  </div>
			</div>  

   
<? include('footer.php'); ?>