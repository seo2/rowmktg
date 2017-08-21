<?php
require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");
$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$regionID = $_POST["regionID"];

$resultado = $db->rawQuery('SELECT comuna_id, comuna_nombre FROM provincia p INNER JOIN comuna c ON p.provincia_id = c.comuna_provincia_id WHERE provincia_region_id = ? ORDER BY comuna_nombre ASC', Array ($regionID));
if($resultado){
foreach ($resultado as $r) {
    $json[] = array('Value' => $r["comuna_id"], 'Display' => $r["comuna_nombre"]);
}
}

$comunas = array('comunas' => $json);

header("Content-Type: application/json", true);
echo json_encode($comunas);
?>