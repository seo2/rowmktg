<?php	
	require_once("functions.php");

	$camID  = $_GET['camID'];
	$catID  = $_GET['catID']; 
	$formID = $_GET['formID'];  
?>
<div id="isc_camp">
<?php
	$i    = 0;
     							
	$sql  = "select * from catalogo_x_formato where camID = $camID and catID = $catID and formID = $formID";
  	$resultado = $db->rawQuery($sql);
	if($resultado){
		foreach ($resultado as $r) {
?>   								
	<div class="row" >
		<div class="col-sm-12 posicion2" style="margin-bottom:10px;">
			<div class="row">
				<div class="col-xs-9 formatito">
					<?php echo get_formato($r['formID']); ?>
				</div>
				<div class="col-xs-3 formatito text-center">
					<? if($paisID==7){ ?>Quantidade<? }else{ ?>Cantidad<? } ?>
				</div>
			</div>
		</div>
<?php
			$formID = $r['formID'];
			$sql  	= "select * from catalogo_x_formato_x_ISC where camID = $camID and catID = $catID and formID = $formID";
		  	$resultado = $db->rawQuery($sql);
			if($resultado){
				foreach ($resultado as $ic) {
					$i++;
?>  
			<div class="col-sm-12 posicion1">
				<div class="row">
					<div class="col-xs-9" >
						<?php echo get_isc_camp($formID,$ic['iscID']); ?> <span class="medida"><small><?php echo get_isc_med($formID,$ic['iscID']); ?></small></span>
					</div>
					<div class="col-xs-3" >
						<div class="form-group">
							<input type="number" class="form-control" name="iscCan[<?php echo $i; ?>]" min="1" value="">
							<input type="hidden" name="iscID[<?php echo $i; ?>]" 	value="<?= $ic['iscID']; ?>">
						</div>
					</div>
				</div>
			</div>									
	
	    <? 		} 
		    } ?>	
		</div>												
	
    <? 		} 
	    } 
?>		
</div>