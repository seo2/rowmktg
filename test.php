<?
$camID = $_GET['camID'];
$url = 'http://PhantomJScloud.com/api/browser/v2/ak-bvee3-e7mvv-qqby1-yx8f3-37qyn/';
$payload = file_get_contents ( 'request.json' );
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => '{ "url":"http://dev.iscrmktg.com/resumen-campana.php?camID=1", "renderType":"pdf", "renderSettings": { "quality": 70, "pdfOptions": { "border": null, "footer": { "firstPage": null, "height": "1cm", "onePage": null, "repeating": "%pageNum%/%numPages%" }, "format": "letter", "header": null, "height": "1.2cm", "orientation": "portrait" }, "clipRectangle": null, "renderIFrame": null, "viewport": { "height": 1280, "width": 1280 }, "zoomFactor": 1, "passThroughHeaders": false } }'
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
file_put_contents('pdf/content2.pdf',$result);
//print_r($payload);
?>
<a href="pdf/content2.pdf" target="_blank">link</a>