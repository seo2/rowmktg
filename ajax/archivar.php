<?
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");
$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$eveID 		= $_POST['eveID'];
$eveEst 	= $_POST['eveEst'];

$data = Array (
	"eveEst"  => $eveEst
	
	);
	$db->where("eveID", $eveID);
	$db->update('eventos', $data);


echo '1';

?>