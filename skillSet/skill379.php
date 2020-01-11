<?php
$data['animation']=0;
$fisicalCoolDown = 1;
if($stats['CollarTactico'])
	$bufftime=600;
else
	$bufftime=60;
insertBuff($pj['idPersonaje'],528,379,$bufftime);
$data['aura'][] = array("idSkill"=>379,"lvl"=>1,"auraTimeOut"=>$bufftime,"pasive"=>0);
$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);

$MonsterAttackAproval=false;
?>
