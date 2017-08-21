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
	
	$clxtID 	= $_GET['clxtID'];
	$sql  		= "select * from checklist_x_tienda where clxtID = $clxtID";
	
    $resultado = $db->rawQuery($sql);
	if($resultado){
		foreach ($resultado as $r) {
			$clxtTie = $r['clxtTie'];
			$clxtCL  = $r['clxtCL'];
			$clxtMM  = $r['clxtMM'];
			$clxtCom = $r['clxtCom'];
			$clxtEst = $r['clxtEst'];
			$clxtTs  = $r['clxtTS'];
			$clxtIntro = $r['clxtIntro'];
		}
	}
	
	if($clxtEst==0){
		$opcion = 'Completar ';	
	}else{
		$opcion = '';	
	}
	
	$tienda  	= get_tienda($clxtTie);
	$formato 	= get_formato(get_formato_tienda($clxtTie));
	$checklist 	= get_checklist_nom($clxtCL);
	$fecha 		= substr($clxtTs,8,2) . '/'. substr($clxtTs,5,2) .'/'. substr($clxtTs,0,4);
	$hora  		= substr($clxtTs,11,8);
	
	
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span><?php echo $tienda; ?> | <?php echo $formato; ?></span>
	    </header>

		    <div id="cajaposiciones">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead" style="border:none">
			    	<h2><?= $opcion; ?><strong><?php echo $checklist; ?></strong> <span><?php echo $fecha; ?></span></h2>
			    </div>

				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" style="border:none">
					<div class="row">

				<? if($clxtEst>0 && $clxtIntro){ ?>
				<div style="padding:0 15px 20px; color:#000;">
		    		<p style="margin: 5px 0 15px; line-height:150%;"><?php echo $clxtIntro; ?></p>
				</div>
				<? } ?>
	<?
	$sql  		= "select * from checklist_detalle where clID = $clxtCL group by cldZona";
	
    $resultado = $db->rawQuery($sql);
	if($resultado){
		foreach ($resultado as $r) {
			$cldID 	  = $r['cldID'];
			$cldZona  = $r['cldZona'];
	?>	
			
			
			<div style="padding: 5px 10px 5px; color: #2196f3; font-weight:lighter;border-bottom: 2px solid #2196f3; font-size:16px;">
				 <i class="fa fa-location-arrow" aria-hidden="true"></i> <?php echo get_zona($cldZona); ?>:
			</div>				
		<?
		$sql  		= "select * from checklist_detalle where clID = $clxtCL and cldZona = $cldZona";
		
	    $resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$cldID 	 = $r['cldID'];
				$cldItem = $r['cldItem'];
				$cldCom  = $r['cldCom'];
		?>								
			<?
			$sql  		= "select * from checklist_x_tienda_detalle where clxtID = $clxtID and clxtdClID = $clxtCL and clxtdClDID = $cldID";
			
		    $resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
					$clxtdStatus 	= $r['clxtdStatus'];
					$clxtdCom 		= $r['clxtdCom'];
					
				}
			}
			?>	
			
			<div style="border-bottom: 1px solid #ccc; position: relative; padding-bottom:10px;">
				<div style="font-size: 14px; padding: 10px 15px 0;color: #000;">
					<strong><?php echo $cldItem; ?></strong> 					
					<? if($clxtEst==1){ ?>
						<? if($clxtdStatus==1){ ?>
						<span class="statusOK" style="color: #5cb85c;font-size: 12px;">OK</span>
						<? }elseif($clxtdStatus==2){ ?>
						<span class="statusNotOK" style="color: #d9534f;font-size: 12px;">Not OK</span>
						<? }elseif($clxtdStatus==3){ ?>
						<span class="statusNoAplica" style="color: #333;font-size: 12px;">No aplica</span>
						<? } ?>
					<? } ?>
				</div>				
				<? if($clxtEst==0){ ?>
				<form>
					<div class="form-group"> 	
						<label class="radio-inline">
						  <input type="radio" name="clxtdStatus" class="clxtdStatus" value="1" data-clxtid="<?php echo $clxtID; ?>" data-clxtdclid="<?php echo $clxtCL; ?>" data-clxtdcldid="<?php echo $cldID; ?>" <? if($clxtdStatus==1){ ?>checked<? } ?>> OK
						</label>
						<label class="radio-inline">
						  <input type="radio" name="clxtdStatus" class="clxtdStatus" value="2" data-clxtid="<?php echo $clxtID; ?>" data-clxtdclid="<?php echo $clxtCL; ?>" data-clxtdcldid="<?php echo $cldID; ?>" <? if($clxtdStatus==2){ ?>checked<? } ?>> Not OK
						</label>
						<label class="radio-inline">
						  <input type="radio" name="clxtdStatus" class="clxtdStatus" value="3" data-clxtid="<?php echo $clxtID; ?>" data-clxtdclid="<?php echo $clxtCL; ?>" data-clxtdcldid="<?php echo $cldID; ?>" <? if($clxtdStatus==3){ ?>checked<? } ?>> No aplica
						</label>
					</div>
					<div class="form-group">
						<textarea class="form-control clxtdCom" placeholder="Comentario:" name="clxtdCom" data-clxtid="<?php echo $clxtID; ?>" data-clxtdclid="<?php echo $clxtCL; ?>" data-clxtdcldid="<?php echo $cldID; ?>"><?php echo $clxtdCom; ?></textarea>
						<? if($cldCom!=0 || $cldCom){ ?>
						<small>* <?php echo $cldCom; ?></small>
						<? } ?>
					</div>	
					
				</form>		
				<? }else{ ?>
				<div style="padding:0 15px;">	
		    		<p style="margin: 5px 0 10px; font-size: 12px;"><?php echo $clxtdCom; ?></p>
				</div>
				<? } ?>
				<!-- fin comentarios -->

				<!-- Fotos Adjuntas -->
				
				<? if($clxtEst==0){ ?>
				<div class="col-lg-12">
					<div class="row text-right">
						<div class="col-lg-12">
							<a href="javascript:void(0);" class="btn btn-default btnFotosChecklists" data-clxtdclid="<?php echo $clxtCL; ?>" data-clxtdcldid="<?php echo $cldID; ?>">Agregar Foto <i class="fa fa-camera" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
				<? } ?>
				<div class="col-lg-12">
					<div class="row" id="fotitos">
						<?
						$sql = "select * from checklist_x_tienda_detalle_fotos where clxtID = $clxtID and clxtdClID = $clxtCL and clxtdClDID = $cldID";
						
					    $resultado = $db->rawQuery($sql);
						if($resultado){
							foreach ($resultado as $r) {
								$clxtdfFile 	= $r['clxtdfFile'];
						?>					
						<div class="col-xs-4 fotospedido" style="padding: 0 5px;">
							<a href="javascript:void(0);" class="pedfoto" data-ptid="<?= $ptID; ?>"  data-ptditem="<?= $ptditem; ?>" data-foto="ajax/uploads/<?= $clxtdfFile; ?>" data-titulo="Foto"  >
								<img src='resize3.php?img=ajax/uploads/<?php echo $clxtdfFile; ?>&width=400&height=400&mode=fit' class="img-responsive" style="border: 1px solid #ccc; padding: 5px">		
							</a>
						</div>				
						<?
							
							}
						}
						?>		
						<div style="clear:both;"></div>
					</div>
				</div>	
				<div style="clear:both;"></div>					
			</div>					
		<?
			
			}
		}
		?>					
	<?
		
		}
	}
	?>							
			<? if($clxtEst==0){ ?>					
			<div style="padding: 25px 15px 5px; color: #000; font-weight:lighter;margin-bottom:10px;">
				Texto de introducción al correo:
			</div>	
			<div style="position: relative;">
				<form>

					<div class="form-group">
						<textarea class="form-control clxtIntro" placeholder="Introducción:" name="clxtIntro"  data-clxtid="<?php echo $clxtID; ?>" data-clxtdclid="<?php echo $clxtCL; ?>"><?php echo $clxtIntro; ?></textarea>
					</div>	
					
				</form>	
				<!-- fin comentarios -->					
			</div>	
			<? } ?> 			
			<div style="padding: 25px 15px 5px; color: #000; font-weight:lighter;margin-bottom:10px;">
				Comentario y conclusiones:
			</div>	
			<div style="position: relative;">
				<? if($clxtEst==0){ ?>
				<form>

					<div class="form-group">
						<textarea class="form-control clxtCom" placeholder="Comentario:" name="clxtCom"  data-clxtid="<?php echo $clxtID; ?>" data-clxtdclid="<?php echo $clxtCL; ?>"><?php echo $clxtCom; ?></textarea>
					</div>	
					
				</form>	
				<? }else{ ?>
				<div style="padding:0 15px 20px; color:#000;">
		    		<p style="margin: 5px 0 15px; line-height:150%;"><?php echo $clxtCom; ?></p>
		    		<p><strong><?php echo get_user_nombre($clxtMM); ?></strong></p>
				</div>
				<? } ?>
				<!-- fin comentarios -->					
			</div>	 
					
					</div>

				</div>	
			
				<? if($clxtEst==0){ ?>
				
				<div class="clear"></div>
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
				    <div class="row">
				    	<div class="col-xs-12 text-center">
							<a href="javascript:void(0);" class="btn btn-default btnenviarChecklist" data-clxtid="<?php echo $clxtID; ?>" >Terminar y Enviar <i class="fa fa-envelope" aria-hidden="true"></i></a> 
				    	</div>
				    </div>
			    </div>
				<? }else{ ?>
				
				<div class="clear"></div>
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
				    <div class="row">
				    	<div class="col-xs-12 text-center">
							<a href="javascript:void(0);" class="btn btn-default btnenviarChecklist" data-clxtid="<?php echo $clxtID; ?>" >Volver a enviar <i class="fa fa-envelope" aria-hidden="true"></i></a> 
				    	</div>
				    </div>
			    </div>
				<? } ?>
				<div class="clear"></div>
		    </div>

	    	<footer class="animated bounceInRight">
		    	<a href="checklists.php?tieID=<?php echo $clxtTie; ?>" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    



