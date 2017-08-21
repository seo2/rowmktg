<?
require_once("../functions.php");

date_default_timezone_set('America/Santiago');

$formID	   = $_POST['formID'];
$insNomGen = $_POST['insNomGen'];
$insNomGes = $_POST['insNomGes']; 
$insNomArg = $_POST['insNomArg']; 
$insNomBra = $_POST['insNomBra']; 
$insNomChi = $_POST['insNomChi']; 
$insNomCol = $_POST['insNomCol']; 
$insNomMex = $_POST['insNomMex']; 
$insNomPer = $_POST['insNomPer']; 
$insNomPan = $_POST['insNomPan']; 
$insFormID = $_POST['insFormID']; 
$insEst    = $_POST['insEst'];



if($_POST['pieID']){
	$data = Array (
		"insNomGen" => $insNomGen,
		"insNomGes" => $insNomGes, 
		"insNomArg" => $insNomArg, 
		"insNomBra" => $insNomBra, 
		"insNomChi" => $insNomChi, 
		"insNomCol" => $insNomCol, 
		"insNomMex" => $insNomMex, 
		"insNomPer" => $insNomPer, 
		"insNomPan" => $insNomPan, 
		"insFormID" => $insFormID, 
		"insEst" 	=> $insEst 
	);	

	$insID = $_POST['pieID'];

	$db->where("insID", $insID);
	$db->where("formID", $formID);
	$db->update('instores', $data);
	
	$respuesta = '2';	
}else{
	$data = Array (
		"formID"	=> $formID,
		"insNomGen" => $insNomGen,
		"insNomGes" => $insNomGes, 
		"insNomArg" => $insNomArg, 
		"insNomBra" => $insNomBra, 
		"insNomChi" => $insNomChi, 
		"insNomCol" => $insNomCol, 
		"insNomMex" => $insNomMex, 
		"insNomPer" => $insNomPer, 
		"insNomPan" => $insNomPan, 
		"insFormID" => $formID, 
		"insEst" 	=> $insEst 
	);

	$id = $db->insert ('instores', $data);
	
	$respuesta = '1';		
}

echo $respuesta;
?>