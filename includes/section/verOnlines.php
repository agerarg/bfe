<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
							'content' => 'templates/sec/onlinePpl.html' )
						);	
					
					define('PATH_USERS', '?sec=verOnlines&');
					 define('PAGINAS', 9);
					$page_number = intval($_GET['page']);
					if( $page_number == 0 ) 
					{ 
						$page_number = 1;
					}
					$query = 'SELECT count(*) as CONTA 
							  FROM personaje WHERE online > '.($now-600).' ';
					$count = $db->sql_fetchrow($db->sql_query($query));
					$filas = $count['CONTA'];
					$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
				$query = 'SELECT p.*,c.nombre AS CLASE ,c.imagen FROM personaje p JOIN clase c USING ( idClase ) 
				WHERE online > '.($now-600).' ORDER BY nivel DESC LIMIT '.$limitbottom.', '.PAGINAS;;
						$membersq = $db->sql_query($query);
						$template->assign_var('NUMERACION', $numeracion);
						$num = ( $page_number - 1 ) * PAGINAS;
						while($member = $db->sql_fetchrow($membersq))
						{	
							$template->assign_block_vars('M', array(
													'NOMBRE' => $member['nombre'],
													'IMG' =>  $member['imagen'].'_'.$member['sexo'].'.png',
													'LVL' =>  $member['nivel'],	
													'CLASE' => $member['CLASE'],	
													'CLANPGAIN' => $member['clanpvp']
													));
						}	
				
?> 