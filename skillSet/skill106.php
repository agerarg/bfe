<?php
$data['animation']=0;
$fisicalCoolDown = 1;

$buffTime = 120;
if($stats['RampageTime'])
	$buffTime = $buffTime+($stats['RampageTime']*60);

switch($skill['nivel'])
{
	case 1:
		insertBuff($pj['idPersonaje'],178,106,600);
	break;
	case 2:
		insertBuff($pj['idPersonaje'],179,106,600);
	break;
}

$data['aura'][] = array("idSkill"=>106,"lvl"=>$skill['nivel'],"auraTimeOut"=>600,"pasive"=>0);
	$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);


if($stats['RampageCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);

$MonsterAttackAproval=false;
?>
