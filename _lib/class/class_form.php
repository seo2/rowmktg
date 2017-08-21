<?php 
#Created by Michel Gomes Ank 
#E-mail: michel@lafanet.com.br 
#MSN: mitheus@bol.com.br 
#ICQ: 530377777 

############################################# OPENNING CLASS FORM ############################################# 

class form { 
var $tdMensaje = 0;
var $tdCampo   = 0;

    function form($tdMensaje='',$tdCampo='')
	{
		$this->_settdMensaje($tdMensaje);
		$this->_settdCampo($tdCampo);    
	}

    function _settdMensaje($tdMensaje) { 
	  if ($tdMensaje)
	  {
          $this->tdMensaje = "width = $tdMensaje";
	  }
	  else
	  {
          $this->tdMensaje = '';
	  }
	}

    function _settdCampo($tdCampo) { 
	  if ($tdCampo)
	  {
         $this->tdCampo = "width = $tdCampo";
	  }
	  else
	  {
         $this->tdCampo = "";
	  }
	}

    #Function: <form...> 
    function form_start($name,$action,$method,$add='') { 
		if(isset($form)){
		$form .= "<div><form name=\"".$name."\" action=\"".$action."\" method=\"".$method."\" ".$add.">\n"; 
		}else{
        $form= "<form name=\"".$name."\" action=\"".$action."\" method=\"".$method."\" ".$add.">\n"; 
		}
        return $form; 
    } 
	#Function: <input text> 
    function tabla_start($add='') { 
        return "<table $add style='text-align:left;'>\n"; 
    } 
   function tabla_end() { 
        return "</table>\n"; 
    } 
 
    #Function: <image> 
	function form_radio($name, $value=NULL, $ads=NULL, $chequed=NULL) { 
	$form_radio = "<INPUT TYPE='radio' NAME=$name value=$value  $chequed> $ads";
	return($form_radio);
	}
    function form_image($name, $name_btn=NULL, $ads=NULL) { 

    $form_image = "<tr><td $this->tdCampo  class=txt11-normal><table><tr>";
	if($ads=='back'){
	$form_image.= "<td><A HREF='";
	$form_image.= "javascript:history.back();'";
	$form_image.= "><img src=images/boton_volver_cuenta.gif border=0 alt=Volver title=Volver align=left></A></td>";
	}
	$form_image.= "<td><INPUT TYPE=image SRC=\"$name\" name='$name_btn' border=0 ALT=\"\" vspace=5></td></tr></table></td></tr>\n";
	return($form_image);
    } 

    #Function: <input text> 
    function form_text_linea($name_txt,$name,$length,$value='',$add='',$dps='', $tipoCampo='0') { 
	
	if ($name_txt!='')
	{
		$saldo1   = '<div><tr><td $this->tdMensaje  class=txt11-normal>';
		$saldo2   = '</td></tr>\n<tr><td $this->tdCampo >';
	}
	else
	{
		$saldo1   = '';
		$saldo2   = '';
	}

    return "$saldo1".$name_txt."<input type=\"text\" id=\"".$name."\"  name=\"".$name."\" size=\"".$length."\" value=\"".$value."\" ".$add." / >".$dps."$saldo2\n";
    } 

    #Function: <input text> 
    function form_text($name_txt,$name,$length,$value='',$add='',$dps='', $tipoCampo='0') { 
	if ($name_txt!='')
	{
		$saldo1   = "<div><tr><td $this->tdMensaje  class=txt11-normal>".$name_txt." </td> \n <td $this->tdCampo >";
		$saldo2   = "</td></tr></div>\n";
	}
	else
	{
		$saldo1   = '';
		$saldo2   = '';
	}
	
    return "$saldo1<input type=\"text\" id=\"".$name."\"  name=\"".$name."\" size=\"".$length."\" value=\"".$value."\" ".$add." onmouseover=\"className='fondo1'\" onmouseout=\"className='fondo2'\" / >".$dps."$saldo2\n";
    } 

    function form_button($name, $value, $add='',$dps='') { 

    return '<input type="button" id="'.$name.'" value="'.$value.'" name="'.$name.'" '.$add.'  '.$dps."\n";
    } 

