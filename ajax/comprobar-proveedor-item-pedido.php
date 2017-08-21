<?php
require_once("../functions.php");

$paisID 	= $_POST['paisID'];
$pdID 		= $_POST['pdID'];
$ptdItem 	= $_POST['ptdItem'];

$i 		= 0;
$det 	= $db->rawQuery('select * from pedido_temporal_detalle where paisID = '.$paisID.' and ptID = '.$pdID.' and ptdItem = '.$ptdItem);
if($det){
	foreach ($det as $d) {
		if($d['ptdProv']>0){
			$i = 1;
		}
	}
}		
	
echo $i;
?>