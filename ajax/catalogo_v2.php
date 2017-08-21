<?php
require_once("../functions.php");

$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$camID 	= $_POST["camID"];
$formID = $_POST["formID"];


$resultado = $db->rawQuery('SELECT * FROM catalogo_v2 WHERE camID = ? and camEst = 0', Array ($camID));
if($resultado){
	foreach ($resultado as $r) {
		$catID 	 = $r["catID"];
		$camDesc = $r["camDesc"];
		$camFile = $r["camFile"];
		$form = $db->rawQuery("SELECT * FROM catalogo_x_formato_x_ISC WHERE catID = $catID and camID = $camID and formID = $formID group by formID");
		if($form){
			foreach ($form as $f) {
				$description = '';
				$formID = $f['formID'];
				$description .= '<strong>'.get_formato($formID).'</strong><br>';
				$res = $db->rawQuery("SELECT * FROM catalogo_x_formato_x_ISC WHERE catID = $catID and camID = $camID and formID = $formID");
				if($res){
					foreach ($res as $isc) {
						$description .= get_ISC_camp_nom_med($formID,$isc['iscID']).'<br>';
					}
				}	
				$description .= '<br>';
			    $json[] = array(
			    	'value' 		=> $catID, 
			    	'text' 			=> $camDesc,
			    	'description' 	=> $description,
			    	'imageSrc' 		=> $camFile
			    );
			}
		}	
	}
}

$opciones = array('ddData' => $json);

header("Content-Type: application/json", true);
echo json_encode($opciones);

?>