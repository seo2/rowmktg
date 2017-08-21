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
	
	$formID 	= $_GET['formID'];
	$pieID  	= $_GET['pieID'];
	if($usuTipo==99){
		$pieza = get_instore_desc_v2($formID,$pieID);	
	}else{
		$pieza = get_instore_nom_x_pais_v2($paisID, $formID, $pieID) ;
	}
	$insNomGen  = get_instore_gen_v2($formID, $pieID);
	$ruta 		= get_carpeta_ISC_v2($formID);
	$formato 	= get_formato($formID);
?>

    <div class="container" id="argumentos">
	    
	    
		<header>
		    <span><?= $formato; ?></span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-8">
			    	<h2><small>Opciones: <strong><?= $pieza; ?></strong></small></h2>
				    	</div>
				    	<div class="col-xs-4 text-right">
					    	<? if($usuTipo==99){ ?>
					    	<a href="formulario-pieza-opciones_v2.php?insID=<?= $pieID; ?>&formID=<?= $formID; ?>" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
					    	<? } ?>
				    	</div>
				    </div>
			    </div>
			    
			<?
				$sql  = "select * from instores_opciones_v2 where formID = $formID and insID = $pieID";

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
		    ?>   
		    
				<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 posicion">
					<div class="row">
						<div class="col-xs-9 postema">
							<?= $r['insOpNom']; ?><br>
							<? if($r['insOpCat']==0){
								if($r['insOpFoto']){ 
									$archivo = '/ajax/uploads/ISC/'.$r['insOpFoto'];
								}else{
									$archivo = '/'.$ruta.quitatodo($insNomGen).quitatodo($r["insOpNom"]).'.jpg';
								}
								?>						
							<img src="<?php echo $archivo; ?>" style="max-width:200px; max-height:100px; padding:2px; border:1px solid #ccc; margin-top:5px;">
							<? }else{ ?>
							<small><i>Selecciona imagen del catálogo</i></small>
							<? } ?>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="formulario-pieza-opciones_v2.php?formID=<?= $formID; ?>&insID=<?= $pieID; ?>&insOpID=<?= $r['insOpID']; ?>" class="btn btn-default">
							<? if($usuTipo==99){ ?>
								<i class="fa fa-edit"></i>
							<? }else{ ?>
								<i class="fa fa-eye"></i>
							<? } ?></a>
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