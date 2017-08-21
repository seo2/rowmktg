<?php
require_once("../functions.php");

$paisID		= $_POST['paisID'];
$formID		= $_POST['formID'];
$ptTie		= $_POST['ptTie'];
$ptdGra		= $_POST['ptdGra'];
$ptdGraOp	= $_POST['ptdGraOp'];
//$ptdFoto	= $_POST['ptdFoto'];

$ptdRes		= get_responsable_pieza($_POST['ptdGra']);

$i = 0;

$ped = $db->rawQuery('select * from pedido_temporal where paisID = '.$paisID.' and ptTie = '.$ptTie.' and ptEst > 0 and MONTH(ptTS) = MONTH( CURRENT_DATE( ) ) ');
if($ped){
	foreach ($ped as $p) {
		$ptID = $p['ptID'];
			$det = $db->rawQuery('select * from pedido_temporal_detalle where paisID = '.$paisID.' and ptID = '.$ptID.' and formID = '.$formID.'and ptdGra = '.$ptdGra.' and ptdGraOp = '.$ptdGraOp);
			if($det){
				foreach ($det as $d) {
					
					if($d['ptdCan']>0){
						$i = $i + $d['ptdCan'];
					}else{
						$i++;	
					}
					
					
				}
			}		
		
		
	}
}


echo $i;
?>