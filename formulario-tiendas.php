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
	
	if($_GET['tieID'] ){
		$tieID 	 	= $_GET['tieID'];
		$sql  		= "select * from tiendas where tieID = $tieID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$tieForm 	= $r['tieForm'];
				$tieNom 	= $r['tieNom'];
				$tieFono 	= $r['tieFono'];
				$tieEst 	= $r['tieEst'];
	 		} 
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
	}
	
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span></span>
	    </header>

		    <div id="cajaposiciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    	<h2><?= $opcion; ?> <? if($paisID==7){ ?>Loja<? }else{ ?>Tienda<? } ?></h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-tienda.php" method="post" accept-charset="utf-8" id="formTiendas">
						<div class="form-group">
							<label for="ptdGra">Formato:</label>
							<select class="form-control" name="tieForm" required id="tieForm">
								<option value=""><? if($paisID==7){ ?>Selecionar<? }else{ ?>Seleccione<? } ?></option>
								<?
								$tema = $db->rawQuery('select * from formatos');
								if($tema){
									foreach ($tema as $t) {
								?>
								<option value="<?= $t['formID']; ?>" <? if($t['formID']==$tieForm){ ?>selected<? } ?>><?= $t['formDesc']; ?></option>
								<?		
									}
								}
								?>
							</select>
						</div>
							<div class="form-group">
								<label class="ptdCan"><? if($paisID==7){ ?>Nome<? }else{ ?>Nombre<? } ?>:</label>
								<input type="text" class="form-control" id="tieNom" placeholder="<? if($paisID==7){ ?>Nome da loja<? }else{ ?>Nombre de la tienda<? } ?>" name="tieNom" value="<?= $tieNom; ?>" required>
								<input type="hidden" name="paisID" 	value="<?= $paisID; ?>">
								<? if($_GET['tieID'] ){?>
								<input type="hidden" name="tieID" 	value="<?= $tieID; ?>">
								<? } ?>
							</div>	

							<div class="form-group <?php echo $hide; ?>" id="formatos">
								<label class="ptdCan"><? if($paisID==7){ ?>Exceções<? }else{ ?>Excepciones<? } ?>:</label>
								<?
									$sql  = "select * from usuario where paisID = $paisID and usuTipo <= 2";
								  	$resultado = $db->rawQuery($sql);
									if($resultado){
										foreach ($resultado as $r) {
											
							    ?>   								
								<div class="checkbox">
								  <label>
								    <input type="radio" name="usuario" value="<?php echo $r['usuID']; ?>" <? if($tieFono==$r['usuID']){ ?>checked<? } ?>>
								    <?php echo $r['usuNom']; ?> <?php echo $r['usuApe'];  ?>
								  </label>
								</div>
							    <? 		} 
								    } ?>
								
							</div>
							<div class="form-group">
								<label for="ptdGra"><? if($paisID==7){ ?>Status<? }else{ ?>Estado<? } ?>:</label>
								<select class="form-control" name="tieEst" required id="tieEst">
									<option value="0" <? if($tieEst==0){ ?>selected<? } ?>><? if($paisID==7){ ?>Ativo<? }else{ ?>Activa<? } ?></option>
									<option value="1" <? if($tieEst==1){ ?>selected<? } ?>><? if($paisID==7){ ?>Inativo<? }else{ ?>Inactiva<? } ?></option>
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
								$back = 'maestro-tiendas.php';
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