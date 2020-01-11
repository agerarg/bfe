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
	$query = 'SELECT idPersonaje, aventura
			FROM personaje
			WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
	$pj = $db->sql_fetchrow($db->sql_query($query));
	
	$data['ok']=1;
	$honor = intval($_GET['h']);
	switch($pj['aventura'])
	{
		case 0:
			if($honor==1)
			{
				$query = 'SELECT idPersonaje
				FROM personaje
				WHERE party = '.$pj['idPersonaje'].' AND idPersonaje != '.$pj['idPersonaje'].' AND rankedPlaing = 0 LIMIT 0,1 ';
				$partymemsq = $db->sql_query($query);
				$partymem = $db->sql_fetchrow($partymemsq);
					$db->sql_query("UPDATE personaje SET party = ".intval($partymem['idPersonaje'])." WHERE party = '".$pj['idPersonaje']."' AND idPersonaje != ".$pj['idPersonaje']);
					
						$query = 'SELECT *
					FROM dungeon WHERE idDungeon = 10';
					$misionsq = $db->sql_query($query);
		
					$dungeon = $db->sql_fetchrow($misionsq);
					
				$db->sql_query("DELETE FROM partyinvite WHERE idTarget = '".$pj['idPersonaje']."'");
					$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
					
					insertBuff($pj['idPersonaje'],246,147,600);	
						
					$db->sql_query("UPDATE personaje SET
					 inDungeon = 1 WHERE idPersonaje = '".$pj['idPersonaje']."'");
					
					$db->sql_query('INSERT INTO  dungeon_instance(idDungeon,idParte,idPersonaje) 
										VALUES("'.$dungeon['idDungeon'].'","'.$dungeon['inicioPart'].'","'.$pj['idPersonaje'].'")');
					 
					 $query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
					$itemsq = $db->sql_query($query);
					$maxId = $db->sql_fetchrow($itemsq);
	
					$query = 'SELECT idMonster,m.VidaLimit, db.cantidad
							FROM monster m JOIN dungeon_board db USING ( idMonster )
							WHERE db.idParte = '.$dungeon['inicioPart'].'';
							$monster = $db->sql_query($query);
							while($chor = $db->sql_fetchrow($monster))
							{	
								for($i=0;$i<$chor['cantidad'];$i++)
								{
									$vida=$chor['VidaLimit'];
									$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,champion,idInstance) 
											VALUES("'.$chor['idMonster'].'","2",
											1,"'.$vida.'",0,'.$maxId['ID'].')');
								}
										
							}
					$msg = '<div class=questMeta>Dungeon '.$dungeon['nombre'].' iniciado.</div>';
					systemLog("self",$msg);			
			}
			else
			{
				$db->sql_query("UPDATE personaje SET
					 aventura = 1, honor=0 WHERE idPersonaje = '".$pj['idPersonaje']."'");
				systemLog("self",'<spam class='."'AdvMsg'".'>Markulion dice: Hijo de putaaaaa!</spam>');
			}
		break;
		case 1:
			$query = 'SELECT idPersonaje
				FROM personaje
				WHERE party = '.$pj['idPersonaje'].' AND idPersonaje != '.$pj['idPersonaje'].' AND rankedPlaing = 0 LIMIT 0,1 ';
				$partymemsq = $db->sql_query($query);
				$partymem = $db->sql_fetchrow($partymemsq);
					$db->sql_query("UPDATE personaje SET party = ".intval($partymem['idPersonaje'])." WHERE party = '".$pj['idPersonaje']."' AND idPersonaje != ".$pj['idPersonaje']);
					
						$query = 'SELECT *
					FROM dungeon WHERE idDungeon = 11';
					$misionsq = $db->sql_query($query);
		
					$dungeon = $db->sql_fetchrow($misionsq);
					
				$db->sql_query("DELETE FROM partyinvite WHERE idTarget = '".$pj['idPersonaje']."'");
					$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
					
					insertBuff($pj['idPersonaje'],246,147,600);	
						
					$db->sql_query("UPDATE personaje SET
					 inDungeon = 1 WHERE idPersonaje = '".$pj['idPersonaje']."'");
					
					$db->sql_query('INSERT INTO  dungeon_instance(idDungeon,idParte,idPersonaje) 
										VALUES("'.$dungeon['idDungeon'].'","'.$dungeon['inicioPart'].'","'.$pj['idPersonaje'].'")');
					 
					 $query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
					$itemsq = $db->sql_query($query);
					$maxId = $db->sql_fetchrow($itemsq);
	
					$query = 'SELECT idMonster,m.VidaLimit, db.cantidad
							FROM monster m JOIN dungeon_board db USING ( idMonster )
							WHERE db.idParte = '.$dungeon['inicioPart'].'';
							$monster = $db->sql_query($query);
							while($chor = $db->sql_fetchrow($monster))
							{	
								for($i=0;$i<$chor['cantidad'];$i++)
								{
									$vida=$chor['VidaLimit'];
									$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,champion,idInstance) 
											VALUES("'.$chor['idMonster'].'","2",
											1,"'.$vida.'",0,'.$maxId['ID'].')');
								}
										
							}
					$msg = '<div class=questMeta>Dungeon '.$dungeon['nombre'].' iniciado.</div>';
					systemLog("self",$msg);			
		break;
		case 2:
			$query = 'SELECT *
						FROM skilllearn
						WHERE  idPersonaje = "'.$log->get("pjSelected").'" AND (idRealSkill = 209 OR idRealSkill = 210 OR idRealSkill = 211)';
			$buffsq = $db->sql_query($query);
			$buff = $db->sql_fetchrow($buffsq);
			if(!$buff)
			{
				switch($_GET['pj'])
				{
					case 1:
							$db->sql_query('INSERT INTO  skilllearn(idPersonaje,idSkill,nivel,idRealSkill,noRecet) 
											VALUES("'.$log->get("pjSelected").'","355",1,209,1)');
							systemLog("self",'<spam class='."'itruptFailWin'".'>Kike te instruyo en Crear Choripan!</spam>');
					break;
					case 2:
						$db->sql_query('INSERT INTO  skilllearn(idPersonaje,idSkill,nivel,idRealSkill,noRecet) 
											VALUES("'.$log->get("pjSelected").'","356",1,210,1)');
							systemLog("self",'<spam class='."'itruptFailWin'".'>Darkolo te instruyo en Aura Oscura!</spam>');
					break;
					case 3:
						$db->sql_query('INSERT INTO  skilllearn(idPersonaje,idSkill,nivel,idRealSkill,noRecet) 
											VALUES("'.$log->get("pjSelected").'","357",1,211,1)');
							systemLog("self",'<spam class='."'itruptFailWin'".'>Pepe te instruyo en Curamela!</spam>');
					break;
				}
			}
			$query = 'SELECT idPersonaje
				FROM personaje
				WHERE party = '.$pj['idPersonaje'].' AND idPersonaje != '.$pj['idPersonaje'].' AND rankedPlaing = 0 LIMIT 0,1 ';
				$partymemsq = $db->sql_query($query);
				$partymem = $db->sql_fetchrow($partymemsq);
					$db->sql_query("UPDATE personaje SET party = ".intval($partymem['idPersonaje'])." WHERE party = '".$pj['idPersonaje']."' AND idPersonaje != ".$pj['idPersonaje']);
					
						$query = 'SELECT *
					FROM dungeon WHERE idDungeon = 12';
					$misionsq = $db->sql_query($query);
		
					$dungeon = $db->sql_fetchrow($misionsq);
					
				$db->sql_query("DELETE FROM partyinvite WHERE idTarget = '".$pj['idPersonaje']."'");
					$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
					
					insertBuff($pj['idPersonaje'],246,147,600);	
						
					$db->sql_query("UPDATE personaje SET
					 inDungeon = 1 WHERE idPersonaje = '".$pj['idPersonaje']."'");
					
					$db->sql_query('INSERT INTO  dungeon_instance(idDungeon,idParte,idPersonaje) 
										VALUES("'.$dungeon['idDungeon'].'","'.$dungeon['inicioPart'].'","'.$pj['idPersonaje'].'")');
					 
					 $query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
					$itemsq = $db->sql_query($query);
					$maxId = $db->sql_fetchrow($itemsq);
	
					$query = 'SELECT idMonster,m.VidaLimit, db.cantidad
							FROM monster m JOIN dungeon_board db USING ( idMonster )
							WHERE db.idParte = '.$dungeon['inicioPart'].'';
							$monster = $db->sql_query($query);
							while($chor = $db->sql_fetchrow($monster))
							{	
								for($i=0;$i<$chor['cantidad'];$i++)
								{
									$vida=$chor['VidaLimit'];
									$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,champion,idInstance) 
											VALUES("'.$chor['idMonster'].'","2",
											1,"'.$vida.'",0,'.$maxId['ID'].')');
								}
										
							}
					$msg = '<div class=questMeta>Dungeon '.$dungeon['nombre'].' iniciado.</div>';
					systemLog("self",$msg);			
		break;
	}
						

}
echo json_encode($data);
?> 