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
	
	$tieID 	= $_GET['tieID'];
	$ptID 	= $_GET['ptID'];

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
	
	$parafecha = 0;
	if($usuTipo==1){ // administrador
		$sql  = "SELECT *  FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst >= 1";
// contar total de items aprobados por MM
		$sqlprov1  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 3";
	  	$resprov1 = $db->rawQuery($sqlprov1);
		if($resprov1){
			foreach ($resprov1 as $rp1) {
				$aprobados = $rp1['total'];
			}	
		}

		// contar total de items del MM
		$sqlprov  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst <> 2";
	  	$resprov = $db->rawQuery($sqlprov);
		if($resprov){
			foreach ($resprov as $rp) {
				$todos = $rp['total'];
			}	
		}	

		// contar total de items del MM para aprobar
		$sqlprov2  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 1";
	  	$resprov2 = $db->rawQuery($sqlprov2);
		if($resprov2){
			foreach ($resprov2 as $rp2) {
				$todos2 = $rp2['total'];
			}	
		}	
		
		// contar total de items que ya tienen precio ingresdo
		$sqlprov4  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdValor > 0 and ptdEst <> 2 and pedNum = 0";
	  	$resprov4 = $db->rawQuery($sqlprov4);
		if($resprov4){
			foreach ($resprov4 as $rp4) {
				$conprecio = $rp4['total'];
			}	
		}

		
		// contar total de items que están en estado cotizado
		$sqlprov6  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 4 and ptdValor > 0";
	  	$resprov6 = $db->rawQuery($sqlprov6);
		if($resprov6){
			foreach ($resprov6 as $rp6) {
				$cotizados = $rp6['total'];
			}	
		}


		// contar total de items del cotizados aprobados por MM
		$sqlprov5  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 5";
	  	$resprov5 = $db->rawQuery($sqlprov5);
		if($resprov5){
			foreach ($resprov5 as $rp5) {
				$cotizaMM = $rp5['total'];
			}	
		}
		
	}elseif($usuTipo==2){ // Retail MKTG
		//$sql  = "SELECT * FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst >= 1 and ptdEst <> 2 and ptdRes = $usuID";
		$sql  = "SELECT * FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst >= 1 and ptdRes = $usuID";
		// contar total de items aprobados por MM
		$sqlprov1  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 3 and ptdRes = $usuID";
	  	$resprov1 = $db->rawQuery($sqlprov1);
		if($resprov1){
			foreach ($resprov1 as $rp1) {
				$aprobados = $rp1['total'];
			}	
		}

		// contar total de items del MM
		$sqlprov  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdRes = $usuID and ptdEst <> 2";
	  	$resprov = $db->rawQuery($sqlprov);
		if($resprov){
			foreach ($resprov as $rp) {
				$todos = $rp['total'];
			}	
		}	

		// contar total de items del MM para aprobar
		$sqlprov2  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdRes = $usuID and ptdEst = 1";
	  	$resprov2 = $db->rawQuery($sqlprov2);
		if($resprov2){
			foreach ($resprov2 as $rp2) {
				$todos2 = $rp2['total'];
			}	
		}	
		
		// contar total de items que ya tienen precio ingresdo
		$sqlprov4  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdValor > 0 and ptdRes = $usuID and  ptdEst <> 2 and pedNum = 0";
	  	$resprov4 = $db->rawQuery($sqlprov4);
		if($resprov4){
			foreach ($resprov4 as $rp4) {
				$conprecio = $rp4['total'];
			}	
		}
		
		// contar total de items que están en estado cotizado
		$sqlprov6  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 4 and ptdValor > 0 and ptdRes = $usuID";
	  	$resprov6 = $db->rawQuery($sqlprov6);
		if($resprov6){
			foreach ($resprov6 as $rp6) {
				$cotizados = $rp6['total'];
			}	
		}
		// contar total de items del cotizados aprobados por MM
		$sqlprov5  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 5 and ptdRes = $usuID";
	  	$resprov5 = $db->rawQuery($sqlprov5);
		if($resprov5){
			foreach ($resprov5 as $rp5) {
				$cotizaMM = $rp5['total'];
			}	
		}		
		
	}elseif($usuTipo==3){ // VM
		//$sql  = "SELECT * FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst >= 1 and ptdVM = $usuID";
		$sql  = "SELECT * FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst >= 1  and  ptdEst <> 2 and ptdVM = $usuID";

		
	}elseif($usuTipo==4){ // Proveedor
		$ptdProv = get_proveedor_usuario($usuID);
		$sql  = "SELECT * FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst >= 3 and ptdEst <= 8 and ptdProv = $ptdProv";



		// contar total de items del proveedor que ya tienen precio ingresdo y enviados a MM
		$sqlprov1  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 4 and ptdProv = $ptdProv";
	  	$resprov1 = $db->rawQuery($sqlprov1);
		if($resprov1){
			foreach ($resprov1 as $rp1) {
				$cotizados = $rp1['total'];
			}	
		}

		// contar total de items del proveedor que fueron aprobados por MM
		$sqlprov  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 5 and ptdProv = $ptdProv";
	  	$resprov = $db->rawQuery($sqlprov);
		if($resprov){
			foreach ($resprov as $rp) {
				$parafecha = $rp['total'];
			}	
		}
		
		// contar total de items del proveedor que tienen fecha de entrega
		$sqlprov2  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 6 and ptdProv = $ptdProv";
	  	$resprov2 = $db->rawQuery($sqlprov2);
		if($resprov2){
			foreach ($resprov2 as $rp2) {
				$parafecha2 = $rp2['total'];
			}	
		}

		// contar total de items del proveedor para ingresar precio // aprobados por MM 
		$sqlprov3  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 3 and ptdProv = $ptdProv";
	  	$resprov3 = $db->rawQuery($sqlprov3);
		if($resprov3){
			foreach ($resprov3 as $rp3) {
				$aprobadosMM = $rp3['total'];
			}	
		}
		
		// contar total de items del proveedor que ya tienen precio ingresdo
		$sqlprov4  = "SELECT count(*) as total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID and ptdEst = 3 and ptdValor > 0 and ptdProv = $ptdProv";
	  	$resprov4 = $db->rawQuery($sqlprov4);
		if($resprov4){
			foreach ($resprov4 as $rp4) {
				$conprecio = $rp4['total'];
			}	
		}




	}

	
	$currency = get_currency($paisID);


