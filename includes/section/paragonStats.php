<?php
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Script By Ager [ager.arg@gmail.com] ///////////////////
/////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['puntos']))
{
		$vida = intval($_POST['vida']);
		$defensa = intval($_POST['defensa']);
		$ataque = intval($_POST['ataque']);
		
		if($pj['paragonNow']>=($vida+$defensa+$ataque))
		{
			if($vida<0 OR $defensa<0 OR $ataque<0)	
			{
				show_error("Puntos incorrectos!","index.php?sec=paragonStats");
			}
			else
			{
				if($vida>0)
				{
					$db->sql_query("UPDATE aura SET acumuleitor=(acumuleitor+".$vida.") WHERE idSkill = 291 AND idPersonaje = ".$log->get("pjSelected")."");	
				}
				if($defensa>0)
				{
					$db->sql_query("UPDATE aura SET acumuleitor=(acumuleitor+".$defensa.") WHERE idSkill = 265 AND idPersonaje = ".$log->get("pjSelected")."");	
				}
				if($ataque>0)
				{
					$db->sql_query("UPDATE aura SET acumuleitor=(acumuleitor+".$ataque.") WHERE idSkill = 256 AND idPersonaje = ".$log->get("pjSelected")."");	
				}
				$db->sql_query("UPDATE personaje SET paragonNow=(paragonNow-".($vida+$defensa+$ataque).") WHERE idPersonaje = ".$log->get("pjSelected")."");	
				show_message("Puntos paragon guardados!","index.php?sec=paragonStats");
			}
		}
		else
		{
			show_error("No tienes suficientes paragons!","index.php?sec=paragonStats");
		}
		
}
else
{
$template->set_filenames(array(
							'content' => 'templates/sec/paragonStats.html' )
						);
						$template->assign_var('PUNTOS',$pj['paragonNow']);	
					
						$template->assign_var('FONDIMAG',"paragon.jpg");	

	$query = 'SELECT a.idAura, a.acumuleitor, s.nombre, s.imagen, s.desc, s.idRealSkill
												FROM skill s JOIN aura a USING ( idSkill ) WHERE 
					a.idPersonaje = '.$log->get("pjSelected").' AND s.idRealSkill = a.idSkillReal
					AND ( s.idSkill = 291  OR s.idSkill = 265 OR s.idSkill = 256) ORDER BY nivel DESC';
			$skillsq = $db->sql_query($query);
												
			while($skill = $db->sql_fetchrow($skillsq))
				{
					$bonus = 0;
					switch($skill['idRealSkill'])
					{
						case 158:
							$bonus = intval($skill['acumuleitor']*25);
							$desc=' Aumenta 25 puntos de vida por cada paragon <input class="select" id="vida" name="vida" type="text" size="4"  value="0" /><div id="vidaBonus"> Bonus actual:'.$bonus.'</div>';
							$template->assign_var('VIDAPARG',$skill['acumuleitor']);	
						break;
						case 150:
							$bonus = intval($skill['acumuleitor']);
							$desc=' Aumenta 1 de defensa y defensa magica por cada paragon <input class="select" id="defensa" name="defensa" type="text" size="4"  value="0" /><div id="defensaBonus"> Bonus actual:'.$bonus.'</div>';
							$template->assign_var('DEFPARAG',$skill['acumuleitor']);	
						break;
						case 149:
							$bonus = intval($skill['acumuleitor']);
							$desc=' Aumenta 1 de ataque y ataque magico por cada paragon <input class="select" id="ataque" name="ataque" type="text" size="4"  value="0" /><div id="ataqueBonus"> Bonus actual:'.$bonus.'</div>';
							$template->assign_var('ATAPARAG',$skill['acumuleitor']);	
						break;
					}
					
						$template->assign_block_vars('BUFF', array(
												'ID' => $skill['idAura'],
												'NOMBRE' => $skill['nombre']." (".$skill['acumuleitor'].")",
												'IMG' => $skill['imagen'],
												'DESC' =>  $desc,	
												));
				}
}
?> 