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
	     $query = 'SELECT p.nombre
			FROM personaje p 
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
				$data="";
				$query = 'SELECT *
				FROM trade
				WHERE usr1 = '.$log->get("idCuenta").' OR usr2 = '.$log->get("idCuenta").' ';
				$tradesq = $db->sql_query($query);
				$trade = $db->sql_fetchrow($tradesq);
				if(!$trade)
				{
					$nombre = textIntoSql($_GET['usr']);
					$query = 'SELECT idCuenta, nombre, idPersonaje
					FROM personaje
					WHERE nombre like "'.$nombre.'"';
					$usrsq = $db->sql_query($query);
					$usr = $db->sql_fetchrow($usrsq);
					if($usr)
					{
						if($usr['idCuenta']!=$log->get("idCuenta"))
						{
						$query = 'SELECT *
						FROM trade
						WHERE usr1 = '.$usr['idCuenta'].' OR usr2 = '.$usr['idCuenta'].' ';
						$tradesq = $db->sql_query($query);
						$trade = $db->sql_fetchrow($tradesq);
						if(!$trade)
						{
							$db->sql_query('INSERT INTO  trade(usr1,usr2) 
														VALUES("'.$log->get("idCuenta").'","'.$usr['idCuenta'].'")');
							$msg="<div class=tradeMsg>".$pj['nombre']." quiere tradear con vos <a href='index.php?sec=trade'>Ir a Trade</a></div>"	;						
							systemLog("other",$msg,$usr['idPersonaje']);
							$data['error'] = 0;
							$data['nombre'] = $nombre;
						}
						else
						{
							$data['error'] = "Error: ".$nombre." ya esta tradeando con alguien!";
						}
						}
						else
						$data['error'] = "Error: No puedes tradear con vos mismo!";
					}
					else
					{
						$data['error'] = "Error: el nombre ".$nombre." no existe!";
					}
				}
				else
				{
					$data['error'] = "Error: ya estas en trade!";
				}
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 