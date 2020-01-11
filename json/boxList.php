<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
define('SWORDON', 1);
include('../system/funciones.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{

		$data['error']=0;
		$query = 'SELECT *
			FROM boxes_player
			WHERE idPersonaje = '.$log->get("pjSelected");
		$boxsq = $db->sql_query($query);
		while($box = $db->sql_fetchrow($boxsq))
		{
			$data['b'][]=$box;
		}
		
}
else
{
	$data['error']=1;
}		
 echo json_encode($data);
?> 