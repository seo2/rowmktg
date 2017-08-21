<? 
	
session_start();
if($_SESSION['todos']['Logged']){ 
 
	$usuID = $_SESSION['todos']['id'];
	
	setcookie("id", $usuID, time()+3600, "/");
 
 }elseif($_COOKIE['id']) { 
 	$usuID = $_COOKIE['id'];
 }else{ ?>
 <script>
	 
	 	actualurl = window.location.href;
	 
 		window.location.replace("index.php?redirect="+actualurl);
 </script>
	

<?  }  ?>
<? 
	include('header.php');
	

?>

    <div class="container" id="argumentos">
	        
		<header>
		    <span>Instore</span>
	    </header>
		   
		    <div id="cajaposiciones" >
			<?
				$sql  = "select * from piezas where formID = 1";

			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						$pieID = $r['pieID'];
						$pieDesc = $r['pieDesc'];
						$pieProv = $r['pieProv'];
						$pieCat = $r['pieCat'];
						$pieCan = $r['pieCan'];
						$pieCom = $r['pieCom'];
						$pieRes = $r['pieRes'];
						$pieEst = $r['pieEst'];
						$pieEnt = $r['pieEnt'];
						
						
						$data = Array (
							"formID"	=> 9,
							"pieDesc" 	=> $pieDesc,
							"pieProv" 	=> $pieProv,
							"pieCat" 	=> $pieCat,
							"pieCan" 	=> $pieCan,
							"pieCom" 	=> $pieCom,
							"pieRes" 	=> $pieRes,
							"pieEnt" 	=> $pieEnt,
							"pieEst" 	=> $pieEst
						);	
						
						$id = $db->insert ('piezas', $data);
						
						$opciones = get_total_opciones_pieza( $r['pieID']);
						if($opciones<=1){
							$opciones = 0;
						}else{
							$sql2  = "select * from pieza_opciones where pieID = $pieID";
			
						  	$res = $db->rawQuery($sql2);
							if($res){
								foreach ($res as $r2) {
									$opcDesc = $r2['opcDesc'];
									$opcEst = $r2['opcEst'];
									
									$data2 = Array (
										"pieID"		=> $id,
										"opcDesc" 	=> $opcDesc,
										"opcEst" 	=> $opcEst
									);	
									$id2 = $db->insert ('pieza_opciones', $data2);
									
								}
							}
						}		
						
						
						
		    ?>   
		    <? 		} 
			    } ?>	    		    
		    </div>
		    	
	    	<footer class="animated bounceInRight">
		    	<a href="formatos.php?piezas=1" id="btnvolver"><i class="fa fa-chevron-left"></i> <span>Volver</span></button>
	    	</footer>	    

		    
<? include('footer.php'); ?>