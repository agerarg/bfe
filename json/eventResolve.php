<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
		$now = time();
		$query = 'SELECT Vida, Mana,maloTimer , maloId, IdMaloMundo FROM personaje 
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));

			if($pj['maloTimer']>$now)
			{
				$query = 'SELECT nombre FROM personaje 
					WHERE idPersonaje = '.$pj['maloId'].'';
				$malo = $db->sql_fetchrow($db->sql_query($query));
				$data['atacado'] = $malo['nombre'];
				$data['idMalo'] = $pj['maloId'];
				$data['idMundo'] = $pj['IdMaloMundo'];
			}
		
		$db->sql_query("UPDATE cuenta SET evento = 0 WHERE idCuenta = ".$log->get("idCuenta"));
		
		$data['error'] = 0;
		
}
else
{
	$data['error'] = 1;
}
 echo json_encode($data);
?> 