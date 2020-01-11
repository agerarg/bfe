<?php

$check = checkPermutacionItem($item);
					if($item['tipo']=="pot")
									{
										$data["error"] = "No se pueden regalar posiones.";
									}
									else
							if($check['result'])
							{
								$cant = intval($_GET['cant']);
								$tal = textIntoSql($_GET['tal']);
								$query = 'SELECT idCuenta, nombre, idPersonaje FROM personaje
								WHERE nombre = "'.$tal.'"';
								$nino = $db->sql_fetchrow($db->sql_query($query));
								if($nino['idCuenta']==$log->get("idCuenta"))
								{
									$data["error"] = "No podes regalarle items a personajes de tu misma cuenta.";
								}else
								if($nino)
								{
									if($item['contable'])
									{
										if($cant<=$item['cantidad'] AND $cant>=1)
										{
											$resto = $item['cantidad']-$cant;
											$db->sql_query("UPDATE inventario SET cantidad=".$resto."  WHERE idInventario = ".$item['idInventario']);
											
											$query = 'SELECT inv.idInventario, i.contable
															FROM inventario inv JOIN item i USING ( idItem )
											WHERE inv.idCuenta = '.$nino['idCuenta'].' AND inv.idItem = '.$item['idItem'].'';
											$giveritemsq = $db->sql_query($query);
											$giveritem = $db->sql_fetchrow($giveritemsq);
											
											if($giveritem)
												$db->sql_query("UPDATE inventario SET
															cantidad = (cantidad+".$cant.")
															WHERE idInventario = ".$giveritem['idInventario']);
											else
							$db->sql_query('INSERT INTO inventario(idItem,idCuenta,cantidad) VALUES("'.$item['idItem'].'","'.$nino['idCuenta'].'","'.$cant.'")');
											
											$data["error"] = 0;
												$msg = "<span class='givemsg'>".$pj['nombre']." regalo ".$cant." ".$item['Nombre']." a ".$nino['nombre']."</span>";
												$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
										VALUES("'.$pj['idPersonaje'].'","'.$msg.'")');
												$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
										VALUES("'.$nino['idPersonaje'].'","'.$msg.'")');
										}
										else
										{
											$data["error"] = "La cantidad es incorrecta";
										}
									}
									else
									{
										$msg = "<span class='givemsg'>".$pj['nombre']." regalo  ".$item['Nombre']." a ".$nino['nombre']."</span>";
									$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
							VALUES("'.$pj['idPersonaje'].'","'.$msg.'")');
									$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
							VALUES("'.$nino['idPersonaje'].'","'.$msg.'")');
							
									$db->sql_query("UPDATE inventario SET idCuenta = ".$nino['idCuenta']." WHERE idInventario = ".$item['idInventario']);	
									$data["error"] = 0;
									}
								}
								else
								{
									$data["error"] = "El nombre del personaje es incorrecto.";
								}
							}
							else
								$data["error"] = $check['error'];

?>