<?php
$ataque_player=1;
$fisicalCoolDown = $stats['CSpeed'];
switch($skill['nivel'])
{
	case 1:
		$ataque_player = $stats['AtaqueMagico']*3+6000;
	break;
}
//GODS THING////////////////////////////////
//// MOH
$result = $stats['MohAcumulate']+3;
if($result<100)
{
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['MohAuraId']."'");
}
else
{
	$result=100;
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['MohAuraId']."'");
}
$data['aura'][] = array("idSkill"=>50,"lvl"=>$skill['nivel'],"auraTimeOut"=>$result,"pasive"=>1);
	$data['auraRowCheck']=true;	
// KON
if($stats['KonShitOn']==1)
{
	$result = $stats['KonAcumulate']-1;
	if($result>0)
	{
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['KonAuraId']."'");
	
	$data['aura'][] = array("idSkill"=>51,"lvl"=>$skill['nivel'],"auraTimeOut"=>$result,"pasive"=>1);
	$data['auraRowCheck']=true;	
	}
}
// NAH
if($stats['NahShitOn']==1)
{
	$result = $stats['NahAcumulate']-1;
	if($result>0)
	{
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['NahAuraId']."'");
	
	$data['aura'][] = array("idSkill"=>52,"lvl"=>$skill['nivel'],"auraTimeOut"=>$result,"pasive"=>1);
	$data['auraRowCheck']=true;	
	}
}

///////////////////////////////////////////

mt_srand((double)microtime()*1000000);
$critical_chanse = mt_rand(1,100);
if($stats['CriticoMagico'] > $critical_chanse)
{
	$ataque_player = critical($ataque_player,$stats['PCMagico']);
	$criticolo=1;
}
else
{
	$ataque_player = normal($ataque_player);
	$criticolo=0;
}

$defensa = penetration($monster['DefensaMagica'],$stats['MagicPenetration']);
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
