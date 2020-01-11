<?php
$data['animation']=0;
$fisicalCoolDown = 1;
$buffTime = 120;
if($stats['ActivationTime'])
	$buffTime = $buffTime+($stats['ActivationTime']*60);

switch($skill['nivel'])
{
	case 1:
		insertBuff($pj['idPersonaje'],185,111,$buffTime);
	break;
	case 2:
		insertBuff($pj['idPersonaje'],186,111,$buffTime);
	break;
	case 3:
		insertBuff($pj['idPersonaje'],187,111,$buffTime);
	break;
}
$perrd= intval(($vidaModifier * 100) / $stats['VidaLimit']);
if($perrd>40)
{
	$vidaModifier = intval(($stats['VidaLimit']/100)*40);
	$data['info'] .= "Uso ".$skill['nombre']."<br>Vida cambiada a ".$vidaModifier ."";
	$db->sql_query("UPDATE personaje SET regenTime='".($now+10)."'  WHERE idPersonaje = '".$pj['idPersonaje']."'");
}
else
	$data['info'] .= textoAtaque(3,$skill['nombre']);
$data['aura'][] = array("idSkill"=>111,"lvl"=>$skill['nivel'],"auraTimeOut"=>$buffTime,"pasive"=>0);
	$data['auraRowCheck']=true;	

if($stats['ActivateCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);
		
$MonsterAttackAproval=false;
?>