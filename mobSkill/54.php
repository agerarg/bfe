<?php
	$robo = mt_rand(1000,20000);
		if($pj['party']>0)
		{
				$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje,p.idCuenta , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
										FROM personaje p , clase c
									WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
									 Vida > 0 AND attackCooldown > '.($now-300).' AND p.party>0';
				$fpjsq =$db->sql_query($query);
				while($fpj = $db->sql_fetchrow($fpjsq))
				{
						$db->sql_query("DELETE FROM aura WHERE idPersonaje = ".$fpj['idPersonaje']." AND timeOut>".$now." AND static = 0 AND idSkillReal != 116");
				}
				$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> cancel all buffs!";
						$db->sql_query('INSERT INTO  chat(party,mensaje) 
									VALUES("'.$pj['party'].'","'.$data['counter'].'")');	
		}
		else
		{
			$db->sql_query("DELETE FROM aura WHERE idPersonaje = ".$pj['idPersonaje']." AND timeOut>".$now." AND static = 0 AND idSkillReal != 116");
			$data['info'] .= "<spam class='raidname'>".$monster['nombre']."</spam> cancel all your buffs";	
		}				
?>
