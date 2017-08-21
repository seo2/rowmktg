<?php
require_once("../functions.php");

$catid 		= $_POST['catid'];
	
$db->where("catID", $catid);
$db->delete('catalogo');


echo 1;
?>