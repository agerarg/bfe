<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////

if($logros['slajim']>=3)
	{

$query = 'SELECT *
					FROM clan WHERE idClan = '.$pj["clan"].'';
	$lidersq = $db->sql_query($query);
	$lidercheck = $db->sql_fetchrow($lidersq);
if($lidercheck)
	$template->assign_var('DMINLINK', "<a href='index.php?sec=clanmanage'>Manejar Clan ".$lidercheck['nombre'].'</a>');
else
	$template->assign_var('DMINLINK', "<a href='index.php?sec=crearclan'>Crear Clan</a>");	
	
if(isset($_GET['id']))
{
			$id = intval($_GET['id']);
			$query = 'SELECT c.*, p.nombre AS LIDER
					FROM clan c LEFT JOIN personaje p ON c.idLeader = p.idPersonaje
					WHERE c.idClan = '.$id.'';
					$clansq = $db->sql_query($query);
			if($clan = $db->sql_fetchrow($clansq))
			{	
			
				$query = 'SELECT count(*) as CONTA 
									  FROM personaje WHERE clan = '.$id.'  ';
				$count = $db->sql_fetchrow($db->sql_query($query));
				$filas = $count['CONTA'];
				
					$template->set_filenames(array(
									'content' => 'templates/sec/clanperfil.html' )
								);	
					$query = 'SELECT count(*) as CONTA 
									  FROM personaje WHERE clan = '.$id.' AND SubClassFrom = 0';
							$count = $db->sql_fetchrow($db->sql_query($query));
							$filas = $count['CONTA'];
					$template->assign_var('LIDER', $clan['LIDER']);	
					$template->assign_var('RUNZ', $clan['nivel']);
					$MAXCantidad = 6;
					
					
					$template->assign_var('MIEMBROS', $filas.' / '.$MAXCantidad);
					
					$template->assign_var('PUNTOS', $clan['puntos_fijo']);
					
					$template->assign_var('NOMBRECLAN', $clan['nombre']);
					
					$medallas="";
					if($clan['Cseal'])
						$medallas.='<img title="Grado C" src="images/clan/mdC.png" />';
					if($clan['Bseal'])
						$medallas.='<img title="Grado B" src="images/clan/mdB.png" />';
					if($clan['Aseal'])
						$medallas.='<img title="Grado A" src="images/clan/mdA.png" />';
					if($clan['Sseal'])
						$medallas.='<img title="Grado S" src="images/clan/mdS.png" />';
					if($clan['Xseal'])
						$medallas.='<img title="Grado X" src="images/clan/mdX.png" />';
					if(strlen ($medallas)<5)
						$medallas="Ninguna.";
					$template->assign_var('MEDALLAS', $medallas);	
					
					define('PATH_USERS', '?sec=clan&id='.$id.'&');
					 define('PAGINAS', 7);
					$page_number = intval($_GET['page']);
					if( $page_number == 0 ) 
					{ 
						$page_number = 1;
					}
					$query = 'SELECT count(*) as CONTA 
							  FROM personaje WHERE clan = '.$id.' AND SubClassFrom = 0';
					$count = $db->sql_fetchrow($db->sql_query($query));
					$filas = $count['CONTA'];
					$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
				$query = 'SELECT p.*,c.nombre AS CLASE ,c.imagen FROM personaje p JOIN clase c USING ( idClase ) 
				WHERE p.clan = '.$id.' ORDER BY nivel DESC LIMIT '.$limitbottom.', '.PAGINAS;;
						$membersq = $db->sql_query($query);
						$template->assign_var('NUMERACION', $numeracion);
						$num = ( $page_number - 1 ) * PAGINAS;
						while($member = $db->sql_fetchrow($membersq))
						{	
							$template->assign_block_vars('M', array(
													'NOMBRE' => $member['nombre'],
													'IMG' =>  $member['imagen'].'_'.$member['sexo'].'.jpg',
													'LVL' =>  $member['nivel'],	
													'CLASE' => $member['CLASE'],	
													'CLANPGAIN' => $member['clanpvp']
													));
						}	
				
			}	
			else
				show_error("No existe el clan","index.php?sec=clan");
			
}
else
{					
					$template->set_filenames(array(
							'content' => 'templates/sec/clanlist.html' )
						);	
					define('PATH_USERS', '?sec=clan&');
					 define('PAGINAS', 10);
					 
					 if($pj['clan']==0)
						$template->assign_var('CREATECLAN', "<a href='?sec=clan&crear'>Crear Clan</a>");
					 
					$page_number = intval($_GET['page']);
					if( $page_number == 0 ) 
					{ 
						$page_number = 1;
					}
					$query = 'SELECT count(*) as CONTA 
							  FROM clan  WHERE activo = 1';
					$count = $db->sql_fetchrow($db->sql_query($query));
					$filas = $count['CONTA'];
					$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
					$query = 'SELECT *
					FROM clan 
					WHERE activo = 1
					ORDER BY puntos_fijo DESC LIMIT '.$limitbottom.', '.PAGINAS;
					$clansq = $db->sql_query($query);
					$template->assign_var('NUMERACION', $numeracion);
					$num = ( $page_number - 1 ) * PAGINAS;
					$numero = $page_number * PAGINAS - PAGINAS;
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
}
	}
	else
	{
		show_error("No tienes acceso a esta sección ","index.php");
	}
?> 