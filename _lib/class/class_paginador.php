<?php
/**  Clase paginador
 * Archivo: paginador.php
 * Este archivo es para ser incluido dentro de ini.webcav.php
 * Sirve para paginar los resultados de una consulta sql
 *...
 * 
 * Uso t�pico:
 * <code>
 * // Carga la clase paginador y transmite el n�mero de registros de la consulta (el primer par�metro)
 * // y se indica cuantos registros se visulizar�n por p�gina (el segundo par�metro).
 *
 * $paginador($cantidadDeRegistros);
 * // obteninedo el offset
 * $offset  = $paginar -> offset();
 * // pintando el paginador
 * $paginar -> display();
 * // obteniendo el limite
 * $limite  = $paginar -> limite();
 *
 * $sql = "SELECT * FROM tabla ORDER BY campo LIMIT $limite OFFSET $offset";
 * ...
 *
 * $paginar -> display();
 *
 * </code>
 *
 * @package WEBCAV
 * @author Carolina Rojas <crojas@lacav.cl>
 *         Ian Ya�ez <ian@lacav.cl>
 * @date 20/10/2006
 */

class paginador {
    // Rutas del sistema webcav

    var $html_pag = "";
    var $nro_registros;
    var $total_registro;
    var $sqlORcount; 

    var $_activar_ini;
    var $_activar_fin;
    var $_nro_registros;
	var $arregloPost;

    /** 
     * Constructor y controla el puntero de la Paginaci�n, utilizando cinco botones estos son:
     * << = Inicio, >> = Fin, < = Anterior, > = Siguiente.
     * @param $sqlORcount  n�mero de registros
     */
    function paginador($sqlORcount,$arregloPost=array()) {

        //**** N�mero de registros a paginar
        $total_registro       =  $sqlORcount;
        $this->total_registro = $total_registro;
		$this->arregloPost    = $arregloPost;

		// Inicializa el indice de la p�gina si GET no se ha ejecutado
        if (isset($_GET['Offset']))
		{
            $offset           = $_GET['Offset'];
        }
		else
		{
            $offset           = 0;
        }
		if (isset($_GET['nro_registros']))
        {
            $nro_registros        = $_GET['nro_registros'];
        }
		else
        {
            $nro_registros        = 0;
        }

        $activar_ini          = '';
        $activar_fin          = '';

        //**** Controlador de p�gina
        if (!isset($_GET['indice_pagina'])) 
        {
     		$indice_pagina    = 0;
            $activar_ini      = 'DISABLED';
            $nro_registros    = 50; // Valor por defecto de registros por p�gina
        }
        else
        {
            // Indice de la p�gina toma su valor desde el GET si se ha ejecutado
            $indice_pagina    = $_GET['indice_pagina'];
        }

        // Determina la cantidad de registros que ha de desplegar en la �ltima p�gina
        if ((intval($total_registro/$nro_registros)!=($total_registro/$nro_registros)))
            /** Si la cantidad de registros de la consulta no es multiplo de la cantidad 
             * de registros de la p�gina.
             * La �ltima p�gina contendr� menos registros que las otras p�ginas (el saldo).
             */
        {
            $tope             = (intval($total_registro/$nro_registros))*$nro_registros;
        }
        else
        {
            /** Si la cantidad de registros de la consulta es multiplo de la cantidad 
             * de registros de la p�gina.
             * La �ltima p�gina contendr� $nro_registros registros y se visualizar� a partir
             * de la cantidad de registros total ($total_registro) - $nro_registros. 
             */
            $tope             = $total_registro-$nro_registros;
        }

        // Inicio de p�gina
        if ($offset          == '<<') 
        {
            $indice_pagina    = 0;
            $activar_ini      = 'DISABLED';
        } 
        // Retrocede p�gina
        if ($offset          == '<') 
        {
            $indice_pagina   -= $nro_registros;
        } 
        // Avanza una p�gina
        if ($offset          == '>') 
        {
            $indice_pagina   += $nro_registros;
        } 
        // Fin de p�gina
        if ($offset === '>>') 
        {
            $indice_pagina    = $tope;
            $activar_fin      = 'DISABLED';
        } 
        // Valida que el indice de paginaci�n no sea negativo.
        if ($indice_pagina<=0)
        {
            $indice_pagina    = 0;
            $activar_ini      = 'DISABLED';
        }
        // Valida que el indice de paginaci�n no sea mayor a la cantidad de registros de la consulta.

        if($indice_pagina>=$tope)
        {
            $indice_pagina    = $tope;
            $activar_fin      = 'DISABLED';
        }

        // Asigna valores a variables de instancia

        $this->indice_pagina  = $indice_pagina;
        $this->tamano_pagina  = $nro_registros;

        $this->_activar_ini   = $activar_ini;
        $this->_activar_fin   = $activar_fin;
        $this->_nro_registros = $nro_registros;
    }
    /** Retorna la cantidad original de registros por p�gina
     * (apararentemente redundante pero evita posibles errores 
     *  de insconsistencia). El valor que retorne se utilizara en la consulta sql. 
     */
    function limite()
    {
        return($this->tamano_pagina);
    }
    /**  function display()
     * Dibuja el formulario y retorna el valor OffSet que ser�
     * utilizado en la consulta sql.
     */
    function display($buscar_arr = null)
    {
        $this->_makeHtml($buscar_arr);
        if ($this->total_registro > 0)
            echo $this->html_pag;
    }
    /**  function offset()
     * Retorna el valor OffSet que ser�
     * utilizado en la consulta sql.
     */
    function offset()
    {
        return($this->indice_pagina);
    }

