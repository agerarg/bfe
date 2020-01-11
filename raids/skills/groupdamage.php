<?php
		$ataque_monster = critical($monster['Ataque']*2,$monster['PC']);
		$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
		
		$query = 'SELECT idPersonaje, Vida
			FROM personaje
			WHERE location = '.$check['mundo'].' AND Vida > 0';
		$targetssq = $db->sql_query($query);
		while($target = $db->sql_fetchrow($targetssq))
		{
			if($ataque_monster>$target['Vida'])
				$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+DEATHTIME)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$target['idPersonaje']."'");
			else
			 	$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$target['idPersonaje']."'");	
		}
						
		$vidaModifier=$vidaModifier-$ataque_monster;
		
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> golpe masivo de ".$ataque_monster."!";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');				
?>
