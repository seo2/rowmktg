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
	
	if($_GET['usuID']){
		$usuID 	= $_GET['usuID'];
		$sql  	= "select * from usuario where usuID = $usuID";
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$usuTipo 	= $r['usuTipo'];
				$usuNom 	= $r['usuNom'];
				$usuApe 	= $r['usuApe'];
				$usuMail 	= $r['usuMail'];
				$usuEst 	= $r['usuEst'];
	 		} 
	    }			
	    if($usuTipo==2 || $usuTipo==4 ){
		    $hide = '';
	    }else{
		    $hide = 'hide';
	    }
	    if($paisID==7){
			$opcion = 'Editar';	
		}else{
			$opcion = 'Modificar';	
		} 
	}else{
	    if($paisID==7){
			$opcion = 'Adicionar';	
		}else{
			$opcion = 'Agregar';	
		} 
		$hide = 'hide';
	}
	
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span></span>
	    </header>

		    <div id="cajaposiciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    	<h2><?= $opcion; ?> <? if($paisID==7){ ?>Usuário<? }else{ ?>Usuario<? } ?></h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" >
					<div class="row">
					
					<form action="ajax/graba-usuario.php" method="post" accept-charset="utf-8" id="formUsuario">
						<div class="form-group">
							<label for="ptdGra">Tipo:</label>
							<select class="form-control" name="usuTipo" required id="usuTipo">
								<option value="">Seleccione</option>
								<?
									if($usuTipo<99){
										$tema = $db->rawQuery('select * from usuTipos where utipID<99 order by utiDesc');
									}else{
										$tema = $db->rawQuery('select * from usuTipos where utipID==99 order by utiDesc');
									}
								if($tema){
									foreach ($tema as $t) {
								?>
								<option value="<?= $t['utipID']; ?>" <? if($t['utipID']==$usuTipo){ ?>selected<? } ?>><?= $t['utiDesc']; ?></option>
								<?		
									}
								}
								?>
							</select>
						</div>
						<div class="form-group hide" id="proveedor">
							<label for="ptdGra"><? if($paisID==7){ ?>Fornecedor<? }else{ ?>Proveedor<? } ?>:</label>
							<select class="form-control" name="usuProv" required id="usuProv">
								<option value="0"><? if($paisID==7){ ?>Selecionar<? }else{ ?>Seleccione<? } ?></option>
								<?
								$tema = $db->rawQuery("select * from proveedores where paisID = $paisID");
								if($tema){
									foreach ($tema as $t) {
								?>
								<option value="<?= $t['provID']; ?>" <? if($t['provID']==$usuProv){ ?>selected<? } ?>><?= $t['provNom']; ?></option>
								<?		
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label class="ptdCan"><? if($paisID==7){ ?>Nome<? }else{ ?>Nombre<? } ?>:</label>
							<input type="text" class="form-control" id="usuNom" placeholder="" name="usuNom" value="<?= $usuNom; ?>" required>
							<input type="hidden" name="paisID" 	value="<?= $paisID; ?>">
						</div>
						<div class="form-group">
							<label class="ptdCan"><? if($paisID==7){ ?>Sobrenome<? }else{ ?>Apellido<? } ?>:</label>
							<input type="text" class="form-control" id="usuApe" placeholder="" name="usuApe" value="<?= $usuApe; ?>" required>
						</div>
						<? if($_GET['usuID']){ ?>
						<div class="form-group">
							<label class="ptdCan">E-mail:</label>
							<input type="email" class="form-control" id="usuMail" placeholder="Se usará para conectarse" name="usuMail" value="<?= $usuMail; ?>">
						</div>
							<input type="hidden" name="usuID" 	value="<?= $_GET['usuID']; ?>">
					    	<a class="btn btn-primary" id="btnpass" href="formulario-cambiar-password.php?usuID=<?= $_GET['usuID']; ?>"><i class="fa fa-floppy-o"></i> <? if($paisID==7){ ?>Alterar senha<? }else{ ?>Cambiar Contraseña<? } ?></a>
						
						<br><br>
						<? }else{ ?>
						<div class="form-group">
							<label class="ptdCan">E-mail:</label>
							<input type="email" class="form-control" id="usuMail" placeholder="<? if($paisID==7){ ?>Ele será usado para conectar<? }else{ ?>Se usará para conectarse<? } ?>" name="usuMail" value="<?= $usuMail; ?>" required>
						</div>
						<div class="form-group">
							<label class="ptdCan"><? if($paisID==7){ ?>Senha<? }else{ ?>Contraseña<? } ?>:</label>
							<input type="password" class="form-control" id="usuPass" placeholder="" name="usuPass" required>
						</div>
						<div class="form-group">
							<label class="ptdCan">Confirmar:</label>
							<input type="password" class="form-control" id="usuPass2" placeholder="" name="usuPass2" required>
						</div>
						<? } ?>

						<div class="form-group <?php echo $hide; ?>" id="formatos">
							<?
								$sql  = "select * from formatos";
							  	$resultado = $db->rawQuery($sql);
								if($resultado){
									foreach ($resultado as $r) {
										$ok = 0;
										if($_GET['usuID'] ){
											$ok = ask_usuario_formato($_GET['usuID'] ,$r['formID']);
										}
						    ?>   								
							<div class="checkbox">
							  <label>
							    <input type="checkbox" name="formato[]" value="<?php echo $r['formID']; ?>" <? if($ok==1){ ?>checked<? } ?>>
							    <?php echo $r['formDesc']; ?>
							  </label>
							</div>
						    <? 		} 
							    } ?>
							
						</div>	
						<div class="form-group">
								<label for="ptdGra"><? if($paisID==7){ ?>Status<? }else{ ?>Estado<? } ?>:</label>
							<select class="form-control" name="usuEst" required id="usuEst">
								<option value="0" <? if($usuEst==0){ ?>selected<? } ?>><? if($paisID==7){ ?>Ativo<? }else{ ?>Activo<? } ?></option>
								<option value="1" <? if($usuEst==1){ ?>selected<? } ?>><? if($paisID==7){ ?>Inativo<? }else{ ?>Inactivo<? } ?></option>
							</select>
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

	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'usuarios.php';
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