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
										if($pj['nivel']>$mundo['nivel']+20 && $mundo['nivel']<80)
										{
											show_error("No puedes tener mas de 20 niveles que el reto","index.php?sec=mundo&");
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
												case 146:
													$itemTier=1;
													$reqsd="Items Grado NG (Nivel: 1)";
												break;
												case 147:
													$itemTier=2;
													$reqsd="Items Grado D (Nivel: 20)";
												break;
												case 148:
													$itemTier=3;
													$reqsd="Items Grado C (Nivel: 40)";
												break;
												case 149:
													$itemTier=4;
													$reqsd="Items Grado B (Nivel: 51)<br>Solo Epicos o Legendarios";
												break;
												case 150:
													$itemTier=5;
													$reqsd="Items Grado A (Nivel: 61)<br>Solo Epicos o Legendarios";
												break;
												case 154:
													$itemTier=6;
													$reqsd="Items Grado S (Nivel: 76)<br>Solo Legendarios";
												break;
												default:
													die("Reto critical error!");
												break;
											}

											$goFight=0;
											$template->set_filenames(array(
													'content' => 'templates/sec/retoIN.html' ));
											
											$template->assign_var('RETOTIER', $itemTier);
											$template->assign_var('ITEMREQ', $reqsd);
										
														
										}
										
									
?> 