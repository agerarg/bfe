<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$id=intval($_GET['id']);
							$query = 'SELECT tp.* , t.nombre
										FROM  torneo_posicion tp JOIN torneo t USING ( idTorneo	 )
										 WHERE idPosicion = '.$id.'';
							$inTorneo = $db->sql_fetchrow($db->sql_query($query));
						
						if($inTorneo)
						{
									$template->assign_var('PElEAID', $id);
								$template->assign_var('TORNEO', $inTorneo['nombre']);
									$template->assign_var('TORNEOID', $inTorneo['idTorneo']);
							$template->set_filenames(array(
										'content' => 'templates/sec/pelea.html' )
									);
									$template->assign_var('HISTORY', $inTorneo['historia']);
							$query = 'SELECT p.idPersonaje, p.nivel, p .nombre, p.sexo , c.dicho, c.nombre AS CLASE, c.imagen
											FROM personaje p JOIN clase c USING ( idClase )
										WHERE p.idPersonaje = '.$inTorneo['idMascota1'].'';
								$pj1 = $db->sql_fetchrow($db->sql_query($query));
		
									$template->assign_var('NOMBRE1', $pj1['nombre']);
									$template->assign_var('LVL1', $pj1['nivel']);
									$template->assign_var('CLASE1', $pj1['CLASE']);
									$template->assign_var('IMG1', $pj1['imagen'].'_'.$pj1['sexo'].'.jpg');
									$template->assign_var('ID1', $pj1['idPersonaje']);
									
						$query = 'SELECT p.idPersonaje, p.nivel, p .nombre, p.sexo , c.dicho, c.nombre AS CLASE, c.imagen
											FROM personaje p JOIN clase c USING ( idClase )
										WHERE p.idPersonaje = '.$inTorneo['idMascota2'].'';
								$pj2 = $db->sql_fetchrow($db->sql_query($query));
		
									$template->assign_var('NOMBRE2', $pj2['nombre']);
									$template->assign_var('LVL2', $pj2['nivel']);
									$template->assign_var('CLASE2', $pj2['CLASE']);
									$template->assign_var('IMG2', $pj2['imagen'].'_'.$pj2['sexo'].'.jpg');
									$template->assign_var('ID2', $pj2['idPersonaje']);
						}
						else
						{
								show_error("No existe esta pelea","index.php");
						}
?> 