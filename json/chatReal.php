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


	$query = 'SELECT clan, party, SubClassFrom, idPersonaje
			FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
	$pj = $db->sql_fetchrow($db->sql_query($query));
	$limite = 26;
	
	if($pj['SubClassFrom']>0)
			$idPersonajeBase = $pj['SubClassFrom'];
		else
			$idPersonajeBase = $pj['idPersonaje'];
	$query = 'SELECT * FROM chatsilence WHERE idPlayer = '.$idPersonajeBase;
	$silencesq = $db->sql_query($query);
	$chatBnList="";
	$ors="";
	$flagBn=false;
	$addSqlSilence="";
	while($silence = $db->sql_fetchrow($silencesq))
	{
		$chatBnList.= $ors." idPersonaje = ".$silence['idTarget']." ";
		$ors="OR";
		$flagBn=true;
	}		
	if($flagBn)
	$addSqlSilence = "AND !(".$chatBnList.")";
	
	switch($_GET['tipoChat'])
	{
		case 'party':
			if($pj['party']>0)
			{
			$query = 'SELECT *
					FROM chatreal
					WHERE  party = '.$pj['party'].' '.$addSqlSilence.'
					 ORDER BY idMsg DESC LIMIT '.$limite;
			}
		break;
		case 'clan':
		if($pj['clan']>0)
			{
			$query = 'SELECT *
					FROM chatreal
					WHERE  clan = '.$pj['clan'].' '.$addSqlSilence.'
					 ORDER BY idMsg DESC LIMIT '.$limite;
			}
		break;
		default:
			$query = 'SELECT *
					FROM chatreal
					WHERE  (party = 0 OR party = '.$pj['party'].') AND (clan = 0 OR clan = '.$pj['clan'].')   '.$addSqlSilence.'
					 ORDER BY idMsg DESC LIMIT '.$limite;
		break;
	}

	

	$chatsq = $db->sql_query($query);
	$data['msg']=false;
	while($chat = $db->sql_fetchrow($chatsq))
		{
			$cadena = utf8_encode($chat['mensaje']);
			$cadena = @eregi_replace("/\r\n+|\r+|\n+|\t+/i",  ' ', $cadena);
			

				$data['msg'][] = array(
				"id"=>$chat['idPersonaje'],
				"odin"=>$chat['odin'],
				"charimage"=> $chat['pimagen'],
				"tipoMSG"=>$tipoMSG,
				"idPj"=>$chat['idPersonaje'],
				'itemName'=>$chat['itemName'],
				'item'=>$chat['item'],
				"nombre"=>$chat['nombre'],
				"tiempo"=>date('(H:i)', $chat['tiempo']).$lid,
				"text"=> $cadena,
				"party"=> $chat['party'],
				"clan"=> $chat['clan'],
				"col"=> $chat['col']);
		}	
		$data['msg']=array_reverse($data['msg']);
}
else
{
	die();
}
 echo json_encode($data);
?> 