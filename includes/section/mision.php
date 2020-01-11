<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['id']))
								{
									$id = intval($_GET['id']);
									$query = 'SELECT m.*
													FROM mision m
													WHERE m.id = '.$id.' AND dimen='.$dimencion.'';
									$misionsq = $db->sql_query($query);
									$mision = $db->sql_fetchrow($misionsq);
									if($mision)	
									{
										$foofo = 0;
										$query = 'SELECT *
													FROM misiononplayer
													WHERE idPersonaje = '.$log->get("pjSelected").'
													 AND idMision = '.$mision['id'].' ';
										$mPlayersq = $db->sql_query($query);
										$mPlayer = $db->sql_fetchrow($mPlayersq);
										
										if($mPlayer['finalizado']==1)
										{
											if($mision['repetible']==1)
												if($now>$mPlayer['lockTime'])
													$foofo=1;
												else
													$foofo=2;
											else
												$foofo=3;
										}
										else
										{
											if($mPlayer)
												$foofo=4;
											else
												$foofo=1;
										}

										switch($foofo)
										{
											case 4:
												show_error("Ya estás haciendo la misión","index.php?sec=misiones");
											break;
											case 3:
												show_error("Ya hiciste esa misión","index.php?sec=misiones");
											break;
											case 2:
												show_error("Espera un rato para volver hacer esta misión ","index.php?sec=misiones");
											break;
											case 1:
												if($pj['nivel']>=$mision['lvlrequiere'] AND ($pj['nivel']<=$mision['lvlmax'] OR $mision['lvlmax']==0))
												{
													$doMision=false;
													if($mision['clanQuest'])
													{
														$clan['idLeader']=intval($clan['idLeader']);
														if($clan['idLeader']==$log->get("pjSelected"))
															{
																$doMision=true;	
															}
													}
													else
														$doMision=true;	
													
													if($doMision)
													{
														$db->sql_query("DELETE FROM misiononplayer WHERE idPersonaje = '".$log->get("pjSelected")."'
														AND idMision=".$mision['id']);
														
														$db->sql_query('INSERT INTO misiononplayer (idPersonaje,idMision,follow) 
																		VALUES("'.$log->get("pjSelected").'","'.$mision['id'].'","'.$mision['mision_start'].'")');
														$query = 'SELECT *
																	FROM mision_parte
																	WHERE idParte = '.$mision['mision_start'].'';
														$partsq = $db->sql_query($query);
														$part = $db->sql_fetchrow($partsq);
														
														$msg = "<div class='questMeta'>Mision: ".$mision['nombre'].'<br>
														Objetivo: '.str_replace("*",$part['cantidad'],$part['descr'])."</div>";
														$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
											VALUES("'.$pj['idPersonaje'].'","'.$msg.'")');	
													
													show_message($msg,"index.php?sec=misiones");
													}
													else
														show_error("Tienes que ser lider de un clan para hacer esta misión","index.php?sec=misiones");
												}
												else
													show_error("No tenes el nivel adecuado para esta misión","index.php?sec=misiones");
											break;
										}
									}
									else
										show_error("No existe la misión","index.php?sec=misiones");
								}
								else
								{
									$template->set_filenames(array(
											'content' => 'templates/sec/misiones.html' )
										);
										define('PATH_USERS', '?sec=misiones&');
										$missionCheck=true;
										 define('PAGINAS', 4);
										 
										 
										$page_number = intval($_GET['page']);
										if( $page_number == 0 ) 
										{ 
											$page_number = 1;
										}
										$clan['idLeader']=intval($clan['idLeader']);
										if($clan['idLeader']!=$log->get("pjSelected"))
											$sqClanAllow = " AND m.clanQuest = 0 ";
										
											$query = 'SELECT count(*) as CONTA 
										  FROM mision m LEFT JOIN misiononplayer mp on mp.idMision = m.id 
													 AND mp.idPersonaje = '.$log->get("pjSelected").'
													WHERE (mp.idMision IS NULL OR (mp.finalizado =1 AND m.repetible=1)) 
													AND lvlrequiere<='.$pj['nivel'].' '.$sqClanAllow. ' AND dealyquest = 0 AND m.dimen='.$dimencion.' AND (lvlmax>='.$pj['nivel'].' OR lvlmax=0)' ;
										
										$count = $db->sql_fetchrow($db->sql_query($query));
										$filas = $count['CONTA'];
											$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
										
										
										$query = 'SELECT m.*, mp.idMisionOn, mp.lockTime
													 FROM mision m LEFT JOIN misiononplayer mp on mp.idMision = m.id 
													 AND  mp.idPersonaje = '.$log->get("pjSelected").'
													WHERE (mp.idMision IS NULL OR (mp.finalizado =1 AND m.repetible=1)) 
													AND lvlrequiere<='.$pj['nivel'].' '.$sqClanAllow.' AND dealyquest = 0 AND m.dimen='.$dimencion.' AND (lvlmax>='.$pj['nivel'].' OR lvlmax=0)
													ORDER BY ponderado DESC, lvlrequiere DESC LIMIT '.$limitbottom.', '.PAGINAS;
										$template->assign_var('NUMERACION', $numeracion);
									$num = ( $page_number - 1 ) * PAGINAS;
										$misionsq = $db->sql_query($query);
										//echo $now+1200;
										while($mision = $db->sql_fetchrow($misionsq))
										{	
											$missionCheck=false;
											if($now<$mision['lockTime'])
												$timer = "Espera: ".conversor_segundos($mision['lockTime']-$now);
											else
												$timer = "";
											
											if($mision['lvlmax']>0)
												$limit = "hasta ".$mision['lvlmax'];
											else
												$limit="";
											$template->assign_block_vars('M', array(
																'ID' => $mision['id'],
																'TIME'=> $timer,
																'NOMBRE' => $mision['nombre'],
																'DESC' =>  utf8_encode($mision['descr']),
																'LVL' => $mision['lvlrequiere'],
																'MAX' => $limit
																));
										}
										if($missionCheck)
											$template->assign_var('NOMISION', "No hay mas misiones por el momento!");
								}


?>