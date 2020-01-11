<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
	$query = 'SELECT clan, party
				FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
	$pj = $db->sql_fetchrow($db->sql_query($query));
	
	$query = 'SELECT c.*
					FROM chat c
					WHERE (('.$log->get("pjSelected").' = c.idPersonaje) 
					OR ('.$pj['clan'].' = c.clan AND c.clan!=0) OR ('.$pj['party'].' = c.party AND c.party!=0) OR global=1)
					 ORDER BY c.id DESC LIMIT 30';
	$chatsq = $db->sql_query($query);
	$data['newMsg']=0;
		while($chat = $db->sql_fetchrow($chatsq))
			{
				$cadena = utf8_encode($chat['mensaje']);
				$cadena = @eregi_replace("/\r\n+|\r+|\n+|\t+/i",  ' ', $cadena);
				if(!$data['lastMsg'])
					$data['lastMsg']=$chat['id'];
				$data['newMsg']=1;
					$data['msg'][] = array(
					"nombre"=>$chat['nombre'],
					"pvpTarget"=>$chat['pvpTarget'],
					"mundo" => $chat['mundo'],
					"text"=> $cadena);
			}	
	if($data['newMsg']==0)
	{
		$data['newMsg']=1;
		$data['msg'][] = array(
					"nombre"=>"",
					"pvpTarget"=>0,
					"mundo" => 0,
					"text"=> "No hay mensajes.");
	}
	$data['msg']=array_reverse($data['msg']);		
}
else
{
	die();
}
 echo json_encode($data);
?> 