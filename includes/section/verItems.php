<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$template->set_filenames(array(
											'content' => 'templates/sec/veritems.html' )
										);

// QUEST
											$query = 'SELECT idMisionOn
																	FROM misiononplayer
																	WHERE idPersonaje = "'.$pj['idPersonaje'].'" AND idMision = 66 AND follow = 81 AND finalizado=0';
														
														$questsq = $db->sql_query($query);
														$quest = $db->sql_fetchrow($questsq);
														if($quest)
														{
																 $template->assign_var('QUESTUP', 1);
														}
											///////

?> 