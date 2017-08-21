<?php

class      baseDatos
{
var $db;
var $tabla;
var $tipoBase;
var $tabla2 = '';
var $tabla3 = '';
var $tabla4 = '';
var $tabla5 = '';
var $num_rows;
var $campos;
var $consulta;

	function     baseDatos(&$db, $tabla=NULL, $tipoBase="mysql") 
	{
        $this->db        = &$db;
        $this->tabla     = $tabla;
		$this->tipoBase  = $tipoBase;
		
	}

	function     setTablas($tabla2, $tabla3, $tabla4, $tabla5) 
	{
        $this->tabla2    = $tabla2;
        $this->tabla3    = $tabla3;
        $this->tabla4    = $tabla4;
        $this->tabla5    = $tabla5;
	}

    /**
	 **    Graba o modifica registro
	*/

	function     grabar($campoId='id', $campos=array()) 
	{
		//***** Campos
		$this->campos            = $campos;
		//***** id 
		if (isset($this->campos[$campoId]))
	    {
    		$id                  = $this->campos[$campoId];
		}
		else
	    {
    		$id                  = 0;
		}

		//***** Inicializa variable de consulta
        $consultaSql             = '';

        if ($id == 0)
	    //******* Insertar
		{
			//******* Campos
			$llaves   = implode(array_keys($this->campos),',');
			//******* Valores
			$valores = implode(array_values($this->campos),"','");
			//******* Sql
            $sql = 'INSERT INTO '.$this->tabla.'( '.$llaves.')'."VALUES ('".$valores."')";
			
			//echo "<br><font size=1 face=arial>$sql</font>";
		    //******* Ejecuta script
			//if($_SERVER["HTTP_HOST"]!='192.168.0.120'){
			//$sql = strtolower($sql);
			//}

            //******* mysql
			if (strtoupper($this->tipoBase) == 'MYSQL')
			{
    			$resultado = mysql_query($sql, $this->db);

				if(!($resultado)){
				//echo "<p><font color=red>Error en la consulta!!</font></p>";
				//echo $sql;
				} 
	    		$last_id = mysql_insert_id();
			}
            //******* MSSQL
			if (strtoupper($this->tipoBase) == 'MSSQL')
			{
    			$resultado = MSSQL_query($sql, $this->db);
			}
		}
		else
	    //******* Modificar
		{
			//******* Construye consulta sql
			foreach ($campos as $llaves=>$valores)
			{
				$consultaSql .= $llaves."='".$valores."',";
			}
			$consultaSql = substr($consultaSql,0,strlen($consultaSql)-1)." where $campoId=".$id;
			//******* Sql
            $sql = 'UPDATE '.$this->tabla.' set '.$consultaSql;
//			echo $sql; 	
            $last_id = 0;
             
		    //******* Ejecuta mysql
			if (strtoupper($this->tipoBase) == 'MYSQL')
			{
    			$resultado = mysql_query($sql, $this->db);
			}
		    //******* Ejecuta MSSQL
			if (strtoupper($this->tipoBase) == 'MSSQL')
			{
    			$resultado = MSSQL_query($sql, $this->db);
			}
		}
		$this->consulta = $sql;
		return($last_id);
	}

    /**
	 **    Eliminar registro
	*/


	function lastid($campoId='id') 
	{
		$sql = "SELECT ".$campoId." FROM ".$this->tabla." ORDER BY ".$campoId." DESC LIMIT 1";
		$resultado = mysql_query($sql, $this->db);
		
		 while ($row = mysql_fetch_array($resultado)){
            $valor = $row[$campoId];
         }

		


		return($valor);

	}

	function     eliminar($campoId='id', $id=0, $ads=NULL) 
	{

       $where = $campoId.'='."'".$id."'";
		if($ads!=NULL){
		$where.= $ads;
		}
        if (strlen($where) != 0 and $where!=' ')
	    //******* Eliminar
		{
			//******* Sql
            $sql = 'DELETE FROM '.$this->tabla." WHERE ".$where;

		    //******* Ejecuta script
		    //******* Ejecuta mysql
			if (strtoupper($this->tipoBase) == 'MYSQL')
			{
    			$resultado = mysql_query($sql, $this->db);
			}
			if (strtoupper($this->tipoBase) == 'MSSQL')
			{
    			$resultado = MSSQL_query($sql, $this->db);
			}
		}
	}

