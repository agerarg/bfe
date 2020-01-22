<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$goFight=0;
		$cleanbrlocation = explode("<br>",$mundo['nombre']);
		$template->assign_var('USR_LOCATION', $cleanbrlocation[0]);
						if($mundo['nivel']==90 && ($pj['nivel']<$mundo['nivel'] || $pj['nivel']>119))
						{
							show_message("Solo personajes de nivel 90 - 119 pueden ingresar aqui!",
							"index.php?sec=mundo");	
						}
							else
						if($pj['nivel']>=$mundo['nivel'] && $pj['nivel']>($mundo['nivel']+30) && $mundo['nivel']!=90 && $mundo['nivel']!=120)
						{
							show_message("Solo personajes de nivel ".$mundo['nivel']." - ".($mundo['nivel']+30)." pueden ingresar aqui!",
							"index.php?sec=mundo");	

						}else
										if($mundo['tipo']=="free" AND $mundo['warTime']<$now AND $pj['clan']==$mundo['clan'] AND $pj['clan']!=0 )
										{
											
											
											$db->sql_query("UPDATE personaje SET location = ".$mundo['id']."
											WHERE idPersonaje = ".$log->get("pjSelected"));
											
											
											$template->assign_var('CASTLE', $mundo['nombre']);
											$template->assign_var('MUNDO', $mundo['id']);
											switch($mundo['nivel'])
											{
												case 0:
													$tier=1;
												break;
												case 30:
													$tier=2;
												break;
												case 60:
													$tier=3;
												break;
												case 80:
													$tier=4;
												break;
												case 120:
													$tier=4;
												break;
												default:
													$tier=99;
												break;
											}
											if(isset($_GET['buff']))
											{
												$buff= intval($_GET['buff']);
												$query = 'SELECT *
													FROM clanbuffs b JOIN skill s USING ( idSkill ) 
													WHERE (idSkill = 122 OR idSkill = 124) AND b.idClanBuff = '.$buff.'';
													$buffsq = $db->sql_query($query);
													$buff = $db->sql_fetchrow($buffsq);
													if($buff)	
													{
														$realGold = $log->realGold();
														if($realGold>=$buff['costo'])
														{
															insertBuff($pj['idPersonaje'],$buff['idSkill'],$buff['idRealSkill'],1800);
															$log->set("oro",$result);
															$db->sql_query("UPDATE cuenta SET oro = (oro-".$buff['costo'].") WHERE idCuenta = ".$log->get("idCuenta"));			
															show_message("Ahora sientes el efecto de ".$buff['nombre'] ,"index.php?sec=mundo&mundo=".$mundo['id']);
																
															
														}
														else
															show_error("No tienes suficiente oro.","index.php?sec=mundo&mundo=".$mundo['id']);
													}
													else
														show_error("No se encontro el buff.","index.php?sec=mundo&mundo=".$mundo['id']);
												}
												else
												{
														define('PATH_USERS', 'index.php?sec=mundo&mundo='.$mundo['id']);
															 define('PAGINAS', 7);
															$page_number = intval($_GET['page']);
															if( $page_number == 0 ) 
															{ 
																$page_number = 1;
															}
															$query = 'SELECT count(*) as CONTA 
																	  FROM clanbuffs WHERE clanLevel = '.$tier.' ';
															$count = $db->sql_fetchrow($db->sql_query($query));
															$filas = $count['CONTA'];
														$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
														$query = 'SELECT *
														FROM clanbuffs b JOIN skill s USING ( idSkill ) 
														WHERE idSkill = 122 OR idSkill = 124 LIMIT '.$limitbottom.', '.PAGINAS;
														$buffsq = $db->sql_query($query);
														$template->assign_var('NUMERACION', $numeracion);
														$num = ( $page_number - 1 ) * PAGINAS;
														while($buff = $db->sql_fetchrow($buffsq))
														{	
															$template->assign_block_vars('BUFF', array(
																					'ID' => $buff['idClanBuff'],
																					'NOMBRE' => $buff['nombre'],
																					'IMG' => $buff['imagen'],
																					'DESC' =>  $buff['desc'],	
																					'COST' => $buff['costo']
																					));
														}	
												
													
												$template->set_filenames(array(
																		'content' => 'templates/sec/castleBuffs.html' )
																	);
												}
										}
										else if($mundo['tipo']=="free" AND $mundo['warTime']<$now AND $mundo['dayBlock'] < $now)
										{
											if($pj['clan']>0)
											{
												if($mundo['warTime']>0)
												{
													$query = 'SELECT MAX( dayBlock ) AS tiempo FROM mundo';
													$qst = $db->sql_fetchrow($db->sql_query($query));
													if($qst['tiempo']>$now)
														$dayBlock = $now + 600;
													else
														$dayBlock = $now + 600;
													$db->sql_query("UPDATE mundo SET dayBlock = ".$dayBlock.",
													warTime = 0 
													WHERE id = ".$mundo['id']);
													
													show_message("Recien termina la batalla de este lugar, tienes que esperar ".conversor_segundos($dayBlock-$now)." para poder atacar.",
									"index.php?sec=mundo");	
												}
												else
												{
													if(isset($_GET['atacar']))
													{
															if($mundo['clan']==0)
															{
																
														$msg = "<div class='asedioNew'>".$clan['nombre']." esta atacando!".$cleanbrlocation[0]."!<br>
																	<a href='index.php?sec=mundo&mundo=". $mundo['id']."'>".$cleanbrlocation[1]." Ir a la batalla</a></div>";	
														systemLog("global",$msg);	
														
														
														$db->sql_query("DELETE FROM inmundo WHERE mundo = ".$mundoid);
																switch($mundo['nivel'])
																{
																	case 0:
																		for ($i = 1; $i <=5; $i++) 
																		{
																		$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																			VALUES("18","2",
																			"'.$mundoid.'","5000")');
																		}
																	break;
																	case 30:
																		for ($i = 1; $i <=10; $i++) 
																		{
																		$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																			VALUES("20","2",
																			"'.$mundoid.'","15000")');
																		}
																	break;
																	case 60:
																		for ($i = 1; $i <=10; $i++) 
																		{
																		$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																			VALUES("21","2",
																			"'.$mundoid.'","25000")');
																		}
																	break;
																	case 80:
																		for ($i = 1; $i <=5; $i++) 
																		{
																			$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																			VALUES("42","2",
																			"'.$mundoid.'","80000")');
																			$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																			VALUES("40","2",
																			"'.$mundoid.'","125000")');
																			$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																			VALUES("41","2",
																			"'.$mundoid.'","50000")');
																		}
																	break;
																	default:
																		for ($i = 1; $i <=10; $i++) 
																		{
																		$db->sql_query('INSERT INTO  inmundo(idMonster,tipo,mundo,currentLife) 
																			VALUES("21","2",
																			"'.$mundoid.'","25000")');
																		}
																	break;
																	
																}
																$db->sql_query("UPDATE mundo SET warTime = ".($now+600)."
																		WHERE id = ".$mundo['id']);
																		header("Location: index.php?sec=mundo&mundo=".$mundoid."");
				
															}
															else 
															{
																$db->sql_query("DELETE FROM inmundo WHERE mundo = ".$mundoid);
																
																$query = 'SELECT idPersonaje FROM personaje
																WHERE clan = '.$mundo['clan'].' AND online > '.($now-600).' AND nivel >= '.$mundo['nivel'].' AND nivel <= '.($mundo['nivel']+20).' AND inDungeon=0';
																
																$membersq = $db->sql_query($query);
																		while($member = $db->sql_fetchrow($membersq))
																		{	
																			$db->sql_query('INSERT INTO inmundo (mundo,tipo,idPlayer,sesion_time) 
														VALUES("'.$mundo['id'].'","1","'.$member['idPersonaje'].'","'.intval($now + 300).'")');
																		}
																	
																$msg = "<div class='asedioNew'>".$clan['nombre']." esta atacando a ".$cleanbrlocation[0]."!<br>
																	<a href='index.php?sec=mundo&mundo=". $mundo['id']."'>".$cleanbrlocation[1]." Ir a la batalla</a></div>";	
																	systemLog("global",$msg);	
																	
																	

																$db->sql_query("UPDATE mundo SET warTime = ".($now+600)."
																WHERE id = ".$mundo['id']);
																header("Location: index.php?sec=mundo&mundo=".$mundoid."");	
die();						
															}
													}
													else
													{
														show_message("<a href='index.php?sec=mundo&mundo=".$mundo['id']."&atacar'>Atacar el Castillo</a>.","index.php?sec=mundo");	
													}
												}
											}
											else
												show_message("Solo miembros de un clan pueden atacar un castillo!",
							"index.php?sec=mundo");	
										}
										else if($mundo['tipo']=="free" AND $mundo['dayBlock']>$now)
										{
												show_message("Tienes que esperar ".conversor_segundos($mundo['dayBlock']-$now)." para atacar el castillo.",
										"index.php?sec=mundo");	
										}
										else
										{
											$goFight=1;
										}										
?> 