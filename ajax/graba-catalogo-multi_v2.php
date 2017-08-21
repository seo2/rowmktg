<?php
require_once("../functions.php");

$camID 		= $_POST['camID'];
$camDesc 	= $_POST['camDesc'];

$jsondata = array();
$jsondata['success'] = false;
$s = '';
$myFile 	= $_FILES['foto'];
$fileCount 	= count($myFile["name"]);
for ($i = 0; $i < $fileCount; $i++) {
	$sourcePath  = $myFile["tmp_name"][$i]; 
	$temp 		 = explode(".",$myFile["name"][$i]);
	$newfilename = quitatodo($camDesc).'_'.sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
	$targetPath  = "catalogo/".$newfilename; 
	move_uploaded_file($sourcePath,$targetPath) ;  		
	$itemFoto = "ajax/catalogo/".$newfilename;

	$data = Array (
		"camID"		=> $camID,
		"camDesc"	=> $myFile["name"][$i],
		"camFile" 	=> $itemFoto
	);	 
	$id = $db->insert ('catalogo_v2', $data);
	
	$jsondata['success'] = true;
	$jsondata['total'] 	 = $i;
	$jsondata['tipo'] 	 = 1;
	if($i>1) $s = 's';
	$jsondata['message'] = $fileCount.' foto'.$s.' agregada'.$s.'.';
	$jsondata['elid'] 	 = $camID;
}

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);
    exit();
?>