<?php
$data['animation']=2;
$fisicalCoolDown = $stats['CSpeed'];
$MonsterAttackAproval=false;
if($stats['miracleCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);
if($stats['faithAuraId']>0)
{
	$result = 10;
	$data['aura'][] = array("idSkill"=>134,"lvl"=>1,"auraTimeOut"=>$result,"pasive"=>1);
	$data['auraRowCheck']=true;	
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['faithAuraId']."'");
}
	$db->sql_query("UPDATE skilllearn SET cooldownCurrent = 1  WHERE idPersonaje = '".$pj['idPersonaje']."'");
	$data['recetSkillCd']=1;
	$data['bicho']=$check['idInMundo'];
	$data['mund']=$check['id'];
	$data['info'] .= "".$skill['nombre']."";
//////////////////////////////////////////////////
$danoFinalPuro = 0;
?>
