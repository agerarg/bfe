<?php
//Blow
$ataque_player=1;
$data['animation']=1;
$ataque_player = $stats['Ataque']+$stats['AtaqueMagico'];

//GODS THING////////////////////////////////
//// KON
$result = $stats['KonAcumulate']+5;
if($result<100)
{
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['KonAuraId']."'");
}
else
{
	$result=100;
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['KonAuraId']."'");
}
$data['aura'][] = array("idSkill"=>51,"lvl"=>$skill['nivel'],"auraTimeOut"=>$result,"pasive"=>1);
	$data['auraRowCheck']=true;	
// MOH
if($stats['MohShitOn']==1)
{
	$result = $stats['MohAcumulate']-1;
	if($result>0)
	{
	$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['MohAuraId']."'");
	
	$data['aura'][] = array("idSkill"=>50,"lvl"=>$skill['nivel'],"auraTimeOut"=>$result,"pasive"=>1);
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
mt_srand((double)microtime()*1000000);
$critical_chanse = mt_rand(1,100);
if($stats['Critico'] > $critical_chanse)
{
	$ataque_player = critical($ataque_player,$stats['PC']);
	$criticolo=1;
}
else
{
	$ataque_player = normal($ataque_player);
	$criticolo=0;
}

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

?>
