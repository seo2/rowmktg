<?php
require_once("../functions.php");

$camid 		= $_POST['camid'];
$catid 		= $_POST['catid'];
$formid 	= $_POST['formid'];
$iscid 		= $_POST['iscid'];
	
$db->where("camID", $camid);
$db->where("catID", $catid);
$db->where("formID", $formid);
$db->where("iscID", $iscid);
$db->delete('catalogo_x_formato_x_ISC');

echo 1;
?>