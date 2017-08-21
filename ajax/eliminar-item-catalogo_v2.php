<?php
require_once("../functions.php");

$camid 		= $_POST['camid'];
$catid 		= $_POST['catid'];
	
$db->where("camID", $camid);
$db->where("catID", $catid);
$db->delete('catalogo_v2');


echo 1;
?>