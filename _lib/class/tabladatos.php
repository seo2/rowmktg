<?php

/**
 **     Tabla de datos 
 **     Permite crear una tabla html
 **
*/

class      tablaDeDatos {
var    $headers;
var    $body;
var    $html;
var    $elements;
var    $id;
var    $cssTable  = "class=\"table1\" "; // estilo de la tabla
var    $txtTh  = "class=\"hcell\" "; // Texto que irá en c/celda TH
var    $txtTd1 = "class=\"cell1\" "; // Texto que irá en c/celda TD por medio
var    $txtTd2 = "class=\"cell2\" "; // Texto que irá en c/celda TD por medio
var    $action;
var    $camposImg;
var    $camposOpc;
var    $hidden;


	function tablaDeDatos($headers,$body,$action="", $hidden=null) {
	    $this->headers   = $headers; 
	    $this->body      = $body; 
	    $this->action    = $action; 
		$this->camposImg = array();
		$this->camposOpc = array();
		$this->hidden = $hidden;
	}

	function getHeaders() {
		if (!is_null($this->headers))
		{
            //******************** Hearder Campos
			foreach ($this->headers as $key => $valor)
			{
				$this->html .= "<th ".$this->txtTh.">".$valor."</th>\n";
			}

            //******************** Hearder Elementos
			if (count($this->elements)>0)
			{
				$this->html .= "<th ".$this->txtTh." COLSPAN=2> Opciones</th>\n";
			}
		}
		else
		{
            //******************** Sin Cabecera
			$this->html .= "<th>Sin Cabecera</th>\n";
		}
		
	

	}

	function addElements($elements) {
		$this->elements    = $elements;
	}

	function setId($id) {
		$this->id      = $id;
	}

	function getId() {
		return $this->id;
	}


	function getHidden(){
		return $this->hidden;
	}

	function getHtml() {
		$odd  = true;

       

		if (!is_null($this->body))
		{	 
            //******************** Grba el cuerpo

			foreach ($this->body as $key1 => $valor1)
			{
				$registro=array();
				$registro=$valor1;
	     		$this->html     .= "<tr>\n";

	            if ($odd) $class = $this->txtTd1;
		        else      $class = $this->txtTd2;
			    $odd = !$odd;

		        if (!is_null($this->getId()))
				{
	                $valorId     = $registro[$this->getId()];
				}
	            else
				{
	                $valorId     = "";
				}
 
                //********** Filtra Id
				If ($valorId != "")
				{
				// Despliega columnas de la tabla
	    		foreach ($registro as $key => $valor)
	    		{
					//************* Valores
					$valorTabla   =  $valor;
					// Verifica valores de los campos y los reeplaza por imagenes
					foreach ($this->camposImg as $llave => $valores)
					{
     					// Verifica el nombre de los campos
						if ($key == $llave)
						{
         					// Opciones e imagenes
							foreach ($valores as $opcion => $imagen)
							{
								if ($valor == $opcion)
								{
									$valorTabla = '<IMG SRC='."$imagen".'>'."\n";
								}
							}
						}
					}

					// Verifica valores de los campos y los reeplaza por palabras
					foreach ($this->camposOpc as $llave => $valores)
					{
     					// Verifica el nombre de los campos
						if ($key == $llave)
						{
         					// Opciones e imagenes
							foreach ($valores as $opcion => $descripcion)
							{
								if ($valor == $opcion)
								{
									$valorTabla = $descripcion."\n";
								}
							}
						}
					}
                	$this->html .= "<td $class><font size=1> \n";
			    	$this->html .= "<p align=center>$valorTabla</p>\n";
	    			$this->html .= "</font></td>\n";
	            }

				// Recorre arreglo con elementos
				if (!is_null($this->elements))
				{
		      		foreach ($this->elements as $key => $valor)
			   		{
     				   if (strtoupper(trim($valor)) == "SUBMIT")
					   {
			     		   $this->html .= "<td $class>";
						   $boton = strtolower($key);

						   if($boton=='eliminar' || strtoupper($boton)=='CHEQUEAR'){
//							   echo $boton;
                               $mensaje = '';
    						   if ($boton=='eliminar'){
								   $mensaje = '';
         						   $onclick = "onclick=\"javascript:return confirm('¿Esta seguro que desea eliminar este registro?')\"";
							   }
							   if (strtoupper($boton)=='CHEQUEAR'){
								   $mensaje = '';
         						   $onclick = "onclick=\"javascript:return confirm('¿Esta seguro que desea marcar este registro?')\"";
							   }

						    $this->html .= '<input type='.$valor.' name='.$key.'['.$valorId.']  class="boton" value='.$key." $onclick>\n";

						   }else{
			     		   $this->html .= '<input type='.$valor.' name='.$key.'['.$valorId.'] class="boton" value='.$key.">\n";
						   }
			     		   $this->html .= "</td>"."\n";
					   }
					   else
					   {
			     		   $this->html .= "<td $class>";
			     		   $this->html .= "<input type=\"$valor\" name=$key"."[$valorId]";
						   $this->html .= "</td>\n";
					   }
					}
				}
                }
	     		$this->html     .= "</tr>\n";
			}
		}
	}

	function draw() {
        $this->html .= '      <form action='.$this->action.' method=post>'."\n";

		$hiddenElements = $this->getHidden();
		if (!is_null($hiddenElements)){
			foreach ($hiddenElements as $key => $valor)
			{
				$this->html .= "<input name=".$key." value=".$valor." type=hidden>\n";
			}
		}
        $this->html .= 			"<div align=\"center\">\n";
    	$this->html .=           "<table border=0 ".$this->cssTable.">\n";

        // En caso de no haber registro a mostrar
		if (count($this->body)==0)
		{
			echo "<h3><FONT COLOR='#0033FF'>No existen registros</FONT><h3>\n";
		}
        else
        // En caso de haber registro a mostrar
		{
			$this->getHeaders();
	  		$this->getHtml();
			echo $this->html;
		}

		echo '       </table>'."\n";
		echo '       </div>'."\n";
		echo "    </form>\n";
	}
	
	function setImg($campo, $arreglo) {
		$this->camposImg[$campo] = $arreglo;
    }
	function setOpc($campo, $arreglo) {
		$this->camposOpc[$campo] = $arreglo;
    }
}

?>