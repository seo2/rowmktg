<?php
require_once("../functions.php");

$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$formID  = $_POST["formID"];
$insID   = $_POST["insID"];
$insOpID   = $_POST["insOpID"];

$resultado = $db->rawQuery('SELECT * FROM instores WHERE formID = '.$formID.' and insID = '.$insID);
if($resultado){
	foreach ($resultado as $r) {
		$insNomGen = $r['insNomGen'];
		$insFormID = $r['insFormID'];
	}
}
$ok = 0;
$resultado = $db->rawQuery('SELECT * FROM instores_opciones WHERE formID = '.$formID.' and insID = '.$insID.' and insOpID = '.$insOpID);

if($resultado){
	foreach ($resultado as $r) {
    	if($r["insOpFoto"]){
			$ruta 		= 'ajax/uploads/ISC/';
			$archivo 	= 'http://iscrmktg.com/'.$ruta.$r["insOpFoto"];	    	
    	}else{
			$ruta 		= get_carpeta_ISC($formID);
			$archivo 	= 'http://iscrmktg.com/'.$ruta.quitatodo($insNomGen).quitatodo($r["insOpNom"]).'.jpg';
    	}
	    $json[] = array(
	    	'Value' 	=> $r["insOpID"], 
	    	'Display' 	=> $r["insOpNom"],
	    	'pieCat' 	=> $r["insOpCat"],
	    	'insNomGen'	=> $insNomGen,
	    	'ruta'		=> $ruta,
	    	'archivo'	=> $archivo
	    	//'pieCan' 	=> $pieCan,
	    	//'pieCom' 	=> $pieCom
	    );
	    $ok = 1;
	}
}


$opciones = array('opciones' => $json);

header("Content-Type: application/json", true);
echo json_encode($opciones);

?>