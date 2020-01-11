<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
header('content-type: text/html; charset=utf-8');
date_default_timezone_set("America/Argentina/Buenos_Aires");
include('system/conexion.php');
include('system/funciones.php');
include('system/login.php');


/*include('system/template_engine.php');
$template = new Template;
$template->set_filenames(array(
	'body' => 'templates/bienvenida.html' )
);
$template->pparse('body');
*/

//$dbLogin = new sql_db_cuenta;
function textIntoSql2($text)
{
	$text = htmlspecialchars($text);
	$text = mysql_real_escape_string($text);
	return $text;
}
//*TEST

$db = new sql_db;
$log = new LOGuser;
$log->logear(2);
die();

//
/*
$db = new sql_db;
session_start();
$log = new LOGuser;
$k=textIntoSql2($_GET['k']);

	
	$pag = file_get_contents('https://www.battleforembolia.com/getAccess.php?k='.$k);

	 $srchuser = intval($pag);

	if($srchuser>0)
		{
			 $query = "SELECT * FROM cuenta WHERE mainId = '".$srchuser."'";
			 $subuser = $db->sql_fetchrow($db->sql_query($query));
			 if(!$subuser)
			 {
			 	$db->sql_query('INSERT INTO  cuenta(nombre,mainId) VALUES("","'.$srchuser.'")');

			 }
			 $log->logear($srchuser);

			 header("Location: http://45.32.168.197");
		}
		else
		{
			die("Error Loco!");
		}
	*/
?> 