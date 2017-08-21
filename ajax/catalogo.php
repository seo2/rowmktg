<?php
require_once("../functions.php");

$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$camID  = $_POST["camID"];

$resultado = $db->rawQuery('SELECT * FROM campana  WHERE camID = ? and camEst = 0', Array ($camID));
if($resultado){
	foreach ($resultado as $r) {
		$camDesc 	= $r['camDesc'];
	}
}

$resultado = $db->rawQuery('SELECT * FROM catalogo  WHERE camID = ? and camEst = 0', Array ($camID));
if($resultado){
	foreach ($resultado as $r) {
	    $json[] = array(
	    	'value' 		=> $r["catID"], 
	    	'text' 			=> $r["camDesc"],
	    	'description' 	=> $camDesc,
	    	'imageSrc' 		=> $r["camFile"]
	    );
	}
}

$opciones = array('ddData' => $json);

header("Content-Type: application/json", true);
echo json_encode($opciones);

?>