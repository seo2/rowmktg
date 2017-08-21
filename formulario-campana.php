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
	
	
	if($_GET['camID'] ){
		$camID 	 	= $_GET['camID'];
		$sql  		= "select * from campana where camID = $camID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$camDesc = $r['camDesc'];
				$camEst = $r['camEst'];
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
			    	<h2><?= $opcion; ?> Catálogo</h2>
			    </div>
 
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
						<form action="ajax/graba-campana.php" method="post" accept-charset="utf-8" id="formCampana">
							
							<div class="form-group">
								<label class="ptdCan">Nombre:</label>
								<input type="text" class="form-control" id="camDesc" placeholder="Nombre de la campaña" name="camDesc" value="<?= $camDesc; ?>" required> 
								<? if($_GET['camID'] ){?>
								<input type="hidden" name="camID" 	value="<?= $camID; ?>">
								<? } ?>
							</div>
							
							<? if(!$_GET['camID'] ){?>
							<div class="form-group">
								<label class="ptdCan">Directorio Fotos (opcional):</label>
								<input type="text" class="form-control" id="camDesc" placeholder="Ej: KIDS201/ALPHABOUNCE" name="directorio" value="">
							</div>
							<? } ?>
							<div class="form-group">
								<?
									$sql  = "select * from paises";
								  	$resultado = $db->rawQuery($sql);
									if($resultado){
										foreach ($resultado as $r) {
											$ok = 0;
											if($_GET['camID'] ){
												$ok = ask_pais_campana($_GET['camID'] ,$r['paisID']);
											}
							    ?>   								
								<div class="checkbox">
								  <label>
								    <input type="checkbox" name="pais[]" value="<?php echo $r['paisID']; ?>" <? if($ok==1){ ?>checked<? } ?>>
								    <?php echo $r['paisNom']; ?>
								  </label>
								</div>
							    <? 		} 
								    } ?>
								
							</div>
	
							<div class="form-group">
								<label for="ptdGra">Estado:</label>
								<select class="form-control" name="camEst" required id="camEst">
									<option value="0" <? if($camEst==0){ ?>selected<? } ?>>Activo</option>
									<option value="1" <? if($camEst==1){ ?>selected<? } ?>>Inactivo</option>
									<option value="2" <? if($camEst==2){ ?>selected<? } ?>>Archivado</option>
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
		    	<a href="javascript:window.history.back();" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    

<!-- Modal Vitrina -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
	      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
      		<p id="titacabas"></p>
      		<div class="row">
	  			<form method="post" action="ajax/graba-vitrina.php" accept-charset="utf-8" id="formAddVit" class="col-xs-12">
		  					  			
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<input class="form-control" id="nombre" type="text" name="nombre" value="" placeholder="Nombre" required>
							<input type="hidden" name="tiendaID" value="<?= $tieID; ?>">
							<input type="hidden" name="vitID"  id="vitID" value="">
							<br>
						</div>
					</div>
		  					  			
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<textarea class="form-control" rows="5" name="descripcion" placeholder="Descripción / Medidas" id="argTxt" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-offset-3 col-xs-6">
				    		<div id="fotito" style="display:none;">
				    			<img src="" class="img-responsive" id="fotoperfil" >
				    		</div>
						</div>
					</div>
	  			
					<div class="form-group">
						<div class="col-xs-6 col-xs-offset-3">
							<button type="submit" class="btn btn-primary" data-posicion="" id="btnGrabaVitrina"><i class="fa fa-floppy-o"></i> Guardar</button>
						</div>
					</div>
	  			</form>
      		</div>
      </div>
    </div>
  </div>
</div>  

   
<? include('footer.php'); ?>