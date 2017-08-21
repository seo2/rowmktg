<?php
require_once("../functions.php");


$paisID	= $_POST['paisID'];
$pdID 	= $_POST['pdID'];
$ptdRes = $_POST['ptdRes'];

$i 		= 1;
$det 	= $db->rawQuery('select * from pedido_temporal_detalle where paisID = '.$paisID.' and ptID = '.$pdID.' and ptdRes = '.$ptdRes.' and ptdEst <> 2');

if($det){
	foreach ($det as $d) {
		if($d['ptdProv']==0){
			$i = 0;
		}
	}
}		
	
echo $i;
?>