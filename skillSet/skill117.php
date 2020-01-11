<?php
//shield Slam
if($stats['perSnowBall']==1)
{
	$mixedid = intval($check['idInMundo']+$check['idPersonaje']);
	if($mixedid == $_SESSION['PerSnowId'])
	{
		$stats['Ataque']+=$_SESSION['PerSnowDmg'];
	}
	else
	{
		$data['auraRowCheck']=true;	
		$data['aura'][] = array("idSkill"=>192,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>1);
		$_SESSION['PerSnowDmg']=0;
		$_SESSION['PerSnowAcu']=0;
		$_SESSION['PerSnowId']=$mixedid;
	}
}

if($stats['ShieldRate']>0)
{
	$stats['Ataque'] = $stats['Ataque'] + 50 + (($stats['Defensa']+$stats['DefensaMagica'])*2);
	
	mt_srand((double)microtime()*1000000);
	$critical_chanse = mt_rand(1,100);
	if($stats['Critico'] > $critical_chanse)
	{
		$ataque_player = critical($stats['Ataque'],$stats['PC']);
		$criticolo=1;
	}
	else
	{
		$ataque_player = normal($stats['Ataque']);
		$criticolo=0;
	}
	$defensa = $monster['Defensa'];
	$monsterVida=($monsterVida-defensa($ataque_player,$defensa));														
	
$chanceInterrupt = 50 - $monster['resistInterrupt'];
	
if($monster['raidSkillready']==1)
				{
					$stunGoingOn=1;					
					if($pj['party']>0)
						systemLog("party",'<spam class='."'itruptFailWin'".'>'.$pj['nombre'].' Shield Slam '.$monster['nombre'].'</spam>');
					else
						systemLog("self",'<spam class='."'itruptFailWin'".'>Shield Slam a '.$monster['nombre'].'!</spam>');
						
					if($multyTarget==0)
					{	
					$db->sql_query("UPDATE inmundo SET  attackCooldown=".($now+30).", raidSkillready = 0 WHERE idInMundo = '".$check['idInMundo']."'");
					}
					else
					{
						$db->sql_query('UPDATE inmundo im SET  attackCooldown='.($now+30).', raidSkillready = 0 WHERE 
												(im.idInMundo = "'.$id.'" OR im.idInMundo = "'.$id2.'" OR im.idInMundo = "'.$id3.'" OR im.idInMundo = "'.$id4.'" OR im.idInMundo = "'.$id5.'")');
					}
					
				}
				else
				{
					systemLog("self",'<spam class='."'itruptFail'".'>Shield Slam fallo el mousntro no estaba casteando nada</spam>');
				}													
	//////////////////////////////////////////////////
	$danoFinalPuro = defensa($ataque_player,$defensa);
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

}
else
{
	$data['info'] .= $skill['nombre']." fallo! necesitas tener un escudo";
}
?>
