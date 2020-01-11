<?php
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
include('../system/funciones.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
$query = 'SELECT p.inDungeon, p.Vida, p.boludo, p.idCuenta, p.nombre, p.idPersonaje, p.nivel, p.idPersonaje, p.idClase, p.nivel, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
			FROM personaje p JOIN clase c USING ( idClase )
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").' AND p.rankedPlaing = 0';
		$pj = $db->sql_fetchrow($db->sql_query($query));
$data = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
echo json_encode($data);
?>
