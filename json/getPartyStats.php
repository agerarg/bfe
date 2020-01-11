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
	$query = 'SELECT nombre, idPersonaje, party,Vida
		FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		
		if($pj['party']>0)
		{
			$query = 'SELECT *
						FROM personaje
						WHERE party = '.$pj['party'].'';
			$partymemsq = $db->sql_query($query);
			while($partymem = $db->sql_fetchrow($partymemsq))
			{
				$data['targ'][] = array(
				"id"=>$partymem['idPersonaje'],
				"name"=>$partymem['nombre'],
				"vida" => $partymem['Vida']);
			}
		}
		else
		{
			$data['targ'][] = array(
				"id"=>$pj['idPersonaje'],
				"name"=>$pj['nombre'],
				"vida" => $pj['Vida']);
		}
}
else
{
	die();
}
 echo json_encode($data);
?> 