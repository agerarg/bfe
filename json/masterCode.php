<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
define('SWORDON', 1);
include('../system/funciones.php');
session_start();
$db = new sql_db;
		$data="";
		$code = textIntoSql($_GET['code']);
		$query = 'SELECT *
			FROM mastercodes
			WHERE code = "'.$code.'"';
		$itemsq = $db->sql_query($query);
		$item = $db->sql_fetchrow($itemsq);
		if($item)
		{
			if($item['used']==0)
			{
				$_SESSION['ChekedCode']=$code;
				$data["resp"] = 1;
			}
			else
				$data["resp"] = 2;
				
		}
		else
			$data["resp"] = 0;

 echo json_encode($data);
?> 