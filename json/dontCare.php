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
$now = tiempoReal();
if($log->check())
{
		$query = 'SELECT idMisionOn
				FROM misiononplayer
				WHERE idPersonaje = "'.$log->get("pjSelected").'" AND idMision = 66 AND follow = 81 AND finalizado=0';
	
	$questsq = $db->sql_query($query);
	$quest = $db->sql_fetchrow($questsq);
	if($quest)
	{

			$id = intval($_GET['id']);
			$query = 'SELECT *
				FROM item
				WHERE idItem = '.$id.' AND tier = 0';
			$itemsq = $db->sql_query($query);
			$item = $db->sql_fetchrow($itemsq);
			if($item)
			{
				include("../system/legendary.php");
				$msg = "<div class='questEnd'>Dont Know Dont Care finalizado!</div>";
				$msg .= "<div class=recompensaAstral>Conseguiste ".$item['Nombre']."</div>";
				$itemId = createLegendary($item['idItem'],1,$log->get("idCuenta"),0,1,$item['epic'],7,$item['forceStats']);
				systemLog("self",$msg);
				$data['ok']=1;
				$db->sql_query("UPDATE misiononplayer SET
							finalizado=1, lockTime=".($now+3600)."
				WHERE idMisionOn  = '".$quest['idMisionOn']."'");
			}
	}
}
 echo json_encode($data);
?> 