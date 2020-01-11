<?php
$data['animation']=0;
$fisicalCoolDown = 1;
	insertBuff($pj['idPersonaje'],354,208,120);
$data['aura'][] = array("idSkill"=>208,"lvl"=>1,"auraTimeOut"=>120,"pasive"=>0);
$data['auraRowCheck']=true;	
$data['info'] .= textoAtaque(3,$skill['nombre']);
$data['aura'][] = array("idSkill"=>206,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
$data['aura'][] = array("idSkill"=>207,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
$db->sql_query("DELETE FROM aura WHERE idPersonaje = ".$pj['idPersonaje']."
								 AND (idSkillReal = 206 OR idSkillReal = 207)");
$MonsterAttackAproval=false;
?>