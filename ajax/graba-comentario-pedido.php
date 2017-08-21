<?php
require_once("../functions.php");

$paisID 	= $_POST['paisID'];
$ptID		= $_POST['ptID'];
$ptdItem	= $_POST['ptdItem'];
$ptoUsu		= $_POST['ptoUsu'];
$ptoObs		= $_POST['ptoObs'];

$data = Array (
	"paisID" 	=> $paisID,
	"ptID" 		=> $ptID,
	"ptdItem" 	=> $ptdItem,
	"ptoUsu" 	=> $ptoUsu,
	"ptoObs" 	=> $ptoObs
);


if($_POST['paisID'] && $_POST['ptID'] && $_POST['ptdItem'] && $_POST['ptoID']){
	
	$ptoID = $_POST['ptoID'];
	
	$db->where("paisID", $paisID);
	$db->where("ptID", $ptID);
	$db->where("ptdItem", $ptID);
	$db->where("ptoID", $ptoID);
	$db->update('pedido_observaciones', $data);		
		
	
}else{

	$id = $db->insert ('pedido_observaciones', $data);	
}
echo 1;
?>