<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$cancelMonsterAutoAttack=1;
/*$query = 'SELECT * FROM monster
							WHERE idMonster = '.$check['idMonster'].'';
$monster = $db->sql_fetchrow($db->sql_query($query));*/



/*if($check['champion']==1)
{
	$monster['Ataque']=$monster['Ataque']*2;
	$monster['VidaLimit']=$monster['VidaLimit']*3;	
}*/


$monsterHeal=0;
$goblinHunt=$pj['goblinHunt'];
$query = 'SELECT *
					FROM logros WHERE idPersonaje = '.$log->get("pjSelected").'';
$logosq = $db->sql_query($query);
$logros = $db->sql_fetchrow($logosq);

if($estoyMuerto==1)
{
	$data['error'] = "No podes atacar cuando estas muerto.";
}else
if(!$otroMundo)
{
		$data['error'] = "El bicho esta en otro mundo!";
}else
if( $monster['raid'] && $id2>0 )
{ 
	$data['error'] = "No podes pegarle a mas de un Raid a la vez!";
}
else
if($pj['antiBot']>$now)
{						
						$query = 'SELECT * FROM mundo m 
						WHERE m.activo=1 AND m.id='.$check['mundo'].'';
						$mundosq = $db->sql_query($query);
						$mundo = $db->sql_fetchrow($mundosq);
						
						$vanillaAttack=$stats['Ataque'];
						if($stats['dmgVsChamps'])
						{
							$stats['Ataque'] = potenciar($stats['Ataque'],$stats['dmgVsChamps']);		
							$stats['AtaqueMagico'] = potenciar($stats['AtaqueMagico'],$stats['dmgVsChamps']);
						}
						
						if($stats['nameWeapon']==1 AND mt_rand(1,50)==38)
						{
							$query = 'SELECT *
								FROM inventario
								WHERE idInventario = '.$stats['idWeapon'];
							$itemsq = $db->sql_query($query);
							$item = $db->sql_fetchrow($itemsq);
						
							$query = 'SELECT  nombre
							FROM jnombre
							WHERE idNombre = '.$item['idNombre'];
							$wnamesq = $db->sql_query($query);
							$wname = $db->sql_fetchrow($wnamesq);
							
							$query = 'SELECT  apellido
							FROM japellido
							WHERE idApellido = '.$item['idApellido'];
							$wlasNamesq = $db->sql_query($query);
							$wlasName = $db->sql_fetchrow($wlasNamesq);
							$fullName = $wname['nombre'].' '.$wlasName['apellido'];
							$tam = strlen($fullName);
							$place =  mt_rand(0, $tam);
							
							$letraMostrar = substr($fullName, $place,1);
							$letraStr="";
							for($i=0;$i<$tam;$i++)
							{
								$letra = substr($item['nameCheck'], $i,1);
								if($place==$i)
									$letra = $letraMostrar;
								$letraStr .= $letra;
							}
							
							$msgS = "<spam class='raidcast'>Descubriste la letra ".$letraMostrar." de tu arma!</spam>";
									systemLog("self",$msgS);
										
							$db->sql_query("UPDATE inventario SET nameCheck = '".$letraStr."' WHERE idInventario = '".$item['idInventario']."'");
						}
						if($monster['nivel']>= 50)
						{
							$monster['Defensa']=($monster['Defensa']*2);
							$monster['DefensaMagica']=($monster['DefensaMagica']*2);
						}
						$MonsterAttackAproval=true;
 
						// WAR ZONE
						if($monster['idMonster']==204)
						{
							if($mundo['clan'] == $pj['clan'])
							{
								$data['error'] = "No podes atacar tu propio nexus!";
									echo json_encode($data);
									die();
							}

							$query = 'SELECT p.idPersonaje, p.clan
							FROM personaje p 
							LEFT JOIN inmundo im 
							ON im.idPlayer = p.idPersonaje
							WHERE im.sesion_time > '.$now.'
							AND  p.clan != '.$pj['clan'].'
							AND im.mundo = "'.$check['mundo'].'" 
							AND tipo=1 LIMIT 1';

							$warZonesq = $db->sql_query($query);
							$warZone = $db->sql_fetchrow($warZonesq);
							if($warZone)
							{
								$data['error'] = "Hay enemigos defendiendo el nexus!";
									echo json_encode($data);
									die();
							}
						}

						//// EXTRA PARAGON
						if($pj['paragonDmg']>0)
						{

							$stats['Ataque'] = potenciar($stats['Ataque'],$pj['paragonDmg']);		
							$stats['AtaqueMagico'] = potenciar($stats['AtaqueMagico'],$pj['paragonDmg']);
						}

						/// PAPAS FRITAS
						include("include/fightManage.php");

						
						//DPS COUNTER //
						if($ataque_player>1)
						{
							$newDpsCalc = defensa($ataque_player,100);
							
							if(isset($_SESSION['DPSHITS']))
							{
								if(($pj['realDPSTime']+60)>=$now)
								{
									$pj['realDPSAcc']+=$newDpsCalc;
								}
								else
								{ 
										$pj['realDPS']=bigintval($pj['realDPSAcc']/($now-$pj['realDPSTime']));
										$pj['realDPSAcc']=0;
										$pj['realDPSTime']= $now;
								}
							}
							else
							{
								$_SESSION['DPSHITS']=true;
								$pj['realDPSAcc']=0;
								$pj['realDPSTime']= $now;
							}
						}
						//// DPS
						//
						/*if($pj['party'] AND $pvpInfo)
									{
										$msg = "<div class=partyhit>".$pj['nombre']." ".$pvpInfo." to <spam class='raidname'>".$monster['nombre']."</spam></div>";
										systemLog("party",$msg);		
									}*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

									
						switch ( $monster['monsterType']) {
							case 'perfect':

								$danoFinalPuro = damageResist($danoFinalPuro,98);
								$data['info']="Golpeaste por ". optimalDmg($danoFinalPuro);
								
								break;
							}


						$nexAttack = $monster['attackType'];
						
						$query = 'SELECT im.element, im.idInMundo, im.currentLife, im.champion, im.idMonster, mob.nivel,mob.nombre, mob.imagen, mob.VidaLimit,im.tipo,mob.exp, mob.gold, mob.VidaLimit, mob.Ataque
									FROM inmundo im JOIN monster mob USING(idMonster)
									WHERE '.$monster_hash.'';
							

						$mobber = $db->sql_query($query);
						while($mob = $db->sql_fetchrow($mobber))
						{
							$mobberArr[]=$mob;
						}
						


						if($MonsterAttackAproval)
						{
							//$monster['Ataque']
							switch ( $monster['monsterType']) {
							case 'perfect':
								$monsterAttackTrue=false;

								if($monster['attackCooldown']<$now)
								{
									$monsterAttackTrue=true;
								//while($mob = $db->sql_fetchrow($mobber))
								//{
										$query = 'SELECT p.idPersonaje, p.nombre, p.Vida,
										p.resist_fire, p.resist_water, p.resist_earth, p.resist_wind, p.resist_dark, p.resist_holy
															FROM personaje p
													WHERE p.party='.$pj['party'].' AND p.party>0 AND p.Vida>0 ORDER BY RAND()';
											$targetssq = $db->sql_query($query);	
											while($player = $db->sql_fetchrow($targetssq))
											{

													$monster['Ataque']=0;
													//while($mob = $db->sql_fetchrow($mobber))
													for($i=0; $i<count($mobberArr); $i++)
													{

														switch ($mobberArr[$i]['element']) 
														{
														case "fire":
															$monster['Ataque']+=damageResist($mobberArr[$i]['Ataque'],$player['resist_fire']);
														break;
														case "water":
															$monster['Ataque']+=damageResist($mobberArr[$i]['Ataque'],$player['resist_water']);
														break;
														case "earth":
															$monster['Ataque']+=damageResist($mobberArr[$i]['Ataque'],$player['resist_earth']);
														break;
														case "wind":
															$monster['Ataque']+=damageResist($mobberArr[$i]['Ataque'],$player['resist_wind']);
														break;
														case "dark":
															$monster['Ataque']+=damageResist($mobberArr[$i]['Ataque'],$player['resist_dark']);
														break;
														case "holy":
															$monster['Ataque']+=damageResist($mobberArr[$i]['Ataque'],$player['resist_holy']);
														break;
														}
														$damageLink= "<div class=perfecthit>".$monster['nombre']." hizo ".$monster['Ataque']." de da&ntilde;o a 
														".$player['nombre']."</div>";
														systemLog("party", $damageLink);
													}
													//TEST
													$monster['Ataque']=10;
												
												if($pj['idPersonaje']==$player['idPersonaje'])
													$vidaModifier-=$monster['Ataque'];

												if($player['Vida']>$monster['Ataque'])
												{
													$db->sql_query("UPDATE personaje SET 
																Vida=(Vida-".$monster['Ataque'].")
																WHERE idPersonaje = '".$player['idPersonaje']."'");
												}
												else
												{
													$timemuerto=120;
												$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', 
													killer = '".$monster['nombre']." te mato' WHERE idPersonaje = '".$player['idPersonaje']."'");	
												}
											
										}
									}
								
							break;
							default:
							//// MOB DMG CHANGER
							$monster['Ataque']=bigintval($monster['Ataque']*($monster['nivel']/15));
							if($dungeon['elite'])
							{
								$monster['Ataque']=$monster['Ataque']+bigintval(($monster['Ataque']/2)*$dungeon['eliteLevel']);
							}	

								switch ($monster['element']) 
								{
								case "fire":
									$monster['Ataque']=penetration($monster['Ataque'],$pj['resist_fire']);
								break;
								case "water":
									$monster['Ataque']=penetration($monster['Ataque'],$pj['resist_water']);
								break;
								case "earth":
									$monster['Ataque']=penetration($monster['Ataque'],$pj['resist_earth']);
								break;
								case "wind":
									$monster['Ataque']=penetration($monster['Ataque'],$pj['resist_wind']);
								break;
								case "dark":
									$monster['Ataque']=penetration($monster['Ataque'],$pj['resist_dark']);
								break;
								case "holy":
									$monster['Ataque']=penetration($monster['Ataque'],$pj['resist_holy']);
								break;
								}


								$monsterAttackTrue=false;
							if($monster['attackCooldown']<$now AND $monsterVida>0)
							{
								switch($monster['hardOne'])
								{
									case 1:
										if($monsterVida<$monster['VidaLimit'])
										{
											$monsterHeal-=bigintval($monster['VidaLimit']/100);
										$msgp="<div class=repMonstheal>".$monster['nombre']." se curo ".bigintval($monster['VidaLimit']/100)." de vida.</div>";
											if($pj['party'])
												systemLog("party",$msgp);
											else
												systemLog("self",$msgp);
										}
									break;
									case 2:
										if($monsterVida<$monster['VidaLimit'])
										{
											$monsterHeal-=bigintval($monster['VidaLimit']/10);
										$msgp="<div class=repMonstheal>".$monster['nombre']." se curo ".bigintval($monster['VidaLimit']/10)." de vida.</div>";
											if($pj['party'])
												systemLog("party",$msgp);
											else
												systemLog("self",$msgp);
										}
									break;
								}
								if($stats['oculus']==1)
								{
									 $monster['Critico']=bigintval($monster['Critico']/2);
									 $monster['PC']=bigintval($monster['PC']/2);
								}
								
								$monsterAttackTrue=true;
								unset($fpj);
								
								if($stats['BloodProtector'])
								{
									$query = 'SELECT  p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
									FROM personaje p JOIN clase c USING ( idClase ) 
								WHERE p.location = '.$check['mundo'].' AND p.idPersonaje != '.$log->get("pjSelected").' AND
								p.idPersonaje = '.$stats['BloodProtector'].' AND p.party = '.$pj['party'].' AND p.attackCooldown > '.($now-300).' AND Vida>0 ORDER BY RAND() LIMIT 1';
									$fpj = $db->sql_fetchrow($db->sql_query($query));
								}

								if($fpj)
								{
									$soyYo = false;
									$OtherVidaModifier=$fpj['Vida'];
									$badluck = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
								}
								else
								{
									$fpj = $pj;
									$OtherVidaModifier=$vidaModifier;
									$badluck = $stats;
									$soyYo = true;
								}
								///////////////////////////////////////////////////////////////////////
								if($badluck['defVsChamp'])
								{
									$badluck['Defensa'] = potenciar($badluck['Defensa'],$badluck['defVsChamp']);		
									$badluck['DefensaMagica'] = potenciar($badluck['DefensaMagica'],$badluck['defVsChamp']);
								}
								
								if($badluck['MDMGRedux'])
									{
										$monster['Ataque']= penetration($monster['Ataque'],$badluck['MDMGRedux']);
									}

								

								if(!$monster['raid'])
								if($multyTarget==0)
								{
									if($monster['raidSkillready']==1)
											{
												
												if(!$stats['immunityHelmet'])
													@include("../mobSkill/randomSpell.php");
												else
												{
													$msg = "<spam class='raidname'>".$monster['nombre']."</spam> tiro algo pero sos inmune!";
													systemLog("self",$msg);
												}
												$db->sql_query("UPDATE inmundo SET raidSkillready = 0 WHERE idInMundo = '".$check['idInMundo']."'");
													
											}
											else
											{
													if($monster['nivel']>10)
													if(mt_rand(1,5)==2)
													{
														$db->sql_query("UPDATE inmundo SET raidSkillready = 1 WHERE idInMundo = '".$check['idInMundo']."'");
														$data['counter'] .= "<div class='raidcast'>".$monster['nombre']." esta casteando algo!</div>";
														
														if($pj['party'])
															systemLog("party",$data['counter'],$pj['party']);
														else
															systemLog("self",$data['counter']);
													}	
											}
								}
								else
								{
									if($monster['raidSkillready']==1)
											{
											
												if(!$stats['immunityHelmet'])
													@include("../mobSkill/randomSpell.php");
												else
												{
													$msg = "<spam class='raidname'>".$monster['nombre']."</spam> tiro algo pero sos inmune!";
													systemLog("self",$msg);
												}
												$db->sql_query('UPDATE inmundo im SET raidSkillready = 0 WHERE 
												(im.idInMundo = "'.$id.'" OR im.idInMundo = "'.$id2.'" OR im.idInMundo = "'.$id3.'" OR im.idInMundo = "'.$id4.'" OR im.idInMundo = "'.$id5.'")');
													
											}
											else
											{
													if($monster['nivel']>10)
													if(mt_rand(1,5)==2)
													{
														$db->sql_query('UPDATE inmundo im SET raidSkillready = 1 WHERE 
														(im.idInMundo = "'.$id.'" OR im.idInMundo = "'.$id2.'" OR im.idInMundo = "'.$id3.'" OR im.idInMundo = "'.$id4.'" OR im.idInMundo = "'.$id5.'")');
														$data['counter'] .= "<div class='raidcast'>Los bichos esta casteando algo!</div>";

														$data['monsterCasting']=1; 
															
														if($pj['party'])
															systemLog("party",$data['counter'],$pj['party']);
														else
															systemLog("self",$data['counter']);
													}	
											}
								}
										
									$critical_chanse = mt_rand(1,100);
									if($monster['Ataque']>0)
									{
										$golpeEvadido=false;
												if($badluck['evasion']>0)
													{
														mt_srand((double)microtime()*1000000);
														$asscnac = mt_rand(1,100);
														if($badluck['evasion']>=$asscnac)
															$golpeEvadido=true;
													}
													if($golpeEvadido)
													{
														$data['counter'] .= $fpj['nombre']." evadiste <spam class='raidname'>".$monster['nombre']."</spam>";
													}else
													if($stunGoingOn==1)
													{
														$data['counter'] .= $fpj['nombre']." interrupt attack from  <spam class='raidname'>".$monster['nombre']."</spam>";
														
													}
													else
													if($badluck['SkillShadow']!=1)
													{
														mt_srand((double)microtime()*1000000);
														$shield_chanse = mt_rand(1,100);
														if($badluck['ShieldRate'] >= $shield_chanse)
														{
															$badluck['Defensa'] = $badluck['Defensa'] + $badluck['shieldDef'];
															$blockdata = "(Block)";
														}
														if($monster['Critico'] > $critical_chanse)
														{
															$ataque_monster = critical($monster['Ataque'],$monster['PC']);
															if($monster['raid'] && $badluck['SubClass_DarkProtection'])
														$ataque_monster=intval($ataque_monster/2);
															$data['counter'] .= "<spam class='raidname'>".$monster['nombre']."</spam> golpe critico a ".$fpj['nombre']." de ".defensa($ataque_monster,$badluck['Defensa']).$blockdata."";
														}
														else
														{
															$ataque_monster = normal($monster['Ataque']);
															if($monster['raid'] && $badluck['SubClass_DarkProtection'])
														$ataque_monster=intval($ataque_monster/2);
															$data['counter'] .= "<spam class='raidname'>".$monster['nombre']."</spam> golpeo a ".$fpj['nombre']." por ".defensa($ataque_monster,$badluck['Defensa']).$blockdata."";
														}
														if($badluck['return'])
														{
															$dmged = bigintval((defensa($ataque_monster,$badluck['Defensa'])/100)*$badluck['return']);
															if(($monsterVida-$dmged)>0);
															{
																if($dmged>10000)
																	$dmged=10000;
																$data['counter'] .= " [return ".$dmged."]";
																$danoFinalPuro+=$dmged;
															}
														}
														
													}
													else
													{
														$db->sql_query("DELETE FROM aura WHERE idAura = '".$badluck['ShadowAuraId']."'");
														$data['counter'] .= $fpj['nombre']." evadiste <spam class='raidname'>".$monster['nombre']."</spam>";
														//$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
													}
													$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
													if($monster['raid'] && $badluck['SubClass_DarkProtection'])
														$ataque_monster=intval($ataque_monster/2);
													
													
													
									}
									else
									{
													if($badluck['ninjaMaster']==1)
													{
														$asscnac = mt_rand(1,100);
														if($badluck['ninjaMasterChanse']>$asscnac)
															$badluck['SkillShadow']=1;
													}
													if($stunGoingOn==1)
													{
														$data['counter'] .= $fpj['nombre']." interrumpiste el ataque  <spam class='raidname'>".$monster['nombre']."</spam>";
													}
													else
													if($badluck['SkillShadow']!=1)
													{
														if($monster['CriticoMagico'] > $critical_chanse)
														{
															$ataque_monster = critical($monster['AtaqueMagico'],$monster['PCMagico']);
															if($monster['raid'] && $badluck['SubClass_DarkProtection'])
														$ataque_monster=intval($ataque_monster/2);
															$data['counter'] .= "<spam class='raidname'>".$monster['nombre']."</spam> critico magico ".$fpj['nombre']." de ".defensa($ataque_monster,$badluck['DefensaMagica']).$blockdata."";
														}
														else
														{
															$ataque_monster = normal($monster['AtaqueMagico']);
															if($monster['raid'] && $badluck['SubClass_DarkProtection'])
														$ataque_monster=intval($ataque_monster/2);
															$data['counter'] .= "<spam class='raidname'>".$monster['nombre']."</spam> golpe magico ".$fpj['nombre']." de ".defensa($ataque_monster,$badluck['DefensaMagica']).$blockdata."";
														}
														
													}
													else
													{
														$db->sql_query("DELETE FROM aura WHERE idAura = '".$badluck['ShadowAuraId']."'");
														$data['counter'] .= $fpj['nombre']." evadiste <spam class='raidname'>".$monster['nombre']."</spam>";
													}
											$ataque_monster = defensa($ataque_monster,$badluck['DefensaMagica']);
											if($monster['raid'] && $badluck['SubClass_DarkProtection'])
														$ataque_monster=intval($ataque_monster/2);		
									
									
							}
							////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							if($badluck['ManaShield'] AND $soyYo)
							{
								$manaFinalCOnsume= intval(($ataque_monster/100) * $badluck['ManaShield']);
								if($manaModifier>=$manaFinalCOnsume)
								{
									$ataque_monster = bigintval($ataque_monster-$manaFinalCOnsume);
									$manaModifier-=$manaFinalCOnsume;
								}
							}
							if($badluck['garcamode']==1)
							{
								$OtherVidaModifier+=$ataque_monster;
								if($badluck['VidaLimit']<=$OtherVidaModifier)
								{
									$db->sql_query("DELETE FROM aura WHERE idAura = '".$badluck['garcamodeId']."'");
									$data['counter'] .= "[Garca Mode OFF]";
								}
							}
							else
								$OtherVidaModifier= $OtherVidaModifier - $ataque_monster;
								
								if($OtherVidaModifier<0)
								{
									
									$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> mato a ".$fpj['nombre']."!";
									$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');	
								
							
									$escapedeath=0;
									if($badluck['anilloMuerte']==1)
										{
											if(mt_rand(1,100)<$badluck['anilloMuerteChanc'])
												$escapedeath=1;
										}
									if($escapedeath==1)
									{
										$OtherVidaModifier=bigintval($badluck['VidaLimit']/4);
										$msg = "<spam class='raidcast'>La muerte revivio a ".$fpj['nombre']." !</spam>";
										systemLog("self",$msg);
									}
									
									
									if($OtherVidaModifier<0 AND $badluck['IgnoreDeath']==1)
										{
											$OtherVidaModifier=1;
											$msg = "<spam class='mobKilled'>".$fpj['nombre']." activo Ignore Death!</spam>";
											systemLog("self",$msg);
											$db->sql_query("DELETE FROM aura WHERE idAura = '".$badluck['IgnoreDeathId']."'");
											$data['aura'][] = array("idSkill"=>366,"lvl"=>1,"auraTimeOut"=>1,"pasive"=>0);
											$data['auraRowCheck']=true;	
										}
									
									
									
									if($badluck['inmortal']==1 AND $OtherVidaModifier<0)
									{
										$OtherVidaModifier=1;
										$msg = "<spam class='mobKilled'>".$fpj['nombre']." dice: Soy inmortal!!!!</spam>";
										systemLog("self",$msg);
									}
									
									if($badluck['sobrevivir']==1 AND $OtherVidaModifier<0)
									{
										$OtherVidaModifier=1;
										$msg = "<spam class='mobKilled'>".$fpj['nombre']." activo Sobrevivir!!!!</spam>";
										systemLog("self",$msg);
										$db->sql_query("DELETE FROM aura WHERE idAura = '".$badluck['sobrevivirId']."'");
									}
									if($OtherVidaModifier<0)
									{	
										$timemuerto=120;
											if($badluck['deathRise']==1)
												$timemuerto = 90;
											$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', killer = '".$monster['nombre']." te mato' WHERE idPersonaje = '".$fpj['idPersonaje']."'");	
									}
								}
							}	
							if($monsterAttackTrue)
								if($soyYo)
									$vidaModifier=$OtherVidaModifier;
								else
								{
									$db->sql_query("UPDATE personaje SET 
											Vida='".$OtherVidaModifier."'
											WHERE idPersonaje = '".$fpj['idPersonaje']."'");
									$damageLink= "<div class=dmgtransf>".$pj['nombre']." transfirio ".$ataque_monster." de da&ntilde;o a ".$fpj['nombre']."</div>";

									$db->sql_query('INSERT INTO  chat(party,mensaje) 
								VALUES("'.$fpj['party'].'","'.$damageLink.'")');
								}
								
								if($monster['papa'] || $monster['idMonster']==204)
								{
										$danoEnMonster = bigintval($monsterVidaTotal - 1);
										$danoFinalPuro = 1;
								}	
								else
									$danoEnMonster = bigintval($monsterVidaTotal - $monsterVida);	


								break;
							}
							//////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////
							$danoFinalPuro=bigintval($danoFinalPuro);
							


                         $ownerTime=($now+300);
                        if($pj['inRunz']){ $ownerTime=0; }
						
								if($monsterAttackTrue)
								{
										$db->sql_query("UPDATE inmundo im 
										SET im.attackType = ".$nexAttack.", 
										im.currentLife=(im.currentLife-".($danoFinalPuro+$monsterHeal)."),  
										im.attackCooldown=".($now+$monster['attackSpeed'])." 
										 WHERE ".$monster_hash."");
								}
								else
								{
										$db->sql_query("UPDATE inmundo im 
										SET im.attackType = ".$nexAttack.", 
										im.currentLife=(im.currentLife-".($danoFinalPuro+$monsterHeal).")
										 WHERE ".$monster_hash."");
								}
							
							//////////////////////////////////////////////////
						
								reset($mobber);// Reseteo el array de todos los monstruos seleccionados
								unset($nEnemy);
								$goldModifier = 0;
								$expModifier = 0;
								$championKilled=0;	
								//while($mob = $db->sql_fetchrow($mobber))
								for($i=0; $i<count($mobberArr); $i++)
								{
									

									$currentLife = $mobberArr[$i]['currentLife']-$danoFinalPuro+$monsterHeal;
									
									if($currentLife<=0)
									{
												
					                   $monster['gold']=0;
                                       $monster['exp']=0;

											$monster['gold']= Monster_gold($mobberArr[$i]['nivel'],$mobberArr[$i]['exp']);
											
											$monster['exp'] = Monster_experience($mobberArr[$i]['nivel'],$mobberArr[$i]['exp']);
																					
											if($mob['champion']==1)
											{
												$monster['gold']=$monster['gold']*3;
												$monster['exp']=$monster['exp']*3;
												$championKilled=1;
											}
										
                                        $goldModifier += $monster['gold'];
										$expModifier += $monster['exp'];
										switch ( $monster['monsterType']) {
											case 'perfect':
												$expModifier*3;
											break;
											}
										$nEnemy++;
										$goldAndExp=1;
										$allowDrop=1;
										$db->sql_query("DELETE FROM inmundo WHERE idInMundo = '".$mobberArr[$i]['idInMundo']."'");
										
									}
									else
									{
										$data['mob'][] = array("nombre"=>$mob['nombre'],"foto"=>'mobs/'.$mob['imagen'],"id"=>$mob['idInMundo'],"vida"=>$currentLife
					,"tipo"=>$mob['tipo']);
									}
								}
							}
							
							if($nEnemy)
							{
								//WARZONE

								if($monster['idMonster']==204)
								{
									$query = 'SELECT *
										FROM clan
										WHERE idClan = '.$pj['clan'].'';
									$clan = $db->sql_fetchrow($db->sql_query($query));
									$db->sql_query("UPDATE mundo SET clan = ".$pj['clan']." WHERE id = '".$check['mundo']."'");			
									$db->sql_query("UPDATE personaje 
									SET clanRep = (clanRep+1) 
									WHERE location = '".$check['mundo']."'
									AND clan = ".$pj['clan']);	
									systemLog("global","<div class=warzone_taked> ".$mundo['nombre']." fue tomado por ".$clan['nombre']."! </div>");
									
									$query = "INSERT INTO inmundo (idMonster,tipo,mundo,currentLife,globalmap) 
									VALUES(204,2,".$check['mundo'].",20,1)";		
									$db->sql_query($query);	
								
								}	
								
								if($monster['idMonster']==216)
								{
									if(isset($_SESSION['goblinFound']))
									{
										earnDropBox($_SESSION['goblinFound'],5,$log->get("pjSelected"));
										earnDropBox($_SESSION['goblinFound'],5,$log->get("pjSelected"));
										earnDropBox($_SESSION['goblinFound'],5,$log->get("pjSelected"));
										earnDropBox($_SESSION['goblinFound'],5,$log->get("pjSelected"));
										earnDropBox($_SESSION['goblinFound'],5,$log->get("pjSelected"));
										$boxDroperino=true;
										$boxDropLevel=$monster['nivel'];
										systemLog("party","<div class=recompensaAstral>".$pj['nombre']." mato a Solari!<br> Obtuvo 5 cofres grosos!</div>") ;
									}
								}

								if($monster['idMonster']==217)
								{
									insertBuff($log->get("pjSelected"),589,433,600);
									systemLog("party","<div class=recompensaAstral>".$pj['nombre']." consiguio el poder de Odin!</div>");
								}


								if($monster['idMonster']==242)// SANTA // COMANDANTE
								{
									earnDropBox(1,1,$log->get("pjSelected"),1);
									systemLog("self","<div class=recompensaAstral>Conseguiste un cofre del Comandante!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
									$monster['raid']=0;
									$monster['mapBoss']=0;
								}
								$goblinHunt--;
								
								if($goblinHunt<=0)
								{
										$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife,deQuien) 
														VALUES("242","2",
														"'.$mundo['id'].'","100",'.$log->get("pjSelected").')');
										$goblinHunt = mt_rand(100,500);
										systemLog("party","<div class=bossKilling>Aparecio el Comandante!!!</div>") ;	
								}


									$expModifier = (int)$expModifier*2;
									$goldModifier  = (int)$goldModifier*2;




									if($pj['party']>0 && ($mundo['extraInfo']==1 || $monster['raid'] || $dungeon['conquest']>0))
									{

										$query = 'SELECT count(*) as CONTA
										FROM personaje
										WHERE party = '.$pj['party'].'';
										$partymemb = $db->sql_fetchrow($db->sql_query($query));
										/*
										$expModifier = bigintval($expModifier/$partymemb['CONTA']);
										$goldModifier  = bigintval($goldModifier/$partymemb['CONTA']);
										*/
										
										if($monster['raid'])
										{
											$expModifier = bigintval($expModifier*15);
											$goldModifier  = bigintval($goldModifier*15);
											systemLog("party","<div class=bossKilling>Mataron al Raid Boss ".$monster['nombre']."!<br>
											+".$expModifier." de experiencia.<br>+".$goldModifier." de oro.</div>") ;												
										}
										else
										{
											$expModifier = bigintval($expModifier*3);
											$goldModifier  = bigintval($goldModifier*3);
										}
										$SOLOgold =0;
										$SOLOexp =0;
										$query = 'SELECT p.idCuenta, p.idPersonaje, p.nombre, p.nivel, p.idClase, p.EXPBONUS, p.GOLDBONUS
															FROM personaje p JOIN cuenta c USING (idCuenta)
													WHERE c.pjSelected = p.idPersonaje AND p.attackCooldown > '.($now-300).' AND p.party='.$pj['party'].' AND p.party>0 AND location = '.$pj['location'].' ORDER BY RAND()';
													$targetssq = $db->sql_query($query);	
													$boxDroperino=false;	
													$boxDropLevel=0;		
											while($targets = $db->sql_fetchrow($targetssq))
														{
														
													if($monster['customDrop'])
													{
														include("../customDeaths/dead".$monster['idMonster'].".php");
													}			
													if($monster['mapBoss'])
													{
															earnDropBox($monster['dropLevel'],$monster['dropGrade'],$targets["idPersonaje"]);
															$boxDroperino=true;
															$boxDropLevel=$monster['nivel'];

													}			
													if($monster['raid'])
													{
														//CustomDropADd
														$raidTierDrop=5;
														switch($monster['idMonster'])
														{
															case 172: // barbon
																add_item(656,1,$targets["idCuenta"],1);
															break;
															case 173: // paloma
																add_item(657,1,$targets["idCuenta"],1);
															break;
															case 174: // nazus
																add_item(658,1,$targets["idCuenta"],1);
															break;
															case 175: // Maestruli
																add_item(438,1,$targets["idCuenta"]);

																add_item(659,1,$targets["idCuenta"],1);
															break;
															case 176: // Otakuy
																add_item(449,1,$targets["idCuenta"]);

																add_item(660,1,$targets["idCuenta"],1);
															break;
															case 177: // Zarpan
																add_item(450,1,$targets["idCuenta"]);

																add_item(661,1,$targets["idCuenta"],1);
															break;
															case 205:
																$raidTierDrop=1;
																add_item(662,1,$targets["idCuenta"],1);
															break;
															case 206:
																$raidTierDrop=1;
																include("../customDrops/raidBoss206.php");
																add_item(663,1,$targets["idCuenta"],1);
															break;
															case 207:
																add_item(649,1,$targets["idCuenta"],1);
															break;
															case 208:
																add_item(648,1,$targets["idCuenta"],1);
															break;
															case 209:
																add_item(650,1,$targets["idCuenta"],1);
															break;
															case 210:
																add_item(653,1,$targets["idCuenta"],1);
															break;
															case 211:
																add_item(654,1,$targets["idCuenta"],1);
															break;

														}
														earnDropBox($monster['dropGrade'],$raidTierDrop,$targets["idPersonaje"]);
														$boxDroperino=true;
														$boxDropLevel=$monster['dropGrade'];
													}
													
														$expBonusTxt="";
														$goldBonusTxt="";
													$expPartyVal=0;
													$goldPartyVal=0;
													$expPartyVal=$expModifier;
													$goldPartyVal=$goldModifier;
													if($targets['EXPBONUS']>0)
													{
														$expPartyVal=potenciar($expModifier,$targets['EXPBONUS']);
														$expBonusTxt=" (Bonus: ".($expPartyVal-$expModifier).")";
													}
													if($targets['GOLDBONUS']>0)
													{
														$goldPartyVal=potenciar($goldModifier,$targets['GOLDBONUS']);
														$goldBonusTxt=" (Bonus: ".($goldPartyVal-$goldModifier).")";	 
													}
													if($targets["idPersonaje"]!=$log->get("pjSelected"))	
													{	
														if($targets["nivel"]<LVLLIMIT)
														{
															$db->sql_query("UPDATE personaje SET 
															exp = (exp+".($expPartyVal).") 
															WHERE idPersonaje = '".$targets["idPersonaje"]."'");
															systemLog("other","<div class=partyExpGold>Party: Ganaste ".$expPartyVal.$expBonusTxt." de experiencia y ".(int)($goldPartyVal).$goldBonusTxt." de oro!</div>",$targets["idPersonaje"]) ;	
														}
														else
															systemLog("other","<div class=partyExpGold>Party: Ganaste ".$goldPartyVal.$goldBonusTxt." de oro!</div>",$targets["idPersonaje"]) ;		

														$db->sql_query("UPDATE cuenta 
														SET oro = (oro+".($goldPartyVal).") 
														WHERE idCuenta = ".$targets['idCuenta']);
													}
													else
													{
														if($targets["nivel"]<LVLLIMIT)
															systemLog("other","<div class=partyExpGold>Party: Ganaste ".$expPartyVal.$expBonusTxt." de experiencia y ".$goldPartyVal.$goldBonusTxt." de oro!</div>",$targets["idPersonaje"]) ;	
														else
															systemLog("other","<div class=partyExpGold>Party: Ganaste ".$goldModifier+$goldPartyVal.$goldBonusTxt." de oro!</div>",$targets["idPersonaje"]) ;		
														$SOLOgold = $goldPartyVal;
														$SOLOexp = $expPartyVal;
													
													}
													if($dungeon['conquest']>0)
														include("../customDrops/conquest.php");

											}

											if($stats['EXPBONUS']>0)
												 $expBonusTxt=" (Bonus: ".(potenciar($expModifier,$stats['EXPBONUS'])-$expModifier).")";
											 if($stats['GOLDBONUS']>0)
												 $goldBonusTxt=" (Bonus: ".(potenciar($goldModifier,$stats['GOLDBONUS'])-$goldModifier).")";	 
											$expModifier = potenciar($expModifier,$stats['EXPBONUS']);
											$goldModifier  = potenciar($goldModifier,$stats['GOLDBONUS']);

											if($boxDroperino)	
											{
												systemLog("party","<div class=recompensaAstral>Conseguiste un cofre nivel ".$boxDropLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;		
												if($monster['raid'])
													{
															//CustomMsg
															switch($monster['idMonster'])
															{
																case 175: // Maestruli
																	systemLog("party","<div class=recompensaAstral>Conseguiste un Craft X!</div>") ;		
																break;
																case 176: // Otakuy
																	systemLog("party","<div class=recompensaAstral>Conseguiste un Craft Y!</div>") ;
																break;
																case 177: // Zarpan
																	systemLog("party","<div class=recompensaAstral>Conseguiste un Craft Z!</div>") ;
																break;
															}
														}
											}
	                                     } else {
												 //ALONE
											if($stats['EXPBONUS']>0)
												 $expBonusTxt=" (Bonus: ".(potenciar($expModifier,$stats['EXPBONUS'])-$expModifier).")";
											 if($stats['GOLDBONUS']>0)
												 $goldBonusTxt=" (Bonus: ".(potenciar($goldModifier,$stats['GOLDBONUS'])-$goldModifier).")";	 
											$expModifier = potenciar($expModifier,$stats['EXPBONUS']);
											$goldModifier  = potenciar($goldModifier,$stats['GOLDBONUS']);
											if($monster['mapBoss'])
											{

												
														earnDropBox($monster['dropLevel'],$monster['dropGrade'],$log->get("pjSelected"));
														systemLog("self","<div class=recompensaAstral>Conseguiste un cofre nivel ".$monster['nivel']."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
														
														//logros
														include("../system/logros.php");
														mapReveal($check['mundo']);
														
														

														$query = 'SELECT i.Nombre, i.contable, i.leg, i.idItem, i.subtipo
														 FROM item i
														 WHERE i.tipo = "stone" ORDER BY RAND() LIMIT 0,1';
														 $dropstonessq = $db->sql_query($query);
														 $dropStone = $db->sql_fetchrow($dropstonessq);

														if($dropStone)
														{
															add_item($dropStone['idItem'],1);
														    systemLog("self","<div class=recompensaAstral>Ganaste ".$dropStone['Nombre']."</div>") ;        
														}
													}
													
													systemLog("self","<div class=drop2>".$nEnemy." enemigos derrotados! Ganaste ".$expModifier.$expBonusTxt." de exp y ".$goldModifier.$goldBonusTxt." de oro</div>") ;
											
																					
										}
										
                               
								//$data['info'] .= $msg;
								$data['enemySlaying'] = true;
								
																
								if($stats['soulShitOn'] AND $goldAndExp==1)
										{
											$sumaSouls = $stats['soulAcumulate']+(1*$nEnemy);
											if($sumaSouls<$stats['soulContainer'])
											{
												$db->sql_query("UPDATE aura SET acumuleitor = (acumuleitor+".bigintval($sumaSouls).")  WHERE idAura = '".$stats['soulAuraId']."'");	
												$data['aura'][] = array("idSkill"=>16,"lvl"=>$stats['soulLvl'],"auraTimeOut"=>$sumaSouls,"pasive"=>1);
												$data['auraRowCheck']=true;	
											}
											else 
											{
												$db->sql_query("UPDATE aura SET acumuleitor = ".bigintval($stats['soulContainer'])."  WHERE idAura = '".$stats['soulAuraId']."'");
												$data['aura'][] = array("idSkill"=>16,"lvl"=>$stats['soulLvl'],"auraTimeOut"=>$stats['soulContainer'],"pasive"=>1);
												$data['auraRowCheck']=true;	
											}
										}	
						}
						
	
						
						if($id2==0)	
						{

							$data['monsterLifeLimit']=$monster['VidaLimit'];
						}
						if($SOLOgold>0)
							$goldModifier  =$SOLOgold;
						if($SOLOexp>0)
							$expModifier  =$SOLOexp;
								
							
						$realGold = $log->realGold();
						$log->set("oro",$realGold+$goldModifier);
						$data['gold'] = $realGold+$goldModifier;
						
						if($pj["nivel"]>=LVLLIMIT)
							$expModifier=0;
												
						$data['exp'] = $pj['exp']+$expModifier;
						
						if($goldModifier>0)
						$db->sql_query("UPDATE cuenta SET oro = (oro+".($goldModifier).") WHERE idCuenta = ".$log->get("idCuenta"));
						
                                               // sqlTarget esta en attackMob
						
						$addDpsSQl="";
						if($pj['realDPS']>$pj['maxDPSEver'])
								$addDpsSQl=' maxDPSEver = "'.$pj['realDPS'].'",';				   
						if($cancelAttackCooldownFFS)
							$fisicalCoolDown=0;

						$db->sql_query("UPDATE personaje SET 
                                                ".$sqlTarget."
						Mana = '".$manaModifier."', 
						exp = (exp+".$expModifier."),
						forceDrop = ".bigintval($_SESSION['FORCEDROP']).",
						attackCooldown = '".($now+$fisicalCoolDown)."', 
						realDPSTime = ".$pj['realDPSTime'].",
						realDPS = ".$pj['realDPS'].",
						realDPSAcc = ".$pj['realDPSAcc'].",
						".$addDpsSQl."
						Vida='".$vidaModifier."',
						goblinHunt=".$goblinHunt.",
						online= '".$now."'
						WHERE idPersonaje = '".$log->get("pjSelected")."'");
	
						$data['isPvp']=0;
						$data['realDPS']=$pj['realDPS'];
							

}// ANTI BOT
else
{
	$data['antiBot']=1;
}
						// LOGROS
					//DAMAGE
					if($logros['damage']<$danoFinalPuro && $logros['dmgLevel']<4)
					{
						$boxLevel=0;
						if($danoFinalPuro>1000000 && $logros['dmgLevel']==3)
						{
							$boxLevel=7;
							earnDropBox($boxLevel,3,$log->get("pjSelected"));
							systemLog("self","<div class=recompensaAstral>Lograste un da&ntilde;o mayor a 1kk! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
						}else
						if($danoFinalPuro>100000 && $logros['dmgLevel']==2)
						{
							$boxLevel=5;
							earnDropBox($boxLevel,3,$log->get("pjSelected"));
							systemLog("self","<div class=recompensaAstral>Lograste un da&ntilde;o mayor a 100k! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
						}else
						if($danoFinalPuro>10000 && $logros['dmgLevel']==1)
						{
							$boxLevel=3;
							earnDropBox($boxLevel,3,$log->get("pjSelected"));
							systemLog("self","<div class=recompensaAstral>Lograste un da&ntilde;o mayor a 10k! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
						}else
						if($danoFinalPuro>1000 && $logros['dmgLevel']==0)
						{
							$boxLevel=1;
							earnDropBox($boxLevel,3,$log->get("pjSelected"));
							systemLog("self","<div class=recompensaAstral>Lograste un da&ntilde;o mayor a 1k! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
						}
						if($boxLevel>0)
						$db->sql_query("UPDATE logros SET dmgLevel = (dmgLevel+1), damage = (".$danoFinalPuro.")  WHERE idPersonaje = '".$log->get("pjSelected")."'");	
					}	

						$data['monsterLife'] = $monsterVidaTotal - $danoFinalPuro;	
						$data['monsterLifeLimit'] = $monster['VidaLimit'];	
?> 