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
		$data="";
		$tierTrash = intval($_GET['t']);
		$sqlSrc="";
		switch($tierTrash)
		{
			case 1:
				$sqlSrc=' (inv.extraLevel = 2 OR inv.extraLevel = 3 OR inv.extraLevel = 4)';
			break;
			case 2:
				$sqlSrc=' (inv.extraLevel = 5 OR inv.extraLevel = 6)';
			break;
			case 3:
				$sqlSrc=' (inv.extraLevel = 7 OR inv.extraLevel = 8)';
			break;
		}
		$query = 'SELECT i.*,inv.*
			FROM item i 
			JOIN inventario inv USING ( idItem ) 
			WHERE '.$sqlSrc.' 
			AND i.tipo = "runa"
			AND inv.usadoPor = 0 
			AND inv.enVenta = 0
			AND inv.idCuenta = '.$log->get("idCuenta").' 
			ORDER BY inv.idInventario DESC';
		$itemsq = $db->sql_query($query);
		while($item = $db->sql_fetchrow($itemsq))
		{
			$data["litem"][] = $item;
		}
		$data["error"] = "";
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 