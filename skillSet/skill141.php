<?php
$data['animation']=0;
$fisicalCoolDown = 1;
//// TOTEM THING

$duration = 300;
if($stats['pumaTotemsTime'])
$duration = 900;
if(!$stats['CTotemico'])
$db->sql_query("DELETE FROM aura WHERE idPersonaje = '".$pj['idPersonaje']."' 
				AND (idSkillReal = 140 OR idSkillReal = 141 OR idSkillReal = 142 OR idSkillReal = 143)");
//////
insertBuff($pj['idPersonaje'],233,141,$duration);
$data['info'] .= textoAtaque(3,$skill['nombre']);

$data['aura'][] = array("idSkill"=>141,"lvl"=>$skill['nivel'],"auraTimeOut"=>$duration,"pasive"=>0);
if(!$stats['CTotemico'])
{
$data['aura'][] = array("idSkill"=>140,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
$data['aura'][] = array("idSkill"=>142,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
$data['aura'][] = array("idSkill"=>143,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
}
	$data['auraRowCheck']=true;	
if($stats['totemsCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);
$MonsterAttackAproval=false;
?>