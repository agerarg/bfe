<?php
$data['animation']=1;
$ataque_player=1;
switch($skill['nivel'])
{
	case 1:
		if($stats['DestroActive']==1)
		{
			$stats['InfinityEadge']=0;
		}
		else
			$ataque_player = $stats['Ataque']*3 + $stats['SkillDmg'];
		if($stats['InfinityEadge']==1)
		{
			$ataque_player +=$stats['IEAcumulate']*($ataque_player/50);
			
			if($stats['SaveIE1']==1)
			{
				
					insertBuff($pj['idPersonaje'],194,114,120);
					$data['aura'][] = array("idSkill"=>114,"lvl"=>2,"auraTimeOut"=>120,"pasive"=>0);
					$data['auraRowCheck']=true;	
				
			}
			else
			{
			$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['IEAuraId']."'");
			$data['aura'][] = array("idSkill"=>113,"lvl"=>$stats['IEALvl'],"auraTimeOut"=>0,"pasive"=>1);
			$data['auraRowCheck']=true;	
			}
		}
	break;
}
if($stats['DeathBlastDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['DeathBlastDmg']);
if($stats['BladesCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);
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

$defensa = penetration($monster['Defensa'],$stats['ArmorPenetration']);
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
