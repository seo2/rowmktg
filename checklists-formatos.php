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
$classbody='gradiente1';
	include('header.php');

	
?>

    <div class="container" id="posiciones">

	    
	    <header>
		    <span>Formato de Tiendas</span>
	    </header>
			<div class="row">
				
				<div class="col-sm-4 col-sm-offset-4 col-xs-10 col-xs-offset-1 cajita" >
					<br>
		<?
			$sql  = "select * from formatos";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
	    ?>   
					<a href="checklists-tiendas.php?formID=<?= $r['formID']; ?>" class="btn btn-primary btn-lg btn-block"><?= $r['formDesc']; ?></a>
					<br>
	    <?  	} 
		    } ?>

						
						
						
				</div>
			</div>

	    	<footer class="animated bounceInRight">
		    	<a href="home.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>
<? include('footer.php'); ?>