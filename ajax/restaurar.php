<?php
session_start();
require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");


$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

if($_POST["usuID"]){
	$usuID  = $_POST["usuID"];
	$pass	= $_POST["password"];

	$data = Array (
	    'usuPass' 		=>  MD5($pass),
	    'usuToken' 		=>  '',
	);

	$db->where ('usuID', $usuID);
	if ($db->update ('usuario', $data))
	    echo 1; //$db->count . ' records were updated';
	else
	    echo 0; //'update failed: ' . $db->getLastError();




}else{
	 echo 0; //'update failed: ' . $db->getLastError();
}

?>