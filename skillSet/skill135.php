<?php
$data['animation']=0;

if($stats['SelfInsta'])
	$fisicalCoolDown = 1;
else
	$fisicalCoolDown = $stats['CSpeed'];

$heal= (intval($stats['AtaqueMagico']*0.5)+500);
if($stats['DDHeal'])
	$heal=$heal*2;
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

$data['info'] .= textoAtaque(7,$skill['nombre'],$heal.$criticolo);

$heal=0;
		
$MonsterAttackAproval=false;
?>