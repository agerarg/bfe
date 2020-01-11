<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
										$goFight=0;	
										if($pj['party']>0)
										{
											show_error("Solo puedes hacer esto solo sin party","index.php?sec=mundo&");
											$goFight=0;	
										}
										else
										if($pj['nivel']>$mundo['nivel']+20 && $mundo['id'] != 153)
										{
											show_error("No puedes tener mas de 20 niveles que la catacumba","index.php?sec=mundo&");
											$goFight=0;	
										}
										else
										if($pj['nivel']<$mundo['nivel'])
										{
											show_error("No tienes suficiente nivel","index.php?sec=mundo&");
											$goFight=0;	
										}
										else
										if($mundo['warTime']<$now)
										{
											
											switch($mundo['id'])
											{
												case 151:
													$itemTier=1;
													$reqsd="Requiere runas nivel 2, 3 y 4.";
												break;
												case 152:
													$itemTier=2;
													$reqsd="Requiere runas nivel 5 y 6.";
												break;
												case 153:
													$itemTier=3;
													$reqsd="Requiere runas nivel 7 y 8.";
												break;
												default:
													die("Cata critical error!");
												break;
											}

											$goFight=0;
											$template->set_filenames(array(
													'content' => 'templates/sec/cataIN.html' ));
											
											$template->assign_var('RETOTIER', $itemTier);
											$template->assign_var('ITEMREQ', $reqsd);
										
														
										}
										
									
?> 