<?php
//Agresion
$data['animation']=2;
		switch($check['tipo'])
		{
			default:
				$data['info'] .= $skill['nombre']." no se puede usar";
			break;
			case 1:
				$db->sql_query("DELETE FROM aura WHERE idPersonaje = ".$monster['PJID']." AND idSkillReal != 147 AND idSkillReal != 102 AND static = 0");
				$pvpInfo .= " Cool Story, Bro ";
				$data['info'] .= "Usaste ".$skill['nombre']."";
			break;
		}
$MonsterAttackAproval=false;
?>
