<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
										$goFight=0;	



										if($pj['party']==0)
										{
											show_error("Necesitas una party para pelear con un Raid Boss","index.php?sec=mundo&");
											$goFight=0;	
										}
										/*else
										if($pj['nivel']>$mundo['nivel']+20)
										{
											show_error("No puedes tener mas de 20 niveles que el raid","index.php?sec=mundo&");
											$goFight=0;	
										}
										else*/
										if($pj['nivel']<$mundo['nivel'])
										{
											show_error("No tienes suficiente nivel","index.php?sec=mundo&");
											$goFight=0;	
										}
										else
										if(1==1)
										{
											

											$query = 'SELECT m.*, i.Nombre AS ITEM
											FROM monster m LEFT JOIN item i ON m.idMaterial = i.idItem
											WHERE m.idMonster = "'.$mundo['extraInfo'].'" 
											';
										$monstersq = $db->sql_query($query);
		
											$monster = $db->sql_fetchrow($monstersq);
											if($monster['idMonster']==248 && isset($_GET['go']))
											{
												header("Location: index.php?sec=mundo&mundo=183");
												die();
											}
											$goFight=0;
											if($pj['party']==$log->get("pjSelected"))
											{
												if(isset($_GET['go']))
													{
													
													$realGold = $log->realGold();


													$query = 'SELECT p.nombre, p.nivel, p.idPersonaje, i.idItem, i.cantidad
													FROM personaje p 
													LEFT JOIN inventario i on i.idCuenta = p.idCuenta 
													AND i.idItem = '.$monster['idMaterial'].'
													WHERE p.party='.$pj['idPersonaje'].'';
													
													$partycharssq = $db->sql_query($query);
													$flagHDP=false;
													$hdps="";
													while($partychar = $db->sql_fetchrow($partycharssq))
													{
														if($partychar['nivel']<$mundo['nivel'])
														{
															$flagHDP=true;
															$hdps.=$partychar['nombre']." tiene nivel menor al requerido (".$mundo['nivel'].")<br>";
														}
														/*if($partychar['nivel']>($mundo['nivel']+20))
														{
															$flagHDP=true;
															$hdps.=$partychar['nombre']." tiene nivel mayor al permitido (".($mundo['nivel']+20).")<br>";
														}*/
														if(intval($partychar['cantidad'])<$monster['costo'])
														{
															$flagHDP=true;
															$hdps.=$partychar['nombre']." no tienen los ".$monster['costo']." ".$monster['ITEM']."<br>";
														}
													}

													if($flagHDP)
													{
														show_error($hdps,
														"index.php?sec=mundo&mundo=".$mundoid."&");
													}
													else
													{
																
														$query = 'SELECT *
															FROM monster
															WHERE idMonster = '.$mundo['extraInfo'];
														$monstersq = $db->sql_query($query);
														$mob = $db->sql_fetchrow($monstersq);	
																	
														show_message("Ir la Batalla!!!",
																			"index.php?sec=mundo&mundo=".$mundoid."&");
																$msg = "<div class='asedioNew'>".$pj['nombre']." inicio el Raid Boss ".$mob['nombre']."<br>
																Pueden entrar entre niveles ".$mundo['nivel']."-".($mundo['nivel']+20)."<br>
													<a href='index.php?sec=mundo&mundo=". $mundo['id']."'>Ir a la batalla!</a></div>";
																		$db->sql_query('INSERT INTO  chat(party,mensaje) 
															VALUES("'.$pj['party'].'","'.$msg.'")');	
															
															///// NEW RAID SHIT	
															$query = 'SELECT idPersonaje, idCuenta FROM personaje WHERE party='.$pj['idPersonaje'].'';
															$partycharssq = $db->sql_query($query);
															while($partychar = $db->sql_fetchrow($partycharssq))
															{
																insertBuff($partychar['idPersonaje'],246,147,600);	
																
																
																$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$partychar['idPersonaje']."'");
															
																// SACAR ITEMS REQUERIDOS POR EL BOSS

																$db->sql_query("UPDATE inventario SET
																		 cantidad=(cantidad-".$monster['costo'].")
																		WHERE  idCuenta = ".$partychar['idCuenta']." AND idItem = ".$monster['idMaterial']);	

																// END SACAR ITEMS REQUERIDOS PAR ABOSS
															}
															$db->sql_query('INSERT INTO  dungeon_instance(idPersonaje,nivel,waves,waveCurr,itemGrado,dificultad,idParty) 
															VALUES("'.$pj['idPersonaje'].'",1,1,0,1,1,'.$pj['party'].')');
															
															$query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
																		$itemsq = $db->sql_query($query);
																		$maxId = $db->sql_fetchrow($itemsq);
																			
															/// MONSTER IN THE INTANCE CREATION			
																$db->sql_query('INSERT INTO  
																	inmundo(idMonster,tipo,mundo,
																	currentLife,dificulty,
																	idInstance,openToClan,element) 
																VALUES("'.$mob['idMonster'].'","2",
																	1,"'.$mob['VidaLimit'].'",1,'.$maxId['ID'].',
																	'.$pj['party'].',"'.getRandomElem().'")');
																				
																		
																$db->sql_query("UPDATE personaje SET
																		inDungeon = 1, dungeonInstance=".$maxId['ID']."
																		WHERE  party = '".$pj['idPersonaje']."'");		
																}
														}
														else
														{
															$cost = "Costo ".$monster['costo']." ".$monster['ITEM']." cada uno.";
															$move = "<div class='menuItem' onclick=".'"location.href='."'index.php?sec=mundo&mundo=".$mundoid."&go'".';"'.">SI</div>
													    </div>";
															if($monster['idMonster']==248)
															{
																$cost="";
																$query = 'SELECT idInMundo AS ID FROM inmundo WHERE
																 idMonster = 248 AND mundo=183';	
																$bosssq = $db->sql_query($query);
																$trixie = $db->sql_fetchrow($bosssq);
																if(!$trixie)
																{
																	$move = "Actualmente Trixie esta muerta. Pero va revivir pronto!</div>";
																}
																else
																	$cost="Costo Gratis";


															}




											show_message("Quieres luchar contra este Raid Boss?
											<br><img src='images/mobs/".$monster['imagen']."'  width=50 height=50 /><br>
											<spam class='raidname'>".$monster['nombre']."</spam>
														<br>
														".$cost."
														<div class='raidButton_move'>
														".$move."
															",
															"index.php?sec=mundo");




														}
											}
											else
											 show_error("Solo el lider puede iniciar el Raid Boss","index.php?sec=mundo&");	
														
										}
										else
										if($pj['party']!=$mundo['clan'])
										{
											show_error("El Raid Boss está ocupado vuelva más tarde","index.php?sec=mundo&");
											$goFight=0;	
										}
										
									
?> 