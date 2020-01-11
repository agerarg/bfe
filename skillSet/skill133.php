<?php

$ataque_player=1;
$fisicalCoolDown = $stats['CSpeed'];
if($stats['SET_holywarrior'])
{
	$stats['AtaqueMagico']=$stats['Ataque'];
	$monster['DefensaMagica']=$monster['Defensa'];
	$stats['MagicPenetration']=0;
	$stats['CriticoMagico']=$stats['Critico'];
	$stats['PCMagico']=$stats['PC'];
}
switch($skill['nivel'])
{
	case 1:
		$stats['faithAcumulate']=intval($stats['faithAcumulate']);
		$ataque_player = intval($stats['AtaqueMagico']*125)+(200*$stats['faithAcumulate']);
		$ataque_player=potenciar($ataque_player,10+(10*$stats['faithAcumulate']));
	break;
}


if($stats['HolyWrathDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['HolyWrathDmg']);
///Fait
if($stats['faithAcumulate']>0)
{
	$result = 0;
	$data['aura'][] = array("idSkill"=>134,"lvl"=>1,"auraTimeOut"=>$result,"pasive"=>1);
	$data['auraRowCheck']=true;	
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['faithAuraId']."'");
}
$critical_chanse = mt_rand(1,100);

if($stats['CriticoMagico'] > $critical_chanse || $stats['ClericHolyWrath'])
{
	if($stats['ClericHolyWrath'])
		$ataque_player+=$ataque_player;
	$ataque_player = critical($ataque_player,$stats['PCMagico']);
	$heal = critical($heal,$stats['PCMagico']);
	$criticolo=1;
}
else
{
	$ataque_player = normal($ataque_player);
	$criticolo=0;
}

$defensa = penetration($monster['DefensaMagica'],$stats['MagicPenetration']);
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
