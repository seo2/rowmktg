<? include('header.php'); ?>
    <div class="container" id="recuperar">
	    
	    <header>
		    <a href="login.php">
		    	<i class="fa fa-chevron-left"></i> 
		    </a>
		    <span>Nueva Contraseña</span>
	    </header>
	    <form action="ajax/restaurar.php" method="post" accept-charset="utf-8" id="formRestaurar" class="seva">
    	
	    	<div class="row">
		    	<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
		    		<a href="javascript:void(0);" class="btn-fb"><i class="fa fa-facebook"></i> Iniciar con Facebook</a>
		    	</div>
	    	</div>
	    	<div class="row">
		    	<div class="col-xs-10 col-xs-offset-1">
			    	<?
					$token = $_GET['token'];
					$db->where ("usuToken", $token);
					$user = $db->getOne ("usuario");
					
					if ($user['usuID']) {
						
						$usuID = $user['usuID'];	
				    ?>
			    	<div class="row">
				    	<h2 class="text-center"> Escribe tu nueva contraseña</h2>
			    	</div>
					<div class="form-group ">
						<div class="input-group">
							<input type="hidden" name="usuID" value="<?= $usuID; ?>">
							<input type="hidden" name="username" value="<?= $user['usuNomUsu']; ?>">
							<input type="password" name="password" class="form-control" id="test1" placeholder="Contraseña (6 caracteres mínimo)" required>
							<div class="input-group-addon" id="mostrarpass2"><i class="fa fa-eye"></i></div>
						</div>
					</div>
					<? }else{ ?>
						
			    	<div class="row">
				    	<h2 class="text-center"> Este contenido ya caducó</h2>
			    	</div>
					<? } ?>
		    	</div>
	    	</div>
	    	
	    	<footer>
		    	<button type="submit" id="btnRecuperar"><span>Confirmar</span> <i class="fa fa-chevron-right"></i></button>
	    	</footer>
	    	
	    </form>
    	
<? include('footer.php'); ?>