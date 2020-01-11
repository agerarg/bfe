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
		$now = tiempoReal();
		$monster_id = intval($_GET['id']);
		$skill_id = intval($_GET['skill']);
		$data['newCoolDown']=1;
		$timemuerto = 120;
		$today = date("z");
		$data['antiBot']=0;
		$query = 'SELECT p.*, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
			FROM personaje p JOIN clase c USING ( idClase ) 
			WHERE  p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		if($pj['deathTime']>$now)
			$estoyMuerto=1;
		$PARTY = $pj['party'];
		$dungeonElite = $pj['dungeonElite'];
		$stats = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
		if($pj['Vida']>$stats['VidaLimit'])
			$pj['Vida']=$stats['VidaLimit'];
		
		if($pj['inDungeon']==1)
		{
			$dungeonSQL = " AND idInstance = ".$pj['dungeonInstance'];
			if(!$stats['dungeon'])
			{
				$msg = '<div class=questMeta>Perdiste el dungeon.</div>';
				systemLog("self",$msg);
				
				///////////////////// INICIO BORRAR INSTANCIAS
					$query = 'SELECT idInstance FROM dungeon_instance WHERE idPersonaje='.$pj['idPersonaje'].'';
					$instancesq = $db->sql_query($query);
					while($instance = $db->sql_fetchrow($instancesq))
						$db->sql_query("DELETE FROM inmundo WHERE idInstance = '".$instance['idInstance']."'");
					$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
					///////////////////// FIN BORRAR INSTANCIAS
				
				$db->sql_query("UPDATE personaje SET
					 inDungeon = 0,inRunz=0, location = 20, dungeonInstance = 0 WHERE idPersonaje = '".$stats['PJID']."'");
				$db->sql_query("DELETE FROM aura WHERE idSkillReal = 147 AND idPersonaje=".$stats['PJID']."");
				$data['error'] .= "Se acabo el tiempo del dungeon!" ;
				echo json_encode($data);
				die();
			}
			else
			{
				$query = 'SELECT *
						FROM dungeon_instance
						WHERE idPersonaje='.$pj['idPersonaje'].' OR (idParty > 0 AND idParty = '.$PARTY.') ORDER BY skillWIn DESC LIMIT 1';
						$dungeonsq = $db->sql_query($query);
						$dungeon = $db->sql_fetchrow($dungeonsq);

			}
		}



		if($pj['Vida']>0 AND $pj['deathTime']<$now)
		{
		$id = intval($_GET['id']);
		$id2 = intval($_GET['id2']);	
		$id3 = intval($_GET['id3']);
		$id4 = intval($_GET['id4']);
		$id5 = intval($_GET['id5']);
		
		
		$query = 'SELECT *
			FROM inmundo im  
			JOIN monster mob 
			USING ( idMonster ) 
			WHERE (im.idInMundo = "'.$id.'" 
			OR im.idInMundo = "'.$id2.'" 
			OR im.idInMundo = "'.$id3.'" 
			OR im.idInMundo = "'.$id4.'" 
			OR im.idInMundo = "'.$id5.'")
			AND ((im.deQuien='.$log->get("pjSelected").') 
			OR (openToClan='.$PARTY.' AND openToClan>0)
			OR globalmap = 1) 
			AND  im.tipo = 2 '.$dungeonSQL;
		$checkkk = $db->sql_query($query);
		$cantidad=0;
		$otroMundo=true;
		$maxVida=0;
		$targetFixer=0;
		$multyTarget=1;
		$allFullVida=1;
		while($check = $db->sql_fetchrow($checkkk))
		{
			if($check['champion']==1)
			{
				$check['Ataque']=$check['Ataque']*2;
			}
			if($id2==0)	
			{
				if($check['champion']==1)
				{
					$check['VidaLimit']=$check['VidaLimit']*3;
					if($stats['dmgVsChampion'])
					{
						$stats['Ataque']=potenciar($stats['Ataque'],$stats['dmgVsChampion']);	
						$stats['AtaqueMagico']=potenciar($stats['AtaqueMagico'],$stats['dmgVsChampion']);	
					}
				}	

				if($stats['dmgVsMonsters'] && $check['raid']==0)
				{
					$stats['Ataque']=potenciar($stats['Ataque'],$stats['dmgVsMonsters']);	
					$stats['AtaqueMagico']=potenciar($stats['AtaqueMagico'],$stats['dmgVsMonsters']);	
					
				}
				
				$monster['VidaLimit'] = $check['VidaLimit'];
			}
			if($check['dificulty']>0)
			{
				$check['VidaLimit']=$check['VidaLimit']*$check['dificulty'];
				$check['Ataque']=$check['Ataque']*$check['dificulty'];
			}
			$monster['mundo']=$check['mundo'];
			$monster['raid']=$check['raid'];
			$monster['dropLevel']=$check['dropLevel'];
			$monster['idMonster']=$check['idMonster'];
			$monster['papa'] =$check['papa'];
			$monster['mapBoss'] =$check['mapBoss'];
			$monster['imagen'] =$check['imagen'];
			$monster['customDrop'] =$check['customDrop'];
			$monster['VidaLimit'] = $check['VidaLimit'];
			$monster['nivel'] = $check['nivel'];
			$monster['hardOne'] = $check['hardOne'];
			$monster['dropGrade'] = $check['dropGrade'];
			$monster['raidSkillready']  = $check['raidSkillready']; 
			$monster['nombre'] = $check['nombre'];
			$monster['VidaLimit'] = $check['VidaLimit'];
			$monster['tipo'] = $check['tipo'];
			$monster['attackType'] = $check['attackType']; 
			$monster['Ataque'] += $check['Ataque'];
			$monster['AtaqueMagico'] += $check['AtaqueMagico'];
			$monster['Defensa'] += $check['Defensa'];
			$monster['DefensaMagica'] += $check['DefensaMagica'];
			$monster['Critico'] += $check['Critico'];
			$monster['LastIm'] = $check['idInMundo'];
                        $sqlTargetOne =  $check['idInMundo'];
                        $sqlTargetHash .= $check['idInMundo'].',';
			$monster_hash .= $andadd." im.idInMundo = ".$check['idInMundo']."";
			$andadd=" OR ";
			$monsterVida += $check['currentLife'];
			$monster['attackCooldown']=$check['attackCooldown'];
			if($check['currentLife']>=$check['VidaLimit'] AND $allFullVida==1)
				$allFullVida=1;
			else
				$allFullVida=0;
			if($maxVida<$check['currentLife'])
			{
				$maxVida=$check['currentLife'];
				$targetFixer = $check['idInMundo'];
			}	
			
			$monster['Critico']+=$check['Critico'];
			$existeAlguno=true;
			$cantidad++;
			
			/*if($check['mundo']!=$pj['location'])
				$otroMundo=false;*/
				
			//LAST
			$monster['idMonster']=$check['idMonster'];

			if($dungeon['elite'])
					{
						$monster['VidaLimit']+=($monster['VidaLimit']*($dungeon['eliteLevel']+1)/4);
					}

			if($check['singleTarget'])
				break;
		}
		//TARGETS
		$check['idInMundo'] = $targetFixer;
		$check['mundo']=$pj['location'];
                $data['mundo']=$check['mundo'];
		$monster['attackSpeed']=20;
		$monsterVidaTotal = $monsterVida;
		if($cantidad>1)
                {
		     $sqlTarget = " targeting = '".$sqlTargetHash."', targetingNature=4, ";
                 }
                 else
                 {
                     $sqlTarget = " targeting = '".$sqlTargetOne."', targetingNature=2, ";
                 }
		if($cantidad>1)
		$monster['Critico'] = intval($monster['Critico']/$cantidad);
		
		
		if($existeAlguno)
		{
			if($pj['attackCooldown']<=$now)
			{
				//LIFE REGEN
				$regGoing=false;
				$VIDA = $pj['Vida'];
				$MANA = $pj['Mana'];
				while($now>$pj['regenTime'])
				{
					$regCount++;
					if($regCount>100)
						break;
					
					$VIDA+=$stats['HpRegen'];
					$MANA+=$stats['MpRegen'];
					$pj['regenTime']+=10;
					if($VIDA>$stats['VidaLimit'] AND $MANA>$stats['ManaLimit'])
						break;
					
					$regGoing=true;
				}
				if($VIDA>$stats['VidaLimit'])
					$VIDA=$stats['VidaLimit'];
				if($MANA>$stats['ManaLimit'])
					$MANA=$stats['ManaLimit'];
				if($regGoing)
					$db->sql_query("UPDATE personaje SET regenTime='".($now+10)."'  WHERE idPersonaje = '".$pj['idPersonaje']."'");
				
				$manaModifier = $MANA;
				$vidaModifier = $VIDA;
				$data['skillCanceled']=1;
				$data['info'] = "";
				$goldModifier = 0;
				$expModifier = 0;
				$goldAndExp=0;
				$data['drop']=0;
				$fisicalCoolDown = $stats['PSpeed'];
				$cancelAttackCooldownFFS=false;
///////////////////////////////////////////////////////////////////////////////////////////////////////		
				if($dungeon['elite'])
				{
					$monster['Defensa']=$monster['Defensa']+intval(10*$dungeon['eliteLevel']);
					$monster['DefensaMagica']=$monster['DefensaMagica']+intval(10*$dungeon['eliteLevel']);
				}

				include("include/player_vs_monster.php");
				
				if($vidaModifier>$stats['VidaLimit'])
				$vidaModifier=$stats['VidaLimit'];
				if( $manaModifier>$stats['ManaLimit'])
				$manaModifier=$stats['ManaLimit'];
					
				$data['userLife'] = $vidaModifier;	
				$data['userMana'] = $manaModifier;	
				$data['userLifeLimit'] = $stats['VidaLimit'];	
				$data['userManaLimit'] = $stats['ManaLimit'];
				
				if($fisicalCoolDown==1)
						$attackCooldown = $stats['PSpeed'] ;
					
				
				
				if($vidaModifier<=0)
				{
					$data['info'] .= " has muerto!" ;
					$data['muerto'] = 1 ;
					$timemuerto = DEATHTIME;
						
					$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$log->get("pjSelected")."'");
					$db->sql_query("UPDATE inmundo SET sesion_time = 0 
					WHERE idPlayer = '".$pj['idPersonaje']."' AND tipo = 1");
					
				}
				else
				{
						if($goldAndExp==1)
						{
							
					$db->sql_query("UPDATE inmundo SET sesion_time = '".($now + 300)."' 
					WHERE mundo = '".$check['mundo']."' AND idPlayer = '".$pj['idPersonaje']."' AND tipo = 1");	
				}
				$data['info']= $data['info'];
				$data['attackCooldown'] = $fisicalCoolDown;	
///////////////////////////////////////////////////////////////////////////////////////////////////////
				}
			}		
			else
			{
				if(($pj['attackCooldown']-$now)>1200 )
				{
					$db->sql_query("update gameactive set activo = 0");	
				}
				$data['error'] = "Error en tiempo de ataque.";
			}
		}
		else
		{
			$realGold = $log->realGold();
			$log->set("oro",$realGold);
			$data['gold'] = $realGold;
			$data['exp'] = $pj['exp'];
			$data['error'] = "El objetivo ya esta muerto. (attack_mob)";
		}
		}
	else
	{
		$data['info'] .= "Fuiste derrotado!" ;
		$data['muerto'] = 1 ;
	}
}
else
{
	$data['error'] = "Error - sos un boludo y no tenes huevos";
}
 echo json_encode($data);
?> 