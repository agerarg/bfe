<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
$today = date("z");
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
								$template->set_filenames(array(
										'content' => 'templates/sec/dungeon_test.html' )
									);
				$mundo = intval($_GET['mundo']);
				$query = 'SELECT matrix, nombre, id
				 FROM mundo
				WHERE id = '.$mundo.'';
				$mundosq = $db->sql_query($query);
				$mundoRow = $db->sql_fetchrow($mundosq);	
			if(!$mundoRow)
				die("No existe el mundo.");		
			$template->assign_var('MATRIX',$mundoRow['matrix']);	
			$template->assign_var('MUNDO',$mundoRow['nombre']);
			$template->assign_var('ID_MUNDO',$mundo);
			$query = 'SELECT im.vr_X, im.vr_Y, m.imagen, m.nombre, idMonster, im.idInMundo
			FROM inmundo im JOIN monster m USING(idMonster)
			WHERE mundo='.$mundo.'';
			$mundosq = $db->sql_query($query);
			while($mundo = $db->sql_fetchrow($mundosq))
			{
				$template->assign_block_vars('MOB', array(
						'ID' => $mundo['idInMundo'],
						'NAME' => $mundo['nombre'],
						'CX' => $mundo['vr_X'],
						'CY' => $mundo['vr_Y'],
						'X' => $mundo['vr_X']*50,
						'IMG' => $mundo['imagen'],
						'Y' => $mundo['vr_Y']*50
						));	
			}
			$query = 'SELECT im.vr_X, im.vr_Y, c.imagen, p.sexo, p.nombre, p.idPersonaje, im.idInMundo, idClase
			FROM inmundo im JOIN personaje p ON(p.idPersonaje = im.idPlayer) JOIN clase c USING(idClase)
			WHERE mundo='.$mundoRow['id'];
			$mundosq = $db->sql_query($query);
			while($mundo = $db->sql_fetchrow($mundosq))
			{
				if($mundo['idPersonaje'] != $log->get("pjSelected"))
				{
					$mundo['imagen'] = $mundo['imagen'].'_'.$mundo['sexo'].'.jpg';
					$template->assign_block_vars('USR', array(
							'ID' => $mundo['idInMundo'],
							'NAME' => $mundo['nombre'],
							'CX' => $mundo['vr_X'],
							'CY' => $mundo['vr_Y'],
							'X' => $mundo['vr_X']*50,
							'IMG' => $mundo['imagen'],
							'Y' => $mundo['vr_Y']*50
							));	
				}
				else
				{
					
					 $template->assign_vars(array(
							'UCX' => $mundo['vr_X'],
							'UCY' => $mundo['vr_Y']
					));
	
				}
			}
			
			$query = 'SELECT sl.cooldownCurrent, s.*, sl.orden, sl.keybind, sl.idPersonaje, sl.idSkill
												FROM skill s, skilllearn sl WHERE sl.disable = 0 AND
												s.idSkill=sl.idSkill AND sl.idPersonaje = '.$log->get("pjSelected").' AND s.active = 1 ORDER BY s.nivel DESC';
												$skillsq = $db->sql_query($query);
												
												$template->assign_block_vars('S', array(
															'ID' => 0,
															'NOMBRE' => "Basic Attack|Damage based on Attack",
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
																	'ID' => $skill['idSkill']
																	));
																	
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
									'NOMBRE' => $skill['nombre'].'|'.$skill['desc'].'<br><spam class=costoMP>Costo de mana: '.$skill['costomp'].'</spam>',
																	'CD' => $skill['cooldown'],	
																	'TAR' => $skill['toTarget'],
																	'IMG' => $skill['imagen']
																	));
													}
												}
												
			
			
			
?> 