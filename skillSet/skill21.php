<?php

//DooM
$ataque_player=1;
$fisicalCoolDown = $stats['CSpeed'];
$per= intval(($vidaModifier * 100) / $stats['VidaLimit']);

$reverse = 100-$per;
if($stats['Drumar'])
	$reverse = 100-$reverse;
$stats['CriticoMagico']=1000;

if($stats['GuantesFlaringg'])
	$skill['cooldown']=($skill['cooldown']/2);
switch($skill['nivel'])
{
	case 1:
		$ataque_player = $stats['AtaqueMagico']+($stats['AtaqueMagico'])*$reverse;
	break;
	case 2:
		$ataque_player = $stats['AtaqueMagico']+($stats['AtaqueMagico']*2)*$reverse;
	break;
}

if($stats['DoomDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['DoomDmg']);

if($stats['soulInside']==1)
{
	$mixedid = intval($check['idInMundo']);
	if($_SESSION['target']==$mixedid)
		$stats['SIAcumulate']++;
	else
		$stats['SIAcumulate']=0;
				
	if($stats['SIAcumulate']>3)
		$stats['SIAcumulate']=3;
	$db->sql_query("UPDATE aura SET acumuleitor = ".$stats['SIAcumulate']."  WHERE idAura = '".$stats['SIAuraId']."'");
	$data['aura'][] = array("idSkill"=>22,"lvl"=>1,"auraTimeOut"=>$stats['SIAcumulate'],"pasive"=>1);
		$data['auraRowCheck']=true;	
	switch($stats['SIAcumulate'] )
	{
		case 1:
			$ataque_player = potenciar($ataque_player,15);
		break;
		case 2:
			$ataque_player = potenciar($ataque_player,25);
		break;
		case 3:
			$ataque_player = potenciar($ataque_player,35);
		break;
	}
	$_SESSION['target']=$mixedid;
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

	$data['info'] .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$defensa));
	$pvpInfo .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$defensa));
}
else
{
	$data['info'] .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa));
	$pvpInfo .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa));
}
//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>