?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span><?= get_tienda($tieID); ?></span>
	    </header>
			
		    <div id="cajaposiciones" data-eveID="<?= $eveID; ?>" data-tiendaID="<?= $tieID; ?>">
			    <div class="row">
				    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
					    <div class="row">
					    	<div class="col-xs-6">
								<h2>Pedido <strong>Nº <?= $ptID; ?></strong></h2> 
					    	</div>
					    	
					    	<? if($parafecha>0){ ?>
					    	<div class="col-xs-6 text-right">
						    	<a href="javascript:void(0);" class="btn btn-default" id="btn-all-recibir" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" ><i class="fa fa-calendar-check-o"></i></a> 
					    	</div>
					    	<? } ?>
					    	
					    	<? if($parafecha2>0){ ?>
					    	<div class="col-xs-6 text-right">
						    	<a href="javascript:void(0);" class="btn btn-default" id="btn-all-entregar" data-paisid="<?= $paisID; ?>" data-ptid="<?= $r['ptID']; ?>"  data-ptditem="<?= $r['ptdItem']; ?>" ><i class="fa fa-truck"></i></a> 
					    	</div>
					    	<? } ?>
						    
						    <? if($usuTipo<=2 && $todos2 > 0){ // Administrador o RM Specialist ?>
					    	<div class="col-xs-6 text-right">
						    	<a href="javascript:void(0);" class="btn btn-default" id="btn-all-aprobar" data-paisid="<?= $paisID; ?>" data-ptid="<?= $ptID; ?>" data-ptdres="<?= $usuID; ?>"><span class="hidden-xs">Todo </span><i class="fa fa-check"></i></a> 
						    	<a href="javascript:void(0);" class="btn btn-danger" id="btn-all-rechazar" data-paisid="<?= $paisID; ?>" data-ptid="<?= $ptID; ?>" data-ptdres="<?= $usuID; ?>"><span class="hidden-xs">Todo </span><i class="fa fa-trash"></i></a> 
					    	</div>		
							<? } ?>	
						    
						    <? if($usuTipo<=2 && $cotizados > 0){ // Administrador o RM Specialist  
							    
						    ?>
					    	<div class="col-xs-6 text-right">
						    	<a href="javascript:void(0);" class="btn btn-default" id="btn-all-aprobarcot" data-paisid="<?= $paisID; ?>" data-ptid="<?= $ptID; ?>" data-ptdres="<?= $usuID; ?>"><span class="hidden-xs">Todo </span><i class="fa fa-check-square-o"></i></a> 
						    	<a href="javascript:void(0);" class="btn btn-danger" id="btn-all-rechazarcot" data-paisid="<?= $paisID; ?>" data-ptid="<?= $ptID; ?>" data-ptdres="<?= $usuID; ?>"><span class="hidden-xs">Todo </span><i class="fa fa-times"></i></a> 
					    	</div>		
							<? } ?>			    	

					    	
					    </div>
				    </div>
			<?
				
				$valorTotal = 0;
			  	
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						
						$fecha = substr($r['ptdTS'],8,2) . '/'. substr($r['ptdTS'],5,2) .'/'. substr($r['ptdTS'],0,4);
						$hora  = substr($r['ptdTS'],11,8);
						
						$fecen = substr($r['ptdFecEn'],8,2) . '/'. substr($r['ptdFecEn'],5,2) .'/'. substr($r['ptdFecEn'],0,4);
						
						if($paisID==1 && $ptID <= 511){
							$pieza_opc_desc = get_pieza_opc_desc($r['ptdGra'],$r['ptdGraOp']); 
								
							if($pieza_opc_desc=='-' || $pieza_opc_desc=='Error'){
								$pieza = get_pieza_desc($r['ptdGra']);
							}else{
								$pieza = get_pieza_desc($r['ptdGra']) . ' [' . $pieza_opc_desc . '] ';
							}
						}else{
							if($r['ptdISC']=='fw2017'){
								$pieza   = get_isc_camp($formID,$r['ptdGra']) .'<br><small>'.get_isc_med($formID,$r['ptdGra']).'</small>';
							}else{		
								if($r['ptdV2']==1){	
									$pieza_opc_desc = get_instore_opc_desc_v2($r['formID'], $r['ptdGra'], $r['ptdGraOp']);
									
									if($pieza_opc_desc=='-' || $pieza_opc_desc==''){
										$pieza = '<small>'.get_instore_nom_gen_v2( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais_v2($paisID, $r['formID'], $r['ptdGra']);
									}else{
										$pieza = '<small>'.get_instore_nom_gen_v2( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais_v2($paisID, $r['formID'], $r['ptdGra']) . ' [' . $pieza_opc_desc . '] ';
									}
								}else{	
									$pieza_opc_desc = get_instore_opc_desc($r['formID'], $r['ptdGra'], $r['ptdGraOp']);
									
									if($pieza_opc_desc=='-' || $pieza_opc_desc==''){
										$pieza = '<small>'.get_instore_nom_gen( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais($paisID, $r['formID'], $r['ptdGra']);
									}else{
										$pieza = '<small>'.get_instore_nom_gen( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais($paisID, $r['formID'], $r['ptdGra']) . ' [' . $pieza_opc_desc . '] ';
									}
								}		
							}
						}

						$pieEnt = get_pieza_entrega($r['ptdGra']);

						if($r['pedNum'] == 1 && $r['ptdEst'] == 3){
						    if($paisID==7){
								$estado = 'Cotação Recusado';
						    }else{
								$estado = 'Cotización Rechazada';
						    } 
							$clase  = 'objetado';
						}else{
						    if($paisID==7){
								$estado = get_desc_estado_br($r['ptdEst']);
						    }else{
								$estado = get_desc_estado($r['ptdEst']);
						    } 
							$clase  = get_class_estado($r['ptdEst']);
						}

						$valorTotal = $valorTotal + $r['ptdValor'];

						include('include-pedido.php');
		    
		    		} 
			    }	
			?>

			    		<? //if($usuTipo==2 && ($aprobados == $todos)){ ?>
			    		<? if($usuTipo<=2 && ($aprobados == $todos)){ ?>
					    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
						    <div class="row">
						    	<div class="col-xs-12 text-center">
									<a href="javascript:void();" class="btn btn-default btnenviar2" data-ptid="<?= $ptID; ?>" data-paisid="<?= $paisID; ?>"><? if($paisID==7){ ?>Enviar para fornecedor<? }else{ ?>Enviar a Proveedor<? } ?> <i class="fa fa-envelope" aria-hidden="true"></i></a> 
						    	</div>
						    </div>
					    </div>
					    <? } ?>
			    		<? if($usuTipo==4 && ($aprobadosMM == $conprecio) && ($aprobadosMM > 0 && $conprecio >0)){ // Proveedor ?>
					    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
						    <div class="row">
						    	<div class="col-xs-12 text-center">
									<a href="javascript:void();" class="btn btn-default btnenviar3" data-ptid="<?= $ptID; ?>" data-ptdprov="<?= $ptdProv; ?>" data-paisid="<?= $paisID; ?>">Enviar Cotización <i class="fa fa-envelope" aria-hidden="true"></i></a> 
						    	</div>
						    </div>
					    </div>
					    <? } ?>		
<!--
					    
						    Con Precio:  <?  echo $conprecio;  ?>
						    CotizaMM:  <?  echo $cotizaMM;  ?>
						
-->
			    		<? if($usuTipo<=2 && $conprecio>0 && ($cotizaMM == $conprecio)){ // MM ?>
					    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
						    <div class="row">
						    	<div class="col-xs-12 text-center">
									<a href="javascript:void();" class="btn btn-default btnenviar4" data-ptid="<?= $ptID; ?>" data-paisid="<?= $paisID; ?>" data-ptdres="<?= $usuID; ?>" >Confirmar Cotización <i class="fa fa-envelope" aria-hidden="true"></i></a> 
						    	</div>
						    </div>
					    </div>
					    
					    <? } ?>		
					    
			    		<?  
				    		if($valorTotal>0){  ?>
					    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
						    <div class="row">
						    	<div class="col-xs-12 text-right">
									<h2><i class="fa fa-arrow-right" aria-hidden="true"></i> Valor total: <strong><small><?php echo $currency; ?></small> <?= number_format($valorTotal,0,',','.'); ?></strong> </h2>
						    	</div>
						    </div>
					    </div>
					    <? } ?>					    
					    
					    
					</div><!-- fin -->
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p id="titacabas"></p>
  		<div class="row">
  			<form method="post" action="ajax/cambiar-estado-item-pedido.php" accept-charset="utf-8" id="formPedido" class="col-xs-12">
	  					  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input class="form-control" id="nombre" disabled type="text" name="nombre" value="" placeholder="Nombre" required>
						<input type="hidden" name="paisID" 	 value="<?= $paisID; ?>">
						<input type="hidden" name="pdID" 	 value="<?= $ptID; ?>">
						<input type="hidden" name="ptdItem"  id="ptdItem" value="">
						<input type="hidden" name="estfin"   id="estfin" value="4">
						<br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-6 text-left hide fechapedido" >
						<label>Fecha de entrega:</label>
						<input type="date" class="form-control" id="ptdFecEn"  name="ptdFecEn" required>
						<br>
					</div>
				</div>						  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<textarea class="form-control" rows="5" name="descripcion" disabled placeholder="Obervación" id="argTxt" required></textarea>
					</div>
				</div>
				<button type="submit" class="btn btn-primary hide" id="btnGrabaFecha"><i class="fa fa-floppy-o"></i> Grabar</button>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div>  


<!-- Modal Objetar -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
	      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
      		<p id="titacabas"></p>
      		<div class="row">
	  			<form method="post" action="ajax/cambiar-estado-item-pedido.php" accept-charset="utf-8" id="formPedido2" class="col-xs-12">
		  					  			
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
						<input type="hidden" name="paisID" 	 value="<?= $paisID; ?>">
							<input type="hidden" name="pdID" 	 value="<?= $ptID; ?>">
							<input type="hidden" name="ptdItem"  id="ptdItem2" value="">
							<input type="hidden" name="estfin"   id="estfin2" value="2">
							<br>
						</div>
					</div>					  			
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<textarea class="form-control" rows="5" name="obsObj" disabled placeholder="<? if($paisID==7){ ?>Observação<? }else{ ?>Observación<? } ?>" ></textarea>
						</div>
					</div>
					<button type="submit" class="btn btn-primary hide" id="btnObjetar"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Rejeitar<? }else{ ?>Rechazar<? } ?></button>
					
	  			</form>
      		</div>
      </div>
    </div>
  </div>
</div>  


<!-- Modal Foto -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p id="titacabas2"></p>
  		<div class="row">	
			<div class="col-sm-offset-3 col-sm-6">
	   			<img src="" class="img-responsive" id="fotoperfil2" >
			</div>
  		</div>
      </div>
    </div>
  </div>
</div>  

<!-- Modal -->
<div class="modal fade" id="ModalComentarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p><strong><? if($paisID==7){ ?>Adicionar comentário<? }else{ ?>Agregar Comentario<? } ?></strong></p>
  		<p id="nombreitem"></p>
  		<div class="row">
  			<form method="post" action="ajax/graba-comentario-pedido.php" accept-charset="utf-8" id="formComentario" class="col-xs-12">
	  					  				  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input type="hidden" name="paisID" 	 value="<?= $paisID; ?>">
						<input type="hidden" name="ptID" 	 value="<?= $ptID; ?>">
						<input type="hidden" name="ptdItem"  id="ptdItem3" value="">
						<input type="hidden" name="ptoUsu"   value="<?= $usuID; ?>">
						<textarea class="form-control" rows="5" name="ptoObs" placeholder="<? if($paisID==7){ ?>Adicionar comentário<? }else{ ?>Escribir comentario<? } ?>" id="argTxt" required></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<button type="submit" class="btn btn-primary" id="btnComentar"><i class="fa fa-comments"></i> Enviar</button>
					</div>
				</div>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div>  

<!-- Modal -->
<div class="modal fade" id="ModalObjetar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<h2><strong><? if($paisID==7){ ?>Tem certeza?<? }else{ ?>¿Estás seguro?<? } ?></strong></h2>
  		<p><? if($paisID==7){ ?>Você realmente quer para rejeitar este item?<? }else{ ?>¿Realmente deseas rechazar este item?<? } ?><br><br></p>
  		<p id="nombreitem"></p>
  		<div class="row">
  			<form method="post" action="ajax/objetar-item-pedido.php" accept-charset="utf-8" id="formObjetar" class="col-xs-12">
	  					  				  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input type="hidden" name="paisID" 	 value="<?= $paisID; ?>">
						<input type="hidden" name="ptID" 	 value="<?= $ptID; ?>">
						<input type="hidden" name="ptdItem"  id="ptdItem4" value="">
						<input type="hidden" name="vm" 	 	 id="vm"	   value="">
						<input type="hidden" name="ptoUsu"   value="<?= $usuID; ?>">
						<textarea class="form-control" rows="5" name="ptoObs" placeholder="<? if($paisID==7){ ?>Adicionar comentário<? }else{ ?>Escribir comentario<? } ?>" id="argTxt2" required></textarea>
					</div>
				</div>
				<button type="submit" class="btn btn-danger" id="btnComentar2"><i class="fa fa-times"></i> Confirmar</button>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div>  


<!-- Modal -->
<div class="modal fade" id="ModalEntrega" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p><strong>Entregar</strong></p>
  		<p id="nombreitem"></p>
  		<div class="row">
  			<form method="post" action="ajax/entrega-pedido.php" accept-charset="utf-8" id="formEntrega" class="col-xs-12">
	  					  				  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input type="hidden" name="paisID" 	 value="<?= $paisID; ?>">
						<input type="hidden" name="pdID" 	 value="<?= $ptID; ?>">
						<input type="hidden" name="estfin"   value="5">
						<input type="hidden" name="ptdProv"   value="<?= $ptdProv; ?>">
						<input type="text"   name="ptdRecibe"  placeholder="Quién recibe" class="form-control" required >
						<br>
					</div>
				</div>
				
				<div class="form-group">
			    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
						<input type="file" id="uploadFoto" name="foto">
			    	</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
			    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
							<i class="fa fa-camera"></i> <? if($paisID==7){ ?>Nota do tranporte<? }else{ ?>Guía de Despacho<? } ?>
 						</button>
						<br>
					</div>
				</div>		
				<div class="row">
					<div class="col-xs-offset-3 col-xs-6">
			    		<div id="fotito" style="display:none;">
			    			<img src="" class="img-responsive" id="fotoperfil" >
			    		</div>
			    	</div>	
				</div>
				
				
				<div class="col-sm-offset-1 col-sm-10">
					<br>
					<button type="submit" class="btn btn-primary" id="btnRecibir"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
				</div>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div> 
   
  

<!-- Modal -->
<div class="modal fade" id="ModalFotos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p><strong><? if($paisID==7){ ?>Adicionar<? }else{ ?>Agregar<? } ?> Foto</strong></p>
  		<p id="nombreitem"></p>
  		<div class="row">
  			<form method="post" action="ajax/agrega-foto-item-pedido.php" accept-charset="utf-8" id="formFotos" class="col-xs-12">
	  					  				  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input type="hidden" name="paisID" 	 value="<?= $paisID; ?>">
						<input type="hidden" name="pdID" 	 value="<?= $ptID; ?>">
						<input type="hidden" name="ptdItem"  id="ptdItem6" value="">
						<input type="hidden" name="estItem"  id="estItem"  value="">
						<input type="hidden" name="fotoUsu"  id="fotoUsu"  value="<?= $usuID; ?>">
						<br>
					</div>
				</div>
				
				<div class="form-group">
			    	<div class="col-xs-10 col-xs-offset-1" id="campofoto2" style="display:none;">
						<input type="file" id="uploadFoto2" name="foto">
			    	</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
			    		<button type="button" onclick="document.getElementById('uploadFoto2').click(); return false" class="btn btn-primary" id="subefoto2">
							<i class="fa fa-camera"></i> <? if($paisID==7){ ?>Adicionar foto<? }else{ ?>Agregar Foto<? } ?>
						</button>
						<br>
					</div>
				</div>		
				<div class="row">
					<div class="col-xs-offset-3 col-xs-6">
			    		<div id="fotito2" style="display:none;">
			    			<img src="" class="img-responsive" id="fotoperfil3" >
			    		</div>
			    	</div>	
				</div>
				<div class="col-sm-offset-1 col-sm-10">
					<br>
					<button type="submit" class="btn btn-primary" id="btnGrabaFotos"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
				</div>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div>   
<!-- Modal -->
<div class="modal fade" id="ModalCotizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p><? if($paisID==7){ ?>Cotar<? }else{ ?>Cotizar<? } ?> Item</p>
  		<p id="titacabas2"></p>
  		<div class="row">
  			<form method="post" action="ajax/precio-item.php" accept-charset="utf-8" id="formPrecioItem" class="col-xs-12">
 					  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input type="hidden" name="paisID" 	 value="<?= $paisID; ?>">
						<input type="hidden" name="pdID" 	  value="<?= $ptID; ?>">
						<input type="hidden" name="ptdItem"  id="ptdItem7" value="">
						<input type="hidden" name="ptdProv" value="<?= $ptdProv; ?>">
						<input class="form-control" id="nombre2" disabled type="text" name="nombre" value="" placeholder="<? if($paisID==7){ ?>Nome<? }else{ ?>Nombre<? } ?>" required>
						<br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-6 text-left fechapedido" >
						<label>Valor:</label>
						 <div class="input-group">
					      <div class="input-group-addon"><?php echo $currency; ?></div>
					      <input type="number" class="form-control" id="ptdValor"  name="ptdValor" required>
					    </div>
						<br>
					</div>
				</div>	
				<button type="submit" class="btn btn-primary" id="btnGrabaValor"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div>   
  
   
<!-- Modal -->
<div class="modal fade" id="ModalFechaEntrega" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p id="titacabas"><? if($paisID==7){ ?>receber<? }else{ ?>Recibir<? } ?> Pedido <strong>Nº <?= $ptID; ?></strong></p>
  		<div class="row">
  			<form method="post" action="ajax/fecha-entrega.php" accept-charset="utf-8" id="formFechaEntrega" class="col-xs-12">
	  					  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input type="hidden" name="paisID" 	value="<?= $paisID; ?>">
						<input type="hidden" name="pdID" 	value="<?= $ptID; ?>">
						<input type="hidden" name="ptdProv" value="<?= $ptdProv; ?>">
						<br>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-6 text-left fechapedido" >
						<label><? if($paisID==7){ ?>Data<? }else{ ?>Fecha<? } ?> de entrega:</label>
						<input type="date" class="form-control" id="ptdFecEn"  name="ptdFecEn" required>
						<br>
					</div>
				</div>	
				<button type="submit" class="btn btn-primary" id="btnGrabaFechaEntrega"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div>     
  
 <!-- Modal -->
<div class="modal fade" id="ModalArchivos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p><strong><? if($paisID==7){ ?>Adicionar arquivo<? }else{ ?>Agregar Archivo<? } ?></strong></p>
  		<p id="nombreitem"></p>
  		<div class="row">
  			<form method="post" action="ajax/agrega-archivo-item-pedido.php" accept-charset="utf-8" id="formArchivos" class="col-xs-12">
	  					  				  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input type="text" class="form-control" id="fileDesc" placeholder="<? if($paisID==7){ ?>Descrição de arquivo<? }else{ ?>Descripción del archivo<? } ?>" name="fileDesc" required>
						<input type="hidden" name="paisID" 	 value="<?= $paisID; ?>">
						<input type="hidden" name="pdID" 	 value="<?= $ptID; ?>">
						<input type="hidden" name="ptdItem"  id="ptdItem8" value="">
						<input type="hidden" name="estItem"  id="estItem"  value="">
						<input type="hidden" name="fotoUsu"  id="fotoUsu"  value="<?= $usuID; ?>">
						<br>
					</div>
				</div>
				
				<div class="form-group">
			    	<div class="col-xs-10 col-xs-offset-1" id="campofoto2" style="display:none;">
						<input type="file" id="uploadFoto2" name="foto">
			    	</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
			    		<button type="button" onclick="document.getElementById('uploadFoto2').click(); return false" class="btn btn-primary" id="subefoto2">
							<i class="fa fa-paperclip"></i> <? if($paisID==7){ ?>Adicionar arquivo<? }else{ ?>Agregar Archivo<? } ?>
						</button>
						<br>
					</div>
				</div>		
				<div class="row">
					<div class="col-xs-offset-3 col-xs-6">
			    		<div id="fotito2" style="display:none;">
			    			<img src="" class="img-responsive" id="fotoperfil3" >
			    		</div>
			    	</div>	
				</div>
				<div class="col-sm-offset-2 col-sm-8">
					<br>
					<button type="submit" class="btn btn-primary" id="btnGrabaArchivos"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
				</div>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div>   
  
   
   
<? include('footer.php'); ?>