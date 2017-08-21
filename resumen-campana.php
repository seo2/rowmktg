<? 
	$usuID = 160;
	include('header.php');
	

	$camID 	 	= $_GET['camID'];
	$sql  		= "select * from campana_v2 where camID = $camID";
	
  	$resultado = $db->rawQuery($sql);
	if($resultado){
		foreach ($resultado as $r) {
			$camDesc = $r['camDesc'];
			$camEst = $r['camEst'];
			$camCad = $r['camCad'];
 		} 
    }		
	$opcion = 'Modificar';	

	
	
?>

    <div class="container" id="argumentos">
	    

	    <div id="cajaposiciones">
			<?
				$sql  = "select * from formatos where formID <> 9 order by formOrder";
				  	$resultado = $db->rawQuery($sql);
					if($resultado){
						foreach ($resultado as $r) {
							$formID = $r['formID'];
				
				
				$sql  = "select * from catalogo_x_formato where camID = $camID and formID = $formID group by formID";
				$formatos = $db->rawQuery($sql);
				if($formatos){
					foreach ($formatos as $f) {
						$formID = $f['formID'];
						
		    ?> 	
		    <div class="col-xs-12" id="pedidohead">
		    	<h2><?= $camDesc; ?><span class="pull-right" style="background: red; display: block; height: 30px; color: #fff; padding: 0 10px; line-height: 30px;font-size: 12px;">Expiración: <strong><?php echo date("d-m-Y", strtotime($camCad)); ?></strong></span></h2>
		    </div>
		    <div class="col-xs-12" id="pedidohead" >
		    	<h2><?= get_formato($f['formID']); ?></h2>
		    </div>
			<div class="col-xs-12 posicion" style="border-bottom:2px solid; ">		
				<div class="row">	
					<?
						$sql  = "select * from catalogo_x_formato_x_ISC where camID = $camID and formID = $formID group by catID";
						$resultado = $db->rawQuery($sql);
						if($resultado){
							foreach ($resultado as $r) {
								$catID = $r['catID'];
								$sql  = "select * from catalogo_v2 where camID = $camID and catID = $catID";
								$resultado = $db->rawQuery($sql);
								if($resultado){
									foreach ($resultado as $r) {
				    ?>   
						<div class="col-xs-6" style="margin-top:10px; border-bottom: 1px solid #ccc; padding-bottom:10px;" >
							<div class="row">
								<div class="col-xs-4">
									<img src="resize2.php?img=<?= str_replace('../', '', $r['camFile']) ; ?>&width=200&height=200&mode=fit" class="img-responsive">
								</div>
								<div class="col-xs-8">
					<?
									$sql  = "select * from catalogo_x_formato_x_ISC where camID = $camID and catID = $catID and formID = $formID";
									$resultado = $db->rawQuery($sql);
									if($resultado){
										foreach ($resultado as $ic) { ?>
										<?php echo get_isc_camp($formID,$ic['iscID']); ?> <span class="medida"><small><?php echo get_isc_med($formID,$ic['iscID']); ?></small></span><br>
							    <? 		} 
								    } ?>															
								</div>
							</div>
						</div>
						    <? 		} 
							    } ?>
				    <? 		} 
					    } ?>
				</div>	

			</div>
			<div class="clear"></div>
			<div class="break" style="page-break-after: always"></div>
			    <? 		} 
				    } ?>
			    <? 		} 
				    } ?>
	    </div>
<!--
    	<div id="footer" class="blancobg">
	    	<div class="container">
		    	<div class="row">
					<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
						
				    	<? 
							$back = 'campana_v2.php';		
						?>
						<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
						  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> <? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></a>
						  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
						  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> Salir</a>
						</div>
			    	</div>
		    	</div>
	    	</div>
    	</div>	
		
-->
	

   
<? include('footer.php'); ?>