    #Function: <input text compuesto> 
    function form_text_compuesto($name_txt,$name,$length,$value='',$add='',$dps='', $strSeparador='-', $name2,$length2,$value2='',$add2='',$dps2='', $txtclass=null) { 

    return "<tr><td $this->tdMensaje  class='txt11-normal'>".$name_txt." </td></tr><tr><td $this->tdCampo class=txt11-normal><input type=\"text\" id=\"".$name."\" name=\"".$name."\" maxlength=\"".$length."\"  size=\"".$length."\" value=\"".$value."\" ".$add." onmouseover=\"className='fondo1'\" onmouseout=\"className='fondo2'\">".$dps.$strSeparador."<input type=\"text\" id=\"".$name2."\" name=\"".$name2."\" maxlength=\"".$length2."\"  size=\"".$length2."\" value=\"".$value2."\" ".$add2." onmouseover=\"className='fondo1'\" onmouseout=\"className='fondo2'\"></td>".$dps2."</tr>\n"; 
    } 

	function form_text_compuesto2($name_txt,$name,$length,$value=null,$name_txt2,$name2,$length2,$value2=null, $ads, $ads2=NULL) 
	{ 

    $html_f="<tr><td class=txt-login>$name_txt</td><td>";
	$html_f.="<input TYPE='text' name=$name value='".$value."' size='$length' class='box-login' $ads2 onMouseover=\"ddrivetip('Ingrese su RUT<br>sin puntos y con guión', 130)\" onMouseout=\"hideddrivetip()\" onChange=\"conMayusculas(this)\">";
	$html_f.="</td><td>&nbsp;</td>";
	$html_f.="<td class=txt-login>$name_txt2</td><td></td><td><input type=password name=$name2 value='$value2' size='$length2' class='box-login' ></td><td>&nbsp;&nbsp;</td><td>$ads</td></tr>";
	return($html_f);
    } 


	#Function: <input password> 
    function form_password($name_txt,$name,$length,$value='',$add='',$dps='') { 
        return "<tr><td $this->tdMensaje  class=txt11-normal>".$name_txt." </td><td $this->tdCampo ><input type=\"password\" name=\"".$name."\" size=\"".$length."\" value=\"".$value."\" ".$add." / class=fieldset.textfield>".$dps."</td></tr>\n"; 
    } 

    #Function: <selects> 
    function form_select($name_txt,$name,$size,$opt_name,$opt_value,$selected='',$add=NULL, $add2='') { 
		if ($name_txt<>'')
		{
           $select = "<tr><td $this->tdMensaje  class=txt11-normal>".$name_txt." </td><td 
		$this->tdCampo >"; 
		}
		else
		{
           $select = ""; 
		}

        $select.= "<select id=\"".$name."\" name=\"".$name."\" $add class='campo-select' onmouseover=\"className='fondoselect1'\" onmouseout=\"className='fondoselect2'\">\n"; 
        $opt_name = explode(",",$opt_name); 
        $opt_value = explode(",",$opt_value); 
        $qts = count($opt_name); 
        for($i=0;$i<$qts;$i++) { 
            if($opt_value[$i] == $selected) { 
                $select .= "<option selected value=\"".$opt_value[$i]."\">".$opt_name[$i]."</option>\n"; 
            }else{ 
                $select .= "<option value=\"".$opt_value[$i]."\">".$opt_name[$i]."</option>\n"; 
            } 
        } 
        $select .= "</select>"; 
		if ($name_txt<>'')
		{
           $select .= $add2." </td></tr>\n"; 
		}

        return $select; 
    } 

