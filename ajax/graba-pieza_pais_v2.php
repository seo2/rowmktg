<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$formID	   = $_POST['formID'];
$insID	   = $_POST['pieID'];
$paisID    = $_POST['paisID'];


if($paisID==1){
	$insNomChi = $_POST['insNomChi']; 
	$data = Array (
		"insNomChi" => $insNomChi
	);
}elseif($paisID==2){
	$insNomCol = $_POST['insNomCol'];  
	$data = Array ( 
		"insNomCol" => $insNomCol
	);
}elseif($paisID==3){
	$insNomArg = $_POST['insNomArg'];  
	$data = Array ( 
		"insNomArg" => $insNomArg
	);
}elseif($paisID==4){
	$insNomMex = $_POST['insNomMex'];  
	$data = Array ( 
		"insNomMex" => $insNomMex
	);
}elseif($paisID==5){
	$insNomPer = $_POST['insNomPer'];  
	$data = Array ( 
		"insNomPer" => $insNomPer
	);
}elseif($paisID==6){
	$insNomPan = $_POST['insNomPan'];  
	$data = Array ( 
		"insNomPan" => $insNomPan
	);
}elseif($paisID==7){
	$insNomBra = $_POST['insNomBra'];  
	$data = Array (
		"insNomBra" => $insNomBra
	);
}

$db->where("insID", $insID);
$db->where("formID", $formID);
$db->update('instores_v2', $data);

$respuesta = '2';	


echo $respuesta;
?>