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
		    <span>Mercados</span>
	    </header>
	    
	    <div id="cajaposiciones" >
		    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    <div class="row">
			    	<div class="col-xs-6">
						<h2>Paises</h2>
			    	</div>
					<? if($usuTipo == 99){ ?>
			    	<div class="col-xs-6 text-right">
						<a href="formulario-mercados.php" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
			    	</div>
			    	<? } ?>
			    </div>
		    </div>
		<?
			$sql  = "select * from paises order by paisNom";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
	    ?>   
			<div class="col-xs-12 col-md-6 col-md-offset-3 posicion <?= $tipo; ?>" id="tienda-<?= $r['tieID']; ?>">
				<div class="row">
					<div class="col-xs-9 postema">
						<a href="formulario-mercados.php?paisID=<?= $r['paisID']; ?>"><?= $r['paisNom']; ?></a>
					</div>
					<div class="col-xs-3 text-right posvotos">
						<a href="formulario-mercados.php?paisID=<?= $r['paisID']; ?>" class="btn btn-default"><i class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a> 
					</div>
				</div>

			</div>
	    <?  	} 
		    } ?>			    		    
	    </div>
	    	
    	<footer class="animated bounceInRight">
	    	<?
		    	if($_GET['piezas']){
			    	if($usuTipo == 99){ 
			?>
	    		<a href="home.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
			<?		}else{ ?>
	    		<a href="maestros.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
			<? }
				
				}else{
			?>
	    		<a href="javascript:window.history.back();" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
			<?
				}
			?>
    	</footer>	    

<? include('footer.php'); ?>