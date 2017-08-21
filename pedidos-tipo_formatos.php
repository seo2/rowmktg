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
			$sql  = "select * from tipo_formato where tipforEst = 0 ORDER BY tipforOrd ASC";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
					if( $r['tipforDir'] == 1 ){
						$formTipo = $r['tipforID'];
		?>
		<?
			$sql2  = "select * from formatos where formEst = 0 and formTipo = $formTipo ORDER BY formOrder";
		  	$resultado2 = $db->rawQuery($sql2);
			if($resultado2){
				foreach ($resultado2 as $r2) {
	    ?>   
					<a href="tiendas.php?formID=<?= $r2['formID']; ?>" class="btn btn-primary btn-lg btn-block">
						<?= $r2['formDesc']; ?> 					
					</a>
					<br>
	    <?  	} 
		    } ?>

		<?				
					}else{
	    ?>   
					<a href="pedidos-formatos.php?tipforID=<?= $r['tipforID']; ?>" class="btn btn-primary btn-lg btn-block">
						<?= $r['tipforDesc']; ?> 
					</a>
					<br>
	    <?  	
					}
				} 
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