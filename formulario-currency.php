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
		
	if($_GET['rexID'] ){
		$rexID 	 	= $_GET['rexID'];
		$sql  		= "select * from rate_exchange where rexID = $rexID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$rexPais = $r['rexPais'];
				$rexCurr = $r['rexCurr'];
				$rexVal  = $r['rexVal'];
				$rexAno  = $r['rexAno'];
				$rexEst  = $r['rexEst'];
	 		} 
	    }		
		$opcion = 'Modificar';	
	}else{
		
		$opcion = 'Agregar';
	}
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span></span>
	    </header>

		    <div id="cajaposiciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    	<h2><?= $opcion; ?> Currency</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-currency.php" method="post" accept-charset="utf-8" id="formStd">
							<div class="form-group">
								<label for="ptdGra">Pais:</label>
								<select class="form-control" name="rexPais" required id="rexPais">
									<option value="">Seleccione</option>
									<?
									$tema = $db->rawQuery('select * from paises');
									if($tema){
										foreach ($tema as $t) {
									?>
									<option value="<?= $t['paisID']; ?>" <? if($t['paisID']==$rexPais){ ?>selected<? } ?>><?= $t['paisNom']; ?></option>
									<?		
										}
									}
									?>
								</select>
							</div>
							
							<div class="form-group">
								<label class="ptdCan">Divisa</label>
								<input type="text" class="form-control" id="rexCurr" placeholder="Currency" name="rexCurr" value="<?= $rexCurr; ?>">
							</div>
							
							<div class="form-group">
								<label class="ptdCan">Año:</label>
								<input type="text" class="form-control" id="rexAno" placeholder="Año" name="rexAno" value="<?= $rexAno; ?>">
							</div>
							
							<div class="form-group">
								<label class="ptdCan">Valor:</label>
								<input type="text" class="form-control" id="rexVal" placeholder="Valor del euro en moneda local" name="rexVal" value="<?= $rexVal; ?>">
								<? if($_GET['rexID'] ){?>
								<input type="hidden" name="rexID" 	value="<?= $rexID; ?>">
								<? } ?>
							</div>
	
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="rexEst" required id="rexEst">
									<option value="0" <? if($rexEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($rexEst==1){ ?>selected<? } ?>>Inactivo</option>
								</select>
							</div>			
							<hr>
							<div class="form-group text-right">
						    	<button type="submit" class="btn btn-primary" id="btngrabar"><i class="fa fa-floppy-o"></i> Grabar</button>
							</div>
							
						</form>
					
					</div>

				</div>
				<div class="clear"></div>
		    </div>

	    	<footer class="animated bounceInRight">
		    	<a href="currency.php" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    

   
<? include('footer.php'); ?>