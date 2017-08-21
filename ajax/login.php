<?
require_once("../functions.php");

$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
if ($ajax) {

	$allowedDomains = array($dominio);
	
	$referer = $_SERVER['HTTP_REFERER'];
	
	$domain = parse_url($referer); //If yes, parse referrer
	
	if(in_array( $domain['host'], $allowedDomains)) {	
	
		session_start();
		
		require_once("../_lib/config.php");
		require_once("../_lib/MysqliDb.php");
		$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
		
		$email		= $_POST["username"];
		$password 	= $_POST["password"];
		$db->where ('usuMail', strtolower($email));
		$db->where ('usuPass',md5($password) );
		$db->where ('usuEst', 0);
		$user = $db->getOne ("usuario");
		
		
		if ($user['usuID'] == '') {
			$login = 0;
		}else{
			$usuID = $user['usuID'];
			
			$db->where('usuID',$usuID);
			$db->delete('usuToken');
		
		
				$_SESSION['todos']['id'] 		= $usuID;
				$_SESSION['todos']['username'] 	= $user['usuNomUsu'];
				$_SESSION['todos']['email'] 	= $user['usuMail'];
				$_SESSION['todos']['Logged']  	= true;  
		    
		    $login = 'ok';
		    
		    	
		    $data = Array (
			    'usuToken' 		=>  ''
			);
		
			$db->where ('usuID', $usuID);
			$db->update ('usuario', $data);
		    
		    $token 	= sha1(uniqid(mt_rand(), TRUE));
			$data 	= Array (
				"usuID" => $usuID,
			    "Token" => $token
			);	
			$id = $db->insert ('usuToken', $data);	
		    
		}
		
		setcookie("id", $usuID, time()+3600, "/");
		
		echo $login;
	}else{
		echo 'Dominio / Host no autorizado';
	}
}else{
	echo 'El archivo no se puede llamar directamente.';
}
        
?>