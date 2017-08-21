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
	
	$campana = get_campana_desc($camID);
	
	if($_GET['catID'] ){
		$catID = $_GET['catID'];
		$sql  = "select * from catalogo where catID = $catID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				
				$camDesc = $r['camDesc'];
				$camFile = $r['camFile'];
				$camEst  = $r['camEst'];
				
	 		} 
	    }	
		$opcion = 'Modificar';		
	}else{
		$opcion = 'Agregar';
	}
	
	
?>
<? //include('menu.php'); ?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span>Campaña <?= $campana; ?></span>
	    </header>

		    <div id="cajaposiciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
			    	<h2><?= $opcion; ?> Item Catálogo</h2>
			    </div>
 
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion">
					<div class="row">
					
					<form action="ajax/graba-catalogo.php" method="post" accept-charset="utf-8" id="formCatalogo">
					
							<div class="form-group">
								<label class="ptdCan">Nombre:</label>
								<input type="text" class="form-control" id="camDesc" placeholder="Nombre del elemento" name="camDesc" value="<?= $camDesc; ?>" required>
								<input type="hidden" name="camID" value="<?= $camID; ?>">
								<? if($_GET['catID'] ){?>
								<input type="hidden" name="catID" 	value="<?= $catID; ?>">
								<input type="hidden" name="camFile" value="<?= $camFile; ?>">
								<? } ?>
							</div>
							<? if($camFile){ ?>
						<div class="form-group">
					    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
								<input type="file" id="uploadFoto" name="foto">
					    	</div>
						</div>
						<div class="form-group">
				    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
								<i class="fa fa-camera"></i> Cambiar Foto
							</button>
						</div>		
						<div class="row">
							<div class="col-xs-offset-3 col-xs-6">
					    		<div id="fotito">
					    			<img src="resize2.php?img=<?= $camFile; ?>&width=640&height=640&mode=fit" class="img-responsive" id="fotoperfil" >
					    		</div>
					    	</div>	
						</div>	
						<? }else{?>					
					
						<div class="form-group">
					    	<div class="col-xs-10 col-xs-offset-1" id="campofoto"style="display:none;">
								<input type="file" id="uploadFoto" name="foto">
					    	</div>
						</div>
						<div class="form-group">
				    		<button type="button" onclick="document.getElementById('uploadFoto').click(); return false" class="btn btn-primary" id="subefoto">
								<i class="fa fa-camera"></i> Agregar Foto
							</button>
						</div>		
						<div class="row">
							<div class="col-xs-offset-3 col-xs-6">
					    		<div id="fotito" style="display:none;">
					    			<img src="" class="img-responsive" id="fotoperfil" >
					    		</div>
					    	</div>	
						</div>	
						<? } ?>		
						<hr>
						<div class="form-group">
							<label for="ptdGra">Estado:</label>
							<select class="form-control" name="camEst" required id="pieEst">
								<option value="0" <? if($camEst==0){ ?>selected<? } ?>>Activo</option>
								<option value="1" <? if($camEst==1){ ?>selected<? } ?>>Inactivo</option>
							</select>
						</div>	
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
							<button type="submit" class="btn btn-primary" data-posicion="" id="btnGrabaVitrina"><i class="fa fa-floppy-o"></i> Guardar</a>
						</div>
					</div>
	  			</form>
      		</div>
      </div>
    </div>
  </div>
</div>  

   
<? include('footer.php'); ?>