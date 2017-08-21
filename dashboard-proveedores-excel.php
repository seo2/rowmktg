<? 
session_start();
require_once("functions.php");

if($_SESSION['todos']['Logged']){ 
	
	//setcookie('id', $_SESSION['todos']['id']);
 
	$usuID = $_SESSION['todos']['id'];
	$paisID 	= get_userpais($usuID);
	$usuTipo 	= get_usertipo($usuID);
	
	setcookie("id", $usuID, time()+3600, "/");
 
 }elseif($_COOKIE['id']) { 
 	$usuID = $_COOKIE['id'];
	$paisID 	= get_userpais($usuID);
	$usuTipo 	= get_usertipo($usuID);
 }else{ 
	 echo 'No está autorizado para ver este archivo';
		exit;
 }
 
 
	if($_GET['aaaa']){
		$anito =  $_GET['aaaa'];
	}else{
		$anito =  date("Y");
	}
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=Resumen-x-Proveedores-$anito.xls" );
	
	require_once("functions.php");

	function pedidos_x_proveedor_x_fecha($provID,$ini,$fin){
		$db = MysqliDb::getInstance();
		$sql  = "SELECT sum(b.ptdValor) as valor FROM pedido_temporal a, pedido_temporal_detalle b WHERE a.ptTS>='$ini'  AND a.ptTS< '$fin'  AND b.ptdProv = $provID AND b.ptID = a.ptID AND b.ptdEst >=7";
		$valor = 0;
	  	$c = $db->rawQuery($sql);
		if($c){
			foreach ($c as $p) {
				$valor = $p['valor'];
			} 
	    } 
	    
	    return $valor;
	    
	}

	
	function pedidos_x_rango_fecha($ini,$fin){
		$db = MysqliDb::getInstance();
		$sql  = "SELECT sum(b.ptdValor) as valor FROM pedido_temporal a, pedido_temporal_detalle b WHERE a.ptTS>='$ini'  AND a.ptTS< '$fin' AND b.ptID = a.ptID AND b.ptdEst >=7";
		$valor = 0;
	  	$c = $db->rawQuery($sql);
		if($c){
			foreach ($c as $p) {
				$valor = $p['valor'];
			} 
	    } 
	    
	    return $valor;
	    
	}


	if($_GET['desde']){
		$fecini  =  $_GET['desde']; 
		$fecfin  =  $_GET['hasta']; 
	}else{
	
		if($_GET['aaaa']){
			$anoactual =  $_GET['aaaa'];
		}else{
			$anoactual =  date("Y");
		}
		$proxano   = $anoactual +1;
		
		$fecini  =  $anoactual.'-01-01'; 
		$fecfin  =  $proxano.'-01-01'; 
	
		$fecini1  =	$anoactual.'-01-01 00:00:00'; 
		$fecfin1  = $anoactual.'-02-01 00:00:00';
		$fecini2  =	$anoactual.'-02-01 00:00:00'; 
		$fecfin2  = $anoactual.'-03-01 00:00:00';
		$fecini3  = $anoactual.'-03-01 00:00:00'; 
		$fecfin3  = $anoactual.'-04-01 00:00:00';
		$fecini4  = $anoactual.'-04-01 00:00:00'; 
		$fecfin4  = $anoactual.'-05-01 00:00:00';
		$fecini5  =	$anoactual.'-05-01 00:00:00'; 
		$fecfin5  = $anoactual.'-06-01 00:00:00';
		$fecini6  =	$anoactual.'-06-01 00:00:00'; 
		$fecfin6  = $anoactual.'-07-01 00:00:00';
		$fecini7  =	$anoactual.'-07-01 00:00:00'; 
		$fecfin7  = $anoactual.'-08-01 00:00:00';
		$fecini8  =	$anoactual.'-08-01 00:00:00'; 
		$fecfin8  = $anoactual.'-09-01 00:00:00';
		$fecini9  =	$anoactual.'-09-01 00:00:00'; 
		$fecfin9  = $anoactual.'-10-01 00:00:00';
		$fecini10 =	$anoactual.'-10-01 00:00:00'; 
		$fecfin10 = $anoactual.'-11-01 00:00:00';
		$fecini11 =	$anoactual.'-11-01 00:00:00'; 
		$fecfin11 = $anoactual.'-12-01 00:00:00';
		$fecini12 =	$anoactual.'-12-01 00:00:00'; 
		$fecfin12 = $proxano.'-01-01 00:00:00';
		
	}

?>
					<div class="row">		
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<table class="table table-bordered table-hover table-condensed dashboard" id="latabla">
									  <thead>
										  <tr >
											  <th>Proveedores</th>
											  <th>Total</th>
											  <th class="text-center">Ene</th>
											  <th class="text-center">Feb</th>
											  <th class="text-center">Mar</th>
											  <th class="text-center">Abr</th>
											  <th class="text-center">May</th>
											  <th class="text-center">Jun</th>
											  <th class="text-center">Jul</th>
											  <th class="text-center">Ago</th>
											  <th class="text-center">Sep</th>
											  <th class="text-center">Oct</th>
											  <th class="text-center">Nov</th>
											  <th class="text-center">Dic</th>
										  </tr>
									  </thead>   
									  <tbody>
