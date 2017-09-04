<?php
require_once("../functions.php");


$paisID		= $_POST['paisID'];
$formID		= $_POST['formID'];
$ptVM		= $_POST['ptVM'];
$ptTie		= $_POST['ptTie'];
$ptdGra		= $_POST['ptdGra'];
$ptdGraOp	= $_POST['ptdGraOp'];
if($formID==14){
	$ptdProv	= 1;
}
$ptdCat		= $_POST['ptdCat'];
$ptdCan		= $_POST['ptdCan'];
$ptdObs		= $_POST['ptdObs'];
$ptdFoto	= $_POST['ptdFoto'];
$ptdAlerta	= $_POST['ptdAlerta'];
$ptdISC		= $_POST['isc'];


	$formInstore = $formID;
	//$ptdProv   = 0;

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

$ptdRes	= get_responsable_tienda($paisID,$ptTie);
if($ptdRes==0){
	$ptdRes = get_responsable_formato($paisID, $formInstore);
}

//echo $ptdRes;

if($_POST['ptID'] && $_POST['ptdItem']){
	
	$ptID 		= $_POST['ptID'];
	$ptdItem 	= $_POST['ptdItem'];
	
	if (!empty($_FILES['foto']['name'])) {
		$sourcePath  = $_FILES['foto']['tmp_name']; 
		$temp 		 = explode(".",$_FILES["foto"]["name"]);
		$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
		$targetPath  = "uploads/".$newfilename; 
		move_uploaded_file($sourcePath,$targetPath) ;  
			
		$itemFoto = $newfilename;
		
	}else{
		$itemFoto = $ptdFoto;
	}	

	$data = Array (
		"formID" 	=> $formID,
		"ptdGra" 	=> $ptdGra,
		"ptdGraOp" 	=> $ptdGraOp,
		"ptdAlerta" => $ptdAlerta,
		"ptdProv" 	=> $ptdProv,
		"ptdCat" 	=> $ptdCat,
		"ptdISC" 	=> $ptdISC,
		"ptdCan" 	=> $ptdCan,
		"ptdObs" 	=> $ptdObs,
		"ptdFoto" 	=> $itemFoto,
		"ptdRes" 	=> $ptdRes,
		"ptdVM" 	=> $ptVM,
		"ptdTS" 	=> $ahora
	);
			
//	print_r( $data);
	
	
	$db->where("paisID", $paisID);
	$db->where("ptID", $ptID);
	$db->where("ptdItem", $ptdItem);
	$db->update('pedido_temporal_detalle', $data);		

	
	echo 2;		
	
}else{

			

	$ptdCat = 0;
	
	// comprobar si existe un pedido temporal activo para esta tienda.
	
	$ptID 	= get_pedido_temporal_x_usuario($paisID,$ptTie,$ptVM);
	if(!$ptID){
		$data = Array (
			"paisID" => $paisID,
			"ptVM" 	 => $ptVM,
			"ptTie"  => $ptTie,
			"ptFec"  => date('Y-m-d')
		);	
		$ptID = $db->insert ('pedido_temporal', $data);			
	}
	
	// grabar nuevo item.
	$itemFoto = '';
	
	if (!empty($_FILES['foto']['name'])) {
		$sourcePath  = $_FILES['foto']['tmp_name']; 
		$temp 		 = explode(".",$_FILES["foto"]["name"]);
		$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
		$targetPath  = "uploads/".$newfilename; 
		move_uploaded_file($sourcePath,$targetPath) ;  
			
		$itemFoto = $newfilename;
		
	}
		$data = Array (
			"paisID" 	=> $paisID,
			"ptID" 		=> $ptID,
			"formID" 	=> $formID,
			"ptdGra" 	=> $ptdGra,
			"ptdGraOp" 	=> $ptdGraOp,
			"ptdAlerta" => $ptdAlerta,
			"ptdProv" 	=> $ptdProv,
			"ptdCat" 	=> $ptdCat,
			"ptdISC" 	=> $ptdISC,
			"ptdCan" 	=> $ptdCan,
			"ptdObs" 	=> $ptdObs,
			"ptdFoto" 	=> $itemFoto,
			"ptdRes" 	=> $ptdRes,
			"ptdVM" 	=> $ptVM,
			"ptdTS" 	=> $ahora
		);	
			
//	print_r( $data);
			
		$id = $db->insert ('pedido_temporal_detalle', $data);	
		
		echo 1;
}
?>