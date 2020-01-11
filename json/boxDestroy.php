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
		$id = intval($_GET['id']);
		$query = 'SELECT *
			FROM boxes_player
			WHERE idBox = "'.$id.'" AND idPersonaje = '.$log->get("pjSelected");
		$boxsq = $db->sql_query($query);
		$box = $db->sql_fetchrow($boxsq);
		if($box)
		{
			$db->sql_query("DELETE FROM boxes_player WHERE idBox = ".$box['idBox']."");
		}

}
else
{
	$data['error']=1;
}		
 echo json_encode($data);
?> 