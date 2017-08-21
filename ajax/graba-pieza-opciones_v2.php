<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$formID	 	= $_POST['formID'];
$insID	 	= $_POST['insID'];
$insOpNom 	= $_POST['insOpNom'];
$insOPEst 	= $_POST['insOPEst'];
if($_POST['insOpCat']){
	$insOpCat	= $_POST['insOpCat'];
}else{
	$insOpCat	= 0;
}
/*
		$data1 = Array (
			"formID" 	=> $formID,
			"insID" 	=> $insID,
			"insOpNom" 	=> $insOpNom,
			"insOpCat" 	=> $insOpCat,
			"insOPEst" 	=> $insOPEst,
			"insOpFoto" => $insOpFoto
		);
		print_r($data1);
*/
if($_POST['insOpID']){ // modifica

	if (!empty($_FILES['foto']['name'])) {
		$sourcePath  = $_FILES['foto']['tmp_name']; 
		$temp 		 = explode(".",$_FILES["foto"]["name"]);
		$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
		$targetPath  = "uploads/ISC/".$newfilename; 
		move_uploaded_file($sourcePath,$targetPath) ;  
			
		$insOpFoto = $newfilename;
	
	
		$data = Array (
			"insOpNom" 	=> $insOpNom,
			"insOpCat" 	=> $insOpCat,
			"insOPEst" 	=> $insOPEst,
			"insOpFoto" => $insOpFoto
		);		
	}else{
		$data = Array (
			"insOpNom" 	=> $insOpNom,
			"insOpCat" 	=> $insOpCat,
			"insOPEst" 	=> $insOPEst,
		);		
	}	
	
	$insOpID = $_POST['insOpID'];
	$db->where("formID", $formID);
	$db->where("insID", $insID);
	$db->where("insOpID", $insOpID);
	$db->update('instores_opciones_v2', $data);
	
	$respuesta = '2';	
}else{ // agrega

	if (!empty($_FILES['foto']['name'])) {
		$sourcePath  = $_FILES['foto']['tmp_name']; 
		$temp 		 = explode(".",$_FILES["foto"]["name"]);
		$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
		$targetPath  = "uploads/ISC/".$newfilename; 
		move_uploaded_file($sourcePath,$targetPath) ;  
			
		$insOpFoto = $newfilename;
		
		$data = Array (
			"formID" 	=> $formID,
			"insID" 	=> $insID,
			"insOpNom" 	=> $insOpNom,
			"insOpCat" 	=> $insOpCat,
			"insOPEst" 	=> $insOPEst,
			"insOpFoto" => $insOpFoto
		);		
	}else{
		$data = Array (
			"formID" 	=> $formID,
			"insID" 	=> $insID,
			"insOpNom" 	=> $insOpNom,
			"insOpCat" 	=> $insOpCat,
			"insOPEst" 	=> $insOPEst,
		);		
	}	

	$id = $db->insert ('instores_opciones_v2', $data);
	
	$respuesta = '1';		
}

echo $respuesta;
?>