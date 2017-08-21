
<div id="menu" class="animated slideInDown" style="display:none;">
	<div id="menuin" class="text-center">
		<div class="vertical">
			<h1>Hola <?= ucwords(mb_strtolower(get_username($_COOKIE['id']), 'UTF-8')); ?></h1>
			<a href="home.php" ><i class="fa fa-home"></i> Inicio</a>
			<a href="eventos.php" ><i class="fa fa-th-list"></i> Eventos</a>
			<? if($usuTipo==2){ ?>
				<a href="vitrinas.php?tieID=<?= $usuTienda; ?>"><i class="fa fa-user"></i> Vitrinas</a>
			<? }else{ ?>
				<a href="tiendas.php" ><i class="fa fa-user"></i> Vitrinas</a>
			<? } ?>			
			 <? if($usuTipo<2){ ?>
			<a href="formulario-subir.php" ><i class="fa fa-upload"></i> Cargar Eventos</a>
			<? } ?>
			<a href="javascript:void(0);" id="closeMenu2" ><i class="fa fa-times"></i> Cerrar Menú</a>
<br>
			<a href="javascript:void(0);" class="logout" id="logoutBtn"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>
		</div>
	</div>
	
</div>