	function form_select2($name_txt,$name,$size,$opt_name,$opt_value,$selected='',$add='', $add2=null) { 
        $select= "<select name=\"".$name."\" ".$add." size='".$size."' class='select-busqueda2'>\n"; 
        $opt_name = explode(",",$opt_name); 
        $opt_value = explode(",",$opt_value); 
        $qts = count($opt_name); 
		$select .= "<option value=\"-1\" selected>".$add2."</option>\n";
        for($i=0;$i<$qts;$i++) { 
			$opt_name2 = strtolower($opt_name[$i]);
            if($opt_value[$i] == $selected) { 

				$select .= "<option selected value=\"".$opt_name2."\">".$opt_name2."</option>\n"; 

            }else{ 
				if($name=='PUNTAJE'){
				$select .= "<option value=\"".$opt_value[$i]."\">".$opt_name2."</option>\n"; 
				}else{
                $select .= "<option value=\"".$opt_value[$i]."\">".StringFirsMayusc($opt_name2)."</option>\n"; 
				}
            } 
        } 
        $select .= "</select>\n"; 
        return $select; 
    } 
    #Function: <input checkbox...> 
    function form_checkbox($name_txt,$name,$checked='',$value='1',$add='',$add2='') { 
        if($checked) 
		{
		   $value   = 1;
		   $checked = "checked";
		}
		else
		{
		   $value   = 0;
		   $checked = "";
		}
		
	    if ($name_txt!='')
        {
     		$campo1   = "<tr><td $this->tdMensaje class='txt11-normal'>".$name_txt." </td><td $this->tdCampo  class='txt11-normal'>";
			$campo2   = "</td></tr>\n";
		}
		else
        {
			$campo1   = "";
			$campo2   = "";
		}

        $checkbox = $campo1."<input type=\"checkbox\" name=\"".$name."\" ".$add2." ".$checked." class=\"checkbox\" /> ".$add.$campo2; 
		return $checkbox; 
    } 
    #Function: <textarea...> 
    function form_textarea($name_txt,$name,$rows,$cols,$value='',$add='') { 

	if ($name_txt!='')
	{
		$saldo1   = "<tr><td valign=top class=txt11-normal>".$name_txt."</td><td>";
		$saldo2   = "</td></tr>";
	}
	else
	{
		$saldo1   = '';
		$saldo2   = '';
	}
//        return "<tr><td >".$name_txt.":<BR><textarea name=\"".$name."\" rows=\"".$rows."\" cols=\"".$cols."\">".$value."</textarea></span></td></tr>\n"; 
        return "$saldo1<textarea name=\"".$name."\" rows=\"".$rows."\" cols=\"".$cols."\"".$add." onmouseover=\"className='fondoselect1'\" onmouseout=\"className='fondoselect2'\">".$value." </textarea>$saldo2\n"; 
    }
	
    #Function: <textarea...> 
    function form_textareaEditor($name_txt,$name,$value='',$add='') { 
		$sBasePath  = $_SERVER['PHP_SELF'] ;
	    $sBasePath  = substr( $sBasePath, 0, strpos($sBasePath, "_admin" ) ) ;
	    $sBasePath .="/inc/clases/fckeditor/";//

		$oFCKeditor = new FCKeditor("$name") ;
		$oFCKeditor->BasePath = $sBasePath ;

		if ( isset($_GET['Toolbar']) )
		{
			$oFCKeditor->ToolbarSet = htmlspecialchars($_GET['Toolbar']);
		}
	
		$oFCKeditor->Value = $value;
		$html   = $oFCKeditor->CreateHtml();
		return "<tr><td valign=top>$name_txt</td><td $this->tdCampo>$html onmouseover=\"className='fondoselect1'\" onmouseout=\"className='fondoselect2'\"</tr><td>";
	}


    #Function: <input file> 
    function form_file($name_txt,$name,$add='',$dps='') { 
        return "<tr><td  class=txt11-normal>".$name_txt."</td><td $this->tdCampo><input type=\"file\" name=\"".$name."\" ".$add." /> ".$dps."</td></tr>\n"; 
    } 
    #Function: <input hidden...> 
    function form_hidden($name,$value='',$add='') { 
        return "<input type=\"hidden\" name=\"".$name."\" value=\"".$value."\" ".$add." />"; 
    } 
    #Function: Submit/Reset 
    function form_go($submit,$reset='',$add='', $sinSalto=0) { 
		if ($sinSalto==0)
		{
           $saida = "\n<tr><td  align=center colspan=2>"; 
		}
		else
		{
           $saida = ""; 
		}

        $saida .= "<input type=\"submit\" name=\"".$submit."\" value=\"".$submit."\" $add class=\"submit\" onmouseover=\"className='boton2'\" onmouseout=\"className='boton'\"/>"; 
        if($reset) { 
            $saida .= "&nbsp;&nbsp;&nbsp;<input type=\"reset\" name=\"reset\" value=\"".$reset."\" />"; 
        } 

		if ($sinSalto==0)
		{
           $saida .= "</td></tr>\n";
		}
		else
		{
           $saida .= ""; 
		}
        return $saida; 
    } 
    function mensajeDiv() { 
        return "<tr><td><div class=\"suggestionsBox\" id=\"suggestions\" style=\"display: none;\"><img src=\"images/upArrow.png\" style=\"position: relative; top: -12px; left: 30px;\" alt=\"upArrow\" /><div class=\"suggestionList\" id=\"autoSuggestionsList\">&nbsp;</div></div></td></tr>\"";
    } 
    #Closing the form 
    function form_end() { 
        return "</form></div>\n"; 
    } 
} 
############################################# CLOSING CLASS FORM ############################################# 

?> 