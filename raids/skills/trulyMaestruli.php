<?php
		$ataque_monster = critical($monster['Ataque']*8,$monster['PC']);
		$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
		
		
		$query = 'SELECT idPersonaje, Vida, nombre
			FROM personaje
			WHERE location = '.$check['mundo'].' AND Vida > 0 ORDER BY RAND() LIMIT 0,5';
		$targetssq = $db->sql_query($query);
		$nombres="";
		while($target = $db->sql_fetchrow($targetssq))
		{
			if($ataque_monster>$target['Vida'])
			{
				$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+DEATHTIME)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$target['idPersonaje']."'");
				systemLog("party","<spam class='raidname'>".$monster['nombre']."</spam> golpeo por ".$ataque_monster." a ".$target['nombre']." y lo mato!");
			}
			else
			{
			 	$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$target['idPersonaje']."'");	
				systemLog("party","<spam class='raidname'>".$monster['nombre']."</spam> golpeo por ".$ataque_monster." a ".$target['nombre']."");
			}
		}
		
		
		$vidaModifier=$vidaModifier-$ataque_monster;
		
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> dice: Jojojojo!";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');				
?>
