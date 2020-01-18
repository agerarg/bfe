<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
header('content-type: text/html; charset=utf-8');
date_default_timezone_set("America/Argentina/Buenos_Aires");
//error_reporting(0);
include('system/conexion.php');
session_start();
include('system/funciones.php');
include('system/template_engine.php');
$db = new sql_db;
include('system/login.php');
$template = new Template;
$log = new LOGuser;
$now = tiempoReal();
$template->assign_var('RAND', 29);//time() 18
define('ADMIN', 1);
$mantenimiento=false;

//echo damageResist(50000,75);
//echo potenciar(potenciar(12077270,859),2803);
					
	if(!$mantenimiento OR $log->get("idCuenta")==1)
	{
		$query = 'SELECT * FROM gameactive';
		$gameCore = $db->sql_fetchrow($db->sql_query($query));
		if($gameCore['activo']==1)
		{
			$template->assign_vars(array(
						 'USR_ORO' => $log->get("oro"),
						 'USR_SERVTIME' => date("H:i"),
						 'USR_STAT' => "activo",
						 'USR_PATH' => $log->get("path_file")));
			
			if(!$log->check())
				include("includes/noLogeado.php");
			else
				if($log->get("pjSelected")==0)
					include("includes/logeadoSinPj.php");
				else 
					include("includes/logeado.php");
			//FIXER
			if(isset($_SERVER['HTTP_USER_AGENT'])){
				$agent = $_SERVER['HTTP_USER_AGENT'];
			}
			if(strlen(strstr($agent,"Firefox")) > 0 ){ 
				$template->assign_var('FIXER', '<link rel="stylesheet" type="text/css" href="css/fixs_firefox.css" />');
			}
		}
		else
		{
			include("includes/problemo.php");
		}
	}
	else
	{
		include("includes/mantenimiento.php");
	}

$template->assign_var_from_handle("CONTENT_HTML", "content");	
$template->pparse('body');
?> 