<?php
$data['animation']=0;
$fisicalCoolDown = 1;
$MonsterAttackAproval=false;
$heal=0;

$heal = intval(($stats['VidaLimit']/100)*20);
$vidaModifier += $heal;
$data['info'] .= textoAtaque(7,$skill['nombre'],$heal);
//////////////////////////////////////////////////
$danoFinalPuro = 0;
?>
