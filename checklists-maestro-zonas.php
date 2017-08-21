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
?>

    <div class="container" id="argumentos">
	    
	    
		<header>
		    <span>Zonas</span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-6">
							<h2>Todos</h2>
				    	</div>
				    	<div class="col-xs-6 text-right">
							<a href="formulario-zonas.php" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
				    	</div>
				    </div>
			    </div>
			<?
				$sql  = "select * from checklist_zona";

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
		    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
						<div class="col-xs-9 postema">
							<a href="formulario-zonas.php?clzID=<?= $r['clzID']; ?>"><?= $r['clzNom']; ?></a>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="formulario-zonas.php?clzID=<?= $r['clzID']; ?>" class="btn btn-default"><i class="fa fa-pencil"></i><span class="hidden-xs"> Editar</span></a> 
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




