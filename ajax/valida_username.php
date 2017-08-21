<?

	require_once("../_lib/config.php");
	require_once("../_lib/MysqliDb.php");
	$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);



// The back-end then will determine if the username is available or not,
// and finally returns a JSON { "valid": true } or { "valid": false }
// The code bellow demonstrates a simple back-end written in PHP

// Get the username from request
$username = $_POST['username'];

/*

$db->where("usuNomUsu", $username);
if($db->has("usuario")) {
    $isAvailable = false;
} else {
    $isAvailable = true;
}
*/
 $isAvailable = true;

$tema = $db->rawQuery('select * from usuario where usuNomUsu LIKE "'.$username.'"');
if($tema){
	foreach ($tema as $t) {
		$isAvailable = false;
	}
}else{
	 $isAvailable = true;
}


// Finally, return a JSON
echo json_encode(array(
    'valid' => $isAvailable,
));

?>