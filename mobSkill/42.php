<?php

	// DArk MAGE
	$critical_chanse = mt_rand(1,100);
		if($monster['CriticoMagico'] > $critical_chanse)
		{
			$ataque_monster = critical(10000,125);
		}
		else
		{
			$ataque_monster = normal(10000);
		}
		if($pj['party']>0)
		{
				$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
										FROM personaje p , clase c
									WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
									 Vida > 0 AND attackCooldown > '.($now-300).' AND p.party>0';
				$fpjsq =$db->sql_query($query);
				while($fpj = $db->sql_fetchrow($fpjsq))
				{
					$badluck = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
					$OtherVidaModifier=$fpj['Vida'];
				
					$ataque_monster = defensa($ataque_monster,$badluck['DefensaMagica']);
					if($ataque_monster>$fpj['Vida'])
					{
						$timemuerto=DEATHTIME;
							if($badluck['deathRise']==1)
								$timemuerto = 90;
						$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', killer = '".$monster['nombre']." te mato' WHERE idPersonaje = '".$fpj['idPersonaje']."'");
						$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> kill ".$fpj['nombre']."!";
						$db->sql_query('INSERT INTO  chat(party,mensaje) 
									VALUES("'.$pj['party'].'","'.$data['counter'].'")');	
					}
					else
						$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$fpj['idPersonaje']."'");	
				
					if($fpj['idPersonaje']==$log->get("pjSelected"))			
					$vidaModifier=$vidaModifier-$ataque_monster;
					$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> use Darkness hit for ".$ataque_monster." damage!";
					$db->sql_query('INSERT INTO  chat(idPersonaje,mensaje) 
									VALUES("'.$fpj['idPersonaje'].'","'.$data['counter'].'")');
				}
				
		}
		else
		{
			$ataque_monster = defensa($ataque_monster,$stats['DefensaMagica']);
			$vidaModifier=$vidaModifier-$ataque_monster;
			$data['info'] .= "<spam class='raidname'>".$monster['nombre']."</spam> use Darkness hit for ".$ataque_monster." dmge";	
		}				
?>
