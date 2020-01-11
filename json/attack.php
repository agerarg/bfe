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
		$query = 'SELECT p.*,c.imagen, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN FROM personaje p JOIN clase c USING ( idClase )
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		if($pj['deathTime']>$now)
			$estoyMuerto=1;
		if($pj['inTorneo'])
		$idTorneo=$pj['idTorneo'];
                
		$imagen = $pj['imagen'].'_'.$pj['sexo'].'.jpg';
		$stats = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
		if($pj['Vida']>$stats['VidaLimit'])
			$pj['Vida']=$stats['VidaLimit'];
		
		if($pj['inDungeon']==1)
		{
			if(!$stats['dungeon'])
			{
				$msg = '<div class=questMeta>Perdiste el dungeon.</div>';
				systemLog("self",$msg);
				$db->sql_query("UPDATE personaje SET
					 inDungeon = 0, location = 20 WHERE idPersonaje = '".$stats['PJID']."'");
				$db->sql_query("DELETE FROM aura WHERE idSkillReal = 147 AND idPersonaje=".$stats['PJID']."");
				$data['error'] .= "Se acabo el tiempo del dungeon!" ;
				echo json_encode($data);
				die();
			}
		}
		
		if($pj['Vida']>0 AND $pj['deathTime']<$now)
		{
		$query = 'SELECT im.*, m.warTime, m.id, m.tipo AS LUGARLOCO , m.clan, m.extraInfo
			FROM inmundo im LEFT JOIN mundo m ON im.mundo = m.id
			WHERE im.idInMundo = "'.$monster_id.'" 
			AND (im.tipo = 1 OR im.tipo = 3 AND im.currentLife>0) AND im.mundo = '.$pj['location'].'';
		$checkkk = $db->sql_query($query);
		$check = $db->sql_fetchrow($checkkk);
		if($check)
		{
			if($check['LUGARLOCO']=="free" AND !isset($_GET['target']))
			{
				if($check['tipo']==1)
				{
					$query = 'SELECT clan
					FROM personaje WHERE idPersonaje = '.$check['idPlayer'].'';
					$clansq = $db->sql_query($query);
					$enemyclan = $db->sql_fetchrow($clansq);
					
					if($enemyclan['clan'] == $pj['clan'])
					{
						$data['error'] .= "No podes atacar los de tu clan!" ;
						echo json_encode($data);
						die();
					}
				}
				else
				{
					if($check['clan']==$pj['clan'])
					{
						$data['error'] .= "No podes atacar los de tu clan!" ;
						echo json_encode($data);
						die();
					}
				}
				
			}
			
			if($pj['attackCooldown']<=$now)
			{
				//LIFE REGEN
				$regGoing=false;
				$VIDA = $pj['Vida'];
				$MANA = $pj['Mana'];
				while($now>$pj['regenTime'])
				{
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

				
				//
				switch($check['tipo'])
				{
					case 1:
						include("include/player_vs_player.php");
					break;
						
				}
				
				
				if($vidaModifier>$stats['VidaLimit'])
				$vidaModifier=$stats['VidaLimit'];
				if( $manaModifier>$stats['ManaLimit'])
				$manaModifier=$stats['ManaLimit'];
				$data['mundo']=$check['mundo'];	
				$data['userLife'] = $vidaModifier;	
				$data['userMana'] = $manaModifier;	
				$data['userLifeLimit'] = $stats['VidaLimit'];	
				$data['userManaLimit'] = $stats['ManaLimit'];
				
				if($fisicalCoolDown==1)
						$attackCooldown = $stats['PSpeed'] ;
					
				
				
				if($vidaModifier<=0)
				{
					$data['info'] .= " estas muerto!" ;
					$data['muerto'] = 1 ;
					if($stats['deathRise']==1)
						$timemuerto = 60;
						
					$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$log->get("pjSelected")."'");
					$db->sql_query("UPDATE inmundo SET sesion_time = 0 
					WHERE idPlayer = '".$pj['idPersonaje']."' AND tipo = 1");
					
				}
				else
				{
					
						$data['isPvp']=1;
						$data['attackCooldown'] = $fisicalCoolDown+1;
						
					$db->sql_query("UPDATE inmundo SET sesion_time = '".($now + 300)."' 
					WHERE mundo = '".$check['mundo']."' AND idPlayer = '".$pj['idPersonaje']."' AND tipo = 1");	
				}
				$data['info']= $data['info'];
				
///////////////////////////////////////////////////////////////////////////////////////////////////////
			}
			else
			{
				if(($pj['attackCooldown']-$now)>1200 )
				{
					$db->sql_query("update gameactive set activo = 0");	
				}
				$data['error'] = "Attack time error.";
			}
		}
		else
		{
			$realGold = $log->realGold();
			$log->set("oro",$realGold);
			$data['gold'] = $realGold;
			$data['exp'] = $pj['exp'];
			$data['error'] = "El objetivo ya esta muerto.";
		}
		}
	else
	{
		$data['info'] .= "Has sido derrotado!" ;
		$data['muerto'] = 1 ;
	}
}
else
{
	$data['error'] = "Error - u are offline";
}
 echo json_encode($data);
?> 