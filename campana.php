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
	
	
	if($_GET['archivo']){				
		$sql  = "select * from campana where camEst = 2";
		if($paisID==7){
			$titulo = 'Catálogos arquivados';
	    }else{
			$titulo = 'Catálogos archivados';
	    } 
	}else{
		$sql  = "select * from campana where camEst < 2";
		if($paisID==7){
			$titulo = 'Catálogos ativos';
	    }else{
			$titulo = 'Catálogos activos';
	    } 
	}
	
	
?>


    <div class="container" id="argumentos">
	    
	    
		<header>
		    <span><? if($paisID==7){ ?>Campanhas<? }else{ ?>Campañas<? } ?></span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-6">
							<h2><?php echo $titulo; ?></h2>
				    	</div>
				    	<div class="col-xs-6 text-right">
					    	<? if(!$_GET['archivo']){ ?>
					    		<a href="campana.php?archivo=1" class="btn btn-default"><span class="hidden-xs">Archivo </span><i class="fa fa-history"></i></a>
							<? }else{ ?>
					    		<a href="campana.php" class="btn btn-default"><span class="hidden-xs"><? if($paisID==7){ ?>Ativos<? }else{ ?>Activos<? } ?></i></a>
							<? } ?>
							<? if($usuTipo==99){ ?>
							<a href="formulario-campana.php" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
							<? } ?>
				    	</div>
				    </div>
			    </div>
			<?

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						$ok = 0;
						if($usuTipo==99){
							$url = 'formulario-campana.php?camID='. $r['camID'];
							$ok = 1;
						}else{
							$url = 'catalogo.php?camID='. $r['camID'];
							$ok = ask_pais_campana( $r['camID'],$paisID);
						}
						if($ok==1){
		    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion <?= $tipo; ?>" id="tienda-<?= $r['tieID']; ?>">
					<div class="row">
						<div class="col-xs-9 postema">
							<a href="<?php echo $url; ?>"><? if($usuTipo==99){ ?><i class="fa fa-edit" aria-hidden="true"></i> <? } ?><?= $r['camDesc']; ?></a>
							<span><?= get_total_fotos_campana($r['camID']); ?> Fotos.</span><br>
							<?	$paises = '';
								$camID = $r['camID'];
								$sql2  = "select * from campana_x_pais where camID = $camID";
							  	$resultado2 = $db->rawQuery($sql2);
								if($resultado2){
									foreach ($resultado2 as $r2) {
										$paises .= get_pais_nom($r2['paisID']) . ', ';
						    		} 
							 } ?>
							<span><?php echo substr($paises, 0,-2); ?></span>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="catalogo.php?camID=<?= $r['camID']; ?>" class="btn btn-default"><i class="fa fa-list"></i><span class="hidden-xs"> Items</span></a> 
						</div>
					</div>

				</div>
		    <? 			}
			    	} 
			    } ?>
			    		    
		    </div>

		    	
	    	<footer class="animated bounceInRight">
		    	<? 
						if($usuTipo==99){
							$back = 'home.php';
						}else{
							$back = 'maestros.php';
						}
				?>
		    	<a href="<?php echo $back; ?>" id="btnvolver"><i class="fa fa-chevron-left"></i> <span><? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></span></button>
	    	</footer>	    

		    
<? include('footer.php'); ?>




