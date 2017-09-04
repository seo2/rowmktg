<?php
require_once("../functions.php");

$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$formID  	= $_POST["formID"];
$insID   	= $_POST["insID"];
$insOpID  	= $_POST["insOpID"];

$resultado = $db->rawQuery('SELECT * FROM instores_v2 WHERE formID = '.$formID.' and insID = '.$insID);
if($resultado){
	foreach ($resultado as $r) {
		$insNomGen = $r['insNomGen'];
		$insFormID = $r['insFormID'];
	}
}
$ok = 0;
$resultado = $db->rawQuery('SELECT * FROM instores_opciones_v2 WHERE formID = '.$formID.' and insID = '.$insID.' and insOpID = '.$insOpID.' and insOPEst = 0');

if($resultado){
	foreach ($resultado as $r) {
    	if($r["insOpFoto"]){
			$ruta 		= 'ajax/uploads/ISC/';
			$archivo 	= $urlactual.'/'.$ruta.$r["insOpFoto"];	    	
    	}else{
			$ruta 		= get_carpeta_ISC_v2($formID);
			$archivo 	= $urlactual.'/'.$ruta.quitatodo($insNomGen).quitatodo($r["insOpNom"]).'.jpg';
    	}
	    $json[] = array(
	    	'Value' 	=> $r["insOpID"], 
	    	'Display' 	=> $r["insOpNom"],
	    	'pieCat' 	=> $r["insOpCat"],
	    	'insNomGen'	=> $insNomGen,
	    	'ruta'		=> $ruta,
	    	'archivo'	=> $archivo
	    );
	    $ok = 1;
	}
}


$opciones = array('opciones' => $json);

header("Content-Type: application/json", true);
echo json_encode($opciones);

?>