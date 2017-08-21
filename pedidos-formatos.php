<? 
	
session_start();
global $usuID;
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
		
	function pedidos_x_formato($usuTipo, $paisID, $formID,$usuID){	
		$db = MysqliDb::getInstance();
		if($usuTipo==1){ // administrador
			$sql0  	= "SELECT count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 0 and formID = $formID GROUP BY ptID ";
		}elseif($usuTipo==2){ // Retail MKTG
			$sql0  	= "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 0 and ptdVM = $usuID and formID = $formID GROUP BY ptID ";
		}elseif($usuTipo==3){ // VM
			$sql0  = "SELECT  count(*) as Total FROM pedido_temporal_detalle WHERE paisID = $paisID and ptdEst = 0 and ptdVM = $usuID and formID = $formID GROUP BY ptID ";
		}		
		$total0 = 0;
		
		$resultado0 = $db->rawQuery($sql0);
		if($resultado0){
			foreach ($resultado0 as $r0) {
				$total0++;
			}
		}
		return 	$total0;
	}
	
	$formTipo = $_GET['tipforID'];
	
								
?>		

    <div class="container" id="posiciones">

	    
	    <header>
		    <? if($paisID==7){ ?>
		    	<span>Formato das lojas</span>
		    <? }else{ ?>
		    	<span>Formato de Tiendas</span>
		    <? } ?>
	    </header>
			<div class="row">
				
				<div class="col-sm-4 col-sm-offset-4 col-xs-10 col-xs-offset-1 cajita" >
					<br>
		<?
			$sql  = "select * from formatos where formEst = 0 and formTipo = $formTipo ORDER BY formOrder";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
	    ?>   
					<a href="tiendas.php?formID=<?= $r['formID']; ?>&tipforID=<?php echo $formTipo; ?>" class="btn btn-primary btn-lg btn-block">
						<?= $r['formDesc']; ?> <small>[<?php echo get_tienda_x_formato_x_pais($r['formID'], $paisID); ?>]</small>
						<span class="total"><i class="fa fa-shopping-basket" aria-hidden="true"></i><strong><?= pedidos_x_formato($usuTipo, $paisID, $r['formID'],$usuID); ?></strong></span>
					</a>
					<br>
	    <?  	} 
		    } ?>

						
						
						
				</div>
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