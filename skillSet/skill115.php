<?php
//Agresion
$data['animation']=2;
		switch($check['tipo'])
		{
			default:
				$data['info'] .= $skill['nombre']." can't be used";
			break;
			case 1:
				$query = 'SELECT a.*, s.nombre, s.nivel
					FROM aura a, skill s
					WHERE a.static=0 AND a.timeOut > '.$now.' AND a.idPersonaje = "'.$monster['PJID'].'" AND a.idSkill = s.idSkill
					AND a.idSkillReal != 100 AND a.idSkillReal != 147 AND a.idSkillReal !=  102';
				$buffsq = $db->sql_query($query);
			
				$buff = $db->sql_fetchrow($buffsq);
				if($buff)
				{
					$db->sql_query("UPDATE aura SET idPersonaje='".$pj['idPersonaje']."'  WHERE idAura = '".$buff['idAura']."'");
					$data['aura'][] = array("idSkill"=>$buff['idSkillReal'],"lvl"=>$buff['nivel'],"auraTimeOut"=>($buff['timeOut']-$now),"pasive"=>0);
					$data['auraRowCheck']=true;	
					$pvpInfo .= " te robo ".$buff['nombre']." ";
					$data['info'] .= "Usaste ".$skill['nombre']." robaste ".$buff['nombre']." buff ";
				}
				else
				{
					$pvpInfo .= "fail penetration!";
					$data['info'] .= "Usaste ".$skill['nombre']." el objetivo no tiene buffs ";
				}
			break;
		}
$MonsterAttackAproval=false;
?>
