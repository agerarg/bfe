<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////

$template->set_filenames(array(
											'content' => 'templates/sec/auras.html' )
										);
define('PATH_USERS', 'index.php?sec=compra_auras&');
									 define('PAGINAS', 6);
									$page_number = intval($_GET['page']);
									if( $page_number == 0 ) 
									{ 
										$page_number = 1;
									}
									$query = 'SELECT count(*) as CONTA 
											  FROM skill WHERE buffSell = 1 ';
									$count = $db->sql_fetchrow($db->sql_query($query));
									$filas = $count['CONTA'];
								$numeracion = NumerarPaginas($page_number, $filas, PATH_USERS, $limitbottom, PAGINAS);
								$query = 'SELECT *
								FROM skill WHERE buffSell = 1  LIMIT '.$limitbottom.', '.PAGINAS;
								$buffsq = $db->sql_query($query);
								$template->assign_var('NUMERACION', $numeracion);
								$num = ( $page_number - 1 ) * PAGINAS;

								$costo = intval($pj['nivel']*$pj['nivel']*$pj['nivel']/100 + 100);

								while($buff = $db->sql_fetchrow($buffsq))
								{	
									$template->assign_block_vars('BUFF', array(
															'ID' => $buff['idSkill'],
															'NOMBRE' => $buff['nombre'],
															'IMG' => $buff['imagen'],
															'DESC' =>  $buff['desc'],	
															'COST' => $costo
															));
								}	