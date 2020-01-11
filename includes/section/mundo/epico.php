<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
										$goFight=0;	
										if($pj['party']==0)
										{
											show_error("Necesitas una party para entrar aqui","index.php?sec=mundo&");
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
										if($mundo['warTime']<$now)
										{
											$query = 'SELECT m.*, i.Nombre AS ITEM
											FROM monster m LEFT JOIN item i ON m.idMaterial = i.idItem
											WHERE m.idMonster = "'.$mundo['extraInfo'].'" 
											';
										$monstersq = $db->sql_query($query);
		
											$monster = $db->sql_fetchrow($monstersq);

											$goFight=0;
											if($pj['party']==$log->get("pjSelected"))
											{
												if(isset($_GET['go']))
													{
													
													$realGold = $log->realGold();


													$query = 'SELECT p.nombre, p.nivel, p.idPersonaje, i.idItem, i.cantidad
													FROM personaje p 
													LEFT JOIN inventario i on i.idCuenta = p.idCuenta 
													AND i.idItem = 655
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
														if(intval($partychar['cantidad'])<$mundo['extraInfo'])
														{
															$flagHDP=true;
															$hdps.=$partychar['nombre']." no tienen los ".$mundo['extraInfo']." Chaos<br>";
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
																$msg = "<div class='asedioNew'>".$pj['nombre']." inicio Epico!<br>
													<a href='index.php?sec=mundo&mundo=". $mundo['id']."'>Ir a la batalla!</a></div>";
																		$db->sql_query('INSERT INTO  chat(party,mensaje) 
															VALUES("'.$pj['party'].'","'.$msg.'")');	
															
															///// NEW RAID SHIT	
															$query = 'SELECT idPersonaje, idCuenta FROM personaje WHERE party='.$pj['idPersonaje'].'';
															$partycharssq = $db->sql_query($query);
															while($partychar = $db->sql_fetchrow($partycharssq))
															{
																insertBuff($partychar['idPersonaje'],246,147,600);	
																if($partychar['idPersonaje']>0)
																$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$partychar['idPersonaje']."'");
															
																// SACAR ITEMS REQUERIDOS POR EL BOSS

																$db->sql_query("UPDATE inventario SET
																		 cantidad=(cantidad-".$mundo['extraInfo'].")
																		WHERE  idCuenta = ".$partychar['idCuenta']." AND idItem = 655");	

																// END SACAR ITEMS REQUERIDOS PAR ABOSS
															}
															$db->sql_query('INSERT INTO  dungeon_instance
															(idPersonaje,nivel,waves,waveCurr,itemGrado,dificultad,idParty,epico) 
															VALUES("'.$pj['idPersonaje'].'",1,4,1,1,1,'.$pj['party'].','.$mundo['id'].')');
															
															$query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
																		$itemsq = $db->sql_query($query);
																		$maxId = $db->sql_fetchrow($itemsq);
																			
															/// MONSTER IN THE INTANCE CREATION		
															switch($mundo['id'])
															{
																case 166:	
																	$cantidad=5;
																	$mobId=175;
																	$mobVida=100000000;
																break;
															}
															for($i=0;$i<$cantidad;$i++)
																{
																	$db->sql_query('INSERT INTO  
																		inmundo(idMonster,tipo,mundo,
																		currentLife,dificulty,
																		idInstance,openToClan) 
																	VALUES("'.$mobId.'","2",
																		1,"'.$mobVida.'",1,'.$maxId['ID'].',
																		'.$pj['party'].')');
																}	



																$db->sql_query("UPDATE personaje SET
																		inDungeon = 1, dungeonInstance=".$maxId['ID']."
																		WHERE  party = '".$pj['idPersonaje']."'");		
																		
																}
														}
														else
														{
											show_message("".$mundo['nombre']."
														<br>Se aventuran a un lugar muy peligroso.<br>
														Costo ".$mundo['extraInfo']." Raid Key cada uno.
														<div class='raidButton_move'>
														<div class='menuItem' onclick=".'"location.href='."'index.php?sec=mundo&mundo=".$mundoid."&go'".';"'.">SI</div>
													    </div>
															",
															"index.php?sec=mundo");
														}
											}
											else
											 show_error("Solo el lider puede iniciar el Epico","index.php?sec=mundo&");	
														
										}
										else
										if($pj['party']!=$mundo['clan'])
										{
											show_error("das","index.php?sec=mundo&");
											$goFight=0;	
										}
										
									
?> 