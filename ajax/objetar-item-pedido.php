<?php
require_once("../functions.php");

$paisID 	= $_POST['paisID'];
$pdID 		= $_POST['ptID'];
$ptdItem 	= $_POST['ptdItem'];
$ptoUsu 	= $_POST['ptoUsu'];
$vm 		= $_POST['vm'];
$ptoObs 	= $_POST['ptoObs'];
$estfin 	= 2;

$to			= get_user_mail($vm);

$to			= "seodos@gmail.com";

$data1 = Array (
	"ptdEst" 	=> $estfin
);		
$db->where("paisID", $paisID);
$db->where("ptID", $pdID);
$db->where("ptdItem", $ptdItem);
$db->update('pedido_temporal_detalle', $data1);


$data2 = Array (
	"paisID" 	=> $paisID,
	"ptID" 		=> $pdID,
	"ptdItem" 	=> $ptdItem,
	"ptoUsu" 	=> $ptoUsu,
	"ptoObs" 	=> $ptoObs
);


if($_POST['ptID'] && $_POST['ptdItem'] && $_POST['ptoID']){
	
	$ptoID = $_POST['ptoID'];
	
	$db->where("paisID", $paisID);
	$db->where("ptID", $pdID);
	$db->where("ptdItem", $ptdItem);
	$db->where("ptoID", $ptoID);
	$db->update('pedido_observaciones', $data2);		
		
	
}else{

	date_default_timezone_set('America/Santiago');
		
	$id = $db->insert ('pedido_observaciones', $data2);	
}



