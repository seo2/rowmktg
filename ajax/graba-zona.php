<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$clzNom 	= $_POST['clzNom'];
$clzEst 	= $_POST['clzEst'];
$clzMail 	= $_POST['clzMail'];

$data = Array (
	"clzNom" 	=> $clzNom,
	"clzEst" 	=> $clzEst
);		

if($_POST['clzID']){
	$clzID = $_POST['clzID'];
	$db->where("clzID", $clzID);
	$db->update('checklist_zona', $data);
	
	$respuesta = '2';	
}else{
	$id = $db->insert ('checklist_zona', $data);
	
	$respuesta = '1';		
}

echo $respuesta;

?>