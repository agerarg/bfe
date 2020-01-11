<?php
$data['animation']=0;
$fisicalCoolDown = 1;

$duration = 600;
insertBuff($pj['idPersonaje'],526,376,$duration);
$data['info'] .= textoAtaque(3,$skill['nombre']);

$data['aura'][] = array("idSkill"=>376,"lvl"=>1,"auraTimeOut"=>$duration,"pasive"=>0);

	$data['auraRowCheck']=true;	
		
$MonsterAttackAproval=false;
?>