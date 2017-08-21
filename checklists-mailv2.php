<?
	
	require_once("functions.php");
	
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
		}
	}
	
	$tienda  	= get_tienda($clxtTie);
	$formato 	= get_formato(get_formato_tienda($clxtTie));
	$checklist 	= get_checklist_nom($clxtCL);
	$fecha 		= substr($clxtTs,8,2) . '/'. substr($clxtTs,5,2) .'/'. substr($clxtTs,0,4);
	$hora  		= substr($clxtTs,11,8);
?>  


<!DOCTYPE html>
<html lang="en">
  <head>
    
	</head>
<body>	

<div style="font-family: Helvetica, Arial, sans-serif; color: #000; max-width:655px; margin: 0 auto; ">
	    
	<div style="text-align:center">
	    <img src="http://armktg.cl/assets/img/logo.png" width="100">
	</div>
	    
	<div style="color: #000; height: 20px; line-height: 20px; text-transform: uppercase; font-weight: 100; padding-left:9px">
	    <?php echo $tienda; ?> | <?php echo $formato; ?>	
	</div>
	
    <div style="line-height: 20px; height:20px; padding: 0 9px;">
		<h2 style="margin: 0; font-size: 15px; font-weight: lighter;"><strong><?php echo $checklist; ?></strong> <span><?php echo $fecha; ?></span></h2> 
    </div>			    
			
	<?
	$sql  		= "select * from checklist_detalle where clID = $clxtCL group by cldZona";
	
    $resultado = $db->rawQuery($sql);
	if($resultado){
		foreach ($resultado as $r) {
			$cldID 	  = $r['cldID'];
			$cldZona  = $r['cldZona'];
	?>	
			
			
			<div style="padding: 25px 10px 5px; color: #2196f3; font-weight:lighter;border-bottom: 2px solid #2196f3;">
				 <?php echo get_zona($cldZona); ?>:
			</div>				
		<?
		$sql  		= "select * from checklist_detalle where clID = $clxtCL and cldZona = $cldZona";
		
	    $resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$cldID 	 = $r['cldID'];
				$cldItem = $r['cldItem'];
				$cldCom  = $r['cldCom'];
			$sql  		= "select * from checklist_x_tienda_detalle where clxtID = $clxtID and clxtdClID = $clxtCL and clxtdClDID = $cldID";
			
		    $resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $r) {
					$clxtdStatus 	= $r['clxtdStatus'];
					$clxtdCom 		= $r['clxtdCom'];
			?>					
			<div style="border-bottom: 1px solid #ccc; position: relative;">
				<div style="font-size: 16px; padding: 10px 9px;color: #000;">
					<strong><?php echo $cldItem; ?></strong> 
					
					<? if($clxtdStatus==1){ ?>
					<span class="statusOK" style="color: #5cb85c;font-size: 12px;">OK</span>
					<? }elseif($clxtdStatus==2){ ?>
					<span class="statusNotOK" style="color: #d9534f;font-size: 12px;">Not OK</span>
					<? }elseif($clxtdStatus==3){ ?>
					<span class="statusNoAplica" style="color: #333;font-size: 12px;">No aplica</span>
					<? } ?>
				
				
				</div>
				<div style="padding-left:10px ">
		    		<p style="margin: 5px 0 10px; font-size: 12px;"><?php echo $clxtdCom; ?></p>
				</div><!-- fin comentarios -->

				<!-- Fotos Adjuntas -->
				<div class="row" id="fotitos" style="padding: 0 0 0 10px;">
					<?
					$sql  		= "select * from checklist_x_tienda_detalle_fotos where clxtID = $clxtID and clxtdClID = $clxtCL and clxtdClDID = $cldID";
					
				    $resultado = $db->rawQuery($sql);
					if($resultado){
						foreach ($resultado as $r) {
							$clxtdfFile 	= $r['clxtdfFile'];
					?>					
					<div style="margin: 0 10px 10px 0;  width: 300px; float: left; border: 1px solid #ccc; padding: 5px">
						
						<img src='http://dev.armktg.cl/resize2.php?img=ajax/uploads/<?php echo $clxtdfFile; ?>&width=400&height=400&mode=fit' style="width: 100%; height: auto;">		
					
					</div>				
					<?
						
						}
					}
					?>		
					<div style="clear:both;"></div>
				</div>						
			</div>						
			<?
				
				}
			}
			?>					
		<?
			
			}
		}
		?>					
	<?
		
		}
	}
	?>							
			
			<div style="padding: 25px 10px 5px; color: #000; font-weight:lighter;border-bottom: 2px solid #000; margin-bottom:10px;">
				Comentario y conclusiones:
			</div>	
			<div style="border-bottom: 1px solid #000; position: relative;">
				<div style="padding-left:10px ">
		    		<p style="margin: 5px 0 10px; line-height:150%;"><?php echo $clxtCom; ?></p>
		    		<p><strong><?php echo get_user_nombre($clxtMM); ?></strong></p>
				</div><!-- fin comentarios -->					
			</div>		
	
    </div>
  </body>
</html>