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
		    <span></span>
	    </header>
	    <div id="cajaposiciones">
		    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
		    	<h2><? if($paisID==7){ ?>Alterar minha senha<? }else{ ?>Cambiar mi contraseña<? } ?></h2>
		    </div>
			<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" >
				<div class="row">
					<form action="ajax/cambiar-password.php" method="post" accept-charset="utf-8" id="formCambiar">
						<? if($_GET['usuID']){ ?>
						<input type="hidden" name="usuID" value="<?= $_GET['usuID']; ?>">
						<? }else{?>
						<input type="hidden" name="usuID" value="<?= $usuID; ?>">
						<? }?>
						<div class="form-group">
							<label class="ptdCan"><? if($paisID==7){ ?>Nova senha<? }else{ ?>Nueva contraseña<? } ?>:</label>
							<input type="password" class="form-control" id="usuPass" placeholder="" name="usuPass" required>
						</div>
						<div class="form-group">
							<label class="ptdCan">Confirmar:</label>
							<input type="password" class="form-control" id="usuPass2" placeholder="" name="usuPass2">
						</div>
						<hr>
						<div class="form-group text-right">
					    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Salvar<? }else{ ?>Grabar<? } ?></button>
						</div>
					</form>
				</div>
			</div>
			<div class="clear"></div>
	    </div>

    	<footer class="animated bounceInRight">
	    	<a href="javascript:window.history.back();" id="btnvolver"><i class="fa fa-chevron-left"></i> <span><? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></span></button>
    	</footer>	    

   
<? include('footer.php'); ?>