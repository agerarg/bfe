<?php

$ataque_player=1;
$fisicalCoolDown = $stats['PSpeed'];
switch($skill['nivel'])
{
	case 1:
		$ataque_player = $pj['Ataque']*2 + intval($stats['VidaLimit']/5)*3;
	break;
	case 2:
		$ataque_player = $pj['Ataque']*2 + intval($stats['VidaLimit']/5)*4;
	break;
}

if($stats['RedStrikeDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['RedStrikeDmg']);
	
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

$defensa = penetration($monster['Defensa'],$stats['ArmorPenetration']);
$monsterVida=($monsterVida-defensa($ataque_player,$defensa));	
if(!$stats['noBloodDamage'])										
    $vidaModifier = $vidaModifier-intval($stats['VidaLimit']/10);
if($vidaModifier<0)
	$vidaModifier=1;

 $sangre = 40;
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
$data['info'] .= "<br>".intval($stats['VidaLimit']/10)." retorno a vos mismo";
//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>
