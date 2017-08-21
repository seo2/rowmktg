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
		$sql  = "select * from campana_v2 where camEst = 2";
		if($paisID==7){
			$titulo = 'Catálogos arquivados';
	    }else{
			$titulo = 'Catálogos archivados';
	    } 
	}else{
		if($usuTipo==99){
			$sql  = "select * from campana_v2 where camEst < 2";
		}else{
			$sql  = "select * from campana_v2 where camEst = 0";	
		}
		if($usuTipo==99){
			$titulo = 'Campañas';
		}else{
			if($paisID==7){
				$titulo = 'Catálogos ativos';
		    }else{
				$titulo = 'Catálogos activos';
		    } 	
		}
	    
	}
	
	
?>
    <div class="container" id="argumentos">
		<header>
		    <span><? if($paisID==7){ ?>ISC de Campanhas<? }else{ ?>ISC de Campaña<? } ?></span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-6">
							<h2><?php echo $titulo; ?></h2>
				    	</div>
				    	<div class="col-xs-6 text-right">
					    	<? if(!$_GET['archivo']){ ?>
					    		<a href="campana_v2.php?archivo=1" class="btn btn-default"><span class="hidden-xs"><? if($paisID==7){ ?>Registros<? }else{ ?>Archivos<? } ?> </span><i class="fa fa-history"></i></a>
							<? } ?>
							<? if($usuTipo==99){ ?>
							<a href="formulario-campana_v2.php" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
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
							$url = 'formulario-campana_v2.php?camID='. $r['camID'];
							$ok = 1;
						}else{
							$url = 'catalogo_v2.php?camID='. $r['camID'];
							$ok = ask_pais_campana_v2( $r['camID'],$paisID);
						}
						if($ok==1){
							if($r['camEst']==1){ 
								$estado = 'off';
								$estDesc = 'Inactivo';						
							}else{ 
								$estado = 'on';
								$estDesc = 'Activo';
							} 
							$paises = '';
							$camID  = $r['camID'];
		    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion campana-<?php echo $estado; ?>">
					<div class="row ">
						<div class="col-xs-2 col-sm-1">
							<a href="javascript:void(0)" data-camid="<?php echo $camID; ?>" data-estado="<?php echo $estado; ?>" class="cambiaEstado" data-toggle="tooltip" data-placement="right"  title="<?php echo $estDesc; ?>">
								<i class="fa fa-toggle-<?php echo $estado; ?>" aria-hidden="true"></i></span>
							</a>
						</div>
						<div class="col-xs-7 col-sm-8 postema nopadl nopadr">
							
							<a href="<?php echo $url; ?>"><? if($usuTipo==99){ ?><i class="fa fa-edit" aria-hidden="true"></i> <? } ?><?= $r['camDesc']; ?></a>
							<br><span><?= get_total_fotos_campana_v2($camID); ?> Fotos.<? if($r['camCad']!='0000-00-00'){ ?><? if($paisID==7){ ?> Expiração <? }else{ ?>Expiración<? } ?>: <strong><?php echo date("d-m-Y", strtotime($r['camCad'])); ?></strong><? } ?></span><br>
							<?	if($usuTipo==99){
								$sql2  = "select * from campana_x_pais_v2 where camID = $camID";
							  	$resultado2 = $db->rawQuery($sql2);
								if($resultado2){
									foreach ($resultado2 as $r2) {
										$paises .= get_pais_nom($r2['paisID']) . ', ';
						    		} 
							 } ?>
							<span class="azultxt"><?php echo substr($paises, 0,-2); ?></span>
							<? } ?>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="catalogo_v2.php?camID=<?= $r['camID']; ?>" class="btn btn-default"><i class="fa fa-camera"></i><span class="hidden-xs"> Fotos</span></a> 
							<a href="javascript:void(0);" class="btn btn-default btnPDF" data-camid="<?php echo $camID; ?>" style="margin-top:5px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i><span class="hidden-xs"> PDF</span></a> 
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
							
					    	<? 
									if($usuTipo==99){
										$back = 'home.php';
									}else{
										$back = 'maestros.php';
									}
							?>
							<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> <? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> Salir</a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>	    

		    
<? include('footer.php'); ?>




