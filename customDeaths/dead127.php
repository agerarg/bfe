<?php
  $goldModifier=25000000;
  $expModifier=1000000;
systemLog("global","<div class=goblindead>El mono dorado ha sido derrotado por ".$pj['nombre']."!</div>") ;
  if($pj['party']>0)
						{
										 if($pj['nivel']<=60)
											$virgus=" ".$pj["nombre"];

										$query = 'SELECT p.idCuenta, p.idPersonaje, p.nombre, p.nivel, p.idClase
															FROM personaje p JOIN cuenta c USING ( idCuenta )
													WHERE c.pjSelected = p.idPersonaje AND p.party='.$pj['party'].' AND p.party>0 ORDER BY RAND()';
													$targetssq = $db->sql_query($query);	
											while($targets = $db->sql_fetchrow($targetssq))
														{
															$drop = goldMonkeyDrop($targets['idCuenta'],$targets['nombre'],6);
														$db->sql_query('INSERT INTO  chat(party,mensaje) 
													VALUES("'.$pj['party'].'","<spam class='."'raidDrop'".' >'.$drop['dropMsg'].'</spam>")');
															
														$drop = goldMonkeyDrop($targets['idCuenta'],$targets['nombre'],6);
														$db->sql_query('INSERT INTO  chat(party,mensaje) 
													VALUES("'.$pj['party'].'","<spam class='."'raidDrop'".' >'.$drop['dropMsg'].'</spam>")');

															if($targets["idPersonaje"]!=$log->get("pjSelected"))	
															{	
																	 if($targets["nivel"]<LVLLIMIT)
																		$db->sql_query("UPDATE personaje SET exp = (exp+".($expModifier+$bonus).") WHERE idPersonaje = '".$targets["idPersonaje"]."'");
																		$db->sql_query("UPDATE cuenta SET oro = (oro+".$goldModifier.") WHERE idCuenta = ".$targets['idCuenta']);
															}
												}

	                                       systemLog("party","<div class=drop2>>Mono Dorado derrotado por ".$pj['nombre']."!<br> Ganaste ".$expModifier." de exp y ".$goldModifier." de oro".$extraBonus."</div>");
										
                 } else {
                 		//ALONE
                 	$drop = goldMonkeyDrop($pj['idCuenta'],$pj['nombre'],6);
					systemLog("self",'<spam class=raidDrop >'.$drop['dropMsg'].'</spam>') ;

					$drop = goldMonkeyDrop($pj['idCuenta'],$pj['nombre'],6);
					systemLog("self",'<spam class=raidDrop >'.$drop['dropMsg'].'</spam>') ;
					
					systemLog("self","<div class=drop2>Mono Dorado derrotado! Ganaste ".$expModifier." de exp y ".$goldModifier." de oro</div>") ;
															
				}
?>
