<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../../system/conexion.php');
define('SWORDON', 1);
include('../../system/funciones.php');
include('../../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
		$data['error']=0;
		$query = 'SELECT *
			FROM lostark_inmundo 
			WHERE idWorld = 1';
		$inmundosq = $db->sql_query($query);
		while($inmundo = $db->sql_fetchrow($inmundosq))
		{
			$data["mobs"][] = $inmundo;
		}
}
else
{
	$data['error']=1;
}		
 echo json_encode($data);
?> 