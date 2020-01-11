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
	$id = intval($_GET['id']);
	$key = intval($_GET['key']);
	$db->sql_query("UPDATE skilllearn SET keybind='".$key."' WHERE idSkillLearn = '".$id."' AND idPersonaje = ".$log->get("pjSelected"));

}
echo json_encode($data);
?> 