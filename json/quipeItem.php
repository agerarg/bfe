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
$now = tiempoReal();
function checkExist($tipo)
{
		global $log, $db;
			$query = 'SELECT count(*) as CONTA
			FROM inventario inv JOIN  item i USING ( idItem )
			WHERE inv.idCuenta = '.$log->get("idCuenta").'
			AND inv.usadoPor='.$log->get("pjSelected").' AND i.tipo="'.$tipo.'"';
			$itemsqshield = $db->sql_query($query);
			$res = $db->sql_fetchrow($itemsqshield);
			return($res['CONTA']);
}
if($log->check())
{
		$id = (int)$_GET['id'];
		$mano = (int)$_GET['mano'];
		$query = 'SELECT p.SubClassFrom, p.inDungeon, p.Vida, p.boludo, p.idCuenta, p.nombre, p.idPersonaje, p.nivel, p.idPersonaje, p.idClase, p.nivel, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
			FROM personaje p JOIN clase c USING ( idClase )
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").' AND p.rankedPlaing = 0';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		
		if($pj['inDungeon']==1)
		{
			$data['error'] = "Estas en dungeon, no puedes realizar ninguna acción aquí";
			echo json_encode($data);
			die();
		}

		unset($_SESSION['PJITEM']);
		unset($_SESSION['MADVSKILL']);
		
		$data="";

		$query = 'SELECT i.*,inv.extraLevel, inv.manoDerecha ,inv.manoIzquierda , inv.idInventario, inv.usadoPor, inv.enVenta, inv.trade, inv.cantidad, inv.intradeable, inv.enchant, inv.idNombre, inv.newSkill, inv.newSkillId, inv.trucho, inv.value,
			 inv.masterWork
			FROM inventario inv JOIN item i USING ( idItem )
			WHERE inv.idCuenta = '.$log->get("idCuenta").' AND inv.idInventario = '.$id.'';
		$itemsq = $db->sql_query($query);
		$item = $db->sql_fetchrow($itemsq);
		if($item['idInventario'])
		{
			$manoIzquierda=0;
			$manoDerecha=0;
		 	switch($_GET['action'])
			{
				case 'poner':
					include('equipo/poner.php');
				break;
				case 'sacar':
					include('equipo/sacar.php');	
				break;
				case 'regalar':
					include('equipo/regalar.php');	
				break;
				case 'venderReal':
					include('equipo/venderReal.php');	
				break;
				case 'borrar': // ROMPER
					include('equipo/borrar.php');	
				break;
				case 'vender':
					include('equipo/vender.php');		
				break;
				case 'cancelar':
					include('equipo/venderCancelar.php');
				break;
				case 'currency':
					include('equipo/currency.php');
				break;
			}
		}
		else
			$data["error"] = "El item no existe.";
}
else
{
	$data['error'] = "Error: user not logged";
}
 echo json_encode($data);
?> 