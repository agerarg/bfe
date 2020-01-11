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
		$query = 'SELECT idCuenta
			FROM cuenta
			WHERE idCuenta = '.$log->get("idCuenta").' AND evento = 1';
		$usuariosq = $db->sql_query($query);
		$usuario = $db->sql_fetchrow($usuariosq);
		if($usuario['idCuenta'])
			$data["error"] = 0;
		else
			$data["error"] = "";
}
else
{
	$data['error'] = 1;
}
 echo json_encode($data);
?> 