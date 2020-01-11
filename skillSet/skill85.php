<?php
$data['animation']=1;
$ataque_player=1;
///Blooddd
switch($skill['nivel'])
{
	case 1:
		$ataque_player = $stats['Ataque']*3;
	break;
	case 2:
		$ataque_player = $stats['Ataque']*4;
	break;
	case 3:
		$ataque_player = $stats['Ataque']*5;
	break;
}

if($stats['BloodBlastDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['BloodBlastDmg']);


if($stats['noCdBloodBlast'])
	$skill['cooldown']=1;

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
if($stats['Critico'] > $critical_chanse OR $forceAssesination)
{
	if($stats['assesination']==1)
	{
		mt_srand((double)microtime()*1000000);
		$asscnac = mt_rand(1,100);
		if($stats['asses_chance']>$asscnac OR $forceAssesination)
		{
			$ataque_player=$ataque_player+200;
			$data['info'] .= "(Assassination) ";
		}
	}
	$ataque_player = critical($ataque_player,$stats['PC']*2);
	$criticolo=1;
}
else
{
	$ataque_player = normal($ataque_player);
	$criticolo=0;
}
          $sangre = 20;
                                                            if($stats['SedSangre']==1 AND !$stats['bloodLord'])
                                                           {
                                                                 if($stats['sangreOn']==1)
								{
									$result = intval($stats['sangreAcumulate']+$sangre);
									$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['sangreAuraId']."'");
									$data['aura'][] = array("idSkill"=>182,"lvl"=>1,"auraTimeOut"=>$result,"pasive"=>1);
									$data['auraRowCheck']=true;	
								}
                                                                else
                                                                {
                                                                      $result = $sangre;
                                                                      $db->sql_query("DELETE FROM aura WHERE idSkillReal = 182 AND idPersonaje = '".$log->get("pjSelected")."' ");
								     $db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal) 
									VALUES("'.$log->get("pjSelected").'",322,"1",182)'); 
                                                                 }
                                                                 $data['aura'][] = array("idSkill"=>182,"lvl"=>1,"auraTimeOut"=>$result,"pasive"=>1);
								 $data['auraRowCheck']=true;
                                                          }
                                                           
$defensa = $monster['Defensa'];
$monsterVida=($monsterVida-defensa($ataque_player,$defensa));	
$danoFinalPuro = defensa($ataque_player,$defensa);

if(!$stats['noBloodDamage'])
{
    $danoReturn = intval($danoFinalPuro/4);
    if($danoReturn>1000)
          $danoReturn=1000;
	$vidaModifier = $vidaModifier-$danoReturn;
    if($vidaModifier<0)
	$vidaModifier=1;	
}
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

if(!$stats['noBloodDamage'])
$data['info'] .= "<br>".$danoReturn." de daño a ti mismo";
//////////////////////////////////////////////////

?>