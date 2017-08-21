<?php
require_once("../functions.php");

$paisID 	= $_POST['paisID'];
$pdID 		= $_POST['pdID'];
$ptdItem 	= $_POST['ptdItem'];
$estfin 	= $_POST['estfin'];
$fotoUsu 	= $_POST['fotoUsu'];

if (!empty($_FILES['foto']['name'])) {
	$sourcePath  = $_FILES['foto']['tmp_name']; 
	$temp 		 = explode(".",$_FILES["foto"]["name"]);
	$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
	$targetPath  = "uploads/".$newfilename; 
	move_uploaded_file($sourcePath,$targetPath) ;  
		
	$itemFoto = $newfilename;
	
}else{
	$itemFoto = '';
}	

$data = Array (
	"paisID" 	=> $paisID,
	"ptID" 		=> $pdID,
	"ptdItem" 	=> $ptdItem,
	"ptoUsu" 	=> $fotoUsu,
	"ptoFoto" 	=> $itemFoto
);

$id = $db->insert ('pedido_fotos', $data);	


echo 1;


?>