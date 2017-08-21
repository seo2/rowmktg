<?

require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");
$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$username = $_POST['usuMail'];

$isAvailable = true;

$tema = $db->rawQuery('select * from usuario where usuMail LIKE "'.$username.'"');
if($tema){
	foreach ($tema as $t) {
		$isAvailable = false;
	}
}else{
	 $isAvailable = true;
}

echo json_encode(array(
    'valid' => $isAvailable,
));

?>