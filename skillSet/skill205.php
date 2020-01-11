<?php
$data['animation']=1;
$ataque_player=1;

$query = 'SELECT count(*) as CONTA
				FROM aura
				WHERE idPersonaje = '.$pj['idPersonaje'].' AND static = 0 ';
$auracsq = $db->sql_query($query);
$auraC = $db->sql_fetchrow($auracsq);
$buferino = intval($auraC['CONTA']);

if($stats['BufferinoDmg']>0)
	$stats['Ataque']=potenciar($stats['Ataque'],$stats['BufferinoDmg']);

if($buferino>5)
	$buferino=5;

switch($skill['nivel'])
{
	case 1:
		$ataque_player = $stats['Ataque']+intval($stats['Ataque']*($buferino/2));
	break;
	case 2:
		$ataque_player = $stats['Ataque']+intval($stats['Ataque']*$buferino);
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

$defensa = penetration($monster['Defensa'],$stats['ArmorPenetration']);
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
