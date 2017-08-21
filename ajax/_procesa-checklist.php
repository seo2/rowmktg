<?php
require_once("../functions.php");
$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
if ($ajax) {

	$allowedDomains = array($dominio);
	
	$referer = $_SERVER['HTTP_REFERER'];
	
	$domain = parse_url($referer); //If yes, parse referrer
	
	if(in_array( $domain['host'], $allowedDomains)) {
	
		$clxtID 	= $_POST['clxtID'];
		$sql  		= "select * from checklist_x_tienda where clxtID = $clxtID";
		
	    $resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				$clxtTie = $r['clxtTie'];
				$clxtCL  = $r['clxtCL'];
				$clxtMM  = $r['clxtMM'];
				$clxtCom = $r['clxtCom'];
				$clxtEst = $r['clxtEst'];
				$clxtTs  = $r['clxtTS'];
			}
		}
	
		$to = get_user_mail($clxtMM);
		
		$to = 'seodos@gmail.com';
		
		$tienda 	= get_tienda($clxtTie);
		$checklist 	= get_checklist_nom($clxtCL);
		$date 		= date('d/m/Y');
						
		$subject = 'Checklist: '.$tienda.' - '.$checklist.' '.$date.'';
		$headers = "From: " . "<no-reply@rowmktg.cl> Reebok Onretail Wholesale Marketing" . "\r\n";
		$headers .= "CC: mc@seo2.cl\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		 
		$email_text = file_get_contents('http://dev.rowmktg.cl/checklists-mail.php?clxtID='.$clxtID);
	
		mail($to, $subject, $email_text, $headers);
	
		$data = Array (
			"clxtEst" 	=> 1
		);		
		$db->where("clxtID", $clxtID);
		$db->update('checklist_x_tienda', $data);
	
		echo 1;
	}else{
		echo 'Dominio / Host no autorizado';
	}
}else{
	echo 'El archivo no se puede llamar directamente.';
}
?>