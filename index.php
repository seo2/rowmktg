<?
	// Begin the session
session_start();

// Unset all of the session variables.
session_unset();

// Destroy the session.
session_destroy();
/*
unset($_COOKIE['id']);
setcookie('id', null, -1, '/');
*/

$cookie_name = 'id';
unset($_COOKIE[$cookie_name]);
$res = setcookie("id", '', time()-3600);
$res = setcookie("id", '', time()-3600, "/", "seo2.cl");
$res = setcookie("id", '', time()-3600, "/ajax/", "seo2.cl");


	include('header.php'); ?>
    <div class="container">
	    
	    <header>
<!-- 		    <span>Inicia Sesión</span> -->
	    </header>
	    <form action="ajax/login.php" method="post" accept-charset="utf-8" id="formLogin" autocomplete="off">
    	
	    	<div class="row">
		    	<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 cajita">
			    	
				
				<h1 class="logo animated fadeIn"><img src="assets/img/rbk.svg" style="margin:10px 0;"></h1>
				<p class="logo animated fadeInDown">On retail & Wholesale Marketing</p>
				<br>
			    	<? if($_GET['restaurado']){ ?>
			    	<p>Tu contraseña ha sido cambiada.</p>
			    	<? }?>
	
					<input style="display:none;" type="email" name="somefakename" />
					<input style="display:none;" type="password" name="anotherfakename" />
			    	
					<div class="form-group">
						<input type="email" name="username" class="form-control" placeholder="Email" value="" required>
						<input type="hidden" name="url" class="form-control" placeholder="url" value="" required>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Contraseña / Senha" value="" required>
					</div>
					<p class="text-center small" id="error">Hay un error en sus datos, por favor verificar.<br>Há um erro em seus dados, verifique</p>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary" id="btnLogin"><span>Entrar</span> <i class="fa fa-sign-in" aria-hidden="true"></i></button>	
					</div>
					<p class="text-center" id="terms">
						<a href="recuperar.php">Olvidé mi contraseña</a>
					</p>
		    	</div>
	    	</div>
	    	
	    </form>
    	
<? include('footer.php'); ?>