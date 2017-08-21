<?
	require_once("../functions.php");
	
	date_default_timezone_set('America/Santiago');
	
	$paisNom = $_POST['paisNom'];
	$paisEst  = $_POST['paisEst'];
	
	$data = Array (
		"paisNom" 	=> $paisNom,
		"paisEst" 	=> $paisEst
	);		
	
	if($_POST['paisID']){
		$paisID = $_POST['paisID'];
		$db->where("paisID", $paisID);
		$db->update('paises', $data);
		$respuesta = '2';	
	}else{
		$id = $db->insert ('paises', $data);	
		$respuesta = '1';		
	}
	
	echo $respuesta;

?>