<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
							'content' => 'templates/sec/pasivos.html' )
						);
 $template->assign_var('ADVPUNTOS', $pj['pasivosCurr']);
	if($dimencion!=1)
		{
			$errorMsg="Tienes que estar en la dimencion de Embolia";
			show_error($errorMsg,"index.php");
		}
		else
		{			
	$query = 'SELECT p.*, s.nombre,s.skill_requiere, s.desc, sl.idskilllearn
					FROM pasivos p JOIN skill s USING ( idSkill ) LEFT JOIN skilllearn sl on sl.idSkill = s.idSkill AND sl.idPersonaje = '.$pj['idPersonaje'].'';
					$skillsq = $db->sql_query($query);
					while($skill = $db->sql_fetchrow($skillsq))
					{	
						$cadena = utf8_encode($skill['desc']);
						$cadena = @eregi_replace("/\r\n+|\r+|\n+|\t+/i",  ' ', $cadena);
						if($skill['idskilllearn']>0)
						{
							$template->assign_block_vars('S', array(
												'ID' => $skill['idPas'],
												'NAME' => $skill['nombre'],
												'COOX' => $skill['posX'],
												'COOY' => $skill['poxY'],
												'IMG' => $skill['pasImg'],
												'DESC' => $cadena
												));	
						}
						else
						{
							$template->assign_block_vars('S', array(
												'ID' => $skill['idPas'],
												'NAME' => $skill['nombre'],
												'COOX' => $skill['posX'],
												'COOY' => $skill['poxY'],
												'IMG' => $skill['pasImg'],
												'NEW' => '<div id="p'.$skill['idPas'].'ap"><a href="javascript:aprender('.$skill['idPas'].');">Ir a Aventura</a></div>',
												'DESC' => $cadena,
												'BLACK' => "pasNoAprendido"
												));
						}
					}			
				}
				
?> 