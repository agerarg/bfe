<?php
$data['animation']=1;
$fisicalCoolDown = 3;
$idSkillReal=373;
$idPersonaje=$pj['idPersonaje'];
$idSkill=523;
$now = tiempoReal();

if($stats['CollarOcular'])
	$skill['cooldown']=90;

$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$idSkillReal."' AND idPersonaje = ".$idPersonaje."");

$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut,acumuleitor) 
VALUES("'.$idPersonaje.'","'.$idSkill.'","1","'.$idSkillReal.'",5,5)');	
	
	
$data['aura'][] = array("idSkill"=>373,"lvl"=>1,"auraTimeOut"=>5,"pasive"=>1);
$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);

$MonsterAttackAproval=false;
?>
