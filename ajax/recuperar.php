<?php
session_start();
require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");
$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);


$email	= $_POST["email"];
$length = 20;
$token 	= sha1(uniqid(mt_rand(), TRUE));

$db->where ("usuMail", $email);
$user = $db->getOne ("usuario");

if ($user['usuID'] != '') {
	$password 		= $user['usuPass'];
	$usermd5 		= md5($email);
	$admin_email 	= "no-contestar@todos.cl";
	$email 			= $email;
	$subject 		= "Recupera tu contraseña en Todos";
	$comment 		= "Reinicia tu contraseña en http://seo2.cl/clientes/todos/restaurar.php?token=".$token;
	$headers = array('Content-Type: text/html; charset=UTF-8');
	//wp_mail( $email, $subject, $comment, $headers );
	
	
	mail($email, "$subject", $comment, "From:" . $admin_email);
	
	$data = Array (
	    'usuToken' 		=>  $token
	);

	$id_usu = $user['usuID'] ;
	
	$db->where ('usuID', $id_usu);
	$db->update ('usuario', $data);


	$registrado = 'ok';
}else{
	$registrado = 'error';

}


echo $registrado;

?>


