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
?>

    <div class="container" id="argumentos">
	    
	    
		<header>
		    <span><? if($paisID==7){ ?>Fornecedores<? }else{ ?>Proveedores<? } ?></span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-6">
							<h2><? if($paisID==7){ ?>Tudo<? }else{ ?>Todos<? } ?></h2>
				    	</div>
				    	<div class="col-xs-6 text-right">
							<a href="formulario-proveedores.php" class="btn btn-default"><span class="hidden-xs"><? if($paisID==7){ ?>Adicionar<? }else{ ?>Agregar<? } ?> </span><i class="fa fa-plus-circle"></i></a>
				    	</div>
				    </div>
			    </div>
			<?
				$sql  = "select * from proveedores where paisID = $paisID";

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
		    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion <?= $tipo; ?>" id="tienda-<?= $r['tieID']; ?>">
					<div class="row">
						<div class="col-xs-9 postema">
							<a href="formulario-proveedores.php?provID=<?= $r['provID']; ?>"><?= $r['provNom']; ?></a>
							<br><span><?= $r['provCon']; ?> <?= $r['provTel']; ?> <?= $r['provMail']; ?></span>
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="formulario-proveedores.php?provID=<?= $r['provID']; ?>" class="btn btn-default"><i class="fa fa-pencil"></i><span class="hidden-xs"> Editar</span></a> 
						</div>
					</div>

				</div>
		    <? 		} 
			    } ?>
			    		    
		    </div>
		    
	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'maestros.php';
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




