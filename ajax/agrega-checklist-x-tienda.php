<?
require_once("../functions.php");
$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
if ($ajax) {

	$allowedDomains = array($dominio);
	
	$referer = $_SERVER['HTTP_REFERER'];
	
	$domain = parse_url($referer); //If yes, parse referrer
	
	if(in_array( $domain['host'], $allowedDomains)) {
		
		date_default_timezone_set('America/Santiago');
		$jsondata['success'] = false;		
				
		$tieID 		= $_POST['tieID'];
		$usuID 		= $_POST['usuID'];
		$formID 	= get_formato_tienda($tieID);	

		$sql  		= "select * from checklist where clFor = $formID";
		
	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$clID		= $r['clID'];
				
				$data = Array (
					"clxtTie" 	=> $tieID,
					"clxtCL"	=> $clID,
					"clxtMM" 	=> $usuID
				);	
				$clxtID = $db->insert ('checklist_x_tienda', $data);
				
				$sql  		= "select * from checklist_detalle where clID = $clID";
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						
						
						$data = Array (
							"clxtID" 	=> $clxtID,
							"clxtdClID" => $clID,
							"clxtdClDID" => $r['cldID']
						);	
						
						$id = $db->insert ('checklist_x_tienda_detalle', $data);
						
						
						
			 		} 
			    }	
				$jsondata['success'] 	= true;
				$jsondata['clxtID'] 	= $clxtID;
	 		} 
	    }	
		
		header('Content-type: application/json; charset=utf-8');
	    echo json_encode($jsondata);
	    exit();
	}else{
		echo 'Dominio / Host no autorizado';
	}
}else{
	echo 'El archivo no se puede llamar directamente.';
}
?>