<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$camDesc 	= $_POST['camDesc'];
$date 		= str_replace('/', '-', $_POST['camCad']);
$camCad 	= date("Y-m-d", strtotime($date) ) ;
$camEst 	= $_POST['camEst'];
$pais 		= $_POST['pais'];

$jsondata = array();
$jsondata['success'] = false;

if($_POST['camID']){
	$camID = $_POST['camID'];
	
	$db->where('camID', $camID);
	$db->delete('campana_x_pais_v2');
	
	for($i=0; $i<sizeof($pais);$i++){
		$data = Array (
			"camID" 	=> $camID, 
			"paisID" 	=> $pais[$i]
		);	
		$id = $db->insert ('campana_x_pais_v2', $data);	
	}
	
	$data = Array (
		"camDesc" 	=> $camDesc,
		"camCad" 	=> $camCad,
		"camEst" 	=> $camEst
	);		
	$db->where("camID", $camID);
	$db->update('campana_v2', $data);
	
	$respuesta = 'Campaña Modificada';	
	$jsondata['success'] = true;
	$jsondata['tipo'] 	 = 2;
	$jsondata['elid'] 	 = $camID;
}else{
	$data = Array (
		"camDesc" 	=> $camDesc,
		"camCad" 	=> $camCad,
		"camEst" 	=> $camEst
	);	
	$camID = $db->insert ('campana_v2', $data);

	
	for($i=0; $i<sizeof($pais);$i++){
		$data = Array (
			"camID" 	=> $camID, 
			"paisID" 	=> $pais[$i]
		);	
		$id = $db->insert ('campana_x_pais_v2', $data);	
	}
		
	$jsondata['success'] = true;
	$jsondata['tipo'] 	 = 1;
	$jsondata['elid'] 	 = $camID;
	
	$i = 0;
/*
	if($_POST['directorio']){
		$directorio = $_POST['directorio'];
		$dirname 	= "catalogo_v2/".$directorio."/"; // Esta es la carpeta que contiene las fotos.
		$images 	= glob('../'.$dirname."*.jpg");
		//print_r($images);
		foreach($images as $image) {
			$i++;
			
			$desc = str_replace($dirname, '', $image);
			$desc = str_replace('.jpg', '', $desc);
			
			$data = Array (
				"camID" 	=> $camID, // este ID debe ser cambiado por el catalogo donde se suben las fotos.
				"camDesc" 	=> $desc,
				"camFile" 	=> $image,
			);	
			$id = $db->insert ('catalogo_v2', $data);	
			
		}
		$respuesta = $i.' fotos agregadas desde '. $dirname;
	}else{
*/
		$respuesta = "Campaña creada.";
/* 	} */
}

    $jsondata['message'] = $respuesta;


    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);
    exit();




?>