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
	$sql  = "select * from checklist where clForm = $formID";
}else{
	$formato = "";
	$sql  = "select * from checklist";
}

?>

    <div class="container" id="argumentos">
	    
	    
		<header>
		    <span>Checklists <?= $formato; ?></span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
					<div class="row">
				    	<div class="col-xs-9">
				    	</div>
				    	<div class="col-xs-3 text-right">
				    		<a href="formulario-checklists.php" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
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
							<a href="formulario-checklists.php?clID=<?= $r['clID']; ?>"><i class="fa fa-edit" aria-hidden="true"></i> <?= $r['clNom']; ?></a>
							<br><span><?= get_formato($r['clFor']); ?></span>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="checklists-maestro-checklists-detalle.php?clID=<?= $r['clID']; ?>" class="btn btn-default"><i class="fa fa-list" aria-hidden="true"></i> <span class="hidden-xs">Detalle</span></a> 
						</div>
					</div>

				</div>
		    <? 		} 
			    } ?>
			    		    
		    </div>

		    	
	    	<footer class="animated bounceInRight">
		    	<a href="maestros.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    

		    
<? include('footer.php'); ?>




