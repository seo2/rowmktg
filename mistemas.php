<? 
	

session_start();
if($_SESSION['todos']['Logged']){ 
	
	setcookie("id", $usuID, time()+3600, "/");
 
	$usuID = $_SESSION['todos']['id'];
 
 }elseif($_COOKIE['id']) { 
 	$usuID = $_COOKIE['id'];
	
	setcookie("id", $usuID, time()+3600, "/");
 }else{ ?>
 <script>
 		window.location.replace("index.php");
 </script>
	

<?  }  ?><? include('header.php'); ?>
<?

	$res = $db->rawQuery('select * from usuToken where usuID = '.$usuID);
	if($res){
		foreach ($res as $re) {
			$token = $re['Token'];
		}
	}
		
	
?>
<? include('menu.php'); ?>

    <div class="container" id="mistemas">
		   <nav class="navbar navbar-inverse navbar-fixed-top">
			  <div class="container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" id="btnmenu" >
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <span>Mis Temas</span>
			    </div>
			
			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
			        <li><a href="#">Link</a></li>
			        <li><a href="#">Link</a></li>
			      </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>	    
    	<div class="row">
	    	<div class="col-xs-12 col-sm-4 col-sm-offset-4 text-center">
		    	<h2>Acá puedes modificar tus temas de interés.</h2>
		    	<p class="text-right" id="todos"><input type="checkbox" id="select_all" name="todos"/> <span for="todos">Seleccionar todos</span></p>
	    	</div>
    	</div>
    	
    	<div class="row">
	    	<div class="col-sm-12 col-sm-4 col-sm-offset-4 ">
		    	<form action="ajax/mistemas.php" method="post" accept-charset="utf-8" id="formTemas">
					<?
					  	$resultado = $db->rawQuery('select * from temas');
						if($resultado){
							foreach ($resultado as $r) {
								
								$ok = get_mitema($r['temaID'], $usuID);
								
				    ?>  
					<div class="form-group">
			    		<label class="checkbox-inline sombra">
							<input type="checkbox" id="tema<?= $r['temaID'];?>" value="1" name="tema<?= $r['temaID'];?>" class="checktema" <? if($ok==1){ ?>checked<? } ?>>
							<span for="tema<?= $r['temaID'];?>"><?= $r['temaDesc'];?> <i class="fa fa-check" <? if($ok==0){ ?>style="display:none;" <? } ?>></i></span>	
						</label>
					</div>
			    <? 		} 
				    } ?>
					<input type="hidden" value="<?= $token; ?>" name="token">
					<div class="row text-center">
						<button type="submit" class="btn btn-primary col-xs-8 col-xs-offset-2" id="btncomienza">Guardar</button>
					</div>
		    	</form>
	    	</div>
    	</div>
    	
<? include('footer.php'); ?>
