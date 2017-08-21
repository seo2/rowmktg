<?
	require_once("../functions.php");
	
	date_default_timezone_set('America/Santiago');
	
	$rexPais = $_POST['rexPais'];
	$rexCurr = $_POST['rexCurr'];
	$rexVal  = $_POST['rexVal'];
	$rexAno  = $_POST['rexAno'];
	$rexEst  = $_POST['rexEst'];
	
	$data = Array (
		"rexPais" 	=> $rexPais,
		"rexCurr" 	=> $rexCurr,
		"rexVal" 	=> $rexVal,
		"rexAno" 	=> $rexAno,
		"rexEst" 	=> $rexEst
	);		
	
	if($_POST['rexID']){
		$rexID = $_POST['rexID'];
		$db->where("rexID", $rexID);
		$db->update('rate_exchange', $data);
		$respuesta = '2';	
	}else{
		$id = $db->insert ('rate_exchange', $data);	
		$respuesta = '1';		
	}
	
	echo $respuesta;

?>