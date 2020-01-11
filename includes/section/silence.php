<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
							'content' => 'templates/sec/silence.html' )
						);	
					
	if(isset($_GET['sacarSl']))
	{
		$id = (int)$_GET['sacarSl'];

		$db->sql_query("DELETE FROM chatsilence WHERE idPlayer = ".$idPersonajeBase." AND idTarget=".$id);
		show_message("Se removio el silence!","index.php?sec=silence");

	}
	else
	{


					define('PATH_USERS', '?sec=silence&');
					 define('PAGINAS', 9);
					$page_number = intval($_GET['page']);
					if( $page_number == 0 ) 
					{ 
						$page_number = 1;
					}
					$query = 'SELECT count(*) as CONTA 
							  FROM chatsilence WHERE idPlayer = '.$idPersonajeBase.' ';
					$count = $db->sql_fetchrow($db->sql_query($query));
					$filas = $count['CONTA'];
					$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
				$query = 'SELECT p.*,c.nombre AS CLASE ,c.imagen FROM chatsilence cs JOIN personaje p ON cs.idTarget = p.idPersonaje  JOIN clase c USING ( idClase ) 
				WHERE cs.idPlayer = '.$idPersonajeBase.' ORDER BY nivel DESC LIMIT '.$limitbottom.', '.PAGINAS;
						$membersq = $db->sql_query($query);
						$template->assign_var('NUMERACION', $numeracion);
						$num = ( $page_number - 1 ) * PAGINAS;
						while($member = $db->sql_fetchrow($membersq))
						{	
							$template->assign_block_vars('M', array(
													'NOMBRE' => $member['nombre'],
													'IMG' =>  $member['imagen'].'_'.$member['sexo'].'.png',
													'LVL' =>  $member['nivel'],	
													'ID' =>  $member['idPersonaje'],	
													'CLASE' => $member['CLASE'],	
													'CLANPGAIN' => $member['clanpvp']
													));
						}	
				}
?> 