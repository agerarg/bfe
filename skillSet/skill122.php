<?php
$data['info'] .= "use ".$skill['nombre'];
$Proct=false;
if($stats['StunStrikeInsta'])
{
	$fisicalCoolDown = 3;
	$db->sql_query("DELETE FROM aura WHERE idAura = '".$stats['ShamanFreeID']."'");
	$data['aura'] = array("idSkill"=>170,"lvl"=>1,"auraTimeOut"=>1);
	$data['auraCheck']=true;
	$skill['cooldown']=1;
	$Proct=true;
}
if($stats['DarkSpikersGuantes'])
{
	insertBuff($pj['idPersonaje'],308,171,60);

}
switch($skill['nivel'])
{
	case 1:
		$chanceStun = 40;
		$ataque_player = $stats['Ataque']*2 + 100;
	break;
	case 2:
		$chanceStun = 60;
		$ataque_player = $stats['Ataque']*3 + 200;
	break;
}	
if($stats['StunStrikeDmg']>0)
	$ataque_player=potenciar($ataque_player,$stats['StunStrikeDmg']);

if($Proct)
	$ataque_player=$ataque_player*3;

if($stats['StunStrikeCd'])
	$skill['cooldown']=intval($skill['cooldown']/2);
$fail=0;
$stunGoingOn=1;
		switch($check['tipo'])
		{
			default:
				$asscnac = mt_rand(1,100);
				if($chanceStun>$asscnac)
				{
					$stunGoingOn=1;
					$monster['attackSpeed']+=20;
					$db->sql_query("UPDATE inmundo SET attackCooldown=".($now+$monster['attackSpeed'])."  WHERE idInMundo = '".$check['idInMundo']."'");
					$data['info'] .= " [entro]";
				}
				else
				{
					$fail=1;
					$data['info'] .= " [fail]";	
				}
			break;
			case 1:
				
				$asscnac = mt_rand(1,100);
				if($chanceStun>$asscnac)
				{
					if($pj['party']>0)
							systemLog("party",'<spam class='."'hate'".'>'.$pj['nombre'].' uso Stun en <a href='."'?sec=mundo&mundo=".$check['mundo']."&target=".$check['idInMundo']."&bicho'".'>'.$monster['nombre'].'</a></spam>');
						else
							systemLog("self",'<spam class='."'hate'".'>'.$pj['nombre'].' uso Stun en <a href='."'?sec=mundo&mundo=".$check['mundo']."&target=".$check['idInMundo']."&bicho'".'>'.$monster['nombre'].'</a></spam>');
					$pvpInfo .= " te stuneo por 20seg!";
					$data['info'] .= " [entro]";
					insertBuff($monster['PJID'],207,122,20);
				}
				else
				{
					if($pj['party']>0)
						systemLog("party",'<spam class='."'itruptFail'".'>'.$pj['nombre'].' fail stun en '.$monster['nombre'].'</spam>');
					else
						systemLog("self",'<spam class='."'itruptFail'".'>'.$pj['nombre'].' fail stun en '.$monster['nombre'].'</spam>');
					$pvpInfo .= " fail stun!";
					$fail=1;
					$data['info'] .= " [fail]";	
				}		
				
			break;
		}
if($fail==1)
{
	$ataque_player=$ataque_player*2;
}
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