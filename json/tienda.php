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
		$query = 'SELECT i.*, t.precio, t.idTienda
			FROM item i JOIN tienda t USING ( idItem )
			ORDER BY t.precio';
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