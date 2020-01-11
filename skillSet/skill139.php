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
	$data['aura'][] = array("idSkill"=>139,"lvl"=>1,"auraTimeOut"=>60,"pasive"=>0);
	$data['auraRowCheck']=true;	
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['faithAuraId']."'");
if($pj['party']>0)
{
	$query = 'SELECT idPersonaje
			FROM personaje
			WHERE party = '.$pj['party'].'';
		$targetssq = $db->sql_query($query);
		while($targets = $db->sql_fetchrow($targetssq))
		{
			insertBuff($targets['idPersonaje'],231,139,60);
		}	
				
	$msgs = "<spam class='ShamanSkill'>".$pj['nombre']." uso ".$skill['nombre']."!</spam>";
	systemLog("party",$msgs);
}
else
{
	insertBuff($pj['idPersonaje'],231,139,60);
}

$data['info'] .= textoAtaque(3,$skill['nombre']);

//////////////////////////////////////////////////
$danoFinalPuro = 0;
?>
