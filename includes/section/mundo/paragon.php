<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
										$goFight=0;	
										if($pj['SubClassFrom']>0)
										{
											show_error("No puedes entrar con la subclase a Paragon Rifts","index.php?sec=mundo&");
											$goFight=0;	
										}
										else
										if($pj['party']>0)
										{
											show_error("No puedes estar en party para hacer Paragon Rifts","index.php?sec=mundo&");
											$goFight=0;	
										}
										else
										if($mundo['warTime']<$now)
										{

											$RiftCost = $pj['paragonAcc'] * 300 * $pj['paragonAcc'];

											
								
											$goFight=0;
											if($pj['party']==0)
											{
												if(isset($_GET['go']))
													{
													
													$realGold = $log->realGold();

													$result = $realGold-$RiftCost;
													if($result>=0)
													{
													$log->set("oro",$result);
														
													$db->sql_query("UPDATE cuenta SET oro = (oro-".$RiftCost.") WHERE idCuenta = ".$log->get("idCuenta"));
														$query = 'SELECT idMonster, VidaLimit
							FROM monster  WHERE exp=1 AND papa=0 AND hardOne = 3 AND raid = 0 AND mapBoss = 0 ORDER BY RAND() DESC LIMIT 0,3';
														$monstersq = $db->sql_query($query);
														$mob = $db->sql_fetchrow($monstersq);	
																	
														show_message("Paragon Rift Nivel 
														".($pj['paragonAcc']+1)."  ah comenzado! <br> <a href='index.php?sec=mundo&mundo=".$mundoid."'> Ir al Bardo!!! </a>",
																			"index.php?sec=mundo&mundo=".$mundoid."&");
																$msg = "<div class='asedioNew'>".$pj['nombre']." inicio Conquest!<br>
													<a href='index.php?sec=mundo&mundo=". $mundo['id']."'>Ir a la batalla!</a></div>";
													
													systemLog("self","<div class='mapObjetive'>Paragon Rift Nivel 
														".($pj['paragonAcc']+1)." ah comenzado!!</div>");					
															
													$party=0;
													insertBuff($pj['idPersonaje'],246,147,600);		
											///////////////////// INICIO BORRAR INSTANCIAS
													$query = 'SELECT idInstance FROM dungeon_instance WHERE idPersonaje='.$pj['idPersonaje'].'';
													$instancesq = $db->sql_query($query);
													while($instance = $db->sql_fetchrow($instancesq))
														$db->sql_query("DELETE FROM inmundo WHERE idInstance = '".$instance['idInstance']."'");
													$db->sql_query("DELETE FROM dungeon_instance WHERE idPersonaje = '".$pj['idPersonaje']."'");
													///////////////////// FIN BORRAR INSTANCIAS
													 $db->sql_query('INSERT INTO  dungeon_instance(idPersonaje,nivel,waves,waveCurr,itemGrado,dificultad,elite,eliteLevel,idParty) 
		VALUES("'.$pj['idPersonaje'].'","1",3,1,1,1,1,'.$pj['paragonAcc'].','.$party.')');										
													
															
															$query = 'SELECT max(idInstance) AS ID FROM dungeon_instance WHERE idPersonaje = '.$pj['idPersonaje'].'';	
															$itemsq = $db->sql_query($query);
															$maxId = $db->sql_fetchrow($itemsq);
																			
															/// MONSTER IN THE INTANCE CREATION			
															for($i=0;$i<10;$i++)
															{
																$vida=$mob['VidaLimit'];
																$vida+=intval(($vida*($pj['paragonAcc']+1))/4);
																$db->sql_query('INSERT INTO  
																	inmundo(idMonster,tipo,mundo,
																	currentLife,dificulty,
																	idInstance,deQuien) 
																VALUES("'.$mob['idMonster'].'","2",
																	1,"'.$vida.'",1,'.$maxId['ID'].','.$pj['idPersonaje'].')');
															}						
																		
																$db->sql_query("UPDATE personaje SET
																		inDungeon = 1, dungeonInstance=".$maxId['ID']."
																		WHERE  idPersonaje = '".$pj['idPersonaje']."'");		
															}
															else
															{
																show_error("No tienes suficiente oro!",
																	"index.php?sec=mundo&mundo=".$mundoid."");
															}			
																
														}
														else
														{
											show_message("".$mundo['nombre']."
														<br>Termina el reto y conseguiras un punto de Paragon.<br>
														Costo ".$RiftCost." de oro.
														<div class='raidButton_move'>
														<div class='menuItem' onclick=".'"location.href='."'index.php?sec=mundo&mundo=".$mundoid."&go'".';"'.">Comenzar</div>
													    </div>
															",
															"index.php?sec=mundo");
														}
										
													}	
										}
										
										
										
									
?> 