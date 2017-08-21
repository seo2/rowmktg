<?php
require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");
require_once("../functions.php");

	$camID 	 	= $_POST['camID'];
	$sql  		= "select * from campana_v2 where camID = $camID";
	
  	$resultado = $db->rawQuery($sql);
	if($resultado){
		foreach ($resultado as $r) {
			$camDesc = $r['camDesc'];
			$camEst = $r['camEst'];
			$camCad = $r['camCad'];
 		} 
    }		
	$camDesc = quitatodo2($camDesc);

$url 		= 'http://PhantomJScloud.com/api/browser/v2/ak-bvee3-e7mvv-qqby1-yx8f3-37qyn/';
//$payload 	= file_get_contents ( 'request.json' );
$options 	= array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => '{ "url":"http://'.$_SERVER['SERVER_NAME'].'/resumen-campana.php?camID='.$camID.'", "renderType":"pdf", "renderSettings": { "quality": 70, "pdfOptions": { "border": "1cm", "footer": { "firstPage": null, "height": "1cm", "onePage": null, "repeating": "%pageNum%/%numPages%" }, "format": "letter", "header": null, "height": "1.2cm", "orientation": "portrait" }, "clipRectangle": null, "renderIFrame": null, "viewport": { "height": 1280, "width": 1280 }, "zoomFactor": 1, "passThroughHeaders": false } }'
    )
);
$archivo = 'pdf/campana_'.$camDesc.'_'.date('Y-m-d').'.pdf';

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
file_put_contents($archivo,$result);

echo 'ajax/'.$archivo;

?>