<?php
	/*
This script is use to upload any Excel file into database.
Here, you can browse your Excel file and upload it into 
your database.

Download Link: http://www.discussdesk.com/import-excel-file-data-in-mysql-database-using-PHP.htm

Website URL: http://www.discussdesk.com
*/

session_start();
require_once("../_lib/config.php");
require_once("../_lib/MysqliDb.php");

$link 	= mysql_connect(DBHOST, DBUSER, DBPASS) or die("Couldn't make connection.");
$db 	= mysql_select_db(DBNAME, $link) or die("Couldn't select database");

/************************ YOUR DATABASE CONNECTION END HERE  ****************************/



set_include_path(get_include_path() . PATH_SEPARATOR . 'classes/');
include 'PHPExcel/IOFactory.php';

		$sourcePath  = $_FILES['archivo']['tmp_name']; 
		$temp 		 = explode(".",$_FILES["archivo"]["name"]);
		$newfilename = sha1(uniqid(mt_rand(), TRUE)) . '.' .end($temp);
		$targetPath  = "uploads/".$newfilename; 
		move_uploaded_file($sourcePath,$targetPath) ;  
			
		$inputFileName = "uploads/".$newfilename;


try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount 	= count($allDataInSheet);  // Here get total count of row in that Excel sheet

$pieID 	= 0;

for($i=2;$i<=$arrayCount;$i++){
	
	$tieForm 	= trim($allDataInSheet[$i]["B"]); 
	$tieNom 	= utf8_decode( trim($allDataInSheet[$i]["A"])); 
	$tieDire 	= utf8_decode( trim($allDataInSheet[$i]["C"]));

	if($tieForm){
		
	
			$query = "insert into tiendas (
				paisID,
				tieForm,	
				tieNom,
				tieDire		
			) values(
				2,
				'".	$tieForm ."',
				'".	$tieNom  ."',
				'".	$tieDire ."'
			)";
	
			$insertTable= mysql_query($query);
			$msg = 'tienda agregada';
		
	}
}
echo $msg;
 

?>