<?php
//Drain
$ataque_player=1;
$fisicalCoolDown = $stats['CSpeed'];
switch($skill['nivel'])
{
	case 1:
		$manaModifier += intval($stats['ManaLimit']/2);
		
		$result = intval($stats['soulAcumulate']-($stats['soulAcumulate']/4));
		
		$db->sql_query("UPDATE aura SET acumuleitor = ".$result." WHERE idAura = '".$stats['soulAuraId']."'");
		$data['aura'] = array("idSkill"=>16,"lvl"=>$stats['soulLvl'],"auraTimeOut"=>$result);
		$data['auraCheckPasive']=true;	
	break;
}
$data['info'] .= textoAtaque(3,$skill['nombre']);
$MonsterAttackAproval=false;

?>
