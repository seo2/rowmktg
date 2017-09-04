<?
	require_once("../functions.php");
$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
if ($ajax) {

	$allowedDomains = array($dominio);
	
	$referer = $_SERVER['HTTP_REFERER'];
	
	$domain = parse_url($referer); //If yes, parse referrer
	
	if(in_array( $domain['host'], $allowedDomains)) {
		
		
		date_default_timezone_set('America/Santiago');


		$paisID	 	= $_POST['paisID'];
		$ptID	 	= $_POST['ptID'];
		$ptdItem  	= $_POST['ptdItem'];
		$proveedor 	= $_POST['proveedor'];
		
		$data = Array (
			"ptdProv" => $proveedor
		);		
		
		$db->where("paisID", $paisID);
		$db->where("ptID", $ptID);
		$db->where("ptdItem", $ptdItem);
		$db->update('pedido_temporal_detalle', $data);
		
		$respuesta = '1';	

		echo $respuesta;
	}else{
		echo 'Dominio / Host no autorizado';
	}
}else{
	echo 'El archivo no se puede llamar directamente.';
}
?>