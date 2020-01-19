<?php
$data["itemTipo"]=$item['tipo'];
$data["itemSubtipo"]=$item['subtipo'];
$customMsg=false;
$data['noBorrarItem']=0;
if($item['Nivel']<=$pj['nivel'] OR $item['epic']==1 AND $pj['nivel']>=40)
							if($item['ClaseReq']<=$pj['idClase'])
								{
									$error=0;
									
									if($item['usadoPor']>0)
									{
										$data["error"] = "Item en uso!";
										$error=1;
									}
									if($item['enVenta']==1)
									{
										$data["error"] = "El item esta en venta.";
										$error=1;
									}
									if($item['trade']==1)
									{
										$data["error"] = "The item is in trade.";
										$error=1;
									}
									switch($item['tipo'])
									{
										case 'W':
											if(!checkExist("W"))
											{
												if($item['hand']==2)
												{
													if(checkExist("shield"))
													{
														$data["error"] = "Desequipa el escudo o arma secundaria!";
														$error=1;
													}
												}
											}
											else
											{
												if($mano==2 && checkExist("shield"))
												{
													$data["error"] = "Desequipa el escudo!";
													$error=1;
												}

												if($item['hand']==2)
												{
													$data["error"] = "Desequipa el arma!";
													$error=1;
												}else
												if($_SESSION['ALLOW2Hand']==0 && $mano==2)
												{
													$data["error"] = "Desequipa el arma!";
													$error=1;
												}
												else
												{
													$query = 'SELECT *
														FROM inventario inv JOIN  item i USING ( idItem )
														WHERE inv.idCuenta = '.$log->get("idCuenta").'
														AND inv.usadoPor='.$log->get("pjSelected").' AND i.tipo="W"';
													$itemsqWeapon = $db->sql_query($query);
													
													$whatmano=0;
													$manoDer=0;
													$manoIzq=0;
													if($mano==2)
														$manoDer=1;
													if($mano==1)
														$manoIzq=1;
													if($mano==1 || $mano==2)
													{	
														while($Weapon = $db->sql_fetchrow($itemsqWeapon))
														{
															if($Weapon['hand']==2)
															{
																$data["error"] = "Desequipa el arma!";
																$error=1;
															}
															if($Weapon['manoDerecha']==0 && $Weapon['manoIzquierda']==0)
															{
																$data["error"] = "Desequipa el arma!";
																$error=1;
															}
															if($Weapon['manoDerecha']==1 && $manoDer==1)
															{
																$data["error"] = "Desequipa el arma derecha!";
																$error=1;
															}

															if($Weapon['manoIzquierda']==1 && $manoIzq==1)
															{
																$data["error"] = "Desequipa el arma izquierda!";
																$error=1;
															}
														}
													}
													else
													{
														$data["error"] = "Desequipa el arma!";
														$error=1;
													}
												}	
											}
										break;
										case 'armor':
											if(checkExist("armor"))
											{
												$data["error"] = "Desequipa la armadura!";
												$error=1;
											}
										break;
										case 'foots':
											if(checkExist("foots"))
											{
												$data["error"] = "Desequipa las botas!";
												$error=1;
											}
										break;
										case 'rings':
											if(checkExist("rings"))
											{
												$data["error"] = "Desequipa el anillo";
												$error=1;
											}
										break;
										case 'shield':
											if(checkExist("shield"))
											{
												$data["error"] = "Desequipa el escudo!";
												$error=1;
											}
											else
											{
												$query = 'SELECT count(*) as CONTA
															FROM inventario inv JOIN item i USING (idItem)
															WHERE inv.usadoPor='.$log->get("pjSelected").' AND i.tipo="W" AND (i.hand = 2 OR inv.manoDerecha = 1)';
												$itemsqshield = $db->sql_query($query);
												$res = $db->sql_fetchrow($itemsqshield);
												if($res['CONTA'])
												{
													$data["error"] = "Desequipa la arma!";
													$error=1;
												}
											}
										break;
										case 'gloves':
											if(checkExist("gloves"))
											{
												$data["error"] = "Desequipa los guantes!";
												$error=1;
											}
										break;
										case 'head':
											if(checkExist("head"))
											{
												$data["error"] = "Desequipa el casco!";
												$error=1;
											}
										break;
										case 'necklace':
											if(checkExist("necklace"))
											{
												$data["error"] = "Desequipa el collar!";
												$error=1;
											}
										break;
										case 'enchant':
										
											$enchantWeapon=false;
											$enchantArmor=false;
											$parte = textIntoSql($_GET['parte']);
											
												switch($parte)
												{
													case "shield":
														$tiposr = "shield";
													break;
													case "armor":
														$tiposr = "armor";
													break;
													case "head":
														$tiposr = "head";
													break;
													case "foots":
														$tiposr = "foots";
													break;
													case "gloves":
														$tiposr = "gloves";
													break;
													case "rings":
														$tiposr = "rings";
													break;
													case "necklace":
														$tiposr = "necklace";
													break;
													default:
														$tiposr = "W";
														$data['manoDerecha']=0;
														if($mano==2)
														{
															$sqladd2 = " AND inv.manoDerecha = 1 AND inv.manoIzquierda = 0 ";
															$data['manoDerecha']=1;
														}
														if($mano==1)
															$sqladd2 = " AND inv.manoDerecha = 0 AND inv.manoIzquierda = 1 ";

													break;
												}

													

											$query = 'SELECT inv.idInventario, inv.enchant, i.grado, i.nombre, inv.trucho, inv.intradeable
													FROM inventario inv JOIN item i USING ( idItem )
													WHERE inv.idCuenta = '.$log->get("idCuenta").'
													AND inv.usadoPor='.$log->get("pjSelected").' AND i.tipo="'.$tiposr.'"'.$sqladd2;
													$itemsqshield = $db->sql_query($query);
													$res = $db->sql_fetchrow($itemsqshield);
											if($res['intradeable']==1)		
											{
												$data["error"] = "No se puede encantar un item intradeable!";	
											}
											else if($res)
												{
													
												switch($item['idItem'])
												{
													//Enchant weapon Astral
													case 691:
														if($res['grado']==12)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 120(Grade Astral)!";	
													break;
													//Enchant weapon Z
													case 442:
														if($res['grado']==11)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 100(Grade Z)!";	
													break;
													//Enchant weapon Y
													case 441:
														if($res['grado']==10)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 90 (Grade Y)!";	
													break;
													 //Enchant weapon X
													case 440:
														if($res['grado']==9)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 80 (Grade X)!";	
													break;
													//Enchant weapon S quest
													case 316:
														if($res['grado']==8)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 76 (Grade S)!";	
													break;
													//Enchant weapon S
													case 315:
														if($res['grado']==8 OR $res['grado']==9)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 76 (Grade S)!";	
													break;
													case 316:
														if($res['grado']==8 OR $res['grado']==9)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 76 (Grade S)!";	
													break;
													//Enchant weapon A
													case 297:
														if($res['grado']==7)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 61 (Grade A)!";	
													break;
													case 299:
														if($res['grado']==7)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 61 (Grade A)!";	
													break;
													//Enchant weapon B
													case 313:
														if($res['grado']==5 OR $res['grado']==6)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 52 (Grade B)!";	
													break;
													case 314:
														if($res['grado']==5 OR $res['grado']==6)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 52 (Grade B)!";	
													break;
													//Enchant weapon C
													case 312:
														if($res['grado']==3 OR $res['grado']==4)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 40 (Grade C)!";	
													break;
													case 311:
														if($res['grado']==3 OR $res['grado']==4)
															$enchantWeapon=true;
														$data["error"] = "El nivel del arma tiene que ser 40 (Grade C)!";	
													break;
													//////////////////////////////////////////////////////////////////////////////////////////
													//Enchant armor Astral
													case 690:
														if($res['grado']==12)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 120 (Grade Astral)!";	
													break;
													//Enchant armor Z
													case 445:
														if($res['grado']==11)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 100 (Grade Z)!";	
													break;
													//Enchant armor Y
													case 444:
														if($res['grado']==10)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 86 (Grade Y)!";	
													break;
													//Enchant armor X
													case 443:
														if($res['grado']==9)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 80 (Grade X)!";	
													break;
													//Enchant armor S
													case 310:
														if($res['grado']==8)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 76 (Grade S)!";	
													break;
													case 309:
														if($res['grado']==8)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 76 (Grade S)!";	
													break;
													//Enchant armor A
													case 296:
														if($res['grado']==7)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 61 (Grade A)!";	
													break;
													case 298:
														if($res['grado']==7)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 61 (Grade A)!";	
													break;
													//Enchant armor B
													case 308:
														if($res['grado']==5 OR $res['grado']==6)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 52 (Grade B)!";	
													break;
													case 307:
														if($res['grado']==5 OR $res['grado']==6)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 52 (Grade B)!";	
													break;
													//Enchant armor C
													case 306:
														if($res['grado']==3 OR $res['grado']==4)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 40 (Grade C)!";	
													break;
													case 305:
														if($res['grado']==3 OR $res['grado']==4)
															$enchantArmor=true;
														$data["error"] = "El nivel de ".$parte." tiene que ser 40 (Grade C)!";	
													break;
											
												}
											if($enchantWeapon && !$enchantArmor)
											{	
													if($item['cantidad']>0)
													{
														$data["ItemEnchant"]=1;
														$Enchanter=$res['enchant'];
														$data["ItemRisky"]=0;
															if($Enchanter<4)
															{
																	$Enchanter++;
																	$data["error"] = "Tu arma mejoro a +".$Enchanter."!";
															}
															else
															{
																$data["ItemRisky"]=1;
																$data["error"] = " asd ";
																
																
																/////////////////// sets
																if($Enchanter>=3)
																	$chance=60;
																if($Enchanter>=5)
																	$chance=50;	
																if($Enchanter>=7)
																	$chance=20;	
																if($Enchanter>=9)
																	$chance=10;	
																//////////////////
																

																$luky_shot =  mt_rand(1,100);
																if($luky_shot<$chance || $masterworkForce)
																{
																	$data["ItemSuccses"]=1;
																	$Enchanter++;
 if($Enchanter>6)
                                                                                   {
                                                                                                                                        systemLog("global",
"<div class=pjkiller><a target='_blank' href='index.php?sec=ver&pj=".$pj['nombre']."'>".$pj['nombre']."</a> encanto ".$res['nombre']." + ".$Enchanter."!</div>");
}
																	$data["EnchantCount"] = $Enchanter;
																}
																else
																{
if($Enchanter>6)
                                                                                   {
                                                                                                                                        systemLog("global",
"<div class=pjkiller><a target='_blank' href='index.php?sec=ver&pj=".$pj['nombre']."'>".$pj['nombre']."</a> FALLO ".$res['nombre']." + ".$Enchanter."!</div>");
}
																	$data["ItemSuccses"]=0;

																	$Enchanter=0;
																}
															}
														$data["updateAttr"] = true;	
														$db->sql_query("UPDATE inventario SET enchant = ".$Enchanter." WHERE idInventario = ".$res['idInventario']);		
														$db->sql_query("UPDATE inventario SET cantidad = (cantidad-1) WHERE idInventario = ".$item['idInventario']);



														$data["itemIdRe"] = $res['idInventario'];
		                                                $data["enchantCount"] = $Enchanter;
                                                       $data['newstats'] = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
										$db->sql_query("UPDATE personaje SET baseDPS = '".$data['newstats']['baseDPS']."' WHERE idPersonaje = ".$log->get("pjSelected"));
													}
													else
														$data["error"] = "No tienes mas enchants!";	
											}
											if($enchantArmor)
											{

													if($item['cantidad']>0)
													{
														$data["ItemEnchant"]=1;
														$Enchanter=$res['enchant'];
														$data["ItemRisky"]=0;
															if($Enchanter<4)
															{
																	$Enchanter++;
																	$data["error"] = "Tu item mejoro a +".$Enchanter."!";
															}
															else
															{
																$data["ItemRisky"]=1;
																$data["error"] = " asd ";
																/////////////////// sets
																if($Enchanter>=3)
																	$chance=40;
																if($Enchanter>=5)
																	$chance=30;	
																if($Enchanter>=7)
																	$chance=20;	
																if($Enchanter>=9)
																	$chance=10;	
																//////////////////
																$luky_shot =  mt_rand(1,100);
																if($luky_shot<$chance)
																{
																	$data["ItemSuccses"]=1;
																	$Enchanter++;
                                                                                                                                         if($Enchanter>6)
                                                                                   {
                                                                                                                                        systemLog("global",
"<div class=pjkiller><a target='_blank' href='index.php?sec=ver&pj=".$pj['nombre']."'>".$pj['nombre']."</a> encanto ".$res['nombre']." + ".$Enchanter."!</div>");
}
																	$data["EnchantCount"] = $Enchanter;
																}
																else
																{
                                                                                if($Enchanter>6)
                                                                                   {
                                                                                                                                        systemLog("global",
"<div class=pjkiller><a target='_blank' href='index.php?sec=ver&pj=".$pj['nombre']."'>".$pj['nombre']."</a> FALLO ".$res['nombre']." + ".$Enchanter."!</div>");
}
																	$data["ItemSuccses"]=0;
																	$Enchanter=0;
																}
															}
														$data["updateAttr"] = true;		
														$db->sql_query("UPDATE inventario SET enchant = ".$Enchanter." WHERE idInventario = ".$res['idInventario']);		
														$db->sql_query("UPDATE inventario SET cantidad = (cantidad-1) WHERE idInventario = ".$item['idInventario']);	
													        $data["itemIdRe"] = $res['idInventario'];
		                                                                                                $data["enchantCount"] = $Enchanter;
                                                                   $data['newstats'] = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
										$db->sql_query("UPDATE personaje SET baseDPS = '".$data['newstats']['baseDPS']."' WHERE idPersonaje = ".$log->get("pjSelected"));		
													}
													else
														$data["error"] = "No tienes mas enchants!";	
												}
											}
												else
													$data["error"] = "Equipa un arma para mejroarla!";
											$error=1;
										break;
										case 'stone':

											$data['manoDerecha']=0;
											if($mano==2)
											{
												$sqladd2 = " AND inv.manoDerecha = 1 AND inv.manoIzquierda = 0 ";
												$data['manoDerecha']=1;
											}
											if($mano==1)
												$sqladd2 = " AND inv.manoDerecha = 0 AND inv.manoIzquierda = 1 ";

											$query = 'SELECT inv.atributos, inv.idInventario, inv.enchant, i.grado, i.nombre, inv.trucho, inv.intradeable, i.hand
											FROM inventario inv JOIN item i USING ( idItem )
											WHERE inv.idCuenta = '.$log->get("idCuenta").' 
											AND inv.usadoPor='.$log->get("pjSelected").' AND i.tipo="W" '.$sqladd2;
											$itemsqweapon = $db->sql_query($query);
											$weapon = $db->sql_fetchrow($itemsqweapon);
											$gradoPass=true;
											

											$data["itemIdRe"] = $item['idInventario'];
		                                    $data["Cantidad"] = $item['cantidad'];

											if($item['cantidad']<=0)
											{
												$data["error"] = "No tienes mas piedras!";	
											}else
											if($weapon)
											{
												
												$cantidadDeStones=(int)$_GET['cantidadStones'];	

												if($cantidadDeStones>$item['cantidad'])
												{
													$data["error"] = "No tienes tantas piedras!";	
												}
											
												$query = 'SELECT *
												FROM item_attr 
												WHERE idInventario ='.$weapon['idInventario'].' AND
												 attrb IN ("wind","water","fire","earth","dark","holy")';

												$item_attrsq = $db->sql_query($query);
												$item_attr = $db->sql_fetchrow($item_attrsq);

												$elementLimit = ($weapon['grado']*40);
												if($weapon['hand'] == 1)
													$elementLimit = (int)$elementLimit/2;

												

												$sumerino= 10;
												$createAtributt = false;
												if(!$item_attr)
												{
													$item_attr['attrb']=$item['textoLoco'];
													$item_attr['valor']=0;
													$createAtributt=true; 	
												}
													if($item_attr['attrb']==$item['textoLoco'])
													{

														
														//LIMITS
														if($item_attr['valor']<$elementLimit)
														{
															$stoneSpend=0;
															$stoneSumatoria=0;
															for($i=0;$i<$cantidadDeStones;$i++)
															{
																if($item_attr['valor']<$elementLimit)
																{
																	if(mt_rand(1,2) == 2)
																	{
																		$item_attr['valor']+=$sumerino;
																		$stoneSumatoria+=$sumerino;
																	}
																	$stoneSpend++;
																}	
															}

															if($item_attr['valor']>$elementLimit)
																$item_attr['valor']=$elementLimit;

															if($createAtributt)
															{
																$db->sql_query('INSERT INTO  item_attr(idInventario,attrb,valor) 
															VALUES("'.$weapon['idInventario'].'",
															"'.$item_attr['attrb'].'",
															"'.$item_attr['valor'].'")');
															}
															else
															{
																$db->sql_query("UPDATE item_attr SET valor=(".$item_attr['valor'].") WHERE idAttrb = ".$item_attr['idAttrb']);
															}
																	$data["error"] = "Se agrego +".$stoneSumatoria." de elemento ".$item['textoLoco']." a tu arma!";	
																	
															recreateItem($weapon['idInventario']);
															$data["Cantidad"]-=$stoneSpend;
															$db->sql_query("UPDATE inventario SET cantidad = (cantidad-".$stoneSpend.") WHERE idInventario = ".$item['idInventario']);

															$data["updateAttr"] = true;

														}
														else
															$data["error"] = "El arma esta al maximo de elemento(".$elementLimit.")!";
													}
													else
													{
														$data["error"] = "El arma tiene que ser del mismo elemento.";	
													}
												
												
											}
											else
												$data["error"] = "No weapon.";
											$error=1;
										break;

										case 'buff':
											if($item['cantidad']>0)
											{
												switch($item['idItem'])
												{
													case 636:
															insertBuff($pj['idPersonaje'],561,411,600);
															$data["error"] = "Sientes los efectos del ".$item['Nombre']."!";
															$db->sql_query("UPDATE inventario SET
																				cantidad = (cantidad-1)
																				WHERE idInventario = ".$item['idInventario']." AND idCuenta = ".$log->get("idCuenta")."");												break;
													default:
														$data["error"] = "No se puede usar!";
													break;
												}
											}
											else
												$data["error"] = "No te quedan mas buffs!";	
											$error=1;
									break;
									case 'card':
										if($item['cantidad']>=$item['cantReq'])
										{
											$customMsg=true;
											$data['noBorrarItem']=1;
											$data["someMsg"]=1;
											$data['cardLeft']=$item['cantidad'];
											switch($item['idItem'])
											{
												case 703: //Hasta la vista
													$query = 'SELECT inv.idInventario, inv.enchant, i.grado, i.nombre, inv.trucho, inv.intradeable
													FROM inventario inv JOIN item i USING ( idItem )
													WHERE inv.idCuenta = '.$log->get("idCuenta").'
													AND inv.usadoPor='.$log->get("pjSelected").' AND enchant<6 AND i.tipo="W" limit 0,1';
													$itemsqshield = $db->sql_query($query);
													$res = $db->sql_fetchrow($itemsqshield);
													if($res)
													{
														$db->sql_query("UPDATE inventario SET enchant = 6 WHERE idInventario = ".$res['idInventario']);
														$data["msg"] = $res['nombre']." se encanto a +6 ";

														$db->sql_query("UPDATE inventario SET
																				cantidad = (cantidad-".$item['cantReq'].")
																				WHERE idInventario = ".$item['idInventario']." AND idCuenta = ".$log->get("idCuenta")."");	
														$data['cardLeft']-=$item['cantReq'];			
													}
													else
													{
														$data["msg"] = "No se encontro el arma!";
													}
												break;
												case 704: // houston
													include("../system/legendary.php");
													$query = 'SELECT * FROM item WHERE grado = 11 AND tipo != "enchant" ORDER BY RAND() limit 0,1';
													$itemsqshield = $db->sql_query($query);
													$res = $db->sql_fetchrow($itemsqshield);
													createLegendary($res['idItem'],0,0,0,4);

													$db->sql_query("UPDATE inventario SET
																				cantidad = (cantidad-".$item['cantReq'].")
																				WHERE idInventario = ".$item['idInventario']." AND idCuenta = ".$log->get("idCuenta")."");

													$data["msg"] = "Conseguiste ".$res['Nombre']." Legendario!";
													$data['cardLeft']-=$item['cantReq'];	
												break;
												case 705: //no lo se
													include("../system/legendary.php");
													$query = 'SELECT * FROM item WHERE grado = 7 AND tipo = "W" ORDER BY RAND() limit 0,1';
													$itemsqshield = $db->sql_query($query);
													$res = $db->sql_fetchrow($itemsqshield);
													createLegendary($res['idItem'],0,0,0,4,0,0,0,1);

													$db->sql_query("UPDATE inventario SET
																				cantidad = (cantidad-".$item['cantReq'].")
																				WHERE idInventario = ".$item['idInventario']." AND idCuenta = ".$log->get("idCuenta")."");

													$data["msg"] = "Conseguiste ".$res['Nombre']." Obra Maestra!";
													$data['cardLeft']-=$item['cantReq'];	
												break;
												case 701: //bobo
													add_item(654,1);

													$db->sql_query("UPDATE inventario SET
																				cantidad = (cantidad-".$item['cantReq'].")
																				WHERE idInventario = ".$item['idInventario']." AND idCuenta = ".$log->get("idCuenta")."");

													$data["msg"] = "Conseguiste un Lost Gark Head!";
													$data['cardLeft']-=$item['cantReq'];
												break;
												case 702: //elemental
													$query = 'SELECT inv.idNombre, inv.idApellido, inv.idInventario, inv.enchant, i.grado, i.nombre, inv.trucho, inv.intradeable
													FROM inventario inv JOIN item i USING ( idItem )
													WHERE inv.idCuenta = '.$log->get("idCuenta").'
													AND inv.usadoPor='.$log->get("pjSelected").' AND inv.conNombre = 0 AND i.tipo="W" limit 0,1';
													$itemsqshield = $db->sql_query($query);
													$res = $db->sql_fetchrow($itemsqshield);
													if($res)
													{
														$query = 'SELECT  nombre
														FROM jnombre
														WHERE idNombre = '.$res['idNombre'];
														$wnamesq = $db->sql_query($query);
														$wname = $db->sql_fetchrow($wnamesq);
														
														$query = 'SELECT  apellido
														FROM japellido
														WHERE idApellido = '.$res['idApellido'];
														$wlasNamesq = $db->sql_query($query);
														$wlasName = $db->sql_fetchrow($wlasNamesq);
														$fullName = $wname['nombre'].' '.$wlasName['apellido'];

											$db->sql_query('UPDATE inventario SET nameCheck="'.$fullName.'", conNombre = 1 
												WHERE idInventario = '.$res['idInventario']);
														
													

													$data["msg"] = "El nombre de tu arma es ".$fullName."!";

														$db->sql_query("UPDATE inventario SET
																				cantidad = (cantidad-".$item['cantReq'].")
																				WHERE idInventario = ".$item['idInventario']." AND idCuenta = ".$log->get("idCuenta")."");	
														$data['cardLeft']-=$item['cantReq'];			
													}
													else
													{
														$data["msg"] = "No se encontro el arma!";
													}
												break;
												case 700: //atras
													include("../system/legendary.php");
													createLegendary(626,0,0,0,4,0,0,0,1);
													$data["msg"] = "Conseguiste Collar Solador Obra Maestra!";
													$db->sql_query("UPDATE inventario SET
																				cantidad = (cantidad-".$item['cantReq'].")
																				WHERE idInventario = ".$item['idInventario']." AND idCuenta = ".$log->get("idCuenta")."");
													$data['cardLeft']-=$item['cantReq'];
												break;
												case 706:
													insertBuff($pj['idPersonaje'],605,449,1200);
													$data["msg"] = "Ahora tienes el Buff del Support!";

													$db->sql_query("UPDATE inventario SET
																				cantidad = (cantidad-".$item['cantReq'].")
																				WHERE idInventario = ".$item['idInventario']." AND idCuenta = ".$log->get("idCuenta")."");	
														$data['cardLeft']-=$item['cantReq'];	
												break;
												case 707:
													include("../system/legendary.php");
													$query = 'SELECT * FROM item WHERE grado = 12 AND tipo != "enchant" ORDER BY RAND() limit 0,1';
													$itemsqshield = $db->sql_query($query);
													$res = $db->sql_fetchrow($itemsqshield);
													createLegendary($res['idItem'],0,0,0,1);

													$db->sql_query("UPDATE inventario SET
																				cantidad = (cantidad-".$item['cantReq'].")
																				WHERE idInventario = ".$item['idInventario']." AND idCuenta = ".$log->get("idCuenta")."");

													$data["msg"] = "Conseguiste ".$res['Nombre']."!";
													$data['cardLeft']-=$item['cantReq'];	
												break;

											}
											
										}
										else
										{
											$data["error"] = "No tienes la cantidad requerida!";
											$error=1;
										}
									break;
										case 'material':
											switch($item['idItem'])
											{
												case 654:
												$customMsg=true;
												if($item['cantidad']>0)
												{
														insertBuff($pj['idPersonaje'],604,448,7200);
														$data["msg"] = "Ahora estas en el mundo Astral!";
														$data["someMsg"]=1;
														$error=0;		
														delete_item($item['idInventario']);
												}
												else
												{
													$data["msg"] = "No tienes suficientes Lost Gark Heads!";
													$data["someMsg"]=1;
												}
												break;
												case 672:
													if($pj['SubClassFrom']>0)
													{

													$db->sql_query("UPDATE logros SET
																				NPCaura = 1
														WHERE idPersonaje = ".$pj['SubClassFrom']);
													}
													else
													{
														$db->sql_query("UPDATE logros SET
																				NPCaura = 1
														WHERE idPersonaje = ".$log->get("pjSelected"));
													}
													$db->sql_query("DELETE FROM inventario WHERE idInventario = ".$item['idInventario']);

													$data["msg"] = "Recuperaste el Collar de Aura ahora goza sus beneficios!";
													$data["someMsg"]=1;
													$error=0;					
												break;
												default:
													$data["error"] = "No se puede usar!";
													$error=1;
												break;
											}
											
										break;
										default:
											$data["error"] = "No se puede usar!";
												$error=1;
										break;
									}
									if($data["updateAttr"])
									{
										$data['newstats'] = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
									}
									if($customMsg)
									{
										///nada
										$data["error"] = 0;
									}else
									if($error==0)
									{
										// chekeando pasivos
										
										if($item['tipo']=="armor")
											$armor = $item['subtipo'];
										if($item['tipo']=="W")
											$Wtipo = $item['subtipo'];
										if($item['tipo']=="shield")
											$shield = 1;
										
										$query = 'SELECT s.*, sl.idskilllearn
										FROM skill s JOIN skilllearn sl  USING ( idSkill )
										WHERE s.active = 0 AND sl.idPersonaje = '.$log->get("pjSelected").'
										ORDER BY sl.nivel DESC';
										$skillsq = $db->sql_query($query);
										$newskills=0;
										while($skill = $db->sql_fetchrow($skillsq))
										{
											$aurpass=false;
											switch($skill['requiere_tipo'])
											{
												case 'armor':
													if($armor==$skill['requiere'])
														$aurpass=true;
												break;
												case 'W':
												if(strlen($skill['requiere'])>1 AND strpos('asd,'.$skill['requiere'].',asd', $Wtipo))
														$aurpass=true;
												break;
												case 'shield':
													if($shield==1)
														$aurpass=true;
												break;
											}
											if($aurpass AND !$quemado[$skill['idRealSkill']])
											{
												$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$skill['idRealSkill']."' AND idPersonaje = '".$log->get("pjSelected")."' ");
												$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal) 
															VALUES("'.$log->get("pjSelected").'","'.$skill['idSkill'].'","1",'.$skill['idRealSkill'].')');
												$quemado[$skill['idRealSkill']]=true;
												
												
												$data['aura'][] = array("idSkill"=>$skill['idRealSkill'],"lvl"=>$skill['nivel'],"static"=>1);
												$data['auraCheck']=true;
											}
											
										}
										
										if($item['idSkillReal']>0)
										{
											$db->sql_query("DELETE FROM aura WHERE idSkillReal = '".$item['idSkillReal']."' AND idPersonaje = '".$log->get("pjSelected")."' ");
											$db->sql_query('INSERT INTO  aura(idPersonaje,idSkill,static,idSkillReal) 
														VALUES("'.$log->get("pjSelected").'","'.$item['idSkill'].'","1",'.$item['idSkillReal'].')');
											
											$data['aura'][] = array("idSkill"=>$item['idSkillReal'],"lvl"=>1,"static"=>1);
											$data['auraCheck']=true;
										}
										$data["manoIzquierda"] = $manoIzquierda;
										$data["manoDerecha"] = $manoDerecha;
										//
										///// SKILL ITEM
										if($item['newSkill']>0)
										{
											$db->sql_query("DELETE FROM skilllearn WHERE idRealSkill = '".$item['newSkill']."' AND idPersonaje = '".$log->get("pjSelected")."' ");
											
											$db->sql_query('INSERT INTO  skilllearn(idPersonaje,idSkill,nivel,idRealSkill,noRecet) 
														VALUES("'.$log->get("pjSelected").'","'.$item['newSkillId'].'","1",'.$item['newSkill'].',1)');
										}
										
										//////////// ARMA NOMBRES
										if($item['grado']>=3 AND $item['idNombre'] == 0)
										{
											$query = 'SELECT * 
											FROM jnombre ORDER BY RAND() LIMIT 0,1';
											$wnamesq = $db->sql_query($query);
											$wname = $db->sql_fetchrow($wnamesq);
											
											$query = 'SELECT  *
											FROM japellido ORDER BY RAND() LIMIT 0,1';
											$wlasNamesq = $db->sql_query($query);
											$wlasName = $db->sql_fetchrow($wlasNamesq);
											$allname = $wname['nombre']." ".$wlasName['apellido'];
											$slotsName = strlen($allname);
											$rampName="";
											for($i=0;$i<$slotsName;$i++)
												$rampName.="_";
											$db->sql_query("UPDATE inventario SET
														idNombre = ".$wname['idNombre'].",
														idApellido = ".$wlasName['idApellido'].",
														nameCheck = '".$rampName."'
														WHERE idInventario = ".$item['idInventario']);
											
										}
										$manoDerecha=0;
										$manoIzquierda=0;
										if($mano==2)
											$manoDerecha=1;
										if($mano==1)
											$manoIzquierda=1;
										
										$data['manoDerecha']=$manoDerecha;

										$db->sql_query("UPDATE inventario SET
											usadoPor = ".$log->get("pjSelected").",
											manoIzquierda = ".$manoIzquierda.",
											manoDerecha = ".$manoDerecha."
											WHERE idInventario = ".$item['idInventario']);
										$data["error"] = 0;
										unset($_SESSION['PJITEM']);
										$data['newstats'] = checkStats($pj['STR'],$pj['CON'],$pj['DEX'],$pj['WIT'],$pj['INTEL'],$pj['MEN'],$pj['nivel'],$pj['idPersonaje']);
										$db->sql_query("UPDATE personaje SET
											baseDPS = '".$data['newstats']['baseDPS']."'
											WHERE idPersonaje = ".$log->get("pjSelected"));
										
									///////////////////////////////////////////////////////////////////////////////////////	
									}
								}
							else
								$data["error"] = "No tienes la clase requerida.";
						else
                            $data["error"] = "No tienes suficiente nivel.";
                            
?>