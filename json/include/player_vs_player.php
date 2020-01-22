<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$pvp=1;
$attackCooldown=$stats['PSpeed'];
$now = tiempoReal();

$query = 'SELECT p . *, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
FROM personaje p JOIN clase c USING ( idClase ) 
WHERE  p.idPersonaje = '.$check['idPlayer'].' AND Vida>0';
$fpj = $db->sql_fetchrow($db->sql_query($query));
$pjEnemyLevel=$fpj['nivel'];
$monster = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
if($fpj['Vida']>$monster['VidaLimit'])
	$fpj['Vida']=$monster['VidaLimit'];

$monster['nombre']=$fpj['nombre'];
$monsterVida=$fpj['Vida'];

$data['enemyPlayerId']=$fpj['idPersonaje'];
if(!$fpj)
{
	$data['error'] = "El objetivo esta ya esta muerto.";
}else
if($pj['party']==$fpj['party'] AND $pj['party']>0)
{
	$data['error'] = "No puedes atacar alguien de tu misma party.";
}else
if($pj['rankedPlaing']==1 AND $rankedGame==0)
{
	$data['error'] = "El objetivo esta jugando ranked.";
}else
if($estoyMuerto==1)
{
	$data['error'] = "No podes atacar cuando estas muerto.";
}else
if($fpj['deathTime']>$now)
{
	$data['error'] = "El objetivo ya esta muerto.";
}
else
if($check['tipo']!="warzone" && $fpj['inDungeon'] && $rankedGame==0)
{
	$data['error'] = "Esta persona esta en un dungeon.";
}else
if($check['LUGARLOCO']=="city")
{
	$data['error'] = "No podes atacar en ciudades.";
}
else
if($fpj['idCuenta']==$pj['idCuenta'])
{
	$data['error'] = "No puedes atacarte vos mismo.";
}
else
{
	if($fpj['peaceShield']>$now AND $check['LUGARLOCO']=="train")
	{
		$data['error'] = "No podes pegarle a ".$monster['nombre'].", presiono el boton de cobarde";
	}
	else
	if($check['tipo']!="warzone" && ($fpj['nivel']+10<$pj['nivel'] OR $fpj['nivel']-10>$pj['nivel']) AND $check['LUGARLOCO']=="train" AND $monster['dimension']!=2)
	{
		$data['error'] = "La diferencia de nivel es muy alta";
	}else if($check['tipo']!="warzone" && $monster['dimension']!=$stats['dimension'])
	{
		$data['error'] = "The person is in another dimention!";
	}
	else
	{

		/////////  LINK
		$bloodLinkActive=0;
		/*if($monster['BloodProtector'])
		{
			$query = 'SELECT p . * , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN FROM personaje p JOIN clase c USING ( idClase ) 
		WHERE  p.attackCooldown > '.($now-300).' AND Vida>0 AND p.idPersonaje = '.$monster['BloodProtector'].'';
			$fpj2 = $db->sql_fetchrow($db->sql_query($query));
			if($fpj2)
			{
				$pjEnemyLevel=$fpj2['nivel'];
				$elsavlado=$monster['nombre'];
				unset($fpj);
				$fpj=$fpj2;
				$monster = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
				if($fpj['Vida']>$monster['VidaLimit'])
					$fpj['Vida']=$monster['VidaLimit'];

				$monster['nombre']=$fpj['nombre'];
				$monsterVida=$fpj['Vida'];
				$bloodLinkActive=1;
			}
		}*/
          /*$stats['Ataque']=($stats['Ataque']/2);
          $stats['AtaqueMagico']=($stats['AtaqueMagico']/2);*/
		$completlyEvation=false;
		//
		if($monster['PVPDMGREDUCE'])
		{
		  $stats['Ataque']=reduccion($stats['Ataque'],$monster['PVPDMGREDUCE']);
          $stats['AtaqueMagico']=reduccion($stats['AtaqueMagico'],$monster['PVPDMGREDUCE']);
		}
		
		include("include/fightManage.php");	
		
		$attackCooldown=$fisicalCoolDown;
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////						
$dmgCap = abs($monsterVida - $fpj['Vida']);
	$dmgCap = defensa($dmgCap,$monster['Defensa']+$monster['DefensaMagica']);
switch ($stats['elemAttack']) {
	case 'fire':
	 $finalDmg = damageResist($dmgCap,$fpj['resist_fire']);
	break;
	case 'water':
	 $finalDmg = damageResist($dmgCap,$fpj['resist_fire']);
	break;
	case 'earth':
	 $finalDmg = damageResist($dmgCap,$fpj['resist_fire']);
	break;
	case 'wind':
	 $finalDmg = damageResist($dmgCap,$fpj['resist_fire']);
	break;
	case 'dark':
	 $finalDmg = damageResist($dmgCap,$fpj['resist_fire']);
	break;
	case 'holy':
	 $finalDmg = damageResist($dmgCap,$fpj['resist_fire']);
	break;
	default:
	 $finalDmg = $dmgCap;
	break;
}
if($finalDmg>1)
		{
$msg = "<div class=pvpLog>PVP: ".$pj['nombre']." hizo <span class=pvpDmg>".$finalDmg."</span> de da&ntilde;o a ".$fpj['nombre']."</div>";
$data['info'] = $msg;
systemLog("self",$msg);
$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje,pvpTarget,nombre,mundo) 
								VALUES("'.$fpj['idPersonaje'].'","'.$msg.'","'.$log->get("pjSelected").'","'.$pj['nombre'].'","'.$check['mundo'].'")');

	$monsterVida = $fpj['Vida'];
	$monsterVida-=$finalDmg;

}

/*if(strlen($pvpInfo)>3)
		{
			
				$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje,pvpTarget,nombre,mundo) 
								VALUES("'.$fpj['idPersonaje'].'"," '.$pvpInfo." a ".$fpj['nombre'].'","'.$log->get("pjSelected").'","'.$pj['nombre'].'","'.$check['mundo'].'")');
				
				systemLog("self",$pj['nombre'].": ".$pvpInfo." a ".$fpj['nombre']);
		}*/



//$dmgCap = abs($monsterVida - $fpj['Vida']);
/*if($dmgCap>20000)
{
	$monsterVida=$fpj['Vida']-20000;
	$data['info'] .= "(CAP: 20k)";
}*/
$_PK=0;
$_PVP=0;
$pktimer=0;
$pvptimer=0;
if($monster['evasion']>0 && $skill_id==0)
{
	mt_srand((double)microtime()*1000000);
	$asscnac = mt_rand(1,100);
	if($monster['evasion']>=$asscnac)
		$golpeEvadido=true;
}
if($golpeEvadido)
{
	$msg = "<spam class='mobKilled'>".$fpj['nombre']." evadio el golpe!</spam>";
	$data['info'] .="<br> ".$fpj['nombre']."  evadio el golpe!";
		systemLog("self",$msg);
		systemLog("other",$msg,$fpj['idPersonaje']);
}else
if(!$completlyEvation)
{
						if($monster['inmortal']==1 AND $monsterVida<0)
									{
										$monsterVida=1;
										$msg = "<spam class='mobKilled'>".$fpj['nombre']." dice: Soy inmortal!!!</spam>";
										systemLog("self",$msg);
									  	systemLog("other",$msg,$fpj['idPersonaje']);
									}
						if($monster['sobrevivir']==1 AND $monsterVida<0)
									{
										$monsterVida=1;
										$msg = "<spam class='mobKilled'>".$fpj['nombre']." activo Sobrevivir!!!</spam>";
										systemLog("self",$msg);
										$db->sql_query("DELETE FROM aura WHERE idAura = '".$monster['sobrevivirId']."'");
										systemLog("other",$msg,$fpj['idPersonaje']);
									}
						if($bloodLinkActive)
							$data['info'] .= "<br><div class=dmgtransf>[".$fpj['nombre']." tankeando]</div>" ;

						if($monsterVida>0)
						{
							

							if($monster['pkTime']<$now)
									$pvptimer=$now+120;
									
						$db->sql_query("UPDATE personaje SET 
									Vida = '".$monsterVida."',
									maloId = '".$pj['idPersonaje']."',
									IdMaloMundo = '".$check['mundo']."',
									pvpEventTime = ".($now+60).",
									maloTimer = '".($now+120)."'
									WHERE idPersonaje = '".$fpj['idPersonaje']."'");
						
						if($pj['maloId']!=$fpj['idPersonaje'] AND $bloodLinkActive==0)
						{	
							if($fpj['pvpEventTime']<$now AND $rankedGame==0)
							{
							$db->sql_query("UPDATE cuenta SET evento = 1	WHERE idCuenta = '".$fpj['idCuenta']."'");
							}
						}

						}
						else/// MUERTO
						{

							$pvpInfo .= " y te mato!";
							$timemuerto=DEATHTIME;
							/*if($badluck['deathRise']==1)
								$timemuerto = 90;
							if($monster['deathRise']==1)
											$timemuerto = 60;*/
							$timemuerto+=$now;
							if($check['LUGARLOCO']=="free" || $check['LUGARLOCO']=="warzone")
							{
								$enemigoDerrotado = 1;
								 $pvptimer=$pj['pvpTime'];
								 $pktimer=$pj['pkTime'];
								$db->sql_query("UPDATE personaje SET Vida='0',
								maloId = 0,
									 deathTime = '".($now+$timemuerto)."',
									 killer = '".$pj['nombre']."' WHERE idPersonaje = '".$fpj['idPersonaje']."'");
							}
							else
							{
								systemLog("global","<div class=pjkiller><a target='_blank' href='index.php?sec=ver&pj=".$pj['nombre']."'>".$pj['nombre']."</a> mato a <a target='_blank' href='index.php?sec=ver&pj=".$fpj['nombre']."'>".$fpj['nombre']."</a>!</div>");
								if($fpj['pkTime']>$now)
								{
									 $pvptimer=$pj['pvpTime'];
									 $pktimer=$pj['pkTime'];
									$_PVP=1;
									$timemuerto=300;
									$db->sql_query("UPDATE personaje SET Vida='0',
									 deathTime = '".($now+$timemuerto)."',
									  pkTime = 0,
									  maloId = 0,
									   pvpKilledTime = '".($now+600)."',
									  pvpTime = 0,
									 killer = '".$pj['nombre']."' WHERE idPersonaje = '".$fpj['idPersonaje']."'");
									 	 
								}else
								if($fpj['pvpTime']>$now OR $bloodLinkActive==1)
								{
									$pvptimer=$now+300;
									$_PVP=1;
									$db->sql_query("UPDATE personaje SET Vida='0',
									 deathTime = '".($now+$timemuerto)."', 
									  pvpKilledTime = '".($now+600)."',
									  pkTime = 0,
									   maloId = 0,
									  pvpTime = 0,
									 killer = '".$pj['nombre']."' WHERE idPersonaje = '".$fpj['idPersonaje']."'");
								}
								else
								{	
									$pktimer=$now+300;
									$_PK=1;
									$db->sql_query("UPDATE personaje SET Vida='0',
									 deathTime = '".($now+$timemuerto)."', 
									 pvpKilledTime = '".($now+600)."',
									  pkTime = 0,
									   maloId = 0,
									  pvpTime = 0,
									 killer = '".$pj['nombre']."' WHERE idPersonaje = '".$fpj['idPersonaje']."'");
								}
							}
							$db->sql_query("UPDATE inmundo SET sesion_time = 0 
							WHERE mundo = '".$check['mundo']."' AND idPlayer = '".$fpj['idPersonaje']."' AND tipo = 1");
							
							$monsterVida=0;
							$data['info'] .= "<br>Enemigo derrotado!" ;


							//Logros
							$query = 'SELECT *
							FROM logros WHERE idPersonaje = '.$log->get("pjSelected").'';
							$logosq = $db->sql_query($query);
							$logros = $db->sql_fetchrow($logosq);
							
							
								if($logros['pvp']==0)
								{
									$boxLevel=2;
									earnDropBox($boxLevel,3,$log->get("pjSelected"));
									systemLog("self","<div class=recompensaAstral>Lograste matar un personaje! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
								}
								if($logros['pvp']==4)
								{
									$boxLevel=3;
									earnDropBox($boxLevel,3,$log->get("pjSelected"));
									systemLog("self","<div class=recompensaAstral>Lograste matar 5 personajes! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
								}
								if($logros['pvp']==9)
								{
									$boxLevel=4;
									earnDropBox($boxLevel,3,$log->get("pjSelected"));
									systemLog("self","<div class=recompensaAstral>Lograste matar 10 personajes! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
								}
								
							$db->sql_query("UPDATE logros SET pvp = (pvp+1)  WHERE idPersonaje = '".$log->get("pjSelected")."'");	

						}
						$data['MaloId'] = $monster['idPersonaje'];	
						
						$db->sql_query("UPDATE personaje SET
							PK= (PK+".$_PK."),
							PVP= (PVP+".$_PVP."),
							pvpTime = '".$pvptimer."',
							peaceShield = 0,
							pkTime = '".$pktimer."',
							Mana = '".$manaModifier."', 
							targeting = '".$check['idInMundo']."',
							targetingNature = 1,
							attackCooldown = '".($now+$attackCooldown)."', 
							Vida='".$vidaModifier."' 
						WHERE idPersonaje = '".$log->get("pjSelected")."'");	
	}
		
	}
	
	/*$db->sql_query("UPDATE personaje SET 
			Mana = '".$manaModifier."', 
			attackCooldown = '".($now+$fisicalCoolDown)."', 
			targeting = '".$check['idInMundo']."',
			targetingNature = 2,
			Vida='".$vidaModifier."' 
			WHERE idPersonaje = '".$log->get("pjSelected")."'");*/
	
	
	
	$data['monsterLife'] = $monsterVida;	
	$data['monsterLifeLimit'] = $monster['VidaLimit'];
}
?> 