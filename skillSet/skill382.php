<?php
$data['animation']=0;
$fisicalCoolDown = 1;
  $nightTimer=60;
if($stats['SET_counttunic'])
      $nightTimer=300;   

insertBuff($pj['idPersonaje'],531,382,$nightTimer);
$data['aura'][] = array("idSkill"=>382,"lvl"=>1,"auraTimeOut"=>$nightTimer,"pasive"=>0);
$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);

$MonsterAttackAproval=false;
?>
