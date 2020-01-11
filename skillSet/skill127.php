<?php

$ataque_player=1;
$fisicalCoolDown = $stats['CSpeed'];

if($stats['faithAcumulate'])
	$faitImprover=1+$stats['faithAcumulate'];
else
	$faitImprover=1;

switch($skill['nivel'])
{
	case 1:
		$ataque_player = intval($stats['AtaqueMagico']*$faitImprover)+100;
	break;
	case 2:
		$ataque_player = intval($stats['AtaqueMagico']*($faitImprover*2))+300;
	break;
	case 3:
		$ataque_player = intval($stats['AtaqueMagico']*($faitImprover*4))+50;
	break;
}

if($stats['SmiteDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['SmiteDmg']);
	
	
///Fait
if($stats['faithAcumulate']>0)
{
	$data['info'] .= "(Faith)";
	$ataque_player=potenciar($ataque_player,10+(10*$stats['faithAcumulate']));
	if(!$stats['noFaith'])
	{
		$result = ($stats['faithAcumulate']+1);
		if($result>=10)
			$result=10;
		$data['aura'][] = array("idSkill"=>134,"lvl"=>1,"auraTimeOut"=>$result,"pasive"=>1);
		$data['auraRowCheck']=true;	
		$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['faithAuraId']."'");
	}
}
$critical_chanse = mt_rand(1,100);
if($stats['CriticoMagico'] > $critical_chanse)
{
	$ataque_player = critical($ataque_player,$stats['PCMagico']);
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
