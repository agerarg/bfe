<?php
$data['animation']=2;
$fisicalCoolDown = $stats['CSpeed'];
$MonsterAttackAproval=false;
$heal=0;

if($stats['groupHealCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);

switch($skill['nivel'])
{
	case 1:
		$heal = intval($stats['AtaqueMagico']*0.8)+500;
	break;
	case 2:
		$heal = intval($stats['AtaqueMagico']*1.2)+1000;
	break;
}

if($stats['GroupHealDmg']>0)
	$heal=potenciar($heal,$stats['GroupHealDmg']);


if($stats['DDHeal'])
	$heal=$heal*2;
///Fait
if($stats['faithAcumulate']>0)
{
	$data['info'] .= "(Faith)";
	$heal=potenciar($heal,20);
	if(!$stats['noFaith'])
	{
	$result = ($stats['faithAcumulate']-1);
	$data['aura'][] = array("idSkill"=>134,"lvl"=>1,"auraTimeOut"=>$result,"pasive"=>1);
	$data['auraRowCheck']=true;	
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['faithAuraId']."'");
	}
}
//////////// HEAL CRITICAL /////////
	$critical_chanse = mt_rand(1,100);
	if($stats['CriticoMagico'] > $critical_chanse)
	{
		$heal = critical($heal,$stats['PCMagico']);
		$criticolo="(Critical)";
	}
	else
	{
		$heal = normal($heal);
	}
//////////// END HEAL CRITICAL /////////
$vidaModifier += $heal;
if($pj['party']>0)
{
	$db->sql_query("UPDATE personaje SET Vida = (Vida+".$heal.")  WHERE party = ".$pj['party']." AND idPersonaje != ".$pj['idPersonaje']."");
				
	$msgs = "<spam class='healSkill'>".$pj['nombre']." curo por ".$heal.$criticolo."!</spam>";
	$data['info'] .= "".$skill['nombre']." curo ".$heal.$criticolo."";
	systemLog("party",$msgs);
}
else
{
	$data['info'] .= "".$skill['nombre']." curo ".$heal.$criticolo."";
}
//////////////////////////////////////////////////
$danoFinalPuro = 0;
?>
