<?php
$data['animation']=1;
$skill_id=0;
$data['info'] .= "Uso ".$skill['nombre'];
$data['animation']=0;
$fisicalCoolDown = 1;

$duration = 300;
insertBuff($pj['idPersonaje'],599,443,$duration);
$data['info'] .= textoAtaque(3,$skill['nombre']);

$data['aura'][] = array("idSkill"=>443,"lvl"=>1,"auraTimeOut"=>$duration,"pasive"=>0);
$data['auraRowCheck']=true;	
		
$MonsterAttackAproval=false;
?>
