<?php
	/*
This script is use to upload any Excel file into database.
Here, you can browse your Excel file and upload it into 
your database.

Download Link: http://www.discussdesk.com/import-excel-file-data-in-mysql-database-using-PHP.htm

Website URL: http://www.discussdesk.com
*/

require_once("../functions.php");




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

for($i=1;$i<=$arrayCount;$i++){
	
	$formID 	=  trim($allDataInSheet[$i]["A"]); 
	$inCaMed 	=  trim($allDataInSheet[$i]["B"]); 
	$inCaNom 	=  trim($allDataInSheet[$i]["C"]);

	
	$data = Array (	
		'formID'	=> $formID,
		'inCaMed' 	=> $inCaMed,
		'inCaNom' 	=> $inCaNom
	);	
	
	$insID = $db->insert ('instores_campanas', $data);	
			

		
}
echo $msg;
 

?>