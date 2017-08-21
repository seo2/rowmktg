<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$camDesc 	= $_POST['camDesc'];
$camEst 	= $_POST['camEst'];
$pais 		= $_POST['pais'];



if($_POST['camID']){
	$camID = $_POST['camID'];
	
	$db->where('camID', $camID);
	$db->delete('campana_x_pais');
	
	for($i=0; $i<sizeof($pais);$i++){
		$data = Array (
			"camID" 	=> $camID, 
			"paisID" 	=> $pais[$i]
		);	
		$id = $db->insert ('campana_x_pais', $data);	
	}
	
	$data = Array (
		"camDesc" 	=> $camDesc,
		"camEst" 	=> $camEst
	);		
	$db->where("camID", $camID);
	$db->update('campana', $data);
	
	$respuesta = '2';	
}else{
	$data = Array (
		"camDesc" 	=> $camDesc,
		"camEst" 	=> $camEst
	);	
	$camID = $db->insert ('campana', $data);

	
	for($i=0; $i<sizeof($pais);$i++){
		$data = Array (
			"camID" 	=> $camID, 
			"paisID" 	=> $pais[$i]
		);	
		$id = $db->insert ('campana_x_pais', $data);	
	}
		
	$respuesta = '1';	
	
	$i = 0;
	if($_POST['directorio']){
		$directorio = $_POST['directorio'];
		$dirname 	= "catalogo/".$directorio."/"; // Esta es la carpeta que contiene las fotos.
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
			$id = $db->insert ('catalogo', $data);	
			
		}
		$respuesta = $i.' fotos agregadas desde '. $dirname;
	}else{
		$respuesta = "Campaña creada.";
	}
}

echo $respuesta;
?>