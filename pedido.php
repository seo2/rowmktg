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
	
	$tieID 	= $_GET['tieID'];
	$formID = get_formato_tienda($tieID);
	if($usuTipo==1){ // administrador
		$ptID = get_pedido_temporal($tieID);
	}elseif($usuTipo==2){ // Retail MKTG
		$ptID = get_pedido_temporal($tieID);
	}elseif($usuTipo==3){ // VM
		$ptID = get_pedido_temporal_x_usuario($paisID,$tieID,$usuID);
	}	
	if($ptID){
		$total = get_total_items_pedido_temporal($paisID,$ptID);
	}
	
?>

    <div class="container" id="argumentos">
	    
		<header>
		    <span><? if($paisID==7){ ?>Pedido atual<? }else{ ?>Pedido Actual<? } ?></span>
	    </header>

		    <div id="cajaposiciones" data-eveID="<?= $eveID; ?>" data-tiendaID="<?= $tieID; ?>">
			    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidohead">
				    <div class="row">
				    	<div class="col-xs-10 col-sm-8">
							<h2><?= get_tienda($tieID); ?></h2> 
				    	</div>
				    	<div class="col-xs-2  col-sm-4 text-right">
					    	<? if($ptID && $total > 0){ ?>
					    	<a href="formulario-pedido_v2.php?tieID=<?= $tieID; ?>" class="btn btn-default" style="margin:0"><span class="hidden-xs"><? if($paisID==7){ ?>Adicionar<? }else{ ?>Agregar<? } ?> </span><i class="fa fa-plus-circle"></i></a>
							<? } ?>
				    	</div>
				    </div><!-- FIN ROW -->
			    </div>			    
			    
			    
			<?
	/*
		
		ESTADOS:
		
		Solicitado: 			0 // creado por VM
		Para revisión: 			1 // A la espera de MM
		Objetado:				2 // Rechazado por MM
		Aprobado:				3 // Aprobado por MM --> traspasado a Proveedor --> para cotizar
		
		Cotizado:				4 // Recibido por Proveedor, ingresó precio y envió a MM
		Cotizacion Aprobada: 	5 // Cotización aprobada por MM --> Proveedor debe ingresar precio
		Ongoing:   				6 // Proveedor compromete fecha de entrega
		
		Entregado:				7 // Entregado por Proveedor
		Finalizado:				8 // Recepcionado por VM
		
	*/	

	
				
			if($ptID && $total > 0){

				$sql  = "select * from pedido_temporal_detalle where paisID = $paisID and ptID = $ptID";
				
			  	$resultado = $db->rawQuery($sql);
				if($resultado){
					foreach ($resultado as $r) {
						
						$fecha = substr($r['ptdTS'],8,2) . '/'. substr($r['ptdTS'],5,2) .'/'. substr($r['ptdTS'],0,4);
						$hora  = substr($r['ptdTS'],11,8);
						
						
						if($r['ptdV2']==1){	
							$pieza_opc_desc = get_instore_opc_desc_v2($r['formID'], $r['ptdGra'], $r['ptdGraOp']);
							
							if($pieza_opc_desc=='-' || $pieza_opc_desc==''){
								$pieza = '<small>'.get_instore_nom_gen_v2( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais_v2($paisID, $r['formID'], $r['ptdGra']);
							}else{
								$pieza = '<small>'.get_instore_nom_gen_v2( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais_v2($paisID, $r['formID'], $r['ptdGra']) . ' [' . $pieza_opc_desc . '] ';
							}
						}else{	
							$pieza_opc_desc = get_instore_opc_desc($r['formID'], $r['ptdGra'], $r['ptdGraOp']);
							
							if($pieza_opc_desc=='-' || $pieza_opc_desc==''){
								$pieza = '<small>'.get_instore_nom_gen( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais($paisID, $r['formID'], $r['ptdGra']);
							}else{
								$pieza = '<small>'.get_instore_nom_gen( $r['formID'], $r['ptdGra']) . '</small><br>' . get_instore_nom_x_pais($paisID, $r['formID'], $r['ptdGra']) . ' [' . $pieza_opc_desc . '] ';
							}
						}


						include('include-pedido.php');
		    
		     		} 
			    }	
			}else{ ?>
		    
				<div class="col-xs-12 col-md-6 col-md-offset-3 posicion" >
					<div class="row">
						<div class="col-xs-12 posevento">
							<a href="javascript:void(0);" class="updvit" ><? if($paisID==7){ ?>Seu pedido encontra-se vazio<? }else{ ?>Su pedido se encuentra vacio<? } ?></a>
							<br><span><? if($paisID==7){ ?>Pressione adicionar para começar<? }else{ ?>Presione agregar para empezar<? } ?>.</span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 text-center">
					    	<br><br><a href="formulario-pedido_v2.php?tieID=<?= $tieID; ?>" class="btn btn-default btn-lg"><span><? if($paisID==7){ ?>Adicionar<? }else{ ?>Agregar<? } ?> </span><i class="fa fa-plus-circle"></i></a><br><br>
						</div>
					</div>
				</div>
			<?
			}
			?>
			
				<div class="clear"></div>
		    			    		<?  
				 if($usuTipo<=2 && $ptID && $total > 0){ // MM ?>
				    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
					    <div class="row">
					    	<div class="col-xs-12 text-center">
								<a href="javascript:void(0);" class="btn btn-default btnenviar5" data-ptid="<?= $ptID; ?>" data-paisid="<?= $paisID; ?>" ><? if($paisID==7){ ?>Processar e aprovar um pedido<? }else{ ?>Procesar y Aprobar Pedido<? } ?> <i class="fa fa-check" aria-hidden="true"></i></a> 
					    	</div>
					    </div>
				    </div>
				<? } ?>	<div class="clear"></div>
		    			    		<?  
				 if($usuTipo==1 && $ptID && $total > 0){ // MM ?>
				    <div class="col-xs-12 col-md-6 col-md-offset-3" id="pedidofoot">
					    <div class="row">
					    	<div class="col-xs-12 text-center">
								<a href="javascript:void(0);" class="btn btn-default btnenviar6" data-ptid="<?= $ptID; ?>" data-paisid="<?= $paisID; ?>" ><? if($paisID==7){ ?>Processar<? }else{ ?>Procesar<? } ?><i class="fa fa-check" aria-hidden="true"></i></a> 
					    	</div>
					    </div>
				    </div>
				<? } ?>	
		    </div>

	    	<div id="footer" class="blancobg">
		    	<div class="container">
			    	<div class="row">
						<div class="col-xs-12 col-md-6 col-md-offset-3 footer">
							
					    	<? 
								$back = 'javascript:window.history.back();';
							?>
							<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
							  <a href="<?php echo $back; ?>" 	class="btn btn-default"><i class="fa fa-chevron-left"></i> <? if($paisID==7){ ?>Voltar<? }else{ ?>Volver<? } ?></a>
							  <a href="home.php" 				class="btn btn-default"><i class="fa fa-home"></i> Home</a>
							  <a href="javascript:void();" 		class="btn btn-default" id="logoutBtn"><i class="fa fa-sign-out"></i> <? if($paisID==7){ ?>Sair<? }else{ ?>Salir<? } ?></a>
							</div>
				    	</div>
			    	</div>
		    	</div>
	    	</div>	    



<!-- Modal Foto -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p id="titacabas2"></p>
  		<div class="row">
  			<form method="post" action="ajax/cambiar-estado-item-pedido.php" accept-charset="utf-8" id="formPedido" class="col-xs-12">	  					
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-6">
			    		<div id="fotito">
			    			<img src="" class="img-responsive" id="fotoperfil2" >
			    		</div>
					</div>
				</div>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div>    

<!-- Modal -->
<div class="modal fade" id="ModalComentarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
      	<a href="javascript:void(0);" data-dismiss="modal" class="btn-close"><i class="fa fa-times"></i></a>
  		<p><strong><? if($paisID==7){ ?>Adicionar comentário<? }else{ ?>Agregar Comentario<? } ?></strong></p>
  		<p id="nombreitem"></p>
  		<div class="row">
  			<form method="post" action="ajax/graba-comentario-pedido.php" accept-charset="utf-8" id="formComentario" class="col-xs-12">				  				  			
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<input type="hidden" name="paisID" 	 value="<?= $paisID; ?>">
						<input type="hidden" name="ptID" 	 value="<?= $ptID; ?>">
						<input type="hidden" name="ptdItem"  id="ptdItem3" value="">
						<input type="hidden" name="ptoUsu"  value="<?= $usuID; ?>">
						<textarea class="form-control" rows="5" name="ptoObs" placeholder="<? if($paisID==7){ ?>Adicionar comentário<? }else{ ?>Escribir comentario<? } ?>" id="argTxt" required></textarea>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" id="btnComentar"><i class="fa fa-comments"></i> Enviar</button>
  			</form>
  		</div>
      </div>
    </div>
  </div>
</div> 
 
<? include('footer.php'); ?>