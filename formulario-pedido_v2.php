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
	
	$tieID 		= $_GET['tieID'];
	$ptdAlerta	= 0;
	
	if($_GET['ptID'] && $_GET['ptdItem'] ){
		$ptID 	 = $_GET['ptID'];
		$ptdItem = $_GET['ptdItem'];
		$sql  = "select * from pedido_temporal_detalle where paisID = $paisID and ptID = $ptID and ptdItem = $ptdItem";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$ptdGra		= $r['ptdGra'];
				$ptdGraOp	= $r['ptdGraOp'];
				$ptdProv	= $r['ptdProv'];
				$ptdCat		= $r['ptdCat'];
				$ptdCan		= $r['ptdCan'];
				$ptdObs		= $r['ptdObs'];
				$ptdFoto	= $r['ptdFoto'];
				$ptdAlerta	= $r['ptdAlerta'];
				$ptdISC     = $r['ptdISC'];
	 		} 
	    }	
	    	
	    if($paisID==7){
			$accion = "Editar";
	    }else{
			$accion = "Modificar";
	    } 
	}else{
		$ptID 		= get_pedido_temporal($tieID);
	    if($paisID==7){
			$accion = "Adicionar";
	    }else{
			$accion = "Agregar";
	    } 
	}
	
		$formato 	= get_formato_tienda($tieID);
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span><?= $accion; ?> Item</span>
	    </header>

		    <div id="cajaposiciones" data-eveID="<?= $eveID; ?>" data-tiendaID="<?= $tieID; ?>">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    	<h2><?= get_tienda($tieID); ?> <small><?php echo get_formato(get_formato_tienda($tieID)); ?></small></h2>
			    </div>
 
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" id="vit-<?= $r['vitID']; ?>" data-nom="<?= $r['vitNom']; ?>"  data-foto="<?= $r['vitFoto']; ?>" data-com="<?= $r['vitDes']; ?>">
					<div class="row">
						
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="tipoPedido">Tipo de <? if($paisID==7){ ?>ordem<? }else{ ?>pedido<? } ?>:</label>
									<? if(!$_GET['ptID'] && !$_GET['ptdItem']){ ?>
										<select class="form-control" name="tipoPedido" required id="tipoPedido">
											<option value=""><? if($paisID==7){ ?>Selecionar<? }else{ ?>Seleccione<? } ?></option>
											<option value="1">ISC Long Term</option>
											<option value="2">ISC de <? if($paisID==7){ ?>Campanhas<? }else{ ?>Campañas<? } ?></option>
										</select>
									<?  	
											$hide1 = 'class="hide"';
											$hide2 = 'class="hide"';
										}else{ 
											$hide1 = '';
											$hide2 = 'class="hide"';
											
											if($ptdISC=='fw2017'){ ?>
											<input class="form-control" type="text" name="tipo" value="ISC de <? if($paisID==7){ ?>Campanhas<? }else{ ?>Campañas<? } ?>" disabled>
										<? }else{ ?>
											<input class="form-control" type="text" name="tipo" value="ISC Long Term" disabled>
										<? } ?>
									<? 	} ?>
									</div>
								</div>
							</div>
						</div>
						<? if($ptdISC=='fw2017'){ ?>
						<form action="ajax/graba-pedido-campana.php" method="post" accept-charset="utf-8" id="agrega-pedido" <?php echo $hide1; ?>>
							<input type="hidden" name="ptVM" 						value="<?= $usuID; ?>">
							<input type="hidden" name="paisID" 		id="paisID" 	value="<?= $paisID; ?>">
							<input type="hidden" name="ptTie" 		id="ptTie" 		value="<?= $tieID; ?>">
							<input type="hidden" name="formID" 		id="formID" 	value="<?= $formato; ?>">
							<input type="hidden" name="ptdAlerta" 	id="ptdAlerta" 	value="<?= $ptdAlerta; ?>">
							<input type="hidden" name="ptdFoto" 					value="<?= $ptdFoto; ?>">
							<? if($_GET['ptID'] && $_GET['ptdItem']){ ?>
							<input type="hidden" name="ptID" 						value="<?= $ptID; ?>">
							<input type="hidden" name="ptdItem" 					value="<?= $ptdItem; ?>">
							<? } ?>
							<div class="form-group">
								<label><? if($paisID==7){ ?>Catálogo<? }else{ ?>Catálogo<? } ?>:</label>
								<input class="form-control" type="text" name="campana" value="<?php echo get_campana_desc_v2($ptdGraOp); ?>" disabled>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="catalogo" value="<?php echo get_desc_campana_v2($ptdGraOp, $ptdCat); ?>" disabled>
							</div>							
							<?php 
							if($r['ptdISC']=='fw2017'){
								$camfile = get_foto_campana_v2($ptdGraOp, $ptdCat);
								$camfile = str_replace('../', '', $camfile) ;
							}else{
								$camfile = get_foto_campana($r['ptdCat']);
								$camfile = str_replace('../', '', $camfile) ;
							}
							?>	
							<div class="row">
								<div class="col-xs-12">
						    		<div id="fotito2">
						    			<img src="<?php echo $camfile; ?>" class="img-responsive" id="fotocatalogo" >
						    			<input type="hidden" name="isc" id="isc" value="<?php echo $ptdISC; ?>">
						    		</div>
						    	</div>	
							</div>						
							<div class="form-group">
								<label for="ptdGra">Instore:</label>
								<select class="form-control" name="ptdGra" required id="ptdGra2" data-formato="<?php echo $formato; ?>" disabled>
									<option value=""><? if($paisID==7){ ?>Selecionar<? }else{ ?>Seleccione<? } ?></option>
									<?php
										$formID = $r['formID'];
										$sql  	= "select * from catalogo_x_formato_x_ISC where camID = $ptdGraOp and catID = $ptdCat and formID = $formato";
									  	$resultado = $db->rawQuery($sql);
										if($resultado){
											foreach ($resultado as $ic) {
												$i++;
												
									?>  
									<option value="<?= $ic['iscID']; ?>" <? if($ic['iscID']==$ptdGra){ ?>selected<? } ?>><?php echo get_isc_camp($formato,$ptdGra); ?> - <?php echo get_isc_med($formato,$ptdGra); ?></option>
									<?		
											}
										}
									?>
								</select>
							</div>
							<hr>
							<div class="row" id="lacantidad">
								<div class="form-group col-xs-6">
									<label class="ptdCan"><? if($paisID==7){ ?>Quantidade<? }else{ ?>Cantidad<? } ?>:</label>
									<input type="number" class="form-control" id="ptdCan" placeholder="<? if($paisID==7){ ?>Quantidade<? }else{ ?>Cantidad<? } ?>" name="ptdCan" required min="1" value="<?= $ptdCan; ?>">
								</div>
							</div>

							<div class="form-group">
							<label><? if($paisID==7){ ?>Obs<? }else{ ?>Observación<? } ?>:</label>
							<textarea  class="form-control" placeholder="<? if($paisID==7){ ?>Obs<? }else{ ?>Observación<? } ?>" name="ptdObs" id="ptdObs"><?= $ptdObs; ?></textarea>
						</div>	
							
						<? if($ptdFoto){ ?>
							<div class="form-group">
						    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
									<input type="file" id="uploadFoto" name="foto">
						    	</div>
							</div>
							<div class="form-group">
					    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
									<i class="fa fa-camera"></i> <? if($paisID==7){ ?>Alterar<? }else{ ?>Cambiar<? } ?> Foto
								</button>
							</div>		
							<div class="row">
								<div class="col-xs-offset-3 col-xs-6">
						    		<div id="fotito">
						    			<img src="resize3.php?img=ajax/uploads/<?= $ptdFoto; ?>&width=640&height=640&mode=fit" class="img-responsive" id="fotoperfil" >
						    		</div>
						    	</div>	
							</div>	
						<? }else{?>
							<div class="form-group">
						    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
									<input type="file" id="uploadFoto" name="foto">
						    	</div>
							</div>
							<div class="form-group">
					    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
									<i class="fa fa-camera"></i> <? if($paisID==7){ ?>Adicionar<? }else{ ?>Agregar<? } ?> Foto
								</button>
							</div>		
							<div class="row">
								<div class="col-xs-offset-3 col-xs-6">
						    		<div id="fotito" style="display:none;">
						    			<img src="" class="img-responsive" id="fotoperfil" >
						    		</div>
						    	</div>	
							</div>	
						<? }?>		
							<hr>
							<div class="form-group text-right">
					    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
						</div>
						</form> <!-- fin form pedido ISC Long Term -->
						<? }else{ ?>
						<form action="ajax/graba-pedido.php" method="post" accept-charset="utf-8" id="agrega-pedido" <?php echo $hide1; ?>>
							<input type="hidden" name="ptVM" 						value="<?= $usuID; ?>">
							<input type="hidden" name="paisID" 		id="paisID" 	value="<?= $paisID; ?>">
							<input type="hidden" name="ptTie" 		id="ptTie" 		value="<?= $tieID; ?>">
							<input type="hidden" name="formID" 		id="formID" 	value="<?= $formato; ?>">
							<input type="hidden" name="ptdAlerta" 	id="ptdAlerta" 	value="<?= $ptdAlerta; ?>">
							<input type="hidden" name="ptdFoto" 					value="<?= $ptdFoto; ?>">
							<? if($_GET['ptID'] && $_GET['ptdItem']){ ?>
							<input type="hidden" name="ptID" 						value="<?= $ptID; ?>">
							<input type="hidden" name="ptdItem" 					value="<?= $ptdItem; ?>">
							<? } ?>
							<div class="form-group">
								<label for="ptdGra">Instore:</label>
								<select class="form-control" name="ptdGra" required id="ptdGra2" data-formato="<?php echo $formato; ?>">
									<option value=""><? if($paisID==7){ ?>Selecionar<? }else{ ?>Seleccione<? } ?></option>
									<?
									$tema = $db->rawQuery('select * from instores_v2 where formID = '.$formato.' order by insNomGen');
									if($tema){
										foreach ($tema as $t) {
											$insID 		= $t['insID'];
											$instore 	= $t['insNomGen'].' - '.get_instore_nom_x_pais_v2($paisID, $formato, $insID);
											
									?>
									<option value="<?= $t['insID']; ?>" <? if($t['insID']==$ptdGra){ ?>selected<? } ?>><?php echo $instore; ?></option>
									<?		
										}
									}
									?>
								</select>
							</div>
							
						<? if($_GET['ptID'] && $_GET['ptdItem'] && $ptdGraOp > 0){?>
							<div class="form-group" id="opcionesgra">
								<label><? if($paisID==7){ ?>Opções<? }else{ ?>Opciones<? } ?> instore:</label>
								<select class="form-control" name="ptdGraOp" id="ptdGraOp2" required>
									<?
									$tema = $db->rawQuery('select * from instores_opciones_v2 where  formID = '.$formato.' and insID = '.$ptdGra);
									if($tema){
										foreach ($tema as $t) {
									?>							
									<option value="<?= $t['insOpID']; ?>" <? if($t['insOpID']==$ptdGraOp){ ?>selected<? } ?>><?= $t['insOpNom']; ?></option>
									<?		
										}
									}
									?>
								</select>
							</div>
						<? }else{ ?>
							<div class="form-group" id="opcionesgra" style="display:none;">
								<label><? if($paisID==7){ ?>Opções<? }else{ ?>Opciones<? } ?> instore:</label>
								<select class="form-control" name="ptdGraOp" id="ptdGraOp2" required>
									<option value="">-</option>
								</select>
							</div>
						<? } ?>
						
						<? if($_GET['ptID'] && $_GET['ptdItem'] && $ptdCat == 0){ ?>	
							<div class="row">
								<div class="col-xs-12">
						    		<div id="fotito2">
						    			<img src="<?php echo $ptdISC; ?>" class="img-responsive" id="fotocatalogo" >
						    			<input type="hidden" name="isc" id="isc" value="<?php echo $ptdISC; ?>">
						    		</div>
						    	</div>	
							</div>
						<? }else{ ?>	
							<div class="row">
								<div class="col-xs-12">
						    		<div id="fotito2"  style="display:none;">
						    			<img src="" class="img-responsive" id="fotocatalogo" >
						    			<input type="hidden" name="isc" id="isc">
						    		</div>
						    	</div>	
							</div>
						<? } ?>
							<hr>
							<div class="row" id="lacantidad">
								<div class="form-group col-xs-6">
									<label class="ptdCan"><? if($paisID==7){ ?>Quantidade<? }else{ ?>Cantidad<? } ?>:</label>
									<input type="number" class="form-control" id="ptdCan" placeholder="<? if($paisID==7){ ?>Quantidade<? }else{ ?>Cantidad<? } ?>" name="ptdCan" required min="1" value="<?= $ptdCan; ?>">
								</div>
							</div>

							<div class="form-group">
							<label><? if($paisID==7){ ?>Obs<? }else{ ?>Observación<? } ?>:</label>
							<textarea  class="form-control" placeholder="<? if($paisID==7){ ?>Obs<? }else{ ?>Observación<? } ?>" name="ptdObs" id="ptdObs"><?= $ptdObs; ?></textarea>
						</div>	
							
						<? if($ptdFoto){ ?>
							<div class="form-group">
						    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
									<input type="file" id="uploadFoto" name="foto">
						    	</div>
							</div>
							<div class="form-group">
					    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
									<i class="fa fa-camera"></i> <? if($paisID==7){ ?>Alterar<? }else{ ?>Cambiar<? } ?> Foto
								</button>
							</div>		
							<div class="row">
								<div class="col-xs-offset-3 col-xs-6">
						    		<div id="fotito">
						    			<img src="resize3.php?img=ajax/uploads/<?= $ptdFoto; ?>&width=640&height=640&mode=fit" class="img-responsive" id="fotoperfil" >
						    		</div>
						    	</div>	
							</div>	
						<? }else{?>
							<div class="form-group">
						    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
									<input type="file" id="uploadFoto" name="foto">
						    	</div>
							</div>
							<div class="form-group">
					    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
									<i class="fa fa-camera"></i> <? if($paisID==7){ ?>Adicionar<? }else{ ?>Agregar<? } ?> Foto
								</button>
							</div>		
							<div class="row">
								<div class="col-xs-offset-3 col-xs-6">
						    		<div id="fotito" style="display:none;">
						    			<img src="" class="img-responsive" id="fotoperfil" >
						    		</div>
						    	</div>	
							</div>	
						<? }?>		
							<hr>
							<div class="form-group text-right">
					    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
						</div>
						</form> <!-- fin form pedido ISC Long Term -->
						<? } ?>
						<form action="ajax/graba-pedido-campana.php" method="post" accept-charset="utf-8" id="agrega-pedido_v2" <?php echo $hide2; ?>>

							<input type="hidden" name="ptVM" 						value="<?= $usuID; ?>">
							<input type="hidden" name="paisID" 		id="paisID2" 	value="<?= $paisID; ?>">
							<input type="hidden" name="ptTie" 		id="ptTie2" 	value="<?= $tieID; ?>">
							<input type="hidden" name="formID" 		id="formID2" 	value="<?= $formato; ?>">
							<input type="hidden" name="ptdAlerta" 	id="ptdAlerta2" value="<?= $ptdAlerta; ?>">
						<? if($_GET['ptID'] && $_GET['ptdItem']){ ?>
							<input type="hidden" name="ptID" 						value="<?= $ptID; ?>">
							<input type="hidden" name="ptdItem" 					value="<?= $ptdItem; ?>">
						<? } ?>

						<div class="form-group">
							<label><? if($paisID==7){ ?>Selecionar de catálogo<? }else{ ?>Seleccionar del Catálogo<? } ?>:</label>
							<select class="form-control" name="camID" required id="camID">
								<option value=""><? if($paisID==7){ ?>Selecionar<? }else{ ?>Seleccione<? } ?></option>
								<?
								$tema = $db->rawQuery('select * from campana_v2 where camEst = 0');
								if($tema){
									foreach ($tema as $t) {
										$ok = ask_pais_campana_v2( $t['camID'],$paisID);
										if($ok==1){
								?>
								<option value="<?= $t['camID']; ?>"><?= $t['camDesc']; ?></option>
								<?		}
									}
								}
								?>
							</select>
						</div>
						<div id="myDropdown" class="col-xs-12"></div>
						<input type="hidden" name="ptdCat" id="ptdCat">
						
						<div id="aca_va">
							
						</div>
						
						<hr>
						

						<div class="form-group">
							<label><? if($paisID==7){ ?>Obs<? }else{ ?>Observación<? } ?>:</label>
							<textarea  class="form-control" placeholder="<? if($paisID==7){ ?>Obs<? }else{ ?>Observación<? } ?>" name="ptdObs" id="ptdObs"><?= $ptdObs; ?></textarea>
						</div>	
						<input type="hidden" name="ptdFoto" value="<?= $ptdFoto; ?>">
						<? if($ptdFoto){ ?>
						<!--
<div class="form-group">
					    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
								<input type="file" id="uploadFoto" name="foto">
					    	</div>
						</div>
						<div class="form-group">
				    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
								<i class="fa fa-camera"></i> <? if($paisID==7){ ?>Alterar<? }else{ ?>Cambiar<? } ?> Foto
							</button>
						</div>		
						<div class="row">
							<div class="col-xs-offset-3 col-xs-6">
					    		<div id="fotito">
					    			<img src="resize3.php?img=ajax/uploads/<?= $ptdFoto; ?>&width=640&height=640&mode=fit" class="img-responsive" id="fotoperfil" >
					    		</div>
					    	</div>	
						</div>	
-->
						<? }else{?>
						<!--
<div class="form-group">
					    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
								<input type="file" id="uploadFoto" name="foto">
					    	</div>
						</div>
						<div class="form-group">
				    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
								<i class="fa fa-camera"></i> <? if($paisID==7){ ?>Adicionar<? }else{ ?>Agregar<? } ?> Foto
							</button>
						</div>		
						<div class="row">
							<div class="col-xs-offset-3 col-xs-6">
					    		<div id="fotito" style="display:none;">
					    			<img src="" class="img-responsive" id="fotoperfil" >
					    		</div>
					    	</div>	
						</div>	
-->
							
						<? }?>		
						<hr>
						<div class="form-group text-right">
					    	<button type="submit" class="btn btn-primary" id="btngrabar2"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
						</div>
						
					</form>
					
					
					</div><!-- fin row -->

				</div><!-- fin caja posicion -->
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
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> <? if($paisID==7){ ?>Sair<? }else{ ?>Salir<? } ?></a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>		    

