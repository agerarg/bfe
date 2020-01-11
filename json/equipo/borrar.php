<?php


if($item['trade']==1)
									{
										$data["error"] = "El item esta en trade.";
									}
					else
						if($item['enVenta']==1)
							$data["error"] = "El item esta en venta.";
						else if($item['trucho']==1)
							$data["error"] = "Trucho Truchooooo";
						else
							if($item['usadoPor']==0)
							{
								
								switch($item['value'])
								{
									case 4:
										if($item['tipo']=="W")
											$romperCant=25;
										else
											$romperCant=15;
									break;
									case 3:
										if($item['tipo']=="W")
											$romperCant=15;
										else
											$romperCant=8;
									break;
									case 2:
										if($item['tipo']=="W")
											$romperCant=8;
										else
											$romperCant=3;
									break;
									default:
										if($item['tipo']=="W")
											$romperCant=3;
										else
											$romperCant=1;
									break;
								}
								switch($item['grado'])
								{
								 	case 3:
									 add_item(400,$romperCant,false);
									 $msg = "Consiguio ".$romperCant." Craft C";
									systemLog("self",$msg);
									break;
									case 4:
									add_item(400,$romperCant,false);
									 $msg = "Consiguio ".$romperCant."  Craft C";
									systemLog("self",$msg);
									break;
									case 5:
									add_item(401,$romperCant,false);
									 $msg = "Consiguio ".$romperCant."  Craft B";
									systemLog("self",$msg);
									break;
									case 6:
									add_item(401,$romperCant,false);
									 $msg = "Consiguio ".$romperCant."  Craft B";
									systemLog("self",$msg);
									break;
									case 7:
									add_item(402,$romperCant,false);
									 $msg = "Consiguio ".$romperCant."  Craft A";
									systemLog("self",$msg);
									break;
									case 8:
									add_item(403,$romperCant,false);
									 $msg = "Consiguio ".$romperCant."  Craft S";
									systemLog("self",$msg);
									break;
                                    case 9:
									add_item(438,$romperCant,false);
									 $msg = "Consiguio ".$romperCant."  Craft X";
									systemLog("self",$msg);
									break;
									  case 10:
									  add_item(449,$romperCant,false);
									  $msg = "Consiguio ".$romperCant."  Craft Y";
									 systemLog("self",$msg);
									break;
									 case 11:
									 add_item(450,$romperCant,false);
									 $msg = "Consiguio ".$romperCant."  Craft Z";
									systemLog("self",$msg);
									break;
									 case 12:
									add_item(450,$romperCant,false);
									 $msg = "Consiguio ".$romperCant."  Craft Z";
									systemLog("self",$msg);
									break;
								}
								
								delete_item($item['idInventario']);
								$data["error"] = 0;

								//Logros
								$query = 'SELECT *
								FROM logros WHERE idPersonaje = '.$log->get("pjSelected").'';
								$logosq = $db->sql_query($query);
								$logros = $db->sql_fetchrow($logosq);
								
								if($item['grado']>3)
								{
									if($logros['romper']==4)
									{
										$boxLevel=4;
										earnDropBox($boxLevel,3,$log->get("pjSelected"));
										systemLog("self","<div class=recompensaAstral>Lograste romper 3 items! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
									}
									if($logros['romper']==9)
									{
										$boxLevel=5;
										earnDropBox($boxLevel,3,$log->get("pjSelected"));
										systemLog("self","<div class=recompensaAstral>Lograste romper 10 items! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
									}
									if($logros['romper']==19)
									{
										$boxLevel=6;
										earnDropBox($boxLevel,3,$log->get("pjSelected"));
										systemLog("self","<div class=recompensaAstral>Lograste un romper 20 items! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
									}
									
									$db->sql_query("UPDATE logros SET romper = (romper+1)  WHERE idPersonaje = '".$log->get("pjSelected")."'");	
								}
							}
							else
								$data["error"] = "No puedes borrar un item que estas usando.";

?>