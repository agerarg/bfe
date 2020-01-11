<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$today = date("z");
	
	/*if(isset($_POST['surrender']))
	{
		if(!$pj['inTorneo'])
		{
			$query = 'SELECT idPlayer1, idPlayer2, id
				FROM ranked_match WHERE winner=0 AND (idPlayer1 = '.$log->get("pjSelected").' OR idPlayer2 = '.$log->get("pjSelected").') ';
		$RMsq = $db->sql_query($query);
		$RM = $db->sql_fetchrow($RMsq);
		if($RM['idPlayer1']==$log->get("pjSelected"))	
			$enemyId = $RM['idPlayer2'];
		else
			$enemyId = $RM['idPlayer1'];
			
			$query = 'SELECT p.mmr, p.idPersonaje, p.nombre
				FROM personaje p WHERE p.idPersonaje = '.$enemyId.' ';
		$checkkk = $db->sql_query($query);
		$check = $db->sql_fetchrow($checkkk);
			if($check)
			{
						$mmrGain=30;
						if($myMmr>=$check['mmr'])
						{
							$result = $myMmr-$check['mmr'];
							$result = ($mmrGain-$result);
						}
						else
						{
							$result = $check['mmr']-$myMmr;
							if($result>$mmrGain)
								$result=30;
						}
						if($result<=0)
								$result=1;
						systemLog("global","<div class=pjkiller><a target='_blank' href='index.php?sec=ver&pj=".$pj['nombre']."'>".$pj['nombre']."</a> se rindio en ranked <a target='_blank' href='index.php?sec=ver&pj=".$check['nombre']."'>".$check['nombre']."</a> gano ".$result." puntos!</div>");
						
						$db->sql_query("UPDATE personaje SET rankedPlaing = 0, ranked = 0, mmr = (mmr-".$result.") WHERE idPersonaje = '".$log->get("pjSelected")."'");
						$db->sql_query("UPDATE personaje SET rankedPlaing = 0, ranked = 0, mmr = (mmr+".$result.") WHERE idPersonaje = ".$check['idPersonaje']);
						$db->sql_query("UPDATE ranked_match SET winner = ".$check['idPersonaje'].", puntos = ".$result." WHERE id = ".$RM['id']);	
						header("Location: index.php");
				die();			
			}
		}
	}*/

	$template->assign_var('MUNDO',122);
														$template->set_filenames(array(
													'content' => 'templates/sec/inmundRanked.html' )
												);
												
//AUTOTARGET
										if(isset($_GET['target']))
											$template->assign_var('AUTOTARGET',"attack(".$_GET['target'].",false,1); MaloId=".$_GET['target'].";");	
												
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
												sl.idPersonaje = '.$log->get("pjSelected").' AND s.active = 1 AND 
												s.idRealSkill != 211 AND s.idRealSkill != 210 AND s.idRealSkill != 209 AND s.idRealSkill != 208 AND s.idRealSkill != 207 AND s.idRealSkill != 206  AND s.idRealSkill !=204
												ORDER BY s.nivel DESC';
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
												
													$template->assign_var('VIDAPOTIONS', 0);	
												//////////////////////////////////////////////////////////////////////////
													$template->assign_var('MANAPOTIONS', 0);			
												
	
									

						
?> 