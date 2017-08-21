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
		
		$clFor 	= $_POST['clFor'];
		$clNom 	= $_POST['clNom'];
		$clEst 	= $_POST['clEst'];
		
		$data = Array (
			"clFor" 	=> $clFor,
			"clNom" 	=> $clNom,
			"clEst" 	=> $clEst
		);		
		
		if($_POST['clID']){
			$clID = $_POST['clID'];
			$db->where("clID", $clID);
			$db->update('checklist', $data);
			
			$respuesta = '2';	
		}else{
			
			$id = $db->insert ('checklist', $data);
			
			$respuesta = '1';		
		}
		
		echo $respuesta;
	}else{
		echo 'Dominio / Host no autorizado';
	}
}else{
	echo 'El archivo no se puede llamar directamente.';
}
?>