<? 
	
session_start();
	if($_SESSION['todos']['Logged']){ 
	
	//setcookie('id', $_SESSION['todos']['id']);
 
	$usuID = $_SESSION['todos']['id'];
	
	setcookie("id", $usuID, time()+3600, "/");
 
 }elseif($_COOKIE['id']) { 
 	$usuID = $_COOKIE['id'];
 }else{ ?>
 <script>
 		window.location.replace("index.php");
 </script>
	

<?  }  ?>

<? 
	include('header.php');
?>
    <div class="container" id="argumentos">
	    

		    <div id="cajaposiciones">

				<div class="row">
			    <div class="col-md-12">
                    <form class="form-horizontal" id="formExcel2" method="post" accept-charset="utf-8">
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h2>Cargar en batch</h2>
			            </div>
			            <div class="panel-body">
			                <div class="row">
			                	<div class="col-sm-6">
									<div class="form-group">
				                        <label class="col-md-3 control-label" for="file-input">Archivo Excel</label>
				                        <div class="col-md-9">
				                            <input type="file" id="upload" name="upload" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
				                        </div>
				                    </div>
			                	</div>
			                	<div class="col-sm-6">
	
			                	</div>
			                </div>
			            </div>
			            <div class="panel-footer">
			                <button type="submit" class="btn btn-sm btn-primary" id="btnSubir"><i class="fa fa-upload"></i> Subir</button>
			            </div>
			        </div>

			        </form>

			    </div>
			</div>
			<!--/.row-->
		    </div>	    	
		    <footer class="animated bounceInRight">
		    	<a href="javascript:window.history.back();" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	  
		

		    
<? include('footer.php'); ?>