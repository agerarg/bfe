<?php
$data['animation']=0;
$fisicalCoolDown = 1;
$MonsterAttackAproval=false;
$heal=0;
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
$heal = intval(($vidaModifier/100)*20);
$vidaModifier += $heal;
if($pj['party']>0)
{
	
	$query = 'SELECT idPersonaje, Vida
			FROM personaje
			WHERE party = '.$pj['party'].' AND idPersonaje != '.$pj['idPersonaje'].'';
		$targetssq = $db->sql_query($query);
		while($targets = $db->sql_fetchrow($targetssq))
		{
			$jeal = intval(($targets['Vida']/100)*20);
			$db->sql_query("UPDATE personaje SET Vida = (Vida+".$jeal.")  WHERE idPersonaje != ".$targets['idPersonaje']."");
		}
	$msgs = "<spam class='healSkill'>".$pj['nombre']." te curo 20% de tu vida actual!</spam>";
	systemLog("party",$msgs);
}
$data['info'] .= textoAtaque(7,$skill['nombre'],$heal);
//////////////////////////////////////////////////
$danoFinalPuro = 0;
?>
