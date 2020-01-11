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
$data['bans']="";
if($log->check())
{		

	$id = (int)$_GET['id'];

	$query = 'SELECT clan, party, SubClassFrom, idPersonaje
			FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
	$pj = $db->sql_fetchrow($db->sql_query($query));
	if($pj['SubClassFrom']>0)
			$idPersonajeBase = $pj['SubClassFrom'];
		else
			$idPersonajeBase = $pj['idPersonaje'];

	$query = "INSERT INTO chatsilence (idPlayer,idTarget) 
					VALUES('".$idPersonajeBase."','".$id."')";	
	$db->sql_query($query);
	$query = 'SELECT * FROM chatsilence WHERE idPlayer = '.$idPersonajeBase;
		$silencesq = $db->sql_query($query);
		$chatBnList=",";
		while($silence = $db->sql_fetchrow($silencesq))
		{
			$chatBnList.=$silence['idTarget'].",";
		}		
		$data['bans']=	$chatBnList;
}
 echo json_encode($data);
?> 