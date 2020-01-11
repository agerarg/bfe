<?php
/////////////// COMBO SHIT ///////////////////////
$now = time();
$forceAssesination=false;
$comboFail=0;
$comboStartFresh=0;

if($_SESSION['NinjaCombo'] > 0 AND $_SESSION['NinjaCombo_skill']==$skill['idSkill'] AND $_SESSION['NinjaCombo'] <6 AND $_SESSION['NinjaTarget'] == $mixedid )
	{
		$skillersq = "(idSkill = 57 OR idSkill = 58 OR idSkill = 59 OR idSkill = 60 OR idSkill = 61 OR idSkill = 67)";
		$skillersq = str_replace($skill['idSkill'],"0",$skillersq);
		$query = 'SELECT idSkill
					FROM skilllearn
					WHERE '.$skillersq.' AND idSkill != '.intval($_SESSION['NinjaSkillUsed']).' AND cooldownCurrent < '.$now.'  AND idPersonaje = '.$pj['idPersonaje'].' ORDER BY RAND() LIMIT 1 ';
		$skillm = $db->sql_fetchrow($db->sql_query($query));
		$_SESSION['NinjaCombo']++;
		
		$_SESSION['NinjaSkillUsed']=$skill['idSkill'];
		
			$stats['Ataque'] = $stats['Ataque'] + $_SESSION['NinjaCombo']*(50+($stats['Ataque']/2));
		if($_SESSION['NinjaCombo_skill']=$skillm['idSkill'])
		{
			if($stats['LucksFist'])	
			{
					$stunGoingOn=1;
					$data['info'] .= " [Lucks Stun]";
			}
			switch($skillm['idSkill'])
			{
				case 57:
					$msg = "Blo"; //Blow
				break;
				case 58:
					$msg = "CrB"; //Critical Blow
				break;
				case 59:
					$msg = "PoB"; //Power Blow
				break;
				case 60:
					$msg = "PeB"; //Penetreitor Blow
				break;
				case 61:
					$msg = "ShB"; //Shadow Blow
				break;
				case 67:
					$msg = "DeB"; //Destructor Blow
				break;
			}
			switch($_SESSION['NinjaCombo'])		
			{
				case 1:
					$data['aura'][] = array("idSkill"=>901,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>1);
					 $data['aura'][] = array("idSkill"=>903,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>902,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>904,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>905,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>906,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);	
					$data['info'] .= "(Combo: ".$msg.")";
				break;	
				case 2:
					$data['aura'][] = array("idSkill"=>901,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>902,"lvl"=>1,"auraTimeOut"=>2,"pasive"=>1);
					$data['aura'][] = array("idSkill"=>903,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>904,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>905,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>906,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);	
					$data['info'] .= "(Combo: ".$msg.")";
				break;	
				case 3:
					$data['aura'][] = array("idSkill"=>901,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>902,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>903,"lvl"=>1,"auraTimeOut"=>3,"pasive"=>1);
					$data['aura'][] = array("idSkill"=>904,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>905,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>906,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);	
					if($stats['removeBreak'])
						$data['info'] .= "(Combo: ".$msg.")";
					else
						$data['info'] .= "(BREAK) ";
						$forceAssesination=true;
						$data['auraRowCheck']=true;	
				break;	
				case 4:
					$data['aura'][] = array("idSkill"=>901,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>902,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>903,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>904,"lvl"=>1,"auraTimeOut"=>4,"pasive"=>1);
					$data['aura'][] = array("idSkill"=>905,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>906,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);	
					$data['info'] .= "(Combo: ".$msg.")";
				break;	
				case 5:
					$data['aura'][] = array("idSkill"=>901,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>902,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>903,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>904,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>905,"lvl"=>1,"auraTimeOut"=>5,"pasive"=>1);
					$data['aura'][] = array("idSkill"=>906,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);	
					$data['info'] .= "(Combo: ".$msg.")";
				break;	
				case 6:
					$data['aura'][] = array("idSkill"=>901,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>902,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>903,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>904,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>905,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
					$data['aura'][] = array("idSkill"=>906,"lvl"=>1,"auraTimeOut"=>6,"pasive"=>1);	
					$data['info'] .= "(Monster!) ";
					$forceAssesination=true;
					$stats['Ataque'] = $stats['Ataque']*2;
				break;	
			}
				$data['auraRowCheck']=true;	
				$_SESSION['NinjaTarget'] = $mixedid;
		}
		else
		 {
			 //////////////////// NO FAIL ///
			 switch($_SESSION['NinjaCombo'])
			 {
				case 2:
					$data['info'] .= "(Feo) ";	
			 	break;
				case 3:
					$data['info'] .= "(Medio) ";	
			 	break;
				case 4:
					$data['info'] .= "(Bueno) ";	
			 	break;
				case 5:
					$data['info'] .= "(Super!) ";	
			 	break;
				case 6:
					$data['info'] .= "(Monstruoso!) ";	
					$forceAssesination=true;
			 	break;
			 }
			 $data['aura'][] = array("idSkill"=>901,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
			$data['aura'][] = array("idSkill"=>902,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
			$data['aura'][] = array("idSkill"=>903,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
			$data['aura'][] = array("idSkill"=>904,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
			$data['aura'][] = array("idSkill"=>905,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
			if($_SESSION['NinjaCombo']==6)
				$data['aura'][] = array("idSkill"=>906,"lvl"=>1,"auraTimeOut"=>6,"pasive"=>1);	
			else
				$data['aura'][] = array("idSkill"=>906,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);	
		 }
	}
	else
	{

if($_SESSION['NinjaTarget'] == $mixedid)
		{
			$data['info'] .= "[Combo Fail]";
			$comboFail=1;
		}
if($_SESSION['NinjaTarget'] != $mixedid)
		{
			$comboStartFresh=1;
		}
		$data['aura'][] = array("idSkill"=>902,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
		$data['aura'][] = array("idSkill"=>903,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
		$data['aura'][] = array("idSkill"=>904,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
		$data['aura'][] = array("idSkill"=>905,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
		$data['aura'][] = array("idSkill"=>906,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);	
		$data['auraRowCheck']=true;	
		$_SESSION['NinjaCombo']=1;
	
	$skillersq = "(idSkill = 57 OR idSkill = 58 OR idSkill = 59 OR idSkill = 60 OR idSkill = 61 OR idSkill = 67)";
	$skillersq = str_replace($skill['idSkill'],"0",$skillersq);
	$query = 'SELECT idSkill
				FROM skilllearn
				WHERE '.$skillersq.' AND cooldownCurrent < '.$now.'  AND idPersonaje = '.$pj['idPersonaje'].' ORDER BY RAND() LIMIT 1 ';
	
	$skillm = $db->sql_fetchrow($db->sql_query($query));
	if($_SESSION['NinjaCombo_skill']=$skillm['idSkill'])
	{
		switch($skillm['idSkill'])
		{
			case 57:
				$msg = "Blo"; //Blow
			break;
			case 58:
				$msg = "CrB"; //Critical Blow
			break;
			case 59:
				$msg = "PoB"; //Power Blow
			break;
			case 60:
				$msg = "PeB"; //Penetreitor Blow
			break;
			case 61:
				$msg = "ShB"; //Shadow Blow
			break;
			case 67:
				$msg = "DeB"; //Destructor Blow
			break;
		}
		$data['info'] .= "(Combo: ".$msg.") ";
		$data['aura'][] = array("idSkill"=>(900+$_SESSION['NinjaCombo']),"lvl"=>1,"auraTimeOut"=>1,"pasive"=>1);

		$data['auraRowCheck']=true;	
		$_SESSION['NinjaTarget'] = $mixedid;
	}

}
if($stats['AuraComboMastery'])
{
		$query = 'SELECT count(*) as CONTA
				FROM skilllearn
				WHERE (idSkill = 57 OR idSkill = 58 OR idSkill = 59 OR idSkill = 60 OR idSkill = 61 OR idSkill = 67) AND idPersonaje = '.$pj['idPersonaje'].'';
		$skillsCta = $db->sql_fetchrow($db->sql_query($query));
		if($skillsCta['CONTA']>=5 && $comboStartFresh==0)
		{
			if($comboFail==0)
			{
				if($stats['AuraComboMasteryAcc']<10)
					{
						$db->sql_query("UPDATE aura SET acumuleitor = (acumuleitor+1)  WHERE idAura = '".$stats['AuraComboMasteryId']."'");
						$data['aura'][] = array("idSkill"=>446,"lvl"=>1,"auraTimeOut"=>($stats['AuraComboMasteryAcc']+1),"pasive"=>1);
					}
					else
					{
						$data['aura'][] = array("idSkill"=>446,"lvl"=>1,"auraTimeOut"=>10,"pasive"=>1);
					
					}
			}

		}
		else
		{
			$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['AuraComboMasteryId']."'");
			$data['aura'][] = array("idSkill"=>446,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>1);
		}
		$data['auraRowCheck']=true;	

}
/////////////////////////////////////////////////
$data['animation']=1;
$ataque_player=1;
///Blooddd
if($stats['skillPowerAcumulate']>2)
$data['info'] .= "(vida: +".$stats['skillPowerAcumulate'].") ";
$vidaModifier = $vidaModifier+$stats['skillPowerAcumulate'];

switch($skill['nivel'])
{
	case 1:
		$ataque_player = $stats['Ataque']*2 + $stats['skillPowerAcumulate'];
	break;
}

if($stats['CriticalBlowDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['CriticalBlowDmg']);

if($monster['ShieldRate']>0)
{
	mt_srand((double)microtime()*1000000);
	$shield_chanse = mt_rand(1,100);
	if($monster['ShieldRate'] > $shield_chanse)
	{
		$monster['Defensa'] = $monster['Defensa'] + $monster['shieldDef'];
		$blockdata = "(Block)";
	}
}	
	if($stats['assesination']==1)
	{
		mt_srand((double)microtime()*1000000);
		$asscnac = mt_rand(1,100);
		if($stats['asses_chance']>$asscnac OR $forceAssesination)
		{
			$ataque_player=intval($ataque_player*5);
			$data['info'] .= "(Assassination) ";
			$duration = 15;
			insertBuff($pj['idPersonaje'],591,435,$duration);
			$data['aura'][] = array("idSkill"=>435,"lvl"=>1,"auraTimeOut"=>$duration,"pasive"=>0);
			$data['auraRowCheck']=true;	
		}
	}
	$ataque_player = critical($ataque_player,$stats['PC']);
	$criticolo=1;

$defensa = $monster['Defensa'];
$monsterVida=($monsterVida-defensa($ataque_player,$defensa));														
if($criticolo==1)
{
	$data['info'] .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata));
	$pvpInfo .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata));
}
else
{
	$data['info'] .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata));
	$pvpInfo .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa.$blockdata));
}


//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>