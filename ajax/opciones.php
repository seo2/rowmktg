<?php
require_once("../functions.php");

$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$formID  = $_POST["formID"];
$insID   = $_POST["insID"];

$resultado = $db->rawQuery('SELECT * FROM instores WHERE formID = '.$formID.' and insID = '.$insID);
if($resultado){
	foreach ($resultado as $r) {
/*
		$pieProv 	= $r['pieProv'];
		$pieCat 	= $r['pieCat'];
		$pieCan 	= $r['pieCan'];
		$pieCom 	= $r['pieCom'];
*/
	}
}
$ok = 0;
$resultado = $db->rawQuery('SELECT insOpID, insOpNom FROM instores_opciones WHERE formID = '.$formID.' and insID = '.$insID);
if($resultado){
	foreach ($resultado as $r) {
	    $json[] = array(
	    	'Value' 	=> $r["insOpID"], 
	    	'Display' 	=> $r["insOpNom"],
	    	'pieCat' 	=> $r["insOpCat"]
	    );
	    $ok = 1;
	}
}

if($ok==0){
    $json[] = array(
    	'Value' 	=> 0, 
    	'Display' 	=> '', 
    	'pieCat' 	=> 0
    );	
}

$opciones = array('opciones' => $json);

header("Content-Type: application/json", true);
echo json_encode($opciones);

?>