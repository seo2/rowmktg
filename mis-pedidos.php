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
<? if($_GET['historial']){
    if($paisID==7){
		$tit = 'Históricos';
		$historicos = 'Você não tem histórico';
    }else{
		$tit = 'Históricos';
		$historicos = 'No tiene aún historial';
    } 	
}elseif($_GET['cotizados']){
    if($paisID==7){
		$tit = 'Cotados';
		$historicos = 'Você não tem cotações pendentes';
    }else{
		$tit = 'Cotizados';
		$historicos = 'No tiene cotizaciones pendientes';
    } 	
	
}else{	
    if($paisID==7){
		$tit = 'Ativos';
		$historicos = 'Você não tem pedidos pendentes';
    }else{
		$tit = 'Activos';
		$historicos = 'No tiene pedidos pendientes';
    } 		
}	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span><? if($paisID==7){ ?>Meus pedidos<? }else{ ?>Mis Pedidos<? } ?></span>
	    </header>

	    <div id="cajaposiciones">
		    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    <div class="row">
			    	<div class="col-xs-8">
						<h2>Pedidos <?= $tit; ?></h2> 
			    	</div>
			    	<div class="col-xs-4 text-right">
				    	<? if(!$_GET['historial']){ ?>
				    		<a href="mis-pedidos.php?historial=1" class="btn btn-default"><span class="hidden-xs"><? if($paisID==7){ ?>Histórico<? }else{ ?>Historial<? } ?> </span><i class="fa fa-history"></i></a>
						<? } ?>
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
				
				
				if($_GET['historial']){		
					if($usuTipo==1){ // administrador
						$sql  = "SELECT count(*) as Total, ptID, ptdTS  FROM pedido_temporal_detalle WHERE ptdEst = 8 and paisID = $paisID GROUP BY ptID order by ptID DESC";
					}elseif($usuTipo==2){ // Retail MKTG
						$sql  = "SELECT  count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE ptdEst = 8 and ptdRes = $usuID GROUP BY ptID order by ptID DESC";
					}elseif($usuTipo==3){ // VM
						$sql  = "SELECT  count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE ptdEst = 8 and ptdVM = $usuID GROUP BY ptID order by ptID DESC";
					}else{ // Proveedor
						$ptdProv = get_proveedor_usuario($usuID);
						$sql  = "SELECT  count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE ptdEst = 8 and ptdProv = $ptdProv GROUP BY ptID order by ptID DESC";
					}
				}elseif($_GET['cotizados']){
					if($usuTipo==1){ // administrador
						$sql  = "SELECT count(*) as Total, ptID, ptdTS  FROM pedido_temporal_detalle WHERE ptdEst = 4 and paisID = $paisID GROUP BY ptID order by ptID DESC";
					}elseif($usuTipo==2){ // Retail MKTG
						$sql  = "SELECT  count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE ptdEst = 4 and ptdRes = $usuID GROUP BY ptID order by ptID DESC";
					}elseif($usuTipo==3){ // VM
						$sql  = "SELECT  count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE ptdEst = 4 and ptdVM = $usuID GROUP BY ptID order by ptID DESC";
					}else{ // Proveedor
						$ptdProv = get_proveedor_usuario($usuID);
						$sql  = "SELECT  count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE ptdEst = 5 and ptdProv = $ptdProv GROUP BY ptID order by ptID DESC";
					}				
				}else{				
					if($usuTipo==1){ // administrador
						$sql  = "SELECT count(*) as Total, ptID, ptdTS  FROM pedido_temporal_detalle WHERE ptdEst >= 1 and ptdEst < 8 and ptdEst <> 2 and pedNum <> 1 and paisID = $paisID GROUP BY ptID order by ptID DESC";
					}elseif($usuTipo==2){ // Retail MKTG
						$sql  = "SELECT  count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE ptdEst >= 1 and ptdEst < 8 and ptdEst <> 2 and pedNum <> 1 and ptdRes = $usuID GROUP BY ptID order by ptID DESC";
					}elseif($usuTipo==3){ // VM
						$sql  = "SELECT  count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE ptdEst >= 1 and ptdEst < 8 and ptdEst <> 2 and pedNum <> 1 and ptdVM = $usuID GROUP BY ptID order by ptID DESC";
					}else{ // Proveedor
						$ptdProv = get_proveedor_usuario($usuID);
						$sql  = "SELECT  count(*) as Total, ptID, ptdTS FROM pedido_temporal_detalle WHERE ptdEst >= 3 and ptdEst < 8 and ptdProv = $ptdProv GROUP BY ptID order by ptID DESC";
					}
				}
				$i = 0;
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						
						$ptTS  = get_pedido_fecha_proceso($paisID, $r['ptID']);
						$fecha = substr($ptTS,8,2) . '/'. substr($ptTS,5,2) .'/'. substr($ptTS,0,4);
						$hora  = substr($ptTS,11,8);
						$i++;
		    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
						<div class="col-xs-9 posevento">
							<a href="detalle-pedido.php?ptID=<?= $r['ptID']; ?>&tieID=<?= get_tienda_pedido($paisID,$r['ptID']); ?>" ><?= get_tienda(get_tienda_pedido($paisID,$r['ptID'])); ?></a>
							<span><strong><?= get_formato(get_formato_tienda(get_tienda_pedido($paisID,$r['ptID']))); ?></strong></span>
							<span>[<?= $r['Total']; ?>]</span>
							<br><span class="numpedido">Pedido <strong>Nº <?= $r['ptID']; ?></strong> del <strong><?= $fecha; ?></strong></span><br>
							
							
							<?
								$ptID = $r['ptID'];
								if($usuTipo==1){ // administrador
									$sql0  = "SELECT count(*) as Total, ptdEst, pedNum FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $ptID group by ptdEst";
								}elseif($usuTipo==2){ // Retail MKTG
									$sql0  = "SELECT count(*) as Total, ptdEst, pedNum FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdRes = $usuID and ptID = $ptID  and ptdEst <> 2 group by ptdEst";
								}elseif($usuTipo==3){ // VM
									$sql0  = "SELECT count(*) as Total, ptdEst, pedNum FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdVM = $usuID and ptID = $ptID  and ptdEst <> 2 group by ptdEst";
								}else{ // Proveedor
									$sql0  = "SELECT count(*) as Total, ptdEst, pedNum FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdProv = $ptdProv and ptID = $ptID  and ptdEst <> 2 group by ptdEst";
								}
								$resultado0 = $db->rawQuery($sql0);
								if($resultado0){
									foreach ($resultado0 as $r0) {
									if($r0['pedNum'] == 1 && $r0['ptdEst'] == 3){
									    if($paisID==7){
											$estado = 'Cotação Recusado';
									    }else{
											$estado = 'Cotización Rechazada';
									    } 
										$clase  = 'objetado';
									}else{
									    if($paisID==7){
											$estado = get_desc_estado_br($r0['ptdEst']);
									    }else{
											$estado = get_desc_estado($r0['ptdEst']);
									    } 
										$clase  = get_class_estado($r0['ptdEst']);
									}
									
							?>
							
								<span class="<?= $clase; ?>"><?= $estado; ?> [<?= $r0['Total']; ?>]</span> 
								
							<?	
									}
								}
							?>		
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="detalle-pedido.php?ptID=<?= $r['ptID']; ?>&tieID=<?= get_tienda_pedido($paisID,$r['ptID']); ?>" class="btn btn-default" ><i class="fa fa-eye"></i></a>
						</div>
					</div>

				</div>
		    <? 		} 
			    } ?>
			    <? if($i==0){?>
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" >
					<div class="row">
						<div class="col-xs-12 posevento">
							<a href="javascript:void(0);"><?= $historicos; ?></a>
							<br><span><? if($paisID==7){ ?>Obrigado<? }else{ ?>Gracias<? } ?>.</span>
						</div>
					</div>

				</div>			    
			    
			    <? }else{ ?>
		    		<? if($usuTipo<=2){ ?>
<!--
				    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
					    <div class="row">
					    	<div class="col-xs-12 text-center">
								<a href="javascript:void();" class="btn btn-default btnenviar1" data-ptditem="<?= $ptditem; ?>">Enviar a Proveedor <i class="fa fa-envelope" aria-hidden="true"></i></a> 
					    	</div>
					    	
					    </div>
				    </div>
-->
				    <? } ?>
			    <? } ?>
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