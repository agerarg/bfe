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
						$robo = mt_rand(1000,20000);
						$db->sql_query("UPDATE cuenta SET oro = (oro-".$robo.") WHERE idCuenta = ".$fpj['idCuenta']);
						
						$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> has stolen ".$robo." gold from ".$fpj['nombre']."!";
						$db->sql_query('INSERT INTO  chat(party,mensaje) 
									VALUES("'.$pj['party'].'","'.$data['counter'].'")');	
				}
				
		}
		else
		{
			$realGold = $log->realGold();
			if(($realGold-$robo)>0)
			{
				$db->sql_query("UPDATE cuenta SET oro = (oro-".$robo.") WHERE idCuenta = ".$log->get("idCuenta"));
			}
			$data['info'] .= "<spam class='raidname'>".$monster['nombre']."</spam> has stolen ".$robo." gold from you";	
		}				
?>
