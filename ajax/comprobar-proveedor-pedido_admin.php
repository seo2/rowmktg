<?php
require_once("../functions.php");

$pdID 	= $_POST['ptID'];
$paisID = $_POST['paisID'];

$i 		= 1;
$det 	= $db->rawQuery('select * from pedido_temporal_detalle where paisID = '.$paisID.' and ptID = '.$pdID);

if($det){
	foreach ($det as $d) {
		if($d['ptdProv']==0){
			$i = 0;
		}
	}
}		
	
echo $i;
?>