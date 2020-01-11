<?php
$data['animation']=2;
$ataque_player=1;
switch($skill['nivel'])
{
	case 1:
	
	$buffTime = 300;
	if($stats['VirusRageTime'])
	$buffTime = $buffTime+($stats['VirusRageTime']*60);
	
	insertBuff($pj['idPersonaje'],23,11,$buffTime);
														
		$data['aura'] = array("idSkill"=>11,"lvl"=>$skill['nivel'],"auraTimeOut"=>$buffTime);
		$data['auraCheck']=true;
	break;
}												

if($stats['MaestruliOn'])
	$skill['cooldown']=intval($skill['cooldown']/2);
$data['info'] .=  textoAtaque(3,$skill['nombre']);
?>
