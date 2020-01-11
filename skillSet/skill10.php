<?php
//Return
$data['animation']=0;
$fisicalCoolDown = 1;
$ataque_player=1;
switch($skill['nivel'])
{
	case 1:
		$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","21","0",10,'.($now+600).')');
														
		$data['aura'] = array("idSkill"=>10,"lvl"=>$skill['nivel'],"auraTimeOut"=>600);
		$data['auraCheck']=true;
	break;
	case 2:
		$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal,timeOut) 
							VALUES("'.$log->get("pjSelected").'","22","0",10,'.($now+600).')');
														
		$data['aura'] = array("idSkill"=>10,"lvl"=>$skill['nivel'],"auraTimeOut"=>600);
		$data['auraCheck']=true;
	break;
}												

if($stats['ReturnCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);
$data['info'] .= textoAtaque(3,$skill['nombre']);
?>
