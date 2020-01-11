<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
										$query = 'SELECT *
										FROM  torneo_posicion WHERE (idMascota1 = '.$log->get("pjSelected").' OR idMascota2 = '.$log->get("pjSelected").') AND idTorneo = '.$pj['idTorneo'].' AND ganador = 0';
										$inTorneo = $db->sql_fetchrow($db->sql_query($query));
										
										if(!$inTorneo)
										{
											show_error("No estas en ningun torneo","index.php?sec=mundo&");
											$goFight=0;
										}else
										{
											$query = 'SELECT idPlayer
												  FROM inmundo
												  WHERE idPlayer != "'.$log->get("pjSelected").'" AND (idPlayer='.$inTorneo['idMascota1'].' OR idPlayer='.$inTorneo['idMascota2'].') AND mundo = 110';
											$srch_logged_player = $db->sql_query($query);
											$logged_player = $db->sql_fetchrow($srch_logged_player);
											if($logged_player)
											{
												if($inTorneo['onFight']==0)
												{
												systemLog("other","Pelea de torneo iniciada<br><a href='index.php?sec=mundo'>Click Aqui</a>",$log->get("pjSelected"));								
												systemLog("other","Pelea de torneo iniciada<br><a href='index.php?sec=mundo'>Click Aqui</a>",$logged_player['idPlayer']);
													$db->sql_query("UPDATE torneo_posicion SET onFight = 1
													WHERE idPosicion = ".$inTorneo['idPosicion']);
												}
												$_SESSION['idContrincante']=$logged_player['idPlayer'];
													//gogo
											}
											else
											{
												show_error("Espera al contrincante...","index.php?sec=mundo&");
											$query = 'SELECT *
												  FROM inmundo
												  WHERE idPlayer = "'.$log->get("pjSelected").'" AND tipo = 1 AND mundo = '.$mundo['id'].'';
											$srch_logged_player = $db->sql_query($query);
											$logged_player = $db->sql_fetchrow($srch_logged_player);	
											if($pj['LOCID']!=$mundo['id'])
											{	
												
													$cleanbrlocation = explode("<br>",$mundo['nombre']);
													$template->assign_var('USR_LOCATION', $cleanbrlocation[0]);
													$db->sql_query("UPDATE personaje SET location = ".$mundo['id']."
													WHERE idPersonaje = ".$log->get("pjSelected"));
															
													if(!$logged_player)		
														$db->sql_query('INSERT INTO inmundo (mundo,tipo,idPlayer,sesion_time) 
														VALUES("'.$mundo['id'].'","1","'.$log->get("pjSelected").'","'.intval($now + 300).'")');
													else
														$db->sql_query("UPDATE inmundo SET sesion_time = '".intval($now + 300)."', 
														mundo = '".$mundo['id']."'
														WHERE idPlayer = '".$log->get("pjSelected")."' AND tipo = '1' AND mundo = ".$mundo['id']."");
												
											}
											else
											{
												if(!$logged_player)		
													$db->sql_query('INSERT INTO inmundo (mundo,tipo,idPlayer,sesion_time) 
													VALUES("'.$mundo['id'].'","1","'.$log->get("pjSelected").'","'.intval($now + 300).'")');
												else
													$db->sql_query("UPDATE inmundo SET sesion_time = '".intval($now + 300)."', 
													mundo = '".$mundo['id']."'
													WHERE idPlayer = '".$log->get("pjSelected")."' AND tipo = '1' AND mundo = ".$mundo['id']."");
											
											}
											$goFight=0;
											}
										}

?> 