<?php
	// ANT WARRIOR
	$ataque_monster = critical($monster['Ataque']*2,$monster['PC']);
	if($pj['party']>0)
	{
		
		$query = 'SELECT p.party, p.clan, p.Vida, p.nombre, p.nivel,p.idPersonaje , c.STR,c.CON,c.DEX,c.WIT,c.INTEL,c.MEN 
								FROM personaje p , clase c
							WHERE p.location = '.$check['mundo'].' AND c.idClase = p.idClase AND p.party = '.$pj['party'].' AND
							 Vida > 0 AND attackCooldown > '.($now-300).' ORDER BY RAND() LIMIT 1';
		$fpj = $db->sql_fetchrow($db->sql_query($query));
		$badluck = checkStats($fpj['STR'],$fpj['CON'],$fpj['DEX'],$fpj['WIT'],$fpj['INTEL'],$fpj['MEN'],$fpj['nivel'],$fpj['idPersonaje']);
		$OtherVidaModifier=$fpj['Vida'];

			$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
			$timemuerto=DEATHTIME;
				if($badluck['deathRise']==1)
					$timemuerto = 90;
			if($ataque_monster>$OtherVidaModifier)
				$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto)."', killer = '".$monster['nombre']."' WHERE idPersonaje = '".$target['idPersonaje']."'");
			else
			 	$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$target['idPersonaje']."'");	
		
			if($fpj['idPersonaje']==$log->get("pjSelected"))			
			$vidaModifier=$vidaModifier-$ataque_monster;
		
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> use Ant Blast hit for ".$ataque_monster." damage to ".$fpj['nombre']."";
			$db->sql_query('INSERT INTO  chat(party,mensaje) 
							VALUES("'.$fpj['party'].'","'.$data['counter'].'")');
	}
	else
	{
			$ataque_monster = defensa($ataque_monster,$badluck['Defensa']);
			$timemuerto=DEATHTIME;
			if($stats['deathRise']==1)
					$timemuerto = 90;
			if($ataque_monster>$vidaModifier)
				$db->sql_query("UPDATE personaje SET Vida='0', deathTime = '".($now+$timemuerto )."', killer = '".$monster['nombre']." ' WHERE idPersonaje = '".$pj['idPersonaje']."'");
			else
			 	$db->sql_query("UPDATE personaje SET Vida=(Vida-".$ataque_monster.") WHERE idPersonaje = '".$pj['idPersonaje']."'");	
				
			$vidaModifier=$vidaModifier-$ataque_monster;
		
			$data['counter'] = "<spam class='raidname'>".$monster['nombre']."</spam> use Ant Blast hit for ".$ataque_monster." damage to ".$pj['nombre']."";

	}
?>
