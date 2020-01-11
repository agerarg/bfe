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
		$tipo = textIntoSql($_GET['tipo']);
		$query = 'SELECT tp.*, p.nombre, p.idClase, p.sexo
		FROM topplayer tp JOIN personaje p USING ( idPersonaje )
		WHERE tipo="'.$tipo.'" ORDER BY topn';
		$topsq = $db->sql_query($query);
		while($top = $db->sql_fetchrow($topsq))
		{
			$top['valor'] = optimalDmg($top['valor']);
			$data[]=$top;
		}
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 