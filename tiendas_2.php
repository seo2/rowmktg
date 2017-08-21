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
		$formID = $_GET['formID'];
		$formato = get_formato($formID);
		$sql  = "select * from tiendas where tieForm = $formID and paisID = $paisID and tieEst = 0";
		$sql2 = "select count(*) as total from tiendas where tieForm = $formID and paisID = $paisID and tieEst = 0";
	}elseif($_GET['s']){
		$busca = $_GET['s'];
		$formato = '';
		$sql  = "select * from tiendas where tieNom LIKE '%".$busca."%' and paisID = $paisID order by tieForm";
		$sql2 = "select count(*) as total from tiendas and paisID = $paisID and tieEst = 0";
	}else{
		$formato = '';
		$sql  = "select * from tiendas where paisID = $paisID and tieEst = 0 order by tieForm";
		$sql2 = "select count(*) as total from tiendas where paisID = $paisID and tieEst = 0";
	}
?>
<? // include('menu.php'); ?>

    <div class="container" id="argumentos">
	   	    
		<header>
		    <span>Tiendas <?= $formato; ?></span>
	    </header>	   
		    <div id="cajaposiciones" >
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion buscar">
					<div class="row">
						<form class="horizontal-form" role="search">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Buscar tienda" name="s" id="srch-term">
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			    
<? if(!$_GET['formID']){ ?>	
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
							$pedidos = get_total_items_pedido_temporal($ptID);
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
		    <? 			}
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
							$pedidos = get_total_items_pedido_temporal($ptID);
						}else{
							$pedidos = 0;
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
			    
			    
<? }else{ ?>
			<?

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
		    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" id="tienda-<?= $r['tieID']; ?>">
					<div class="row">
						<div class="col-xs-9 postema">
							<a href="pedido.php?tieID=<?= $r['tieID']; ?>"><?= $r['tieNom']; ?></a>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="pedido.php?tieID=<?= $r['tieID']; ?>" class="btn btn-default"><i class="fa fa-list"></i><span class="hidden-xs"> Pedido</span></a> 
						</div>
					</div>

				</div>
		    <? 		} 
			    } ?>

<? } ?>			    		    
		    </div>

		    	
	    	<footer class="animated bounceInRight">
		    	<a href="javascript:window.history.back();" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    

		    
<? include('footer.php'); ?>