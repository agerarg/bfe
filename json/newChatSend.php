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
$now = time();
if($log->check())
{
	$mensaje=textIntoSql($_POST['msg']);
	$img=textIntoSql($_POST['charimage']);
	$namer=textIntoSql($_POST['name']);
	$item=intval($_POST['item']);
	$party=0;
	$itemName=textIntoSql($_POST['itemName']);
	$odyn=textIntoSql($_POST['odin']);
	$col=intval($_POST['col']);
	$clan = 0;
	if(!($mensaje=="" OR $mensaje==" "))
	{

		$query = 'SELECT idPersonaje, SubClassFrom, party, clan
			FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));

		$idPersonajeBase =0;

		if($pj['SubClassFrom']>0)
			$idPersonajeBase = $pj['SubClassFrom'];
		else
			$idPersonajeBase = $pj['idPersonaje'];

		$mensaje=htmlentities($mensaje);


		switch($_POST['tipoChat'])
		{
			case 'party':
				if($pj['party']>0)
					$party=$pj['party'];
			break;
			case 'clan':
				if($pj['clan']>0)
					$clan=$pj['clan'];
			break;
		}

		$query = "INSERT INTO chatreal (idPersonaje,mensaje,tiempo,item,nombre,party,itemName,pimagen, odin, clan, col) 
					VALUES(
					'".$idPersonajeBase."',
					'".$mensaje."',
					'".$now."',
					'".$item."',
					'".$namer."',
					'".$party."',
					'".$itemName."',
					'".$img."',
					'".$odyn."',
					'".$clan."',
					'".$col."'
				)";	
		$db->sql_query($query);
		$db->sql_query("UPDATE personaje SET online='".$now."' WHERE idPersonaje = '".$log->get("pjSelected")."'");
	
	}
}
else
{
	die();
}
 echo json_encode($data);
?> 