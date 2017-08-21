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
$itemCom	= $_POST['argumento'];

$db->where("eveID", $eveID);
$db->where("tiendaID", $tiendaID);
$db->where("itemID", $itemID);
$item 		= $db->getOne ("items");
$itemFoto 	= $item['itemFoto'];
$itemEst 	= $item['itemEst'];


if (!empty($_FILES['foto']['name'])) {
		$sourcePath  = $_FILES['foto']['tmp_name']; 
		$temp 		 = explode(".",$_FILES["foto"]["name"]);
		$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
		$targetPath  = "uploads/".$newfilename; 
		move_uploaded_file($sourcePath,$targetPath) ;  
			
		$itemFoto = $newfilename;
		$itemEst  = 1;
	
}

	$data = Array (
	"itemFoto"  => $itemFoto,
	"itemCom"	=> $itemCom,
	"itemEst"	=> $itemEst
	
	);
	$db->where("eveID", $eveID);
	$db->where("tiendaID", $tiendaID);
	$db->where("itemID", $itemID);
	$db->update('items', $data);

	$jsondata['eveID'] 		= $eveID;
	$jsondata['tiendaID'] 	= $tiendaID;
	$jsondata['itemID'] 	= $itemID;
	$jsondata['comentario'] = $itemCom;
	$jsondata['foto'] 		= $itemFoto;
	$jsondata['estado'] 	= $itemEst;

    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);

?>