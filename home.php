<? 
	
session_start();
global $usuID;

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
	
?>
	<style>
		#botonera{display: none;}
	</style>
    <div class="container" id="posiciones">
	    <header>
		    <? if($paisID==7){ ?>
		    <span>Menu</span>
		    <? }else{ ?>
		    <span>Menú</span>
		    <? } ?>
	    </header>
			<div class="row">
				
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 cajita" >
				
				<h1 class="logo animated fadeIn"><img src="assets/img/rbk.svg" style="margin:10px 0;"></h1>
				<p class="logo animated fadeInDown">Own Retail Wholesale Marketing</p>
					<?
					// 	QUERIES PARA SACAR TOTAL DE PEDIDOS:

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
	
				
		    if($paisID==7){
			    $boton1 = "Realizar Pedido";
			    $boton2 = "Resumo por lojas";
			    $boton3 = "Resumo de fornecedores";
			    $boton4 = "Alterar Senha";
			    $boton5 = "Master";
			    $boton6 = "Sair";
			    
		    }else{
		   		$boton1 = "Hacer Pedido";
			    $boton2 = "Resumen x tiendas";
			    $boton3 = "Resumen x Proveedores";
			    $boton4 = "Cambiar Contraseña";
			    $boton5 = "Maestros";
			    $boton6 = "Salir";
		    } 
	

					
					if($usuTipo==1){ // administrador
						$sql0  	= "SELECT count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 0 GROUP BY ptID ";
						$sql  	= "SELECT count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst >= 1 and ptdEst < 8 and ptdEst <> 2 ";
						$sql2  	= "SELECT count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 6";
					    if($paisID==7){
							$tit 	= "Pedidos";
							$tit2 	= "Entregas Agendadas";
					    }else{
							$tit 	= "Pedidos";
							$tit2 	= "Entregas Programadas";
					    } 				
					}elseif($usuTipo==2){ // Retail MKTG
						$sql0  	= "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 0 and ptdVM = $usuID GROUP BY ptID ";
						$sql 	= "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst >= 1 and ptdEst < 8 and ptdEst <> 2 and ptdRes = $usuID GROUP BY ptID ";
						$sql2  	= "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 6 and ptdRes = $usuID GROUP BY ptID";
						$sql3   = "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 4 and ptdRes = $usuID GROUP BY ptID";
					    if($paisID==7){
							$tit 	= "Meus Pedidos";
							$tit2 	= "Entregas Agendadas";
							$tit3 	= "Cotações Pendentes";
					    }else{
							$tit 	= "Mis Pedidos";
							$tit2 	= "Entregas Programadas";
							$tit3 	= "Cotizaciones Pendientes";
					    } 			
					}elseif($usuTipo==3){ // VM
						$sql0  = "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 0 and ptdVM = $usuID GROUP BY ptID ";
						$sql  = "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst >= 1 and ptdEst < 8 and ptdVM = $usuID GROUP BY ptID ";
						$sql2  = "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 6 and ptdVM = $usuID GROUP BY ptID ";
					    if($paisID==7){
							$tit 	= "Meus Pendentes";
							$tit2 	= "Entregas Agendadas";
					    }else{
							$tit 	= "Mis Pendientes";
							$tit2 	= "Entregas Programadas";
					    } 	
					}elseif($usuTipo==4){ // Proveedor
						$ptdProv = get_proveedor_usuario($usuID);
						$sql  = "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst >= 3 and ptdEst < 6 and ptdProv = $ptdProv GROUP BY ptID ";
						$sql2  = "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 6 and ptdProv = $ptdProv";					
						$sql3  = "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 5 and ptdProv = $ptdProv GROUP BY ptID ";
					    if($paisID==7){
							$tit 	= "Pedidos Pendentes";
							$tit2 	= "Pedidos em Andamento";
							$tit3 	= "Cotações Aprovadas";
					    }else{
							$tit	= "Pedidos Pendientes";
							$tit2 	= "Pedidos Ongoing";
							$tit3 	= "Cotizaciones Aprobadas";
					    } 	
					}		
						
					?>	
					
					<? if($usuTipo<4){ ?>

<?					
					$resultado0 = $db->rawQuery($sql0);
					if($resultado0){
						foreach ($resultado0 as $r0) {
							$total0++;
						}
					}			
?>		



					<a href="pedidos-formatos.php?tipforID=1" class="btn btn-primary btn-lg btn-block"><?php echo $boton1; ?> <span class="total"><i class="fa fa-shopping-basket" aria-hidden="true"></i><strong><?= $total0; ?></strong></span></a>
					<br>
					
					
					<? } ?>
					
