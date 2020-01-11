<?php
$data['animation']=0;
$fisicalCoolDown = 1;

$duration = 120;
if($stats['ritualTime'])
$duration = 360;

insertBuff($pj['idPersonaje'],236,144,$duration);
$data['info'] .= textoAtaque(3,$skill['nombre']);

$data['aura'][] = array("idSkill"=>144,"lvl"=>1,"auraTimeOut"=>$duration,"pasive"=>0);

	$data['auraRowCheck']=true;	
		
$MonsterAttackAproval=false;
?>