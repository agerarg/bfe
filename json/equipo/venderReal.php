<?php


if($item['idItem']==283 OR $item['idItem']==284)
									{
										$data["error"] = "No se pueden vender posiones.";
									}
									else
						if($item['enVenta']==1)
							$data["error"] = "El item ya esta en venta";
						else 
							if($item['usadoPor']==0)
							{
								$realGold = $log->realGold();
								$precio = $item['grado']*50;
								
								$data['gold'] = $realGold+$precio;
								$db->sql_query("UPDATE cuenta SET oro = ".($realGold+$precio)." WHERE idCuenta = ".$log->get("idCuenta"));
								$data["error"] = 0;
							
								delete_item($item['idInventario']);
								$msg= $item['Nombre']." vendido a ".$precio." de oro!";
								systemLog("self",$msg);

							}
							else
								$data["error"] = "Este item esta siendo usado.";


?>