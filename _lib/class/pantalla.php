<?php

class   pantalla
{
var     $header;
var     $body;
var     $contenido;
var     $footer;
var     $html;
var     $naviTabs;
var		$categoria;

	function  pantalla($db, &$sesion)
	{
		$this->hearder = '';
		$this->body    = '';
		$this->naviTabs = array();
		$this->categoria = array();
		$this->setContenido = ("	<TD bgcolor=\"white\" width=\"90%\"><IMG SRC=\"img/linea.gif\" WIDTH=\"100%\" HEIGHT=\"3\" BORDER=\"0\" ALT=\"\"><IMG SRC=\"img/contenido.gif\" WIDTH=\"548\" HEIGHT=\"333\" BORDER=\"0\" ALT=\"\"></TD>\n");

		$this->footer  = '';

	
	}

	function  setHeader()
	{
		$this->header  = "<HTML>\r";

		

		$this->header .= "<HEAD>\r";
		$this->header .= "<TITLE>LiceTeam Admin</TITLE>\n";


	
		$this->header .= "</HEAD>\n";

	   
	    $this->header .= "<CENTER><TABLE width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=0>\n";
	    $this->header .= "<TR>\n";
	    $this->header .= "</TR>\n";
//		$this->header .= "<tr><td>".menu()."</td></tr>\n";
	}

	function  setBody()
	{
	   // $this->body   .= "<tr><TD align=\"left\"><IMG SRC=\"img/pixx.gif\" WIDTH=\"167\" HEIGHT=\"1\" BORDER=\"0\" ALT=\"\"><IMG SRC=\"img/borde1.gif\"  WIDTH=\"57\" HEIGHT=\"22\" BORDER=\"0\" ALT=\"\"></TD>\n";

	    $this->body   .= "<td  WIDTH=\"707\" HEIGHT=\"22\">\n";

		//************ Agrega Botones de navegación
		foreach ($this->naviTabs as $texto => $href)
		{
       	    $this->body   .= "<A class=navitab HREF=$href> $texto</A>\n";
		}
   	    $this->body   .= "</td>\n";


//	    $this->body   .= "</tr>\n";

	    $this->body   .= "</table>\n";

	    $this->body   .= "<TABLE align=center width=\"90%\" cellpadding=\"0\" cellspacing=\"0\" border=0>\n";
	    $this->body   .= "<TR>\n";
	    $this->body   .= "	   <TD VALIGN=TOP>";
	 
	    $this->body   .= "	   </TD>\n";

		//********************** Contenido
	    $this->body   .= "     <TD width=100% align=center>\n";
	    $this->body   .= "        <TABLE border=0 WIDTH=95% HEIGHT=50 border=0>\n";
	    $this->body   .= "        <TR>\n";
	    $this->body   .= "            <TD VALIGN = TOP>\n";
		//********************** Verifica si existen mensajes 
		if (isset($_GET['imagen']))
		{
			$imagen    = '<IMG SRC="img/'.$_GET['imagen'].'" WIDTH="15" HEIGHT="15" BORDER="0" ALT="">';
		}
		else
		{
			$imagen    = '';
		}

		if (isset($_GET['mensaje']))
		{
			$mensaje   = $_GET['mensaje'];
			$mensaje   = "<center><h1>$mensaje &nbsp $imagen</h1></center>";
    		$this->body   .= $mensaje;
		}


    }

	function  setContenido($contenido)
	{
		$this->contenido = $contenido;
	}

	function  getContenido()
	{
		return $this->contenido;
	}

	function  setFooter()
	{
	    $this->footer  = "          </TD>";
	    $this->footer .= "       </TR>";
	    $this->footer .= "       </TABLE>";

	    $this->footer .= "    </TD>";
	    $this->footer .= "</TR>";
	    $this->footer .= "</TABLE>";

	    $this->footer .= "<tr><td colspan=\"2\" align=\"center\"><HR noshade size=1 color=\"898989\">\n";
	    $this->footer .= "<FONT SIZE=\"1\">\n";
		//************ Agrega Botones de navegación
		foreach ($this->naviTabs as $texto => $href)
       {
             $this->footer .= "<A HREF=$href> $texto </A>\n";
       }	   
	}

	function  addNavitabs($texto, $href)
	{
		$this->naviTabs[$texto] = $href;
	}

	
	function  addCategorias($texto, $href)
	{
		$this->categoria[$texto] = $href;
	}

	function llenarCategorias($db){

		 //******** Verifica Categorías
	   	 $categorias = new baseDatos($db, 'categorias');
		 $arregloCategorias = $categorias->leeTabla('CATALOGO=1', array('ID', 'DESCRIP'));
		 $arregloCategorias = arregloCampo($arregloCategorias, 'DESCRIP', 'ID');
		 foreach($arregloCategorias as $indice=>$valor){
		 $this->addCategorias($valor, 'vercatalogo.php?categoria='.$indice.'&nomostrar=1');
		}
	}

	function  dibujar()
	{
		echo $this->header;
		echo $this->body;
	}

	function  dibujarFooter()
	{
		$this->setFooter();
		echo  $this->footer;
	    echo  "</HTML>\n";
	}
}
?>