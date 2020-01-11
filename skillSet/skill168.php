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
		$multipliquitor = $_SESSION['PerSnowAcu'];
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

if($_SESSION["idClase"]==1)
	{
			switch($skill['nivel'])
			{
				case 1:
					$per= intval(($vidaModifier * 100) / $stats['VidaLimit']);
					$reverse = 100-$per;
					$stats['Ataque'] = $stats['Ataque']+1000+intval((($stats['Ataque']*4)/100)*$reverse);
				break;
			}
			$vidaModifier = intval(($vidaModifier+2)/2);
			mt_srand((double)microtime()*1000000);
			$critical_chanse = mt_rand(1,100);
			if($stats['LifeSword'])
				$stats['Critico']=100;
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
			if($stats['LifeSword'])
				$ataque_player=$ataque_player*($multipliquitor/8);
}
else
{
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
