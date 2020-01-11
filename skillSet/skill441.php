<?php

$data['animation']=1;
$skill_id=0;
$data['info'] .= "Uso ".$skill['nombre'];
$data['animation']=0;
$fisicalCoolDown = 1;

if(intval($_SESSION['Cleric_Pro'])>0)
{
	switch($_SESSION['Cleric_Pro'])
	{
		case 1:
			$skillid=596;
			$skillreal=440;
			$name = "Prophecy of Hope";
		break;
		case 2:
			$skillid=595;
			$skillreal=439;
			$name = "Prophecy of Doom";
		break;
		case 3:
			$skillid=594;
			$skillreal=438;
			$name = "Prophecy of Violence";
		break;
	}
	unset($_SESSION['Cleric_Pro']);
	$db->sql_query("DELETE FROM aura WHERE idPersonaje = '".$pj['idPersonaje']."' 
				AND (idSkillReal = 440 OR idSkillReal = 439 OR idSkillReal = 438)");
	$duration = 120;
	insertBuff($pj['idPersonaje'],$skillid,$skillreal,$duration);
	$data['info'] .= textoAtaque(3,$name);

	$data['aura'][] = array("idSkill"=>440,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
	$data['aura'][] = array("idSkill"=>439,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
	$data['aura'][] = array("idSkill"=>438,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);

	$data['aura'][] = array("idSkill"=>$skillreal,"lvl"=>1,"auraTimeOut"=>$duration,"pasive"=>0);
	$data['auraRowCheck']=true;	

}
else
{
	$data['info'] .= " No hay Prophecy ";
}

		
$MonsterAttackAproval=false;

?>