<!-- Modal Foto -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p id="titacabas2"></p>
  		<div class="row">	
			<div class="col-xs-12">
	   			<img src="" class="img-responsive" id="fotoperfil2" >
			</div>
  		</div>
      </div>
    </div>
  </div>
</div>  

<!-- Modal -->
<div class="modal fade" id="ModalFotos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p><strong>Agregar Foto</strong></p>
  		<p id="nombreitem"></p>
  		<div class="row">
  			<form method="post" action="ajax/agrega-foto-checklists-detalle.php" accept-charset="utf-8" id="formFotos" class="col-xs-12">
	  					  				  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input type="hidden" name="clxtID" 	 	value="<?= $clxtID; ?>">
						<input type="hidden" name="clxtdClID"   id="ClID" value="">
						<input type="hidden" name="clxtdClDID"  id="ClDID"  value="">
						<br>
					</div>
				</div>
				
				<div class="form-group">
			    	<div class="col-xs-10 col-xs-offset-1" id="campofoto2" style="display:none;">
						<input type="file" id="uploadFoto2" name="foto">
			    	</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
			    		<button type="button" onclick="document.getElementById('uploadFoto2').click(); return false" class="btn btn-primary" id="subefoto2">
							<i class="fa fa-camera"></i> Agregar Foto
						</button>
						<br>
					</div>
				</div>		
				<div class="row">
					<div class="col-xs-offset-3 col-xs-6">
			    		<div id="fotito2" style="display:none;">
			    			<img src="" class="img-responsive" id="fotoperfil3" >
			    		</div>
			    	</div>	
				</div>
				<div class="col-sm-offset-1 col-sm-10">
					<br>
					<button type="submit" class="btn btn-primary" id="btnGrabaFotos"><i class="fa fa-floppy-o"></i> Grabar</button>
				</div>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div>   
  
 
   
<? include('footer.php'); ?>