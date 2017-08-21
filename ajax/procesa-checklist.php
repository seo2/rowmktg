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
				$clxtIntro = $r['clxtIntro'];
			}
		}
		
	$tienda  	= get_tienda($clxtTie);
	$formato 	= get_formato(get_formato_tienda($clxtTie));
	$checklist 	= get_checklist_nom($clxtCL);
	$fecha 		= substr($clxtTs,8,2) . '/'. substr($clxtTs,5,2) .'/'. substr($clxtTs,0,4);
	$hora  		= substr($clxtTs,11,8);

	$camDesc = quitatodo2($tienda).'_'.quitatodo2($formato).'_'.quitatodo2($checklist).'_'.date('Y-m-d');

	$url 		= 'http://PhantomJScloud.com/api/browser/v2/ak-bvee3-e7mvv-qqby1-yx8f3-37qyn/';
	//$payload 	= file_get_contents ( 'request.json' );
	$options 	= array(
	    'http' => array(
	        'header'  => "Content-type: application/json\r\n",
	        'method'  => 'POST',
	        'content' => '{ "url":"http://'.$_SERVER['SERVER_NAME'].'/checklists-mail.php?clxtID='.$clxtID.'", "renderType":"pdf", "renderSettings": { "quality": 70, "pdfOptions": { "border": "1cm", "footer": { "firstPage": null, "height": "1cm", "onePage": null, "repeating": "%pageNum%/%numPages%" }, "format": "letter", "header": null, "height": "1.2cm", "orientation": "portrait" }, "clipRectangle": null, "renderIFrame": null, "viewport": { "height": 1280, "width": 1280 }, "zoomFactor": 1, "passThroughHeaders": false } }'
	    )
	);
	
	$archivo = 'pdf/checklist_'.$camDesc.'.pdf';
	
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ }
	file_put_contents($archivo,$result);

	
		$to = get_user_mail($clxtMM);
		
		$to = 'seodos@gmail.com';
		
		$tienda 	= get_tienda($clxtTie);
		$checklist 	= get_checklist_nom($clxtCL);
		$date 		= date('d/m/Y');
		$formato 	= get_formato(get_formato_tienda($clxtTie));
		$fecha 		= substr($clxtTs,8,2) . '/'. substr($clxtTs,5,2) .'/'. substr($clxtTs,0,4);
		$hora  		= substr($clxtTs,11,8);
						
		$subject = 'Checklist '.$clxtID.': '.$tienda.' - '.$checklist.' '.$date.'';
		$headers = "From: " . "<no-reply@iscrmktg.com> Adidas Retail Marketing" . "\r\n";
		$headers .= "CC: mc@seo2.cl\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message  = '<html><head></head><body style="font-family: Helvetica, Arial, sans-serif;">';
		$message .= '<div><img src="http://'.$_SERVER['SERVER_NAME'].'/assets/img/cabeceramail.png"></div>';	
		
		$message .= '<div style="color: #000; height: 20px; line-height: 20px; text-transform: uppercase; font-weight: 100; padding-left:9px">';
	    $message .=  $tienda.' | '. $formato;
		$message .= '</div>';

		$message .= '<div style="line-height: 20px; height:20px; padding: 0 9px;">';
		$message .= '<h2 style="margin: 0; font-size: 15px; font-weight: lighter;"><strong>'. $checklist .'</strong> <span>'. $fecha .'</span></h2>';
		$message .= '</div>';	    

		if($clxtIntro){
			$message .= '<div style="padding:15px 10px 0; color:#000;"><p style="margin: 5px 0 15px; line-height:150%;">'.utf8_decode($clxtIntro).'</p></div>';
		}
	
		$message .= '<div style="line-height: 20px; height:20px; padding: 0 9px;">';
		$message .= '<h4 style="margin: 0; font-size: 15px; font-weight: lighter;"><a href="http://'.$_SERVER['SERVER_NAME'].'/ajax/'.$archivo.'"><strong>Descarga desde ac&aacute; el checklist</a></span></h4>';
		$message .= '</div>';
			
			
		$message .= '<div style="padding: 25px 10px 5px; color: #000; font-weight:lighter;border-bottom: 2px solid #000; margin-bottom:10px;">';
		$message .= 'Comentario y conclusiones:';
		$message .= '</div>';
		$message .= '<div style="border-bottom: 1px solid #000; position: relative;">';
		$message .= '<div style="padding-left:10px ">';
		$message .= '<p style="margin: 5px 0 10px; line-height:150%;">'.$clxtCom.'</p>';
		$message .= '<p><strong>'. get_user_nombre($clxtMM) .'</strong></p>';
		$message .= '</div>';					
		$message .= '</div>';				
		$message .= '</div>';
		$message .= '</body></html>';
	
 
		mail($to, $subject, $message, $headers);
	
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