    //** Construye html
    function _makeHtml($buscar_arr = null) 
    {
        $numInicial = ($this->indice_pagina + 1);
        $numFinal = ($this->indice_pagina)+($this->_nro_registros);
        if ($this->total_registro < $numFinal)
            $numFinal = $this->total_registro;
        $html_pag  = "<DIV ALIGN='center' style='font-size:11px;'><FORM METHOD='GET'>\n";
		$html_pag .= "<INPUT TYPE='hidden' NAME='op' value=".$_GET['op'].">";
        $html_pag .= "$numInicial - $numFinal de ". $this->total_registro . "<BR>";
        $html_pag .= "<INPUT TYPE='submit' NAME='Offset' class='boton' VALUE='<<' " . $this->_activar_ini . ">\n";
        $html_pag .= "<INPUT TYPE='submit' NAME='Offset' class='boton' VALUE='<' " . $this->_activar_ini . ">\n";
        $html_pag .= "<INPUT TYPE='submit' NAME='Offset' class='boton' VALUE='>' " . $this->_activar_fin . ">\n";
        $html_pag .= "<INPUT TYPE='submit' NAME='Offset' class='boton' VALUE='>>' " . $this->_activar_fin . ">\n";

        If (isset($this->arregloPost))
        {
		    foreach ($this->arregloPost as $llavePost => $campoPost)
            {
			     $html_pag .= "<INPUT TYPE='hidden' NAME=$llavePost VALUE=$campoPost>\n";
            }
		}

        $html_pag .= "<SELECT NAME='nro_registros' onchange=javascript:submit() class=select-busqueda2>";

        if ($this->_nro_registros==1)
            $html_pag .= "  <OPTION VALUE='1' selected> 1 </OPTION>";
        else
            $html_pag .= "  <OPTION VALUE='1'> 1 </OPTION>";

        if ($this->_nro_registros==5)
            $html_pag .= "  <OPTION VALUE='5' selected> 5 </OPTION>";
        else
            $html_pag .= "  <OPTION VALUE='5'> 5 </OPTION>";

        if ($this->_nro_registros==10)
            $html_pag .= "  <OPTION VALUE='10' selected> 10 </OPTION>";
        else
            $html_pag .= "  <OPTION VALUE='10'> 10 </OPTION>";

        if ($this->_nro_registros==20)
            $html_pag .= "  <OPTION VALUE='20' selected> 20 </OPTION>";
        else
            $html_pag .= "  <OPTION VALUE='20'> 20 </OPTION>";

        if ($this->_nro_registros==50)
            $html_pag .= "  <OPTION VALUE='50' selected> 50 </OPTION>";
        else
            $html_pag .= "  <OPTION VALUE='50'> 50 </OPTION>";

        if ($this->_nro_registros==100)
            $html_pag .= "  <OPTION VALUE='100' selected> 100 </OPTION>";
        else
            $html_pag .= "  <OPTION VALUE='100'> 100 </OPTION>";

        $html_pag .= "</SELECT>&nbsp;";

        $html_pag .= "<INPUT TYPE='submit' NAME='mostrar' class='boton' VALUE='Ver' >\n";
        $html_pag .= "<INPUT TYPE='hidden' NAME='indice_pagina' VALUE='" . $this->indice_pagina . "' >\n";

        // vemos si esta definido el parametro...
        if (!is_null($buscar_arr)) {
            $html_pag .= "<INPUT TYPE='hidden' NAME='buscar_serialized' VALUE='". base64_encode(serialize($buscar_arr)) . "' >\n";

        }
        $html_pag .= "</FORM></DIV>\n";
        $this->html_pag = $html_pag;
    }
}

?>