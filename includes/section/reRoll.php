<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if($logros['arabia']>=3)
{
function infoAttrb($itemId,$grade,$type,$clase,$value,$astralLvl,$forceStats,$masterWork)
{
	global $tipoRoll;
	if($astralLvl>0 OR $forceStats>0)
	{
		$value+=3;
	}
	switch($grade)
	 {
		 case 12:
		 	$skilltopPer=40;
			$elemtopPer=40;
			
			$maxSkill3 = 8;
			$maxSkill5 = 50;
		 	$maxSkill1 = 60;
			$maxSkill2 = 85;
			$maxSkill4 = 750;
		 break;
		 case 11:
		 	$skilltopPer=30;
			$elemtopPer=30;
			
			$maxSkill3 = 16;
			$maxSkill5 = 40;
		 	$maxSkill1 = 50;
			$maxSkill2 = 75;
			$maxSkill4 = 650;
		 break;
		 case 10:
		 	$skilltopPer=25;
			$elemtopPer=25;
			
			$maxSkill3 = 12;
			$maxSkill5 = 30;
		 	$maxSkill1 = 40;
			$maxSkill2 = 65;
			$maxSkill4 = 550;
		 break;
		  case 9:
			$skilltopPer=23;
			$elemtopPer=23;
			
			$maxSkill3 = 10;
			$maxSkill5 = 25;
		 	$maxSkill1 = 35;
			$maxSkill2 = 60;
			$maxSkill4 = 500;
		 break;
		  case 8:
		 	$skilltopPer=20;
			$elemtopPer=20;
			
			$maxSkill3 = 8;
			$maxSkill5 = 20;
		 	$maxSkill1 = 30;
			$maxSkill2 = 55;
			$maxSkill4 = 450;
		 break;
		 case 7:
		 	$skilltopPer=15;
			$elemtopPer=15;
			
			$maxSkill3 = 5;
			$maxSkill5 = 15;
		 	$maxSkill1 = 25;
			$maxSkill2 = 50;
			$maxSkill4 = 350;
		 break;
		 case 1:
		 	$skilltopPer=5;
			$elemtopPer=5;
			
			$maxSkill3 = 2;
			$maxSkill5 = 5;
		 	$maxSkill1 = 10;
			$maxSkill2 = 25;
			$maxSkill4 = 150;
		 break;
		 case 2:
		 	$skilltopPer=5;
			$elemtopPer=5;
			
			$maxSkill3 = 2;
			$maxSkill5 = 5;
		 	$maxSkill1 = 10;
			$maxSkill2 = 25;
			$maxSkill4 = 150;
		 break;
		 case 3:
		 	$skilltopPer=6;
			$elemtopPer=6;
			
			$maxSkill3 = 3;
			$maxSkill5 = 6;
		 	$maxSkill1 = 12;
			$maxSkill2 = 30;
			$maxSkill4 = 175;
		 break;
		 case 4:
		 	$skilltopPer=7;
			$elemtopPer=7;
			
			$maxSkill3 = 3;
			$maxSkill5 = 7;
		 	$maxSkill1 = 11;
			$maxSkill2 = 30;
			$maxSkill4 = 200;
		 break;
		 case 5:
		 	$skilltopPer=8;
			$elemtopPer=8;
			
			$maxSkill3 = 4;
			$maxSkill5 = 8;
		 	$maxSkill1 = 12;
			$maxSkill2 = 35;
			$maxSkill4 = 250;
		 break;
		 case 6:
		 	$skilltopPer=10;
			$elemtopPer=10;
			
			$maxSkill3 = 4;
			$maxSkill5 = 13;
		 	$maxSkill1 = 20;
			$maxSkill2 = 40;
			$maxSkill4 = 300;
		 break;
	 }
	$acumulate=0;
	$leyenda="";
	
			$skilltopPer=$skilltopPer*$value;
			$elemtopPer=$elemtopPer*$value;
			$maxSkill3 = $maxSkill3*$value;
			$maxSkill5 = $maxSkill5*$value;
		 	$maxSkill1 = $maxSkill1*$value;
			$maxSkill2 = $maxSkill2*$value;
			$maxSkill4 = $maxSkill4*$value;
	
	// VALUE
	
	
	
	if($type=="W")
	{

			$elemtopPer=$elemtopPer*3;
			$skilltopPer=$skilltopPer*2;
			if($masterwork)
				$elemtopPer=$elemtopPer*2;
	}

	$acumulate=$value;

	$attaqueFree=true;
	$attaqueMagicFree=true;
	$criticalFree=true;
	$CriticoMagicoFree=true;
	$PCFree=true;
	$DefensaFree=true;
	$PCMagicoFree=true;
	$DefensaMagicaFree=true;
	$VidaLimitFree=true;
	$ManaLimitFree=true;
	$HpRegenFree=true;
	$MpRegenFree=true;

	$data['RRcantidad']=$acumulate;
	$acumulate++;
	$leyenda .= "Nro Atributos: ".$acumulate."<br>";

		/////// ALLLLL
					if($tipoRoll!=2)
					{
						$attr="Ataque";
						if($masterWork)
							$leyenda .= $attr." (".($maxSkill1*3).") <br>";
						else	
							$leyenda .= $attr." (10/".$maxSkill1.") <br>";
					}
					if($tipoRoll!=1)
					{
						$attr="AtaqueMagico";
						if($masterWork)
							$leyenda .= $attr." (".($maxSkill1*3).") <br>";
						else	
						$leyenda .= $attr." (10/".$maxSkill1.") <br>";
					}	
					if($tipoRoll!=2)
					{
						$attr="Critico";
						if($masterWork)
							$leyenda .= $attr." (".($maxSkill3*3).") <br>";
						else	
						$leyenda .= $attr." (1/".$maxSkill3.") <br>";
					}
					if($tipoRoll!=1)
					{
						$attr="CriticoMagico";
						if($masterWork)
							$leyenda .= $attr." (".($maxSkill3*3).") <br>";
						else
						$leyenda .= $attr." (1/".$maxSkill3.") <br>";
					}
					if($tipoRoll!=2)
					{	
						$attr="PC";
						if($masterWork)
							$leyenda .= $attr." (".($maxSkill1*3).") <br>";
						else
						$leyenda .= $attr." (5/".$maxSkill1.") <br>";
					}
					if($tipoRoll!=1)
					{
						$attr="PCMagico";
						if($masterWork)
							$leyenda .= $attr." (".($maxSkill1*3).") <br>";
						else
						$leyenda .= $attr." (5/".$maxSkill1.") <br>";
					}
					$attr="Defensa";
					if($masterWork)
							$leyenda .= $attr." (".($maxSkill2*3).") <br>";
						else
							$leyenda .= $attr." (20/".$maxSkill2.") <br>";
					$attr="DefensaMagica";
					if($masterWork)
							$leyenda .= $attr." (".($maxSkill2*3).") <br>";
						else
					$leyenda .= $attr." (20/".$maxSkill2.") <br>";
					$attr="VidaLimit";
					if($masterWork)
							$leyenda .= $attr." (".($maxSkill4*3).") <br>";
						else
					$leyenda .= $attr." (100/".$maxSkill4.") <br>";
					$attr="ManaLimit";
					if($masterWork)
							$leyenda .= $attr." (".($maxSkill4*3).") <br>";
						else
					$leyenda .= $attr." (100/".$maxSkill4.") <br>";
					$attr="HpRegen";
						if($masterWork)
							$leyenda .= $attr." (".($maxSkill5*3).") <br>";
						else
						$leyenda .= $attr." (1/".$maxSkill5.") <br>";
					$attr="MpRegen";
					if($masterWork)
							$leyenda .= $attr." (".($maxSkill5*3).") <br>";
						else
					$leyenda .= $attr." (1/".$maxSkill5.") <br>";	
	$data['leyenda']=$leyenda;
	$data['maxSkill1']=$maxSkill1;
	$data['maxSkill3']=$maxSkill3;
	$data['maxSkill2']=$maxSkill2;
	$data['maxSkill4']=$maxSkill4;
	$data['maxSkill5']=$maxSkill5;
	return $data;
}
function costoRe($grado,$roll)
{
	$roll=$roll+1;
	$precioRoll = 5;
	if($grado>=6)
	{
		switch($grado)	
		{
			case 6:
				$precioRoll = 15;	
			break;
			case 7:
				$precioRoll = 25;	
			break;
			case 8:
				$precioRoll = 50;	
			break;
			case 9:
				$precioRoll = 250;	
			break;
			case 10:
				$precioRoll = 250;	
			break;
			case 11:
				$precioRoll = 250;	
			break;
			case 12:
				$precioRoll = 250;	
			break;
		}
	}
	$costo = intval((($roll/10)*$precioRoll))+$precioRoll;
	return $costo;
}
					



function NorRandAttrb($itemId,$grade,$type,$clase,$value,$astralLvl,$forceStats=0,$AtribId,$masterWork)
{
	global $db,$tipoRoll;
	$mainLuky =  mt_rand(1,5);
	if($astralLvl>0 OR $forceStats>0)
	{
		$value+=3;
	}
	include("system/tablaAtributos.php");
	if($type=="W")
	{

			$elemtopPer=$elemtopPer*3;
			$skilltopPer=$skilltopPer*2;
			if($masterwork)
				$elemtopPer=$elemtopPer*2;
	}
	$acumulate=$value;
	
	$attaqueFree=true;
	$attaqueMagicFree=true;
	$criticalFree=true;
	$CriticoMagicoFree=true;
	$PCFree=true;
	$DefensaFree=true;
	$PCMagicoFree=true;
	$DefensaMagicaFree=true;
	$VidaLimitFree=true;
	$ManaLimitFree=true;
	$HpRegenFree=true;
	$MpRegenFree=true;

$cantBeAtr=Array();
	$query = 'SELECT *
	FROM item_attr
	WHERE idInventario = '.$itemId;
	$itematrsq = $db->sql_query($query);
	$atrbList="";
	$vueltas=0;
	$leyendafin="";
	$forceElement=0;
	while($atrr = $db->sql_fetchrow($itematrsq))
	{
		if($atrr['idAttrb']!=$AtribId)
		{
			$cantBeAtr[$atrr['attrb']]=1;
			$leyendafin .= $atrr['attrb']." +".$atrr['valor']." <br>";
		}
		else
		{
			$forceElement=0;

			$leyendafin .= "{changer}";
		}

	}
$vueltas=0;
$marquer = " &#10067;";
while(0==$vueltas)
	{
		if($forceElement==1)
			$atrChance = 1;	
		else
			$atrChance = mt_rand(2,13);
		switch($atrChance)
		{
		/////// ALLLLL
			case 2: // ataque
				if($tipoRoll!=2)
				{
					if(!$cantBeAtr['Ataque'])
					{
					$vueltas++;
						$attaqueFree=false;
						$buffGiven++;
						$attr="Ataque";
						if($masterWork)
							$valor=$maxSkill1*3;
						else	
						$valor=mt_rand(10,$maxSkill1);
						$leyenda .= $attr." +".$valor.$marquer." <br>";
					}
				}
			break;
			case 3: // ataque magico
				if($tipoRoll!=1)
				{
					if(!$cantBeAtr['AtaqueMagico'])
					{
						$vueltas++;
						$attaqueMagicFree=false;
						$buffGiven++;
						$attr="AtaqueMagico";
						if($masterWork)
							$valor=$maxSkill1*3;
						else
						$valor=mt_rand(10,$maxSkill1);
						$leyenda .= $attr." +".$valor.$marquer." <br>";
					}
				}
			break;
			case 4: // critico
				if($tipoRoll!=2)
				{
					if(!$cantBeAtr['Critico'])
					{
						$vueltas++;
						$criticalFree=false;
						$buffGiven++;
						$attr="Critico";
						if($masterWork)
							$valor=$maxSkill3*3;
						else
						$valor=mt_rand(1,$maxSkill3);
						$leyenda .= $attr." +".$valor.$marquer." <br>";
					}
				}
			break;
			case 5: //critico magico
				if($tipoRoll!=1)
				{
					if(!$cantBeAtr['CriticoMagico'])
					{
						$vueltas++;
						$CriticoMagicoFree=false;
						$buffGiven++;
						$attr="CriticoMagico";
						if($masterWork)
							$valor=$maxSkill3*3;
						else
						$valor=mt_rand(1,$maxSkill3);
						$leyenda .= $attr." +".$valor.$marquer." <br>";
					}
				}
			break;
			case 6: // PC
				if($tipoRoll!=2)
				{
					if(!$cantBeAtr['PC'])
					{
						$vueltas++;
						$PCFree=false;
						$buffGiven++;
						$attr="PC";
						if($masterWork)
							$valor=$maxSkill1*3;
						else
						$valor=mt_rand(5,$maxSkill1);
						$leyenda .= $attr." +".$valor.$marquer." <br>";
					}
				}
			break;
			case 7: // PC MAGICO
				if($tipoRoll!=1)
				{
					if(!$cantBeAtr['PCMagico'])
					{
						$vueltas++;
						$PCMagicoFree=false;
						$buffGiven++;
						$attr="PCMagico";
						if($masterWork)
							$valor=$maxSkill1*3;
						else
						$valor=mt_rand(5,$maxSkill1);
						$leyenda .= $attr." +".$valor.$marquer." <br>";
					}
               	}
            break;
            case 8: // defensa
				if(!$cantBeAtr['Defensa'])
					{
						$vueltas++;
					$DefensaFree=false;
					$buffGiven++;
					$attr="Defensa";
					if($masterWork)
							$valor=$maxSkill2*3;
						else
					$valor=mt_rand(20,$maxSkill2);
					$leyenda .= $attr." +".$valor.$marquer." <br>";
				}
			break;
			case 9: // defensa magica
				if(!$cantBeAtr['DefensaMagica'])
					{
					$DefensaMagicaFree=false;
					$buffGiven++;
					$attr="DefensaMagica";
					if($masterWork)
							$valor=$maxSkill2*3;
						else
					$valor=mt_rand(20,$maxSkill2);
					$leyenda .= $attr." +".$valor.$marquer." <br>";
				}
			break;
			case 10: // vida
			if(!$cantBeAtr['VidaLimit'])
					{
						$vueltas++;
					$VidaLimitFree=false;
					$buffGiven++;
					$attr="VidaLimit";
					if($masterWork)
							$valor=$maxSkill4*3;
						else
					$valor=mt_rand(100,$maxSkill4);
					$leyenda .= $attr." +".$valor.$marquer." <br>";
				}
			break;
			case 11: // mana
			if(!$cantBeAtr['ManaLimit'])
					{
						$vueltas++;
					$ManaLimitFree=false;
					$buffGiven++;
					$attr="ManaLimit";
					if($masterWork)
							$valor=$maxSkill4*3;
						else
					$valor=mt_rand(100,$maxSkill4);
					$leyenda .= $attr." +".$valor.$marquer." <br>";
				}
			break;
			case 12: //hp reg
					if(!$cantBeAtr['HpRegen'])
					{
						$vueltas++;
					$HpRegenFree=false;
					$buffGiven++;
					$attr="HpRegen";
					if($masterWork)
							$valor=$maxSkill5*3;
						else
					$valor=mt_rand(1,$maxSkill5);
					$leyenda .= $attr." +".$valor.$marquer." <br>";
				}
			break; 
			case 13: //mp regen
				if(!$cantBeAtr['MpRegen'])
					{
						$vueltas++;
					$MpRegenFree=false;
					$buffGiven++;
					$attr="MpRegen";
					if($masterWork)
							$valor=$maxSkill5*3;
						else
					$valor=mt_rand(1,$maxSkill5);
					$leyenda .= $attr." +".$valor.$marquer." <br>";
				}
			break;
			}
	}	
	$db->sql_query('UPDATE item_attr SET attrb = "'.$attr.'", valor = '.$valor.' WHERE idAttrb = '.$AtribId);
	
	if($acumulate>0)
		$leyenda=recreateItem($itemId);
	return $leyenda;
}







							if(isset($_GET['que']))
							{
								$que = textIntoSql($_GET['que']);
								$tipoRoll = intval($_GET['tipo']);
								if($que == "W")
									$sqladd2 = "  ";
								if($que == "Wisq")
								{
									$que = "W";
									$sqladd2 = " AND inv.manoIzquierda = 1 ";
								}
								if($que == "Wder")
								{
									$que = "W";
									$sqladd2 = " AND inv.manoDerecha = 1 ";
								}

								$query = 'SELECT inv.corrupted, inv.RollId, i.forceStats, i.nombre, i.imagen, i.subtipo, i.grado, inv.ReRoll, inv.idInventario, i.tipo,inv.value, inv.atributos, inv.masterWork
									FROM inventario inv JOIN  item i USING ( idItem )
									WHERE inv.usadoPor = '.$log->get("pjSelected").' AND tipo = "'.$que.'" AND inv.trucho=0 '.$sqladd2 ;
									$dropsq = $db->sql_query($query);
									$item = $db->sql_fetchrow($dropsq);
								if($item)
								{
										$template->set_filenames(array(
										'content' => 'templates/sec/reRollItem.html' )
									);
									
										$costo = costoRe($item['grado'],$item['ReRoll']);
									
									if(isset($_POST['ReRoll']))
									{
										if($item['RollId']>0)
										$idChanger = $item['RollId'];
											else
										$idChanger = intval($_POST['IdRoll']);

										if($idChanger>0)
										{
											if(intval($_SESSION['REROLLMADE'])<$now)
											{
												$realGold = $log->realGold();


												//Coin ASk
												$ReRollCoin = getCurrency("ReRoll");
												if($item['corrupted'])
													show_error("No se puede hacer ReRoll a un item Corrupto!","index.php?sec=ReRoll");
												else
												if($ReRollCoin['cantidad']<=0)
													show_error("Necesitas 1 ReRoll para hacer esto (los ReRoll no pueden estar en venta para realizar esta accion)!","index.php?sec=ReRoll");
												else
												if($costo<=$realGold)
												{
													$db->sql_query("UPDATE cuenta SET oro = (oro-".$costo.") WHERE idCuenta = ".$log->get("idCuenta"));
													$db->sql_query("UPDATE inventario SET 
													cantidad = (cantidad-1)
													WHERE idInventario = ".$ReRollCoin['idInventario']);
													$db->sql_query("UPDATE inventario SET ReRoll=(ReRoll+1), legendary=1, RollId = ".$idChanger." WHERE idInventario = ".$item['idInventario']);
													$item['RollId']=$idChanger;
													$item['ReRoll']++;
													$template->assign_var('SROP', "goldChange(".($realGold-$costo).");");
													include("system/legendary.php");
													$item['atributos'] = NorRandAttrb($item['idInventario'],$item['grado'],$item['tipo'],$pj['idClase'],$item['value'],$item['lvlAstral'],$item['forceStats'],$idChanger,$item['masterWork']);

													$_SESSION['REROLLMADE']=$now+3;
													unset($_SESSION['PJITEM']);

													if($logros['reroll']==4)
													{
														$boxLevel=2;
														earnDropBox($boxLevel,3,$log->get("pjSelected"));
														systemLog("self","<div class=recompensaAstral>Lograste 5 ReRolls! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
													}
													if($logros['reroll']==19)
													{
														$boxLevel=4;
														earnDropBox($boxLevel,3,$log->get("pjSelected"));
														systemLog("self","<div class=recompensaAstral>Lograste 20 ReRolls! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
													}
													if($logros['reroll']==49)
													{
														$boxLevel=5;
														earnDropBox($boxLevel,3,$log->get("pjSelected"));
														systemLog("self","<div class=recompensaAstral>Lograste 50 ReRolls! conseguiste un cofre nivel ".$boxLevel."!<br><a href='index.php?sec=recompensas'>Ir a abrirlo</a></div>") ;
													}
													
												$db->sql_query("UPDATE logros SET reroll = (reroll+1)  WHERE idPersonaje = '".$log->get("pjSelected")."'");	
												}
												else
													show_error("No tienes suficiente oro!","index.php?sec=ReRoll");
											}
											else
												show_error("La vieja no pudo terminar de castear el hechizo!","index.php?sec=ReRoll");
										}
										else
											show_error("Elije un atributo para cambiar","index.php?sec=ReRoll");
									}
																
									$costoShow = costoRe($item['grado'],$item['ReRoll']);


					$data = infoAttrb($item['idInventario'],$item['grado'],$item['tipo'],$pj['idClase'],$item['value'],0,
						$item['forceStats'],$item['masterWork']);
									$template->assign_var('POSIBILI', $data['leyenda']);
									$template->assign_var('RR_MAX1', $data['maxSkill1']);
									$template->assign_var('RR_MAX2', $data['maxSkill2']);
									$template->assign_var('RR_MAX3', $data['maxSkill3']);
									$template->assign_var('RR_MAX4', $data['maxSkill4']);
									$template->assign_var('RR_MAX5', $data['maxSkill5']);
									$template->assign_var('RRelemtopPer', $data['RRelemtopPer']);
									$template->assign_var('RRcantidad', $data['RRcantidad']);
									if(!$item['atributos'] OR $item['atributos']=="")
										$item['atributos']="Ningun Atributo";
								 $template->assign_var('ITEMIMG', $item['subtipo'].'/'. $item['imagen']);
								 $template->assign_var('ITEMNAME', $item['nombre']);


								 	$query = 'SELECT *
									FROM item_attr
									WHERE idInventario = '.$item['idInventario'].' AND NOT attrb IN ("wind","water","fire","earth","dark","holy") ' ;
									$itematrsq = $db->sql_query($query);
									$atrbList="";
									if($item['RollId']>0)
									{
										while($atrr = $db->sql_fetchrow($itematrsq))
										{
											if($item['RollId']==$atrr['idAttrb'])
											$atrbList.="<div class='rollBtn' onClick='changeAtrr(".$atrr['idAttrb'].")'>".$atrr['attrb']." +".$atrr['valor']."</div>";
											else
											$atrbList.="<div>".$atrr['attrb']." +".$atrr['valor']."</div>";	
										}
									}
									else
									{
										while($atrr = $db->sql_fetchrow($itematrsq))
										{
		$atrbList.="<div class='rollBtn' onClick='changeAtrr(".$atrr['idAttrb'].")'>".$atrr['attrb']." +".$atrr['valor']."</div>";
										}
									}
								$template->assign_var('ITEMATR', $atrbList);

									$template->assign_var('ITEMCOST', $costoShow);	
								}
								else
									show_error("No existe el item!","index.php?sec=ReRoll");
							}
							else
							{

								if($stats['CantidadArmas']==2)
									$template->assign_var('ARMAS', '<option value="Wisq">Arma Izquierda</option>
										<option value="Wder">Arma Derecha</option>');
								else
									$template->assign_var('ARMAS', '<option value="W">Arma</option>');
								


								$template->set_filenames(array(
										'content' => 'templates/sec/reRoll.html' )
									);
							}
						}
						else
						{
							show_error("No tienes acceso a esta sección ","index.php");

						}
?> 