<?php
require_once("../functions.php");


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


	$paisID = $_POST['paisID'];
	$ptID   = $_POST['ptID'];


	$data = Array (
		"ptEst" 	=> 1
	);		
	$db->where("paisID", $paisID);
	$db->where("ptID", $ptID);
	$db->where("ptEst", 0);
	$db->update('pedido_temporal', $data);


	$data = Array (
		"ptdEst" 	=> 1
	);		
	$db->where("paisID", $paisID);
	$db->where("ptID", $ptID);
	$db->where("ptdEst", 0);
	$db->update('pedido_temporal_detalle', $data);

	

	

echo 1;
?>