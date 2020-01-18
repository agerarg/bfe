<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$today = date("z");
if($pj['descanso']==0)
{
	if($pj['inDungeon']==1)
		$_GET['mundo']=1;
		
	if(isset($_GET['mundo']))
							{
								$mundoid = intval($_GET['mundo']);
								if($pj['inDungeon']==1)
								{
                                    if($pj['inRunz'])
									{
                                    $query = 'SELECT d.nombre, d.onlyTarget FROM 
									dungeon_instance di JOIN dungeon d USING ( idDungeon )
									 WHERE di.clan='.$pj['clan'].'';
									}
									else
									{
										$query = 'SELECT * FROM 
										dungeon_instance
										WHERE idPersonaje='.$pj['idPersonaje'].' OR (idParty = 1 AND idPersonaje = '.$pj['party'].' AND '.$pj['party'].'>0)';
									}	
										$dungeonsq = $db->sql_query($query);
										$dungeon = $db->sql_fetchrow($dungeonsq);
										$query = 'SELECT * FROM mundo WHERE id=1';
										$mundosq = $db->sql_query($query);
										$mundo = $db->sql_fetchrow($mundosq);
										$mundo['nombre'] = "Dungeon";
										$mundo['tipo'] = "dungeon";
								}
								else
								{
									$sqlAllow="";
									if(is_array($mapAllow))
									{
										$i=0;
										$sqlAllow.="(m.id = 20 ";
										while($mapAllow[$i])
										{
											$sqlAllow.=" OR m.id = ".$mapAllow[$i];
											$i++;
										}
										$sqlAllow.=")";
									}
									else
									$sqlAllow="m.id = 20 ";

									$query = 'SELECT * FROM mundo m 
									WHERE '.$sqlAllow.' AND m.activo=1 AND m.id='.$mundoid.'';
									$mundosq = $db->sql_query($query);
									$mundo = $db->sql_fetchrow($mundosq);
								}
								$currGold = $log->realGold();
								$template->assign_var('MUNDO', $mundo['id']);
								if($mundo)
								{
									$goFight=1;
										switch($mundo['tipo'])
										{
											case "astral":
											include('includes/section/mundo/astral.php');
											break;
											case "paragon":
											include('includes/section/mundo/paragon.php');
											break;
											case "portal":
											include('includes/section/mundo/portal.php');
											break;
											case "arena":
												include('includes/section/mundo/arena.php');
											break;
											case "raid":
												include('includes/section/mundo/raid.php');
											break;
											case "fist":
												include('includes/section/mundo/conquest.php');
											break;
											case "reto":
												include('includes/section/mundo/reto.php');
											break;
											case "cata":
												include('includes/section/mundo/cata.php');
											break;
											case "banco":
												include('includes/section/mundo/banco.php');
											break;
											case "warzone":
											include('includes/section/mundo/warzone.php');
										break;
										case "epico":
										include('includes/section/mundo/epico.php');
									break;
									
											case "free":
											if($mundo['nivel']>$pj['nivel'])
											{
													$goFight=false;
													show_error("No tienes el nivel adecuado para este castillo <br>Niveles: de ".$mundo['nivel']." a ".($mundo['nivel']+20)." ","index.php?sec=mundo");
											
											}else
												include('includes/section/mundo/free.php');
											break;
										}

									if($mundo['special'])
									{
										if($pj['clan']==0)
											show_error("Necesitas clan para entrar a este mundo!","index.php?sec=mundo");

										$outLvl=0;
										switch($mundo['id'])
										{
											case 125:
												if($pj['nivel']>=51)
													$outLvl=1;
												$sealG="C";
											break;
											case 126:
												if($pj['nivel']>=61)
													$outLvl=1;
												$sealG="B";
											break;
											case 127:
												if($pj['nivel']>=76)
													$outLvl=1;
												$sealG="A";
											break;
											case 128:
												if($pj['nivel']>=86)
													$outLvl=1;
												$sealG="S";
											break;
											case 129:
												$sealG="X";
											break;
												case 132:
												$sealG="X";
											break;
										}

										if($outLvl==1)
										{
											show_error("Tu nivel es muy alto, este lugar es solo para categorias ".$sealG,"index.php?sec=mundo");
										}
									}

									if($mundo['dimencion']!=$stats['dimension'])
									{
											show_error("Este mundo es de otra dimencion!","index.php?sec=mundo");
									}else
									if($goFight)
									{
										$template->assign_var('MUNDO', $mundo['id']);
										
										//AUTOTARGET
										if(isset($_GET['target']))
										{
											if(!isset($_GET['bicho']))
											{
                                                                                             $id=intval($_GET['target']);
												$query = 'SELECT idInMundo
												FROM inmundo WHERE mundo = '.$mundo['id'].' AND idPlayer = '.$id.' AND tipo = 1';
											$checkkk = $db->sql_query($query);
											$check = $db->sql_fetchrow($checkkk);
											if($check)
													$template->assign_var('AUTOTARGET',"attack(".$check['idInMundo'].",false,1); MaloId=".$id.";");	
											}
											else
											{
												if($_GET['multy']==1)
												{
													$template->assign_var('AUTOTARGET',"
													objetive[0]='".$_GET['id']."';
													objetive[1]='".$_GET['id2']."';
													objetive[2]='".$_GET['id3']."';
													objetive[3]='".$_GET['id4']."';
													objetive[4]='".$_GET['id5']."';
													attack2(); MaloId=0;");	
												}
												else
													$template->assign_var('AUTOTARGET',"
													attack(".$_GET['target'].",false,2); MaloId=0;");	
											}
										}
										//en el mudno
												$query = 'SELECT *
												  FROM inmundo
												  WHERE idPlayer = "'.$log->get("pjSelected").'" AND tipo = 1 AND mundo = '.$mundo['id'].'';
											$srch_logged_player = $db->sql_query($query);
											$logged_player = $db->sql_fetchrow($srch_logged_player);
											$blockEntry = true;
											if($pj['LOCID']!=$mundo['id'])
											{	
												
													$cleanbrlocation = explode("<br>",$mundo['nombre']);
													$template->assign_var('USR_LOCATION', $cleanbrlocation[0]);
													$db->sql_query("UPDATE personaje SET location = ".$mundo['id']."
													WHERE idPersonaje = ".$log->get("pjSelected"));
															
													if(!$logged_player)		
														$db->sql_query('INSERT INTO inmundo (mundo,tipo,idPlayer,sesion_time) 
														VALUES("'.$mundo['id'].'","1","'.$log->get("pjSelected").'","'.intval($now + 300).'")');
													else
														$db->sql_query("UPDATE inmundo SET sesion_time = '".intval($now + 300)."', 
														mundo = '".$mundo['id']."'
														WHERE idPlayer = '".$log->get("pjSelected")."' AND tipo = '1' AND mundo = ".$mundo['id']."");
												
											}
											else
											{
												if(!$logged_player)		
													$db->sql_query('INSERT INTO inmundo (mundo,tipo,idPlayer,sesion_time) 
													VALUES("'.$mundo['id'].'","1","'.$log->get("pjSelected").'","'.intval($now + 300).'")');
												else
													$db->sql_query("UPDATE inmundo SET sesion_time = '".intval($now + 300)."', 
													mundo = '".$mundo['id']."'
													WHERE idPlayer = '".$log->get("pjSelected")."' AND tipo = '1' AND mundo = ".$mundo['id']."");
											
											}
											if($blockEntry)
											{
												switch($mundo['tipo'])
												{
													case "raid":
														$template->assign_var('TIMELIMIT', $mundo['warTime']-$now);
														$template->set_filenames(array(
														'content' => 'templates/sec/inmundoRaid.html' )
													);

													break;
													case "free":
														
														$template->assign_var('TIMELIMIT', $mundo['warTime']-$now);
														
														
														$template->set_filenames(array(
														'content' => 'templates/sec/inmundoFree.html' )
													);
													
													
													break;
													case 'dungeon':
														$template->assign_var('MUNDONAME', "Dungeon (".$dungeon['waveCurr']."/".$dungeon['waves'].")");
													
														$template->set_filenames(array(
													'content' => 'templates/sec/inmundoDungeon.html' ));
													break;
													case 'warzone':
														if($mundo['clan']>0)
														{
															$query = 'SELECT nombre
															FROM clan
															WHERE idClan = '.$mundo['clan'];
															$clanownsq = $db->sql_query($query);
															$clanown = $db->sql_fetchrow($clanownsq);
															$clanAd="<br>Tomado por ".$clanown['nombre'];
														}	
														$template->assign_var('MUNDONAME', "Zona de Guerra: ".$mundo['nombre'].$clanAd);	
														$template->assign_var('TOPIMG', "warzone.jpg");
															$template->set_filenames(array(
														'content' => 'templates/sec/inmundoWarZone.html' )
													);
													break;
													case 'city':
														$template->set_filenames(array(
													'content' => 'templates/sec/inmundoCity.html' )
												);
															$template->assign_var('MUNDONAME', $mundo['nombre']);
													break;
													default:

													/// HACEMOS LAS PAPAS FRITAS!! //
													if($mundo['extraInfo']==0)
													{
														
													}
													else
													{ // FOR PARTY
														if($pj['party']==0)
														{
															show_error("Solo puedes ingresar a este mundo con party","index.php?sec=mundo");
														}
														else
														{
															
															
														}
													}
													
													////
													$template->assign_var('MUNDONAME', $mundo['nombre']);
													
													if($mundo['extraInfo']==0)
													{
														$objetive=false;
														switch($mundo['id'])
														{
															case 20:
																if($logros['arabia']<3)
																{
																	$objetive=true;
																	$objCta=(3-$logros['arabia']);
																}
															break;
															case 22:
																if($logros['shika']<3)
																{
																	$objetive=true;
																	$objCta=(3-$logros['shika']);
																}
															break;
															case 23:
																if($logros['slajim']<3)
																{
																	$objetive=true;
																	$objCta=(3-$logros['slajim']);
																}
															break;
															case 24:
																if($logros['piwik']<3)
																{
																	$objetive=true;
																	$objCta=(3-$logros['piwik']);
																}
															break;
															case 25:
																if($logros['moosh']<3)
																{
																	$objetive=true;
																	$objCta=(3-$logros['moosh']);
																}
															break;
															case 26:
																if($logros['forgottenground']<3)
																{
																	$objetive=true;
																	$objCta=(3-$logros['forgottenground']);
																}
															break;
															case 27:
															if($logros['kunkawa']<3)
															{
																$objetive=true;
																$objCta=(3-$logros['kunkawa']);
															}
															break;
															case 30:
															if($logros['glaciar1']<3)
															{
																$objetive=true;
																$objCta=(3-$logros['glaciar1']);
															}
															break;
															case 31:
															if($logros['glaciar2']<3)
															{
																$objetive=true;
																$objCta=(3-$logros['glaciar2']);
															}
															break;
															case 32:
															if($logros['lairofcabrium']<3)
															{
																$objetive=true;
																$objCta=(3-$logros['lairofcabrium']);
															}
															break;
															case 93:
															if($logros['enchantedvalley']<3)
															{
																$objetive=true;
																$objCta=(3-$logros['enchantedvalley']);
															}
															break;
															case 94:
															if($logros['doomtemple']<3)
															{
																$objetive=true;
																$objCta=(3-$logros['doomtemple']);
															}
															break;
														}
														if($objetive)
															$template->assign_var('MUNDODONE', "Objetivo: Matar ".$objCta." Papas!");
													}
													if($mundo['estructura'])
													{
														$template->assign_var('TOPIMG', $mundo['estructImg']);
															$template->set_filenames(array(
														'content' => 'templates/sec/inmundoSingle.html' )
													);
													}
													else
														$template->set_filenames(array(
													'content' => 'templates/sec/inmundo.html' )
												);
												
													break;
												}
								/// Attack Coldown FIX
								$restado = ($pj['attackCooldown']-$now);
								if($restado>0)
									$template->assign_var('SKILLTIME', "$('#listo').hide(); skilltimer(".$restado.");");			
												
											// habilidades
												function sksort(&$array, $subkey="id", $sort_ascending=false) {

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
}
												$query = 'SELECT sl.cooldownCurrent, s.*, sl.orden, sl.keybind, sl.idPersonaje, sl.idSkill
												FROM skill s JOIN skilllearn sl USING ( idSkill ) WHERE sl.disable = 0 AND
												sl.idPersonaje = '.$log->get("pjSelected").' AND s.active = 1 ORDER BY s.nivel DESC';
												$skillsq = $db->sql_query($query);
												
												$template->assign_block_vars('S', array(
															'ID' => 0,
															'NOMBRE' => "Ataque Basico [ESPACIO]|Daño basado en el ataque",
															'CD' =>  5,	
															'TAR' => 0,
															'IMG' => "basicAttack.jpg"
															));
												$norder=false;
												while($skill = $db->sql_fetchrow($skillsq))
												{

														if(!$skillburn[$skill['idRealSkill']])
														{
															$skillburn[$skill['idRealSkill']]=true;
															if($skill['cooldownCurrent']>$now)
																$template->assign_block_vars('CD', array(
																	'ID' => $skill['idSkill'],
																	'TIME' => ($skill['cooldownCurrent']-$now)
																	));
																	
																	$template->assign_block_vars('KEYBIND', array(
																	'KEY' => $skill['keybind'],
																	'CD' => $skill['cooldown'],	
																	'TAR' => $skill['toTarget'],
																	'ID' => $skill['idSkill']
																	));
															$hotkeys[$skill['idSkill']]=strtoupper(chr($skill['keybind']));	
																	
																$cadena = utf8_encode($skill['desc']);
																$cadena = @eregi_replace("/\r\n+|\r+|\n+|\t+/i",  ' ', $cadena);	
																$skill['desc']=$cadena;
																
																
																if($skill['orden']==0)
																	$saverSkill[$skill['idRealSkill']]=$skill;
																else
																	$saverSkill[$skill['orden']]=$skill;
														}

												}
												if(is_array($saverSkill))
												{
													sksort($saverSkill, "orden", true);
													foreach( $saverSkill as $skill)
													{
														$template->assign_block_vars('S', array(
																	'ID' => $skill['idSkill'],
									'NOMBRE' => $skill['nombre'].' ['.$hotkeys[$skill['idSkill']].']|'.$skill['desc'].'<br><spam class=costoMP>Costo de mana: '.$skill['costomp'].'</spam>',
																	'CD' => $skill['cooldown'],	
																	'TAR' => $skill['toTarget'],
																	'IMG' => $skill['imagen']
																	));
													}
												}
												
												
												///////////////////////////////////////////////////////////////////////////////
												$query = 'SELECT i.imagen, i.Nombre, i.textoLoco, inv.potCooldown, inv.potSlot
												FROM inventario inv JOIN item i USING ( idItem )
												WHERE inv.idCuenta = '.$log->get("idCuenta").' 
												AND inv.usadoPor = '.$log->get("pjSelected").'
												AND i.tipo = "pot"';
												$itemsq = $db->sql_query($query);
												$now = time();
												while($item = $db->sql_fetchrow($itemsq))
												{
													$template->assign_block_vars('POCIONES', array(
																	'SLOT' => $item['potSlot'],
																		'NOMBRE' => "'".$item['Nombre'].'|'.$item['textoLoco']."'",
																		'IMG' => "'".$item['imagen']."'",
																		'CD' => ($item['potCooldown'] - $now),	
																		));
											    }

	
											}
							}
								}
								else
									show_error("Este lugar no existe","index.php?sec=mundo");
									
							$template->assign_var('NEWGOLDCHANGE', $currGold);
							}
							else
							{
								
								
								
								$useragent=$_SERVER['HTTP_USER_AGENT'];


	switch($dimencion)
	{
		case 2:
		$template->set_filenames(array(
				'content' => 'templates/sec/mundo_alien.html' )
			);
		break;
		default:
			$template->set_filenames(array(
				'content' => 'templates/sec/mundo.html' )
			);
		break;
	}
		

								if($dimencion==1)
								{
									//SHOW MY CASTLE
									$query = 'SELECT m.id, m.dominated, c.nombre AS CLANNAME 
									FROM mundo m LEFT JOIN clan c ON c.idClan = m.clan
									WHERE m.tipo = "free" AND m.clan = '.$pj['clan'].' AND m.dimencion=1 AND m.clan > 0';
									$castsq = $db->sql_query($query);	
									$clanCastle = $db->sql_fetchrow($castsq);	
									if($clanCastle)
											$template->assign_var('CLANCASTLE', '<a href="#" rel="'.$clanCastle['id'].'">Castillo '.$clanCastle['CLANNAME'].'</a>');
									
									$sqlAllow="";
									if(is_array($mapAllow))
									{
										$i=0;
										$sqlAllow.="(m.id = 20 ";
										while($mapAllow[$i])
										{
											$sqlAllow.=" OR m.id = ".$mapAllow[$i];
											$i++;
										}
										$sqlAllow.=")";
									}
									else
									$sqlAllow="m.id = 20 ";
									$query = 'SELECT m.* , c.nombre AS CLANN
												FROM mundo m LEFT JOIN clan c on c.idClan = m.clan
												WHERE '.$sqlAllow.' AND m.activo=1 AND m.dimencion=1';
								
							}
								else
									$query = 'SELECT m.*
												FROM mundo m
												WHERE m.activo=1 AND dimencion='.$stats['dimension'].' ORDER BY nivel';
								$mundosq = $db->sql_query($query);
								while($mundo = $db->sql_fetchrow($mundosq))
								{
									$option = '<a href="index.php?sec=mundo&mundo='.$mundo['id'].'">Entrar</a>';
									$addname="";
									$injertoImg="";
									$mundo['SLtipo']="";
									if($mundo['tipo']=="train")
									{
										$mundo['SLtipo']="train";
										if($mundo['extraInfo']==1)
										{
											$mundo['tipo']="trainparty";
											$mundo['SLtipo']="trainparty";
										}
										if($mundo['special']==1)
											$mundo['tipo']="trainclan";
										$addname="<br>Lvl: ".$mundo['nivel'];

										$mundo['basic_tipo']="Lvl: ".$mundo['nivel']." - ".$mundo['nombre'];
									}
									
									if($mundo['tipo']=="free")
									{
										$mundo['basic_tipo']="Castillo ".$mundo['nombre'];
										if($mundo['clan']>0)
										{
											$mundo['nombre']= $mundo['nombre'].'<br>';
											$mundo['nombre'].= "Ruled by ".$mundo['CLANN'].'<br>';
										}
										$mundo['SLtipo']="castle";
										
									}
									else
										$onname ="";
									
									if($mundo['tipo']=="portal")
									{
										$mundo['tipo']="";
										$injertoImg = "background-image:url('images/".$mundo['estructImg']."')";
										$addname="<br>Lvl: ".$mundo['nivel'];
									}
									$nameBlow = $mundo['nombre'].$addname.$onname;
									if($mundo['tipo']=="city")
									{
										$injertoImg = "background-image:url('images/citypoint.png')";
										$mundo['SLtipo']="city";
										$mundo['basic_tipo']="Ciudad ".$mundo['nombre'];
									}
									if($mundo['tipo']=="raid")
									{
										$nameBlow="<br>Lvl: ".$mundo['nivel'];
										$mundo['tipo']="";
										$mundo['basic_tipo']="Lvl: ".$mundo['nivel']." Raid Boss: ".$mundo['nombre'];
										$injertoImg = " width: 46px;
										height: 46px;  background-image:url('images/raids/".$mundo['estructImg']."')";
										$mundo['SLtipo']="raid";
									}
									if($mundo['tipo']=="epico")
									{
										$nameBlow="<div class='cataMap'>".$mundo['nombre'].$addCNam."</div>";
										$mundo['tipo']="";
										$injertoImg = "	
										background-repeat:no-repeat;
										width: 74px;
										height: 53px;  background-image:url('images/retos/".$mundo['estructImg']."')";
										$mundo['SLtipo']="epico";
										$mundo['basic_tipo']="Lvl: ".$mundo['nivel']." - ".$mundo['nombre'];
									}
									if($mundo['tipo']=="warzone")
									{
										if($addCNam=$mundo['CLANN'])
											$addCNam="<br>Tomado: ".$mundo['CLANN'];
										$nameBlow="<div class='cataMap'>".$mundo['nombre'].$addCNam."</div>";
										$mundo['tipo']="";
										$injertoImg = "	
										background-repeat:no-repeat;
										width: 59px;
										height: 69px;  background-image:url('images/retos/".$mundo['estructImg']."')";
										$mundo['SLtipo']="warzone";
										$mundo['basic_tipo']="Lvl: ".$mundo['nivel']." - ".$mundo['nombre'];
									}
									if($mundo['tipo']=="fist")
									{
										$nameBlow="<div class='cataMap'>".$mundo['nombre']."</div>";
										$mundo['tipo']="";
										$injertoImg = "	
										background-repeat:no-repeat;
										width: 59px;
										height: 69px;  background-image:url('images/retos/".$mundo['estructImg']."')";
										$mundo['SLtipo']="conquista";
										$mundo['basic_tipo']="Lvl: ".$mundo['nivel']." - ".$mundo['nombre'];
									}
									if($mundo['tipo']=="banco")
									{
										$nameBlow="<div class='cataMap'>Banco Central</div>";
										$mundo['tipo']="";
										$injertoImg = "	
										background-repeat:no-repeat;
										width: 59px;
										height: 69px;  background-image:url('images/retos/".$mundo['estructImg']."')";
										$mundo['SLtipo']="banco";
										$mundo['basic_tipo']=" ".$mundo['nombre'];
									}
									if($mundo['tipo']=="paragon")
									{
										$nameBlow="<div class='cataMap' style='margin-top:30px;'>Paragon Rift</div>";
										$mundo['tipo']="";
										$injertoImg = "	
										background-repeat:no-repeat;
										width: 52px;
										height: 66px;  background-image:url('images/retos/".$mundo['estructImg']."')";
										$mundo['SLtipo']="paragon";
										$mundo['basic_tipo']=" ".$mundo['nombre'];
									}
									if($mundo['tipo']=="astral")
									{
										$nameBlow="<div class='cataMap' style='margin-top:15px;'>".$mundo['nombre']."</div>";
										$mundo['tipo']="";
										$injertoImg = "	
										background-repeat:no-repeat;
										width: 50px;
										height: 50px;  
										background-image:url('images/retos/".$mundo['estructImg']."')";
										$mundo['SLtipo']="astral";
										$mundo['basic_tipo']=" ".$mundo['nombre'];
									}
									if($mundo['tipo']=="cata")
									{
										$nameBlow="<div class='cataMap'>Catacumba: Lvl: ".$mundo['nivel']."</div>";
										$mundo['tipo']="";
										$injertoImg = "	
										background-repeat:no-repeat;
										width: 59px;
										height: 69px;  background-image:url('images/retos/".$mundo['estructImg']."')";
										$mundo['SLtipo']="catacumba";
										$mundo['basic_tipo']="Lvl: ".$mundo['nivel']." - ".$mundo['nombre'];
										
									}
									if($mundo['tipo']=="reto")
									{
										if($mundo['nivel']>=80)
										$nameBlow="<br>Lvl: ".$mundo['nivel'];
										else
										$nameBlow="<br>Lvl: ".$mundo['nivel']." - ".($mundo['nivel']+20);
										$mundo['tipo']="";
										$injertoImg = " width: 46px;
										height: 46px;  background-image:url('images/retos/".$mundo['estructImg']."')";
										$mundo['SLtipo']="reto";
										$mundo['basic_tipo']="Lvl: ".$mundo['nivel']." - ".$mundo['nombre'];
									}
									$template->assign_block_vars('LOC', array(
											'ID' => $mundo['id'],
											'SLtipo'=> $mundo['SLtipo'],
											'BASIC' => $mundo['basic_tipo'],
											'NAME' => $mundo['nombre'],
											'LVL' => $mundo['nivel'],
											'NAMEBLOW' => $nameBlow,
											'X' => $mundo['pos_x'],
											'INJERTO' => $injertoImg,
											'Y' => $mundo['pos_y'],
											'XT' => $mundo['pos_x']-55,
											'YT' => $mundo['pos_y']+35,
											'TIPO' => $mundo['tipo'],
											'OP' => $option,
											));	
								}
								$mundo['basic_tipo']="";

								
								
}
	}
	else
	{
		if($stats['durmiendo'])
			show_error("Shhh no molestes a ".$pj['nombre'].", esta durmiendo.","index.php?sec=GTFO");
		else	
			{
				$db->sql_query("UPDATE personaje SET attackCooldown=0, descanso=0, Vida=".$stats['VidaLimit'].", Mana=".$stats['ManaLimit']." WHERE idPersonaje = '".$pj['idPersonaje']."'");
				$db->sql_query("DELETE FROM chat WHERE idPersonaje = ".$pj['idPersonaje']." OR party = ".$pj['idPersonaje']."");
				header("Location: index.php?sec=mundo");
				die();
			}
	}
?> 