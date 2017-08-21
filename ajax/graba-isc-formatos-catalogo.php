<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$camID 		= $_POST['camID'];
$catID 		= $_POST['catID'];
$formID	= $_POST['formID'];
$isc		= $_POST['isc'];

$jsondata = array();
$jsondata['success'] = false;

for($i=0; $i<sizeof($isc);$i++){

	$data = Array (
		"camID" 	=> $camID,
		"catID" 	=> $catID,
		"formID" 	=> $formID,
		"iscID"		=> $isc[$i]
	);	
	$db->insert ('catalogo_x_formato_x_ISC', $data);

}
	
$jsondata['success'] = true;
$jsondata['tipo'] 	 = 1;
$jsondata['elid'] 	 = $camID;

$i = 0;
$respuesta = "Campaña creada.";

$jsondata['message'] = $respuesta;

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();




?>