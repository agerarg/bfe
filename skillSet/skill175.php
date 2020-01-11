<?php
$data['animation']=0;
$fisicalCoolDown = 1;

insertBuff($pj['idPersonaje'],312,175,30);
$data['info'] .= textoAtaque(3,$skill['nombre']);

$data['aura'][] = array("idSkill"=>175,"lvl"=>1,"auraTimeOut"=>30,"pasive"=>0);

	$data['auraRowCheck']=true;	
		
$MonsterAttackAproval=false;
?>