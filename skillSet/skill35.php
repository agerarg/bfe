<?php
//Focus
$data['animation']=0;
$fisicalCoolDown = 1;
$ataque_player=1;
if($stats['CPeligro'])
	$duration=600;
else
	$duration=120;
switch($skill['nivel'])
{
	case 1:
		$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","65","0",35,'.($now+$duration).')');
														
		$data['aura'] = array("idSkill"=>35,"lvl"=>$skill['nivel'],"auraTimeOut"=>$duration);
		$data['auraCheck']=true;
	break;
	case 2:
		$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","66","0",35,'.($now+$duration).')');
														
		$data['aura'] = array("idSkill"=>35,"lvl"=>$skill['nivel'],"auraTimeOut"=>$duration);
		$data['auraCheck']=true;
	break;
}
$data['info'] .= textoAtaque(3,$skill['nombre']);
$MonsterAttackAproval=false;
?>
