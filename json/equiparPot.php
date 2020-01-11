<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
		$id = (int)($_GET['id']);
		$slot = (int)($_GET['slot']);
		$query = 'SELECT inv.idInventario, i.idItem
		FROM inventario inv JOIN item i USING(idItem)
		WHERE i.tipo = "pot" AND
		 inv.idInventario = '.$id.' AND
		 idCuenta = '.$log->get("idCuenta");

		$itemsq = $db->sql_query($query);
		$item = $db->sql_fetchrow($itemsq);
		if($item)
		{
			$db->sql_query('UPDATE inventario SET
					usadoPor = 0
				WHERE (idItem='.$item['idItem'].') AND usadoPor = "'.$log->get("pjSelected").'"');
			
			$db->sql_query('UPDATE inventario SET
			usadoPor = 0
		WHERE potSlot='.$slot.' AND
		 (idItem IN (637,638,639,640,641,642,643,644,644,645,646,647)) AND 
		 usadoPor = "'.$log->get("pjSelected").'"');

		$db->sql_query('UPDATE inventario SET
				usadoPor = "'.$log->get("pjSelected").'",
				potSlot = "'.$slot.'"
			WHERE idInventario = "'.$item['idInventario'].'"');

			$db->sql_query("DELETE FROM inventario WHERE 
			idItem = ".$item['idItem']." AND
			usadoPor=0 AND 
			idCuenta = ".$log->get("idCuenta"));

		}
		else
		$data['error'] = "Error: no existe el item";
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 