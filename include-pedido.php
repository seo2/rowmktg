<?

	/*
		
		ESTADOS:
		
		Solicitado: 			0 // creado por VM
		Para revisión: 			1 // A la espera de MM
		Objetado:				2 // Rechazado por MM
		Aprobado:				3 // Aprobado por MM --> traspasado a Proveedor --> para cotizar
		
		Cotizado:				4 // Recibido por Proveedor, ingresó precio y envió a MM
		Cotizacion Aprobada: 	5 // Cotización aprobada por MM --> Proveedor debe ingresar precio
		Ongoing:   				6 // Proveedor compromete fecha de entrega
		
		Entregado:				7 // Entregado por Proveedor
		Finalizado:				8 // Recepcionado por VM
		
	*/	

	
?>


				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" id="peddet-<?= $r['ptdItem']; ?>" data-nom="<?= $piecita; ?>"  data-foto="<?= $r['ptdFoto']; ?>" data-com="<?= $r['ptdObs']; ?>" data-est="<?= $r['ptdEst']; ?>" data-usutipo="<?= $usuTipo; ?>" data-fecen="<?= $r['ptdFecEn']; ?>">
					<div class="row" style="margin-bottom:10px;">
						<div class="col-xs-6 posevento">
							<?= $pieza; ?>
						</div>
						
						<!-- BOTONES -->
						<div class="col-xs-6 text-right posvotos" data-estado="<?= $r['ptdEst']; ?>" style=" padding-right: 10px; padding-left: 0;">
							<? if($r['ptdEst']==1 && $usuTipo<=2){ ?>
								<a href="formulario-pedido_v2.php?ptID=<?= $r['ptID']; ?>&ptdItem=<?= $r['ptdItem']; ?>&tieID=<?= $tieID; ?>" class="btn btn-default" ><i class="fa fa-edit"></i></a>
								<a href="javascript:void(0);" class="btn btn-default btn-aprobar" style="margin-left:0;" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" ><i class="fa fa-check"></i></a>
							<? }elseif($r['ptdEst']==2 && $usuTipo<=2){ ?>
								<a href="javascript:void(0);" class="btn btn-default btn-aprobar" style="margin-left:0;" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" ><i class="fa fa-check"></i></a>
							<? }elseif($r['ptdEst']==3 && $usuTipo>=4){ ?>
								<a href="javascript:void(0);" class="btn btn-success btn-cotizar" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" ><i class="fa fa-money"></i></a>
							<? }elseif($r['ptdEst']==0){ ?>	
								<a href="formulario-pedido_v2.php?ptID=<?= $r['ptID']; ?>&ptdItem=<?= $r['ptdItem']; ?>&tieID=<?= $tieID; ?>" class="btn btn-default" ><i class="fa fa-edit"></i></a>
								<a href="javascript:void(0);" class="btn btn-danger btn-eliminar" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" ><i class="fa fa-times"></i></a>
							<? }elseif($r['ptdEst']==4 && $usuTipo<=2){ ?>
								<a href="javascript:void(0);" class="btn btn-default btn-aprobarcot" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" ><i class="fa fa-check-square-o"></i></a>
								<a href="javascript:void(0);" class="btn btn-danger  btn-rechazarcot" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" data-vm="<?= $r['ptdVM']; ?>" ><i class="fa fa-times"></i></a>
							<? }elseif(($r['ptdEst']==7 && $usuTipo==3 && $r['ptdVM'] == $usuID) || ($r['ptdEst']==7 && $usuTipo<3)){ ?>
								<a href="javascript:void(0);" class="btn btn-default btn-recibir btnfinaliza" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" ><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
							<? }elseif($r['ptdEst']==7 && $usuTipo==2 && $pieEnt == 1){ ?>
								<a href="javascript:void(0);" class="btn btn-default btn-recibir btnfinaliza" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" ><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
							<? } ?>
							<? if($r['ptdEst']>0 && $r['ptdEst']<=5 && $usuTipo<=2){ ?>
								<a href="javascript:void(0);" class="btn btn-danger  btn-rechazar" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" data-vm="<?= $r['ptdVM']; ?>" ><i class="fa fa-trash"></i></a>
							<? } ?>
						</div>
					</div>
					<div class="row">
						<!-- DETALLE -->
						<div class="col-xs-6 posevento">
							<span class="<?= $clase; ?>"><?= $estado; ?></span><br>
							<span><? if($r['ptdEst']==7){ ?><i class="fa fa-arrow-circle-right blue" aria-hidden="true"></i> <? } ?><? if($paisID==7){ ?>Quantidade<? }else{ ?>Cantidad<? } ?>: <strong><?= $r['ptdCan']; ?></strong> 
							<? if($r['ptdAlerta']){ ?>
								<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>
							<? } ?> </span>
							<br><span><?= $fecha; ?> <?= $hora; ?></span> 
						</div>
						
						<div class="col-xs-6 posevento">
							<span><? if($r['ptdEst']==7){ ?><i class="fa fa-arrow-circle-right blue" aria-hidden="true"></i> <? } ?>VM: <strong><?= get_user_nombre($r['ptdVM']); ?></strong></span>
							<br><span><? if($r['ptdEst']==1 || $r['ptdEst']==4){ ?><i class="fa fa-arrow-circle-right blue" aria-hidden="true"></i> <? } ?>RM: <strong><?= get_user_nombre($r['ptdRes']); ?></strong></span>
							<? if($r['ptdProv']>0 && $r['ptdEst']>2){ ?>
							<br><span><? if($r['ptdEst']==3 || $r['ptdEst']==5 || $r['ptdEst']==6){ ?><i class="fa fa-arrow-circle-right blue" aria-hidden="true"></i> <? } ?><? if($paisID==7){ ?>Forn.<? }else{ ?>Prov.<? } ?>: <strong><?= get_proveedor_nombre($r['ptdProv']); ?></strong></span>
							<? } ?>
							<? if($r['ptdEst']>=6){ ?>
							<br><span><? if($paisID==7){ ?>Data de entrega<? }else{ ?>Fecha de Entrega<? } ?>: <strong><?= $fecen; ?></strong></span> 
							<? } ?>
							<? if($r['ptdEst']>=7){ ?>
							<br><span><? if($paisID==7){ ?>Recebido por<? }else{ ?>Recibido por<? } ?>: <strong><?= $r['ptdRecibe']; ?></strong></span> 
							<? } ?>
						</div>
					</div>	
					
					<? if($usuTipo<=2 && $r['ptdEst']<3){ ?>
					<div class="row" id="provselect">
						<div class="col-xs-12 posevento">
							<span><? if($paisID==7){ ?>Fornecedor<? }else{ ?>Proveedor<? } ?>:</span>
							<div class="form-group">
								<select class="form-control pedProv" name="pieProv" required id="pedProv" data-paisid="<?php echo $paisID; ?>" data-ptid="<?php echo $r['ptID']; ?>" data-ptditem="<?php echo $r['ptdItem']; ?>">
									<option value=""><? if($paisID==7){ ?>Selecionar fornecedor<? }else{ ?>Seleccione Proveedor<? } ?></option>
									<?
									$tema = $db->rawQuery('select * from proveedores where paisID = '.$paisID.' and provEst = 0');
									if($tema){
										foreach ($tema as $t) {
									?>
									<option value="<?= $t['provID']; ?>" <? if($r['ptdProv']== $t['provID']){ ?>selected<? } ?>><?= $t['provNom']; ?></option>
									<?		
										}
									}
									?>
								</select>	
							</div>
						</div>
					</div>					
					<? } ?>
					<div class="row">
						<div class="col-xs-12 posevento">
							<? if($r['ptdObs']){ ?>
							<span><? if($paisID==7){ ?>Observação<? }else{ ?>Observación<? } ?>:</span>
							<br><span><strong><?= $r['ptdObs']; ?></strong></span> 
							<? } ?>
						</div>
					</div>
					
					<div class="row">	
						<? if($r['ptdValor']){ ?>
						<div class="clear"></div>
						<div class="col-xs-6 posevento pull-right">
							<span>Valor: <strong><small><?php echo $currency; ?></small> <?= number_format($r['ptdValor'],0,',','.'); ?></strong></span> 
						</div>
						
						<? } ?>
						
						<div class="clear"></div>
						
						<!-- FOTOS -->
						
						
						<? if($r['ptdFotoFinal']){
							$colfotos = 4;	
						}else{
							$colfotos = 6;
						}?>

						<? if($r['ptdCat']>0){
							if($r['ptdISC']=='fw2017'){
								$camID   = $r['ptdGraOp'];
								$camfile = get_foto_campana_v2($camID, $r['ptdCat']);
								$camfile = str_replace('../', '', $camfile) ;
							}else{
								$camfile = get_foto_campana($r['ptdCat']);
								$camfile = str_replace('../', '', $camfile) ;
							}
						?>
						<div class="col-xs-<?= $colfotos; ?> posevento fotospedido">
							<span>Catálogo:</span> 
							<a href="javascript:void(0);" class="pedfoto" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" data-foto="<?= $camfile; ?>" data-titulo="Catálogo" >
								<img src="resize2.php?img=<?= $camfile; ?>&width=300&height=300&mode=fit" class="img-responsive">
							</a>	
						</div>
						<? }else{
							
							$camfile = $r['ptdISC'];
							if($camfile){
						?>
						<div class="col-xs-<?= $colfotos; ?> posevento fotospedido">
							<span>ISC:</span> 
							<a href="javascript:void(0);" class="pedfoto" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" data-foto="<?= $camfile; ?>" data-titulo="Catálogo" >
								<img src="resize2.php?img=<?= $camfile; ?>&width=300&height=300&mode=fit" class="img-responsive">
							</a>	
						</div>
						<? 		}
							} ?>
						<? if($r['ptdFoto']){?>	
						<div class="col-xs-<?= $colfotos; ?> posevento fotospedido">
							<span>Foto:</span> 
							<a href="javascript:void(0);" class="pedfoto" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" data-foto="ajax/uploads/<?= $r['ptdFoto']; ?>" data-titulo="Foto"  >
								<img src="resize3.php?img=ajax/uploads/<?= $r['ptdFoto']; ?>&width=300&height=300&mode=fit" class="img-responsive">	
							</a>
						</div>
						<? } ?>
						<? if($r['ptdFotoFinal']){?>	
						<div class="col-xs-<?= $colfotos; ?> posevento fotospedido">
							<span><? if($paisID==7){ ?>Nota do tranporte<? }else{ ?>Guía de Despacho<? } ?>:</span> 
							<a href="ajax/uploads/<?= $r['ptdFotoFinal']; ?>" target="_blank" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" data-foto="ajax/uploads/<?= $r['ptdFotoFinal']; ?>" data-titulo="Foto"  >
								<img src="resize3.php?img=ajax/uploads/<?= $r['ptdFotoFinal']; ?>&width=300&height=300&mode=fit" class="img-responsive">	
							</a>
						</div>
						<? } ?>
						<? if($r['ptdEst']>2){ ?>
						<!-- Fotos Adjuntas -->
						<div class="clearfix"></div>
						<div class="col-lg-12">
							<div class="row" id="fotitos">
						<?
						$ptditem = $r['ptdItem'];	
							
						$sql2  	= "select * from pedido_fotos where paisID = $paisID and ptID = $ptID and ptdItem = $ptditem";
						$c 		= 1;
					  	$resultado2 = $db->rawQuery($sql2);
						if($resultado2){
							foreach ($resultado2 as $r2) {
								
								$fecha2 = substr($r2['ptoTS'],8,2) . '/'. substr($r2['ptoTS'],5,2) .'/'. substr($r2['ptoTS'],0,4);
								$hora2  = substr($r2['ptoTS'],11,8);

		?>
						<div class="col-xs-3 posevento fotospedido">
							<a href="javascript:void(0);" class="pedfoto" data-ptid="<?= $ptID; ?>"  data-ptditem="<?= $ptditem; ?>" data-foto="ajax/uploads/<?= $r2['ptoFoto']; ?>" data-titulo="Foto"  >
								<img src="resize3.php?img=ajax/uploads/<?= $r2['ptoFoto']; ?>&width=200&height=200&mode=fit" class="img-responsive">	
							</a>
						</div>
		<?					
				    
				     		} 
					    }	
		?>
							</div>
						</div>
						
						<div class="clear"></div>

						<!-- COMENTARIOS -->
						<div class="col-lg-12">
							<div class="row" id="comentarios">
						<?
						$ptditem 	= $r['ptdItem'];	
						$sql2		= "select * from pedido_archivos where paisID = $paisID and ptID = $ptID and ptdItem = $ptditem";
						$c 			= 1;
						$i = 0;
					  	$resultado2 = $db->rawQuery($sql2);
						if($resultado2){
							foreach ($resultado2 as $r2) {
								$i++;
								$fecha2 = substr($r2['ptoTS'],8,2) . '/'. substr($r2['ptoTS'],5,2) .'/'. substr($r2['ptoTS'],0,4);
								$hora2  = substr($r2['ptoTS'],11,8);
								if($c==1){
									$class = 'claro'; 
									$c = 2;
								}else{
									$class = 'oscuro';
									$c = 1;
								}
								if($i==1){
						?>
							<div class="col-lg-12">
								<span><strong><? if($paisID==7){ ?>Arquivos<? }else{ ?>Archivos<? } ?>:</strong></span> 
							</div>
						<?			
								}
						?>
							<div class="col-lg-12 <?= $class; ?>" style="padding-bottom:10px; padding-top:10px;">
								<div class="row">
									<div class="col-xs-9">
										<p><strong class="text-primary"><?= $r2['ptoDesc']; ?></strong> [<?php echo $r2['ptoExt']; ?>]<br>
										<small>Subido por <?= get_user_nombre($r2['ptoUsu']); ?> <?php echo $fecha2; ?> <?php echo $hora2; ?></small></p>
									</div>
									<div class="col-xs-3 text-right">
										<a href="ajax/uploads/<?php echo $r2['ptoFile']; ?>" class="btn-sm btn-default" target="_blank" ><i class="fa fa-download" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
						<?					
				     		} 
					    }	
						?>
							</div>
						</div>		
						
						<div class="clear"></div>				
						<div class="col-lg-12">
							<div class="row text-right">
								<div class="col-lg-12">
									<? if($r['ptdEst']>4){ ?>
									<a href="javascript:void();" class="btn-sm btn-default btnFotos" data-ptditem="<?= $ptditem; ?>"><? if($paisID==7){ ?>Adicionar foto<? }else{ ?>Agregar Foto<? } ?> <i class="fa fa-camera" aria-hidden="true"></i></a>
									<? } ?>
									<a href="javascript:void(0);" class="btn-sm btn-default btnadjuntar" data-ptditem="<?= $ptditem; ?>"><? if($paisID==7){ ?>Anexar arquivo<? }else{ ?>Adjuntar archivo<? } ?> <i class="fa fa-paperclip" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
						<? } ?>
						<div class="clear"></div>
						<!-- COMENTARIOS -->
						<div class="col-lg-12">
							<div class="row" id="comentarios">
						<?
						$ptditem 	= $r['ptdItem'];	
						$sql2		= "select * from pedido_observaciones where paisID = $paisID and ptID = $ptID and ptdItem = $ptditem";
						$c 			= 1;
						$i = 0;
					  	$resultado2 = $db->rawQuery($sql2);
						if($resultado2){
							foreach ($resultado2 as $r2) {
								$i++;
								$fecha2 = substr($r2['ptoTS'],8,2) . '/'. substr($r2['ptoTS'],5,2) .'/'. substr($r2['ptoTS'],0,4);
								$hora2  = substr($r2['ptoTS'],11,8);
								if($c==1){
									$class = 'claro'; 
									$c = 2;
								}else{
									$class = 'oscuro';
									$c = 1;
								}
								if($i==1){
						?>
							<div class="col-lg-12">
								<span><strong><? if($paisID==7){ ?>Comentários<? }else{ ?>Comentarios<? } ?>:</strong></span> 
							</div>
						<?			
								}
						?>
								<div class="col-lg-12 <?= $class; ?>">
									<p><strong class="text-primary"><?= get_user_nombre($r2['ptoUsu']); ?></strong> <small><?= get_tipo_usuario_desc(get_usertipo($r2['ptoUsu'])); ?></small></p>
									<p><?= $r2['ptoObs']; ?></p>
									<small><?= $fecha2; ?> <?= $hora2; ?></small>
								</div>
						<?					
				     		} 
					    }	
						?>
							</div>
							<div class="row text-right">
								<div class="col-lg-12">
									<a href="javascript:void(0);" class="btn btn-default btncomentar" data-ptditem="<?= $ptditem; ?>">Comentar <i class="fa fa-comments" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
						
						
					</div>

				</div>