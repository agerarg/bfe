<?php

	$data['animation']=1;
	switch($skill['nivel'])
	{
		case 1:
			$ataque_player = intval($stats['Ataque']*1.5) + 150 + $stats['SkillDmg'];
			$chanceStun=50;
		break;
	}
	
	
if($stats['StunShotDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['StunShotDmg']);
	
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
	///////////////////////////////////////////////////////	
switch($check['tipo'])
		{
			default:
				$stunGoingOn=1;
					$db->sql_query("UPDATE inmundo SET attackCooldown=".($now+20)."  WHERE idInMundo = '".$check['idInMundo']."'");
					$data['info'] .= " [STUN SHOT]";
			break;
			case 1:
				
				$asscnac = mt_rand(1,100);
				if($chanceStun>$asscnac)
				{
					if($pj['party']>0)
							systemLog("party",'<spam class='."'hate'".'>'.$pj['nombre'].' use Stun on <a href='."'?sec=mundo&mundo=".$check['mundo']."&target=".$check['idInMundo']."&bicho'".'>'.$monster['nombre'].'</a></spam>');
						else
							systemLog("self",'<spam class='."'hate'".'>'.$pj['nombre'].' use Stun on <a href='."'?sec=mundo&mundo=".$check['mundo']."&target=".$check['idInMundo']."&bicho'".'>'.$monster['nombre'].'</a></spam>');
					$pvpInfo .= " stun you for 20seg!";
					$data['info'] .= " [successfully]";
					insertBuff($monster['PJID'],207,122,20);
				}
				else
				{
					if($pj['party']>0)
						systemLog("party",'<spam class='."'itruptFail'".'>'.$pj['nombre'].' fail stun on '.$monster['nombre'].'</spam>');
					else
						systemLog("self",'<spam class='."'itruptFail'".'>'.$pj['nombre'].' fail stun on '.$monster['nombre'].'</spam>');
					$pvpInfo .= " fail stun!";
					$fail=1;
					$data['info'] .= " [fail]";	
				}		
				
			break;
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