<?
	
				$sumaTotal = pedidos_x_rango_fecha($anoactual.'-01-01 00:00:00',$proxano.'-01-01 00:00:00');
	
	
				$formatos_sql  = "SELECT * from proveedores where paisID = $paisID";
			  	$formatos = $db->rawQuery($formatos_sql);
				if($formatos){
					foreach ($formatos as $f) {
						$provID 	= $f['provID'];
						$proveedor	= $f['provNom'];
						
						$total = 0;

						// Detalle Pedidos
						$ini = $anoactual.'-01-01 00:00:00';
						$fin = $proxano.'-01-01 00:00:00';
					    $total = pedidos_x_proveedor_x_fecha($provID,$ini,$fin);
								
								
								
?>										  
										<tr class="prov" id="prov-<?= $provID; ?>">
											<td><strong><?= $proveedor; ?></strong></td>
											<td class="text-right">$ <?= number_format($total,0,',','.'); ?></td>
											<?
											
												$ene =	pedidos_x_proveedor_x_fecha($provID,$fecini1,$fecfin1);
												$feb =	pedidos_x_proveedor_x_fecha($provID,$fecini2,$fecfin2);
												$mar = 	pedidos_x_proveedor_x_fecha($provID,$fecini3,$fecfin3);
												$abr = 	pedidos_x_proveedor_x_fecha($provID,$fecini4,$fecfin4);
												$may =	pedidos_x_proveedor_x_fecha($provID,$fecini5,$fecfin5);
												$jun =	pedidos_x_proveedor_x_fecha($provID,$fecini6,$fecfin6);
												$jul =	pedidos_x_proveedor_x_fecha($provID,$fecini7,$fecfin7);
												$ago =	pedidos_x_proveedor_x_fecha($provID,$fecini8,$fecfin8);
												$sep =	pedidos_x_proveedor_x_fecha($provID,$fecini9,$fecfin9);
												$oct =	pedidos_x_proveedor_x_fecha($provID,$fecini10,$fecfin10);
												$nov =	pedidos_x_proveedor_x_fecha($provID,$fecini11,$fecfin11);
												$dic =	pedidos_x_proveedor_x_fecha($provID,$fecini12,$fecfin12);
												
												$totform0  = $totform0 + $total;
												$totform1  = $totform1 + $ene;
												$totform2  = $totform2 + $feb;
												$totform3  = $totform3 + $mar;
												$totform4  = $totform4 + $abr;
												$totform5  = $totform5 + $may;
												$totform6  = $totform6 + $jun;
												$totform7  = $totform7 + $jul;
												$totform8  = $totform8 + $ago;
												$totform9  = $totform9 + $sep;
												$totform10 = $totform10 + $oct;
												$totform11 = $totform11 + $nov;
												$totform11 = $totform12 + $dic;												
												
												$tot0  = $tot0 + $total;
												$tot1  = $tot1 + $ene;
												$tot2  = $tot2 + $feb;
												$tot3  = $tot3 + $mar;
												$tot4  = $tot4 + $abr;
												$tot5  = $tot5 + $may;
												$tot6  = $tot6 + $jun;
												$tot7  = $tot7 + $jul;
												$tot8  = $tot8 + $ago;
												$tot9  = $tot9 + $sep;
												$tot10 = $tot10 + $oct;
												$tot11 = $tot11 + $nov;
												$tot11 = $tot12 + $dic;
												
											?>
											
											
											
											<td class="text-right">$ <?= number_format($ene,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($feb,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($mar,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($abr,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($may,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($jun,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($jul,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($ago,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($sep,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($oct,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($nov,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($dic,0,',','.'); ?></td>
										</tr>
	
										
										
		    <? 		
			    
			    
						$totform0  = 0;
						$totform1  = 0;
						$totform2  = 0;
						$totform3  = 0;
						$totform4  = 0;
						$totform5  = 0;
						$totform6  = 0;
						$totform7  = 0;
						$totform8  = 0;
						$totform9  = 0;
						$totform10 = 0;
						$totform11 = 0;
						$totform11 = 0;
			    
			    	} 
			    } ?>										
										<tr class="totales" >
											<td class="text-right">TOTAL:</td>
											<td class="text-right">$ <?= number_format($tot0,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot1,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot2,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot3,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot4,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot5,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot6,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot7,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot8,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot9,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot10,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot11,0,',','.'); ?></td>
											<td class="text-right">$ <?= number_format($tot12,0,',','.'); ?></td>
										</tr>										
									  </tbody>
								  </table>            
								</div>
							</div>
						</div><!--/col-->
					
					</div><!--/row-->			    
			    