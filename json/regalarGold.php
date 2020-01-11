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
		$oroRegalar = intval($_GET['cant']);	
		$target = textIntoSql($_GET['tal']);	
		$query = 'SELECT idPersonaje,idCuenta, nombre
			FROM personaje
			WHERE nombre = "'.$target.'"';
		$targetsq = $db->sql_query($query);
		$targetRow = $db->sql_fetchrow($targetsq);
		if($targetRow)
		{
			if($oroRegalar<0)
			{
				$data['error'] = "Incorrect gold amount";
			}
			else
			{
				if($targetRow['idCuenta']!=$log->get("idCuenta"))
				{
					$realGold = $log->realGold();
					if($realGold>=$oroRegalar)
					{
						$query = 'SELECT p.idCuenta, p.nombre, p.idPersonaje, p.nivel, p.idPersonaje, p.idClase, p.nivel, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
						FROM personaje p JOIN clase c USING ( idClase )
								WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
						$pj = $db->sql_fetchrow($db->sql_query($query));
						$db->sql_query("UPDATE cuenta SET oro = (oro-".$oroRegalar.") WHERE idCuenta = ".$log->get("idCuenta"));
						$db->sql_query("UPDATE cuenta SET oro = (oro+".$oroRegalar.") WHERE idCuenta = ".$targetRow['idCuenta']);
						
						$msg = "Recibiste ".$oroRegalar." de oro de ".$pj['nombre'];
						systemLog("other",$msg,$targetRow['idPersonaje']);
						$msg = "Has enviado ".$oroRegalar." de oro a ".$targetRow['nombre'];
						systemLog("self",$msg);
					}
					else
						$data['error'] = "No tienes suficiente oro";
				}
				else
					$data['error'] = "No te podes mandar oro vos mismo wachin";
			}
		}
		else
			$data['error'] = "El perosnaje (".$target.") no existe";
}
else
{
	$data['error'] = "Error: user not logged";
}
 echo json_encode($data);
?> 