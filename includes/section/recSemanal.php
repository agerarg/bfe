<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
//ADMIN

	$template->set_filenames(array(
			'content' => 'templates/sec/clanWeek.html' )
		);
		$template->assign_var('RECOMEPENZA', $gameCore['recompenza']);

		$query = 'SELECT *
					FROM clan 
					WHERE activo = 1 AND puntos_fijo>0
					ORDER BY puntos_fijo DESC LIMIT 3';
					$clansq = $db->sql_query($query);
					while($clan = $db->sql_fetchrow($clansq))
					{	
						$numero++;
						$template->assign_block_vars('CLAN', array(
												'ID' => $clan['idClan'],
												'NRO' => $numero,
												'NOMBRE' => $clan['nombre'],
												'IMG' => $clan['img'],
												'MEMBERS' => $clan['members'],
												'PTS' =>  $clan['puntos_fijo'],	
												'PUNTOS' =>  $clan['puntos_fijo'],	
												'IMG' => $skill['imagen'],
												'CAP' => $skill['capaciad']
												));
					}
?> 