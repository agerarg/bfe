<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
include('../system/conexion.php');
include('../system/login.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{	
		function insertBuff($idPersonaje,$idSkill,$idSkillReal,$time)
		{
			global $db;
			$now = time();
			$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$idSkillReal."' AND idPersonaje = ".$idPersonaje."");
			
			$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
			VALUES("'.$idPersonaje.'","'.$idSkill.'","0","'.$idSkillReal.'",'.($now+$time).')');
		}
		function systemLog($tipo,$msg,$to=0)
		{
			global $db,$pj,$log;
			$now = time();
			switch($tipo)
			{
				case 'party':
					$db->sql_query('INSERT INTO  chat(party,mensaje,tempo) 
					VALUES("'.$pj['party'].'","'.$msg.'",'.$now.')');
				break;
				case 'self':
					$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje,tempo) 
					VALUES("'.$log->get("pjSelected").'","'.$msg.'",'.$now.')');
				break;
				case 'other':
					$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje,tempo) 
					VALUES("'.$to.'","'.$msg.'",'.$now.')');
				break;
				case 'clan':
					$db->sql_query('INSERT INTO  chat(clan,mensaje,tempo) 
					VALUES("'.$to.'","'.$msg.'",'.$now.')');
				break;
				case 'global':
					$db->sql_query('INSERT INTO  chat(global,mensaje,tempo) 
					VALUES(1,"'.$msg.'",'.$now.')');
				break;
			}
		}
		////////////////////////////
		
		$id = intval($_GET['id']);
		$query = 'SELECT p.idPas, s.skill_requiere, s.pasive, s.idSkill, s.nombre, p.importante
							FROM pasivos p JOIN skill s USING ( idSkill )
							WHERE p.idPas = '.$id.'';
		$skill = $db->sql_fetchrow($db->sql_query($query));
		if($skill['pasive']==1)
		{					
			$haveThat=0;
			if($skill['skill_requiere'])
			{
				$req = explode(",",$skill['skill_requiere']);
				foreach ($req as $valor) {
					if($sqlChecker)
						$sqlChecker.=" OR ";
					$sqlChecker.= " idSkill =".$valor." ";
				}
				$query = 'SELECT idSkillLearn
								FROM skilllearn
								WHERE ('.$sqlChecker.') AND idPersonaje = '.$log->get("pjSelected").' LIMIT 0,1';
				$chekkker = $db->sql_fetchrow($db->sql_query($query));
				if($chekkker)
					$haveThat=1;
				else
				{
					$haveThat=0;
					$data['error']=1;
					$data['msg']="Requiere aventuras que conecten esta.";
				}
			}
			else
				$haveThat=1;
			
			if($haveThat==1)
			{
				$query = 'SELECT idSkillLearn
								FROM skilllearn
								WHERE idSkill = '.$skill['idSkill'].' AND idPersonaje = '.$log->get("pjSelected").' LIMIT 0,1';
				$chekkker = $db->sql_fetchrow($db->sql_query($query));
				if($chekkker)
				{
					$haveThat=0;
					$data['error']=1;
					$data['msg']="ya tenes esta aventura realizada.";
				}
			}
			
			if($haveThat==1)
			{
					$query = 'SELECT idPersonaje,pasivosCurr,nivel,pasivosWins,pasivosGain
						FROM personaje
						WHERE idCuenta = '.$log->get("idCuenta").' AND idPersonaje = '.$log->get("pjSelected").'';
					$pj = $db->sql_fetchrow($db->sql_query($query));
					if($pj['pasivosCurr']<=0)
					{
						$haveThat=0;
						$data['error']=1;
						$data['msg']="no tienes puntos de aventura.";
					}
			}
			
			if($haveThat==1)
			{
					if($pj['pasivosGain']<$pj['pasivosWins'])
					{
						$query = 'SELECT idSkill, idRealSkill, nombre
						FROM skill
						WHERE idSkill = '.$skill['idSkill'].'';
						$skillwin = $db->sql_fetchrow($db->sql_query($query));
							
						$db->sql_query('INSERT INTO  skilllearn(idSkill,idRealSkill,idPersonaje,noRecet,aventura ) 
									VALUES("'.$skill['idSkill'].'","'.$skillwin['idRealSkill'].'","'.$pj['idPersonaje'].'",1,1)');	
						
						$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,acumuleitor,aventura) 
											VALUES("'.$pj['idPersonaje'].'","'.$skillwin['idSkill'].'","1",'.$skillwin['idRealSkill'].',0,1)');
									
						$msg = '<div class=questMeta>Conseguiste '.$skillwin['nombre'].'!</div>';
						systemLog("self",$msg);
						$db->sql_query("UPDATE personaje SET pasivosGain=(pasivosGain+1), pasivosCurr=(pasivosCurr-1) WHERE idPersonaje = ".$pj['idPersonaje']);
						
						unset($_SESSION['MADVSKILL']);
							$data['error']=2;
							$data['idPas']=$skill['idPas'];
							$data['puntos']=($pj['pasivosCurr']-1);
							$data['msg']="Aventura aprendida.";
					}
					else
					{
					insertBuff($pj['idPersonaje'],246,147,600);	
					
					 $waves=5;
					///////////////////// INICIO BORRAR INSTANCIAS
					$query = 'SELECT idInstance FROM dungeon_instance WHERE idPersonaje='.$pj['idPersonaje'].'';
					$instancesq = $db->sql_query($query);
					while($instance = $db->sql_fetchrow($instancesq))
						$db->sql_query("DELETE FROM inmundo WHERE idInstance = '".$instance['idInstance']."'");
					$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
					///////////////////// FIN BORRAR INSTANCIAS
						
					 $db->sql_query('INSERT INTO  dungeon_instance(skillWIn,idPersonaje,nivel,waves,waveCurr) 
										VALUES("'.$skill['idSkill'].'","'.$pj['idPersonaje'].'","'.(($pj['pasivosWins']*5)+3).'",'.$waves.',1)');
										
					$query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
					$itemsq = $db->sql_query($query);
					$maxId = $db->sql_fetchrow($itemsq);
					
					// Agregar Players
					$db->sql_query("UPDATE personaje SET
					 inDungeon = 1, dungeonInstance=".$maxId['ID']."
					 WHERE  idPersonaje = '".$pj['idPersonaje']."'");
					//
					$cantidad=mt_rand(2,4);
					
					$query = 'SELECT idMonster, VidaLimit
							FROM monster  WHERE  exp=1 AND hardOne = 0 AND nivel < '.(($pj['pasivosWins']*5)+3).' AND raid = 0 AND customDrop=0 ORDER BY nivel DESC LIMIT 0,3';
							$monster = $db->sql_query($query);
							while($chor = $db->sql_fetchrow($monster))
							{	
								for($i=0;$i<$cantidad;$i++)
								{
									$vida=$chor['VidaLimit'];
									$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,champion,dificulty,idInstance) 
											VALUES("'.$chor['idMonster'].'","2",
											1,"'.$vida.'",0,0,'.$maxId['ID'].')');
								}
										
							}
					$msg = '<div class=questMeta>Dungeon para '.$skill['nombre'].' iniciado.</div>';
					systemLog("self",$msg);		
					$data['error']=0;	
					}		
			}
		}
		else
		{
			$data['error']=1;
			$data['msg']="No se encuentra la aventura";
		}
}
else
{
	$data['error'] = 1;
}
 echo json_encode($data);
?> 