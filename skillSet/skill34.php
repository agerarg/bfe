<?php
//Magic Barrier
$data['animation']=0;
$fisicalCoolDown = 1;

$ataque_player=1;
$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","64","0",34,'.($now+300).')');
														
		$data['aura'] = array("idSkill"=>34,"lvl"=>$skill['nivel'],"auraTimeOut"=>300);
		$data['auraCheck']=true;
$data['info'] .= textoAtaque(3,$skill['nombre']);
$MonsterAttackAproval=false;

?>
