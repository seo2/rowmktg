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
	
	$tieID 		= $_GET['tieID'];
	$formID 	= get_formato_tienda($tieID);
	$formato 	= get_formato($formID);
	
	if($_GET['historial']){
		$clxtEst = 1;
		$icon = 'eye';
		$titulo = 'Historial de Checklists';
	}else{
		$clxtEst = 0;
		$icon = 'edit';
		$titulo = 'Checklists Pendientes';
	}
	
	if($usuTipo==1){ // administrador
		$total = get_total_checklists_pendientes($tieID);
		$sql  = "select * from checklist_x_tienda where clxtTie = $tieID and clxtEst = $clxtEst";
	}elseif($usuTipo==2){ // Retail MKTG
		$total = get_total_checklists_pendientes_x_usuario($tieID,$usuID);
		$sql   = "select * from checklist_x_tienda where clxtTie = $tieID and clxtMM = $usuID and clxtEst = $clxtEst";
	}
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span><?= get_tienda($tieID); ?> | <?php echo $formato; ?></span>
	    </header>

		    <div id="cajaposiciones" data-eveID="<?= $eveID; ?>" data-tiendaID="<?= $tieID; ?>">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-6">
							<h2><?php echo $titulo; ?></h2> 
				    	</div>
<!--
				    	<div class="col-xs-4 text-right">
					    	<? if($ptID && $total > 0){ ?>
					    	<a href="formulario-pedido.php?tieID=<?= $tieID; ?>" class="btn btn-default"><span>Agregar </span><i class="fa fa-plus-circle"></i></a>
							<? } ?>
				    	</div>
-->
				    	<div class="col-xs-6 text-right">
					    	<? if(!$_GET['historial']){ ?>
					    		<a href="checklists.php?tieID=<?php echo $tieID; ?>&historial=1" class="btn btn-default"><span class="hidden-xs">Historial </span><i class="fa fa-history"></i></a>
							<? }else{ ?>
					    		<a href="checklists.php?tieID=<?php echo $tieID; ?>" class="btn btn-default"><span class="hidden-xs">Pendientes</i></a>
							<? } ?>
				    	</div>
				    	
				    	
				    	
				    </div><!-- FIN ROW -->
			    </div>			    
			    
			    
			<?
				
			if($total > 0 || $_GET['historial']){
				
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						
						$fecha = substr($r['clxtTS'],8,2) . '/'. substr($r['clxtTS'],5,2) .'/'. substr($r['clxtTS'],0,4);
						$hora  = substr($r['clxtTS'],11,8);
			?>
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
						<div class="col-xs-9 posevento">
							<a href="formulario-checklists-x-tienda.php?clxtID=<?= $r['clxtID']; ?>" ><?= get_checklist_nom($r['clxtCL']); ?></a>
							<span><strong><?= get_user_nombre($r['clxtMM']); ?></strong></span>
							<br><span class="numpedido">Checklist <strong>Nº <?= $r['clxtID']; ?></strong> del <strong><?= $fecha; ?></strong></span><br>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="formulario-checklists-x-tienda.php?clxtID=<?= $r['clxtID']; ?>" class="btn btn-default" ><i class="fa fa-<?php echo $icon; ?>"></i></a>
						</div>
					</div>

				</div>
		    <?
		     		} 
			    }	?>
			    <? if(!$_GET['historial']){ ?>
				    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
					    <div class="row">
					    	<div class="col-xs-12 text-center">
								<a href="javascript:void(0);" class="btn btn-default" id="btnAgregaChecklist" data-tieid="<?= $tieID; ?>" data-usuid="<?php echo $usuID; ?>"><span>Agregar </span><i class="fa fa-plus-circle"></i></a> 
					    	</div>
					    	
					    </div>
				    </div>
				<? } ?>
			<?
			}else{ ?>
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" >
					<div class="row">
						<div class="col-xs-12 posevento">
							<a href="javascript:void(0);" class="updvit" >No existen checklists pendientes.</a>
							<br><span>Presione agregar para empezar.</span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 text-center">
					    	<br><br><a href="javascript:void(0);" class="btn btn-default btn-lg" id="btnAgregaChecklist" data-tieid="<?= $tieID; ?>" data-usuid="<?php echo $usuID; ?>"><span>Agregar </span><i class="fa fa-plus-circle"></i></a><br><br>
						</div>
					</div>
				</div>
			<?
			}
			?>
			
				<div class="clear"></div>
		    
		    </div>

	    	<footer class="animated bounceInRight">
		    	<a href="checklists-tiendas.php?formID=<?php echo $formID; ?>" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    

 
<? include('footer.php'); ?>