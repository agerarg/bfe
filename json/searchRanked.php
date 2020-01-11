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
		$query = 'SELECT ranked, mmr, rankedTimer, rankedCalls, rankedPlaing, inTorneo, idTorneo
			FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		$time = time();
		$data['itson']=0;
		$data['call']=0;
		if($pj['rankedPlaing']==1)
		{
			$data['itson']=1;
		}
		else
		if($pj['ranked']==1)
		{		
			$search = ($pj['rankedCalls']*20);
			if($search>100)
				$search=$search;
			$data['call']=$pj['rankedCalls'];
			if($pj['rankedTimer']<$time)
				$db->sql_query("UPDATE personaje SET rankedCalls = (rankedCalls+1), rankedTimer=".($time+30)." WHERE idCuenta = ".$log->get("idCuenta")." AND idPersonaje = '".$log->get("pjSelected")."'");
			
			if($pj['inTorneo'])
			{
				$data['call']="T";
					$query = 'SELECT *
										FROM torneo_posicion tp WHERE (tp.idMascota1 = '.$log->get("pjSelected").' OR tp.idMascota2 = '.$log->get("pjSelected").') AND ganador = 0 AND idTorneo = '.$pj['idTorneo'].'';
					$inTorneo = $db->sql_fetchrow($db->sql_query($query));
					
					if($inTorneo['idMascota1']==$log->get("pjSelected"))
						$matching = $inTorneo['idMascota2'];
					else
						$matching = $inTorneo['idMascota1'];
					
				$query = 'SELECT ranked, mmr, idPersonaje
				FROM personaje
				WHERE ranked = 1 AND deathTime < '.time().' AND idPersonaje = '.$matching.' AND rankedPlaing=0';
				$otro = $db->sql_fetchrow($db->sql_query($query));
			}
			else
			{
				$query = 'SELECT ranked, mmr, idPersonaje
				FROM personaje
				WHERE ranked = 1 AND deathTime < '.time().' AND mmr < '.($pj['mmr']+$search).' AND mmr > '.($pj['mmr']-$search).' AND idPersonaje != '.$log->get("pjSelected").' AND rankedPlaing=0';
				$otro = $db->sql_fetchrow($db->sql_query($query));
			}
			
			
			if($otro)
			{
				$db->sql_query("UPDATE personaje SET readyPalRanked=1, rankedPlaing = 1 WHERE idCuenta = ".$log->get("idCuenta")." AND idPersonaje = '".$log->get("pjSelected")."'");
				$db->sql_query("UPDATE personaje SET readyPalRanked=1, rankedPlaing = 1 WHERE idPersonaje = ".$otro['idPersonaje']."");
				$data['itson']=1;
					$db->sql_query('INSERT INTO  ranked_match(idPlayer1,idPlayer2,startAt) 
						VALUES("'.$log->get("pjSelected").'","'.$otro['idPersonaje'].'",'.($time+60).')');		
			}
		}
}
 echo json_encode($data);
?> 