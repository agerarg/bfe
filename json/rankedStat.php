<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
include('../system/funciones.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
		$query = 'SELECT ranked, party, deathTime, nivel
			FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		if($pj['ranked']==0 AND $_GET['go']==1)
		{		
			if($pj['nivel']<40)
			{
				$data['error'] = 1;
				$data['msg'] = "Tenes que ser nivel 40 para jugar ranked";
			}else
			if($pj['deathTime']>time())
			{
				$data['error'] = 1;
				$data['msg'] = "No podes buscar ranked estando muerto";
			}else
			{			
				$db->sql_query("UPDATE personaje SET ranked=1, rankedCalls = 1, rankedTimer=".(time()+60)." WHERE idCuenta = ".$log->get("idCuenta")." AND idPersonaje = '".$log->get("pjSelected")."'");
			}
		}
		else
		{
			$db->sql_query("UPDATE personaje SET ranked=0 WHERE  idCuenta = ".$log->get("idCuenta")." AND idPersonaje = '".$log->get("pjSelected")."'");
		}
}
else
{
	$data['mensaje'] = "Error: not logged";
}
 echo json_encode($data);
?> 