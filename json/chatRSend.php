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

	$query = 'SELECT clan, party
			FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
	$pj = $db->sql_fetchrow($db->sql_query($query));
	$data['error']=0;
	//$_POST = $_GET;
	$mensaje=textIntoSql($_POST['msg']);
	if(!($mensaje=="" OR $mensaje==" "))
	{
		$mensaje=htmlentities($mensaje);
		switch($_POST['tipoChat'])
		{
			/*case 'chat_privado':
			
			$nombre=textIntoSql($_POST['to']);
			$nombre = str_replace(' ', '', $nombre);
				$query = 'SELECT idPersonaje
			FROM personaje
			WHERE nombre = "'.$nombre.'" AND desactivada=0';
			$to = $db->sql_fetchrow($db->sql_query($query));
			if($to)
			{
			$query = "INSERT INTO chatreal (idPersonaje,mensaje,tiempo,privado) 
					VALUES('".$log->get("pjSelected")."','".$mensaje."','".time()."',".$to['idPersonaje'].")";	
			}
			else
			{
				$data['error']=1;
				$data['msg']="No existe el jugador para hablar.";
			}
			break;*/
			case 'clan':
			if($pj['clan']>0)
				$query = "INSERT INTO chatreal (idPersonaje,mensaje,tiempo,idClan) 
					VALUES('".$log->get("pjSelected")."','".$mensaje."432','".time()."',".$pj['clan'].")";	
			else
				die();
			break;
			case 'party':
			if($pj['party']>0)
				$query = "INSERT INTO chatreal (idPersonaje,mensaje,tiempo,party) 
					VALUES('".$log->get("pjSelected")."','".$mensaje."11123','".time()."',".$pj['party'].")";	
			else
				die();
			break;
			default:
		$query = "INSERT INTO chatreal (idPersonaje,mensaje,tiempo) 
					VALUES('".$log->get("pjSelected")."','".$mensaje."[tipo]".$_POST['tipoChat']."','".time()."')";	
			break;
		}
		$db->sql_query($query);	
	}
}
else
{
	die();
}
 echo json_encode($data);
?> 