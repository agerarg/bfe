<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
include('../system/funciones.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
if($log->check())
{
		$now = tiempoReal();
		$monster_id = intval($_GET['id']);
		$skill_id = intval($_GET['skill']);
		$data['newCoolDown']=1;
		$timemuerto = 120;
		$today = date("z");
		$data['antiBot']=0;
		$query = 'SELECT p.*,c.imagen, c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN FROM personaje p JOIN clase c USING ( idClase )
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
		$pj = $db->sql_fetchrow($db->sql_query($query));
		if($pj['deathTime']>$now)
			$estoyMuerto=1;
		if($pj['inTorneo'])
		$idTorneo=$pj['idTorneo'];
         $myMmr = $pj['mmr'];       
		$imagen = $pj['imagen'].'_'.$pj['sexo'].'.jpg';
		$stats = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
		if($pj['Vida']>$stats['VidaLimit'])
			$pj['Vida']=$stats['VidaLimit'];
		
		if($pj['deathTime']<$now)
		{
		$query = 'SELECT p.mmr, p.idPersonaje,p.nivel, p.sexo, p.nombre AS NAMER, p.Vida, rm.id AS RMID, rm.startAt
				FROM ranked_match rm LEFT JOIN personaje p on (rm.idPlayer1 = p.idPersonaje OR rm.idPlayer2 = p.idPersonaje) AND rm.winner=0 
				WHERE p.idPersonaje = '.$monster_id.' AND (rm.idPlayer1 = '.$pj['idPersonaje'].' OR rm.idPlayer2 = '.$pj['idPersonaje'].')';
		
		$checkkk = $db->sql_query($query);
		$check = $db->sql_fetchrow($checkkk);
		if($check)
		{
			
			if($pj['attackCooldown']<=$now)
			{
				//LIFE REGEN
				$regGoing=false;
				$VIDA = $pj['Vida'];
				$MANA = $pj['Mana'];
				while($now>$pj['regenTime'])
				{
					$VIDA+=$stats['HpRegen'];
					$MANA+=$stats['MpRegen'];
					$pj['regenTime']+=10;
					if($VIDA>$stats['VidaLimit'] AND $MANA>$stats['ManaLimit'])
						break;
					
					$regGoing=true;
				}
				if($VIDA>$stats['VidaLimit'])
					$VIDA=$stats['VidaLimit'];
				if($MANA>$stats['ManaLimit'])
					$MANA=$stats['ManaLimit'];
				if($regGoing)
					$db->sql_query("UPDATE personaje SET regenTime='".($now+10)."'  WHERE idPersonaje = '".$pj['idPersonaje']."'");
				
				$manaModifier = $MANA;
				$vidaModifier = $VIDA;
				$data['skillCanceled']=1;
				$data['info'] = "";
				$goldModifier = 0;
				$expModifier = 0;
				$goldAndExp=0;
				$data['drop']=0;
				$fisicalCoolDown = $stats['PSpeed'];
				$cancelAttackCooldownFFS=false;
///////////////////////////////////////////////////////////////////////////////////////////////////////		

				
				//
				$check['idPlayer'] = $check['idPersonaje'];
				$monster['PJID'] = $check['idPersonaje'];
				$check['tipo']=1;
				$check['LUGARLOCO']= "free";
				$rankedGame = 1;
				$enemigoDerrotado = 0;
				
				if($check['startAt']>time())
				{
					$data['error'] .= "Todavia no puedes atacar!" ;
						echo json_encode($data);
						die();
				}
				
				include("include/player_vs_player.php");
				
				if($pj['inTorneo']==1)
				{
						$query = 'SELECT *
										FROM  torneo_posicion tp WHERE (tp.idMascota1 = '.$log->get("pjSelected").' OR tp.idMascota2 = '.$log->get("pjSelected").') AND tp.idTorneo = '.$idTorneo.' AND tp.ganador = 0';
						$Htorneo = $db->sql_fetchrow($db->sql_query($query));
						
						if($Htorneo['idMascota1'] == $log->get("pjSelected"))
						{
							$vida1=$vidaModifier;
							$vida2=$monsterVida;
						}
						else
						{
							$vida2=$vidaModifier;
							$vida1=$monsterVida;
						}
						$skillUse = intval($skill['idSkill']);
						$danoFinalPuro = intval($danoFinalPuro);
							$db->sql_query('INSERT INTO
							torneo_history(idTorneo,idPosicion,vida1,vida2,skilluse,damage,playerMove) 
		                            VALUES('.$idTorneo.',"'.$Htorneo['idPosicion'].'",'.$vida1.','.$vida2.','.$skillUse.','.$danoFinalPuro.','.$log->get("pjSelected").')');
						
				}
					
				if($enemigoDerrotado==1)
				{
					
					//////////////// TORNEO SHIT
					if($pj['inTorneo']==1)
					{
							$query = 'SELECT t.nombre, t.premio1, t.premio2, tp.slotOrder, tp.idPosicion,tp.slotPosicion, t.jugadores
										FROM  torneo_posicion tp JOIN torneo t USING (idTorneo) WHERE (tp.idMascota1 = '.$log->get("pjSelected").' OR tp.idMascota2 = '.$log->get("pjSelected").') AND tp.idTorneo = '.$idTorneo.' AND ganador = 0';
							$inTorneo = $db->sql_fetchrow($db->sql_query($query));
							if($inTorneo)
							{
								switch($inTorneo['jugadores'])
								{
									case 4:
									$nextPost = $inTorneo['slotPosicion']+1;
									$nextOrder = round(($inTorneo['slotOrder']+($inTorneo['slotOrder']+1))/4);
										if($inTorneo['slotPosicion']==2)
										{
												$db->sql_query('INSERT INTO  torneo_posicion(slotPosicion,idMascota1,idTorneo,slotOrder) 
									VALUES(5,"'.$log->get("pjSelected").'",'.$idTorneo.',1)');
											
												$db->sql_query("UPDATE  torneo SET 
												finalizado	 = 1,
												primero = ".$log->get("pjSelected").",
												segundo = ".$fpj['idPersonaje']."
												WHERE idTorneo = '".$idTorneo."'");
												$db->sql_query("UPDATE  personaje SET 
												inTorneo	 = 0,
												idTorneo = 0
												WHERE idPersonaje = '".$log->get("pjSelected")."'");
												
											$db->sql_query("UPDATE cuenta SET oro = (oro+".$inTorneo['premio1'].") 
											WHERE idCuenta = ".$log->get("idCuenta"));
											$db->sql_query("UPDATE cuenta SET oro = (oro+".$inTorneo['premio2'].") 
											WHERE idCuenta = ".$fpj["idCuenta"]);
											systemLog("global","<div class=winer>".$inTorneo['nombre']." Finalizado!</div>");								
											systemLog("global","<div class=winer>".$pj['nombre']." primer lugar gana ".$inTorneo['premio1']." de oro!</div>");
											systemLog("global","<div class=winer>".$fpj['nombre']." segundo lugar ".$inTorneo['premio2']." de oro!</div>");
											systemLog("global","<a href='index.php?sec=pelea&id=".$inTorneo['idPosicion']."'>Ver Pelea Final</a>");
										}
										else
										{
											$query = 'SELECT *
													FROM  torneo_posicion WHERE (idMascota1 = 0 OR idMascota2 = 0) AND idTorneo = '.$idTorneo.' AND slotPosicion='.$nextPost.' AND slotOrder = '.$nextOrder.'';
														$sloty = $db->sql_fetchrow($db->sql_query($query));
														if($sloty)
														{
															if($sloty['idMascota1']==0)
																$db->sql_query("UPDATE torneo_posicion SET 
															idMascota1 = ".$log->get("pjSelected")."
															WHERE idPosicion = '".$sloty['idPosicion']."'");
															else
															$db->sql_query("UPDATE torneo_posicion SET 
															idMascota2 = ".$log->get("pjSelected")."
															WHERE idPosicion = '".$sloty['idPosicion']."'");	
														}
														else
														{
															if($nextOrder%2==0)
																{
																		$nextOrder-=1;
															$db->sql_query('INSERT INTO  												                                    torneo_posicion(slotPosicion,idMascota2,idTorneo,slotOrder) 
		                            VALUES('.$nextPost.',"'.$log->get("pjSelected").'",'.$idTorneo.','.$nextOrder.')');
																}
																else
																{
															$db->sql_query('INSERT INTO  												                                    torneo_posicion(slotPosicion,idMascota1,idTorneo,slotOrder) 
		                            VALUES('.$nextPost.',"'.$log->get("pjSelected").'",'.$idTorneo.','.$nextOrder.')');		
																}
														}
										}
									break;
									case 8:
										$nextPost = $inTorneo['slotPosicion']+1;
										$nextOrder = round(($inTorneo['slotOrder']+($inTorneo['slotOrder']+1))/4);
										switch($inTorneo['slotPosicion'])
										{
											case 3:
												$db->sql_query('INSERT INTO  torneo_posicion(slotPosicion,idMascota1,idTorneo,slotOrder) 
									VALUES(4,"'.$log->get("pjSelected").'",'.$idTorneo.',1)');
											
												$db->sql_query("UPDATE  torneo SET 
												finalizado	 = 1,
												primero = ".$log->get("pjSelected").",
												segundo = ".$fpj['idPersonaje']."
												WHERE idTorneo = '".$idTorneo."'");
												$db->sql_query("UPDATE  personaje SET 
												inTorneo	 = 0,
												idTorneo = 0
												WHERE idPersonaje = '".$log->get("pjSelected")."'");
											break;
											default:
												$query = 'SELECT *
													FROM  torneo_posicion WHERE (idMascota1 = 0 OR idMascota2 = 0) AND idTorneo = '.$idTorneo.' AND slotPosicion='.$nextPost.' AND slotOrder = '.$nextOrder.'';
														$sloty = $db->sql_fetchrow($db->sql_query($query));
														if($sloty)
														{
															if($sloty['idMascota1']==0)
																$db->sql_query("UPDATE torneo SET 
															idMascota1 = ".$log->get("pjSelected")."
															WHERE idPosicion = '".$sloty['idPosicion']."'");
															else
															$db->sql_query("UPDATE torneo SET 
															idMascota2 = ".$log->get("pjSelected")."
															WHERE idPosicion = '".$sloty['idPosicion']."'");	
														}
														else
														{
															$db->sql_query('INSERT INTO  torneo_posicion(slotPosicion,idMascota1,idTorneo,slotOrder) 
												VALUES('.$nextPost.',"'.$log->get("pjSelected").'",'.$idTorneo.','.$nextOrder.')');
														}
											break;
										}
									break;
									case 16:
										$nextPost = $inTorneo['slotPosicion']+1;
										$nextOrder = round(($inTorneo['slotOrder']+($inTorneo['slotOrder']+1))/4);
										switch($inTorneo['slotPosicion'])
										{
											case 4:
												$db->sql_query('INSERT INTO  torneo_posicion(slotPosicion,idMascota1,idTorneo,slotOrder) 
									VALUES(5,"'.$log->get("pjSelected").'",'.$idTorneo.',1)');
											
												$db->sql_query("UPDATE  torneo SET 
												finalizado	 = 1,
												primero = ".$log->get("pjSelected").",
												segundo = ".$fpj['idPersonaje']."
												WHERE idTorneo = '".$idTorneo."'");
												$db->sql_query("UPDATE  personaje SET 
												inTorneo	 = 0,
												idTorneo = 0
												WHERE idPersonaje = '".$log->get("pjSelected")."'");
												
											$db->sql_query("UPDATE cuenta SET oro = (oro+".$inTorneo['premio1'].") 
											WHERE idCuenta = ".$log->get("idCuenta"));
											$db->sql_query("UPDATE cuenta SET oro = (oro+".$inTorneo['premio2'].") 
											WHERE idCuenta = ".$fpj["idCuenta"]);
				systemLog("global","<div class=winer>".$inTorneo['nombre']." Finalizado!</div>");								
				systemLog("global","<div class=winer>".$pj['nombre']." primer lugar gana ".$inTorneo['premio1']." de oro!</div>");
				systemLog("global","<div class=winer>".$fpj['nombre']." segundo lugar ".$inTorneo['premio2']." de oro!</div>");
				systemLog("global","<a href='index.php?sec=pelea&id=".$inTorneo['idPosicion']."'>Ver Pelea Final</a>");
											break;
											default:
												$query = 'SELECT *
													FROM  torneo_posicion WHERE (idMascota1 = 0 OR idMascota2 = 0) AND idTorneo = '.$idTorneo.' AND slotPosicion='.$nextPost.' AND slotOrder = '.$nextOrder.'';
														$sloty = $db->sql_fetchrow($db->sql_query($query));
														if($sloty)
														{
															if($sloty['idMascota1']==0)
																$db->sql_query("UPDATE torneo_posicion SET 
															idMascota1 = ".$log->get("pjSelected")."
															WHERE idPosicion = '".$sloty['idPosicion']."'");
															else
															$db->sql_query("UPDATE torneo_posicion SET 
															idMascota2 = ".$log->get("pjSelected")."
															WHERE idPosicion = '".$sloty['idPosicion']."'");	
														}
														else
														{
															if($nextOrder%2==0)
																{
																		$nextOrder-=1;
															$db->sql_query('INSERT INTO  												                                    torneo_posicion(slotPosicion,idMascota2,idTorneo,slotOrder) 
		                            VALUES('.$nextPost.',"'.$log->get("pjSelected").'",'.$idTorneo.','.$nextOrder.')');
																}
																else
																{
															$db->sql_query('INSERT INTO  												                                    torneo_posicion(slotPosicion,idMascota1,idTorneo,slotOrder) 
		                            VALUES('.$nextPost.',"'.$log->get("pjSelected").'",'.$idTorneo.','.$nextOrder.')');		
																}
														}
											break;
										}
									break;
								}
								$db->sql_query("UPDATE  personaje SET 
												inTorneo	 = 0,
												idTorneo = 0
												WHERE idPersonaje = '".$fpj['idPersonaje']."'");
								$db->sql_query("UPDATE torneo_posicion SET 
										ganador = ".$log->get("pjSelected")."
										WHERE idPosicion = '".$inTorneo['idPosicion']."'");
							}
							$result=0;
							systemLog("global","<div class=pjkiller><a target='_blank' href='index.php?sec=ver&pj=".$pj['nombre']."'>".$pj['nombre']."</a> le gano a <a target='_blank' href='index.php?sec=ver&pj=".$fpj['nombre']."'>".$fpj['nombre']."</a> por el torneo!<br> <a href='index.php?sec=pelea&id=".$inTorneo['idPosicion']."'>Ver Pelea</a></div>");
					}
							///////// FIN TORNEO
					else
					{
					$mmrGain=30;
					if($myMmr>=$check['mmr'])
					{
						$result = $myMmr-$check['mmr'];
						$result = ($mmrGain-$result);
					}
					else
					{
						$result = $check['mmr']-$myMmr;
						if($result>$mmrGain)
							$result=30;
					}
					if($result<=0)
							$result=1;
					systemLog("global","<div class=pjkiller><a target='_blank' href='index.php?sec=ver&pj=".$pj['nombre']."'>".$pj['nombre']."</a> gano en ranked a <a target='_blank' href='index.php?sec=ver&pj=".$fpj['nombre']."'>".$fpj['nombre']."</a> ".$result." puntos!</div>");
					}
					$db->sql_query("UPDATE personaje SET rankedPlaing = 0, ranked = 0, mmr = (mmr+".$result.") WHERE idCuenta = ".$log->get("idCuenta")." AND idPersonaje = '".$log->get("pjSelected")."'");
					$db->sql_query("UPDATE personaje SET rankedPlaing = 0, ranked = 0, mmr = (mmr-".$result.") WHERE idPersonaje = ".$check['idPlayer']);
					$db->sql_query("UPDATE ranked_match SET winner = ".$log->get("pjSelected").", puntos = ".$result." WHERE id = ".$check['RMID']);
				}
				
				if($vidaModifier>$stats['VidaLimit'])
				$vidaModifier=$stats['VidaLimit'];
				if( $manaModifier>$stats['ManaLimit'])
				$manaModifier=$stats['ManaLimit'];
				$data['mundo']=$check['mundo'];	
				$data['userLife'] = $vidaModifier;	
				$data['userMana'] = $manaModifier;	
				$data['userLifeLimit'] = $stats['VidaLimit'];	
				$data['userManaLimit'] = $stats['ManaLimit'];
				
				if($fisicalCoolDown==1)
						$attackCooldown = $stats['PSpeed'] ;
					
				
				
				if($vidaModifier<=0)
				{
					$data['info'] .= " estas muerto!" ;
					$data['muerto'] = 1 ;
					if($stats['deathRise']==1)
						$timemuerto = 60;
						
					$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$log->get("pjSelected")."'");
					$db->sql_query("UPDATE inmundo SET sesion_time = 0 
					WHERE idPlayer = '".$pj['idPersonaje']."' AND tipo = 1");
					
				}
				else
				{
						$data['isPvp']=1;
						$data['attackCooldown'] = $fisicalCoolDown+1;
					
				}
				$data['info']= $data['info'];
				
///////////////////////////////////////////////////////////////////////////////////////////////////////
			}
			else
			{
				if(($pj['attackCooldown']-$now)>1200 )
				{
					$db->sql_query("update gameactive set activo = 0");	
				}
				$data['error'] = "Attack time error.";
			}
		}
		else
		{
			$realGold = $log->realGold();
			$log->set("oro",$realGold);
			$data['gold'] = $realGold;
			$data['exp'] = $pj['exp'];
			$data['error'] = "El objetivo ya esta muerto. (ranked)";
		}
		}
	else
	{
		$data['info'] .= "Has sido derrotado!" ;
		$data['muerto'] = 1 ;
	}
}
else
{
	$data['error'] = "Error - u are offline";
}
 echo json_encode($data);
?> 