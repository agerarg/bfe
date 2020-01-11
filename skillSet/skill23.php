<?php

$ataque_player=1;
$fisicalCoolDown = $stats['CSpeed'];
switch($skill['nivel'])
{
	case 1:
		$ataque_player = $stats['AtaqueMagico']*3+100;
		$heal=($stats['soulAcumulate']*intval($pj['nivel']/4));
	break;
	case 2:
		$ataque_player = $stats['AtaqueMagico']*4+200;
		$heal=($stats['soulAcumulate']*intval($pj['nivel']/2));
	break;
}


if($stats['DrainDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['DrainDmg']);
if($stats['drainCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);
if($stats['soulInside']==1)
{
	$mixedid = intval($check['idInMundo']);
	if($_SESSION['target']==$mixedid)
		$stats['SIAcumulate']++;
	else
		$stats['SIAcumulate']=0;
				
	if($stats['SIAcumulate']>3)
		$stats['SIAcumulate']=3;
	$db->sql_query("UPDATE aura SET acumuleitor = ".$stats['SIAcumulate']."  WHERE idAura = '".$stats['SIAuraId']."'");
	$data['aura'][] = array("idSkill"=>22,"lvl"=>1,"auraTimeOut"=>$stats['SIAcumulate'],"pasive"=>1);
		$data['auraRowCheck']=true;	
	switch($stats['SIAcumulate'] )
	{
		case 1:
			$ataque_player = potenciar($ataque_player,15);
		break;
		case 2:
			$ataque_player = potenciar($ataque_player,25);
		break;
		case 3:
			$ataque_player = potenciar($ataque_player,35);
		break;
	}
	$_SESSION['target']=$mixedid;
}
$critical_chanse = mt_rand(1,100);
if($stats['CriticoMagico'] > $critical_chanse)
{
	$ataque_player = critical($ataque_player,$stats['PCMagico']);
	$criticolo=1;
}
else
{
	$ataque_player = normal($ataque_player);
	$criticolo=0;
}

$defensa = penetration($monster['DefensaMagica'],$stats['MagicPenetration']);
$monsterVida=($monsterVida-defensa($ataque_player,$defensa));														

if($criticolo==1)
{
	/// THE EVIL START
	if($stats['AwakingEvil']==1)
	{
		switch($stats['AwakingEvilLevel'])
		{
			case 1:
			$query = 'SELECT idAura,idSkill
			FROM aura
			WHERE idPersonaje = '.$log->get("pjSelected").' AND timeOut > '.$now.' AND idSkillReal = 96 LIMIT 0,1';
			$evil = $db->sql_fetchrow($db->sql_query($query));
			if($evil)
			{
				$db->sql_query("DELETE FROM aura WHERE idAura = '".$evil['idAura']."'");
				switch($evil['idSkill'])
				{
					case 161:
						$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","162","0",96,'.($now+120).')');
						$data['aura'][] = array("idSkill"=>96,"lvl"=>2,"auraTimeOut"=>120,"pasive"=>0);
					break;
					case 162:
						$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","163","0",96,'.($now+120).')');
						$data['aura'][] = array("idSkill"=>96,"lvl"=>3,"auraTimeOut"=>120,"pasive"=>0);
					break;
					case 163:
						$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","163","0",96,'.($now+120).')');
						$data['aura'][] = array("idSkill"=>96,"lvl"=>3,"auraTimeOut"=>120,"pasive"=>0);
					break;
				}
			}
			else
			{
					$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","161","0",96,'.($now+120).')');
						$data['aura'][] = array("idSkill"=>96,"lvl"=>1,"auraTimeOut"=>120,"pasive"=>0);
			}
			break;
			case 2:
			$query = 'SELECT idAura,idSkill
			FROM aura
			WHERE idPersonaje = '.$log->get("pjSelected").' AND timeOut > '.$now.' AND idSkillReal = 97 LIMIT 0,1';
			$evil = $db->sql_fetchrow($db->sql_query($query));
			if($evil)
			{
				switch($evil['idSkill'])
				{
					case 164:
						insertBuff($pj['idPersonaje'],165,97,120);	
							
						$data['aura'][] = array("idSkill"=>97,"lvl"=>2,"auraTimeOut"=>120,"pasive"=>0);
					break;
					case 165:
						insertBuff($pj['idPersonaje'],166,97,120);	
						$data['aura'][] = array("idSkill"=>97,"lvl"=>3,"auraTimeOut"=>120,"pasive"=>0);
					break;
					case 166:
						insertBuff($pj['idPersonaje'],166,97,120);	
						$data['aura'][] = array("idSkill"=>97,"lvl"=>3,"auraTimeOut"=>120,"pasive"=>0);
					break;
				}
			}
			else
			{
							insertBuff($pj['idPersonaje'],164,97,120);	
						$data['aura'][] = array("idSkill"=>97,"lvl"=>1,"auraTimeOut"=>120,"pasive"=>0);
			}	
			break;
		}
		$data['auraRowCheck']=true;	
	}
	/// THE EVIL END
	$heal=$heal*2;
	$data['info'] .= textoAtaque(6,$skill['nombre'],defensa($ataque_player,$defensa),$heal);
	$pvpInfo .= textoAtaque(6,$skill['nombre'],defensa($ataque_player,$defensa),$heal);
}
else
{
	
	$data['info'] .= textoAtaque(5,$skill['nombre'],defensa($ataque_player,$defensa),$heal);
	$pvpInfo .= textoAtaque(5,$skill['nombre'],defensa($ataque_player,$defensa),$heal);
}
$vidaModifier = $vidaModifier+$heal;
$heal=0;
//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>
