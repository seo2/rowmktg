<?
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");
$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$eveID 		= $_POST['eveID'];
$tiendaID	= $_POST['tiendaID'];
$itemID		= $_POST['itemID'];

$db->where("eveID", $eveID);
$db->where("tiendaID", $tiendaID);
$db->where("itemID", $itemID);
$item 		= $db->getOne ("items");
$itemFoto 	= $item['itemFoto'];
$itemEst 	= $item['itemEst'];

$jsondata['eveID'] 		= $eveID;
$jsondata['tiendaID'] 	= $tiendaID;
$jsondata['itemID'] 	= $itemID;
$jsondata['comentario'] = $itemCom;
$jsondata['foto'] 		= $itemFoto;
$jsondata['estado'] 	= $itemEst;

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);


?>