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
	
	$camID = $_GET['camID'];
	
	$campana = get_campana_desc($camID);

?>
<? // include('menu.php'); ?>

    <div class="container" id="argumentos">
	    
	    
		<header>
		    <span><?= $campana; ?></span>
	    </header>
		   
		    <div id="cajaposiciones" >
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-6">
							<h2>Items</h2>
				    	</div>
				    	<? if($usuTipo==99){ ?>
				    	<div class="col-xs-6 text-right">
					    	<a href="formulario-campana.php?camID=<?= $camID; ?>" class="btn btn-default"><span class="hidden-xs">Modificar </span><i class="fa fa-edit"></i></a>
					    	<a href="formulario-catalogo.php?camID=<?= $camID; ?>" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
				    	</div>
				    	<? } ?>
				    </div>
			    </div>
			    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" >
			    
			<?
				$sql  = "select * from catalogo where camID = $camID";
	
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
		    ?>   
					<div class="col-xs-6 col-sm-4 posicion" >
				    	<? if($usuTipo==99){ ?>
						<a href="formulario-catalogo.php?camID=<?= $camID; ?>&catID=<?= $r['catID']; ?>" class="btncat btnedit"><i class="fa fa-edit"></i></a>
						<a href="javascript:void(0);" class="btncat btntrash" data-catid="<?= $r['catID']; ?>"><i class="fa fa-trash"></i></a>
				    	<? } ?>
						<img src="resize2.php?img=<?= str_replace('../', '', $r['camFile']) ; ?>&width=200&height=200&mode=fit" class="img-responsive">
					</div>
		    <? 		} 
			    } ?>
		    	</div>		    
		    </div>

		    	
	    	<footer class="animated bounceInRight">
		    	<a href="campana.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span><? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></span></a>
	    	</footer>	    

		    
<? include('footer.php'); ?>




