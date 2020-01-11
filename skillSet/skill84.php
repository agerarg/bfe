<?php
$data['animation']=2;
$ataque_player=1;
$data['info'] .= textoAtaque(3,$skill['nombre']);

$vidaModifier = $vidaModifier-1000;
if($vidaModifier<0)
 $vidaModifier=1;

$duration = 600;
if($stats['blackBloodTime'])
	$duration=$duration*2;
$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","'.$skill['idSkill'].'","0",84,'.($now+$duration).')');
														
$data['aura'][] = array("idSkill"=>84,"lvl"=>$skill['nivel'],"auraTimeOut"=>$duration,"pasive"=>0);
$data['auraRowCheck']=true;	
$MonsterAttackAproval=false;
?>
