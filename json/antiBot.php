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
	$now = tiempoReal();
	$palabra=$_GET['palabra'];
	$data['ingresada']=textIntoSql($palabra);
	$data['registrada']=textIntoSql($_SESSION['captcha']);
	if(isset($_SESSION['captcha']))
	{
		if(strtolower($_SESSION['captcha'])==strtolower($palabra))
		{
			$query = 'SELECT exp,idPersonaje,nivel,antiBot FROM personaje p
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
			$pj = $db->sql_fetchrow($db->sql_query($query));
			if($pj AND $pj['antiBot']<=$now)
			{
				
				if($pj['nivel']<LVLLIMIT)
					$expBonus= 50 + intval(($pj['nivel']*$pj['nivel']) / 5); 
				else
					$expBonus=0;
				$data['exp'] = $pj['exp']+$expBonus;
				
				$msg = "<div class='checkPoint'>CheckPoint:<br>Ganaste +".$expBonus." de exp!</div>";
				
				systemLog("self",$msg);	
				
				$db->sql_query("UPDATE personaje SET antiBot=".($now+3600)." WHERE idCuenta = '".$log->get("idCuenta")."'");
				$db->sql_query("UPDATE personaje SET exp=(exp+".$expBonus.") WHERE idPersonaje = '".$log->get("pjSelected")."'");
				
				$data['ok']=1;
			}
			else
				die("puto el que lee!");
		}
		else
		{
			unset($_SESSION['captcha']);
			$data['ok'] = 0;
		}
	}
	else
		$data['ok'] = 0;
}
else
{
	$data['ok'] = 2;
}
 echo json_encode($data);
?> 