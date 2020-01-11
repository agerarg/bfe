<?php
//Swing Blade
$data['animation']=1;
$ataque_player=1;

if($stats['perSnowBall']==1)
{
	$mixedid = intval($check['idInMundo']+$check['idPersonaje']);
	if($mixedid == $_SESSION['PerSnowId'])
	{
		$stats['Ataque']+=$_SESSION['PerSnowDmg'];
	}
	else
	{
		$data['auraRowCheck']=true;	
		$data['aura'][] = array("idSkill"=>192,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>1);
		$_SESSION['PerSnowDmg']=0;
		$_SESSION['PerSnowAcu']=0;
		$_SESSION['PerSnowId']=$mixedid;
	}
}
if($stats['AngryShield'])
{
	$stats['Ataque']+=intval($stats['Defensa']/2);
}
switch($skill['nivel'])
{
	case 1:
		$stats['Ataque'] = $stats['Ataque'] + 250;
	break;
	case 2:
		$stats['Ataque'] = $stats['Ataque']*2 + 400;
	break;
	case 3:
		$stats['Ataque'] = $stats['Ataque']*3 + 600;
	break;
}
if($stats['HonorSword'])
{
	if($stats['Critico']<100)
		$stats['Ataque']=potenciar($stats['Ataque'],50);

}
if($stats['HonorHelmet'])
{
	$skill['cooldown']=1;
	$stats['Ataque']=$stats['Ataque']*3;
}
mt_srand((double)microtime()*1000000);
$critical_chanse = mt_rand(1,100);
if($stats['Critico'] > $critical_chanse)
{
	$ataque_player = critical($stats['Ataque'],$stats['PC']);
	$criticolo=1;
}
else
{
	$ataque_player = normal($stats['Ataque']);
	$criticolo=0;
}

$defensa = $monster['Defensa'];
$monsterVida=($monsterVida-defensa($ataque_player,$defensa));														

if($criticolo==1)
{
	$data['info'] .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$defensa));
	$pvpInfo .= textoAtaque(2,$skill['nombre'],defensa($ataque_player,$monster['Defensa']));
}
else
{
	$data['info'] .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$defensa));
	$pvpInfo .= textoAtaque(1,$skill['nombre'],defensa($ataque_player,$monster['Defensa']));
}
//////////////////////////////////////////////////
$danoFinalPuro = defensa($ataque_player,$defensa);
?>
