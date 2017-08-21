<?
	require_once("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Adidas - Onretail Wholesale Marketing</title>

	<link rel="icon" type="image/png" href="assets/img/favicon.png" >

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="assets/css/bootstrap.min.css" 		rel="stylesheet">
    <link href="assets/css/formValidation.min.css" 	rel="stylesheet">
    <link href="assets/css/sweetalert.css" 			rel="stylesheet">
    <link href="assets/datepicker/css/datepicker.css?v=1" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="assets/css/visualapp.css?ver=1.5.4" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?
	  if($usuID){
		$usuTipo 	= get_usertipo($usuID);
		$paisID 	= get_userpais($usuID);
	  }
	?>
    
</head>
<body>	
	
<?php	
	
	if(($_SESSION['todos']['Logged'] || $_COOKIE['id']) && $home!=1){  ?>
	<div id="botonera">
		<a href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a>
	</div>
	<?  }  ?>


<?php	
	
	if(($_SESSION['todos']['Logged'] || $_COOKIE['id'])){  
		
		if($paisID==1){
			$pais='chile';
		}elseif($paisID==2){
			$pais='colombia';
		}elseif($paisID==3){
			$pais='argentina';
		}elseif($paisID==4){
			$pais='mexico';
		}elseif($paisID==5){
			$pais='peru';
		}elseif($paisID==6){
			$pais='panama';
		}elseif($paisID==7){
			$pais='brazil';
		}else{
			$pais='panama';
		}
		
	?>
	<div id="usuario">
		<p><?php echo get_user_nombre2($usuID); ?></p>
	</div>
	<div id="bandera">
		<img src="assets/img/flags/<?php echo $pais; ?>.png" class="img-responsive">
	</div>

<?  }  ?>