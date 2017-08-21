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
		
		$paisID 	= $_POST['paisID'];
		$tieForm 	= $_POST['tieForm'];
		$tieNom 	= $_POST['tieNom'];
		if($_POST['usuario']){
			$tieFono 	= $_POST['usuario'];
		}else{
			$tieFono 	= '';
		}
		$tieEst 	= $_POST['tieEst'];
		
		$data = Array (
			"paisID" 	=> $paisID,
			"tieForm" 	=> $tieForm,
			"tieNom" 	=> $tieNom,
			"tieFono" 	=> $tieFono,
			"tieEst" 	=> $tieEst
		);		
		
		if($_POST['tieID']){
			$tieID = $_POST['tieID'];
			$db->where("tieID", $tieID);
			$db->update('tiendas', $data);
			
			$respuesta = '2';	
		}else{
			
			$id = $db->insert ('tiendas', $data);
			
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