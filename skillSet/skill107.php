<?php
$data['animation']=0;

$fisicalCoolDown = 1;
$buffTime = 120;
if(mt_rand(1,10)==5)
	$buffTime=600;

switch($skill['idSkill'])
{
	case 180:
		insertBuff($pj['idPersonaje'],180,107,$buffTime);
		$level = 1;
	break;
	case 181:
		insertBuff($pj['idPersonaje'],181,107,$buffTime);
		$level = 2;
	break;
}


if($stats['DestructionCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);
$data['aura'][] = array("idSkill"=>107,"lvl"=>$level,"auraTimeOut"=>$buffTime,"pasive"=>0);
	$data['auraRowCheck']=true;	
		
$data['info'] .= textoAtaque(3,$skill['nombre']);
$MonsterAttackAproval=false;
?>
