<?php

$ataque_player=1;
$Proct=false;
if($stats['LifeDrainInsta'])
{
	$fisicalCoolDown = 3;
	$db->sql_query("DELETE FROM aura WHERE idAura = '".$stats['ShamanFreeID']."'");
	$data['aura'] = array("idSkill"=>169,"lvl"=>1,"auraTimeOut"=>1);
	$data['auraCheck']=true;
	$skill['cooldown']=1;
	$Proct=true;
}
else
$fisicalCoolDown = $stats['PSpeed'];

if($stats['LifeDrainCd']==1)
	$skill['cooldown']=intval($skill['cooldown']/2);

switch($skill['nivel'])
{
	case 1:
		$ataque_player = intval($stats['Ataque']*3)+25;
		$heal=intval($stats['Ataque']*1.3)+50;
	break;
	case 2:
		$ataque_player = intval($stats['Ataque']*4)+35;
		$heal=intval($stats['Ataque']*1.6)+50;
	break;
	case 3:
		$ataque_player = intval($stats['Ataque']*5)+50;
		$heal=intval($stats['Ataque']*2)+50;
	break;
}
if($Proct)
	$ataque_player=$ataque_player*3;

if($stats['LifeDrainDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['LifeDrainDmg']);

$critical_chanse = mt_rand(1,100);
if($stats['Critico'] > $critical_chanse)
{
	$ataque_player = critical($ataque_player,$stats['PC']);
	$heal = critical($heal,$stats['PC']);
	$criticolo=1;
}
else
{
	$ataque_player = normal($ataque_player);
	$criticolo=0;
}

$defensa = penetration($monster['Defensa'],$stats['ArmorPenetration']);
if($heal>3000)
$heal=6000;
$monsterVida=($monsterVida-defensa($ataque_player,$defensa));														

if($criticolo==1)
{
	$data['info'] .= textoAtaque(6,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata),$heal);
	$pvpInfo .= textoAtaque(6,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata),$heal);
}
else
{
	$data['info'] .= textoAtaque(5,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata),$heal);
	$pvpInfo .= textoAtaque(5,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata),$heal);
}

$vidaModifier = $vidaModifier+$heal;
$heal=0;
//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>