    /**
	 **    Lee registros
	*/
	function filas(){
	return($this->num_rows);
	}
	function     leeTabla($where='', $campos=array('*'), $add='') 
	{

		//******* Tablas asociadas

		$tablaFrom         = $this->tabla;

        //******* 1er Join
		if ($this->tabla2 !='' && $this->tabla2 !=' ')
		{
     		$tablaFrom    .= ', '.$this->tabla2;
        }
        //******* 2do Join
		if ($this->tabla3 !='' && $this->tabla3 !=' ')
		{
     		$tablaFrom    .= ', '.$this->tabla3;
        }
        //******* 3ro Join
		if ($this->tabla4 !=''  && $this->tabla4 !=' ')
		{
     		$tablaFrom    .= ', '.$this->tabla4;
        }
        //******* 4to Join
		if ($this->tabla5 !=''  && $this->tabla5 !=' ')
		{
     		$tablaFrom    .= ', '.$this->tabla5;
        }


		//******* Lee los campos a desplegar

		if (array_count_values($campos)==0 || $campos=='*')
		{
        	//******* Todos campos a desplegar
           $camposConsulta = '*';
		}
		else
		{
        	//******* Lee los campos a desplegar
           $camposConsulta = implode(array_values($campos),',');
		}


        if (strlen($where) == 0 || $where =='  ')
	    //******* Eliminar
		{
			//******* Sql
            $sql = 'select '.$camposConsulta.' from '.$tablaFrom.' '.$add;
		}
		else
		{
			//******* Sql
            $sql = 'select '.$camposConsulta.' from '.$tablaFrom." where ".$where.' '.$add;
		}

		$this->consulta = $sql;
		//echo $this->consulta."<br>";
		//******* Ejecuta script
		//******* Ejecuta mysql
		if (strtoupper($this->tipoBase) == 'MYSQL')
		{
    		$resultado = mysql_query($sql, $this->db);
			if($resultado){
    		$this->num_rows = mysql_num_rows($resultado);
			}else{
			$this->num_rows = array(0);
			}

    		if ($resultado)
    		{
        		while ($registro = mysql_fetch_assoc($resultado))
	        	{
                    $arreglo[] = $registro;
                }
            }else{
			}
			
        }
		//******* Ejecuta MSSQL
		if (strtoupper($this->tipoBase) == 'MSSQL')
		{
    		//14-03-2007
			//echo $sql.'<br><br>';
			$resultado = MSSQL_query($sql, $this->db);
    		$this->num_rows = MSSQL_num_rows($resultado);

    		if ($resultado)
    		{
        		while ($registro = MSSQL_fetch_assoc($resultado))
	        	{
                       $arreglo[] = $registro;
                }
            }
        }

		//******* Determina si el arreglo contiene o no llaves
		if (!isset($arreglo))
		{
			$arreglo = array();
			//******* Sql
       		foreach ($campos as $llave => $valores)
        	{
                $arreglo[0][$valores] = '';
            }

		}

		return($arreglo);
	}

    function exex_sp($sentencia){

	$resultado = MSSQL_query('exec '.$sentencia);
	//$this->result = $resultado;
    $this->num_rows = MSSQL_num_rows($resultado);
	if ($resultado){
        		while ($registro = MSSQL_fetch_assoc($resultado))
	        	{
                       $arreglo[] = $registro;
                }
            }
    
		//******* Determina si el arreglo contiene o no llaves
		if (!isset($arreglo))
		{
			$arreglo = array();
		}

		return($arreglo);
	}
	
	
	function listar($arreglo, $cabecera=NULL, $campos=NULL){
		$html = "<table border=0>";
		if(isset($cabecera)){
			$html.= "<tr>";
		 foreach($cabecera as $etiqueta){
		    $html.=  "<th class='txt11-normal'>".$etiqueta."</th>\n";
		 }
			 $html.= "</tr>";
		}
	 foreach($arreglo as $label=>$arr_records){
		  if($cnt_aux == $cnt_aux2){
		  $tdColor = "#0066FF";
		  }
		  else{
		  $tdColor = "#FFFFFF";
		  }
	if(!isset($cabecera)){
	   $html.=  "<tr>\n";
	  // y para cada uno, armamos el HTML.
	  foreach($arr_records as $file=>$valor){
		$html.=  "<th class='txt11-normal'>".$file."</font></th>\n";
	  }
	  $html.="</tr>";
	}

	   $html.=  "<tr bgcolor='$tdColor'>\n";
	  // y para cada uno, armamos el HTML.
	  foreach($arr_records as $file=>$valor){
		foreach($campos as $file2){
			if($file2 == $file){
				/*if($file=='fecha_ini' || $file=='fecha_fin'){
				$valor = "<font color=red>".$valor."</font>";
				}*/
		$html.=  "<td class='txt11-normal'>".$valor."</font></td>\n";
			}
		}
	  }
	  $html.="</tr>";
	 }

	 $html.="</table>";
	return($html);
	}

	function muestra_sentencia(){

	return($this->consulta);

	}
}
?>