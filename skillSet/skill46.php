<?php
//BOW SKILL
	switch($skill['nivel'])
	{
		case 1:
			$ataque_player = $stats['Ataque'] + $stats['SkillDmg'];
		break;
	}
	//// Critical City
	if($stats['critCityShitOn']==1)
		{
			if($stats['critCityAcumulate']>=$stats['critCityLimit'])
				{
					$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['critCityAuraId']."'");
	$data['aura'][] = array("idSkill"=>39,"nombre"=>"Critical City",
	"imagen"=>"marksman/criticalcity.jpg","auraTimeOut"=>0,"pasive"=>1);
		$data['auraRowCheckPasive']=true;	
					$stats['Critico']=100;
					$stats['PC']=$stats['PC']+25;
					$data['info'] .= "(DD) ";
					$changeEverything=1;
				}
		}
if($changeEverything==1)
		$result = intval($stats['arrowAcumulate']-1);
	else
		$result = intval($stats['arrowAcumulate']-2);

		
mt_srand((double)microtime()*1000000);
		$lucky_chanse = mt_rand(1,100);
		if(20 > $lucky_chanse)
		{
			$result=mt_rand(1,5);	
			$data['info'] .= "(DD) ";
			if($changeEverything)
			{
				$data['info'] .= "(+DROP) ";
				$stats['forceSomeDrop']=1;
			}
		}

	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['arrowAuraId']."'");
	
	$data['aura'][] = array("idSkill"=>49,"nombre"=>"Arrow Allow","imagen"=>"marksman/savearrow.jpg","auraTimeOut"=>$result,"pasive"=>1);
	$data['auraRowCheck']=true;	

//	
	
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
	$data['info'] .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata));
	$pvpInfo .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata));
}
else
{
	$data['info'] .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata));
	$pvpInfo .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata));
}

//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>
