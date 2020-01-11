<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['id']))
{
		$id=intval($_GET['id']);
		
					$query = 'SELECT *
					FROM torneo
					WHERE idTorneo = '.$id.'';
		$torneosq = $db->sql_query($query);
	$torneo = $db->sql_fetchrow($torneosq);
	if($torneo)
	{
				if(isset($_GET['forzar']))
				{
					$forceid = intval($_GET['forzar']);
					$db->sql_query("UPDATE personaje SET ranked = 1, deathTime = 0, Vida = 10000
										WHERE idPersonaje  = '".$forceid."'");
					header("Location: index.php?sec=torneo&id=".$id."&f=1");
				}
				if(isset($_GET['inscr']))
				{
					if($torneo['freeOpen']==1 AND $pj['idPersonaje']==ADMIN)
					{
						if(isset($_POST['registros']))
						{
							$registros = $_POST['registros'];
							$split = explode("\n",$registros);
							$orm="";
							$sqlSrc="";
							foreach ($split as &$value) 
							{
								$sqlSrc .= $orm." nombre = '".trim($value)."' ";
								$orm="OR";
							}
							$query = 'SELECT idPersonaje, nombre
							FROM  personaje
							WHERE ('.$sqlSrc.')';
							$dropsq = $db->sql_query($query);
							$orm="";
							$sqlUldate="";
							$acepted="";
							while($drop = $db->sql_fetchrow($dropsq))
							{
								$acepted .= "".$drop['nombre']." Aceptado.<br>";
								$sqlUldate .= $orm." idPersonaje = ".$drop['idPersonaje']." ";
								$orm=" OR ";
								$conta++;
							}
							
							if($conta==$torneo['jugadores'])
							{
								show_message("LISTO","index.php?sec=torneo&id=".$id);
								
								$db->sql_query("UPDATE personaje SET inTorneo = 1, idTorneo = ".$id."
											WHERE ".$sqlUldate."");
								
								$db->sql_query("UPDATE torneo SET itsOn = 1
											WHERE idTorneo = ".$id);
								
								
								$query = 'SELECT idPersonaje
									FROM  personaje
									WHERE ('.$sqlSrc.') ORDER BY RAND()';
									$dropsq = $db->sql_query($query);
									$saveId=0;
									$slotOrder=1;
									while($drop = $db->sql_fetchrow($dropsq))
									{
										if($saveId>0)
										{
											$db->sql_query('INSERT INTO  torneo_posicion(idMascota1,idMascota2,idTorneo,slotPosicion,slotOrder) 
																VALUES("'.$drop['idPersonaje'].'","'.$saveId.'",'.$id.',1,'.$slotOrder.')');	
											$saveId=0;	
											$slotOrder+=2;
										}
										else
											$saveId=$drop['idPersonaje'];	
									}
							}
							else
								show_error("Error solo hay ".$conta.":<br>".$acepted."","index.php?sec=torneo&id=".$id."&inscr");
						}
						else
						{
						$template->set_filenames(array(
								'content' => 'templates/sec/inscrpTorneo.html' )
							);
						}
					}
					else
						show_error("No tienes permiso para entrar aquí","index.php?");
				}
				else
				{
						$template->set_filenames(array(
								'content' => 'templates/sec/torneoFixture'.$torneo['jugadores'].'.html' )
							);
							$template->assign_var("NRO","<br>".$torneo['nombre']);	
														$query = 'SELECT tp.idPosicion, tp.ganador, tp.idPosicion, tp.slotPosicion, tp.slotOrder, tp.idMascota1, tp.idMascota2, mb.nombre AS PRIMERO, mb2.nombre AS SEGUNDO, tp.idTorneo AS T3
														FROM torneo_posicion tp 
														LEFT JOIN personaje mb ON tp.idMascota1 = mb.idPersonaje
														LEFT JOIN personaje mb2 ON tp.idMascota2 = mb2.idPersonaje
														WHERE tp.idTorneo = '.$torneo['idTorneo'].' ORDER BY tp.idPosicion';
														$dropsq = $db->sql_query($query);
															$nro=1;
															$nro2=1;
															$nro3=1;
															$nro4=1;
															while($drop = $db->sql_fetchrow($dropsq))
															{
																if($pj['idPersonaje']==ADMIN AND isset($_GET['f']))
																{
																	$drop['PRIMERO']=$drop['PRIMERO']." - <a href='index.php?sec=torneo&id=".$torneo['idTorneo']."&forzar=".$drop['idMascota1']."'>F</a>";
																	$drop['SEGUNDO']=$drop['SEGUNDO']." - <a href='index.php?sec=torneo&id=".$torneo['idTorneo']."&forzar=".$drop['idMascota2']."'>F</a>";
																}
																switch($drop['slotPosicion'])
																{
																	case 1:
																		$template->assign_var($drop['slotPosicion'].'SLOT'.$drop['slotOrder'],$drop['PRIMERO']);	
																		$template->assign_var($drop['slotPosicion'].'SLOT'.($drop['slotOrder']+1),$drop['SEGUNDO']);
																		
																		if($drop['ganador'])
																		{
																			$orFocus = round(($drop['slotOrder']+($drop['slotOrder']+1))/4);
																			$replay[$orFocus] = '<div class="Treplay"><a href="index.php?sec=pelea&id='.$drop['idPosicion'].'"><img src="images/miro.png" width="25" height="25" /></a></div>';
																		}
																	break;
																	case 2:
																		if($replay[$drop['slotOrder']])
																			$template->assign_var($drop['slotPosicion'].'REPLY'.$drop['slotOrder'],$replay[$drop['slotOrder']]);	
																		
																		if($replay[($drop['slotOrder']+1)])
																			$template->assign_var($drop['slotPosicion'].'REPLY'.($drop['slotOrder']+1),$replay[($drop['slotOrder']+1)]);
																		
																		$template->assign_var($drop['slotPosicion'].'SLOT'.$drop['slotOrder'],$drop['PRIMERO']);	
																		$template->assign_var($drop['slotPosicion'].'SLOT'.($drop['slotOrder']+1),$drop['SEGUNDO']);
																		
																		if($drop['ganador'])
																		{
																			$orFocus = round(($drop['slotOrder']+($drop['slotOrder']+1))/4);
																			$replay[$orFocus] = '<div class="Treplay"><a href="index.php?sec=pelea&id='.$drop['idPosicion'].'"><img src="images/miro.png" width="25" height="25" /></a></div>';
																		}
																		
																	break;
																	case 3:
																		if($replay[$drop['slotOrder']])
																			$template->assign_var($drop['slotPosicion'].'REPLY'.$drop['slotOrder'],$replay[$drop['slotOrder']]);	
																		
																		if($replay[($drop['slotOrder']+1)])
																			$template->assign_var($drop['slotPosicion'].'REPLY'.($drop['slotOrder']+1),$replay[($drop['slotOrder']+1)]);
																		
																		$template->assign_var($drop['slotPosicion'].'SLOT'.$drop['slotOrder'],$drop['PRIMERO']);	
																		$template->assign_var($drop['slotPosicion'].'SLOT'.($drop['slotOrder']+1),$drop['SEGUNDO']);
																		
																		if($drop['ganador'])
																		{
																			$orFocus = round(($drop['slotOrder']+($drop['slotOrder']+1))/4);
																			$replay[$orFocus] = '<div class="Treplay"><a href="index.php?sec=pelea&id='.$drop['idPosicion'].'"><img src="images/miro.png" width="25" height="25" /></a></div>';
																		}
																	break;
																	case 4:
																		if($replay[$drop['slotOrder']])
																			$template->assign_var($drop['slotPosicion'].'REPLY'.$drop['slotOrder'],$replay[$drop['slotOrder']]);	
																		
																		if($replay[($drop['slotOrder']+1)])
																			$template->assign_var($drop['slotPosicion'].'REPLY'.($drop['slotOrder']+1),$replay[($drop['slotOrder']+1)]);
																			
																		$template->assign_var($drop['slotPosicion'].'SLOT'.$drop['slotOrder'],$drop['PRIMERO']);	
																		$template->assign_var($drop['slotPosicion'].'SLOT'.($drop['slotOrder']+1),$drop['SEGUNDO']);
																		
																		if($drop['ganador'])
																		{
																			$orFocus = round(($drop['slotOrder']+($drop['slotOrder']+1))/4);
																			$replay[$orFocus] = '<a href="index.php?sec=pelea&id='.$drop['idPosicion'].'"><img src="images/miro.png" width="30" height="30" /></a>';
																		}
																	break;
																	case 5:
																		if($replay[$drop['slotOrder']])
																			$template->assign_var($drop['slotPosicion'].'REPLY'.$drop['slotOrder'],$replay[$drop['slotOrder']]);	
																		
																		if($replay[($drop['slotOrder']+1)])
																			$template->assign_var($drop['slotPosicion'].'REPLY'.($drop['slotOrder']+1),$replay[($drop['slotOrder']+1)]);
																			
																		$template->assign_var($drop['slotPosicion'].'SLOT1',$drop['PRIMERO']);	
																	break;
																}
															}	
															
				}
	}
	else
			show_error("No existe el torneo!","index.php");
}
else
{
	
	$template->set_filenames(array(
			'content' => 'templates/sec/listaTorneo.html' )
		);
		
		
		define('PATH_USERS', '?sec=torneo&');
								 define('PAGINAS', 6);
								$page_number = intval($_GET['page']);
								if( $page_number == 0 ) 
								{ 
									$page_number = 1;
								}	
								$query = 'SELECT count(*) as CONTA 
										  FROM torneo';
								$count = $db->sql_fetchrow($db->sql_query($query));
								$filas = $count['CONTA'];
								$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
							$query = 'SELECT * FROM torneo ORDER BY freeOpen DESC, finalizado LIMIT '.$limitbottom.', '.PAGINAS;
									$misionsq = $db->sql_query($query);
									$template->assign_var('NUMERACION', $numeracion);
									$num = ( $page_number - 1 ) * PAGINAS;	
									while($torneo = $db->sql_fetchrow($misionsq))
									{
										if($torneo['finalizado'])
											$finale = "Finalizado";
										else
											$finale = "Por Jugar";
										
										if($torneo['itsOn']==0)
											$insc = "- <a href='foro/viewtopic.php?".$torneo['direccion']."'  target='_blank'>Inscribirse</a>";
										else
											$insc = "";
										
											
										$template->assign_block_vars('TOR', array(
															'NOMBRE' => $torneo['nombre'],
															'ID' => $torneo['idTorneo'],
															'STATE' => $finale,
															'INSC' => $insc
															
															));		
									}
		
		
		
		
}
?> 