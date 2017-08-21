<?php
require_once("../functions.php");

$pdID 		= $_POST['pdID'];
$ptdItem 	= $_POST['ptdItem'];
$ptdValor 	= $_POST['ptdValor'];

	/*
		
		
	*/	



/* 
	$data = Array (
		"ptdValor" 	=> $ptdValor,
		"ptdEst" 	=> 4
	);
*/

// decidí no cambiar el estado hasta enviar a MM
	$data = Array (
		"ptdValor" 	=> $ptdValor
	);


	$db->where("ptID", $pdID);
	$db->where("ptdItem", $ptdItem);
	$db->update('pedido_temporal_detalle', $data);


echo 1;
?>