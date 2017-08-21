<?php
require_once("../functions.php");

$camID 		= $_POST['camID'];
$camDesc 	= $_POST['camDesc'];
$camEst 	= $_POST['camEst'];
$camFile 	= $_POST['camFile'];

if (!empty($_FILES['foto']['name'])) {
	$sourcePath  = $_FILES['foto']['tmp_name']; 
	$temp 		 = explode(".",$_FILES["foto"]["name"]);
	$newfilename = quitatodo($camDesc).'_'.sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
	$targetPath  = "catalogo/".$newfilename; 
	move_uploaded_file($sourcePath,$targetPath) ;  
		
	$itemFoto = "ajax/catalogo/".$newfilename;
	
}else{
	$itemFoto = $camFile;
}		
	
$data = Array (
	"camDesc"	=> $camDesc,
	"camEst" 	=> $camEst,
	"camFile" 	=> $itemFoto
);		
	
if($_POST['catID']){
	$catID = $_POST['catID'];
	$db->where("camID", $camID);
	$db->where("catID", $catID);
	$db->update('catalogo_v2', $data);
	
	$respuesta = '2';	
}else{
	$id = $db->insert ('catalogo_v2', $data);
	
	$respuesta = '1';	
	

		
}


echo $respuesta;
?>