<?					
					if($usuTipo<99){
						$resultado = $db->rawQuery($sql);
						if($resultado){
							foreach ($resultado as $r) {
								$total = $r['Total'];
								//$total++;
							}
						}		
?>					
					
					<a href="mis-pedidos.php" class="btn btn-primary btn-lg btn-block"><?= $tit; ?> <span class="total"><i class="fa fa-shopping-basket" aria-hidden="true"></i><strong><?= $total; ?></strong></span></a>
					<br>
					
							
<?					
					}		
					if($usuTipo==2 || $usuTipo==4){
						$resultado3 = $db->rawQuery($sql3);
						if($resultado3){
							foreach ($resultado3 as $r3) {
								$total3 = $r3['total'];
							}
						}				
?>					
					
					<a href="mis-pedidos.php?cotizados=1" class="btn btn-primary btn-lg btn-block"><?= $tit3; ?> <span class="total"><i class="fa fa-shopping-basket" aria-hidden="true"></i><strong><?= $total3; ?></strong></span></a>
					<br>
					<? } ?>
					
					
			
<?				if($usuTipo<99){
					$resultado2 = $db->rawQuery($sql2);
					if($resultado2){
						foreach ($resultado2 as $r2) {
							$total2 = $r2['total'];
						}
					}			
?>								
					
					<a href="mis-pedidos-agenda.php" class="btn btn-primary btn-lg btn-block"><?= $tit2; ?> <span class="total"><i class="fa fa-shopping-basket" aria-hidden="true"></i><strong><?= $total2; ?></strong></span></a>
					<hr>
					
<?  } ?>
					<? if($usuTipo<4 && $paisID==1){ ?>
					<a href="checklists-formatos.php" class="btn btn-primary btn-lg btn-block">Checklists</a>
					<hr>
					<? } ?>
					<? if($usuTipo<3){ ?>
					<a href="dashboard.php" class="btn btn-primary btn-lg btn-block"><?php echo $boton2; ?></a>
					<br>
					<a href="dashboard-proveedores.php" class="btn btn-primary btn-lg btn-block"><?php echo $boton3; ?></a>
						<? if($paisID==1){ ?>
					<br>
					<a href="checklists-dashboard.php" class="btn btn-primary btn-lg btn-block">Resumen Checklists</a>
						<? } ?>
					<hr>
					<a href="maestros.php" class="btn btn-primary btn-lg btn-block"><?php echo $boton5; ?></a>
					<br>
					<? } ?>
					<? if($usuTipo==99){ ?>
					<a href="paises.php" class="btn btn-primary btn-lg btn-block">Reportes</a>
					<hr>
<!--
					<a href="formatos.php?piezas=1" class="btn btn-primary btn-lg btn-block">ISC Long Term</a>
					<br>
-->
					<a href="formatos.php?piezas=1&FW2017=1" class="btn btn-primary btn-lg btn-block">ISC Long Term</a>
					<br>
					<a href="campana_v2.php" class="btn btn-primary btn-lg btn-block">ISC de Campañas</a>
					<br>
					<a href="mercados.php" class="btn btn-primary btn-lg btn-block">Mercados</a>
					<br>
					<a href="currency.php" class="btn btn-primary btn-lg btn-block">Rate Exchange</a>
					<hr>
					<? } ?>
					<a href="formulario-cambiar-password.php" class="btn btn-primary btn-lg btn-block"><?php echo $boton4; ?></a>
					<br>
					<a href="javascript:void();" class="btn btn-primary btn-lg btn-block" id="logoutBtn"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo $boton6; ?></a>
				</div>
			</div>
    
<? include('footer.php'); ?>