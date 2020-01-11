<?php
//BOW SKILL
if($stats['DobleShotCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);
	$data['animation']=1;

	switch($skill['nivel'])
	{
		case 1:
			$ataque_player = intval($stats['Ataque']*1.5) + 200 + $stats['SkillDmg'];
			if($stats['DobleShotDmg']>0)
				$ataque_player=potenciar($ataque_player,$stats['DobleShotDmg']);		
		break;
	}
	//// Critical City
	if($stats['critCityShitOn']==1)
		{
			if($stats['critCityAcumulate']>=$stats['critCityLimit'])
				{
					$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['critCityAuraId']."'");
	$data['aura'][] = array("idSkill"=>39,"lvl"=>$skill['nivel'],"auraTimeOut"=>0,"pasive"=>1);
		$data['auraRowCheckPasive']=true;	
					$stats['Critico']=100;
					$stats['PC']=$stats['PC']+25;
					$data['info'] .= "(CC) ";
					$changeEverything=1;					
				}
		}	
	
	if($monster['ShieldRate']>0)
	{
		mt_srand((double)microtime()*1000000);
		$shield_chanse = mt_rand(1,100);
		if($monster['ShieldRate'] > $shield_chanse)
		{
			$monster['Defensa'] = $monster['Defensa'] + $monster['shieldDef'];
			$blockdata = "(Block)";
		}
	}
	
	mt_srand((double)microtime()*1000000);
	$critical_chanse = mt_rand(1,100);

	if($stats['Critico'] > $critical_chanse)
	{
		$ataque_playerTemp = critical($ataque_player,$stats['PC']);
		$criticolo=1;
	}
	else
	{
		$ataque_playerTemp = normal($ataque_player);
		$criticolo=0;
	}
	
	$defensa = $monster['Defensa'];
	$monsterVida=($monsterVida-defensa($ataque_playerTemp,$defensa));														
	if($criticolo==1)
	{
		$data['info'] .= 
		textoAtaque(2,$skill['nombre'],defensa($ataque_playerTemp,$defensa)).$blockdata;
		$pvpInfo .= 
		textoAtaque(2,$skill['nombre'],defensa($ataque_playerTemp,$defensa)).$blockdata;
	}
	else
	{
		$data['info'] .= 
		textoAtaque(1,$skill['nombre'],defensa($ataque_playerTemp,$defensa)).$blockdata;
		$pvpInfo .= 
		textoAtaque(1,$skill['nombre'],defensa($ataque_playerTemp,$defensa)).$blockdata;
	}

	//-----------------------------------------------------------------------------------------------------------------//
	//$ataque_player = $stats['Ataque'] + $stats['SkillDmg'];
	if($monster['ShieldRate']>0)
	{
		mt_srand((double)microtime()*1000000);
		$shield_chanse = mt_rand(1,100);
		if($monster['ShieldRate'] > $shield_chanse)
		{
			$monster['Defensa'] = $monster['Defensa'] + $monster['shieldDef'];
			$blockdata = "(Block)";
		}
	}
	
	mt_srand((double)microtime()*1000000);
	$critical_chanse = mt_rand(1,100);

	if($stats['Critico'] > $critical_chanse)
	{
		$ataque_player = critical($ataque_player,$stats['PC']);
		$criticolo=1;
	}
	else
	{
		$ataque_player = normal($ataque_player);
		$criticolo=0;
	}
	
	$defensa = $monster['Defensa'];
	$monsterVida=($monsterVida-defensa($ataque_player,$defensa));														
	if($criticolo==1)
	{
		$data['info'] .= " y critico de ".
		optimalDmg(defensa($ataque_player,$defensa)).$blockdata;
		$pvpInfo .= 
		" y critico de".optimalDmg(defensa($ataque_player,$defensa)).$blockdata;
	}
	else
	{
		$data['info'] .= 
		" y ".optimalDmg(defensa($ataque_player,$defensa)).$blockdata;
		$pvpInfo .= 
		" y ".optimalDmg(defensa($ataque_player,$defensa)).$blockdata;
	}


	///////////////////////////////	

//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa)+defensa($ataque_playerTemp,$defensa);
?>
