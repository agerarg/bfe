<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
	if(isset($_GET['ver']))
							{
								$id = intval($_GET['ver']);
								$query = 'SELECT * FROM monster WHERE activo = 1 AND idMonster = "'.$id.'" AND dimen='.$dimencion.'';
								$monstersq = $db->sql_query($query);
								$monster = $db->sql_fetchrow($monstersq);
								if($monster)
								{
									$template->set_filenames(array(
										'content' => 'templates/sec/drops.html' )
									);
									$template->assign_var('MONSIMG', $monster['imagen']);
									$template->assign_var('PAGE', $_GET['page']);
									$template->assign_var('MONSTNAME', $monster['nombre']);
									$template->assign_var('MONSTID',$id);
								}
								else
									show_error("No existe el monstruo","index.php?sec=drops");
					
							}
							else
							{
								show_error("No existe el monstruo","index.php");
							}
?> 