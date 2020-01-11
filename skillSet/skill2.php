<?php
//Bite
$ataque_player=1;
switch($skill['nivel'])
{
	case 1:
		$ataque_player = $stats['Ataque'] + intval(($monster['Defensa']/100)*15);
	break;
}
$defensa = $monster['Defensa'];
$monsterVida=($monsterVida-defensa($ataque_player,$defensa));

$buffTime = 300;
if($stats['BiteTime'])
	$buffTime = 300+($stats['BiteTime']*60);
	
insertBuff($log->get("pjSelected"),4,2,$buffTime);
														
$data['aura'] = array("idSkill"=>2,"lvl"=>$skill['nivel'],"auraTimeOut"=>$buffTime);
$data['auraCheck']=true;
$data['info'] .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa));
$pvpInfo .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$monster['Defensa']));
$bonususlf = intval(($stats['VidaLimit']/100)*15);
	$vidaModifier = $vidaModifier+$bonususlf;
	$data['info'] .= " (Life:+".$bonususlf.")";

/*if($criticolo==1)
	$data['info'] .= " hizo un daño critico de ".defensa($ataque_player,$defensa)."";
else
	$data['info'] .= " hizo un daño ".defensa($ataque_player,$defensa)."";*/
	
//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>
