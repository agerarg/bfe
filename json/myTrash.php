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
			case 3:
				$sqlSrc=' (i.grado = 3 OR i.grado = 4 )';
			break;
			case 4:
				$sqlSrc=' inv.value >=3 AND (i.grado = 5 OR i.grado = 6)';
			break;
			case 5:
				$sqlSrc=' inv.value >=3 AND i.grado = 7';
			break;
			case 6:
				$sqlSrc=' inv.value >=4 AND i.grado = 8';
			break;
			default:
				$sqlSrc=' i.grado = '.$tierTrash.' ';
			break;
		}
		$query = 'SELECT i.*,inv.*
			FROM item i 
			JOIN inventario inv USING ( idItem ) 
			WHERE '.$sqlSrc.' 
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