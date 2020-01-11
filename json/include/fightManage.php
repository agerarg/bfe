<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////PENETRATIONS
/*$monster['Defensa'] = penetration($monster['Defensa'],$stats['ArmorPenetration']);
$monster['DefensaMagica'] = penetration($monster['DefensaMagica'],$stats['MagicPenetration']);
*/
$aaOn=0;
$mixedid = bigintval($check['idInMundo']);
$danoFinalPuro=0;
$realDpsAcc=0;
$savedmonsterVida=$monsterVida;
$criticalExist=0;
$criticolo=0;
if($stats['corruptHand'])
{
	$data['error'] = "No pudes tener una arma equipada en derecha!";
}
if($stats['DaggerThrowing'])
{
	if($stats['weapon']=="dagger")
		$stats['weapon']="bow";
}
if($stats['FistofFury'])
{
	if($stats['weapon']=="fist")
		$stats['weapon']="dagger";
}
if($stats['hexxar']==1)
{
		$monster['Defensa']=bigintval($monster['Defensa']/2);
		$data['info'] .= "(HEX)";
}
if($stats['altoataque']>0)
{
	if(!$stats['AltokeSwords'])
	{
	if($pvp)
	{
		$query = 'SELECT *
					FROM garcatarget im
					WHERE im.idPersonaje = '.$pj['idPersonaje'].' AND idInMundo = '.$fpj['idPersonaje'].' LIMIT 1 ';
		$garcaTsq = $db->sql_fetchrow($db->sql_query($query));
		if(!$garcaTsq)
		{
				$db->sql_query('INSERT INTO  garcatarget(idPersonaje,idInMundo) 
				VALUES("'.$pj['idPersonaje'].'","'.$fpj['idPersonaje'].'")');

				$stats['Ataque']+=$stats['Ataque']*$stats['altoataque'];
				$stats['AtaqueMagico']+=$stats['Ataque']*$stats['altoataque'];
				$data['info'] .= " (AA x".$stats['altoataque'].") ";
				$aaOn=1;
		}
	}
	else
	{
		$query = 'SELECT *
					FROM garcatarget im
					WHERE im.idPersonaje = '.$pj['idPersonaje'].' AND '.$monster_hash.' LIMIT 1 ';
		$garcaTsq = $db->sql_fetchrow($db->sql_query($query));
		if(!$garcaTsq)
		{
				$db->sql_query('INSERT INTO  garcatarget(idPersonaje,idInMundo) 
				VALUES("'.$pj['idPersonaje'].'","'.$monster['LastIm'].'")');

				$stats['Ataque']+=$stats['Ataque']*$stats['altoataque'];
				$stats['AtaqueMagico']+=$stats['Ataque']*$stats['altoataque'];
				$data['info'] .= " (AA x".$stats['altoataque'].") ";
				$aaOn=1;
		}
	}
	}
	else
	{
		$stats['Ataque']+=$stats['Ataque']*$stats['altoataque'];
		$stats['AtaqueMagico']+=$stats['Ataque']*$stats['altoataque'];
		$data['info'] .= " (AA x".$stats['altoataque'].") ";
		$aaOn=1;
	}
}
if($stats['CkruckOn'])
{
	if($_SESSION['CkruckSv']!=$mixedid)
		{
			$_SESSION['CkruckSv']=$mixedid;
			$_SESSION['CkruckCrit']=0;
		}
		else
		{
			$_SESSION['CkruckCrit']+=5;
			$stats['Critico']+=$_SESSION['CkruckCrit'];
		}
}
if($stats['SniperBow'] AND $stats['Critico']>100)
	$_SESSION['MarcaMuerte']=$mixedid;
if($_SESSION['MarcaMuerte']==$mixedid AND isset($_SESSION['MarcaMuerte']))
{
	$stats['Ataque']+=$stats['Ataque'];
	$data['info'] .= " (Mark) ";
	unset($_SESSION['MarcaMuerte']);
}
if($stats['AngerOn'])
{
	$data['aura'][] = array("idSkill"=>104,"lvl"=>$stats['AngerLvl'],"auraTimeOut"=>$stats['AngerBonus'],"pasive"=>1);
	$data['auraRowCheck']=true;	
}


if($stats['CrDarkLord']==1)
{
	 $saveVidaDL=$vidaModifier;
	 if($_SESSION['CrDL_PLUS'])
	 {
	 	$stats['PCMagico']+=$stats['PCMagico'];
	 	unset($_SESSION['CrDL_PLUS']);
	 }
}
if($stats['Agresion']==1 AND $monster['PJID']!=$stats['AgresionId'] AND $rankedGame==0)
{
	 $data['error'] = "Solo podes atacar al que te tiro agresión!";
	$data['updateAuras']=true;
	 $cancelAttackCooldownFFS=true;
}
else
if($stats['stun']==1)
{
	 $data['error'] = "estas stuneado!";
	$data['updateAuras']=true;
	 
	 $cancelAttackCooldownFFS=true;
}
else
if($skill_id==0) 
// ataque fisico
						{
							$cancelMonsterAutoAttack=0;
							$trueDmg=0;
							$bowattackblock=true;

							if($stats['SubClass_Brutality'])
							{
								$stats['Ataque']=potenciar($stats['Ataque'],50);
							}

							if($stats['weapon']=="bow")
							{
								$bowattackblock=true;
							}
							if($stats['CM_ON'])
							{
								if(mt_rand(1,100)==78)
								{
									$cantidad=mt_rand(1,15);
									add_item(438,$cantidad);
									$msg = '<div class=questMeta>Craft Master creo '.$cantidad.' Craft X</div>';
									systemLog("self",$msg);
								}	
							}
							$hits=1;
							switch($stats['weapon'])
							{
								case "fist":
									$hits=2;
								break;
								case "dual":
									$hits=2;
								break;
							}
							if($stats['runa_dobleHit'])
							{
								if(mt_rand(1,100)<=$stats['runa_dobleHit'])
									$hits++;
							}
							
							if($stats['hits']>0)
								$hits+=$stats['hits'];
							if($stats['ChargeFocus']==1)
							{
								if($stats["ChargeFocusAcc"]>0)
								{
									$data['auraRowCheck']=true;	
									$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['ChargeFocusId']."'");
									$data['aura'][] = array("idSkill"=>371,"lvl"=>$stats["ChargeFocusLvl"],"auraTimeOut"=>0,"pasive"=>1);
									$hits+=$stats["ChargeFocusAcc"];
								}
							}
							$comboTotalDamage=0;
							$comboTotalCriticos=0;
							if($stats['SubClass_LifeGet'])
							{
								$bonusLG=intval($stats['VidaLimit']*0.05);
								$vidaModifier+= $bonusLG;
								$data['info'] .= "(LG:+".$bonusLG.") ";
							}
							///////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////
							for($i=1;$i<=$hits;$i++)
							{
							mt_srand((double)microtime()*1000000);
							$critical_chanse = mt_rand(1,100);

							 if($stats['FireBat'])
							{
								if(mt_rand(1,10)==7)
								{
									$stunGoingOn=1;
									$data['info'] .= " [FireBat Stun]";
								}
							}
							/// DESTROYER THINGS
                             if($stats['basicoMulty']>0)
							{
                                 $stats['Ataque']=bigintval($stats['Ataque']*$stats['basicoMulty']);
                                 $db->sql_query("DELETE FROM aura WHERE idAura = '".$stats['basicoMultyId']."'");
						            $data['aura'][] = array("idSkill"=>179,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
							    $data['auraRowCheck']=true;	
							    $stats['basicoMulty']=0;
							}
							if($stats['Swiftblade']==1)
							{
								if($stats['SwiftbladeAcc']<3)
								{
									$fisicalCoolDown=1;
									$db->sql_query("UPDATE aura SET acumuleitor = (acumuleitor+1)  WHERE idAura = '".$stats['SwiftbladId']."'");
								}
								else
								{
									$db->sql_query("DELETE FROM aura WHERE idAura = '".$stats['SwiftbladId']."'");
									$data['aura'][] = array("idSkill"=>176,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
									$data['auraRowCheck']=true;	
								}
							}
							if($stats['InfinityEadge']==1)
										{
											$result = $stats['IEAcumulate']+100;
											switch($stats['IEALvl'])
											{
												case 1:
													if($result>500)
														$result=500;
													if($stats['CollarInfinito'])
														$result=500;
												break;
												case 2:
													if($result>1000)
														$result=1000;
													if($stats['CollarInfinito'])
														$result=1000;
												break;
												default:
													$result=0;
												break;
											}
											if($stats['BlastMaster'])
												$result=$result*2;
											$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['IEAuraId']."'");
											$data['aura'][] = array("idSkill"=>113,"lvl"=>$stats['IEALvl'],"auraTimeOut"=>$result,"pasive"=>1);
											$data['auraRowCheck']=true;	
										}
							/// ZOMBIE
									if($stats['inmortalityShitOn'])
									{
										$per= bigintval(($vidaModifier * 100) / $stats['VidaLimit']);
										$reverse = 100-$per;
										$inmortality = $reverse;
									$db->sql_query("UPDATE aura SET acumuleitor = ".$inmortality."  WHERE idAura = '".$stats['inmortalityAuraId']."'");	
									$data['aura'][] = array("idSkill"=>68,"lvl"=>$stats['inmortalityLvl'],"auraTimeOut"=>$inmortality,"pasive"=>1);
									$data['auraRowCheck']=true;	
									}
										//// 
										
									if($stats['BasicShield'])
									{
										insertBuff($pj['idPersonaje'],511,364,30);
										$data['aura'] = array("idSkill"=>364,"lvl"=>1,"auraTimeOut"=>30);
										$data['auraCheck']=true;
									}	
							if($bowattackblock)
							{
								$data['animation']=1;
								if($stats['mStrikeShitOn']==1)
								{
									$manaModifier = $manaModifier+$stats['manaHealStr'];
									$data['info'] .= "(MP+".$stats['manaHealStr'].") ";
								}
								if($stats['ManaVamp']>0)
								{
									$manaModifier = $manaModifier+$stats['ManaVamp'];
									$data['info'] .= "(MV+".$stats['ManaVamp'].") ";
								}
								if($monster['ninjaMaster']==1)
								{
									mt_srand((double)microtime()*1000000);
									$asscnac = mt_rand(1,100);
									if($monster['ninjaMasterChanse']>$asscnac)
										$monster['SkillShadow']=1;
								}
								if($monster['SkillShadow']!=1)
								{
									if($stats['skillPowerShitOn']==1)
										{
											$result = $stats['skillPowerAcumulate']+$stats['skillPowerSuma'];
											if($result<500)
											{
												$db->sql_query("UPDATE aura SET acumuleitor = ".$result."  WHERE idAura = '".$stats['skillPowerAuraId']."'");
												$data['aura'][] = array("idSkill"=>69,"lvl"=>$stats['skillPowerLvl'],"auraTimeOut"=>$result,"pasive"=>1);
												$data['auraRowCheck']=true;	
											}
											else
											{
												$db->sql_query("UPDATE aura SET acumuleitor = 500  WHERE idAura = '".$stats['skillPowerAuraId']."'");
												$data['aura'][] = array("idSkill"=>69,"lvl"=>$stats['skillPowerLvl'],"auraTimeOut"=>500,"pasive"=>1);
												$data['auraRowCheck']=true;	
											}
										}
									
									/////////////////////////////////////////////////////////////////
									
										if(isset($_SESSION['NinjaCombo']))
										{
												$data['aura'][] = array("idSkill"=>(900+$_SESSION['NinjaCombo']),"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
												$data['auraRowCheck']=true;	
												unset($_SESSION['NinjaCombo']);
										}
									
									if($stats['critCityShitOn']==1)
									{
										$data['auraRowCheck']=true;	
										if($stats['critCityAcumulate']<$stats['critCityLimit'])
											{
							$db->sql_query("UPDATE aura SET acumuleitor = (acumuleitor+1)  WHERE idAura = '".$stats['critCityAuraId']."'");
									$data['aura'][] = array("idSkill"=>39,"lvl"=>$stats["critNivel"],"auraTimeOut"=>($stats['critCityAcumulate']+1),"pasive"=>1);
											}
											else
											{
												$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['critCityAuraId']."'");
								$data['aura'][] = array("idSkill"=>39,"lvl"=>$stats["critNivel"],"auraTimeOut"=>0,"pasive"=>1);
												$stats['Critico']=100;
												$stats['PC']=$stats['PC']+25;
												$data['info'] .= "(FC) ";
											}
									}
									
									if($monster['ShieldOn']==1)
									{
										mt_srand((double)microtime()*1000000);
										$shield_chanse = mt_rand(1,100);
										if($monster['ShieldRate'] > $shield_chanse)
										{
											$monster['Defensa'] = $monster['Defensa'] + $monster['shieldDef'];
											$blockdata = "(Block)";
											$pvpInfo .= "(Block) ";
										}
									}
									if($stats['SubClass_Perseveroide'])
									{
										$data['auraRowCheck']=true;	
										$mixedid = bigintval($check['idInMundo']+$check['idPersonaje']);
										if($mixedid == $_SESSION['PerseveroideId'])
										{
												$persvStaks=50;
											
											if($_SESSION['PerseveroideAcu']<$persvStaks)
											{
												$_SESSION['PerseveroideAcu']+=5;
												if($_SESSION['PerseveroideAcu']>$persvStaks)
													$_SESSION['PerseveroideAcu']=$persvStaks;

											}
											$stats['Ataque']=potenciar($stats['Ataque'],$_SESSION['PerseveroideAcu']);
											$data['aura'][] = array("idSkill"=>421,
												"lvl"=>1,
												"auraTimeOut"=>$_SESSION['PerseveroideAcu'],
												"pasive"=>1);
										}
										else
										{
											$data['aura'][] = array("idSkill"=>421,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>1);
											$_SESSION['PerseveroideAcu']=0;
											$_SESSION['PerseveroideId']=$mixedid;
										}
									}
									if($stats['perSnowBall']==1)
									{
										$data['auraRowCheck']=true;	
										$mixedid = bigintval($check['idInMundo']+$check['idPersonaje']);
										if($mixedid == $_SESSION['PerSnowId'])
										{
											if($stats['Bluntieitor'])
												$persvStaks=10+$stats['BluntieitorBonus'];
											else
												$persvStaks=10;
											
											if($_SESSION['PerSnowAcu']<$persvStaks)
											{
												if($stats['Bluntieitor'])
													$_SESSION['PerSnowAcu']+=5;
												else
													$_SESSION['PerSnowAcu']++;
												$_SESSION['PerSnowDmg']=bigintval(($stats['Ataque']/3)*($_SESSION['PerSnowAcu']/3));
												if($_SESSION['PerSnowAcu']>$persvStaks)
													$_SESSION['PerSnowAcu']=$persvStaks;

											}
											$stats['Ataque']+=$_SESSION['PerSnowDmg'];
											$data['aura'][] = array("idSkill"=>192,"lvl"=>1,"auraTimeOut"=>$_SESSION['PerSnowAcu'],"pasive"=>1);
										}
										else
										{
											$data['aura'][] = array("idSkill"=>192,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>1);
											$_SESSION['PerSnowDmg']=0;
											$_SESSION['PerSnowAcu']=0;
											$_SESSION['PerSnowId']=$mixedid;
										}
									}

									if($stats['trueDmgPerMana']>0)
									{
										$trueDmg+= bigintval(($stats['ManaLimit']/100)*$stats['trueDmgPerMana']);
										if($hits<=2)
										$data['info'] .= "[+".$trueDmg."]";
									}
									
									if($stats['manijaMode']==1)
									{
										if($stats["manijaModeAcc"]>0)
										{
											$data['auraRowCheck']=true;	
											$manija=$stats["manijaModeAcc"]-1;
											$db->sql_query("UPDATE aura SET acumuleitor = ".$manija."  WHERE idAura = '".$stats['manijaModeId']."'");
											$data['aura'][] = array("idSkill"=>212,"lvl"=>1,"auraTimeOut"=>$manija,"pasive"=>1);
											$critical_chanse=0;
										}
									}
									if($stats['DeathEyeMode']==1)
									{
										if($stats["DeathEyeAcc"]>0)
										{
											$data['auraRowCheck']=true;	
											$stats["DeathEyeAcc"]--;
											$db->sql_query("UPDATE aura SET acumuleitor = ".$stats["DeathEyeAcc"]."  WHERE idAura = '".$stats['DeathEyeId']."'");
											$data['aura'][] = array("idSkill"=>373,"lvl"=>1,"auraTimeOut"=>$stats["DeathEyeAcc"],"pasive"=>1);
											$critical_chanse=0;
											if($stats['Critico']>=100)
											{
												$stats['PC']+=$stats['PC'];
											}
										}
									}
									///////////////////////////////////////////////////////////////////////////////////////
									if($stats['Critico'] > $critical_chanse OR $stats['GranBigSword'])
									{
										$criticalExist=1;
										if($stats['assesination']==1)
										{
											mt_srand((double)microtime()*1000000);
											$asscnac = mt_rand(1,100);
											if($stats['asses_chance']>$asscnac)
											{
												$stats['Ataque']=$stats['Ataque']*5;
												$data['info'] .= "(Assassination) ";
												$pvpInfo .= "(Assassination) ";
											}
										}
										$ataque_player = critical($stats['Ataque'],$stats['PC']);
										if($stats['GranSword'])
											$ataque_player=$ataque_player*2;

										$fkingRealDamage=(defensa($ataque_player,$monster['Defensa'])+$trueDmg);

										if($hits<=2)
										{
											$data['info'] .= " golpe critico de ".optimalDmg($fkingRealDamage)."";
											$pvpInfo .= " golpe critico de ".optimalDmg($fkingRealDamage)."";
										}
										$comboTotalCriticos++;
										///kappaOn
										if($stats['kappaOn'])
										{
													insertBuff($pj['idPersonaje'],361,215,20);
													$data['aura'][] = array("idSkill"=>215,"lvl"=>1,"auraTimeOut"=>20,"pasive"=>0);
													$data['auraRowCheck']=true;	
										}
										if($stats['CritAgro']>0)
										{
											@include("../skillSet/skill13.php");
										}
									}
									else
									{
										
										
										$ataque_player = normal($stats['Ataque']);
										$fkingRealDamage=(defensa($ataque_player,$monster['Defensa'])+$trueDmg);
										if($hits<=2)
										{
											$data['info'] .= " golpe de ".optimalDmg($fkingRealDamage)."";
											$pvpInfo .= " golpe de ".optimalDmg($fkingRealDamage)."";
										}
									}
									////////////////////////////////////////////////////////////////////////////////////////////
									
									$danoFinalPuro+=$fkingRealDamage;
									$trueDmg=0;
									if($monster['garcamode']==1)
									{
										$monsterVida+=($danoFinalPuro);
										if($monster['VidaLimit']<=$monsterVida)
										{
											$db->sql_query("DELETE FROM aura WHERE idAura = '".$monster['garcamodeId']."'");
											$pvpInfo .= "[Garca Mode OFF]";
										}
									}
									else
										$monsterVida=($monsterVida-$danoFinalPuro);


									if($stats['undeadStance'])
									{
										$bonususlf = bigintval(($stats['VidaLimit']/100)*$stats['UndSt']);
										$vidaModifier = $vidaModifier+$bonususlf;
										$data['info'] .= "(US:+".$bonususlf.")";
									}
									if($stats['VampireStance']>0)
									{
										$bonususlf = $stats['VampireStance'];
										$vidaModifier = $vidaModifier+$bonususlf;
										$data['info'] .= "(V:+".$bonususlf.")";
									}
									/////// SHAMAN RESET LOCO ///////////
									if($stats['ShamanInsta'] AND !$stats['ShamanFreeDeny'])
									{
										$stats['ShamanInsta']=0;
											$shamanOp=mt_rand(1,3);
											if($shamanOp==3)
											{
												switch(mt_rand(1,3))
												{
													case 1:
														$data['info'] .= "[Life Drain] ";
														insertBuff($pj['idPersonaje'],306,169,60);
														$idSKillReal=169;
													break;
													case 2:
														$data['info'] .= "[Stun Strike] ";
														insertBuff($pj['idPersonaje'],307,170,60);
														$idSKillReal=170;
													break;
													case 3:
														$data['info'] .= "[Dark Spike] ";
														insertBuff($pj['idPersonaje'],308,171,60);
														$idSKillReal=171;
													break;
												}
												$data['aura'] = array("idSkill"=>$idSKillReal,"lvl"=>1,"auraTimeOut"=>60);
												$data['auraCheck']=true;
											}
									}
									//////// DEVIL PACT START //////////////////////////////////////////////////////////////
									if($stats['DevilPact']==1)
									{
										$chanceall=mt_rand(1,4);
                                                                                if($stats['siempreDemonic'])
                                                                                     $chanceall=3;
										
										if($chanceall==3)
										{
                                                                                   $chance=mt_rand(1,4);
											switch(mt_rand(1,5))
											{
												case 1:
													//FURY
													$idSkill=154;
													$idSKillReal=90;
													$name= "Demonic Fury";
												break;
												case 2:
													//BLOOD
													$idSkill=155;
													$idSKillReal=91;
													$name= "Demonic Blood";
												break;
												case 3:
													//PROTECTION
													$idSkill=156;
													$idSKillReal=92;
													$name= "Demonic Protection";
												break;
												case 4:
													//TERROR
													$idSkill=157;
													$idSKillReal=93;
													$name= "Demonic Terror";
												break;
												case 5:
													//WISDOM
													$idSkill=158;
													$idSKillReal=94;
													$name= "Demonic Wisdom";
												break;
											}
											$buffTime = 120;
											if($stats['DemonicAurasTime'])
											$buffTime = $buffTime+($stats['DemonicAurasTime']*60);
										        
                                                                                        insertBuff($log->get("pjSelected"),$idSkill,$idSKillReal,$buffTime);
											
											$data['aura'] = array("idSkill"=>$idSKillReal,"lvl"=>1,"auraTimeOut"=>120);
											$data['auraCheck']=true;
										}
									}
									//////// DEVIL PACT END //////////////////////////////////////////////////////////////
									$imagenSkill = "basicAttack.jpg";
									//$danoFinalPuro = defensa($ataque_player,$monster['Defensa']);
									//////////////////////////////////////////////////////////////////////
								}
								else
								{
									if($RAIDON==0)
									{
									$db->sql_query("DELETE FROM aura WHERE idAura = '".$monster['ShadowAuraId']."'");
									$completlyEvation=true; 
									$data['counter'] = " evadio el golpe!";
									$msg = " evadiste el golpe!";
									$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje,pvpTarget,nombre,mundo) 
							VALUES("'.$fpj['idPersonaje'].'","'.$msg.'","'.$log->get("pjSelected").'","'.$pj['nombre'].'","'.$check['mundo'].'")');
									}
									else
										$data['counter'] = " evadio el golpe!";
								}
								
							}
							else
							{
								 $data['error'] = "No hay mana para usar el bow";
								  $cancelAttackCooldownFFS=true;
							}
							}//FIN HITS
							///////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////
							///////////////////////////////////////////////////////////////////////////////////////////////
							if($hits>2)
							{
								if($comboTotalCriticos>0)
										$addCC=", ".$comboTotalCriticos." criticos.";
								$data['info'] .= " golpe x".$hits." por ".optimalDmg($danoFinalPuro)."".$addCC;
								$pvpInfo .= " golpe x".$hits." por ".optimalDmg($danoFinalPuro)."".$addCC;
							}
						}	
						else // SKILL
						{
							if($stats['Silence']==1)
								{
									 $data['error'] = "Estas silenciado!";
									$data['updateAuras']=true;
									 echo json_encode($data);
									 die();
								}

							$query = 'SELECT s.*, sl.cooldownCurrent, sl.idPersonaje, sl.idSkillLearn
							FROM skill s, skilllearn sl
							WHERE sl.disable= 0 AND s.idSkill = '.$skill_id.' AND sl.idSkill = s.idSkill AND sl.idPersonaje = '.$pj['idPersonaje'].' '.$sqlRank.' ORDER BY s.nivel DESC
							LIMIT 0,1';
							$skillsq = $db->sql_query($query);
							$skill = $db->sql_fetchrow($skillsq);	
							
							if($skill)
							{
								$imagenSkill = $skill['imagen'];
								if($stats['preparate']>0)
								{
										$skill['cooldown']=1;
										$skill['costomp']=0;
										$db->sql_query("DELETE FROM aura WHERE idAura = '".$stats['preparateId']."'");
										$data['aura'][] = array("idSkill"=>201,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
										$data['auraRowCheck']=true;	
										$data['info'] .= "(Prep)";
								}
								if(strlen($skill['requiere'])>1 AND !strpos('asd,'.$skill['requiere'].',asd', $stats['weapon']) AND $stats['meChupa']==0)
								{
									 $data['error'] = "Necesitas una arma tipo ".$skill['requiere']." para usar ese poder!";
									 $cancelAttackCooldownFFS=true;
								}
								else
								if($skill['cooldownCurrent']<=$now)
								{ 
									if($skill['onlyPlayer']==0 OR ($skill['onlyPlayer']==1 AND $check['tipo']==1))
									{
									//										
									if($stats['CostStance']>0)	
									{
										$mpper = ($skill['costomp']/100);
										$skill['costomp'] = $skill['costomp']-bigintval($mpper*$stats['CostStance']);
									}
									$manaModifier = bigintval($manaModifier-$skill['costomp']);
									if($manaModifier>0)
									{
                                                                                /// ZOMBIE
									if($stats['inmortalityShitOn'])
									{
										$per= bigintval(($vidaModifier * 100) / $stats['VidaLimit']);
										$reverse = 100-$per;
										$inmortality = $reverse;
									$db->sql_query("UPDATE aura SET acumuleitor = ".$inmortality."  WHERE idAura = '".$stats['inmortalityAuraId']."'");	
									$data['aura'][] = array("idSkill"=>68,"lvl"=>$stats['inmortalityLvl'],"auraTimeOut"=>$inmortality,"pasive"=>1);
									$data['auraRowCheck']=true;	
									}
									
									if($stats['CastAutHeal']>0)
									{
										$vidaModifier+=$stats['CastAutHeal'];
										$data['info'] .= "(+".$stats['CastAutHeal']." HP)";
									}
										////
										$data['skillCanceled']=0;
										$cancelMonsterAutoAttack=0;
										
										if($monster['SkillShadow']==1 AND $RAIDON==1)
										{
											$data['counter'] = " Evadio la habilidad ".$skill['nombre']."!";
										}
										else
										{
											if($stats['skillPowerShitOn']==1)
											{
													
													if($stats['skillPowerAcumulate']>1)
													{
														$powerDown = $stats['skillPowerAcumulate']-bigintval($stats['skillPowerAcumulate']/4);
														$db->sql_query("UPDATE aura SET acumuleitor = ".$powerDown."  WHERE idAura = '".$stats['skillPowerAuraId']."'");
														$data['aura'][] = array("idSkill"=>69,"lvl"=>$stats['skillPowerLvl'],"auraTimeOut"=>$powerDown,"pasive"=>1);
														$data['auraRowCheck']=true;	
													}
													else
													{
														$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['skillPowerAuraId']."'");
														$data['aura'][] = array("idSkill"=>69,"lvl"=>$stats['skillPowerLvl'],"auraTimeOut"=>0,"pasive"=>1);
														$data['auraRowCheck']=true;	
													}
											}

											if($stats['ChargeFocus']==1)
											{
												if($stats["ChargeFocusAcc"]<$stats['ChargeFocusLimit'])
												{
													$data['auraRowCheck']=true;	
													$db->sql_query("UPDATE aura SET acumuleitor = (acumuleitor+1)  WHERE idAura = '".$stats['ChargeFocusId']."'");
													$data['aura'][] = array("idSkill"=>371,"lvl"=>$stats["ChargeFocusLvl"],"auraTimeOut"=>($stats["ChargeFocusAcc"]+1),"pasive"=>1);
												}
											}
											if($stats['overpower']==1 AND $aaOn==0)
											{

												$stats['Ataque']+=$stats['Ataque'];
												$stats['AtaqueMagico']+=$stats['Ataque'];
												$db->sql_query("DELETE FROM aura WHERE idAura = '".$stats['overpowerId']."'");
												$data['aura'][] = array("idSkill"=>203,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>0);
												$data['auraRowCheck']=true;	
												$data['info'] .= " (OP) ";
												
												$stats['Critico']=200;
												$stats['CriticoMagico']=200;
												$stats['overpower']=0;
												$stats['overpowerON']=1;
											}
											if($stats['IlluminatiOn'])
											{
												if($_SESSION['IlluminatiSv']!=$mixedid)
													{
														$_SESSION['IlluminatiSv']=$mixedid;
														$_SESSION['IlluminatiCrt']=0;
													}
													else
													{
														$_SESSION['IlluminatiCrt']+=5;
														$stats['CriticoMagico']+=$_SESSION['IlluminatiCrt'];
													}
											}
											if($stats['EnemyWeakness'])
											{
												if($_SESSION['EnemyWeaknessSV']!=$mixedid)
													{
														$_SESSION['EnemyWeaknessSV']=$mixedid;
														$_SESSION['EnemyWeaknessEF']=5;
													}
													else
													{
														if($_SESSION['EnemyWeaknessEF']>=60)
															$_SESSION['EnemyWeaknessEF']=60;
														$monster['Defensa']=penetration($monster['Defensa'],$_SESSION['EnemyWeaknessEF']);
														$_SESSION['EnemyWeaknessEF']+=10;
													}
											}
											if($stats['clarckDagger'])
												{
													if(mt_rand(1,10)==3)
													{
														$stunGoingOn=1;
														$data['info'] .= " [Clarck Stun]";
													}
												}
											if($stats['SubClass_Combo'])
												{
													$query = 'SELECT sl.idSkill, s.nombre
															FROM skilllearn sl JOIN skill s USING ( idSkill )
															WHERE s.active = 1 AND sl.disable = 0 
															AND sl.idSkill != '.(int)$skill['idSkill'].' 
															AND sl.cooldownCurrent < '.$now.'  AND sl.idPersonaje = '.$pj['idPersonaje'].' ORDER BY RAND() LIMIT 1 ';
													$skillm = $db->sql_fetchrow($db->sql_query($query));
													if($skillm)
													{
														if($_SESSION['SubCombo'] > 0 AND 
															$_SESSION['SubCombo_skill']==$skill['idSkill'] AND 
															$_SESSION['SubCombo'] <=5 AND 
															$_SESSION['SubComboTarget'] == $mixedid )
														{		
															$data['aura'][] = array("idSkill"=>424,"lvl"=>1,
																"auraTimeOut"=>$_SESSION['SubCombo'],"pasive"=>1);
															$data['auraRowCheck']=true;	
															$_SESSION['SubCombo']++;
															$stats['Ataque']=potenciar($stats['Ataque'],$_SESSION['SubCombo']*10);
															$stats['AtaqueMagico']=potenciar($stats['AtaqueMagico'],$_SESSION['SubCombo']*10);

														}
														else
														{
															$data['aura'][] = array("idSkill"=>424,"lvl"=>1,
																"auraTimeOut"=>0,"pasive"=>1);
															$data['auraRowCheck']=true;	
															$_SESSION['SubCombo']=1;
															$_SESSION['SubComboTarget'] = $mixedid;
														}
														$data['info'] .= "(Combo: ".$skillm['nombre'].") ";
														$_SESSION['SubCombo_skill']=$skillm['idSkill'];
													}
												}



											@include("../skillSet/skill".$skill['idRealSkill'].".php");
											
											$realDpsAcc+=$danoFinalPuro;
											if($monster['bastHunter']==1)
											{
												$bhDmg=bigintval(($monsterVida/100)*2);
												$data['info'] .= "(BH:".$bhDmg.")";
												$monsterVida-=$bhDmg;
											}
											if($monster['garcamode']==1)
											{
												if($danoFinalPuro>0)
												{
													$monsterVida+=$danoFinalPuro+$danoFinalPuro;
													if($monster['VidaLimit']<=$monsterVida)
													{
														$db->sql_query("DELETE FROM aura WHERE idAura = '".$monster['garcamodeId']."'");
														$pvpInfo .= "[Garca Mode OFF]";
													}
												}
											}
											if($stats['BloodBath']==1)
											{
												$bonusmcv = bigintval(($stats['VidaLimit']/100)*2);
												$vidaModifier = $vidaModifier+$bonusmcv;
												$data['info'] .= "(BB:".$bonusmcv.")";
											}
											if($stats['MagicCritcVamp']>0)
											{
												if($criticolo==1)
												{
													$bonusmcv = bigintval(($stats['VidaLimit']/100)*$stats['MagicCritcVamp']);
													$vidaModifier = $vidaModifier+$bonusmcv;
													$data['info'] .= "(CV:".$bonusmcv.")";
												}
											}
											///kappaOn
										if($stats['kappaOn'])
										{
											if($criticolo==1)
												{
													insertBuff($pj['idPersonaje'],361,215,20);
													$data['aura'][] = array("idSkill"=>215,"lvl"=>1,"auraTimeOut"=>20,"pasive"=>0);
													$data['auraRowCheck']=true;	
											}
										}
											
										
										}
										$data['idSkill'] = $skill['idSkill'];
										
										if($stats['cooldownReduction']>0)
										 $skill['cooldown']=penetration($skill['cooldown'],$stats['cooldownReduction']);
										 
										$db->sql_query("UPDATE skilllearn SET 
											cooldownCurrent = '".($now+$skill['cooldown']-1)."' 
											 WHERE idSkillLearn = '".$skill['idSkillLearn']."'");
										$data['newCoolDown'] = $skill['cooldown'];
									}
									else
									{
									 	$data['error'] = "No tienes suficiente mana para usar ".$skill['nombre']."!";
										 $cancelAttackCooldownFFS=true;
										$manaModifier=$pj['Mana'];
									}
									}
									else
									 $data['error'] = $skill['nombre']." can only be used against people!";
								}
								else
								{
									$data['error'] = $skill['nombre']." esta en cooldown!";
									 $cancelAttackCooldownFFS=true;
								}
								
							}
							else
								$data['error'] = "Error no skill.";
						}
						if($stats['CrDarkLord']==1)
						{
							 if($saveVidaDL<$vidaModifier)
							 {
							 	$_SESSION['CrDL_PLUS']=1;
							 }
						}
						if($stats['AuraSwordPike'] && $ataque_player>1)	
						{
							if($criticalExist==0 && $criticolo==0)
							{
								if($stats['AuraSwordPikeAcc']<10)
												{
								$db->sql_query("UPDATE aura SET acumuleitor = (acumuleitor+1)  WHERE idAura = '".$stats['AuraSwordPikeId']."'");
								$data['aura'][] = array("idSkill"=>444,"lvl"=>1,"auraTimeOut"=>($stats['AuraSwordPikeAcc']+1),"pasive"=>1);
												}
												else
												{
								$db->sql_query("UPDATE aura SET acumuleitor = 10  WHERE idAura = '".$stats['AuraSwordPikeId']."'");
								$data['aura'][] = array("idSkill"=>444,"lvl"=>1,"auraTimeOut"=>10,"pasive"=>1);
												
												}
							}
							else
							{
								if($stats['AuraSwordPikeAcc']>0)
												{
								$db->sql_query("UPDATE aura SET acumuleitor = (acumuleitor-1)  WHERE idAura = '".$stats['AuraSwordPikeId']."'");
								$data['aura'][] = array("idSkill"=>444,"lvl"=>1,"auraTimeOut"=>($stats['AuraSwordPikeAcc']-1),"pasive"=>1);
												}
												else
												{
								$db->sql_query("UPDATE aura SET acumuleitor = 0  WHERE idAura = '".$stats['AuraSwordPikeId']."'");
								$data['aura'][] = array("idSkill"=>444,"lvl"=>1,"auraTimeOut"=>0,"pasive"=>1);
												
												}
							}
							$data['auraRowCheck']=true;	
						}

						/*if($pvp AND $savedmonsterVida<$monsterVida AND $pjEnemyLevel>70)
						{
							$danovirtual = $savedmonsterVida-$monsterVida;
							$finaldano = intval($danovirtual/(0.625*$pjEnemyLevel));
							$pvpInfo.=" (Daño PVP: ".$finaldano.")";
							$monsterVida = $savedmonsterVida-$finaldano;
						}*/
?> 