<?php
$data['animation']=0;
$fisicalCoolDown = 1;
insertBuff($pj['idPersonaje'],527,378,300);
$data['aura'][] = array("idSkill"=>378,"lvl"=>1,"auraTimeOut"=>300,"pasive"=>0);
$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);

$MonsterAttackAproval=false;
?>
