<?php
		$ataque_monster = critical($monster['Ataque']*8,$monster['PC']);
		$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
		
		
		$query = 'SELECT idPersonaje, Vida, nombre
			FROM personaje
			WHERE location = '.$check['mundo'].' AND Vida > 0 ORDER BY RAND() LIMIT 0,3';
		$targetssq = $db->sql_query($query);
		$nombres="";
		while($target = $db->sql_fetchrow($targetssq))
		{
			$nombres .=" ".$coma.$target['nombre'];
			if($ataque_monster>$target['vida'])
				$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+DEATHTIME)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$target['idPersonaje']."'");
			else
			 	$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$target['idPersonaje']."'");	
			$coma=",";
		}
		
		
		$vidaModifier=$vidaModifier-$ataque_monster;
		
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> ".$nombres." DIE!!!";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');				
?>
