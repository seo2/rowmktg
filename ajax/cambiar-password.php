<?
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

date_default_timezone_set('Chile/Continental');

require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");
$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

if($_POST['usuID']){
	$usuID = $_POST['usuID'];
	$usuPass = $_POST['usuPass'];
	$data = Array (
		"usuPass" 	=> md5($usuPass)
	);		
	$db->where("usuID", $usuID);
	$db->update('usuario', $data);
	
}

echo 1;	

?>