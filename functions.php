<?
	
	session_start();
	require_once("_lib/config.php");
	require_once("_lib/MysqliDb.php");
	require_once("lib/WideImage.php");
	$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);


	global $urlactual, $dominio;
	$dominio   = $_SERVER['SERVER_NAME'];
	$urlactual = 'http://'.$_SERVER['SERVER_NAME'];

    function init () {
		$db = new MysqliDb (DBHOST, DBUSER, DBPASS, DBNAME);
    }	
	
	function get_username($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["usuNom"];
			}
		}

		return $temaDesc;
		
	}	

	function get_user_nombre($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["usuNom"] . ' ' . $t["usuApe"];
			}
		}

		return $temaDesc;
		
	}	

	function get_user_nombre2($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  =  substr($t["usuNom"], 0,1)  . '. ' . $t["usuApe"];
			}
		}

		return $temaDesc;
		
	}	

	function get_user_mail($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["usuMail"];
			}
		}

		return $temaDesc;
		
	}

	function get_usertipo($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$usuTipo  = $t["usuTipo"];
			}
		}

		return $usuTipo;
		
	}

	function get_userpais($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$usuTipo  = $t["paisID"];
			}
		}

		return $usuTipo;
		
	}


	function get_proveedor_usuario($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				$usuProv  = $t["usuProv"];
			}
		}

		return $usuProv;
		
	}
	
	function get_comuna($comID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from comuna where comuna_id = '.$comID);
		if($tema){
			foreach ($tema as $t) {
				$temaDesc  = $t["comuna_nombre"];
			}
		}

		return $temaDesc;
		
	}

	function get_usercomuna($userID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario where usuID = '.$userID);
		if($tema){
			foreach ($tema as $t) {
				if($t["usuCom"]>0){
					$temaDesc  =  get_comuna($t["usuCom"]);
				}else{
					$temaDesc  =  '';
				}
			}
		}

		return $temaDesc;
		
	}
	
	
	function get_estado_tienda($tiendaID,$eveID){
		$db 	= MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from items where tiendaID = '.$tiendaID.' and eveID = '.$eveID.' and itemEst = 0');
		$ok = 1;
		if($tema){
			foreach ($tema as $t) {
					$ok = 0;
			}
		}else{
			$ok = 1;
		}

		return $ok;
	
	}
	
	
	function get_evento($eveID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from eventos where eveID = '.$eveID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["eveNombre"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}
	
	function get_tienda($eveID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from tiendas where tieID = '.$eveID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["tieNom"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}


	function get_pieza_desc($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from piezas where pieID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["pieDesc"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
	}


	function get_instore_desc($formID, $ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores where formID = '.$formID.' and insID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["insNomGes"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
	}


	function get_instore_gen($formID, $ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores where formID = '.$formID.' and insID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["insNomGen"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
	}


	function get_instore_desc_v2($formID, $ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_v2 where formID = '.$formID.' and insID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["insNomGes"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
	}


	function get_instore_gen_v2($formID, $ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_v2 where formID = '.$formID.' and insID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["insNomGen"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
	}


	function get_pieza_entrega($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from piezas where pieID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$pieEnt  = $t["pieEnt"];
			}
		}else{
			$pieEnt = 0;
		}

		return $pieEnt;
	}


	function get_pieza_opc_desc($pieID,$ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pieza_opciones where pieID = '.$pieID.' and opcID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["opcDesc"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
	}
	
	function get_votoTipo($posID, $usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery("select * from votosUsuario where posID = $posID and usuID = $usuID");
		if($tema){
			foreach ($tema as $t) {
				$votoTipo  = $t["votoTipo"];
			}
		}else{
			$votoTipo = 0;
		}

		return $votoTipo;
		
	}
	function get_votoAct($posID, $usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery("select * from votosUsuario where posID = $posID and usuID = $usuID");
		if($tema){
			foreach ($tema as $t) {
				$votoTipo  = $t["votoAct"];
			}
		}else{
			$votoTipo = 0;
		}

		return $votoTipo;
		
	}


	function get_mitema($temaID, $usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery("select * from usutemas where usuID = $usuID and temaID = $temaID");
		if($tema){
			foreach ($tema as $t) {
				$ok = 1;			
			}
		}else{
				$ok = 0;
		}

		return $ok;
		
	}

	function get_votos($posID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery("select count(*) as total from votosUsuario where posID = $posID");
		if($tema){
			foreach ($tema as $t) {
				$votos  = $t["total"];			
			}
		}else{
				$votos = 0;
		}

		return $votos;
		
	}

	function get_regiones(){
		$db = MysqliDb::getInstance();
		$regiones = $db->rawQuery("SELECT region_id, region_nombre from region");
		return($regiones);    
	}

	function get_total_argumentos($posID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery("select count(*) as total from argumenos where posID = $posID and argEst = 0");
		if($tema){
			foreach ($tema as $t) {
				$votos  = $t["total"];			
			}
		}else{
				$votos = 0;
		}

		return $votos;
		
	}

	function get_voto_argumentos($posID,$argID,$usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery("select count(*) as total from votosUsuArg where posID = $posID and argID = $argID and usuID = $usuID and votoEst = 1");
		if($tema){
			foreach ($tema as $t) {
				$votos  = $t["total"];			
			}
		}else{
				$votos = 0;
		}

		return $votos;
		
	}

	function get_votos_argumentos($posID,$argID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery("select count(*) as total from votosUsuArg where posID = $posID and argID = $argID and votoEst = 1");
		if($tema){
			foreach ($tema as $t) {
				$votos  = $t["total"];			
			}
		}else{
				$votos = 0;
		}

		return $votos;
		
	}

	function get_similitud($miID,$suID){
		$db = MysqliDb::getInstance();
		$votos = $db->rawQuery("select * from votosUsuario where usuID = $miID");
		$totalPos 		= 0;
		$totalIguales 	= 0;
		if($votos){
			foreach ($votos as $v) {
						
				$miVotoTipo  = $v["votoTipo"];
		
				$suVotoTipo = get_votoTipo($v['posID'], $suID);
				if($suVotoTipo>0){
					$totalPos++;
					if($suVotoTipo==$miVotoTipo){
						$totalIguales++;
					}
				}
				
				//$votos  = $t["total"];			
			}
		}else{
				$porcentaje = 0;
		}
		if($totalPos>0){
			$porcentaje = (100*$totalIguales)/$totalPos;
		}else{
			$porcentaje = 0;
		}
		return round($porcentaje,1);
		
	}


	function get_items_tienda($tiendaID,$eveID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from items where eveID = '.$eveID.' and tiendaID = '.$tiendaID);
		$i = 0;
		if($tema){
			foreach ($tema as $t) {
				$i++;
			}
		}else{
			$i = 0;
		}

		return $i;
	}


	function get_fono_tienda($tiendaID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from tiendas where tieID = '.$tiendaID);
		if($tema){
			foreach ($tema as $t) {
				$tieFono = $t['tieFono'];
			}
		}else{
			$tieFonoi = '';
		}

		return $tieFono;
	}


	function get_mail_tienda($tiendaID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from tiendas where tieID = '.$tiendaID);
		if($tema){
			foreach ($tema as $t) {
				$tieFono = $t['tieMail'];
			}
		}else{
			$tieFonoi = '';
		}

		return $tieFono;
	}
	
	function get_formato($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from formatos where formID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["formDesc"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}


	function get_formato_tienda($tiendaID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from tiendas where tieID = '.$tiendaID);
		if($tema){
			foreach ($tema as $t) {
				$tieForm = $t['tieForm'];
			}
		}

		return $tieForm;
	}


	function formatoxcatalogo($camID,$catID,$formID){
		$ok = false;
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from catalogo_x_formato where camID = '.$camID.' and catID = '.$catID.' and formID = '.$formID);
		if($tema){
			foreach ($tema as $t) {
				$ok = true;
			}
		}

		return $ok;
	}


	function ISCxformatoxcatalogo($camID,$catID,$formID,$inCaID){
		$ok = false;
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from catalogo_x_formato_x_ISC where camID = '.$camID.' and catID = '.$catID.' and formID = '.$formID.' and iscID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$ok = true;
			}
		}

		return $ok;
	}


	function get_isc_camp($formID,$inCaID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_campanas where formID = '.$formID.' and inCaID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$inCaNom = $t['inCaNom'];
			}
		}

		return $inCaNom;
	}


	function get_isc_med($formID,$inCaID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_campanas where formID = '.$formID.' and inCaID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$inCaMed = $t['inCaMed'];
			}
		}

		return $inCaMed;
	}




	function get_pedido_temporal($tieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal where ptTie = '.$tieID.' and ptEst = 0');
		if($tema){
			foreach ($tema as $t) {
				$ptID = $t['ptID'];
			}
		}else{
			$ptID = '';
		}
		return $ptID;
	}
	
	
	

	function get_pedido_fecha_proceso($paisID,$ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal where paisID = '.$paisID.' and ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$ptID = $t['ptTS'];
			}
		}else{
			$ptID = '';
		}
		return $ptID;
	}




	function get_pedido_temporal_x_usuario($paisID,$tieID,$usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal where paisID = '.$paisID.' and ptTie = '.$tieID.' and ptVM = '.$usuID.' and ptEst = 0');
		if($tema){
			foreach ($tema as $t) {
				$ptID = $t['ptID'];
			}
		}else{
			$ptID = '';
		}
		return $ptID;
	}


	function get_total_items_pedido_temporal($paisID, $ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from pedido_temporal_detalle where paisID = '.$paisID.' and ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_tienda_pedido($paisID,$ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal where paisID = '.$paisID.' and ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$tieID = $t['ptTie'];
			}
		}

		return $tieID;
	}

	function get_proveedor_nombre($pieProv){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from proveedores where provID = '.$pieProv);
		if($tema){
			foreach ($tema as $t) {
				$tieForm = $t['provNom'];
			}
		}

		return $tieForm;
	}

	function get_proveedor_mails($pieProv){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from proveedores where provID = '.$pieProv);
		if($tema){
			foreach ($tema as $t) {
				$tieForm = $t['provMail'];
			}
		}

		return $tieForm;
	}

	function get_tipo_usuario_desc($utipID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuTipos where utipID = '.$utipID);
		if($tema){
			foreach ($tema as $t) {
				$utiDesc = $t['utiDesc'];
			}
		}
		return $utiDesc;
	}


	function get_campana_desc($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from campana where camID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["camDesc"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}


	function get_campana_desc_v2($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from campana_v2 where camID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["camDesc"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}


	function get_desc_campana_v2($camID,$ID){
		$db 	= MysqliDb::getInstance();
		$tema 	= $db->rawQuery('select * from catalogo_v2 where camID = '.$camID.' and catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$camDesc  = $t["camDesc"];
			}
		}else{
			$camFile = '';
		}

		return $camDesc;
		
	}

	
	function get_campana_catalogo($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from catalogo where catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["camID"];
			}
		}else{
			$eveNombre = 'Error';
		}

		return $eveNombre;
		
	}

	function get_total_fotos_campana($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from catalogo where camID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["total"];
			}
		}else{
			$eveNombre = 0;
		}

		return $eveNombre;
		
	}	function get_total_fotos_campana_v2($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from catalogo_v2 where camID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["total"];
			}
		}else{
			$eveNombre = 0;
		}

		return $eveNombre;
		
	}

	function get_foto_campana($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from catalogo where catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["camFile"];
			}
		}else{
			$eveNombre = 0;
		}

		return $eveNombre;
		
	}

	function get_foto_campana_v2($camID,$ID){
		$db 	= MysqliDb::getInstance();
		$tema 	= $db->rawQuery('select * from catalogo_v2 where camID = '.$camID.' and catID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$camFile  = $t["camFile"];
			}
		}else{
			$camFile = '';
		}

		return $camFile;
		
	}


	function get_total_piezas_formato($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from piezas where formID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_total_instores_formato($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores where formID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}


	function get_total_piezas_formato_x_responsable($ID,$usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from piezas where formID = '.$ID.'  and pieRes = '.$usuID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}
	


	function get_total_instores_formato_v2($ID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores_v2 where formID = '.$ID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	


	function get_total_piezas_instores_x_responsable($ID,$usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores where formID = '.$ID.'  and pieRes = '.$usuID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_responsable_pieza($pieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from piezas where pieID = '.$pieID);
		if($tema){
			foreach ($tema as $t) {
				$pieRes = $t['pieRes'];
			}
		}
		return $pieRes;
	}

	function get_cantidad_pieza($pieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from piezas where pieID = '.$pieID);
		if($tema){
			foreach ($tema as $t) {
				$pieRes = $t['pieCan'];
			}
		}
		return $pieRes;
	}

	function get_total_opciones_pieza($pieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from pieza_opciones where pieID = '.$pieID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_total_opciones_instores($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores_opciones where formID = '.$formID.' and insID ='.$insID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}

	function get_total_opciones_instores_v2($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from instores_opciones_v2 where formID = '.$formID.' and insID ='.$insID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}
	
/*
	function get_proveedor_pedido($ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal_detalle where ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$ptdProv = $t['ptdProv'];
			}
		}
		return $ptdProv;
	}
*/


	function get_VM_pedido($paisID, $ptID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from pedido_temporal_detalle where paisID = '.$paisID.' and ptID = '.$ptID);
		if($tema){
			foreach ($tema as $t) {
				$pieRes = $t['ptdVM'];
			}
		}
		return $pieRes;
	}

function resample($jpgFile, $thumbFile, $width, $orientation) {
    // Get new dimensions
    list($width_orig, $height_orig) = getimagesize($jpgFile);
    $height = (int) (($width / $width_orig) * $height_orig);
    // Resample
    $image_p = imagecreatetruecolor($width, $height);
    $image   = imagecreatefromjpeg($jpgFile);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
    // Fix Orientation
    switch($orientation) {
        case 3:
            $image_p = imagerotate($image_p, 180, 0);
            break;
        case 6:
            $image_p = imagerotate($image_p, -90, 0);
            break;
        case 8:
            $image_p = imagerotate($image_p, 90, 0);
            break;
    }
    // Output
    imagejpeg($image_p, $thumbFile, 90);
}


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

function get_desc_estado($est){
	if($est == 0){
		$estado = 'Solicitado';
	}elseif($est == 1){
		$estado = 'Para revisión';
	}elseif($est == 2){
		$estado = 'Rechazado';
	}elseif($est == 3){
		$estado = 'Aprobado';
	}elseif($est == 4){
		$estado = 'Cotizado';
	}elseif($est == 5){
		$estado = 'Cotizacion Aprobada';
	}elseif($est == 6){
		$estado = 'Ongoing';
	}elseif($est == 7){
		$estado = 'Entregado';
	}elseif($est == 8){
		$estado = 'Finalizado';
	}
	return $estado;
}

function get_desc_estado_br($est){
	if($est == 0){
		$estado = 'Requerido';
	}elseif($est == 1){
		$estado = 'Para revisão';
	}elseif($est == 2){
		$estado = 'Rejeitado';
	}elseif($est == 3){
		$estado = 'Aprovado';
	}elseif($est == 4){
		$estado = 'Cotado';
	}elseif($est == 5){
		$estado = 'Cotações Aprovada';
	}elseif($est == 6){
		$estado = 'Em Andamento';
	}elseif($est == 7){
		$estado = 'Entregado';
	}elseif($est == 8){
		$estado = 'Finalizado';
	}
	return $estado;
}

function get_class_estado($est){
	if($est == 0){
		$estado = 'solicitado';
	}elseif($est == 1){
		$estado = 'revision';
	}elseif($est == 2){
		$estado = 'objetado';
	}elseif($est == 3){
		$estado = 'aprobado';
	}elseif($est == 4){
		$estado = 'recibido';
	}elseif($est == 5){
		$estado = 'recibido';
	}elseif($est == 6){
		$estado = 'recibido';
	}elseif($est == 7){
		$estado = 'entregado';
	}elseif($est == 8){
		$estado = 'finalizado';
	}
	return $estado;
}

function get_tipo_formato($est){
	if($est == 1){
		$estado = 'Performance';
	}elseif($est == 2){
		$estado = 'Originals';
	}elseif($est == 3){
		$estado = 'Outlet';
	}elseif($est == 4){
		$estado = 'Kids';
	}
	return $estado;
}

function get_carpeta_ISC($formID){
	if($formID == 1){
		$folder = 'ISC/CORE/';
	}elseif($formID == 2){
		$folder = 'ISC/HC/';
	}elseif($formID == 3){
		$folder = 'ISC/OCS/';
	}elseif($formID == 4){
		$folder = 'ISC/FO/';
	}elseif($formID == 5){
		$folder = 'ISC/NBHD/';
	}elseif($formID == 6){
		$folder = 'ISC/KIDS/';
	}elseif($formID == 7){
		$folder = 'ISC/HCE/';
	}elseif($formID == 9){
		$folder = 'ISC/CORE/';
	}
	return $folder;
}

function get_carpeta_ISC_v2($formID){
	if($formID == 1){
		$folder = 'ISC2/CORE_SPC/';
	}elseif($formID == 2){
		$folder = 'ISC2/HC10/';
	}elseif($formID == 3){
		$folder = 'ISC2/ATELIER_STUDIO/';
	}elseif($formID == 4){
		$folder = 'ISC2/HC_FO/';
	}elseif($formID == 5){
		$folder = 'ISC2/NBHD/';
	}elseif($formID == 6){
		$folder = 'ISC2/CORE_YA/';
	}elseif($formID == 7){
		$folder = 'ISC2/HC31/';
	}elseif($formID == 10){
		$folder = 'ISC2/NBHD_FDD/';
	}elseif($formID == 11){
		$folder = 'ISC2/HC31_YA/';
	}elseif($formID == 12){
		$folder = 'ISC2/CORE_FO/';
	}
	return $folder;
}

	
function get_checklist_nom($clID){
	$db = MysqliDb::getInstance();
	$tema = $db->rawQuery('select * from checklist where clID = '.$clID);
	if($tema){
		foreach ($tema as $t) {
			$eveNombre  = $t["clNom"];
		}
	}else{
		$eveNombre = 'Error';
	}

	return $eveNombre;
}

function get_checklist_formato($clID){
	$db = MysqliDb::getInstance();
	$tema = $db->rawQuery('select * from checklist where clID = '.$clID);
	if($tema){
		foreach ($tema as $t) {
			$eveNombre  = $t["clFor"];
		}
	}else{
		$eveNombre = 'Error';
	}

	return $eveNombre;
}

	
function get_zona($clID){
	$db = MysqliDb::getInstance();
	$tema = $db->rawQuery('select * from checklist_zona where clzID = '.$clID);
	if($tema){
		foreach ($tema as $t) {
			$eveNombre  = $t["clzNom"];
		}
	}else{
		$eveNombre = 'Error';
	}

	return $eveNombre;
	
}

	function get_total_checklists_pendientes($tieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from checklist_x_tienda where clxtTie = '.$tieID.' and clxtEst = 0');
		if($tema){
			foreach ($tema as $t) {
				$total = $t['total'];
			}
		}else{
			$total = 0;
		}
		return $total;
	}

	function get_total_checklists_pendientes_x_usuario($tieID,$usuID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from checklist_x_tienda where clxtTie = '.$tieID.' and clxtMM = '.$usuID.' and clxtEst = 0');
		if($tema){
			foreach ($tema as $t) {
				$total = $t['total'];
			}
		}else{
			$total = 0;
		}
		return $total;
	}

	
	function ask_pais_campana($camID,$paisID){
		$ok = 0;
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from campana_x_pais where camID = '.$camID.' and paisID = '.$paisID);
		if($tema){
			foreach ($tema as $t) {
				$ok = 1;
			}
		}

		return $ok;
		
	}	

	
	function ask_pais_campana_v2($camID,$paisID){
		$ok = 0;
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from campana_x_pais_v2 where camID = '.$camID.' and paisID = '.$paisID);
		if($tema){
			foreach ($tema as $t) {
				$ok = 1;
			}
		}

		return $ok;
		
	}
	function get_pais_nom($clID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from paises where paisID = '.$clID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["paisNom"];
			}
		}else{
			$eveNombre = 'Error';
		}
	
		return $eveNombre;
		
	}
	function get_currency($clID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from rate_exchange where rexPais = '.$clID);
		if($tema){
			foreach ($tema as $t) {
				$eveNombre  = $t["rexCurr"];
			}
		}else{
			$eveNombre = 'Error';
		}
	
		return $eveNombre;
		
	}
	function ask_usuario_formato($usuID,$formID){
		$ok = 0;
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario_x_formato where usuID = '.$usuID.' and formID = '.$formID);
		if($tema){
			foreach ($tema as $t) {
				$ok = 1;
			}
		}

		return $ok;
		
	}
	
	function get_instore_nom_gen($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				$nombre  = $t["insNomGen"];
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}
	
	function get_instore_nom_gen_v2($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_v2 where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				$nombre  = $t["insNomGen"];
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}
	
	
	function get_instore_nom_ges($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				$nombre  = $t["insNomGes"];
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}
	
	function get_instore_nom_ges_v2($formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_v2 where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				$nombre  = $t["insNomGes"];
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}
	
	function get_instore_nom_x_pais($paisID, $formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				if($paisID==1){
					$nombre  = $t["insNomChi"];
				}elseif($paisID==2){
					$nombre  = $t["insNomCol"];
				}elseif($paisID==3){
					$nombre  = $t["insNomArg"];
				}elseif($paisID==4){
					$nombre  = $t["insNomMex"];
				}elseif($paisID==5){
					$nombre  = $t["insNomPer"];
				}elseif($paisID==6){
					$nombre  = $t["insNomPan"];
				}elseif($paisID==7){
					$nombre  = $t["insNomBra"];
				}
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}
	
	function get_instore_nom_x_pais_v2($paisID, $formID, $insID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_v2 where formID = '.$formID.' and insID = '.$insID);
		if($tema){
			foreach ($tema as $t) {
				if($paisID==1){
					$nombre  = $t["insNomChi"];
				}elseif($paisID==2){
					$nombre  = $t["insNomCol"];
				}elseif($paisID==3){
					$nombre  = $t["insNomArg"];
				}elseif($paisID==4){
					$nombre  = $t["insNomMex"];
				}elseif($paisID==5){
					$nombre  = $t["insNomPer"];
				}elseif($paisID==6){
					$nombre  = $t["insNomPan"];
				}elseif($paisID==7){
					$nombre  = $t["insNomBra"];
				}
			}
		}else{
			$nombre = 'Error';
		}
	
		return $nombre;
	}

	function get_instore_opc_desc($formID, $insID, $opcID){
		$db 	= MysqliDb::getInstance();
		$tema 	= $db->rawQuery('select * from instores_opciones where formID = '.$formID.' and insID = '.$insID.' and insOpID = '.$opcID);
		if($tema){
			foreach ($tema as $t) {
				$insOpNom  = $t["insOpNom"];
			}
		}else{
			$insOpNom = 'Error';
		}

		return $insOpNom;
	}

	function get_instore_opc_desc_v2($formID, $insID, $opcID){
		$db 	= MysqliDb::getInstance();
		$tema 	= $db->rawQuery('select * from instores_opciones_v2 where formID = '.$formID.' and insID = '.$insID.' and insOpID = '.$opcID);
		if($tema){
			foreach ($tema as $t) {
				$insOpNom  = $t["insOpNom"];
			}
		}else{
			$insOpNom = 'Error';
		}

		return $insOpNom;
	}

	
	function get_formato_pieza($formID,$ptdGra){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores where formID = '.$formID.' and insID = '.$ptdGra);
		if($tema){
			foreach ($tema as $t) {
				$insFormID = $t['insFormID'];
			}
		}

		return $insFormID;
	}

	
	function get_formato_pieza_v2($formID,$ptdGra){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from instores_v2 where formID = '.$formID.' and insID = '.$ptdGra);
		if($tema){
			foreach ($tema as $t) {
				$insFormID = $t['insFormID'];
			}
		}

		return $insFormID;
	}
	
	function get_responsable_formato($paisID,$formID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from usuario_x_formato where paisID = '.$paisID.' and formID = '.$formID);
		if($tema){
			foreach ($tema as $t) {
				$usuID = $t['usuID'];
			}
		}

		return $usuID;
	}
	
	
	
	function get_responsable_tienda($paisID,$tieID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from tiendas where paisID = '.$paisID.' and tieID = '.$tieID);
		if($tema){
			foreach ($tema as $t) {
				$tieFono = $t['tieFono'];
			}
		}

		return $tieFono;
	}
	
	function get_tienda_x_formato_x_pais($formID, $paisID){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select count(*) as total from tiendas where tieForm = '.$formID.' and paisID = '.$paisID);
		if($tema){
			foreach ($tema as $t) {
				$total  = $t["total"];
			}
		}else{
			$total = 0;
		}

		return $total;
		
	}	
	
	function quitatodo($string){
    	$colA = str_replace(' ', '', $string);
    	$colA = str_replace('_', '', $colA);
    	$colA = str_replace('-', '', $colA);
    	$colA = str_replace('/', '', $colA);
    	$colA = str_replace(')', '', $colA);
    	$colA = str_replace('(', '', $colA);
    	$colA = str_replace('&ntilde;', 'n', $colA);
    	$colA = str_replace('&ouml;', 'o', $colA);
    	$colA = str_replace('ö', 'o', $colA);
    	$colA = str_replace('ñ', 'n', $colA);
    	$colA = str_replace('%', 'porc', $colA);
    	$colA = str_replace('&', 'porc', $colA);
    	$colA = str_replace('generico', '', $colA);
    	$colA = strtolower($colA);
    	return $colA;
	}

function quitatodo2($string){
    	$colA = str_replace(' ', '_', $string);
    	$colA = str_replace('/', '', $colA);
    	$colA = str_replace(')', '', $colA);
    	$colA = str_replace('(', '', $colA);
    	$colA = str_replace('&ntilde;', 'n', $colA);
    	$colA = str_replace('&ouml;', 'o', $colA);
    	$colA = str_replace('ö', 'o', $colA);
    	$colA = str_replace('ñ', 'n', $colA);
    	$colA = str_replace('%', 'porc', $colA);
    	$colA = str_replace('&', 'porc', $colA);
    	$colA = str_replace('generico', '', $colA);
    	$colA = strtolower($colA);
    	return $colA;
	}
	

	function get_rate_exchange($paisID,$ano){
		$db = MysqliDb::getInstance();
		$tema = $db->rawQuery('select * from rate_exchange where rexPais = '.$paisID.' and rexAno = '.$ano.' order by rexID DESC limit 1');
		if($tema){
			foreach ($tema as $t) {
				$rexVal = $t['rexVal'];
			}
		}

		return $rexVal;
	}
	
	function check_ISC_campana($camID, $catID){
		$db = MysqliDb::getInstance();
		$ok = 0;
		$tema = $db->rawQuery('select * from catalogo_x_formato where camID = '.$camID.' and catID = '.$catID.' limit 1');
		if($tema){
			foreach ($tema as $t) {
				$ok = 1;
			}
		}

		return $ok;
	}
	
	function get_ISC_camp_nom($formID,$inCaID){
		$db = MysqliDb::getInstance();
		$ok = 0;
		$tema = $db->rawQuery('select * from instores_campanas where formID = '.$formID.' and inCaID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$inCaNom = $t['inCaNom'];
			}
		}

		return $inCaNom;
	}
	
	function get_ISC_camp_nom_med($formID,$inCaID){
		$db = MysqliDb::getInstance();
		$ok = 0;
		$tema = $db->rawQuery('select * from instores_campanas where formID = '.$formID.' and inCaID = '.$inCaID);
		if($tema){
			foreach ($tema as $t) {
				$desc = $t['inCaNom'].' ('.$t['inCaMed'].')';
			}
		}

		return $desc;
	}
	
	

	function comprueba_archivos_x_pieza_formato($formID,$pieID){
		$db 	= MysqliDb::getInstance();
		$ok 	= 1;
		$ruta 	= get_carpeta_ISC_v2($formID);
		$sql  	= "select * from instores_opciones_v2 where formID = $formID and insID = $pieID";

	  	$resultado = $db->rawQuery($sql);
		if($resultado){
			foreach ($resultado as $r) {
				if($r['insOpCat']==0){
					if($r['insOpFoto']){ 
						$archivo = '/ajax/uploads/ISC2/'.$r['insOpFoto'];
					}else{
						$archivo = '/'.$ruta.quitatodo($insNomGen).quitatodo($r["insOpNom"]).'.jpg';
					}				
					
					if (file_exists($archivo)) {
					
					}else{
					    $ok = 0;
					}	
				}else{
					$ok = 0;
				}				
			}
		}

		return $ok;
	}

	
?>