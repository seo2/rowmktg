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
<? //include('menu.php'); ?>
    <div class="container" id="argumentos">
	    
		   
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
				  <a href="javascript:void(0);" id="closeMenu" style="display:none" class="animated fadeInDownBig"><i class="fa fa-times"></i></a>
			      <span><?= $titulo; ?></span>
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

		    <div id="cajaposiciones">

				<div class="row">
			    <div class="col-md-12">
                    <form class="form-horizontal" id="formExcel" method="post" accept-charset="utf-8">
			        <div class="panel panel-default">
			            <div class="panel-heading">
			                <h2>Cargar en batch</h2>
			            </div>
			            <div class="panel-body">
				            			    
				            <div class="row">
				            	<div class="col-sm-6">
				                    <div class="form-group">
				                        <label class="col-md-3 control-label" for="text-input">Evento</label>
				                        <div class="col-md-9">
				                            <input type="text" class="form-control required" placeholder="Nombre del evento" name="eveNombre" required>
				                        </div>
				                    </div>			                    		
				            	</div>
				            </div>
			                <div class="row">
			                	<div class="col-sm-6">
									<div class="form-group">
				                        <label class="col-md-3 control-label" for="file-input">Archivo Excel</label>
				                        <div class="col-md-9">
				                            <input type="file" id="upload" name="upload" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
				                            <input type="hidden" name="usuID" value="<?= $_usuID; ?>">
				                            <input type="hidden" name="empresa" value="<?= $_usuEmp; ?>">
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