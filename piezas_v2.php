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
	
	$formID = $_GET['formID'];
	
	$formato = get_formato($formID);
?>

    <div class="container" id="argumentos">
	        
		<header>
		    <span>Instore</span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-6">
							<h2><?= $formato; ?></h2>
				    	</div>
				    	<div class="col-xs-6 text-right">
					    	<? if($usuTipo == 99){ ?>
				    	<a href="formulario-pieza_v2.php?formID=<?= $formID; ?>" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
				    	<? } ?>
				    	</div>
				    </div>
			    </div>
			<?
				if($usuTipo == 1){
					$sql  = "select * from instores_v2 where formID = $formID order by insNomGen";
				}elseif($usuTipo == 2){
					if($_GET['todos']){
						$sql  = "select * from instores_v2 where formID = $formID order by insNomGen";
					}else{
						//$sql  = "select * from instores where formID = $formID and pieRes = $usuID";
						$sql  = "select * from instores_v2 where formID = $formID order by insNomGen";
					}
				}elseif($usuTipo == 99){
					$sql  = "select * from instores_v2 where formID = $formID order by insNomGen";
				}

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						
						$opciones = get_total_opciones_instores_v2($formID, $r['insID']);
							
						
						
						
		    ?>   
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
						<div class="col-xs-9 postema">
<!--
							<? if(comprueba_archivos_x_pieza_formato($formID,$r['insID'])==0){ ?>
								<span class="error"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
							<? } ?>
-->
							<a href="opciones_v2.php?pieID=<?= $r['insID']; ?>&formID=<?= $formID; ?>"><?= $r['insNomGen']; ?></a>
							<small><i class="fa fa-list" aria-hidden="true"></i> <?= $opciones ; ?></small>
							<? if($usuTipo<99){ ?>
							<br><small><?php echo get_instore_nom_x_pais_v2($paisID, $r['formID'], $r['insID']) ; ?></small>
							<? }else{ ?>
							<br><small><?php echo $r['insNomGes'] ; ?></small>
							<? } ?>
							<? if($usuTipo>99){ ?>
							<br><span><i class="fa fa-user" aria-hidden="true"></i> <?php //echo get_username($r['pieRes']); ?> | <i class="fa fa-cog" aria-hidden="true"></i> <?php //echo get_proveedor_nombre($r['pieProv']); ?></span>
							<? } ?>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="formulario-pieza_v2.php?pieID=<?= $r['insID']; ?>&formID=<?= $formID; ?>" class="btn btn-default ">
							<? if($usuTipo==99){ ?>
								<i class="fa fa-edit"></i>
							<? }else{ ?>
								<i class="fa fa-eye"></i>
							<? } ?>
							</a> 
						</div>
					</div>
				</div>
		    <? 		} 
			    } ?>	    		    
		    </div>
		    	 

	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
		
			    	<?

							$back = 'formatos.php?piezas=1&FW2017=1';
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