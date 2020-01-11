<?php

$ataque_player=1;
$fisicalCoolDown = $stats['CSpeed'];
$idSkillReal=20;
$idPersonaje=$pj['idPersonaje'];
$idSkill=39;
if(!$stats['soulCannonCount'])
{
	$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut,acumuleitor) 
VALUES("'.$idPersonaje.'","'.$idSkill.'","1","'.$idSkillReal.'",1,1)');	
$result=1;
}
else
{
	$result = $stats['soulCannonAcc']+1;
	if($result>3)
		$result=3;
	if($result==0)
		$result=1;
		
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['soulCannonId']."'");
}
$data['aura'][] = array("idSkill"=>20,"lvl"=>1,"auraTimeOut"=>$result,"pasive"=>1);
$data['auraRowCheck']=true;	
switch($skill['nivel'])
{
	case 1:
		$ataque_player = 100 + $stats['AtaqueMagico']*2 + $stats['soulAcumulate']*1;
	break;
	case 2:
		$ataque_player = 100 + $stats['AtaqueMagico']*4 + $stats['soulAcumulate']*2;
	break;
	case 3:
		$ataque_player = 100 + $stats['AtaqueMagico']*8 + $stats['soulAcumulate']*3;
	break;
	case 4:
		$ataque_player = 100 + $stats['AtaqueMagico']*16 + $stats['soulAcumulate']*4;
	break;
}
if($stats['SoulCannonDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['SoulCannonDmg']);
//soul cannon
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



mt_srand((double)microtime()*1000000);
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

$defensa = $monster['DefensaMagica'];
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
	$data['info'] .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$defensa));
	$pvpInfo .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$defensa));
}
else
{
	$data['info'] .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa));
	$pvpInfo .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa));
}
//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>
