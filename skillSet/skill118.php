<?php
$data['animation']=0;
$fisicalCoolDown = 1;
$buffTime = 30;
if($stats['UltimateDefenseTime'])
$buffTime = $buffTime+($stats['UltimateDefenseTime']*10);

switch($skill['nivel'])
{
	case 1:
		insertBuff($pj['idPersonaje'],198,118,$buffTime);
	break;
	case 2:
		insertBuff($pj['idPersonaje'],199,118,$buffTime);
	break;
}
$data['aura'][] = array("idSkill"=>118,"lvl"=>$skill['nivel'],"auraTimeOut"=>$buffTime,"pasive"=>0);
$data['info'] .= textoAtaque(3,$skill['nombre']);
	$data['auraRowCheck']=true;	

if($stats['MaestruliOn'])
	$skill['cooldown']=intval($skill['cooldown']/2);
$MonsterAttackAproval=false;
?>
