<?php
//$db = mysql_connect('localhost', 'root', 'ucinf'); 
$db = mysql_connect('internal-db.s92700.gridserver.com', 'db92700_seo2', 'd0l0r3s1'); 
mysql_select_db('db92700_liceteam',$db);

if (!$db) {
     die("<CENTER> <table border=1><td><CENTER> <FONT COLOR='#EF0000'> <H1>¡ ES IMPOSIBLE CONECTARSE A LA BASE DE DATOS (1)! </FONT COLOR> </H1></CENTER> <br> <CENTER> <FONT COLOR='#FFAA22'> <H2>¡ CONTACTESE CON EL ADMINISTRADOR DEL SISTEMA ! </FONT COLOR> </H1></CENTER></td></CENTER> ");
}

?>