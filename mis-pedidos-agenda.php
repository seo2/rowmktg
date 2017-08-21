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
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span><? if($paisID==7){ ?>Meus pedidos<? }else{ ?>Mis Pedidos<? } ?></span>
	    </header>

		    <div id="cajaposiciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-8">
							<h2>Agenda de Entregas</h2> 
				    	</div>
				    </div>
			    </div>
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

		
					if($usuTipo==1){ // administrador
						$sql  = "SELECT ptdFecEn  FROM pedido_temporal_detalle WHERE ptdEst = 6 and paisID = $paisID GROUP BY ptdFecEn order by ptdFecEn ASC";
					}elseif($usuTipo==2){ // Retail MKTG
						$sql  = "SELECT ptdFecEn FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 6 and ptdRes = $usuID GROUP BY ptdFecEn order by ptdFecEn ASC";
					}elseif($usuTipo==3){ // VM
						$sql  = "SELECT  ptdFecEn FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 6 and ptdVM = $usuID GROUP BY ptdFecEn order by ptdFecEn ASC";
					}else{ // Proveedor
						$ptdProv = get_proveedor_usuario($usuID);
						$sql  = "SELECT  ptdFecEn FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 6 and ptdProv = $ptdProv GROUP BY ptdFecEn order by ptdFecEn ASC";
					}
				$i = 0;
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r1) {
						
						$ptdFecEn =  $r1['ptdFecEn'];
						$fecha   = substr($ptdFecEn,8,2) . '/'. substr($ptdFecEn,5,2) .'/'. substr($ptdFecEn,0,4);
/*
						$ptTS  = get_pedido_fecha_proceso( $r['ptID']);
						$fecha = substr($ptTS,8,2) . '/'. substr($ptTS,5,2) .'/'. substr($ptTS,0,4);
						$hora  = substr($ptTS,11,8);
*/
						$i++;
		    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-lg-12 fechaentrega">
							<strong><?=  $fecha; ?> </strong>
						</div>
<?
				if($usuTipo==1){ // administrador
					$sql2  = "SELECT *  FROM pedido_temporal_detalle WHERE ptdFecEn = '$ptdFecEn' and paisID = $paisID and  ptdEst = 6 and ptdEst <> 2";
				}elseif($usuTipo==2){ // Retail MKTG
					$sql2  = "SELECT * FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdRes = $usuID and ptdFecEn = '$ptdFecEn' and  ptdEst = 6 and ptdEst <> 2";
				}elseif($usuTipo==3){ // VM
					$sql2  = "SELECT * FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdVM = $usuID and ptdFecEn = '$ptdFecEn'  and ptdEst = 6 and ptdEst <> 2";
				}else{ // Proveedor
					$sql2  = "SELECT * FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdProv = $ptdProv and ptdFecEn = '$ptdFecEn'  and  ptdEst = 6 and ptdEst <> 2";
				}	
				
				$resultado2 = $db->rawQuery($sql2);
				if($resultado2){
					foreach ($resultado2 as $r) {
						
						$fecha = substr($r['ptdTS'],8,2) . '/'. substr($r['ptdTS'],5,2) .'/'. substr($r['ptdTS'],0,4);
						$hora  = substr($r['ptdTS'],11,8);
						
						if($paisID==1 && $ptID <= 511){
							$pieza_opc_desc = get_pieza_opc_desc($r['ptdGra'],$r['ptdGraOp']); 
								
							if($pieza_opc_desc=='-' || $pieza_opc_desc=='Error'){
								$pieza = get_pieza_desc($r['ptdGra']);
							}else{
								$pieza = get_pieza_desc($r['ptdGra']) . ' [' . $pieza_opc_desc . '] ';
							}
						}else{

							$pieza_opc_desc = get_instore_opc_desc($r['formID'], $r['ptdGra'], $r['ptdGraOp']);
							
							if($pieza_opc_desc=='-' || $pieza_opc_desc==''){
								$pieza = '<small>'.get_instore_nom_gen( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais($paisID, $r['formID'], $r['ptdGra']);
							}else{
								$pieza = '<small>'.get_instore_nom_gen( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais($paisID, $r['formID'], $r['ptdGra']) . ' [' . $pieza_opc_desc . '] ';
							}
						}


						$tienda = get_tienda(get_tienda_pedido($paisID,$r['ptID']));
						if($paisID==7){ 							
							if($r['ptdFecEn']>date('Y-m-d')){
								$estado = 'A tempo';
								$clase  = 'recibido';
							}elseif($r['ptdFecEn']==date('Y-m-d')){
								$estado = 'Para hoje';
								$clase  = 'aprobado';
							}else{
								$estado = 'Atrasado';
								$clase  = 'objetado';
							}
					    }else{						
							if($r['ptdFecEn']>date('Y-m-d')){
								$estado = 'A tiempo';
								$clase  = 'recibido';
							}elseif($r['ptdFecEn']==date('Y-m-d')){
								$estado = 'Para hoy';
								$clase  = 'aprobado';
							}else{
								$estado = 'Atrasado';
								$clase  = 'objetado';
							}
					    }
						
					
?>											


				<div class="col-xs-12 posicion" id="peddet-<?= $r['ptdItem']; ?>" data-nom="<?= $pieza; ?>"  data-foto="<?= $r['ptdFoto']; ?>" data-com="<?= $r['ptdObs']; ?>" data-est="<?= $r['ptdEst']; ?>" data-usutipo="<?= $usuTipo; ?>" data-fecen="<?= $r['ptdFecEn']; ?>">
					<div class="row">
						<div class="col-xs-12 posevento">
							<strong><?= $tienda; ?></strong><br><?= $pieza; ?> <span class="<?= $clase; ?>"><?= $estado; ?></span>
						</div>
						
						<!-- DETALLE -->
						<div class="col-xs-6 posevento">
							<span>Nº Pedido: <strong><?= $r['ptID']; ?></strong> <br>
							<span><? if($paisID==7){ ?>Status do item<? }else{ ?>Estado Item<? } ?>: <strong><? if($paisID==7){ echo get_desc_estado_br($r['ptdEst']); }else{ echo get_desc_estado($r['ptdEst']); }  ?></strong> <br>
							<span><? if($r['ptdEst']==5){ ?><i class="fa fa-arrow-circle-right blue" aria-hidden="true"></i> <? } ?>Cantidad: <strong><?= $r['ptdCan']; ?></strong> 
							<? if($r['ptdAlerta']){ ?>
								<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i>
							<? } ?> <span>
							<br><span><?= $fecha; ?> <?= $hora; ?></span> 
							<? if($r['ptdObs']){ ?>
							<br><span><? if($paisID==7){ ?>Observação<? }else{ ?>Observación<? } ?>:</span>
							<br><span><strong><?= $r['ptdObs']; ?></strong></span> 
							<? } ?>
						</div>
						<div class="col-xs-6 posevento">
							<span><? if($r['ptdEst']==5){ ?><i class="fa fa-arrow-circle-right blue" aria-hidden="true"></i> <? } ?>VM: <strong><?= get_user_nombre($r['ptdVM']); ?></strong></strong><span>
							<br><span><? if($r['ptdEst']==1){ ?><i class="fa fa-arrow-circle-right blue" aria-hidden="true"></i> <? } ?><? if($paisID==7){ ?>Responsável<? }else{ ?>Responsable<? } ?>: <strong><?= get_user_nombre($r['ptdRes']); ?></strong><span>
							<br><span><? if($r['ptdEst']==3 || $r['ptdEst']==4){ ?><i class="fa fa-arrow-circle-right blue" aria-hidden="true"></i> <? } ?><? if($paisID==7){ ?>Fornecedor<? }else{ ?>Proveedor<? } ?>: <strong><?= get_proveedor_nombre($r['ptdProv']); ?></strong><span>
						</div>
						
						
						<div class="clear"></div>
						
					</div>

				</div>

<?
		    
		    		} 
			    }			
				
				
?>
					</div>

				</div>
		    <? 		} 
			    } ?>
			    <? if($i==0){?>
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" >
					<div class="row">
						<div class="col-xs-12 posevento">
							<a href="javascript:void(0);"><? if($paisID==7){ ?>Você não tem entregas agendadas<? }else{ ?>No tiene entregas agendadas<? } ?></a>
							<br><span><? if($paisID==7){ ?>Obrigado<? }else{ ?>Gracias<? } ?>.</span>
						</div>
					</div>

				</div>			    

			    <? } ?>
				<div class="clear"></div>
		    </div>

	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'home.php';
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