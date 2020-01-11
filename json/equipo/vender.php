<?php

$check = checkPermutacionItem($item);
						if($check['result'])
							{

								$query = 'SELECT count(*) as CONTA
								FROM compra_venta
								WHERE idCuenta = '.$log->get("idCuenta").'';
								$ventas = $db->sql_fetchrow($db->sql_query($query));
								if($log->get("premium")==1)
									$ventasLimit=10;
								else
									$ventasLimit=5;
								if($ventas['CONTA']>=$ventasLimit)
								{
									$data["error"] = "Ya estas vendiendo el limite de items que es ".$ventasLimit.".";
								}
								else
								{

									$price = intval($_GET['price']);
									$cantidad = intval($_GET['cantidad']);
									$moneda = intval($_GET['moneda']);
									if($price<100 && ($moneda>0 && $price<=0))
										$data["error"] = "Error en el precio.";
									else if($price>99999999)
										$data["error"] = "El precio es estupidamente caro.";
									else
									{
										if($item['contable'])
											$price=$price*$cantidad;
										$trueCoin=true;
										switch($moneda)
										{
											case 613:
												$coinName="ReRoll";
											break;
											case 614:
												$coinName="Chaos";
											break;
											case 615:
												$coinName="Upulus";
											break;
											case 616:
												$coinName="Exodimo";
											break;
											case 617:
												$coinName="Alquimist";
											break;
											case 618:
												$coinName="Corruption";
											break;
											case 0:
												$coinName="de Oro";
											break;
											default:
												$trueCoin=false;
											break;
										}
											
										if($item['contable']==1 && ($cantidad<=0 || $cantidad>$item['cantidad']))
											$data["error"] = "Error en cantidad de items.";	
										else
										if($trueCoin)
										{
										///////
											if($item['contable'])
												$price=intval($price/$cantidad);
											if($item['enchant']>0)
												$enchant = "+".$item['enchant'];
											if($item['SA']==1)
												$sa="(".$item['SAchar'].")";

											

											if($item['contable'])
												$msg = "<div class=msales>".$pj['nombre']." puso en venta ".$cantidad." ".$item['Nombre']." a ".$price." ".$coinName." c/u!</div>";
											else
												$msg = "<div class=msales>".$pj['nombre']." puso en venta ".$item['Nombre'].$enchant.$sa." a ".$price." ".$coinName."!</div>";
											systemLog("global",$msg);
											
											$db->sql_query("UPDATE inventario SET enVenta = 1 WHERE idInventario = ".$item['idInventario']);	
											
											$query = "INSERT INTO compra_venta 
											(idInventario,precio,wachTime,idCuenta,cantidadVenta,idCurrency) 
											VALUES('".$item['idInventario']."',
											'".$price."',
											".($now+300).",
											".$log->get("idCuenta").",
											".$cantidad.",
											".$moneda.")";					
											$db->sql_query($query);
											$data["error"] = 0;
											$data["precio"] = $price;
											$data['gold'] = $realGold-$feed;

										}
										else
										{
											$data["error"] = "PUTO EL QUE LEE.";
										}
										//
									}	
								}						
						}
						else
							$data["error"] = $check["error"];

?>