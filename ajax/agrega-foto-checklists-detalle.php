<?php
		require_once("../functions.php");
$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
if ($ajax) {

	$allowedDomains = array($dominio);
	
	$referer = $_SERVER['HTTP_REFERER'];
	
	$domain = parse_url($referer); //If yes, parse referrer
	
	if(in_array( $domain['host'], $allowedDomains)) {
		
		$clxtID 	 = $_POST['clxtID'];
		$clxtdClID 	 = $_POST['clxtdClID'];
		$clxtdClDID  = $_POST['clxtdClDID'];
		$clxtdCom 	 = $_POST['clxtdCom'];
		
		
		if (!empty($_FILES['foto']['name'])) {
			$sourcePath  = $_FILES['foto']['tmp_name']; 
			$temp 		 = explode(".",$_FILES["foto"]["name"]);
			$newfilename = "chkclst_".sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
			$targetPath  = "uploads/".$newfilename; 
			move_uploaded_file($sourcePath,$targetPath) ;  
				
			$itemFoto = $newfilename;
			
		}else{
			$itemFoto = '';
		}	
		
		$data = Array (
			"clxtID" 		=> $clxtID,
			"clxtdClID" 	=> $clxtdClID,
			"clxtdClDID" 	=> $clxtdClDID,
			"clxtdfFile" 	=> $itemFoto
		);
		
		
		$id = $db->insert ('checklist_x_tienda_detalle_fotos', $data);	
		
		
		echo 1;
	}else{
		echo 'Dominio / Host no autorizado';
	}
}else{
	echo 'El archivo no se puede llamar directamente.';
}


?>