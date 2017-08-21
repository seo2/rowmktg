<? 
	
session_start();
	if($_SESSION['todos']['Logged']){ 
	
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
	
	if($_GET['AAAA']){	
		$aaaa = $_GET['AAAA']; 
	}else{
		$aaaa = date("Y"); 
	}
	
?>

    <div class="container" id="argumentos">
	    
	    
		<header>
		    <span>Rate Exchange</span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-6">
					    	<h2>Valor Euro por país</h2>
				    	</div>
				    	<div class="col-xs-6 text-right">
							<a href="formulario-currency.php" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
				    	</div>
				    </div>
			    </div>
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-3">
							<h2><strong>País</strong></h2>
				    	</div>
				    	<div class="col-xs-3">
							<h2><strong>Divisa</strong></h2>
				    	</div>
				    	<div class="col-xs-3 text-right">
							<h2><strong><?php echo $aaaa; ?></strong></h2>
				    	</div>
				    </div>
			    </div>
			<?
				$sql0  = "select * from paises order by paisNom";

			  	$paises = $db->rawQuery($sql0);
				if($paises){
					foreach ($paises as $p) {
						$rexPais = $p['paisID'];
		    ?>   
				<?
					$sql  = "select * from rate_exchange where rexPais = $rexPais and rexAno = $aaaa and rexEst = 0 group by rexPais";
	
				  	$resultado = $db->rawQuery($sql);
					if($resultado){
						foreach ($resultado as $r) {
			    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion <?= $tipo; ?>" >
					<div class="row">
						<div class="col-xs-3 postema">
							<?= get_pais_nom($r['rexPais']); ?>
						</div>
						<div class="col-xs-3 postema">
							<?= $r['rexCurr']; ?>
						</div>
						<div class="col-xs-3 postema text-right">
							<?= $r['rexVal']; ?>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="formulario-currency.php?rexID=<?= $r['rexID']; ?>" class="btn btn-default"><i class="fa fa-edit"></i> <span class="hidden-xs">Editar</span></a> 
						</div>
					</div>

				</div>
			    <? 		} 
				    } ?>
			    	
		    <? 		} 
			    } ?>	    
		    </div>

		    	
	    	<footer class="animated bounceInRight">
		    	<a href="home.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    

		    
<? include('footer.php'); ?>




