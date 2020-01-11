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
		$data['error']=false;

		$cantidad = (int)$_GET['cantidad'];
		if($cantidad<=0 || $cantidad>1000)
			$data['error']="cantidad incorrecta!";

		$query = 'SELECT clanRep
		FROM personaje p
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		if(isset($_GET['material']))
		{
			$precio=0;
			switch($_GET['id'])
			{
				case 1:
					$precioIn=1;
					$precio=($precioIn*$cantidad);
					$item = 655;
					$name = "Raid Key";
				break;
				default:
					$data['error']="id no definido!";
				break;
			}
	
		$pj['clanRep']-=$precio;
		if($pj['clanRep']<0)
			$data['error']="no tienes suficiente honor!";

		if(!$data['error'])
		{
			$data['currHonor']=$pj['clanRep'];
			$db->sql_query("UPDATE personaje 
			SET clanRep=(clanRep-".$precio.") 
			WHERE idPersonaje = '".$log->get("pjSelected")."'");
				systemLog("self","<div class=warzone_taked>Compraste ".$cantidad." ".$name."!</div>") ;
			add_item($item,$cantidad,$log->get("idCuenta"),1);
		}


			//////////////////////////////////////
		}
		else
		{
			/*
		$tier = (int)$_GET['tier'];
		$level = (int)$_GET['level'];
		
		
		$precio=1000;
		$data['error']=false;
		$dropGrade=1;
		switch($tier)
		{
			case 1:
				$precio = 2;
				$dropGrade=8;
			break;
			case 2:
				$precio = 5;
				$dropGrade=9;
			break;
			case 3:
				$precio = 10;
				$dropGrade=10;
			break;
		}
		$precio=($precio*$level);
		$pj['clanRep']-=$precio;
		if($precio<=0)
			$data['error']="error en precio!";
		if($pj['clanRep']<0)
			$data['error']="no tienes suficiente honor!";

		if(!$data['error'])
		{
			$data['currHonor']=$pj['clanRep'];
			earnDropBox($dropGrade,$level,$log->get("pjSelected"));
			systemLog("self","<div class=warzone_taked>Compraste un cofre nivel ".$dropGrade."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
			$db->sql_query("UPDATE personaje 
			SET clanRep=(clanRep-".$precio.") 
			WHERE idPersonaje = '".$log->get("pjSelected")."'");
		}*/
	}
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 