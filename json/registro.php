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
$data['ok']=0;

	$email = textIntoSql($_POST['mail']);
	$log_user = textIntoSql($_POST['user']);
	$log_clave = textIntoSql($_POST['clave']);
	/*if($log->logear($log_user,$log_clave))
	{
		$data['ok']=1;
	}
*/

	if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) { 
			$query = 'SELECT *
			FROM cuenta
			WHERE nombre = "'.$log_user.'"';
			$ctasq = $db->sql_query($query);
			$cta = $db->sql_fetchrow($ctasq);
			if($cta)
			{
				$data['ok']=2;
				$data['msg']="el usuario esta siendo usado!";
			}
			else
			{

				$log_clave = md5($log_clave);
				$db->sql_query('INSERT INTO  cuenta(nombre,clave,mail) 
					VALUES("'.$log_user.'","'.$log_clave.'","'.$email.'")');
				
					$data['ok'] = 1;
			}
	} 
	else { 
	 	$data['ok'] = 2;
	 	$data['msg']="El mail es invalido";
	} 



 echo json_encode($data);
?> 