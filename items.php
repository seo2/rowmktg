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
	
	
	if($_GET['pagina']){
		$multiplicador 	= $_GET['pagina'] -1;
		$offset 		= 8 * $multiplicador;
		$page   		= $_GET['pagina'];
	}else{
		$offset = 0;
		$page   = 1;
	}
		$limit  = 8;
	$eveID = $_GET['eveID'];
	$tieID = $_GET['tieID'];
?>
<? include('menu.php'); ?>

    <div class="container" id="argumentos">
	    
		   
		   <nav class="navbar navbar-inverse navbar-fixed-top">
			  <div class="container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" id="btnmenu" >
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
				  <a href="javascript:void(0);" id="closeMenu" style="display:none" class="animated fadeInDownBig"><i class="fa fa-times"></i></a>
			      <span>ITEMS</span>
			    </div>
			
			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
			        <li><a href="#">Link</a></li>
			        <li><a href="#">Link</a></li>
			      </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>

		    <div id="cajaposiciones" data-eveID="<?= $eveID; ?>" data-tiendaID="<?= $tieID; ?>">
			    <h2 class="text-center"><?= get_tienda($tieID); ?> <i class="fa fa-arrow-right"></i> <?= get_evento($eveID); ?></h2>
			<?
				$posID = $_GET['posID'];

				$sql  = "select * from items where eveID = $eveID and tiendaID = $tieID";

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
		    ?>   
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion <? if($r['itemEst']==1){ ?>completo<? }else{ ?>incompleto<? } ?>" id="item-<?= $r['itemID']; ?>" data-nom="<?= ucfirst(mb_strtolower($r['itemNom'], 'UTF-8')); ?>"  data-foto="<?= $r['itemFoto']; ?>" data-com="<?= $r['itemCom']; ?>">
					<div class="row">
						<div class="col-xs-9 postema">
							<div class="row">
								<div class="col-xs-2 checka">
									<i class="fa fa-check"></i> 
								</div>
								<div class="col-xs-10">
									<a href="javascript:void(0);" class="subefoto" data-itemid="<?= $r['itemID']; ?>" ><?= ucfirst(mb_strtolower($r['itemNom'], 'UTF-8')); ?></a> <span>(<?= $r['itemCant']; ?>)</span>
								</div>
							</div>
							
						</div>
						<div class="col-xs-3 text-right posvotos">
							<a href="javascript:void(0);" class="btn btn-default subefoto" data-itemid="<?= $r['itemID']; ?>" ><i class="fa fa-camera"></i></a>
						</div>
					</div>

				</div>
		    <? 		} 
			    } ?>
				<div class="clear"></div>
		    </div>
		    <? if($usuTipo<2){ ?>
		    <div class="row" id="acciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3">
				    <div class="row">
				    	<div class="col-xs-6">
					    	<? if(get_fono_tienda($tieID)){ ?>
				    		<a href="tel:<?= get_fono_tienda($tieID); ?>" class="btn btn-primary"><i class="fa fa-mobile"></i></a>
				    		<? } ?>
				    	</div>
				    	<div class="col-xs-6">
					    	<? if(get_mail_tienda($tieID)){ ?>
				    		<a href="mailto:<?= get_mail_tienda($tieID); ?>" class="btn btn-primary"><i class="fa fa-envelope"></i></a>
				    		<? } ?>
				    	</div>
				    	
				    </div>
			    </div>
		    </div>
			<? } ?>
	    	<footer class="animated bounceInRight">
		    	<a href="javascript:window.history.back();" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    


<!-- Modal voto -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
	      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
      		<h3>"Estoy de acuerdo"</h3>
      		<div class="row">
	  			<form method="post" action="ajax/actualiza-item.php" accept-charset="utf-8" id="formItem" class="col-xs-12">
		  			
					<div class="form-group">
						<div class="col-xs-offset-3 col-xs-6">
				    		<div id="fotito" style="display:none;">
				    			<img src="" class="img-responsive" id="fotoperfil" >
				    		</div>
						</div>
			    	</div>
					<div class="form-group">
				    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
							<input type="file" id="uploadFoto" name="foto">
				    	</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<input type="hidden" name="eveID" value="" id="eveID">
							<input type="hidden" name="tiendaID" value="" id="tiendaID">
							<input type="hidden" name="itemID" value="" id="itemID">
							<textarea class="form-control" rows="5" name="argumento" placeholder="Escribe un comentario (opcional)" id="argTxt"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-6">	
				    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
								<i class="fa fa-camera"></i> Subir
							</button>
						</div>
						<div class="col-xs-6">	
							<button type="submit" class="btn btn-primary" data-posicion="" id="btnEnviarArgumento"><i class="fa fa-floppy-o"></i>
 Guardar</button>
						</div>
					</div>
	  			</form>
      		</div>
      </div>
    </div>
  </div>
</div>  

   
<? include('footer.php'); ?>