<?php
require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");
require_once("../functions.php");

	$clxtID 	 	= $_POST['clxtID'];
	$sql  		= "select * from campana_v2 where camID = $camID";
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
	
	$tienda  	= get_tienda($clxtTie);
	$formato 	= get_formato(get_formato_tienda($clxtTie));
	$checklist 	= get_checklist_nom($clxtCL);
	$fecha 		= substr($clxtTs,8,2) . '/'. substr($clxtTs,5,2) .'/'. substr($clxtTs,0,4);
	$hora  		= substr($clxtTs,11,8);

	$camDesc = quitatodo2($tienda).'_'.quitatodo2($formato).'_'.quitatodo2($checklist).'_'.$fecha;

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

echo 'ajax/'.$archivo;

?>