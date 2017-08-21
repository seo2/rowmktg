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
	    <? $titulo 	= 'Menú';
		   $tipo 	=  get_usertipo($_COOKIE['id']);
	    ?>
	    
	    <header>
		    <span><? if($paisID==7){ ?>Master<? }else{ ?>Maestros<? } ?></span>
	    </header>
			<div class="row">
				
				<div class="col-sm-4 col-sm-offset-4 col-xs-10 col-xs-offset-1 cajita" >
				
				<h1 class="logo animated fadeIn"><img src="assets/img/rbk.svg" style="margin:10px 0;"></h1>
				<p class="logo animated fadeInDown">Onretail Wholesale Marketing</p>

					<? if($tipo<3){ ?>
						<a href="campana_v2.php" class="btn btn-primary btn-lg btn-block">ISC de Campañas</a>
						<br>
						<a href="formatos.php?piezas=1&FW2017=1" class="btn btn-primary btn-lg btn-block">ISC Long Term</a>
						<hr>
					<? if($tipo<=2){ ?>
						<a href="maestro-tiendas.php" class="btn btn-primary btn-lg btn-block"><? if($paisID==7){ ?>Lojas<? }else{ ?>Tiendas<? } ?></a>
						<br>
						<a href="proveedores.php" class="btn btn-primary btn-lg btn-block"><? if($paisID==7){ ?>Fornecedores<? }else{ ?>Proveedores<? } ?></a>
						<br>
						<a href="usuarios.php" class="btn btn-primary btn-lg btn-block"><? if($paisID==7){ ?>Usuários<? }else{ ?>Usuarios<? } ?></a>
					<? } ?>
					<? if($paisID==1){ ?>
						<hr>
						<a href="checklists-maestro-zonas.php" class="btn btn-primary btn-lg btn-block">Zonas</a>
						<br>
						<a href="checklists-maestro-checklists.php" class="btn btn-primary btn-lg btn-block">Checklists</a>
						<? } ?>
					<? } ?>
				</div>
			</div>

	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'home.php';
							?>
							<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> <? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> <? if($paisID==7){ ?>Sair<? }else{ ?>Salir<? } ?></a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>
<? include('footer.php'); ?>