if($estfin==2){
	$subject = 'Se ha rechazado un ítem del Pedido Nº '.$pdID;
	$headers = "From: " . "<no-reply@rowmktg.cl> Reebok Onretail Wholesale Marketing" . "\r\n";
	//$headers .= "Reply-To: ". "seo2@seo2.cl" . "\r\n";
	$headers .= "CC: mc@seo2.cl\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
	
	$message  	= '<html><body style="font-family: Helvetica, Arial, sans-serif;">';
    if($paisID==7){
		$message .= '<h2>Item Recusado - '.$date.'</h2>';
    }else{
		$message .= '<h2>Item Rechazado - '.$date.'</h2>';
    } 	
	
	$i 		= 0;
	$sql  	= "SELECT * FROM pedido_temporal WHERE paisID = $paisID and ptID = $pdID";	
	
  	$resultado = $db->rawQuery($sql);
	if($resultado){
		foreach ($resultado as $r0) {
			
			$ptTS  = $r0['ptTS'];
			$fecha = substr($ptTS,8,2) . '/'. substr($ptTS,5,2) .'/'. substr($ptTS,0,4);
			$hora  = substr($ptTS,11,8);
			
			$message  = '<html><head></head><body style="font-family: Helvetica, Arial, sans-serif;">';
			$message .= '<div><img src="http://rowmktg.cl/assets/img/cabeceramail.png"></div>';
			$message .= '<h3>Pedido N&ordm; '.$pdID.' del '.$fecha.'</h3>';
			$message .= '<div class="row">'.utf8_decode(get_tienda(get_tienda_pedido($paisID,$pdID))).' <small><strong>'.get_formato(get_formato_tienda(get_tienda_pedido($paisID,$pdID))).'</strong></small>';
			if($paisID==7){
				$message .= '<div class="row"> Rejeitado por: '.utf8_decode( get_user_nombre($ptoUsu)).'</strong></small>';
		    }else{
				$message .= '<div class="row"> Rechazado por: '.utf8_decode( get_user_nombre($ptoUsu)).'</strong></small>';
		    } 			
			
			$message .= '<br><br>';
			
			$sql2  		= "SELECT *  FROM pedido_temporal_detalle WHERE paisID = $paisID and ptID = $pdID and ptdItem = $ptdItem";
		  	$resultado2 = $db->rawQuery($sql2);
			if($resultado2){
				foreach ($resultado2 as $r) {
					$fecha = substr($r['ptdTS'],8,2) . '/'. substr($r['ptdTS'],5,2) .'/'. substr($r['ptdTS'],0,4);
					$hora  = substr($r['ptdTS'],11,8);
				
					$fecen = substr($r['ptdFecEn'],8,2) . '/'. substr($r['ptdFecEn'],5,2) .'/'. substr($r['ptdFecEn'],0,4);
				
					$pieza_opc_desc = get_instore_opc_desc($r['formID'], $r['ptdGra'], $r['ptdGraOp']);
					
					if($pieza_opc_desc=='-' || $pieza_opc_desc==''){
						$pieza = get_instore_nom_gen( $r['formID'], $r['ptdGra']) . ' - ' . get_instore_nom_x_pais($paisId, $r['formID'], $r['ptdGra']);
					}else{
						$pieza = get_instore_nom_gen( $r['formID'], $r['ptdGra']) . ' - ' . get_instore_nom_x_pais($paisId, $r['formID'], $r['ptdGra']) . ' [' . $pieza_opc_desc . '] ';
					}

					$estado = get_desc_estado($r['ptdEst']);
					$clase  = get_class_estado($r['ptdEst']);
									
					$message .= "<div style='border-bottom: 1px solid #ccc; padding: 0 0 10px 0; margin-bottom:10px; font-size:12px;' >";
					$message .= "<div style='margin-bottom:5px; font-size:14px;'>Instore: <strong>".utf8_decode( $pieza)."</strong></div>";

				    if($paisID==7){
						$message .= "<div  style='margin-bottom:5px;'><span>Quantidade: <strong>".$r['ptdCan']."</strong></div>";
				    }else{
						$message .= "<div  style='margin-bottom:5px;'><span>Cantidad: <strong>".$r['ptdCan']."</strong></div>";
				    } 

					if( $r['ptdObs']){
					    if($paisID==7){
							$message .= "<div  style='margin-bottom:5px;'><span>Obs:</span> <span><strong>". utf8_decode( $r['ptdObs'])." </strong></span></div>"; 
					    }else{
							$message .= "<div  style='margin-bottom:5px;'><span>Observaci&oacute;n:</span> <span><strong>". utf8_decode( $r['ptdObs'])." </strong></span></div>"; 
					    } 
					}
					
					if($paisID==7){
						$message .= "<div  style='margin-bottom:5px;'><span>Pedido por: <strong>". utf8_decode( get_user_nombre($r['ptdVM']))." </strong><span></div>";
						$message .= "<div  style='margin-bottom:5px;'><span>Respons&aacute;vel: <strong>". utf8_decode( get_user_nombre($r['ptdRes']))."</strong><span></div>";
						$message .= "<div  style='margin-bottom:5px;'><span>Fornecedor: <strong>". utf8_decode( get_proveedor_nombre($r['ptdProv']))."</strong><span></div>";
					}else{
						$message .= "<div  style='margin-bottom:5px;'><span>Solicitado por: <strong>". utf8_decode( get_user_nombre($r['ptdVM']))." </strong><span></div>";
						$message .= "<div  style='margin-bottom:5px;'><span>Responsable: <strong>". utf8_decode( get_user_nombre($r['ptdRes']))."</strong><span></div>";
						$message .= "<div  style='margin-bottom:5px;'><span>Proveedor: <strong>". utf8_decode( get_proveedor_nombre($r['ptdProv']))."</strong><span></div>";
					} 
					
					$estado =$r['ptdEst'];

					if($r['ptdCat']>0){
						$camfile = get_foto_campana($r['ptdCat']);
							$camfile =  str_replace('../', '', $camfile) ;
						$message .= "<div class='posevento fotospedido'>";
						if($paisID==7){
							$message .= "<span>Imagem de cat&aacute;logo:</span><br>";
					    }else{
							$message .= "<span>Imagen de Cat&aacute;logo:</span><br>";
					    } 
						$message .= "<img src='http://rowmktg.cl/resize2.php?img=".$camfile."&width=300&height=300&mode=fit' class='img-responsive'>";
						$message .= "</div>";
					}else{
						$camfile = $r['ptdISC'];
						$message .= "<div class='posevento fotospedido'>";
						if($paisID==7){
							$message .= "<span>Imagem ISC</span><br>";
					    }else{
							$message .= "<span>Imagen ISC</span><br>";
					    } 
						$message .= "<img src='http://rowmktg.cl/resize2.php?img=".$camfile."&width=300&height=300&mode=fit' class='img-responsive'>";
						$message .= "</div>";
				 	} 
					if($r['ptdFoto']){	
						$message .= "<div class='posevento fotospedido'>";
						$message .= "<span>Foto:</span><br>";
						$message .= "<img src='http://rowmktg.cl/resize3.php?img=ajax/uploads/".$r['ptdFoto']."&width=300&height=300&mode=fit' class='img-responsive'>";	
						$message .= "</div>";
					} 

						
					$message .= "<div class='col-lg-12'>";
					$message .= "<div class='row' id='comentarios'>";
					
					$ptditem = $r['ptdItem'];	
					
					$sql3  = "select * from pedido_observaciones where paisID = $paisID and ptID = $pdID and ptdItem = $ptditem";
					$c		= 1;
				  	$resultado3 = $db->rawQuery($sql3);
					if($resultado3){
						foreach ($resultado3 as $r2) {
							
							$fecha2 = substr($r2['ptoTS'],8,2) . '/'. substr($r2['ptoTS'],5,2) .'/'. substr($r2['ptoTS'],0,4);
							$hora2  = substr($r2['ptoTS'],11,8);

							$message .= "<div style='boder-top:1px dashed #eee'>";
							$message .= "<p><strong class='text-primary'>". get_user_nombre($r2['ptoUsu'])."</strong> <small>". get_tipo_usuario_desc(get_usertipo($r2['ptoUsu']))."</small></p>";
							$message .= "<p>". utf8_decode( $r2['ptoObs'])."</p>";
							$message .= "<small>". $fecha2." ".$hora."</small>";
							$message .= "</div>";
			     		} 
				    }	
	
					$message .= "</div>";
					$message .= "</div>";
						
						
					$message .= "</div>";

					$message .= "</div>";							
					
					
																				    
    			}
	    	}
			$message .='</div>';	
			$message .='<div ><a style="padding:10px 20px; background: #000; color:#fff; display: block; margin:10px auto; width:100px; text-align: center; text-decoration:none;" href="http://rowmktg.cl/">Ir al sitio</a></div>';
			$message .= "<div style='height:50px; background: #0084D6; margin-bottom:40px;'>";	
			$message .= "</div>";	
			$message .= "</body></html>";
		}
	}		
			mail($to, $subject, $message, $headers);
					

}

echo 1;
?>