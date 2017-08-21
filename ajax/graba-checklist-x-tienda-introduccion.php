<?
$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
if ($ajax) {

	$allowedDomains = array('dev.iscrmktg.com', 'iscrmktg.com', 'www.iscrmktg.com');
	
	$referer = $_SERVER['HTTP_REFERER'];
	
	$domain = parse_url($referer); //If yes, parse referrer
	
	if(in_array( $domain['host'], $allowedDomains)) {
		
		require_once("../functions.php");
		
		date_default_timezone_set('America/Santiago');
		
		$clxtID 	 = $_POST['clxtID'];
		$clxtdClID 	 = $_POST['clxtdClID'];
		$clxtIntro 	 = $_POST['clxtIntro'];
		$data = Array (
			"clxtIntro" 	=> $clxtIntro
		);		
		
		$db->where("clxtID", $clxtID);
		$db->where("clxtCL", $clxtdClID);
		$db->update('checklist_x_tienda', $data);
		
		$respuesta = '1';	

		echo $respuesta;
	}else{
		echo 'Dominio / Host no autorizado';
	}
}else{
	echo 'El archivo no se puede llamar directamente.';
}
?>