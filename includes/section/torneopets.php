<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
	$template->set_filenames(array(
			'content' => 'templates/sec/torneoFixture.html' )
		);
									$query = 'SELECT tp.slotPosicion, tp.idMascota1, tp.idMascota2, mb.nombre AS PRIMERO, mb2.nombre AS SEGUNDO
									FROM torneo_posicion tp 
									LEFT JOIN mascota_body mb ON tp.idMascota1 = mb.idMascota
									LEFT JOIN mascota_body mb2 ON tp.idMascota2 = mb2.idMascota
									WHERE idTorneo = 1 ORDER BY idPosicion';
									$dropsq = $db->sql_query($query);
										$nro=1;
										$nro2=1;
										$nro3=1;
										$nro4=1;
										while($drop = $db->sql_fetchrow($dropsq))
										{
											switch($drop['slotPosicion'])
											{
												case 1:
													$template->assign_var($drop['slotPosicion'].'SLOT'.$nro,$drop['PRIMERO']);	
													//echo $drop['slotPosicion'].'SLOT'.$nro,$drop['PRIMERO'].'<br>';
													$nro++;
													$template->assign_var($drop['slotPosicion'].'SLOT'.$nro,$drop['SEGUNDO']);
													//echo $drop['slotPosicion'].'SLOT'.$nro,$drop['SEGUNDO'].'<br>';
													$nro++;
												break;
												case 2:
													$template->assign_var($drop['slotPosicion'].'SLOT'.$nro2,$drop['PRIMERO']);	
													//echo $drop['slotPosicion'].'SLOT'.$nro,$drop['PRIMERO'].'<br>';
													$nro2++;
													$template->assign_var($drop['slotPosicion'].'SLOT'.$nro2,$drop['SEGUNDO']);
													//echo $drop['slotPosicion'].'SLOT'.$nro,$drop['SEGUNDO'].'<br>';
													$nro2++;
												break;
												case 3:
													$template->assign_var($drop['slotPosicion'].'SLOT'.$nro3,$drop['PRIMERO']);	
													//echo $drop['slotPosicion'].'SLOT'.$nro,$drop['PRIMERO'].'<br>';
													$nro3++;
													$template->assign_var($drop['slotPosicion'].'SLOT'.$nro3,$drop['SEGUNDO']);
													//echo $drop['slotPosicion'].'SLOT'.$nro,$drop['SEGUNDO'].'<br>';
													$nro3++;
												break;
												case 4:
													$template->assign_var($drop['slotPosicion'].'SLOT'.$nro4,$drop['PRIMERO']);	
													//echo $drop['slotPosicion'].'SLOT'.$nro,$drop['PRIMERO'].'<br>';
													$nro4++;
													$template->assign_var($drop['slotPosicion'].'SLOT'.$nro4,$drop['SEGUNDO']);
													//echo $drop['slotPosicion'].'SLOT'.$nro,$drop['SEGUNDO'].'<br>';
													$nro4++;
												break;
											}
										}	
										$query = 'SELECT b.nombre
									FROM torneo t 
									LEFT JOIN mascota_body b ON t.primero = b.idMascota
									WHERE idTorneo = 1';
									$dropsq = $db->sql_query($query);
									$drop = $db->sql_fetchrow($dropsq);
									if($drop)
										$template->assign_var('PRIMERO',$drop['nombre']);
		
?> 