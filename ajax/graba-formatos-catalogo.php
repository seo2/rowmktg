<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$camID 		= $_POST['camID'];
$catID 		= $_POST['catID'];
$formato	= $_POST['formato'];

$jsondata = array();
$jsondata['success'] = false;

for($i=0; $i<sizeof($formato);$i++){

	$data = Array (
		"camID" 	=> $camID,
		"catID" 	=> $catID,
		"formID" 	=> $formato[$i]
	);	
	$db->insert ('catalogo_x_formato', $data);

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