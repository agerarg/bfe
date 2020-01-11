<?php
$data['animation']=0;
$fisicalCoolDown = 1;

insertBuff($pj['idPersonaje'],313,176,60);
$data['info'] .= textoAtaque(3,$skill['nombre']);

$data['aura'][] = array("idSkill"=>176,"lvl"=>1,"auraTimeOut"=>120,"pasive"=>0);

	$data['auraRowCheck']=true;	
		
$MonsterAttackAproval=false;
?>