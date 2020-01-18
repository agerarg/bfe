<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
										$goFight=0;	
										if($pj['party']==0)
										{
											show_error("Necesitas una party para entrar aqui","index.php?sec=mundo&");
											$goFight=0;	
										}
										/*else
										if($pj['nivel']>$mundo['nivel']+20)
										{
											show_error("No puedes tener mas de 20 niveles que el raid","index.php?sec=mundo&");
											$goFight=0;	
										}
										else*/
										if($pj['nivel']<$mundo['nivel'])
										{
											show_error("No tienes suficiente nivel","index.php?sec=mundo&");
											$goFight=0;	
										}
										else
										if($stats['AstralPass']==0)
										{
											show_error("Necesitas estar en el mundo astral, usa el item Lost Gark Head (Se consigue matando el Raid Boss Lost Gark).","index.php?sec=mundo&");
											$goFight=0;	
										}
										else
										{
											$goFight=1;	
										}


										
										
									
?> 