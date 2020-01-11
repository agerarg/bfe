<?php
$data['animation']=0;
$fisicalCoolDown = 1;
$MonsterAttackAproval=false;
$heal=0;
switch($skill['nivel'])
{
	case 1:
		$heal = intval($stats['AtaqueMagico']*0.3)+50;
	break;
}

if(!$stats['ClericSabio']==1)
{
	if(mt_rand(1,10)==4){
		$gen = mt_rand(1,3);
		switch($gen)
		{
			case 1:
				$data['info'] .= "(Prophecy of Hope)";
			break;
			case 2:
				$data['info'] .= "(Prophecy of Doom)";
			break;
			case 3:
				$data['info'] .= "(Prophecy of Violence)";
			break;
		}
		$_SESSION['Cleric_Pro']=$gen;
	}
}

///Fait
if($stats['ClericProf_Hope'])
	$result = $stats['faithAcumulate']+10;
else
	$result = $stats['faithAcumulate']+3;
	if($result>10)
		$result=10;
	$data['aura'][] = array("idSkill"=>134,"lvl"=>1,"auraTimeOut"=>$result,"pasive"=>1);
	$data['auraRowCheck']=true;	
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['faithAuraId']."'");

$manaModifier += $heal;
if($pj['party']>0)
{
	$db->sql_query("UPDATE personaje SET Mana = (Mana+".$heal.")  WHERE party = ".$pj['party']." AND idPersonaje != ".$pj['idPersonaje']."");
				
	$msgs = "<spam class='healSkill'>".$pj['nombre']." te restauro ".$heal." de mana!</spam>";
	systemLog("party",$msgs);
	$data['info'] .= "".$skill['nombre']." restauro  ".$heal." de mana";
}
else
{
	$data['info'] .= "".$skill['nombre']." restauro  ".$heal." de mana";
}
//////////////////////////////////////////////////
$danoFinalPuro = 0;
?>
