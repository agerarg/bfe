<?php
$ataque_player=1;
$Proct=false;
if($stats['DarkSpikeInsta'])
{
	$fisicalCoolDown = 3;
	$db->sql_query("DELETE FROM aura WHERE idAura = '".$stats['ShamanFreeID']."'");
	$data['aura'] = array("idSkill"=>171,"lvl"=>1,"auraTimeOut"=>1);
	$data['auraCheck']=true;
	$skill['cooldown']=1;
	$Proct=true;
}
else
$fisicalCoolDown = $stats['PSpeed'];


$mohacumulr=1;


switch($skill['nivel'])
{
	case 1:
		$ataque_player = $stats['Ataque']*6+50;
	break;
	case 2:
		$ataque_player = $stats['Ataque']*8+150;
	break;
}

if($stats['DarkSpikeDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['DarkSpikeDmg']);

if($Proct)
	$ataque_player=$ataque_player*3;	
///////////////////////////////////////////

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
