<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
		switch($_GET['ver'])
					{
						case 'pvp':
							$query = 'SELECT p.nombre, p.nivel, p.PVP, c.nombre AS TXTCLASE, c.imagen AS IMGCLASE
									FROM personaje p, clase c
									WHERE p.idClase = c.idClase AND PVP > 0 AND p.idPersonaje != 1
									ORDER BY PVP DESC LIMIT 0,10';
									$topsq = $db->sql_query($query);
									$puesto=0;
									while($top = $db->sql_fetchrow($topsq))
									{
										$puesto++;
											$template->assign_block_vars('T', array(
												'N' => $puesto,
												'CLASE' => $top['TXTCLASE'],
												'DATO' => "PvP: ".$top['PVP'],
												'IMG' => $top['IMGCLASE'],
												'NOMBRE' => $top['nombre']
												));
									}
							$template->assign_var('TITULO',"Top PvP");			
							$template->set_filenames(array(
							'content' => 'templates/sec/verinfo.html' )
						);		
						break;
						case 'pk':
						$template->assign_var('TITULO',"Top PK");	
							$query = 'SELECT p.nombre, p.nivel, p.PK, c.nombre AS TXTCLASE, c.imagen AS IMGCLASE
									FROM personaje p, clase c
									WHERE p.idClase = c.idClase AND PK > 0 AND p.idPersonaje != 1
									ORDER BY PK DESC LIMIT 0,10';
									$topsq = $db->sql_query($query);
									$puesto=0;
									while($top = $db->sql_fetchrow($topsq))
									{
										$puesto++;
											$template->assign_block_vars('T', array(
												'N' => $puesto,
												'CLASE' => $top['TXTCLASE'],
												'DATO' => "PK: ".$top['PK'],
												'IMG' => $top['IMGCLASE'],
												'NOMBRE' => $top['nombre']
												));
									}
							$template->set_filenames(array(
							'content' => 'templates/sec/verinfo.html' )
						);		
						break;
						case 'lvl':
						$template->assign_var('TITULO',"Top Lvl");	
							$query = 'SELECT p.nombre, p.nivel, c.nombre AS TXTCLASE, c.imagen AS IMGCLASE
									FROM personaje p, clase c
									WHERE p.idClase = c.idClase AND p.idPersonaje != 1
									ORDER BY p.nivel DESC LIMIT 0,10 ';
									$topsq = $db->sql_query($query);
									$puesto=0;
									while($top = $db->sql_fetchrow($topsq))
									{
										$puesto++;
											$template->assign_block_vars('T', array(
												'N' => $puesto,
												'CLASE' => $top['TXTCLASE'],
												'DATO' => "Lvl: ".$top['nivel'],
												'IMG' => $top['IMGCLASE'],
												'NOMBRE' => $top['nombre']
												));
									}
							$template->set_filenames(array(
							'content' => 'templates/sec/verinfo.html' )
						);		
						break;
						case 'ricos':
						$template->assign_var('TITULO',"Top Ricos");	
							$query = 'SELECT p.nombre, p.nivel, cue.oro, c.nombre AS TXTCLASE, c.imagen AS IMGCLASE
									FROM personaje p, clase c, cuenta cue
									WHERE p.idClase = c.idClase AND cue.pjSelected = p.idPersonaje AND cue.oro > 0 AND p.idPersonaje != 1
									ORDER BY cue.oro DESC LIMIT 0,10';
									$topsq = $db->sql_query($query);
									$puesto=0;
									while($top = $db->sql_fetchrow($topsq))
									{
										$puesto++;
											$template->assign_block_vars('T', array(
												'N' => $puesto,
												'CLASE' => $top['TXTCLASE'],
												'DATO' => "Oro: ".$top['oro'],
												'IMG' => $top['IMGCLASE'],
												'NOMBRE' => $top['nombre']
												));
									}
							$template->set_filenames(array(
							'content' => 'templates/sec/verinfo.html' )
						);		
						break;
						default:
					$template->set_filenames(array(
							'content' => 'templates/sec/info.html' )
						);
					$query = 'SELECT count(*) as CONTA FROM cuenta';
					$counta = $db->sql_fetchrow($db->sql_query($query));	
						$template->assign_var('CUENTAS',$counta['CONTA']);	
						
					$query = 'SELECT count(*) as CONTA FROM personaje';
					$counta = $db->sql_fetchrow($db->sql_query($query));	
						$template->assign_var('PJS',$counta['CONTA']);	
					
					$query = 'SELECT count(*) as CONTA FROM item';
					$counta = $db->sql_fetchrow($db->sql_query($query));	
						$template->assign_var('ITEMS',$counta['CONTA']);	
					
						$query = 'SELECT count(*) as CONTA FROM monster';
					$counta = $db->sql_fetchrow($db->sql_query($query));	
						$template->assign_var('MONST',$counta['CONTA']);		
					
					$query = 'SELECT count(*) as CONTA FROM skill';
					$counta = $db->sql_fetchrow($db->sql_query($query));	
						$template->assign_var('SKILLS',$counta['CONTA']);		
						
					$query = 'SELECT count(*) as CONTA FROM clase';
					$counta = $db->sql_fetchrow($db->sql_query($query));	
						$template->assign_var('CLASES',$counta['CONTA']);		
					break;
					}
?> 