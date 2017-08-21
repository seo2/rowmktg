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
	
	$campana = get_campana_desc_v2($camID);

?>

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
					    	<a href="formulario-campana_v2.php?camID=<?= $camID; ?>" class="btn btn-default"><span class="hidden-xs">Modificar </span><i class="fa fa-edit"></i></a>
					    	<a href="formulario-catalogo_v2.php?camID=<?= $camID; ?>" class="btn btn-default"><span class="hidden-xs">Agregar </span><i class="fa fa-plus-circle"></i></a>
				    	</div>
				    	<? } ?>
				    </div>
			    </div>
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" >
			<?
				$sql  = "select * from catalogo_v2 where camID = $camID";
	
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
		    ?>   
					<div class="col-xs-6 col-sm-4" id="catv2<?= $r['catID']; ?>">
						<div class="fotCat">
					    <? if($usuTipo==99){ ?>
					    <?
					    	$tienecamp = check_ISC_campana($camID, $r['catID']);
							if($tienecamp == 1) { ?>
					    	<span class="fa-stack fa-lg conISC">
							  <i class="fa fa-circle fa-stack-1x fa-inverse"></i>
							  <i class="fa fa-check-circle fa-stack-1x "></i>
							</span>
							<? } ?>
							<a href="formulario-catalogo_v2.php?camID=<?= $camID; ?>&catID=<?= $r['catID']; ?>" class="btncat btnedit"><i class="fa fa-edit"></i></a>
							<a href="javascript:void(0);" class="btncat btntrash_V2" data-catid="<?= $r['catID']; ?>" data-camid="<?php echo $camID; ?>"><i class="fa fa-trash"></i></a>
					    <? }else{
					    	$tienecamp = check_ISC_campana($camID, $r['catID']);
							if($tienecamp == 1) { ?>
					    	<span class="fa-stack fa-lg conISC">
							  <i class="fa fa-circle fa-stack-1x fa-inverse"></i>
							  <i class="fa fa-check-circle fa-stack-1x "></i>
							</span>
							<? } ?>
							<a href="formulario-catalogo_v2.php?camID=<?= $camID; ?>&catID=<?= $r['catID']; ?>" class="btncat btnedit"><i class="fa fa-search"></i></a>
					    
					    <? } ?>
							<img src="resize2.php?img=<?= str_replace('../', '', $r['camFile']) ; ?>&width=200&height=200&mode=fit" class="img-responsive">
						</div>
					</div>
		    <? 		} 
			    } ?>
		    	</div>		    
		    </div>

		    	
	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'campana_v2.php';		
							?>
							<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> <? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> Salir</a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>		    

		    
<? include('footer.php'); ?>




