<?php
$fisicalCoolDown = 1;
$data['animation']=0;
$healdat = intval(($stats['VidaLimit']/10)*3);
$data['info'] .=textoAtaque(7,$skill['nombre'],$healdat);
$vidaModifier = $vidaModifier+$healdat;

$MonsterAttackAproval=false;

?>
