<?php
require_once("../functions.php");

$paisID		= $_POST['paisID'];
$pdID 		= $_POST['pdID'];
$ptdProv 	= $_POST['ptdProv'];
$ptdRecibe 	= $_POST['ptdRecibe'];

	/*
		
		ESTADOS:
		
		Solicitado: 			0 // creado por VM
		Para revisión: 			1 // A la espera de MM
		Objetado:				2 // Rechazado por MM
		Aprobado:				3 // Aprobado por MM --> traspasado a Proveedor --> para cotizar
		
		Cotizado:				4 // Recibido por Proveedor, ingresó precio y envió a MM
		Cotizacion Aprobada: 	5 // Cotización aprobada por MM --> Proveedor debe ingresar precio
		Ongoing:   				6 // Proveedor compromete fecha de entrega
		
		Entregado:				7 // Entregado por Proveedor
		Finalizado:				8 // Recepcionado por VM
		
	*/	
	
if (!empty($_FILES['foto']['name'])) {
	$sourcePath  = $_FILES['foto']['tmp_name']; 
	$temp 		 = explode(".",$_FILES["foto"]["name"]);
	$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
	$targetPath  = "uploads/".$newfilename; 
	move_uploaded_file($sourcePath,$targetPath) ;  
		
	$itemFoto = $newfilename;
	
}else{
	$itemFoto = '';
}		
	
	$data = Array (
		"ptdRecibe" => $ptdRecibe,
		"ptdEst" 	=> 7,
		"ptdFotoFinal" => $itemFoto
	);		
	$db->where("paisID", $paisID);
	$db->where("ptID", $pdID);
	$db->where("ptdEst", 6);
	$db->where("ptdProv", $ptdProv);
	$db->update('pedido_temporal_detalle', $data);

echo 1;
?>