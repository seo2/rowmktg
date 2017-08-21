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
	
	
	
	if($_GET['formID']){
		
		$formTipo = $_GET['tipforID'];
		$formID   = $_GET['formID'];
		$formato  = get_formato($formID);
		$sql  = "select * from tiendas where tieForm = $formID and paisID = $paisID and tieEst = 0 order by tieID ASC";
		$sql2 = "select count(*) as total from tiendas where tieForm = $formID and paisID = $paisID and tieEst = 0";
	}elseif($_GET['s']){
		$busca = $_GET['s'];
		$formato = '';
		$sql  = "select * from tiendas where tieNom LIKE '%".$busca."%' and paisID = $paisID and tieEst = 0 order by tieForm";
		$sql2 = "select count(*) as total from tiendas and paisID = $paisID";
	}else{
		$formato = '';
		$sql  = "select * from tiendas where paisID = $paisID and tieEst = 0 order by tieForm";
		$sql2 = "select count(*) as total from tiendas where paisID = $paisID and tieEst = 0";
	}
?>

    <div class="container" id="argumentos">
	   	    
		<header>
		    <span><? if($paisID==7){ ?>Lojas<? }else{ ?>Tiendas<? } ?> <?= $formato; ?></span>
	    </header>	   
		    <div id="cajaposiciones" >
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion buscar">
					<div class="row">
						<form class="horizontal-form" role="search">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="<? if($paisID==7){ ?>Procurar loja<? }else{ ?>Buscar tienda<? } ?>" name="s" id="srch-term">
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			    
			<?

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {

						if($usuTipo==1){ // administrador
							$ptID = get_pedido_temporal($r['tieID']);
						}elseif($usuTipo==2){ // Retail MKTG
							//$ptID = get_pedido_temporal($r['tieID']);
							$ptID = get_pedido_temporal_x_usuario($paisID,$r['tieID'],$usuID);
						}elseif($usuTipo==3){ // VM
							$ptID = get_pedido_temporal_x_usuario($paisID,$r['tieID'],$usuID);
						}
						if($ptID){
							$pedidos = get_total_items_pedido_temporal($paisID,$ptID);
							if($pedidos>0){
				?> 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion conpedido" id="tienda-<?= $r['tieID']; ?>">
					<div class="row">
						<div class="col-xs-9 postema">
							<a href="pedido.php?tieID=<?= $r['tieID']; ?>"><?= $r['tieNom']; ?></a>
							<br><span><?= get_formato($r['tieForm']); ?> | <i class="fa fa-shopping-basket" aria-hidden="true"></i> <?= $pedidos; ?></span>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="pedido.php?tieID=<?= $r['tieID']; ?>" class="btn btn-default"><i class="fa fa-list"></i><span class="hidden-xs"> Pedido</span></a> 
						</div>
					</div>

				</div>
		    <? 				}
			    		}
			    	} 
			    } ?>
			    
			<?

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {

						if($usuTipo==1){ // administrador
							$ptID = get_pedido_temporal($r['tieID']);
						}elseif($usuTipo==2){ // Retail MKTG
							//$ptID = get_pedido_temporal($r['tieID']);
							$ptID = get_pedido_temporal_x_usuario($paisID,$r['tieID'],$usuID);
						}elseif($usuTipo==3){ // VM
							$ptID = get_pedido_temporal_x_usuario($paisID,$r['tieID'],$usuID);
						}
						if($ptID){
							$pedidos = get_total_items_pedido_temporal($paisID,$ptID);
						}else{
							$pedidos = 0;
						}
						
						if($pedidos == 0){
							
				?> 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" id="tienda-<?= $r['tieID']; ?>">
					<div class="row">
						<div class="col-xs-9 postema">
							<a href="pedido.php?tieID=<?= $r['tieID']; ?>"><?= $r['tieNom']; ?></a>
							<br><span><?= get_formato($r['tieForm']); ?> | <i class="fa fa-shopping-basket" aria-hidden="true"></i> <?= $pedidos; ?></span>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="pedido.php?tieID=<?= $r['tieID']; ?>" class="btn btn-default"><i class="fa fa-list"></i><span class="hidden-xs"> Pedido</span></a> 
						</div>
					</div>

				</div>
		    <? 			}
			    	} 
			    } ?>			    
			    
			    
		    </div>
		    
	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<?  if($formTipo){ 
									$back = 'pedidos-formatos.php?tipforID='.$formTipo;
								}else{
									$back = 'pedidos-tipo_formatos.php';
								}
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