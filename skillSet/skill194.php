<?php
//Bite
$data['animation']=0;
$fisicalCoolDown = 1;
//$skill['cooldown']=1;
switch($check['tipo'])
		{
			default:
				$claseid = mt_rand(1,8);

				$query = 'SELECT idClase, idPersonaje FROM personaje 
				WHERE nivel <= '.$pj['nivel'].' 
				AND idClase = '.$claseid.' 
				ORDER BY `nivel` DESC LIMIT 1';
				$playersq = $db->sql_query($query);
				$player = $db->sql_fetchrow($playersq);
				$monster['PJID']=$player['idPersonaje'];
					$db->sql_query("DELETE FROM skilllearn WHERE garcados = 1 AND idPersonaje = '".$log->get("pjSelected")."' ");
					
					$query = 'SELECT s.idSkill, s.idRealSkill, sl.nivel, s.nombre
						FROM skilllearn sl JOIN skill s USING ( idSkill )
						WHERE  sl.idPersonaje = "'.$monster['PJID'].'"
						AND s.active = 1 AND noRecet = 0 AND s.idSkill != 301 AND s.idSkill != 300 AND s.idSkill != 299 AND s.idSkill != 278 AND s.idSkill != 349 
						AND !(s.idSkill >= 352 AND s.idSkill <= 357)
						ORDER BY RAND() limit 0,'.($skill['nivel']+1);
					$buffsq = $db->sql_query($query);
					$coma="";
					$someskill=false;
					while($buff = $db->sql_fetchrow($buffsq))
					{
						if($someskill)
							$coma=",";
						$db->sql_query('INSERT INTO  skilllearn(idPersonaje,idSkill,nivel,idRealSkill,noRecet,garcados) 
								VALUES("'.$log->get("pjSelected").'","'.$buff['idSkill'].'","'.$buff['nivel'].'",'.$buff['idRealSkill'].',1,1)');
								
						$mensaj .=$coma." ".$buff['nombre'];	
						$someskill=true;	
					}
					if($someskill)
					{
						$data['info'] .= $skill['nombre']." copio ".$mensaj;
						$pvpInfo .= $skill['nombre']." copio ".$mensaj;
						$data['recetSkillCd']=1;
						$data['bicho']=$check['idInMundo'];
						$data['mund']=$check['id'];
						$data['info'] .= "".$skill['nombre']."";
					}
					else
					{
						$data['info'] .= $skill['nombre']." no hay habilidades para copiar";
						$pvpInfo .= $skill['nombre']." no hay habilidades para copiar";
					}
			break;
			case 1:
				$query = 'SELECT idClase
					FROM personaje
					WHERE  idPersonaje = '.$monster['PJID'];
				$playersq = $db->sql_query($query);
				$player = $db->sql_fetchrow($playersq);
				if($player['idClase']==10)
				{
					$data['info'] .= $skill['nombre']." no funciona con garcas";
					$pvpInfo .= $skill['nombre']."  no funciona con garcas";
				}
				else
				{
					$db->sql_query("DELETE FROM skilllearn WHERE garcados = 1 AND idPersonaje = '".$log->get("pjSelected")."' ");
					
					$query = 'SELECT s.idSkill, s.idRealSkill, sl.nivel, s.nombre
						FROM skilllearn sl JOIN skill s USING ( idSkill )
						WHERE  sl.idPersonaje = "'.$monster['PJID'].'"
						AND s.active = 1 AND noRecet = 0 AND s.idSkill != 301 AND s.idSkill != 300 AND s.idSkill != 299 AND s.idSkill != 278 AND s.idSkill != 349 
						AND !(s.idSkill >= 352 AND s.idSkill <= 357)
						ORDER BY RAND() limit 0,'.($skill['nivel']+1);
					$buffsq = $db->sql_query($query);
					$coma="";
					$someskill=false;
					while($buff = $db->sql_fetchrow($buffsq))
					{
						if($someskill)
							$coma=",";
						$db->sql_query('INSERT INTO  skilllearn(idPersonaje,idSkill,nivel,idRealSkill,noRecet,garcados) 
								VALUES("'.$log->get("pjSelected").'","'.$buff['idSkill'].'","'.$buff['nivel'].'",'.$buff['idRealSkill'].',1,1)');
								
						$mensaj .=$coma." ".$buff['nombre'];	
						$someskill=true;	
					}
					if($someskill)
					{
						$data['info'] .= $skill['nombre']." copio ".$mensaj;
						$pvpInfo .= $skill['nombre']." copio ".$mensaj;
						$data['recetSkillCd']=1;
						$data['bicho']=$check['idInMundo'];
						$data['mund']=$check['id'];
						$data['info'] .= "".$skill['nombre']."";
					}
					else
					{
						$data['info'] .= $skill['nombre']." no hay habilidades para copiar";
						$pvpInfo .= $skill['nombre']." no hay habilidades para copiar";
					}
				}
		}

$MonsterAttackAproval=false;
?>
