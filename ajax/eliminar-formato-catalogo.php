<?php
require_once("../functions.php");

$camid 		= $_POST['camid'];
$catid 		= $_POST['catid'];
$formid 	= $_POST['formid'];


$db->where("camID", $camid);
$db->where("catID", $catid);
$db->where("formID", $formid);
$db->delete('catalogo_x_formato');
	
$db->where("camID", $camid);
$db->where("catID", $catid);
$db->where("formID", $formid);
$db->delete('catalogo_x_formato_x_ISC');

echo 1;
?>