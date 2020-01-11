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
	$db->sql_query("UPDATE inventario 
						SET usadoPor=0
						WHERE idCuenta = ".$log->get("idCuenta")." AND (idItem IN (637,638,639,640,641,642,643,644,644,645,646,647))");
}
echo json_encode($data);
?> 