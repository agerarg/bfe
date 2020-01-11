<?php
$data['animation']=3;
$data['customAnimation']="YF2XFw3";
$data['custAW']=391;
$data['custAH']=289;
$fisicalCoolDown = 3;
$idSkillReal=212;
$idPersonaje=$pj['idPersonaje'];
$idSkill=358;
$now = tiempoReal();
$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$idSkillReal."' AND idPersonaje = ".$idPersonaje."");

$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut,acumuleitor) 
VALUES("'.$idPersonaje.'","'.$idSkill.'","1","'.$idSkillReal.'",3,3)');	
	
	
$data['aura'][] = array("idSkill"=>212,"lvl"=>1,"auraTimeOut"=>3,"pasive"=>1);
$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);

$MonsterAttackAproval=false;
?>
