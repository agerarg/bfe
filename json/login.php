<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
include('../system/funciones.php');
include("../simple-php-captcha.php");
session_start();
$db = new sql_db;
$log = new LOGuser;
$log_code = textIntoSql($_GET['code']);
$data['ok']=0;


	$log_user = textIntoSql($_GET['mail']);

	$query = 'SELECT intentos FROM cuenta 
			WHERE nombre = "'.$log_user.'";';
	$cta = $db->sql_fetchrow($db->sql_query($query));

	if($cta['intentos']>3)
	{
		$_SESSION['todubem']=2;
	}

	if((isset($_SESSION['captcha']) AND $_SESSION['captcha']['code']==$log_code) OR $_SESSION['todubem']==1)
	{
			$log_clave = textIntoSql($_GET['clave']);
			$log_clave = md5($log_clave);
			if($log->logear($log_user,$log_clave))
			{
				$data['ok']=1;
				$db->sql_query("UPDATE cuenta SET intentos=0 WHERE nombre = '".$log_user."'");
			}
			else
			{
		$db->sql_query("UPDATE cuenta SET intentos=(intentos+1) WHERE nombre = '".$log_user."'");

			}
	}
	else
	{
		$data['ok']=2;
	}
	if($_SESSION['todubem']==2)
	{
		if($data['ok']!=1)
		{
			$_SESSION['captcha'] = simple_php_captcha();
			$data['newCap'] = $_SESSION['captcha']['image_src'];
		}
	}


 echo json_encode($data);
?> 