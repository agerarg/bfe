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

		$query = 'SELECT i.*,inv.*
			FROM item i JOIN inventario inv USING ( idItem ) 
			WHERE i.tipo = "runa" AND inv.cantidad > 0 AND inv.idCuenta = '.$log->get("idCuenta").' ORDER BY inv.idInventario DESC';
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