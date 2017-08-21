<?php
require_once("../functions.php");

$paisID 	= $_POST['paisID'];
$pdID 		= $_POST['pdID'];
$ptdItem 	= $_POST['ptdItem'];
$estfin 	= $_POST['estfin'];
$fotoUsu 	= $_POST['fotoUsu'];
$fileDesc   = $_POST['fileDesc'];

if (!empty($_FILES['foto']['name'])) {
	$sourcePath  = $_FILES['foto']['tmp_name']; 
	$path        = $_FILES["foto"]["name"];
	$ptoExt		 = pathinfo($path, PATHINFO_EXTENSION);
	$temp 		 = explode(".",$_FILES["foto"]["name"]);
	$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
	$targetPath  = "uploads/".$newfilename; 
	move_uploaded_file($sourcePath,$targetPath) ;  
		
	$itemFoto = $newfilename;
	
}else{
	$itemFoto = '';
}	

if($paisID==1){
	date_default_timezone_set('America/Santiago');
}elseif($paisID==2){
	date_default_timezone_set('America/Bogota');
}elseif($paisID==3){
	date_default_timezone_set('America/Buenos_Aires');
}elseif($paisID==4){
	date_default_timezone_set('America/Mexico_City');
}elseif($paisID==5){
	date_default_timezone_set('America/Lima');
}elseif($paisID==6){
	date_default_timezone_set('America/Panama');
}elseif($paisID==7){
	date_default_timezone_set('America/Araguaina');
}
$ahora = date("Y-m-d H:i:s");

$data = Array (
	"paisID" 	=> $paisID,
	"ptID" 		=> $pdID,
	"ptdItem" 	=> $ptdItem,
	"ptoUsu" 	=> $fotoUsu,
	"ptoFile" 	=> $itemFoto,
	"ptoDesc" 	=> $fileDesc,
	"ptoExt"    => $ptoExt,
	"ptoTS"    	=> $ahora
);

$id = $db->insert ('pedido_archivos', $data);	

echo 1;


?>