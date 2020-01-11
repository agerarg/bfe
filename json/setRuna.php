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
		$id = intval($_GET['id']);
		unset($_SESSION['PJITEM']);
		$query = 'SELECT inv.idInventario, i.idItem
				FROM item i JOIN inventario inv USING ( idItem ) 
			WHERE inv.enVenta = 0 AND i.tipo = "runa" AND inv.idInventario = '.$id.' AND inv.idCuenta = '.$log->get("idCuenta").'';
		$ITEM = $db->sql_fetchrow($db->sql_query($query));
	if($ITEM)
	{
			if($_GET['ac']=="poner")
			{

				$query = 'SELECT i.idItem
			FROM item i JOIN inventario inv USING ( idItem ) 
			WHERE i.tipo = "runa" AND inv.usadoPor = '.$log->get("pjSelected").' AND inv.idCuenta = '.$log->get("idCuenta").' ORDER BY inv.idInventario DESC';
		
		$itemsq = $db->sql_query($query);
		$runasUsadas=null;
		while($used = $db->sql_fetchrow($itemsq))
		{
			$runasUsadas[$used['idItem']]=1;
		}
		if(!$runasUsadas[$ITEM['idItem']])
		{
			$query = 'SELECT  count(*) as CONTA
				FROM item i JOIN inventario inv USING ( idItem ) 
				WHERE i.tipo = "runa" AND inv.usadoPor = '.$log->get("pjSelected").' AND inv.idCuenta = '.$log->get("idCuenta").'';
			$querysq = $db->sql_query($query);
			$runas = $db->sql_fetchrow($querysq);
			$nroRunas = $runas['CONTA'];

			$query = 'SELECT nivel
					FROM personaje p 
				WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").' AND p.desactivada=0';
			$pj = $db->sql_fetchrow($db->sql_query($query));
			$maximoRunas=5;
			
				
			if($nroRunas<$maximoRunas)	
			{
				$db->sql_query("UPDATE inventario SET usadoPor = ".$log->get("pjSelected")." WHERE idInventario = ".$ITEM['idInventario']);
				$data['error'] = "wii";
			}
			else
			{
				$data['error'] = "max runas";
			}
			}
			else
			$data['error'] = "ya equipada";
		}
		else
		{
			//SACAR
			$db->sql_query("UPDATE inventario SET usadoPor = 0 WHERE idInventario = ".$ITEM['idInventario']);
			$data['error'] = "sacado";
		}
	}
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 