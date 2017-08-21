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
	
	$clID = $_GET['clID'];
	$checklist = get_checklist_nom($clID);
	
	$sql  = "select * from checklist_detalle where clID = $clID";


?>

    <div class="container" id="argumentos">
	    
	    
		<header>
		    <span>Detalle <?= $checklist; ?></span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
					<div class="row">
				    	<div class="col-xs-9">
				    	</div>
				    	<div class="col-xs-3 text-right">
				    		<a href="formulario-checklists-detalle.php?clID=<?php echo $clID; ?>" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
				    	</div>
					</div>
				</div>
			    
			<?
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
		    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
						<div class="col-xs-9 postema">
							<a href="formulario-checklists-detalle.php?clID=<?= $r['clID']; ?>&cldID=<?php echo  $r['cldID']; ?>"><?= $r['cldItem']; ?></a>
							<br><span><i class="fa fa-map-marker" aria-hidden="true"></i> <?= get_zona($r['cldZona']); ?></span>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="formulario-checklists-detalle.php?clID=<?= $r['clID']; ?>&cldID=<?php echo  $r['cldID']; ?>" class="btn btn-default"><i class="fa fa-edit" aria-hidden="true"></i> <span class="hidden-xs">Editar</span></a> 
						</div>
					</div>

				</div>
		    <? 		} 
			    } ?>
			    		    
		    </div>

		    	
	    	<footer class="animated bounceInRight">
		    	<a href="checklists-maestro-checklists.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    

		    
<? include('footer.php'); ?>




