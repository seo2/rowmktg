<?php
// Begin the session
session_start();

// Unset all of the session variables.
session_unset();

// Destroy the session.
session_destroy();
/*
unset($_COOKIE['id']);
setcookie('id', null, -1, '/');
*/

require_once("_lib/config.php");
require_once("_lib/MysqliDb.php");
$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);

$db->where('usuID',$_COOKIE['id']);
$db->delete('usuToken');


$cookie_name = 'id';
unset($_COOKIE['id']);
$res = setcookie("id", '', time()-3600);
$res = setcookie("id", '', time()-3600, "/");


echo 'logout';

?>