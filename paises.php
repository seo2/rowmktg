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
	include('header.php');
							
?>		

    <div class="container" id="posiciones">

	    
	    <header>
		    <span>Paises</span>
	    </header>
			<div class="row">
				
				<div class="col-sm-4 col-sm-offset-4 col-xs-10 col-xs-offset-1 cajita" >
					<br>
		<?
			$sql  = "select * from paises order by paisNom";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
	    ?>   
					<a href="dashboard.php?paisID=<?= $r['paisID']; ?>" class="btn btn-primary btn-lg btn-block">
						<?= $r['paisNom']; ?>
					</a>
					<br>
	    <?  	} 
		    } ?>	
					<hr>
					<a href="dashboardxpais.php" class="btn btn-primary btn-lg btn-block">
						Total
					</a>
					<br>	
				</div>
			</div>

	    	<footer class="animated bounceInRight">
		    	<a href="home.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>
<? include('footer.php'); ?>