<? include('footer.php'); ?>

<? if($_GET['ptID'] && $_GET['ptdItem'] && $ptdCat > 0){ ?>
<script>
	<?
	$i = 0;
	$tema = $db->rawQuery('select * from catalogo where camID = '.$camID);
	if($tema){
		foreach ($tema as $t) {
			if($t['catID']==$ptdCat){
				$index = $i;	
			}
				
			$i++;
		}
	}
	echo $index;
	?>	
	console.log('index: <?= $index; ?> ');
	GetCatalogo2(<?= $camID; ?>,<?= $index; ?>  );
	 

function GetCatalogo2(camID,clander) {
  if (camID > 0) {
 	    $.ajax({
            type: "POST",
            url: "ajax/catalogo_v2.php",
            data: { "camID": camID },
			success: function(msg) {
            	console.log(msg);

				$('#myDropdown').ddslick({
				    data:msg.ddData,
				    defaultSelectedIndex:clander,
				    height:300,
				    selectText: "Elige el item del catálogo",
				    imagePosition:"right",
				    onSelected: function(selectedData){
					    console.log(selectedData);
					    console.log(selectedData.selectedData.value);
				        $('#ptdCat').val(selectedData.selectedData.value);
						include = 'include-isc-campana.php?camID='+camID+'&catID='+selectedData.selectedData.value;
						
						$.post(include, function(data) {
							pines = $(data).find("#isc_camp");
							console.log(pines);
							$('#aca_va').append( $(pines).hide().fadeIn(2000));
				    	});			        
				        
				        
				        
				    }   
				});

            },
            error: function(xhr, status, error) {
				//alert(status);
        	}
        });
    }else{
        $("#ptdGraOp2").get(0).options.length = 0;
    }
}	 
	 
	 
</script>
<? } ?>