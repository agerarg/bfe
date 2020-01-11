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
	 $data['msg']="sep";
	$row= 	explode(",",$_GET['ord']);
	foreach( $row as $order)
	{
		$i++;
		if($i>20)
			break;
		 $db->sql_query("UPDATE skilllearn SET orden='".$i."' WHERE idPersonaje = ".$log->get("pjSelected")." AND idSkillLearn = '".intval($order)."' ");
	}

}
echo json_encode($data);
?> 