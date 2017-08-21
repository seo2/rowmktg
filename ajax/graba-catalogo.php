<?php
require_once("../functions.php");

$camID 	= $_POST['camID'];
$camDesc 	= $_POST['camDesc'];
$camEst 	= $_POST['camEst'];
$camFile 	= $_POST['camFile'];

if (!empty($_FILES['foto']['name'])) {
	$sourcePath  = $_FILES['foto']['tmp_name']; 
	$temp 		 = explode(".",$_FILES["foto"]["name"]);
	$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
	$targetPath  = "uploads/".$newfilename; 
	move_uploaded_file($sourcePath,$targetPath) ;  
		
	$itemFoto = "ajax/uploads/".$newfilename;
	
}else{
	$itemFoto = $camFile;
}		
	
$data = Array (
	"camID"		=> $camID,
	"camDesc"	=> $camDesc,
	"camEst" 	=> $camEst,
	"camFile" 	=> $itemFoto
);		
	
	
if($_POST['catID']){
	$catID = $_POST['catID'];

	$db->where("catID", $catID);
	$db->update('catalogo', $data);
	
	$respuesta = '2';	
}else{
	$id = $db->insert ('catalogo', $data);
	
	$respuesta = '1';	
	

		
}






echo $respuesta;
?>