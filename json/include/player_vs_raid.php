<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$cancelMonsterAutoAttack=1;
$query = 'SELECT * FROM monster
							WHERE idMonster = '.$check['idMonster'].'';
						$monster = $db->sql_fetchrow($db->sql_query($query));
						$monsterVida=$check['currentLife'];
if($monsterVida<=0)
 $alreadydeathRaid=1;
if($estoyMuerto==1)
{
	$data['error'] = "No podes atacar cuando estas muerto.";
}else
if($check['mundo']!=$pj['location'])
{
		$data['error'] = "El raid esta en otro mundo!";
}else
if($monster['dimen']!=$stats['dimension'])
{
		$data['error'] = "The monster is on other dimencion!";
}
else if($monsterVida<=0)
	$data['error'] = "El raid ya fue derrotado!";
else
{						
						$ataque_monster=0;
						$ataque_player=0;
						$RAIDON=1;
						switch($monster['idMonster'])
						{
							case 102:
								include("../raids/defensivo/witch.php");
							break;
							case 104:
								include("../raids/defensivo/ninja.php");
							break;
							case 106:
								include("../raids/defensivo/resistInterrupt.php");
							break;
						}
						$monster['Defensa']=($monster['Defensa']*2);
						$monster['DefensaMagica']=($monster['DefensaMagica']*2);
						include("include/fightManage.php");
						
						systemLog("party","<div class=partyDmg>".$pj['nombre']." ".$data['info']."<div>");
						//////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////						
						$raidAttack=0;
						$query = 'SELECT *
						FROM  raidinfo WHERE idPlayer = '.$log->get("pjSelected").' AND idRaid='.$monster['idMonster'].' AND raidDay = '.$today.' AND targetRaid = '.$check['idInMundo'].' AND killed=0';
						$raid = $db->sql_fetchrow($db->sql_query($query));
						if(!$raid)
							$db->sql_query('UPDATE raidinfo SET targetRaid = '.$check['idInMundo'].' WHERE
									idPlayer = '.$log->get("pjSelected").' AND idRaid='.$monster['idMonster'].' AND raidDay = '.$today.' AND killed=0');
					
											
						if($monsterVida>=0)
						{
							if($check['attackCooldown']<$now)
							{
								$raidAttack=1;
								
								if($check['hateAuraTimer']>$now)
								{
									$query = 'SELECT  p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
								FROM personaje p , clase c
							WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND
							p.idPersonaje = '.$check['idTanker'].' AND Vida>0 ORDER BY RAND() LIMIT 1';
									$fpj = $db->sql_fetchrow($db->sql_query($query));
								}
								if(!$fpj)
								{
									$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
									FROM personaje p , clase c
								WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND Vida>0 ORDER BY RAND() LIMIT 1';
									$fpj = $db->sql_fetchrow($db->sql_query($query));
								}
								
								$badluck = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
								$OtherVidaModifier=$fpj['Vida'];
								
								////RAID ATTACK////
								mt_srand((double)microtime()*1000000);
								$critical_chanse = mt_rand(1,100);
								
								if($check['raidSkillready']==1)
								{
									$db->sql_query("UPDATE inmundo SET raidSkillready = 0 WHERE idInMundo = '".$check['idInMundo']."'");
									switch($monster['idMonster'])
									{
										case 105:
											include("../raids/skills/megaHeal.php");
										break;
										case 102:
											include("../raids/skills/witchSummon.php");
										break;
										case 36:
											include("../raids/skills/queenSummon.php");
										break;
										case 81:
											include("../raids/skills/trulyMaestruli.php");
										break;
										default:
											switch(mt_rand(1,4))
											{
												case 1:											
													include("../raids/skills/groupdamage.php");
												break;
												case 2:
													include("../raids/skills/silence.php");
												break;
												case 3:
													include("../raids/skills/maestruli.php");
												break;
												case 4:
													include("../raids/skills/confusion.php");
												break;
												default:
													$data['counter'] .= "error*".$slector."*";
												break;
											}
									break;
									}
								}
								else
								{
									// AUTOATTACK SKILL
									switch($monster['idMonster'])
									{
										case 36:
											include("../raids/queen.php");
										break;
										case 43:
											include("../raids/doom.php");
										break;
									}
									
										$monster['Ataque']+=intval($monster['Ataque']*($monster['nivel']/25));
										
										mt_srand((double)microtime()*1000000);
										$shield_chanse = mt_rand(1,100);
										if($badluck['ShieldRate'] > $shield_chanse)
										{
											$badluck['Defensa'] = $badluck['Defensa'] + $badluck['shieldDef'];
											$blockdata = "(Block)";
										}
										if($monster['Critico'] > $critical_chanse)
										{
											$ataque_monster = critical($monster['Ataque'],$monster['PC']);
											$data['counter'] .= "<spam class='raidname'>".$monster['nombre']."</spam> critical hit to ".$fpj['nombre']." for ".defensa($ataque_monster,$badluck['Defensa']).$blockdata." damage";
										}
										else
										{
											$ataque_monster = normal($monster['Ataque']);
											$data['counter'] .= "<spam class='raidname'>".$monster['nombre']."</spam> hit ".$fpj['nombre']." for ".defensa($ataque_monster,$badluck['Defensa']).$blockdata." damage";
										}
										if($badluck['return'])
										{
											$dmged = intval((defensa($ataque_monster,$badluck['Defensa'])/100)*$badluck['return']);
											if(($monsterVida-$dmged)>0);
											{
												if($dmged>200)
													$dmged=200;
												$data['counter'] .= " [return ".$dmged." damage]";
												$monsterVida=$monsterVida-$dmged;
											}
										}
										////
								///////
								//////
								////
								$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
								
								// AUTOATTACK DAMAGE
									switch($monster['idMonster'])
									{
										case 107:
											include("../raids/vampire.php");
										break;
									}

									$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');

								$OtherVidaModifier= $OtherVidaModifier - $ataque_monster;
								if($OtherVidaModifier<0)
								{
									$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> mato ".$fpj['nombre']."!";
									
									$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');
								}
																
								if($fpj['idPersonaje']!=$log->get("pjSelected"))
								{
									if($OtherVidaModifier>0)
									{
										$db->sql_query("UPDATE personaje SET 
										Vida='".$OtherVidaModifier."'
										WHERE idPersonaje = '".$fpj['idPersonaje']."'");
									}
									else
									{
										$data['counter'] .= " ".$fpj['nombre']." murio!";
										$timemuerto=120;
										if($badluck['deathRise']==1)
											$timemuerto = 90;
										$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', killer = '".$monster['nombre']." te mato' WHERE idPersonaje = '".$fpj['idPersonaje']."'");
										
									}
								}
								else
								{
									$vidaModifier=$OtherVidaModifier;
								}
								$db->sql_query('UPDATE raidinfo SET damageDeal = (damageDeal+'.intval($danoFinalPuro).') WHERE 
									idPlayer = '.$log->get("pjSelected").' AND idRaid='.$monster['idMonster'].' AND raidDay = '.$today.' AND targetRaid = '.$check['idInMundo'].' AND killed=0');
								//CAST
									if(mt_rand(1,4)==2)
									{
										$db->sql_query("UPDATE inmundo SET raidSkillready = 1 WHERE idInMundo = '".$check['idInMundo']."'");
											$data['counter'] = "<spam class='raidcast'>".$monster['nombre']." esta por lanzar algo!!!</spam>";
										$db->sql_query('INSERT INTO  chat(party,mensaje) 
								VALUES("'.$fpj['party'].'","'.$data['counter'].'")');
									}
								///
								}
								
							}
							
						}
						else/// MUERTO
						{

							$today = date("z");
							if(!$alreadydeathRaid)
							{
                                                        $db->sql_query("UPDATE inmundo SET currentLife = 0 WHERE idInMundo = '".$check['idInMundo']."'");
							$monster['gold']= Monster_gold($monster['nivel'],$monster['exp']);
							if($stats['GOLDBONUS']>0)
								$monster['gold']= potenciar($monster['gold'],$stats['GOLDBONUS']);
						
							$monster['exp'] = Monster_experience($monster['nivel'],$monster['exp']);
							if($stats['EXPBONUS']>0)
								$monster['exp']= potenciar($monster['exp'],$stats['EXPBONUS']);
							$expModifier = $monster['exp'];
							$goldModifier = $monster['gold'];
							include("include/misionStaffParty.php");
																
							$monsterVida=0;
							include("include/drop.php");
							$fecha = date("Y-m-d");
							
							$query = 'SELECT MAX(idLogroRaid) AS ID FROM logroraid ';
							$logrmaxsq = $db->sql_query($query);
							$logrmax = $db->sql_fetchrow($logrmaxsq);
							$LogroRaidID = $logrmax['ID']+1;
							
								$db->sql_query('INSERT INTO  chat(party,mensaje) 
								VALUES("'.$pj['party'].'","<div class=raidname>'.$monster['nombre'].' fue derrotado!</div><div>gano '.$expModifier.' exp and '.$goldModifier.' gold!</div>")');
							
							
							$db->sql_query('INSERT INTO  logroraid(raidId,fecha) 
								VALUES("'.$monster['idMonster'].'","'.$fecha.'")');
							
						$query = 'SELECT p.idCuenta, p.nombre, p.nivel, p.idPersonaje
										FROM cuenta c, personaje p
					WHERE p.location = '.$check['mundo'].' AND c.pjSelected = p.idPersonaje AND p.attackCooldown > '.($now-600).' AND p.party='.$pj['party'].' AND c.idCuenta = p.idCuenta';
								$targetssq = $db->sql_query($query);
								while($targets = $db->sql_fetchrow($targetssq))
								{
									if($heroes)
										$heroes .= ', ';
									$heroes .= $targets['nombre'];
									$drop = raidDrop($monster['idMonster'],$targets['idCuenta'],$targets['nombre'],$LogroRaidID,$targets["idPersonaje"],$monster['dropGrade']);
									if($drop['exito']==1)
											systemLog("party",$drop['dropMsg']);
									if($targets["nivel"]<LVLLIMIT)
											$db->sql_query("UPDATE personaje SET exp = (exp+".$expModifier.") WHERE idPersonaje = '".$targets["idPersonaje"]."'");
									$db->sql_query("UPDATE cuenta SET oro = (oro+".$goldModifier.") WHERE idCuenta = ".$targets['idCuenta']);
								}
							$tiempoTransc = $monster['battleTime'] - ($check['warTime']-$now);	
							$db->sql_query("DELETE FROM inmundo WHERE mundo = '".$check['id']."'");
							$db->sql_query('UPDATE raidinfo SET damageDeal = (damageDeal+'.intval($danoFinalPuro).') WHERE 
									idPlayer = '.$log->get("pjSelected").' AND idRaid='.$monster['idMonster'].' AND raidDay = '.$today.' AND targetRaid = '.$check['idInMundo'].' AND killed=0');
								
						
							$db->sql_query("UPDATE raidinfo SET killed = 1, tiempo = ".$tiempoTransc.", idLogroRaid=".$LogroRaidID."  WHERE idRaid=".$monster['idMonster']." AND killed = 0 AND raidDay = ".$today."");
							
							$db->sql_query("DELETE FROM raidinfo WHERE idRaid=".$monster['idMonster']." AND killed = 0 AND raidDay = ".$today." AND targetRaid != ".$check['idInMundo']."");
							
							
							
							if($monster['onDeathDo'])
							{
								@include("../raids/onRaidKill/raidDie".$monster['idMonster'].".php");	
							}
							$db->sql_query("DELETE FROM inmundo WHERE mundo = '".$check['mundo']."'");
							$db->sql_query("UPDATE mundo SET warTime = 0 WHERE id = '".$check['mundo']."'");
							
							
						}
						}
						
						if($monsterVida>$monster['VidaLimit'])
							$monsterVida=$monster['VidaLimit'];
						if($raidAttack==0)
							$db->sql_query("UPDATE inmundo SET currentLife = '".$monsterVida."' WHERE idInMundo = '".$check['idInMundo']."'");
						else
							$db->sql_query("UPDATE inmundo SET currentLife = '".$monsterVida."', attackCooldown=".($now+$monster['attackSpeed'])."  WHERE idInMundo = '".$check['idInMundo']."'");
						
						if($check['warTime']<$now AND $monsterVida>0)
						{
							$data['counter'] = "Se acabo el tiempo!";
							$db->sql_query("DELETE FROM inmundo WHERE mundo = '".$check['id']."'");
							$db->sql_query("DELETE FROM raidinfo WHERE idRaid=".$monster['idMonster']." AND killed = 0 AND raidDay = ".$today."");
						}
}
						$data['monsterLife'] = $monsterVida;	
						$data['monsterLifeLimit'] = $monster['VidaLimit'];	
?> 