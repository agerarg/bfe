<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if($_GET['sacar'])
						{
							$idCore=333;
							$epic=0;
							switch($_GET['sacar'])
							{
								case 'casco':
									$costo=1;
									$type ="head";
								break;
								case 'guantes':
									$costo=1;
									$type ="gloves";
								break;
								case 'botas':
									$costo=1;
									$type ="foots";
								break;
								case 'armadura':
									$costo=2;
									$type ="armor";
								break;
								case 'arma':
									$costo=3;
									$type ="W";
								break;
								case 'epic_arma':
									$idCore=334;
									$costo=1;
									$type ="W";
									$epic=1;
								break;
								default:
								die("error loco");
								break;
							
							}
								$query = 'SELECT idInventario, cantidad
													FROM inventario
													WHERE idCuenta = '.$log->get("idCuenta").' AND '.$idCore.' = idItem ';
								$itemsq = $db->sql_query($query);
								$res = $db->sql_fetchrow($itemsq);
							if($res)
							{
								if($res['cantidad']>=$costo)
								{
									$db->sql_query("UPDATE inventario SET cantidad = (cantidad-".$costo.") WHERE idInventario = ".$res['idInventario']);
									
									include("system/legendary.php");
									$itemId = createLegendary($type,$epic,1,7);
									
									$query = 'SELECT i.*, inv.idInventario, inv.usadoPor, inv.enVenta, inv.trade, inv.cantidad, inv.intradeable, inv.enchant, il.atributos
									FROM item i, inventario inv LEFT JOIN inventario_legend il on il.idInventario = inv.idInventario 
									WHERE inv.idCuenta = '.$log->get("idCuenta").' AND i.idItem = inv.idItem AND inv.idInventario = '.$itemId.'';
									$itemsq = $db->sql_query($query);
									$item = $db->sql_fetchrow($itemsq);
									
									
									show_message("Conseguiste: ".$item['Nombre']."<br>Propiedades:<br>".$item['atributos']."","index.php?sec=atendedor");
									
								}
								else
								show_error("No tienes los items necesarios.","index.php?sec=atendedor");
							}
							else
							{
								show_error("No tienes los items necesarios.","index.php?sec=atendedor");
							}
						}
						else
						{
							$template->set_filenames(array(
										'content' => 'templates/sec/atendedor.html' )
									);
						}
?> 