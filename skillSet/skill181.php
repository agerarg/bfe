<?php
$data['animation']=0;
$fisicalCoolDown = 1;
if($stats['SIAcumulate'])
{
$duration = (intval($stats['SIAcumulate'])*60)+60;
    if($stats['DarkExplodeDD']==1)
    $duration=$duration*2;
$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['SIAuraId']."'");
$data['aura'][] = array("idSkill"=>22,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>1);
$data['auraRowCheck']=true;	
}
else
	$duration = 60;
insertBuff($pj['idPersonaje'],318,181,$duration);
$data['info'] .= textoAtaque(3,$skill['nombre']);

$data['aura'][] = array("idSkill"=>181,"lvl"=>1,"auraTimeOut"=>$duration,"pasive"=>0);
$data['auraRowCheck']=true;	
		
$MonsterAttackAproval=false;
?>
