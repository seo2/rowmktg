<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$formDesc 	= $_POST['formDesc'];
$formEst 	= $_POST['formEst'];

if($_POST['formID']){
	$formID = $_POST['formID'];
	$data = Array (
		"formDesc" 	=> $formDesc,
		"formEst" 	=> $formEst
	);		
	$db->where("formID", $formID);
	$db->update('formatos', $data);
	
	$respuesta = '2';	
}else{
	$data = Array (
		"formDesc" 	=> $formDesc,
		"formEst" 	=> $formEst
	);	
	$id = $db->insert ('formatos', $data);
	
	$respuesta = '1';		
}

echo $respuesta;
?>