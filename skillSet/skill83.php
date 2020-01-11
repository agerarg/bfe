<?php
if($stats['bloodyComboCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);

if($stats['BloodyComboDmg']>0)
	$stats['Ataque']=potenciar($stats['Ataque'],$stats['BloodyComboDmg']);
	
function attackero()
{
	global $monster,$stats;
	$ataque_player = $stats['Ataque'];
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
	if($criticolo==1)
{
	$data['nextdmg'] .= defensa($ataque_player,$defensa.$blockdata);
}
else
{
	$data['nextdmg'] .= defensa($ataque_player,$defensa.$blockdata);
}

	
	$data['damage'] = defensa($ataque_player,$defensa);
	return $data;
}


switch($skill['nivel'])
	{
		case 1:
			$responc = attackero();
			$dano1 = $responc['nextdmg'];
			$danoFinalPuro+= $responc['damage'];
			
			$responc = attackero();
			$dano2 = $responc['nextdmg'];
			$danoFinalPuro+= $responc['damage'];

			$data['info'] .= textoAtaque(1,$skill['nombre'],$dano1." y ".$dano2);
	                $pvpInfo .= textoAtaque(1,$skill['nombre'],$dano1." y ".$dano2);

			if($stats['VampireStance']>0)
			{
				$bonususlf = $stats['VampireStance']*2;
				$vidaModifier = $vidaModifier+$bonususlf;
				$data['info'] .= "(V:+".$bonususlf.")";
			}
		break;
		case 2:
			$responc = attackero();
			$dano1 = $responc['nextdmg'];
			$danoFinalPuro+= $responc['damage'];
			
			$responc = attackero();
			$dano2 = $responc['nextdmg'];
			$danoFinalPuro+= $responc['damage'];
			
			$responc = attackero();
			$dano3 = $responc['nextdmg'];
			$danoFinalPuro+= $responc['damage'];

			$data['info'] .= textoAtaque(1,$skill['nombre'],$dano1.", ".$dano2." y ".$dano3);
	                $pvpInfo .= textoAtaque(1,$skill['nombre'],$dano1.", ".$dano2." y ".$dano3);
			if($stats['VampireStance']>0)
			{
				$bonususlf = $stats['VampireStance']*3;
				$vidaModifier = $vidaModifier+$bonususlf;
				$data['info'] .= "(V:+".$bonususlf.")";
			}
		break;
		case 3:
			$responc = attackero();
			$dano1 = $responc['nextdmg'];
			$danoFinalPuro+= $responc['damage'];
			
			$responc = attackero();
			$dano2 = $responc['nextdmg'];
			$danoFinalPuro+= $responc['damage'];
			
			$responc = attackero();
			$dano3 = $responc['nextdmg'];
			$danoFinalPuro+= $responc['damage'];
			
			$responc = attackero();
			$dano4 = $responc['nextdmg'];
			$danoFinalPuro+= $responc['damage'];
			$data['info'] .= textoAtaque(1,$skill['nombre'],$dano1.", ".$dano2.", ".$dano3." y ".$dano4);
	                $pvpInfo .= textoAtaque(1,$skill['nombre'],$dano1.", ".$dano2.", ".$dano3." y ".$dano4);
			if($stats['VampireStance']>0)
			{
				$bonususlf = $stats['VampireStance']*4;
				$vidaModifier = $vidaModifier+$bonususlf;
				$data['info'] .= "(V:+".$bonususlf.")";
			}
		break;
		
	}
$monsterVida=($monsterVida-$danoFinalPuro);	
?>
