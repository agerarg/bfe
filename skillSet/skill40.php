<?php
//arrow charge
$data['animation']=2;
switch($skill['nivel'])
{
	case 1:
		$result=5;
	break;
	case 2:
		$result=10;
	break;
	case 3:
		$result=15;
	break;
}

if($stats['dobleFlechas'])
	$result=$result*2;
$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['arrowAuraId']."'");
$data['aura'] = array("idSkill"=>49,"lvl"=>1,"auraTimeOut"=>$result);
$data['auraCheckPasive']=true;
		
$data['info'] .= textoAtaque(3,$skill['nombre']);
$MonsterAttackAproval=false;
?>
