<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
define('SWORDON', 1);
include('../system/conexion.php');
include('../system/login.php');
include('../system/funciones.php');
session_start();
$db = new sql_db;
$log = new LOGuser;
$data['customError']=0;
if($log->check())
{
	$grado=1;
$mundoBlacksmith=intval($_GET['mundo']);

	$grado=intval($_GET['grade']);
	$id = intval($_GET['id']);
 $runz =intval($_GET['runz']) ;

                     $query = 'SELECT c.runz
				FROM personaje p LEFT JOIN clan c ON c.idClan = p.clan
			WHERE p.idCuenta = '.$log->get("idCuenta").' AND p.idPersonaje = '.$log->get("pjSelected").'';
                     $pj = $db->sql_fetchrow($db->sql_query($query));
					  
$query = 'SELECT c.*, i.nombre, i.imagen, i.subtipo, i.contable, i.forceStats
								FROM craft c JOIN item i  USING ( idItem ) 
								WHERE c.idCraft='.$id.' AND c.runz = '.$runz;
								$craftsq = $db->sql_query($query);
								$craft = $db->sql_fetchrow($craftsq);


								if($craft)
								{
	$query = 'SELECT i.idItem, i.imagen, i.subtipo, i.nombre, cm.cantidad, inv.cantidad AS IHAVE, i.contable
											FROM item i JOIN craft_mats cm  USING ( idItem ) LEFT JOIN inventario inv on inv.idItem = cm.idItem AND cm.unico = 0
											AND inv.idCuenta = '.$log->get("idCuenta").' AND inv.usadoPor = 0 AND inv.enVenta = 0
											WHERE  cm.idCraft = '.$craft['idCraft'].'';
											$dropsq = $db->sql_query($query);
											
											$passBall=1;
											$idq=0;	
											while($drop = $db->sql_fetchrow($dropsq))
											{
												if($drop['contable']==1)
												{
													$have = intval($drop['IHAVE']);
													$Eliminator[$idq]['id']=$drop['idItem'];
													$Eliminator[$idq]['cant']=$drop['cantidad'];
													$Eliminator[$idq]['cont']=1;
													
													if($drop['cantidad']>$have)
														$passBall=0;
												}
												else
												{
													if(!isset($ChekCuanty[$drop['idItem']]))
													{
														$sqlLeg="";
														if($craft['masterWork'])
															$sqlLeg=" AND value=4 ";
														$query = 'SELECT count(*) as CONTA 
																  FROM inventario WHERE idItem = '.$drop['idItem'].'
												AND idCuenta = '.$log->get("idCuenta").' '.$sqlLeg.' 
												AND  usadoPor = 0 AND enVenta = 0 AND masterWork = 0';
														$count = $db->sql_fetchrow($db->sql_query($query));
														$ChekCuanty[$drop['idItem']]=intval($count['CONTA']);
													}
													
													if($ChekCuanty[$drop['idItem']]>0)
													{
														$ChekCuanty[$drop['idItem']]--;
														$have=1;
														$Eliminator[$idq]['id']=$drop['idItem'];
														$Eliminator[$idq]['cant']=1;
														$Eliminator[$idq]['cont']=0;
													}
													else
													{
														$have=0;
														$passBall=0;
													}
													
												}
												$idq++;
											}
											$data["COSTO"]= $craft['cost'];
											
											$realGold = $log->realGold();
											$goldresult = $realGold-$craft['cost'];
											if($goldresult<0)
												$passBall=false;
											if($passBall)
											{
												foreach ($Eliminator as $delet) {
													if($delet['cont'])
														$db->sql_query("UPDATE inventario SET
																		cantidad = (cantidad-".$delet['cant'].")
																		WHERE idItem = ".$delet['id']." AND idCuenta = ".$log->get("idCuenta")."");
													else
														$db->sql_query("DELETE FROM inventario WHERE idItem = ".$delet['id']." 
														AND idCuenta = ".$log->get("idCuenta")." AND usadoPor = 0 AND masterWork = 0 LIMIT 1");
												}
												include("../system/legendary.php");
								
												$value="";
												$data['masterWork']=$craft['masterWork'];
                                                if($craft['contable']==0)
                                                {
													$chance = mt_rand(1,500);
													$LegChance = 1;
													$EpicChance = 50;
													$RareChance = 100;	
													$MagicChance = 200;	
													if($chance<=$LegChance || $craft['masterWork']==1)
													{
														$valueInt=4;
														$value="Legendario";
														$counterLegendary++;
													}else if($chance<=$EpicChance)
													{
														$valueInt=3;
														$value="Epico";
														$counterEpic++;
													}else if($chance<=$RareChance)
													{
														$valueInt=2;
														$value="Raro";
														$counterRare++;
													}else 
													{
														$value="Magic";
														$valueInt=1;
													}
													$varDropOn=1;
                                                	
					createLegendary($craft['idItem'],0,0,0,$valueInt,1,$craft['astralLvl'],$craft['forceStats'],$craft['masterWork']);
                                                }
												else
												    add_item($craft['idItem'],1);
												
												
												$data['gold']=$goldresult;
												$log->set("oro",$goldresult);
												$db->sql_query("UPDATE cuenta SET oro = (oro-".$craft['cost'].") WHERE idCuenta = ".$log->get("idCuenta"));
												
												$msg = "<div class='questNew'>Creaste un ".$craft['nombre']." ".$value."!</div>";
												$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
															VALUES("'.$log->get("pjSelected").'","'.$msg.'")');	
												$data['creado']=1;	
												

												$query = 'SELECT max(idInventario) AS ID FROM inventario WHERE idCuenta = '.$log->get("idCuenta").'';	
												$itemsq = $db->sql_query($query);
												$maxId = $db->sql_fetchrow($itemsq);
												$data['itemID']=$maxId['ID'];
												//Logros
												$query = 'SELECT *
														FROM logros WHERE idPersonaje = '.$log->get("pjSelected").'';
												$logosq = $db->sql_query($query);
												$logros = $db->sql_fetchrow($logosq);
												
												
													if($logros['craft']==2)
													{
														$boxLevel=4;
														earnDropBox($boxLevel,3,$log->get("pjSelected"));
														systemLog("self","<div class=recompensaAstral>Lograste crear 3 items! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
													}
													if($logros['craft']==9)
													{
														$boxLevel=5;
														earnDropBox($boxLevel,3,$log->get("pjSelected"));
														systemLog("self","<div class=recompensaAstral>Lograste crear 10 items! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
													}
													if($logros['craft']==19)
													{
														$boxLevel=6;
														earnDropBox($boxLevel,3,$log->get("pjSelected"));
														systemLog("self","<div class=recompensaAstral>Lograste un crear 20 items! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
													}
													
												$db->sql_query("UPDATE logros SET craft = (craft+1)  WHERE idPersonaje = '".$log->get("pjSelected")."'");	
													
												
												//$data['gold']=$realGold+$goldBonus;
											}
											else
											{
												$data['creado']=0;	
											}
								}
								else
									$data['error'] = "Error: Craft inexistente";
}
else
{
	$data['error'] = "Error: usuario no logeado";
}
 echo json_encode($data);
?> 